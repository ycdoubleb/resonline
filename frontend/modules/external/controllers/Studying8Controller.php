<?php

namespace frontend\modules\external\controllers;

use common\core\BaseApiController;
use common\models\User;
use common\utils\SecurityUtil;
use frontend\modules\external\models\ExternalResponse;
use Yii;
use yii\filters\VerbFilter;

/**
 * www.studying8.com 接口
 *
 * @author Administrator
 */
class Studying8Controller extends BaseApiController {

    public $enableCsrfValidation = false;
    
    public function behaviors() {
        return parent::behaviors() + [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'authentication' => ['post'],
                ],
            ],
        ];
    }
    
    /**
     * studying8 到 res.studying8 认证，通过后返回目标用户令牌
     * 通过
     */
    public function actionAuthentication() {

        $post = Yii::$app->request->post();
        //加密 key
        $data = SecurityUtil::decryption($post['encrypt']);
        if($data == null){
            //认证失败
            return new ExternalResponse(ExternalResponse::CODE_AUTHENTICATION_FAIL);
        }else{
            $user_id = $data['user_id'];
        
            if ($user_id == null) {
                return new ExternalResponse(ExternalResponse::CODE_COMMON_MISS_PARAM, null, null, ['param' => 'user_id']);
            }
            //认证通过,返回用户token
            $user = User::findOne(['id' => $user_id, 'status' => User::STATUS_ACTIVE]);
            if($user == null){
                return new ExternalResponse(ExternalResponse::CODE_USER_NOT_FOUND);
            }
            //修改到期时间
            $user->generateAccessToken(false);                  
            $user->save(false, ['access_token','access_token_expire_time']);       
            return new ExternalResponse(ExternalResponse::CODE_COMMON_OK,null,["access_token" => $user->access_token]);
        }
    }

    /**
     * 同步用户
     * 在www.studying8.com的用户在res.studying8.com也有相同账号
     */
    public function actionSynchronizationUser(){
        $post = Yii::$app->request->post();
        //加密 key
        $data = SecurityUtil::decryption($post['encrypt']);
        if($data == null){
            //认证失败
            return new ExternalResponse(ExternalResponse::CODE_SYNCHRONIZATION_USER_FAIL);
        }else{
            if (!isset($data['User'])) {
                return new ExternalResponse(ExternalResponse::CODE_COMMON_MISS_PARAM, null, null, ['param' => 'User']);
            }
            /* @var $user User */
            $user = User::findOne(['id' => $data['User']['id']]);
            if(!$user){
                $user = new User();
            }
            if($user->load($data,'User') && $user->save()){
                return new ExternalResponse(ExternalResponse::CODE_COMMON_OK);
            }else{
                return new ExternalResponse(ExternalResponse::CODE_SYNCHRONIZATION_USER_FAIL,null,$user->getErrorSummary(true));
            }
        }
    }
}
