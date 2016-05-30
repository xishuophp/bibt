<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'View Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Article List'), 'url' => ['list']];
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
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Article title')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->article_title?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Article Author')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->article_author?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Title Color')?></label>
					<div class="col-sm-8 col-xs-12">
						<div style="width:30px;height:30px;background-color:<?=$model->title_color?>"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Article Alias')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->article_alias?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Article Excerpt')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control" style="height:auto;min-height:80px"><?= $model->article_excerpt?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Order No')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->order_no?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Article Status')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= Yii::$app->params['articleStatus'][$model->article_status]?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Publish Date')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->publish_date?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Article Content')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control" style="height:auto;min-height:80px"><?= $model->article_content?></div>
					</div>
				</div>
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
			                                </li>
			                            <?php }} ?>
			                            </ul>
			                        <?php } ?>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Create Time')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->create_time?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right"><?= Yii::t('app','Update Time')?></label>
					<div class="col-sm-8 col-xs-12">
						<div class="form-control"><?= $model->update_time?></div>
					</div>
				</div>    
            </div>
		</div>			
	</div><!-- /.row -->
</div>