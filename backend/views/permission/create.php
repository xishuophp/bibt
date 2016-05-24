<?php

use yii\helpers\Html;


$this->title = Yii::t('app','Create Permission');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Permission List'), 'url' => ['index']];
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
                'model' => $model,
                'groups' => $groups,
            ])  ?>
        </div>
    </div>
</div>