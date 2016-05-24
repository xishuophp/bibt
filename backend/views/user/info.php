<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'User Info');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            <?= Html::encode($this->title) ?>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <?php $form = ActiveForm::begin([
            'options' => [
                    'class'=>'form-horizontal',
                    'role'=>'form',
                    'enctype'=>'multipart/form-data',
                ],
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-sm-4 col-xs-12\">{input}</div><div class=\"help-block col-xs-12 col-sm-reset inline\">{error}</div>",
                    'labelOptions' => ['class'=>'col-sm-2 control-label no-padding-right'],
                ],
        ]); ?>
        <div class="col-sm-12">
            <?= $form->field($model, 'nickname')->textInput() ?>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right"><?=Yii::t('app','Image Url')?></label>
                <div class="col-sm-4 col-xs-12">
                    <?php 
                    $image = json_decode($model->avatar,true);
                    if(empty($image)){ ?>
                        <label>
                            <input name="avatar" type="file" class="ace" />
                        </label>
                    <?php }else{ ?>
                            <image id="logo" height="50" src=<?= $image[0]['fileUrl'] ?>>
                            <a onclick="update_image()">点击修改</a>
                            <input type="hidden" name="imageInfo[]" value=<?= $image[0]['fileUrl']; ?>>
                    <?php } ?>
                </div>
            </div>
            <?= $form->field($model, 'city')->textInput() ?>
            <?= $form->field($model, 'email')->textInput() ?>
            <?= $form->field($model, 'mobile')->textInput() ?>
            <?= $form->field($model, 'qq')->textInput() ?>
            <?= $form->field($model, 'introduce')->textarea(['rows' => '5']) ?>
            
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-offset-2 col-md-6" style="margin:20px auto 0px">
                    <button name="subtype" onclick="sub_post();" class="btn btn-info" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        <?=Yii::t('app', 'Save')?>
                    </button>
                    &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        <?=Yii::t('app', 'Reset')?>
                    </button>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?> 
    </div>						
</div>

<script type="text/javascript">
    function update_image(){
        $('#logo').siblings().remove();
        $('#logo').after("<div id='logo2'></br><div class='radio inline no-padding'>修改为：</div><div class='radio inline'><input type='file' name='image_url' /></div><a class='middle' onclick='del()'><i class='ace-icon fa fa-trash-o red bigger-130 middle'></i></a></div>");
    }
    function del(){
        $('#logo2').remove();
        $('#logo').after('<a onclick="update_image()">点击修改</a>');
    }
</script>
