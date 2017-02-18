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
                        <option value="金融管理">金融管理</option>
                        <option value="会计(芸豆会计订单班)">会计(芸豆会计订单班)</option>
                        <option value="幼儿发展与健康管理">幼儿发展与健康管理</option>
                        <option value="空中乘务(空乘、地勤、民航空中安全保卫)">空中乘务(空乘、地勤、民航空中安全保卫)</option>
                        <option value="酒店管理(首都大酒店订单班)">酒店管理(首都大酒店订单班)</option>
                        <option value="广告设计与制作">广告设计与制作</option>
                        <option value="体育运营与管理(休闲体育)">体育运营与管理(休闲体育)</option>
                        <option value="软件技术(多媒体交互设计工程师、java电商软件开发工程师)">软件技术(多媒体交互设计工程师、java电商软件开发工程师)</option>
                        <option value="电子商务(跨境电商运营、数字化新媒体运营)">电子商务(跨境电商运营、数字化新媒体运营)</option>

                	</select>
				</p>
				<p class="tips t15">* 请选择报考专业</p>
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
			$(".t14").show();
			return false;
		}else{
			$(".t14").hide();
		}

		return true;
}

</script>
