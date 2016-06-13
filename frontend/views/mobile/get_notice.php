<?php
use yii\helpers\Url;
use backend\models\YiiForum;

?>
<?php
    if($rows):
        foreach($rows as $row):
?>
<li><a href="<?=Url::to(['mobile/article-detail','aid'=>$row['article_id']])?>">· <?php echo \common\models\Utils::cutstr($row['article_title'], 50)?></a><span><?=date('Y-m-d', strtotime($row['create_time']))?></span></li>

<?php
        endforeach;
    endif;
?>