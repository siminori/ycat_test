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
				<li class="breadcrumb__lst__item"><a href="<?php echo get_bloginfo("url"); ?>/route/">バス路線案内 / 時刻表・運賃</a></li>
				<?php 
				$ids = array();
				foreach( $post->ancestors as $k ){ $ids[] = $k; }
					// 親IDが逆順なのでひっくり返す
					echo "<!--";
					var_dump($ids);
					echo "-->";
				if( ! is_null ($ids) ) {
					$ids = array_reverse($ids);
				}
				foreach( (array)$ids as $k){
					$slugs[] = get_page_slug($k);
					echo '<li class="breadcrumb__lst__item"><a href="'.get_bloginfo("url").'/service/'.implode($slugs,"/").'/">'.get_the_title($k).'</a></li>';
				}
				?>
				<li class="breadcrumb__lst__item"><?php echo  get_the_title();?></li>
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
						"name": "バス路線案内 / 時刻表・運賃"
					}
				},
				<?php
				$cnt = 3; 
				$slugs = array();
				foreach( (array)$ids as $k){
				$slugs[] = get_page_slug($k);
				?>
				{
					"@type": "ListItem",
						"position": <?=$cnt++;?>,
					"item": {
						"@id": "<?=get_bloginfo("url")?>/route/<?php echo implode($slugs,"/"); ?>/",
						"name": "<?=get_the_title($k);?>"
					}
				},
				<?php }?>
				{
					"@type": "ListItem",
						"position": <?=$cnt;?>,
					"item": {
						"@id": "<?php the_permalink(); ?>",
						"name": "<?=get_the_title();?>"
					}
				}
			]
		}
		</script>


		<?php if(have_posts()): while(have_posts()): the_post(); ?>

			<?=the_content(); ?>

		<?php endwhile; endif; ?>


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

		<div id="popup">
			<p class="upblock" id="popup_red"></p>
		</div>
	</main>


</div>

<?php //======================== ?>
<?php get_template_part('chatbot2/chatbot');?>
<?php //======================== ?>


<?php //======================== ?>
<?php get_template_part('include_body_footer');?>
<?php //======================== ?>



