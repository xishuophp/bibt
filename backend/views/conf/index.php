<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\base\YiiForum;

$this->title = Yii::t('app', 'System Conf');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .switch{
        color:red;
        width:20px;
        margin-right: 8px;
        margin-left: 2px;
    }
    .deploy{
        padding:20px;
    }
</style>
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
                'enctype' => 'multipart/form-data',
            ],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-sm-4 col-xs-12\">{input}</div><div class=\"help-block col-xs-12 col-sm-reset inline\">{error}</div>",
                'labelOptions' => ['class'=>'col-sm-2 control-label no-padding-right'],
            ],
        ]); ?>
        <div class="col-sm-12">
            <div id="tabs">
                <ul>
                    <li>
                        <a href="#tabs-1"><?=yii::t('app','Basic Config') ?></a>
                    </li>

                    <li>
                        <a href="#tabs-2"><?=yii::t('app','Senior Config')?></a>
                    </li>
                </ul>

                <div id="tabs-1">
                    <?php if (isset($res['sysname1'][0])) { ?>
                        <div class="profile-activity clearfix config">
                            <div class="ids" id="<?= $res['sysname1'][0]?>"></div>
                            <div class="form-group" style="margin-top:15px;">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">fgdsh配置1: </label>
                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-6 SysConfigValue" name="sysname1" value="<?= $res['sysname1'][1]?>" />
                                </div>
                            </div> 
                        </div>
                    <?php }else{ ?>
                        <div class="profile-activity clearfix config">
                            <div class="ids" id=""></div>
                            <div class="form-group" style="margin-top:15px;">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">配置1: </label>
                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-6 SysConfigValue" name="sysname1" value="" />
                                </div>
                            </div> 
                        </div>
                    <?php } ?>
                    <?php if (isset($res['sysname2'][0])) { ?>
                        <div class="profile-activity clearfix config">
                            <div class="ids" id="<?= $res['sysname2'][0]?>"></div>
                            <div class="form-group" style="margin-top:15px;">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">配置2: </label>
                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-6 SysConfigValue" name="sysname2" value="<?= $res['sysname2'][1]?>" />
                                </div>
                            </div> 
                        </div>
                    <?php }else{ ?>
                        <div class="profile-activity clearfix config">
                            <div class="ids" id=""></div>
                            <div class="form-group" style="margin-top:15px;">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">配置2: </label>
                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-6 SysConfigValue" name="sysname2" value="" />
                                </div>
                            </div> 
                        </div>
                    <?php } ?>
                    <?php if (isset($res['sysname3'][0])) { ?>
                    <div class="profile-activity clearfix config">
                        <div class="ids" id="<?= $res['sysname3'][0]?>"></div>
                        <div class="form-group" style="margin-top:15px;">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">配置3: </label>
                            <div class="col-sm-9">
                                <input type="text" id="form-field-1"  class="col-xs-10 col-sm-6 SysConfigValue" name="sysname3" value="<?= $res['sysname3'][1]?>" />
                            </div>
                        </div> 
                    </div>
                    <?php }else{ ?>
                        <div class="profile-activity clearfix config">
                        <div class="ids" id=""></div>
                        <div class="form-group" style="margin-top:15px;">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">配置3: </label>
                            <div class="col-sm-9">
                                <input type="text" id="form-field-1"  class="col-xs-10 col-sm-6 SysConfigValue" name="sysname3" value="" />
                            </div>
                        </div> 
                    </div>
                    <?php } ?>
                    <?php if (isset($res['sysname4'][0])) { ?>
                    <div class="profile-activity clearfix config">
                        <div class="ids" id="<?= $res['sysname4'][0]?>"></div>
                        <div class="form-group" style="margin-top:15px;">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">配置4: </label>
                            <div class="col-sm-9">
                                <textarea type="text" name="sysname4" class="col-xs-10 col-sm-6 SysConfigValue" id="form-field-1"><?= $res['sysname4'][1]?></textarea>
                            </div>
                        </div> 
                    </div>
                    <?php }else{ ?>
                        <div class="profile-activity clearfix config">
                        <div class="ids" id=""></div>
                        <div class="form-group" style="margin-top:15px;">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">配置4: </label>
                            <div class="col-sm-9">
                                <textarea rows="4" type="text" name="sysname4" class="col-xs-10 col-sm-6 SysConfigValue" id="form-field-1"></textarea>
                            </div>
                        </div> 
                    </div>
                    <?php } ?>                                       
                </div>
  
                <div id="tabs-2">
                    <div class="form-group">
                        <div class="controls col-xs-12 col-sm-9" style="margin-left:12%;margin-top:10px;">
                            <!-- #section:custom/checkbox.switch -->
                            <div class="row line">
                                <?php if (isset($res['start_config1'][0])) { ?>
                                <div class="col-xs-10 deploy">
                                    <label class="col-xs-10">
                                    <div class="ids" id="<?= $res['start_config1'][0]?>"></div>
                                        <input name="start_config1" value="" class="ace ace-switch ace-switch-3" type="checkbox" <?php if($res['start_config1'][1] == 1) echo 'checked';?> />
                                        <span class="lbl">
                                            <i class="ace-icon fa fa-arrow-right icon-on-right switch"></i>是否开启配置1
                                        </span>
                                    </label>
                                </div>
                                <?php }else{ ?>
                                    <div class="col-xs-10 deploy">
                                        <label class="col-xs-10">
                                        <div class="ids" id=""></div>
                                            <input name="start_config1" value="" class="ace ace-switch ace-switch-3" type="checkbox" />
                                            <span class="lbl">
                                                <i class="ace-icon fa fa-arrow-right icon-on-right switch"></i>是否开启配置1
                                            </span>
                                        </label>
                                    </div> 
                                <?php } ?>
                                <?php if (isset($res['start_config2'][0])) { ?>
                                    <div class="col-xs-10 deploy">
                                        <label class="col-xs-10">
                                        <div class="ids" id="<?= $res['start_config2'][0]?>"></div>
                                            <input name="start_config2" value="" class="ace ace-switch ace-switch-3" type="checkbox" <?php if($res['start_config2'][1] == 1) echo 'checked';?> />
                                            <span class="lbl">
                                                <i class="ace-icon fa fa-arrow-right icon-on-right switch"></i>是否开启配置2
                                            </span>
                                        </label>
                                    </div>
                                <?php }else{ ?>
                                    <div class="col-xs-10 deploy">
                                        <label class="col-xs-10">
                                        <div class="ids" id=""></div>
                                            <input name="start_config2" value="" class="ace ace-switch ace-switch-3" type="checkbox" />
                                            <span class="lbl">
                                                <i class="ace-icon fa fa-arrow-right icon-on-right switch"></i>是否开启配置2
                                            </span>
                                        </label>
                                    </div>
                                <?php } ?>
                                <?php if (isset($res['start_config3'][0])) { ?>
                                    <div class="col-xs-10 deploy">
                                        <label class="col-xs-10">
                                        <div class="ids" id="<?= $res['start_config3'][0]?>"></div>
                                            <input name="start_config2" value="" class="ace ace-switch ace-switch-3" type="checkbox" <?php if($res['start_config3'][1] == 1) echo 'checked';?> />
                                            <span class="lbl">
                                                <i class="ace-icon fa fa-arrow-right icon-on-right switch"></i>是否开启配置3
                                            </span>
                                        </label>
                                    </div>
                                <?php }else{ ?>
                                    <div class="col-xs-10 deploy">
                                        <label class="col-xs-10">
                                        <div class="ids" id=""></div>
                                            <input name="start_config3" value="" class="ace ace-switch ace-switch-3" type="checkbox" />
                                            <span class="lbl">
                                                <i class="ace-icon fa fa-arrow-right icon-on-right switch"></i>是否开启配置3
                                            </span>
                                        </label>
                                    </div>
                                <?php } ?>
                            </div>  
                            <!-- /section:custom/checkbox.switch -->
                        </div>
                    </div>
                </div>                                   
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-md-2"></div>
            <div class="col-md-offset-2 col-md-6" style="margin:20px auto 0px">
                &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
                <label name="subtype" value="0" onclick="sub_post()" class="btn btn-info"  >
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    <?=Yii::t('app', 'Save')?>
                </label>
                &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
                <button class="btn" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    <?=Yii::t('app', 'Reset')?>
                </button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>                          
