<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'View Dept');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dept List'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
	<div class="page-header">
        <h1>
            <?= Html::encode($this->title) ?>
        </h1>
    </div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
		    <div class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Dept Name')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->dept_name?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Dept Type')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->dept_type?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Parent ID')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->parent_id?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Dept Phone')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->dept_phone?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Dept Leader')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->dept_leader?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Dept Intro')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control" style="height:auto;min-height:80px"><?= $model->dept_intro?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Dept Details')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control" style="height:auto;min-height:80px"><?= $model->dept_details?></div>
					</div>
				</div>   
            </div>
		</div>			
	</div><!-- /.row -->
</div>