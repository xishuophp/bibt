<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\base\YiiForum;
use backend\models\ServiceDepartment;

$this->title = Yii::t('app', 'Course List');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            <?= Html::encode($this->title) ?>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
    	<div id="left_list" class="col-xs-12">
            <div class="widget-box">
                <div class="widget-header widget-header-small">
                    <h5 class="widget-title lighter"><?=Yii::t('app', 'Search Form') ?></h5>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <?php $form = ActiveForm::begin([
                                'options' => [
                                    'class'=>'form-inline',
                                    'role'=>'form',
                                ],
                                'action'=>Url::to(['course/list']),
                        ]); ?>
                            <label class="inline"><?php echo Yii::t('app', 'Class Name'); ?> : </label>
                            <div class="form-group">
                                <input type="text" name="class_name" class="input-sm" style="width:150px;">
                            </div>
                            <button type="submit" class="btn btn-purple btn-sm">
                                <?=Yii::t('app', 'Search') ?>
                                <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                            </button>
                            <a style="margin-left:30px;" class="btn btn-sm btn-info" href="#modal-form1" data-toggle="modal" >
                                <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i><?=Yii::t('app', 'Import') ?>
                            </a>
                            <a style="margin-left:30px;" class="btn btn-sm btn-danger" onClick="del_all()" href="javascript:void(0)"  >
                                <?=Yii::t('app', 'Clear') ?>
                            </a>
                            <a style="float:right" href="<?= Url::to(['course/create']) ?>" class="btn btn-sm btn-success">
                                <i class=" ace-icon glyphicon glyphicon-plus"></i>
                                <?= Yii::t('app', 'Create Course') ?>
                            </a>
                        <?php ActiveForm::end(); ?>  
                    </div>
                </div>
            </div>
            <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th ><?=Yii::t('app', 'ID') ?></th>
                        <th ><?=Yii::t('app', 'Course Name') ?></th>
                        <th ><?=Yii::t('app', 'Class Room') ?></th>
                        <th ><?=Yii::t('app', 'Teacher') ?></th>
                        <th ><?=Yii::t('app', 'Section') ?></th>
                        <th ><?=Yii::t('app', 'Class Time') ?></th>
                        <th ><?=Yii::t('app', 'Class Name') ?></th>
                        <th ><?=Yii::t('app', 'Class Grade') ?></th>
                        <th ><?=Yii::t('app', 'Academic Year') ?></th>
                        <th ><?=Yii::t('app', 'Week Day') ?></th>
                        <th ><?=Yii::t('app', 'Note') ?></th>
                        <th><?=Yii::t('app', 'Operation') ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $weekDayArr = Yii::$app->params['weekDay'];
                    $academicYearArr = Yii::$app->params['academicYear'];
                    foreach ($rows as $row):
                ?>
                    <tr>
                        <td><?= $row['course_id'] ?></td>
                        <td><?= $row['course_name'] ?></td>
                        <td><?= $row['class_room'] ?></td>
                        <td><?= $row['teacher'] ?></td>
                        <td><?= $row['section'] ?></td>
                        <td><?= $row['class_time'] ?></td>
                        <td><?= $row['class_name'] ?></td>
                        <td><?= $row['class_grade'] ?></td>
                        <td><?= $row['academic_year'] ?></td>
                        <td><?= $row['week_day'] ?></td>
                        <td><?= $row['note'] ?></td>
                        <td>
                            <a class="btn btn-xs btn-purple"  href="<?php echo Url::to(['course/update','id'=>$row['course_id']]); ?>">
                                <?=Yii::t('app', 'Update') ?>
                            </a>&nbsp;
                            <a class="btn btn-xs btn-danger"  onClick="course_del(<?= $row['course_id'] ?>)" href="javascript:void(0)" >
                                <?=Yii::t('app', 'Delete') ?>
                            </a>&nbsp;
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="modal-footer no-margin-top">
                <div class="col-xs-6">
                    <div class="dataTables_info pull-left"><?= Yii::t('app', 'The total number of records') . ' : ' . $pages->totalCount ?></div>
                </div>
                <?=
                    LinkPager::widget([
                        'pagination' => $pages,
                        'maxButtonCount' => 8,
                        'options' => [
                            'class' => 'pagination pull-right no-margin',
                        ],
                    ]);
                ?>
            </div>
        <div>
    </div><!-- /.span -->							
