<?php

use yii\helpers\Url;

?>
<h1 class="tit">师资队伍</h1>
<div class="article">
	<?php if($teacherArr):?>
	<?php foreach($teacherArr as $teacher):?>
	<section class="lead">
		<h2><?=$teacher['real_name']?></h2>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;<?=$teacher['intro']?></p>
		<p class="tr"><a href="<?=Url::to(['mobile/teacher-detail','tid'=>$teacher['staff_id']])?>" class="more">详细介绍</a></p>
	</section>
	<?php endforeach;?>
	<?php endif;?>
</div>

<div class="gk_area">
	<p class="sz_02"><img src="images/sz02.png"></p>
	<p class="sz_03"><img src="images/sz03.png"></p>
	<p class="sz_04"><img src="images/sz04.png"></p>
	<p class="sz_06"><img src="images/sz06.png"></p>
	<p class="sz_05"><img src="images/sz05.png"></p>
	<p class="sz_01"><img src="images/sz01.png"></p>
</div>