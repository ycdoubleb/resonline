<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\modules\external\models;

use common\models\api\ApiResponse;

/**
 * Description of ExternalResponse
 *
 * @author Administrator
 */
class ExternalResponse extends ApiResponse{
     /**
     * 未知错误
     */
    const CODE_AUTHENTICATION_FAIL = 'Code.Authentication.Fail';
    
    /**
     * 未找到对应用户
     */
    const CODE_USER_NOT_FOUND = 'Code.User.Not.Found';
    /**
     * 超时
     */
    const CODE_TIME_OUT = 'Code.Time.Out';
    
    /** 同步失败 */
    const CODE_SYNCHRONIZATION_USER_FAIL = 'Code.Synchronization.User.Fail';
    
    public function getCodeMap() {
        return parent::getCodeMap() + [
            self::CODE_AUTHENTICATION_FAIL => "认证失败",
            self::CODE_USER_NOT_FOUND => "未找到对应用户",
            self::CODE_TIME_OUT => "超时",
            self::CODE_SYNCHRONIZATION_USER_FAIL => "同步失败",
        ];
    }
}
