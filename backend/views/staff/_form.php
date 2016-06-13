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
        
    <?= $form->field($model, 'real_name')->textInput(['class'=>'col-xs-12']) ?>
    
    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right"><?=Yii::t('app','Sex')?></label>

        <div class="radio inline">
            <label>
                <input name="Staff[sex]" value="1" type="radio" class="ace" <?php if(($model->sex==null)||$model->sex==1){echo "checked";} ?> />
                <span class="lbl"> <?=Yii::t('app','Male')?></span>
            </label>
        </div>
        <div class="radio inline">
            <label>
                <input name="Staff[sex]" value="0" type="radio" class="ace" <?php if($model->sex===0){echo "checked";} ?> />
                <span class="lbl"> <?=Yii::t('app','Female')?></span>
            </label>
        </div>

    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right"><?=Yii::t('app','Staff Logo')?></label>
        <div class="col-sm-4 col-xs-12">
            <?php 
            $image = json_decode($model->logo,true);
            if(empty($image)){ ?>
                <label>
                    <input name="logo" type="file" class="ace" />
                </label>
            <?php }else{ ?>
                    <image id="logo" height="50" src=<?= $image[0]['fileUrl'] ?>>
                    <a onclick="update_image()">点击修改</a>
            <?php } ?>
        </div>
    </div>
    
    <?= $form->field($model, 'dept_id')->dropDownList($departments,['class'=>'col-xs-12','prompt'=>'请选择'])->label(Yii::t('app','Dept Name')) ?>

    <?= $form->field($model, 'staff_type')->dropdownList(Yii::$app->params['staffType'],['class'=>'form-control']) ?>

    <?= $form->field($model, 'staff_title')->textInput(['class'=>'form-control']) ?>

    <?php if($model->isNewRecord){$model->order_no=100;} ?>
    <?= $form->field($model, 'order_no')->textInput(['class'=>'form-control']) ?>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right"><?=Yii::t('app','Is Index')?></label>

        <div class="radio inline">
            <label>
                <input name="Staff[is_index]" value="1" type="radio" class="ace" <?php if($model->is_index==1){echo "checked";} ?> />
                <span class="lbl"> <?=Yii::t('app','Yes')?></span>
            </label>
        </div>
        <div class="radio inline">
            <label>
                <input name="Staff[is_index]" value="0" type="radio" class="ace" <?php if($model->is_index==0){echo "checked";} ?> />
                <span class="lbl"> <?=Yii::t('app','No')?></span>
            </label>
        </div>
    </div>

    <?= $form->field($model, 'intro')->textarea(['class' => 'col-xs-12 col-sm-12','rows'=>4]) ?>

    <?= $form->field($model,'details')->widget('pjkui\kindeditor\KindEditor',['clientOptions'=>['class'=>'col-sm-8 col-xs-12','allowFileManager'=>'true','allowUpload'=>'true']]) ?>
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
<script type="text/javascript">
    function update_image(){
        $('#logo').siblings().remove();
        $('#logo').after("<div id='logo2'></br><div class='radio inline no-padding'>修改为：</div><div class='radio inline'><input type='file' name='logo' /></div><a class='middle' onclick='del()'><i class='ace-icon fa fa-trash-o red bigger-130 middle'></i></a></div>");
    }
    function del(){
        $('#logo2').remove();
        $('#logo').after('<a onclick="update_image()">点击修改</a>');
    }
</script>
