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
        
    <?= $form->field($model, 'article_title')->textInput(['class'=>'col-xs-12',]) ?>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right" for="simple-colorpicker-1"><?= Yii::t('app','Title Color')?></label>
        <div class="col-sm-4 col-xs-12">
            <?=Html::dropDownList('Article[title_color]',$model->title_color,Yii::$app->params['ArticleTitleColorArr'],['class'=>'hide','id'=>'simple-colorpicker-1']) ?>
        </div>

    </div>

    <?= $form->field($model, 'article_alias')->textInput(['class'=>'col-xs-12',]) ?>

    <?= $form->field($model, 'article_excerpt')->textarea(['class'=>'col-xs-12',]) ?>

    <?php if($model->isNewRecord){$model->order_no=100;} ?>
    <?= $form->field($model, 'order_no')->textInput(['class'=>'col-xs-12',]) ?>

    <?= $form->field($model, 'article_category')->dropDownList($categorys,['class'=>'col-xs-12','prompt'=>'请选择分类']) ?>

    <?= $form->field($model, 'article_status')->dropDownList(Yii::$app->params['articleStatus'],['class'=>'col-xs-12']) ?>

    <?php if($model->publish_date){$model->publish_date = '';} ?>
    <?= $form->field($model, 'publish_date')->textInput(['class'=>'col-xs-12','id'=>'date-timepicker1','placeholder'=>date('Y-m-d H:i:s')]) ?>

    <?= $form->field($model,'article_content')->widget('pjkui\kindeditor\KindEditor',['clientOptions'=>['class'=>'col-sm-8 col-xs-12','allowFileManager'=>'true','allowUpload'=>'true']]) ?>

    <div class="form-group">
        <label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Article Attachment')?></label>
        <div class="col-sm-6 col-xs-12">
            <div class="form-group no-margin-bottom attachment_box col-xs-12">
                <div class="col-xs-12 col-sm-12">
                    <div id="form-attachments">
                        <?php if($model->article_attachment){ ?>
                            <ul class="attachment-list pull-left list-unstyled col-xs-12 col-sm-7">
                            <?php 
                                $fileRet = json_decode($model->article_attachment,true);
                                foreach ($fileRet as $key => $value) {
                                    if($value){
                            ?>
                                <li>
                                    <input type="hidden" name="attachment2[]" value=<?= json_encode($value) ?> >
                                    <a href="javascript:void(0)" class="width-85 inline attached-file">
                                        <i class="ace-icon fa fa-file-o bigger-110"></i>
                                        <span class="attached-name"><?= $value['name']?></span>
                                    </a>

                                    <span class="action-buttons">
                                        <a href="javascript:void(0)" data-action="delete">
                                            <i class="ace-icon fa fa-trash-o red bigger-130 middle"></i>
                                        </a>
                                    </span>
                                </li>
                            <?php }} ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="align-right">
                <button id="id-add-attachment" type="button" class="btn btn-sm btn-danger">
                    <i class="ace-icon fa fa-paperclip bigger-140"></i>
                    <?=Yii::t('app', 'Add Attachment')?>
                </button>
            </div>
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
<link rel="stylesheet" href="/static/css/bootstrap-datetimepicker.css" />

<?php $this->registerJsFile("/static/js/date-time/bootstrap-datepicker.min.js", ['depends'=>['backend\assets\AppAsset']]); ?>
<?php $this->registerJsFile("/static/js/date-time/moment.min.js", ['depends'=>['backend\assets\AppAsset']]); ?>
<?php $this->registerJsFile("/static/js/date-time/bootstrap-datetimepicker.min.js", ['depends'=>['backend\assets\AppAsset']]); ?>
<?php $this->registerJsFile("/static/js/jquery.colorbox-min.js", ['depends'=>['backend\assets\AppAsset']]); ?>
<?php $this->beginBlock('cms') ?>
    jQuery(function($){
        function showErrorAlert (reason, detail) {
            var msg='';
            if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
            else {
                //console.log("error uploading file", reason, detail);
            }
            $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
             '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
        }
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#date-timepicker1').datetimepicker().next().on(ace.click_event, function(){
            $(this).prev().focus();
        });

        $('#id-add-attachment').on('click', function(){
                var file = $('<input type="file" name="attachment[]" />').appendTo('#form-attachments');
                file.ace_file_input();
                
                file.closest('.ace-file-input')
                .addClass('width-85 inline')
                .wrap('<div class="form-group file-input-container"><div class="col-sm-7"></div></div>')
                .parent().append('<div class="action-buttons pull-right col-xs-1">\
                    <a href="#" data-action="delete" class="middle">\
                        <i class="ace-icon fa fa-trash-o red bigger-130 middle"></i>\
                    </a>\
                </div>')
                .find('a[data-action=delete]').on('click', function(e){
                    //the button that removes the newly inserted file input
                    e.preventDefault();
                    $(this).closest('.file-input-container').hide(300, function(){ $(this).remove() });
                });
            });

        $('#simple-colorpicker-1').ace_colorpicker();

        $('.attachment-list').find('a[data-action=delete]').each(function(){
            $(this).click(function(){
                $(this).parent().parent().remove();
                if(!$(this).siblings()){
                }
            });
        })

    });
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['cms'], \yii\web\View::POS_END); ?>
