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
				<li class="breadcrumb__lst__item"><a href="<?=get_bloginfo("url"); ?>/info/">インフォメーション</a></li>
				<li class="breadcrumb__lst__item"><span><?=get_the_title();?></span></li>
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
						"@id": "<?php echo get_bloginfo("url"); ?>/info/",
						"name": "インフォメーション"
					}
				},
				{
					"@type": "ListItem",
					"position": 3,
					"item": {
						"@id": "<?=get_permalink();?>",
						"name": "<?=get_the_title();?>"
					}
				}
			]
		}
		</script>


		<!-- ページヘッダータイトル（画像背景）-->
		<div class="pageHeader">
			<p class="pageHeader__txt"><span>インフォメーション</span></p>
		</div>
		<div class="content">
			<div class="tit02 col">
				<p class="tit02__ja"><span>インフォメーション</span></p>
				<!-- <p class="tit02__en"><span>Faq</span></p> -->
			</div>
		</div>

		<div class="content">
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
				<p class="blogDate"><?=get_the_time('Y/m/d');?></p>
				<h1 class="tit06"><?=get_the_title();?></h1>

				<?php //$terms = get_the_terms($post->ID, 'info_cat') ; ?>
				<?php //foreach ( $terms as $term ) : ?>
					<!-- <span><?=$term->name;?></span> -->
				<?php //endforeach;?>	


				<div class="blogDetail">
					<?=the_content(); ?>
				</div>
			<?php endwhile; endif; ?>
		</div>
		<div class="content">
			<ul class="btnArea col01">
				<li class="btnArea__item"><a href="<?=get_bloginfo("url"); ?>/info/" class="bg-blue01">インフォメーション一覧に戻る</a></li>
			</ul>
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
