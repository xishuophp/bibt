<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\base\YiiForum;

$this->title = Yii::t('app', 'Nav List');
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
                                'action'=>Url::to(['nav/list']),
                        ]); ?>
                            <label class="inline"><?php echo Yii::t('app', 'Nav Type'); ?> : </label>
                            <div class="form-group">
                                <input type="text" name="Nav_type" class="input-sm" style="width:150px;">
                            </div>
                            <label class="inline"><?php echo Yii::t('app', 'Nav Name'); ?> : </label>
                            <div class="form-group">
                                <input type="text" name="nav_name" class="input-sm" style="width:150px;">
                            </div>
                            <button type="submit" class="btn btn-purple btn-sm">
                                <?=Yii::t('app', 'Search') ?>
                                <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                            </button>
                            <a style="float:right" href="<?= Url::to(['nav/create']) ?>" class="btn btn-sm btn-success">
                                <i class=" ace-icon glyphicon glyphicon-plus"></i>
                                <?= Yii::t('app', 'Create Nav') ?>
                            </a>
                        <?php ActiveForm::end(); ?>  
                    </div>
                </div>
            </div>
            <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th ><?=Yii::t('app', 'ID') ?></th>
                        <th ><?=Yii::t('app', 'Nav Name') ?></th>
                        <th ><?=Yii::t('app', 'Nav Type') ?></th>
                        <th ><?=Yii::t('app', 'Nav Link') ?></th>
                        <th ><?=Yii::t('app', 'Nav Logo') ?></th>
                        <th><?=Yii::t('app', 'Operation') ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($rows as $row):
                ?>
                    <tr>
                        <td><?= $row['nav_id'] ?></td>
                        <td><?= $row['nav_name'] ?></td>
                        <td><?= Yii::$app->params['navType'][$row['nav_type']] ?></td>
                        <td><?= $row['nav_link'] ?></td>
                        <td><?= $row['nav_logo'] ?></td>
                        <td>
                            <a class="btn btn-xs btn-purple"  href="<?php echo Url::to(['nav/update','id'=>$row['nav_id']]); ?>">
                                <?=Yii::t('app', 'Update') ?>
                            </a>&nbsp;
                            <a class="btn btn-xs btn-danger"  onClick="dept_del(<?= $row['nav_id'] ?>)" href="javascript:void(0)" >
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
    function dept_del(id){
        bootbox.confirm("您确定要删除此项吗?", function(result) {
            if(result) {
                $.ajax({
                    url: "<?=Url::to(['nav/delete'])?>",
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