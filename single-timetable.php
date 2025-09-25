<?php

global $meta;

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
				<li class="breadcrumb__lst__item"><a href="<?php echo get_bloginfo("url"); ?>/">バス路線案内 / 時刻表・運賃</a></li>
				<li class="breadcrumb__lst__item"><span><?=get_the_title();?></span></li>
			</ol>
		</div>		
		<!-- <script type="application/ld+json">
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
						"@id": "<?php echo get_bloginfo("url"); ?>/faq/",
						"name": "aa"
					}
				}
			]
		}
		</script> -->

		<!-- ページヘッダータイトル（画像背景）-->
		<div class="pageHeader">
			<h1 class="pageHeader__txt"><span><?=get_the_title();?></span></h1>
		</div>
		<div class="content">
			<div class="tit02">
				<h2 class="tit02__ja"><span><?=get_the_title();?></span></h2>
			</div>
		</div>



		<?php echo get_Timetable3(); ?>

		<?php //======================== ?>
		<?php //get_template_part('include_parts_routeInfoMenu');?>
		<?php //======================== ?>

		<?php //======================== ?>
		<?php //get_template_part('include_parts_onlineTwitter');?>
		<?php //======================== ?>





		<!-- footer -->
		<?php //======================== ?>
		<?php get_template_part('include_footer');?>
		<?php //======================== ?>

	</main>
</div>

<?php //======================== ?>
<?php //get_template_part('chatbot2/chatbot');?>
<?php //======================== ?>



<?php //======================== ?>
<?php get_template_part('include_body_footer');?>
<?php //======================== ?>
