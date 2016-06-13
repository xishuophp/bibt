<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta content="telephone=no, email=no" name="format-detection">
<title>错误信息</title>
<link rel="stylesheet" href="/static/css/common.css">
<link rel="stylesheet" href="/static/css/index.css">
</head>

<body>
<body class="error_404">
	<div class="container">
		<!--<h1 class="text-jumbo"><img src="/static/images/404.png"></h1>-->
		<p class="text-oops">很抱歉^_^<br><?=$errorMsg?></p>
		<a href="<?=\yii\helpers\Url::to(['mobile/index'])?>" class="btn_back">返回首页</a>
	</div>

<script src="/static/js/zepto.min.js"></script>
<script src="/static/js/scale.js"></script>
<script src="/static/js/touch.js"></script>
</body>
</html>