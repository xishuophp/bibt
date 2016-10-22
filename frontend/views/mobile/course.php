<?php

use yii\widgets\ActiveForm;
?>
<h1 class="tit">课表查询</h1>

<div class="sign">
    <?php $form = ActiveForm::begin([
            'options' => [
                'class'=>'form-horizontal',
                'role'=>'form',
                'onsubmit' => 'return check_form()',
            ],
    ]); ?>
        <div class="fill">
            <label>年级</label>
            <div class="input_box">
                <p>
                    <select onchange="getClass(this.value)" name="class_grade" id="class_grade">
                        <option value="">---请选择年级---</option>
                        <?php 
                            if($gradeArr){
                                foreach($gradeArr as $grade){
                                    echo '<option value="'.$grade['class_grade'].'">'.$grade['class_grade'].'</option>';
                                }
                            }
                        ?>
                    </select>
                </p>
                <p class="tips t14">* 请选择年级</p>
            </div>
        </div>
        <div class="fill">
            <label>班级</label>
            <div class="input_box">
                <p>
                    <select name="class_name" id="class_room">
                        
                    </select>
                </p>
                <p class="tips t15">* 请选择班级</p>
            </div>
        </div>

        <p class="btn"><button type="submit"  class="btn_sure">查&nbsp;询</button></p>

    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">

function check_form()
{
    if($("#class_grade").val() == "" ){
        $(".t14").show();
        return false;
    }else{
        $(".t14").hide();
    }

    if($("#class_room").val() == "" ){
        $(".t15").show();
        return false;
    }else{
        $(".t15").hide();
    }

    return true;
}

function getClass(grade){
    $.get('/index.php?r=mobile/class',{'grade_name':grade},function(data){
        if(data.status == 0){
            $('#class_room').html(data.content);
        }

    },'json');
}

</script>
