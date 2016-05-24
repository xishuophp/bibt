<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Update Password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            <?= Html::encode($this->title) ?>
        </h1>
        <?php
            if(Yii::$app->session->getFlash('success')){ ?>
            <div class="alert alert-block alert-success">
                <?= Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php }
        ?>
        <?php
            if(Yii::$app->session->getFlash('error')){ ?>
            <div class="alert alert-block alert-error">
                <?= Yii::$app->session->getFlash('error'); ?>
            </div>
        <?php }
        ?>
    </div><!-- /.page-header -->
    <div class="row">
        <?php $form = ActiveForm::begin([
            'id' => 'reset-password-form',
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
            <?= $form->field($model, 'oldpassword')->passwordInput()->label(Yii::t('app' , 'Old Password')) ?>
            <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app' , 'New Password')) ?>
            <?= $form->field($model, 'repassword')->passwordInput()->label(Yii::t('app' , 'Repeat Password')) ?>
            
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
    
</script>
