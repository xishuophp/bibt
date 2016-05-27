<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'View Staff');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Staff List'), 'url' => ['list']];
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
			        <label class="col-sm-2 control-label no-padding-right"><?=Yii::t('app','Staff Logo')?></label>
			        <div class="col-sm-4 col-xs-12">
			            <?php 
			            $image = json_decode($model->logo,true);
			            if(!empty($image)){ ?>
			                <image id="logo" height="50" src=<?= $image[0]['fileUrl'] ?>>
			            <?php } ?>
			        </div>
		    	</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Dept ID')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->dept_id?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Staff Type')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= Yii::$app->params['staffType'][$model->staff_type]?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Staff Title')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->staff_title?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Order No')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->order_no?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Is Index')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->is_index?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Intro')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control" style="height:auto;min-height:80px"><?= $model->intro?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Details')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control" style="height:auto;min-height:80px"><?= $model->details?></div>
					</div>
				</div>   
            </div>
		</div>			
	</div><!-- /.row -->
</div>