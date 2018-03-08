<?php

use yii\widgets\ActiveForm;
?>
<h1 class="tit">网上报名</h1>

<div class="sign">
	<?php $form = ActiveForm::begin([
            'options' => [
                'class'=>'form-horizontal',
                'role'=>'form',
                'onsubmit' => 'return check_form()',
            ],
    ]); ?>
		<div class="fill">
			<label>姓名</label>
			<div class="input_box">
				<p><input type="text" id="real_name" name="ApplyOnline[real_name]" value="" class="input_skin"></p>
				<p class="tips t10">* 请输入姓名</p>
			</div>
		</div>
		<div class="fill">
			<label>考生号</label>
			<div class="input_box">
				<p><input type="text" id="exam_number" name="ApplyOnline[exam_number]" value="" class="input_skin"></p>
				<p class="tips t11">* 请输入考生号</p>
			</div>
		</div>
		<div class="fill">
			<label>身份证号</label>
			<div class="input_box">
				<p><input type="text" id="identity_card" name="ApplyOnline[identity_card]" value="" class="input_skin"></p>
				<p class="tips t12">* 请输入身份证号</p>
			</div>
		</div>
		<div class="fill">
			<label>联系电话</label>
			<div class="input_box">
				<p><input type="text" id="phone" name="ApplyOnline[phone]" value="" class="input_skin"></p>
				<p class="tips t13">* 请输入联系电话</p>
			</div>
		</div>
		<div class="fill">
			<label>性别</label>
			<div class="input_box">
				<p>
					<select name="ApplyOnline[sex]" id="sex">
                        <option value="0">---请选择性别---</option>
                        <option value="1">男</option>
                        <option value="2">女</option>
                	</select>
				</p>
				<p class="tips t14">* 请选择性别</p>
			</div>
		</div>

		<div class="fill">
			<label>拟报专业</label>
			<div class="input_box">
				<p>
                	<select name="ApplyOnline[apply_major]" id="major">
                        <option value="">---请选择报考专业---</option>
                        <option value="空中乘务(空乘、地勤)">空中乘务(空乘、地勤)</option>
                        <option value="学前教育">学前教育</option>
                        <option value="会计(芸豆会计订单班)">会计(芸豆会计订单班)</option>
                        <option value="金融管理">金融管理</option>
                        <option value="计算机应用技术(Java大数据)">计算机应用技术(Java大数据)</option>
                        <option value="软件技术(VR虚拟现实)">软件技术(VR虚拟现实)</option>
                        <option value="电子商务(互联网金融-小马金融订单班)">电子商务(互联网金融-小马金融订单班)</option>
                        <option value="老年服务与管理(适老环境评估与设计)">老年服务与管理(适老环境评估与设计)</option>
                        <option value="老年服务与管理(高端社区养老机构运营管理)">老年服务与管理(高端社区养老机构运营管理)</option>
                        <option value="老年服务与管理(老年康复)">老年服务与管理(老年康复)</option>
                        <option value="酒店管理(订单班)">酒店管理(订单班)</option>
                        <option value="休闲体育(户外运动)">休闲体育(户外运动)</option>
                	</select>
				</p>
				<p class="tips t15">* 请选择报考专业</p>
			</div>
		</div>
		<div class="fill">
			<label>省份</label>
			<div class="input_box">
				<p>
					<select name="ApplyOnline[province]" id="province">
                        <option value="北京">北京</option>
                        <option value="天津">天津</option>
                        <option value="上海">上海</option>
                        <option value="重庆">重庆</option>
                        <option value="河北">河北</option>
                        <option value="山西">山西</option>
                        <option value="辽宁">辽宁</option>
                        <option value="吉林">吉林</option>
                        <option value="黑龙江">黑龙江</option>
                        <option value="江苏">江苏</option>
                        <option value="浙江">浙江</option>
                        <option value="安徽">安徽</option>
                        <option value="福建">福建</option>
                        <option value="江西">江西</option>
                        <option value="山东">山东</option>
                        <option value="河南">河南</option>
                        <option value="湖北">湖北</option>
                        <option value="湖南">湖南</option>
                        <option value="广东">广东</option>
                        <option value="海南">海南</option>
                        <option value="四川">四川</option>
                        <option value="贵州">贵州</option>
                        <option value="云南">云南</option>
                        <option value="陕西">陕西</option>
                        <option value="甘肃">甘肃</option>
                        <option value="青海">青海</option>
                        <option value="内蒙古">内蒙古</option>
                        <option value="广西">广西</option>
                        <option value="西藏">西藏</option>
                        <option value="宁夏">宁夏</option>
                        <option value="新疆">新疆</option>
                	</select>
				</p>
				<p class="tips t16">* 请选择省份</p>
			</div>
		</div>
		<div class="fill">
			<label>毕业学校</label>
			<div class="input_box">
				<p><input type="text" id="graduate_school" name="ApplyOnline[graduate_school]" value="" class="input_skin"></p>
				<p class="tips t17">* 请输入毕业学校</p>
			</div>
		</div>

		<div class="fill">
			<label>留言</label>
			<div class="input_box">
				<p>
					<textarea name="ApplyOnline[notes]"></textarea>
				</p>
			</div>
		</div>

		<p class="btn"><button type="submit"  class="btn_sure">确&nbsp;认</button></p>

	<?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">

function check_form()
{
	if($("#real_name").val() == ''){
			$(".t10").show();
			return false;
		}else{
			$(".t10").hide();
		}
		if($("#exam_number").val() == ''){
			$(".t11").show();
			return false;
		}else{
			$(".t11").hide();
		}
		if($("#identity_card").val() == ''){
			$(".t12").show();
			return false;
		}else{
			$(".t12").hide();
		}
		if($("#phone").val() == ''){
			$(".t13").show();
			return false;
		}else{
			$(".t13").hide();
		}

		if($("#sex").val() == "0" ){
			$(".t14").show();
			return false;
		}else{
			$(".t14").hide();
		}
		if($("#major").val() == "" ){
			$(".t15").show();
			return false;
		}else{
			$(".t15").hide();
		}

		if($("#province").val() == "" ){
			$(".t16").show();
			return false;
		}else{
			$(".t16").hide();
		}

		if($("#graduate_school").val() == "" ){
			$(".t17").show();
			return false;
		}else{
			$(".t17").hide();
		}

		return true;
}

</script>
