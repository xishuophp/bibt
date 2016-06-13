<?php

use yii\helpers\Url;

?>
<h1 class="tit">新闻公告</h1>
<div class="article">
	<ul class="new_list" id="notice_list">
		
	</ul>
</div>
<div style="display:none;" id="next_page">1</div>
<?php $this->beginBlock('notice_cms') ?>
	$(document).ready(function(){
		var next_page = $('#next_page').html();
		load_article(next_page);
	});
	function load_article(next_page)
	{
		var url = '<?=Url::to(['mobile/get-notice-list'])?>';

		$.ajax({
            url: url + '&page=' + next_page,
            type:'POST',
            dataType: 'JSON',
            data : {<?=Yii::$app->request->csrfParam ?> : '<?=Yii::$app->request->getCsrfToken()?>'},
            beforeSend: function(){
                //spinner.spin($('body').get(0));
            },
            success: function(data){
                $('#notice_list').append(data.rows);
                $('#next_page').html(data.nextPage);
            },
            error:function(e, xhr, settings) {
                spinner.spin();
                if(e.status == 401){
                    bootbox.alert("对不起，您现在还没获此操作的权限", function() {
                    });
                }else{
                    bootbox.alert("登录超时,请重新<a href='"+'<?=Url::to(['site/login'])?>'+"'>登录</a>", function() {
                    });
                }
            }
        });
	}

<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['notice_cms'], \yii\web\View::POS_END); ?>