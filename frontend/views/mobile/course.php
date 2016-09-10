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
            <label>班级</label>
            <div class="input_box">
                <p>
                    <select name="class_name" id="class_room">
                        <option value="">---请选择班级---</option>
                        <?php 
                            if($classArr){
                                foreach($classArr as $class){
                                    echo '<option value="'.$class['class_name'].'">'.$class['class_name'].'</option>';
                                }
                            }
                        ?>
                    </select>
                </p>
                <p class="tips t14">* 请选择班级</p>
            </div>
        </div>

        <p class="btn"><button type="submit"  class="btn_sure">查&nbsp;询</button></p>

    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">

function check_form()
{
    if($("#class_room").val() == "" ){
        $(".t14").show();
        return false;
    }else{
        $(".t14").hide();
    }

    return true;
}

</script>
