<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 */

$this->title = Yii::t('app','Publish Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Article List'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-content">
	<div class="page-header">
		<h1>
			<?= Html::encode($this->title) ?>
		</h1>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<?= $this->render('_form', [
				'model' => $model,'categorys'=>$categorys
			])	?>
		</div>
	</div>
</div>

