<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<link rel="stylesheet" href="/static/css/chosen.css" />       
<link rel="stylesheet" href="/static/css/ace.min.css" />
<link rel="stylesheet" href="/static/css/jquery-ui.min.css" />
<?php $form = ActiveForm::begin([
            'options' => [
                'class'=>'form-horizontal',
                'role'=>'form',
            ],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-sm-8 col-xs-12\">{input}</div><div class=\"help-block col-xs-12 col-sm-reset inline\">{error}</div>",
                'labelOptions' => ['class'=>'col-sm-2 control-label no-padding-right'],
            ],
    ]); ?>
        
    <?= $form->field($model, 'course_name')->textInput(['class'=>'col-xs-12']) ?>

    <?= $form->field($model, 'class_room')->textInput(['class'=>'col-xs-12']) ?>

    <?= $form->field($model, 'teacher')->textInput(['class'=>'col-xs-12']) ?>

    <?= $form->field($model, 'section')->textInput(['class'=>'col-xs-12','placeholder'=>'多节课之间用英文,隔开如:1,2,3']) ?>

    <?= $form->field($model, 'class_time')->textInput(['class'=>'col-xs-12']) ?>

    <?= $form->field($model, 'class_name')->textInput(['class'=>'col-xs-12']) ?>

    <?= $form->field($model, 'academic_year')->textInput(['class'=>'col-xs-12']) ?>

    <?= $form->field($model, 'week_day')->textInput(['class'=>'col-xs-12']) ?>

    <?= $form->field($model, 'note')->textarea(['class' => 'col-xs-12 col-sm-12','rows'=>4]) ?>
    <div class="clearfix form-actions">
        <div class="col-md-offset-2 col-md-9">
            <button class="btn btn-info" type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>
                <?=Yii::t('app','Submit') ?>
            </button>

            &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
            <button class="btn" type="reset">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                <?=Yii::t('app','Reset') ?>
            </button>
        </div>
    </div>
<?php ActiveForm::end(); ?>
