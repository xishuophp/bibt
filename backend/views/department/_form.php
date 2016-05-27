<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>

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
        
    <?= $form->field($model, 'dept_name')->textInput(['class'=>'col-xs-12']) ?>

    <?= $form->field($model, 'dept_type')->dropdownList(Yii::$app->params['deptType'],['class'=>'form-control']) ?>

    <?= $form->field($model, 'parent_id')->textInput(['class'=>'col-xs-12']) ?>

    <?= $form->field($model, 'dept_phone')->textInput(['class'=>'col-xs-12']) ?>

    <?= $form->field($model, 'dept_leader')->textInput(['class'=>'col-xs-12']) ?>

    <?= $form->field($model, 'dept_intro')->textarea(['class' => 'col-xs-12 col-sm-12','rows'=>4]) ?>

    <?= $form->field($model,'dept_details')->widget('pjkui\kindeditor\KindEditor',['clientOptions'=>['class'=>'col-sm-8 col-xs-12','allowFileManager'=>'true','allowUpload'=>'true']]) ?>
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
