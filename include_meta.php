<?php

$meta = seo_meta_set();


?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">

	<title><?=$meta['tag_title'];?></title>
	<meta name="description" content="<?=$meta['tag_meta_description'];?>">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php
		// インフォメーション
		if(is_post_type_archive('info')):
	?>
	<?php // ページネーションある場合 ?>
	<?php if ( get_previous_posts_link() ): ?> <link rel="prev" href="<?=previous_posts(false);?>" /><?php echo "\n"; endif; ?>
	<?php if ( get_next_posts_link() ):     ?> <link rel="next" href="<?=next_posts(false);?>" /><?php echo "\n"; endif; ?>
	<?php 
		endif;
?>

	<?php wp_head();?>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@400;500;700;800;900&family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">

	<link rel="stylesheet" media="screen and (min-width: 1000px) , print" href="<?=get_bloginfo('template_directory'); ?>/css/common.css">
	<link rel="stylesheet" media="screen and (max-width: 999px)" href="<?=get_bloginfo('template_directory'); ?>/css/common_sp.css">


	<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script> -->
	<script src="https://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('template_directory'); ?>/js/common.js"></script>

	<!--[if lt IE 9]>
	  <script src="<?=get_bloginfo('template_directory'); ?>/js/html5shiv.min.js"></script>
	<![endif]-->


	<?php if( fnc_hitBrowser() == "Safari" ){ ?>
		<script src="<?=get_bloginfo('template_directory'); ?>/js/html5shiv.min.js"></script>
	<?php } ?>

	<!-- ■ sliderメニュー -->
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/js/slidebars/slidebars.min.css">
	<script src="<?php echo get_bloginfo('template_directory'); ?>/js/slidebars/slidebars.min.js"></script>

	<script>
	jQuery(function() {

		// --------------------------
		// スマホ用スライドメニュー（toggle)
		// --------------------------
		// スライドメニュー
		var mySlidebar = new jQuery.slidebars({
			siteClose: true,
			scrollLock: true,
			disableOver: 1000, // integer or false
			hideControlClasses: true // true or false
		});
	});

	</script>

	<?php if( get_home_url() == "https://www.ycat.co.jp"): ?>

	<!-- Google tag (gtag.js) GA4-->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-VT41SL11P2"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-VT41SL11P2');
	</script>


	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56528235-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-56528235-1');
	</script>
	<?php endif; ?>

	

</head>
<body <?php body_class();?>>