</div></div>
<!-- 导入课程信息 -->
<div id="modal-form1" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="width:700px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">&nbsp;&nbsp;&nbsp;&nbsp;<?=Yii::t('app', 'Course Import') ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-10">
                        <div class="form-group" id="form-code" style="padding-left:10px;margin-left:10px;">
                            <input id='course' class="input-large" name="course" type="file" multiple="multiple" />
                        </div>
                    </div>
                </div>
                <div style="color:red;margin-top: 30px">数据格式必须是后缀为.xlsx的文件,表格的字段顺序请与列表的显示顺序保持一致</div>
            </div>
            <div class="modal-footer" id="game_category">
                <button class="btn btn-sm" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    <?=Yii::t('app', 'Cancel') ?>
                </button>
                
                <button class="btn btn-sm btn-primary" onClick="upload()">
                        <?=Yii::t('app', 'Import') ?>
                </button>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock('cms') ?>
    function course_del(id){
        bootbox.confirm("您确定要删除此项吗?", function(result) {
            if(result) {
                $.ajax({
                    url: "<?=Url::to(['course/delete'])?>",
                    type:'POST',
                    dataType: 'JSON',
                    data : {<?=Yii::$app->request->csrfParam ?> : '<?=Yii::$app->request->getCsrfToken()?>',id:id},
                    beforeSend: function(){
                        spinner.spin($('body').get(0));
                    },
                    success: function(data){
                        spinner.spin();
                        if(data.errno != 0){
                            bootbox.alert(data.errmsg);
                        }else{
                            // location.href = reload();
                            location.reload();
                        }
                    },
                    error:function(e, xhr, settings) {
                        spinner.spin();
                        if(e.status == 401){
                            bootbox.alert("对不起，您现在还没获此操作的权限", function() {
                            });
                        }else{
                            bootbox.alert("登录超时,请重新<a href='"+'<?=Url::to(['site/login'])?>'+"'>登录</a>", function() {
                            });
                        }
                    }
                });
            }
        });
    }
    function del_all(){
        bootbox.confirm("您确定要清空课程信息吗?", function(result) {
            if(result) {
                $.ajax({
                    url: "<?=Url::to(['course/delete-all'])?>",
                    type:'POST',
                    dataType: 'JSON',
                    data : {<?=Yii::$app->request->csrfParam ?> : '<?=Yii::$app->request->getCsrfToken()?>'},
                    beforeSend: function(){
                        spinner.spin($('body').get(0));
                    },
                    success: function(data){
                        spinner.spin();
                        if(data.errno != 0){
                            bootbox.alert(data.errmsg);
                        }else{
                            // location.href = reload();
                            location.reload();
                        }
                    },
                    error:function(e, xhr, settings) {
                        spinner.spin();
                        if(e.status == 401){
                            bootbox.alert("对不起，您现在还没获此操作的权限", function() {
                            });
                        }else{
                            bootbox.alert("登录超时,请重新<a href='"+'<?=Url::to(['site/login'])?>'+"'>登录</a>", function() {
                            });
                        }
                    }
                });
            }
        });
    }
    function upload(){
        var fileObj=$('input[name="course"]');
        var res=0;
        var fileName='';
        if(typeof(fileObj[0].files[0])=='undefined'){
            return false;
        }
        var file=fileObj[0].files[0];
        var form=new FormData();
        form.append('course',file);
        form.append("<?=Yii::$app->request->csrfParam?>","<?=Yii::$app->request->getCsrfToken()?>");
        $.ajax({
            url:"<?= Url::to(['course/import'])?>",
            type:'POST',
            data:form,
            async:false,
            processData:false,
            contentType:false,
            dataType: 'JSON',
            beforeSend: function(){
                spinner.spin($('body').get(0));
            },
            success:function(data){
                spinner.spin();
                if(data.errno != 0){
                    bootbox.alert(data.errmsg);
                }else{
                    $('#modal-form1').modal('hide');
                    window.location.reload();
                }

            },
             error:function(e, xhr, settings) {
                spinner.spin();
                if(e.status == 401){
                    bootbox.alert("对不起，您现在还没获此操作的权限", function() {
                    });
                }else{
                    bootbox.alert("登录超时,请重新<a href='"+'<?=Url::to(['site/login'])?>'+"'>登录</a>", function() {
                    });
                }
            }
        });
    }
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['cms'], \yii\web\View::POS_END); ?>