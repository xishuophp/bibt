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
        
    <?= $form->field($model, 'dept_name')->textInput(['class'=>'col-xs-12']) ?>

    <?= $form->field($model, 'dept_type')->dropdownList(Yii::$app->params['deptType'],['class'=>'form-control']) ?>
    
    <?= $form->field($model, 'parent_id')->dropDownList($departments,['class'=>'col-xs-12','prompt'=>'无上级部门']) ?>

    <?= $form->field($model, 'dept_phone')->textInput(['class'=>'col-xs-12']) ?>
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right"><?=Yii::t('app','Dept Leader')?></label>
        
        <div class="col-sm-8 col-xs-12" style="width:66%">

            <?=Html::dropDownList("Department[dept_leader]",$model->dept_leader,Yii::$app->cache->get(Yii::$app->params['staffList']),['class'=>'chosen-select','prompt'=>'请选择']) ?>
        </div>
    </div>
    
    <?php if($model->isNewRecord){$model->order_no=100;} ?>
    <?= $form->field($model, 'order_no')->textInput(['class'=>'form-control']) ?>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right"><?=Yii::t('app','Is Index')?></label>

        <div class="radio inline">
            <label>
                <input name="Department[is_index]" value="1" type="radio" class="ace" <?php if($model->is_index==1){echo "checked";} ?> />
                <span class="lbl"> <?=Yii::t('app','Yes')?></span>
            </label>
        </div>
        <div class="radio inline">
            <label>
                <input name="Department[is_index]" value="0" type="radio" class="ace" <?php if($model->is_index==0){echo "checked";} ?> />
                <span class="lbl"> <?=Yii::t('app','No')?></span>
            </label>
        </div>
    </div>

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
<?php $this->registerJsFile('/static/js/chosen.jquery.min.js', ['depends'=>['backend\assets\AppAsset']]); ?>
<?php $this->registerJsFile('/static/js/jquery-ui.min.js', ['depends'=>['backend\assets\AppAsset']]); ?>
<?php $this->beginBlock('cms') ?>
    jQuery(function($){
        $('.chosen-select').chosen({allow_single_deselect:true}); 
                //resize the chosen on window resize
                $(window).on('resize.chosen', function() {
                    var w = $('.chosen-select').parent().width();
                    $('.chosen-select').next().css({'width':w});
                }).trigger('resize.chosen');

        $('.chosen-select').chosen({allow_single_deselect:true}); 
                //resize the chosen on window resize
        $(window).on('resize.chosen', function() {
            var w = $('.chosen-select').parent().width();
            $('.chosen-select').next().css({'width':w});
        }).trigger('resize.chosen');
    });
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['cms'], \yii\web\View::POS_END); ?>
