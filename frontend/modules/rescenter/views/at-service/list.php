<?php

use common\modules\webuploader\models\Uploadfile;
use frontend\modules\rescenter\assets\ResCenterAssets;

/* @var $files Array */
/* @var $file Uploadfile */

ResCenterAssets::register($this);
?>

<div class="rescenter-default-index">
    <div class="list">
        <?php foreach($files as $file): ?>
        <?php 
            $name = urlencode($file->name);
            $filename = pathinfo($file->oss_key,PATHINFO_BASENAME);
        ?>
        <div class="res-tile" title="<?= $file->name ?>">
            <div class="pic-box">
                <img src="<?= $file->thumb_path ?>"/>
            </div>
            <div class="name-box">
                <span class="name single-clamp"><?= $file->name ?></span>
                <a class="download" href="<?= "download://resource/$name/$file->id/$filename/$file->updated_at/$file->size/" ?>">下载</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
