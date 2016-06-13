<?php
use common\models\Utils;

?>
<?php if($model):?>
<h1 class="tit"><?=$model['article_title']?></h1>
<div class="article">
    <?=$model['article_content']?> 
</div>
<?php endif;?>