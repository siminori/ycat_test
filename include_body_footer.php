<?php //======================== ?>
<?php get_template_part('include_modal');?>
<?php //======================== ?>

<script>
/* 使用例------------- */
jQuery(function () {
    pageLink(50);
});
</script>

<!-- fancybox -->
<link rel="stylesheet" href="<?=get_bloginfo('template_directory'); ?>/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?=get_bloginfo('template_directory'); ?>/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script>
jQuery(function() {
	// --------------------------
	// fancybox
	// --------------------------
	jQuery('.fancybox').fancybox({
		'padding':20
		, 'margin':30
		, 'width':800
	});

	// 動的に追加された要素にfancyboxを適用
	jQuery('.fancybox').live('click', function() {
		jQuery.fancybox(
			this, 
			{
				'padding':20
				, 'margin':30
				, 'width':800
			}
		);
		$(".chatBotBox__close").trigger("click");
	});

	
});
</script>




<?php if( is_front_page() || is_singular('route') ): ?>
<script>
//タブ表示切替機能
jQuery(function($){
	$('.tab').click(function(){
		$('.is-active').removeClass('is-active');
		$(this).addClass('is-active');
		$('.is-show').removeClass('is-show');
		// クリックしたタブからインデックス番号を取得
		const index = $(this).index();
		// クリックしたタブと同じインデックス番号をもつコンテンツを表
		$('.panel').eq(index).addClass('is-show');
	});
});
</script>
<?php endif; ?>




<?php
// ****************************************
// 時刻表制御用　Javascript読込
// ****************************************

// 時刻表投稿の場合
if( is_singular('timetable') || is_singular('route_busstopfile') ):
	get_template_part('include_body_footer_timetableJS');

// バス路線案内投稿の場合
elseif( is_singular('route') ):
	// 子要素の場合
	if( $post->post_parent > 0){
		get_template_part('include_body_footer_timetableJS');
	}
endif ;
?>



<script>
// ****************************************
// 翻訳ページ用のJS処理
// ****************************************

//console.log(location.host);
jQuery(function() {
	if( location.host == "translation2.j-server.com"){


		// bodyタグに専用のクラスを設定する
		jQuery("body").addClass("translationPage");

		// bodyタグに専用のクラスを設定する
		jQuery(".translationClass").css('display','none');

		// 検索、言語選択のモーダルウィンドウ「href」が勝手に書き換えられるので再設定
		jQuery('#animatedModal01-Btn').attr('href', '#animatedModal01');
		jQuery('#animatedModal02-Btn').attr('href', '#animatedModal02');

		// 言語選択の「日本語」のリンク先が崩れるのでJSにて再設定
		jQuery('.langJapanLnk').attr('href', '<?=get_bloginfo("url"); ?>/');



	}
});

</script>
<style>
body.translationPage{
border-bottom:solid 3px #ff0;
}
</style>

<?php wp_footer(); ?>

</body>
</html>
