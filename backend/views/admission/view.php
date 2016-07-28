<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'View Admission');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admission List'), 'url' => ['list']];
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
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Other Number')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->other_number?></div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Real Name')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->real_name?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Sex')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= Yii::$app->params['sex'][$model->sex]?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Exam Number')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->exam_number?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Apply Major')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->apply_major?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Phone')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->phone?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Province')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->province?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','City')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->city?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Graduate School')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->graduate_school?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Apply Time')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->create_time?></div>
					</div>
				</div>
            </div>
		</div>			
	</div><!-- /.row -->
</div>