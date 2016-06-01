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
                'enctype'=>'multipart/form-data',
            ],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-sm-8 col-xs-12\">{input}</div><div class=\"help-block col-xs-12 col-sm-reset inline\">{error}</div>",
                'labelOptions' => ['class'=>'col-sm-2 control-label no-padding-right'],
            ],
    ]); ?>
        
    <?= $form->field($model, 'category_name')->textInput(['class'=>'col-xs-12',]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($categorys,['class'=>'col-xs-12','prompt'=>'无父级分类'])->label(Yii::t('app','Parent Category')) ?>

    <?php if($model->isNewRecord){$model->order_no=100;} ?>
    <?= $form->field($model, 'order_no')->textInput(['class'=>'col-xs-12',]) ?>
    
    <?= $form->field($model, 'query_tag')->textInput(['class'=>'col-xs-12',]) ?>
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

