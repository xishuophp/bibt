<?php

use yii\helpers\Url;

?>
<h1 class="tit">课表查询</h1>
<div class="sign">
    <?php if($courseArr){?>
        <?php foreach($courseArr as $course):?>
            <div class="fill">
                <label>星期：</label>
                <div class="input_box">
                    <?php
                        $arr = [
                            1 => '星期一',
                            2 => '星期二',
                            3 => '星期三',
                            4 => '星期四',
                            5 => '星期五',
                            6 => '星期六',
                            7 => '星期日',
                        ];
                        if(isset($arr[$course['week_day']])){
                            echo $arr[$course['week_day']];
                        }else{
                            echo $course['week_day'];
                        }

                    ?>
                </div>
            </div>
            <div class="fill">
                <label>时间：</label>
                <div class="input_box">
                    <?=$course['class_time']?>
                </div>
            </div>
            <div class="fill">
                <label>节次：</label>
                <div class="input_box">
                    <?=$course['section']?>
                </div>
            </div>
            <div class="fill">
                <label>课程：</label>
                <div class="input_box">
                    <?=$course['course_name']?>
                </div>
            </div>
            <div class="fill">
                <label>教师：</label>
                <div class="input_box">
                    <?=$course['teacher']?>
                </div>
            </div>
            <div class="fill">
                <label>教室：</label>
                <div class="input_box">
                    <?=$course['class_room']?>
                </div>
            </div>
            <div class="fill">
                <label>备注：</label>
                <div class="input_box">
                    <?=$course['note']?>
                </div>
            </div>
            <hr/> 
        <?php endforeach;?>
        <div class="fill">
        <a href="<?=\yii\helpers\Url::to(['mobile/index'])?>" class="btn_back">返回首页</a>
        </div>
    <?php }else{?>
        <div class="fill">
            <p class="text-oops">很抱歉^_^<br>暂时未查到课表信息，请稍后再试!</p>
            <a href="<?=\yii\helpers\Url::to(['mobile/index'])?>" class="btn_back">返回首页</a>
        </div>
    <?php }?>
 
</div>
<div id="loading" class="loading hide">
    <span class="rotate"></span>
    <h1>loading</h1>
</div>