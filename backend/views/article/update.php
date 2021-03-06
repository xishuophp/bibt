<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 */

$this->title = Yii::t('app', 'Update Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Article List'), 'url' => ['list']];
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
			<?= $this->render('_form', [
				'model' => $model,'categorys'=>$categorys
			])	?>
		</div>
	</div>
</div>
