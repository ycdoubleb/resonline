<?php

namespace frontend\modules\rescenter\controllers;

use common\modules\webuploader\models\Uploadfile;
use yii\web\Controller;

/**
 * Default controller for the `rescenter` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        /* @var $file Uploadfile */
        $ufiles = Uploadfile::findAll(['is_del' => 0]);
        foreach($ufiles as &$file){
            $file->thumb_path = $this->getExt(pathinfo($file->oss_key, PATHINFO_EXTENSION));
        }
        return $this->render('index',['files' => $ufiles]);
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
                return "imgs/upload_filetype_icons/$key.png";
            }
        }
        return "imgs/upload_filetype_icons/$ext.png";
    }
}
