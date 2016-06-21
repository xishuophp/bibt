<?php
use common\models\Utils;

?>
<?php if($model):?>
<h1 class="tit"><?=$model['article_title']?></h1>
<div class="article">
    <?=$model['article_content']?>

    <div class="qrcode">
        <h2 class="logo"><img src="/static/images/logo1.png"></h2>
        <p class="t_name">北京经济技术职业学院</p>
        <p>招生热线：010-61595668、010-61595685</p>
        <p class="q_name">微信号：bibtwx</p>
        <p class="p_qrcode"><img src="/static/images/qrcode.jpg"></p>
    </div> 
</div>
<?php endif;?>