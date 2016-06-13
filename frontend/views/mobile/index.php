<?php

use yii\helpers\Url;

?>

<div class="gamepic">
	<div class="slide-1">
		<nova-carousel default-style autoplay="true" autoplay-interval-ms="2500"  duration-ms="500" class="carousel-1">
			<?php if($bannerIndex == 1){?>
			<?php foreach($bannerArr as $banner):?>
				<a href="<?=Url::to(['mobile/detail','aid'=>$banner['article_id']])?>" target="_blank"><img src="<?=$banner['article_logo']?>" alt="some pic" draggable="false"></a>
			<?php endforeach;?>	
			<?php }else{?>
			<?php foreach($bannerArr as $banner):?>
				<a href="javascript:void(0)"><img src="<?=$banner?>" alt="some pic" draggable="false"></a>
			<?php endforeach;?>
			<?php }?>
			
		</nova-carousel>
	</div>
</div>
<!-- banner轮播 end -->

<div class="part01">
	<div class="line"><img src="/static/images/line.png"></div>
	<div class="thumb t01">
		<a href="<?=Url::to(['mobile/notice'])?>">
			<div class="box"><img src="/static/images/pic07.jpg"></div>
			<p>新闻公告</p>
		</a>
	</div>

	<div class="thumb t02">
		<a href="<?=Url::to(['mobile/intro'])?>">
			<div class="box"><img src="/static/images/pic02.jpg"></div>
			<p>学院概况</p>
		</a>
	</div>

	<div class="thumb t03">
		<a href="<?=Url::to(['mobile/campus'])?>">
			<div class="box"><img src="/static/images/pic03.jpg"></div>
			<p>校园风光</p>
		</a>
	</div>

	<div class="thumb t04">
		<a href="<?=Url::to(['mobile/department-introduction'])?>">
			<div class="box"><img src="/static/images/pic04.jpg"></div>
			<p>院系介绍</p>
		</a>
	</div>

	<div class="thumb t05">
		<a href="<?=Url::to(['mobile/teacher-team'])?>">
			<div class="box"><img src="/static/images/pic05.jpg"></div>
			<p>师资队伍</p>
		</a>
	</div>

	<div class="thumb t06">
		<a href="<?=Url::to(['mobile/online-application'])?>">
			<div class="box"><img src="/static/images/pic06.jpg"></div>
			<p>网上报名</p>
		</a>
	</div>
	<div class="thumb t07">
		<a href="<?=Url::to(['mobile/accept'])?>">
			<div class="box"><img src="/static/images/pic06.jpg"></div>
			<p>录取查询</p>
		</a>
	</div>
</div>