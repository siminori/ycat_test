<?php

global $meta;

// 自動生成されるタグを制御する方法(br削除等)
remove_filter ('the_content', 'wpautop');

?>
<?php //======================== ?>
<?php get_template_part('include_meta'); ?>
<?php //======================== ?>

<div id="wrapper">

	<?php //======================== ?>
	<?php get_template_part('include_toggle'); ?>
	<?php //======================== ?>

	<?php //======================== ?>
	<?php get_template_part('include_nav');?>
	<?php //======================== ?>

	<main id="sb-site" class="sb-slide">

		<div class="breadcrumb">
			<ol class="breadcrumb__lst">
				<li class="breadcrumb__lst__item"><a href="<?php echo get_bloginfo("url"); ?>/">トップページ</a> </li>
				<li class="breadcrumb__lst__item"><span>404 - not found</span></li>
			</ol>
		</div>		


		<!-- ページヘッダータイトル（画像背景）-->
		<div class="pageHeader">
			<h1 class="pageHeader__txt"><span>404</span></h1>
		</div>
		<div class="content">
			<div class="tit02">
				<h2 class="tit02__ja"><span>Not Found</span></h2>
			</div>
		</div>

		<div class="content-mini">

			<h3 class="tit08">お探しのページを見つけることができませんでした。</h3>
			<div class="txt01">
				<p>
					お探しのページは、削除されたか、名前が変更された可能性があります。<br />
					直接アドレスを入力された場合は、アドレスが正しく入力されているかもう一度ご確認下さい。
				</p>
			</div>
		</div>

		<?php //======================== ?>
		<?php get_template_part('include_parts_routeInfoMenu');?>
		<?php //======================== ?>

		<?php //======================== ?>
		<?php get_template_part('include_parts_onlineTwitter');?>
		<?php //======================== ?>


		<!-- footer -->
		<?php //======================== ?>
		<?php get_template_part('include_footer');?>
		<?php //======================== ?>

	</main>
</div>

<?php //======================== ?>
<?php get_template_part('chatbot2/chatbot');?>
<?php //======================== ?>

<?php //======================== ?>
<?php get_template_part('include_body_footer');?>
<?php //======================== ?>
