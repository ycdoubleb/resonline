<?php

use common\modules\webuploader\models\Uploadfile;
use common\widgets\webuploader\WebUploaderAsset;
use yii\helpers\Html;
use yii\web\View;
/* @var $this View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    
    <div class="container"><?= Html::a('清空资源库',['clear-uploadfile'],['class' => 'btn btn-default'])?></div>
    
    <div class="container">
        <div class="col-xs-12 col-sm-2" style="text-align: right;">视频上传：</div>
        <div id="video-uploader-container" class="col-xs-12 col-sm-10">
        </div>
    </div>
    <?php
    //获取flash上传组件路径
    $swfpath = $this->assetManager->getPublishedUrl(WebUploaderAsset::register($this)->sourcePath);
    //获取已上传文件
    $files = json_encode(Uploadfile::find()->asArray()->all());
    ?>
    <script type='text/javascript'>
        var videoUploader;

        window.onload = function () {
            require(['euploader'], function (euploader) {
                var config = {
                    name: 'videos',
                    swf: '<?= $swfpath ?>' + '/Uploader.swf',
                    // 文件接收服务端。
                    server: '/webuploader/default/upload',
                    //检查文件是否存在
                    checkFile: '/webuploader/default/check-file',
                    //分片合并
                    mergeChunks: '/webuploader/default/merge-chunks',
                    // 选择文件的按钮。可选。
                    // 上传容器
                    container: '#video-uploader-container',
                    formData: {
                        "<?= Yii::$app->request->csrfParam ?>": "<?= Yii::$app->request->csrfToken ?>",
                        //指定文件上传到的应用
                        app_path: 'vk',
                        //同时创建缩略图
                        makeThumb: 1
                    }

                };

                //视频
                var videoUploader = new euploader.Uploader(config);

                videoUploader.addCompleteFiles(<?= $files ?>);
            });
        }
        /**
         * 上传文件完成才可以提交
         * @returns {Wskeee.Uploader.isFinish}
         */
        function tijiao() {
            //uploader,isFinish() 是否已经完成所有上传

            return videoUploader.isFinish();
        }
    </script>
</div>
