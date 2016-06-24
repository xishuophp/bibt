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
        <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1259670038'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1259670038' type='text/javascript'%3E%3C/script%3E"));</script>
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