</div>

<?php $this->registerJsFile("/static/js/jquery-ui.min.js", ['depends'=>['backend\assets\AppAsset']]); ?>
<?php $this->beginBlock('cms') ?>
    jQuery(function($) {        
        $( "#tabs" ).tabs();   
    

    });

    <!-- 发送ajax请求进行修改 添加操作 -->
    function sub_post(){
        var sum=$('.deploy').size();
        <!-- 获取数据 -->
        var total=$('.config').size();
        var name=$('.SysConfigValue').attr('name');
        var value=$.trim($('.SysConfigValue').val());

        var id=$('.ids').attr('id');
        var data="";
        for(var i=0;i< total;i++){
            data+=$('.ids:eq('+i+')').attr('id')+"#"+$('.SysConfigValue:eq('+i+')').attr('name')+"#"+$('.SysConfigValue:eq('+i+')').val()+"@";
        }
        <!-- 复选框中的值 -->
        $('input[type="checkbox"]').each(function(){
           data+=$(this).siblings('.ids').attr('id')+"#"+$(this).attr('name')+"#"+$(this).is(':checked')+"@";
        });
        <!-- alert(data); -->
          $.ajax({
            url: "<?=Url::to(['conf/update'])?>",
            type:'POST',
            dataType: 'JSON',
            data : {<?=Yii::$app->request->csrfParam ?> : '<?=Yii::$app->request->getCsrfToken()?>','config':data},
            beforeSend: function(){
                spinner.spin($('body').get(0));
            },
           success:function(data){
                spinner.spin();
                if(data.data==1){
                    window.location.reload();
                }else if(data.data==2){
                    bootbox.dialog({
                        message: "<span class='bigger-110'>"+data.errmsg+"</span>",
                        buttons:            
                        {
                            "button" :
                             {
                                "label" : "确定",
                                "className" : "btn-sm btn-primary",
                                callback: function () {  
                                    window.location.reload();  
                                }
                            }
                        }
                    });
                }else{
                    bootbox.alert("操作失败!!!");
                }
           },
        });
    }

<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['cms'], \yii\web\View::POS_END); ?>
