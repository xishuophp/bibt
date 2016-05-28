<?php

use yii\helpers\Url;
?>
<h1 class="tit">院系介绍</h1>
<div class="article">
	<?php if($deptArr):?>
	<?php foreach($deptArr as $dept):?>
	<section class="lead">
		<h2><?=$dept['dept_name']?></h2>
		<p><?=$dept['dept_intro']?></p>
		<p class="tr"><a href="<?=Url::to(['mobile/department-detail','dept_id'=>$dept['dept_id']])?>" class="more">详细介绍</a></p>
	</section>
	<?php endforeach;?>
	<?php endif;?>
	<section class="lead">
		<h2>民航商务学院</h2>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;旅游管理系坚持面向旅游产业，以就业需求为导向，以服务社会和经济建设为宗旨，重点培养适应全球化经济环境，适应中国旅游、酒店、会展业、民航旅游、空 港服务管理发展需求，德才兼备的中、高级管理及高技能人才。在办学过程中紧密联系实际，开展校企合作，产学研结合，强调职业技能，强化职业素质训练，迄今 已与国内多家著名旅游、酒店、民航空港企业建立了合作关系。</p>
		<p class="tr"><a href="details.html" class="more">详细介绍</a></p>
	</section>

	<section class="lead">
		<h2>交通运输学院</h2>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;市场营销（连锁经营储备干部)、市场营销（交通驾校经营）、市场营销（创业与企业经营）、市场营销（银行理财经理）、国际经济与贸易（银行国际业务）、物流管理（微小企业信贷员）等专业及方向。</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;在教学过程中努力落实高等职业教育理念，努力探索工学结合的人才培养模式。各专业积极探索适合的课程体系建设，加强了专业设置的针对性和适应性，通过对专业教学计划调整，完善了专业和职业素质与能力，各专业在教学中开展“双证书”培养，开发了实践教学课程，将职业资格证书课程、创业指导课程入培养方案中，为使专业培养目标定位 更为准确，各专业还进行了专业讨论、系专业建设指导委员会把关、校内专家审定、校外专家论证四个环节，力争培养目标的定位方面准确。</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;为实现工学交替的人才培养模式，还进行了校内外实训基地的建设，申请了劳动部高职创业培训基地，建立了20余家校外实训基地，创立了小企业主模拟实验环 境，沙盘模拟实训室、国际贸易与物流管理综合模拟实训室。加强实训环节，通过实训基地锻炼提高学生调研能力、沟通能力、推广策划能力、分析问题以及解决问题的能力。并且利用专业课程和专业基础课程，运用小组讨论、案例分析、角色扮演、演示、撰写创业策划书以及实地调研等多样的教学方法锻炼学生的协作能力、 沟通能力、演讲能力和组织管理能力，提高通用学生能力方面。从而基本适应和体现高职教育重适度、强能力和高素质的整体规划。</p>
		<p class="tr"><a href="details.html" class="more">详细介绍</a></p>
	</section>

	<section class="lead">
		<h2>信息工程学院</h2>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;信息工程学院成立于2004年，目前下设两个专业：计算机应用技术、电子商务和市场营销三个专业。学院校企合作成果显著，至今已建立二十余家校外实习实训、校企合作基地，为学生校外实习实训及今后的求职就业工作奠定了坚实的基础。学院学生有多次选择专业方向和职业岗位的机会。信息工程学院师资力量雄厚，多年来已形成了一批学历结构合理，专业水平突出的中青年教师队伍，他们有着丰富的的教学和实践经历，深受广大学生的欢迎与爱戴。</p>
		<p class="tr"><a href="details.html" class="more">详细介绍</a></p>
	</section>

	<section class="lead">
		<h2>文化与传媒学院</h2>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;基础教育系现开设商务英语、商务英语（学前英语方向）、体育服务与管理等专业。基础教育依托“多元双优”教师团队，为企事业单位培养具有国际视野、艺术气质、创新思维、高素质、应用型高技能人才。</p>
		<p class="tr"><a href="details.html" class="more">详细介绍</a></p>
	</section>
	
</div>

<div class="yx_area">
	<p class="yx_air"><img src="images/yx_air.png"></p>
	<p class="yx_sun"><img src="images/yx_sun.png"></p>
	<p class="yx_tree01"><img src="images/yx_tree01.png"></p>
	<p class="yx_tree02"><img src="images/yx_tree02.png"></p>
	<p class="yx_tree03"><img src="images/yx_tree01.png"></p>
	<p class="yx_tree04"><img src="images/yx_tree03.png"></p>
	<p class="yx_tree05"><img src="images/yx_tree04.png"></p>
	<p class="yx_tree06"><img src="images/yx_tree03.png"></p>
	<p class="yx_ta01"><img src="images/yx_ta.png"></p>
	<p class="yx_ta02"><img src="images/yx_ta.png"></p>
	<p class="yx_ta03"><img src="images/yx_ta.png"></p>
</div>