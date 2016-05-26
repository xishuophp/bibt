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
                'enctype' => 'multipart/form-data',
            ],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-sm-4 col-xs-12\">{input}</div><div class=\"help-block col-xs-12 col-sm-reset inline\">{error}</div>",
                'labelOptions' => ['class'=>'col-sm-2 control-label no-padding-right'],
            ],
    ]); ?>
        
    <?= $form->field($model, 'nav_name')->textInput(['class'=>'col-xs-12']) ?>

    <?= $form->field($model, 'nav_type')->dropdownList(Yii::$app->params['navType'],['class'=>'form-control']) ?>

    <?= $form->field($model, 'parent_id')->textInput(['class'=>'col-xs-12']) ?>

    <?= $form->field($model, 'nav_link')->textInput(['class'=>'col-xs-12']) ?>

    <?= $form->field($model, 'order_no')->textInput(['class'=>'col-xs-12']) ?>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right"><?=Yii::t('app','Image Url')?></label>
        <div class="col-sm-4 col-xs-12">
            <?php 
            $image = json_decode($model->nav_logo,true);
            if(empty($image)){ ?>
                <label>
                    <input name="logo" type="file" class="ace" />
                </label>
            <?php }else{ ?>
                    <image id="logo" height="100" width="100" src=<?= $image[0]['fileUrl'] ?>>
                    <a onclick="update_image()">点击修改</a>
            <?php } ?>
        </div>
    </div>
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