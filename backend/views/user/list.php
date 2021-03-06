<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\base\YiiForum;

$this->title = Yii::t('app', 'User List');
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
                                'action'=>Url::to(['user/list']),
                        ]); ?>
                            <label class="inline"><?php echo Yii::t('app', 'Username'); ?> : </label>
                            <div class="form-group">
                                <input type="text" name="username" class="input-sm" style="width:150px;">
                            </div>
                            <label class="inline"><?php echo Yii::t('app', 'Nickname'); ?> : </label>
                            <div class="form-group">
                                <input type="text" name="nickname" class="input-sm" style="width:150px;">
                            </div>
                            <button type="submit" class="btn btn-purple btn-sm">
                                <?=Yii::t('app', 'Search') ?>
                                <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                            </button>
                            <a style="float:right" href="<?= Url::to(['user/create']) ?>" class="btn btn-sm btn-success">
                                <i class=" ace-icon glyphicon glyphicon-plus"></i>
                                <?= Yii::t('app', 'Create User') ?>
                            </a>
                        <?php ActiveForm::end(); ?>  
                    </div>
                </div>
            </div>
            <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width:15%"><?=Yii::t('app', 'Username') ?></th>
                        <th><?=Yii::t('app', 'Nickname') ?></th>
                        <th style="width:18%"><?=Yii::t('app', 'Email') ?></th>
                        <th style="width:18%"><?=Yii::t('app', 'Create At') ?></th>
                        <th><?=Yii::t('app', 'Status') ?></th>
                        <th><?=Yii::t('app', 'Operation') ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($rows as $row):
                ?>
                    <tr>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['nickname'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= date('Y-m-d H:i:s',$row['created_at']) ?></td>
                        <td>
                            <?php
                                switch ($row['status']) {
                                    case '200':
                                        echo '<span class="label label-success arrowed">正常</span>';
                                        break;
                                    case '110':
                                        echo '<span class="label label-danger arrowed-in">禁用</span>';
                                        break;
                                    case '120':
                                        echo '<span class="label label-warning ">冻结</span>';
                                        break;
                                }
                            ?>
                        </td>
                        <td>
                            <a class="btn btn-xs btn-info"  onClick="reset_pw(<?= $row['user_id'] ?>)" href="javascript:void(0)">
                                <?=Yii::t('app', 'Reset Password') ?>
                            </a>&nbsp;
                            <a class="btn btn-xs btn-purple"  href="<?php echo Url::to(['user/update','id'=>$row['user_id']]); ?>">
                                <?=Yii::t('app', 'Update') ?>
                            </a>&nbsp;
                            <a class="btn btn-xs btn-danger"  onClick="user_del(<?= $row['user_id'] ?>)" href="javascript:void(0)" >
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
    function user_del(id){
        bootbox.confirm("您确定要删除此项吗?", function(result) {
            if(result) {
                $.ajax({
                    url: "<?=Url::to(['user/delete'])?>",
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

    function reset_pw(id){
        bootbox.confirm("密码将重置为：123456,是否继续?", function(result) {
            if(result) {
                $.ajax({
                    url: "<?=Url::to(['user/reset'])?>",
                    type:'POST',
                    dataType: 'JSON',
                    data : {<?=Yii::$app->request->csrfParam ?> : '<?=Yii::$app->request->getCsrfToken()?>',id:id},
                    beforeSend: function(){
                        spinner.spin($('body').get(0));
                    },
                    success: function(data){
                        spinner.spin();
                        bootbox.alert(data.errmsg);
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