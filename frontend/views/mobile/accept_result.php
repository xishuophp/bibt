<?php

use yii\widgets\ActiveForm;
?>
<h1 class="tit">录取查询结果</h1>

<div class="sign">
        <?php if($model){ ?>
            <div class="fill">
                <label>姓名</label>
                <div class="input_box">
                    <p><?=$model->real_name?></p>
                </div>
            </div>
            <div class="fill">
                <label>考生号</label>
                <div class="input_box">
                    <p><?=$model->exam_number?></p>
                </div>
            </div>
            <div class="fill">
                <label>身份证号</label>
                <div class="input_box">
                    <p><?=$model->identity_card?></p>
                </div>
            </div>
            <div class="fill">
                <label>录取专业</label>
                <div class="input_box">
                    <p><?=$model->accept_major?></p>
                </div>
            </div>
        <?php }else{?>
            <div class="fill">
                <p class="text-oops">很抱歉^_^<br>暂时未查到录取信息，请稍后再试!</p>
                <a href="<?=\yii\helpers\Url::to(['mobile/index'])?>" class="btn_back">返回首页</a>
            </div>
        <?php }?>
</div>

