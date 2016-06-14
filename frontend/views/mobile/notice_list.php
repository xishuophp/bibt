<?php

use yii\helpers\Url;

?>
<h1 class="tit">新闻公告</h1>
<div class="article">
	<ul class="new_list" id="notice_list">
		
	</ul>
    <div id="nextPage" dis="0" class="ico_arrow" rel="1"><span></span></div>
</div>
<div id="loading" class="loading hide">
    <span class="rotate"></span>
    <h1>loading</h1>
</div>
<?php $this->beginBlock('notice_cms') ?>
	$(document).ready(function(){
		load_article();

        $("#nextPage").click(function() {
            load_article();   
        });
	});

	function load_article(next_page)
	{
        var dis = $('#nextPage').attr('dis');
        if(dis == 1){
            return false;
        }
		var url = '<?=Url::to(['mobile/get-notice-list'])?>';
        var next_page = $('#nextPage').attr('rel');
		$.ajax({
            url: url + '&page=' + next_page,
            type:'POST',
            dataType: 'JSON',
            data : {<?=Yii::$app->request->csrfParam ?> : '<?=Yii::$app->request->getCsrfToken()?>'},
            beforeSend: function(){
                $("#loading").css({
                    "top": $(window).scrollTop() + 200
                });

                $('#loading').show();

            },
            success: function(data){
                $('#notice_list').append(data.rows);
                $('#nextPage').attr('rel',data.nextPage);
                $('#loading').hide();
                if(data.nextPage == 0){
                    $('#nextPage').attr('dis', 1);
                }
            },
            error:function() {
                $('#loading').hide();
            }
        });
	}

<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['notice_cms'], \yii\web\View::POS_END); ?>