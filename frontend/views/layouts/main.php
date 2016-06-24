<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta content="telephone=no, email=no" name="format-detection">
<title>北京经济技术职业学院</title>
<link rel="stylesheet" href="/static/css/common.css">
<link rel="stylesheet" href="/static/css/index.css">
<link rel="stylesheet" href="/static/css/animate.css"/>
</head>

<body class="bg">
<?php $this->beginBody() ?>
<div class="container">
    <?=$content?>

    <footer>
        <p>© 北京经济技术职业学院</p>
        <span style="display:none;">
        <script src="http://s4.cnzz.com/z_stat.php?id=1259670038&web_id=1259670038" language="JavaScript"></script>
        </span>
    </footer>

</div>
<script src="/static/js/zepto.min.js"></script>
<script src="/static/js/scale.js"></script>
<script src="/static/js/touch.js"></script>
<script src="/static/js/nova_polyfills.1.0.1.js"></script>
<script src="/static/js/nova.1.0.1.js"></script>
<script src="/static/js/nova-tab.1.0.5.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>