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
        
        <?= $form->field($model, 'username')->textInput(['class'=>'col-xs-12']) ?>

        <?= $form->field($model, 'nickname')->textInput(['class'=>'col-xs-12']) ?>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right"><?=Yii::t('app','Sex')?></label>

            <div class="radio inline">
                <label>
                    <input name="User[sex]" value="1" type="radio" class="ace" <?php if(($model->sex==null)||$model->sex==1){echo "checked";} ?> />
                    <span class="lbl"> <?=Yii::t('app','Male')?></span>
                </label>
            </div>
            <div class="radio inline">
                <label>
                    <input name="User[sex]" value="0" type="radio" class="ace" <?php if($model->sex===0){echo "checked";} ?> />
                    <span class="lbl"> <?=Yii::t('app','Female')?></span>
                </label>
            </div>

        </div>
        
        <?= $form->field($model, 'email')->textInput(['class'=>'col-xs-12']) ?>
        
        <?= $form->field($model, 'mobile')->textInput(['class'=>'col-xs-12']) ?>

        <?php if(!$model->isNewRecord): ?>
        <?= $form->field($model, 'status')->dropdownList(Yii::$app->params['userStatus'],['class'=>'form-control']) ?>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right"><?=Yii::t('app','Reset Password')?></label>

            <div class="radio inline">
                <label>
                    <input name="reset_password" value="1" type="radio" class="ace" />
                    <span class="lbl"> <?=Yii::t('app','Yes')?></span>
                </label>
            </div>
            <div class="radio inline">
                <label>
                    <input name="reset_password" value="0" type="radio" class="ace" checked />
                    <span class="lbl"> <?=Yii::t('app','No')?></span>
                </label>
            </div>

        </div>    
        <?php endif;?>
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
