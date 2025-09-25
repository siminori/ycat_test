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
				<li class="breadcrumb__lst__item">バス路線案内 / 時刻表・運賃</li>
			</ol>
		</div>
		<script type="application/ld+json">
		{	"@context": "http://schema.org",
			"@type": "BreadcrumbList",
			"itemListElement": [
				{
					"@type": "ListItem",
					"position": 1,
					"item": {
						"@id": "<?php echo get_bloginfo("url"); ?>/",
						"name": "YCAT"
					}
				},
				{
					"@type": "ListItem",
					"position": 2,
					"item": {
						"@id": "<?=get_bloginfo("url"); ?>/route/",
						"name": "バス線案内 / 時刻表・運賃"
					}
				}
			]
		}
		</script>

		<!-- ページヘッダータイトル（画像背景）-->
		<div class="pageHeader">
			<h1 class="pageHeader__txt"><span>バス線案内 / 時刻表・運賃</span></h1>
		</div>



		<?php //======================== ?>
		<?php get_template_part('include_parts_routeInfoMenu');?>
		<?php //======================== ?>


		<div style="background:#FDFFF1; padding-bottom:50px;">
			<div class="content">
				<ul class="btnArea">
					<li class="btnArea__item"><a class="bg-blue01 icon-bus" href="<?=get_bloginfo("url"); ?>/route/operation/">本日の運行予定</a></li>
					<li class="btnArea__item"><a class="bg-blue01 icon-lst" href="<?=get_bloginfo("url"); ?>/route/companylist/">運行バス会社一覧</a></li>
				</ul>
			</div>
		</div>


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
