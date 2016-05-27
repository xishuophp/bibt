<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\base\YiiForum;

$this->title = Yii::t('app', 'Staff List');
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
                                'action'=>Url::to(['staff/list']),
                        ]); ?>
                            
                            <label class="inline"><?php echo Yii::t('app', 'Real Name'); ?> : </label>
                            <div class="form-group">
                                <input type="text" name="real_name" class="input-sm" style="width:150px;">
                            </div>
                            <label class="inline"><?php echo Yii::t('app', 'Staff Type'); ?> : </label>
                            <div style="width:150px;" class="inline">
                                <?=Html::dropDownList('staff_type',null,Yii::$app->params['staffType'],['class'=>'form-control','style'=>'width:120px']) ?>
                            </div>
                            <button type="submit" class="btn btn-purple btn-sm">
                                <?=Yii::t('app', 'Search') ?>
                                <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                            </button>
                            <a style="float:right" href="<?= Url::to(['staff/create']) ?>" class="btn btn-sm btn-success">
                                <i class=" ace-icon glyphicon glyphicon-plus"></i>
                                <?= Yii::t('app', 'Create Staff') ?>
                            </a>
                        <?php ActiveForm::end(); ?>  
                    </div>
                </div>
            </div>
            <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th ><?=Yii::t('app', 'ID') ?></th>
                        <th ><?=Yii::t('app', 'Real Name') ?></th>
                        <th ><?=Yii::t('app', 'Staff Type') ?></th>
                        <th ><?=Yii::t('app', 'Dept ID') ?></th>
                        <th ><?=Yii::t('app', 'Staff Title') ?></th>
                        <th><?=Yii::t('app', 'Operation') ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($rows as $row):
                ?>
                    <tr>
                        <td><?= $row['staff_id'] ?></td>
                        <td><?= $row['real_name'] ?></td>
                        <td><?= Yii::$app->params['staffType'][$row['staff_type']] ?></td>
                        <td><?= $row['dept_id'] ?></td>
                        <td><?= $row['staff_title'] ?></td>
                        <td>
                            <a class="btn btn-xs btn-info"  href="<?php echo Url::to(['staff/view','id'=>$row['staff_id']]); ?>">
                                <?=Yii::t('app', 'View') ?>
                            </a>&nbsp;
                            <a class="btn btn-xs btn-purple"  href="<?php echo Url::to(['staff/update','id'=>$row['staff_id']]); ?>">
                                <?=Yii::t('app', 'Update') ?>
                            </a>&nbsp;
                            <a class="btn btn-xs btn-danger"  onClick="staff_del(<?= $row['staff_id'] ?>)" href="javascript:void(0)" >
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
<?php $this->beginBlock('cms') ?>
    function staff_del(id){
        bootbox.confirm("您确定要删除此项吗?", function(result) {
            if(result) {
                $.ajax({
                    url: "<?=Url::to(['staff/delete'])?>",
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
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['cms'], \yii\web\View::POS_END); ?>