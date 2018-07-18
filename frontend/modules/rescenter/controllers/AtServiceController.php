<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\modules\rescenter\controllers;

use common\components\aliyuncs\Aliyun;
use common\core\AccessTokenController;
use common\modules\webuploader\models\Uploadfile;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * 允许其它客户端通过 AccessToken 方式访问
 *
 * @author Administrator
 */
class AtServiceController extends AccessTokenController{
    public function behaviors() {
        return parent::behaviors() + [
            'authenticator' => [
                'optional' => [
                    //'index', 注明 index 不需要使用 accessToken 访问
                ],
            ]
        ];
    }
    
    /**
     * 返回资源列表
     * @return string
     */
    public function actionList()
    {
        /* @var $file Uploadfile */
        $ufiles = Uploadfile::findAll(['is_del' => 0]);
        foreach($ufiles as &$file){
            $file->thumb_path = $this->getExt(pathinfo($file->oss_key, PATHINFO_EXTENSION));
        }
        return $this->render('list',['files' => $ufiles]);
    }
    
    /**
     * 下载文件
     */
    public function actionDownload(){
        $file_id = ArrayHelper::getValue(Yii::$app->request->getQueryParams(), 'file_id', '');
        /* @var $file Uploadfile */
        $file = Uploadfile::findOne(['id' => $file_id, 'is_del' => 0]);
        if ($file) {
            $file->download_count ++;
            //保存
            $file->save();
            try {
                
//                Yii::$app->getResponse()->sendContentAsFile(Aliyun::getOss()->getInputObject($file->oss_key, [
//                    OssClient::OSS_RANGE => Yii::$app->getRequest()->getHeaders()->get('range'),
//                    OssClient::OSS_FILE_DOWNLOAD => 'aaaaaaaaaa.mp4',
//                ]), $file->name );
                //Yii::$app->getResponse()->sendFile($file->path, $file->name);
                return $this->redirect(Aliyun::absoluteInputPath($file->oss_key));
            } catch (Exception $ex) {
                throw new NotFoundHttpException($ex->getMessage());
            }
        } else {
            throw new NotFoundHttpException('文件不存在！');
        }
    }
    
    /**
     * 获取对应文件类型图标
     * @param suffix        文件后缀
     * @returns {string}
     * @private
     */
    private function getExt($suffix) {
        
        //无法生成缩略图的文件图标
        $exts = [
            'doc' => ['doc', 'docx'],
            'xls' => ['xls', 'xlsx'],
            'ppt' => ['ppt', 'pptx'],
            'ai' => ['ai'],
            'audio' => ['mp3', 'wma'],
            'gif' => ['gif'],
            'jpg' => ['jpg', 'jpeg'],
            'pdf' => ['pdf'],
            'psd' => ['psd'],
            'video' => ['mp4', 'avi', 'mpg', 'wmv', 'rmvb', 'rm', 'mov'],
            'zip' => ['zip', 'rar', 'tar', 'gz'],
        ];
        $ext = 'other';
        $suffix = strtolower($suffix);
        foreach ($exts as $key => $ext_arr) {
            if (in_array($suffix, $ext_arr)) {
                return "/imgs/upload_filetype_icons/$key.png";
            }
        }
        return "/imgs/upload_filetype_icons/$ext.png";
    }
}
