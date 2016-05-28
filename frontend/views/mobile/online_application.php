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
				<p><input type="text" id="exam_number" name="ApplyOnline['exam_number']" value="" class="input_skin"></p>
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
				<p><input type="text" id="phone" name="ApllyOnline[phone]" value="" class="input_skin"></p>
				<p class="tips t13">* 请输入联系电话</p>
			</div>
		</div>
		<div class="fill">
			<label>性别</label>
			<div class="input_box">
				<p>
					<select name="type" id="sex">
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
                        <option value="会计">会计</option>
                        <option value="商务英语(学前英语)">商务英语(学前英语)</option>
                        <option value="广告设计与制作专业(UI/UE设计)">广告设计与制作专业(UI/UE设计)</option>
                        <option value="体育运营与管理(休闲体育项目)">体育运营与管理(休闲体育项目)</option>
                        <option value="空中乘务">空中乘务</option>
                        <option value="物流管理(航空物流)">物流管理(航空物流)</option>
                        <option value="酒店管理(首都大酒店订单班)">酒店管理(首都大酒店订单班)</option>
                        <option value="计算机应用技术(Java电商软件开发工程师)">计算机应用技术(Java电商软件开发工程师)</option>
                        <option value="计算机应用技术(移动互联网开发工程师)">计算机应用技术(移动互联网开发工程师)</option>
                        <option value="计算机应用技术(PHP软件开发工程师)">计算机应用技术(PHP软件开发工程师)</option>
                        <option value="计算机应用技术(手机游戏开发工程师)">计算机应用技术(手机游戏开发工程师)</option>
                        <option value="计算机应用技术(数据中心IT工程师)">计算机应用技术(数据中心IT工程师)</option>
                        <option value="电子商务">电子商务</option>
                        <option value="市场营销">市场营销</option>
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
