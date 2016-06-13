<?php

use yii\widgets\ActiveForm;
?>
<h1 class="tit">录取查询</h1>

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
                <p><input type="text" id="real_name" name="AcceptForm[real_name]" value="" class="input_skin"></p>
                <p class="tips t10">* 请输入姓名</p>
            </div>
        </div>
        <div class="fill">
            <label>考生号</label>
            <div class="input_box">
                <p><input type="text" id="exam_number" name="AcceptForm[exam_number]" value="" class="input_skin"></p>
                <p class="tips t11">* 请输入考生号</p>
            </div>
        </div>
        <div class="fill">
            <label>身份证号</label>
            <div class="input_box">
                <p><input type="text" id="identity_card" name="AcceptForm[identity_card]" value="" class="input_skin"></p>
                <p class="tips t12">* 请输入身份证号</p>
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

        return true;
}

</script>
