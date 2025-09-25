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
				<li class="breadcrumb__lst__item"><span>インフォメーション</span></li>
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
						"@id": "<?php echo get_bloginfo("url"); ?>/infonews/",
						"name": "インフォメーション"
					}
				}
			]
		}
		</script>


		<!-- ページヘッダータイトル（画像背景）-->
		<div class="pageHeader">
			<h1 class="pageHeader__txt"><span>インフォメーション</span></h1>
		</div>
		<!--<div class="content">
			<div class="tit02 col">
				<h2 class="tit02__ja"><span>インフォメーション</span></h2>
			</div>
		</div>-->



		<div class="content">

			<?php
			/*=======================
			重要なお知らせ
			  =====================*/
			$args = array(
				'post_type' => 'info',
				'posts_per_page' => 4,
				'tax_query' => array(
				 'relation' => 'AND',
					array(
						'taxonomy' => 'info_cat',
						'field' => 'slug',
						'terms' => array(
							'important'
						),
						'operator' => 'IN', 
					),
				),
			);
			$loop = new WP_Query($args);
			?>
			<?php if($loop->have_posts()):?>
			<div class="info__important">
				<p class="info__important__label"><span>重要なお知らせ</span></p>
				<ul class="info__important__lst">
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<li class="info__important__lst__item">
						<a href="<?=get_permalink();?>"><?=get_the_title();?></a>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php wp_reset_query(); ?>



			<div class="infoBox">
				<?php
				/*=======================

				  =====================*/
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				$args = array(
					'post_type' => 'info',
					'posts_per_page' => 10,
					'paged' => $paged,
					'tax_query' => array(
					 'relation' => 'AND',
						array(
							'taxonomy' => 'info_cat',
							'field' => 'slug',
							'terms' => array(
								'important'
							),
							'operator' => 'NOT IN', 
						),
					),
				);
				$loop = new WP_Query($args);
				?>
				<ul class="infoBox__lst">
					<?php if($loop->have_posts()):?>
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<li class="infoBox__lst__item">	

						<span class="infoBox__lst__item__date"><?=get_the_time('Y/m/d');?></span>
						<?php //カスタムタクソノミーカテゴリーを取得 --------------- ?>
						<?php $cnt = 0; ?>
						<?php $i = 1; ?>
						<?php $terms = get_the_terms($post->ID, 'info_cat') ; ?>
							<?php foreach ( $terms as $term ) : ?>
								<span class="infoBox__lst__item__label <?=$term->slug;?>"><span><?=$term->name;?></span></span>
								<?php $i++;?>
								<?php if( $i > 1 ) break; ; ?>
							<?php endforeach;?>	

						<p class="infoBox__lst__item__tit">
							<a href="<?=get_permalink();?>"><?=get_the_title();?></a>
						</p>
					</li>
					<?php endwhile; ?>
					<?php endif; ?>
				<ul>
				<?php wp_reset_query(); ?>
			</div>


				<?php if(function_exists('wp_pagenavi')) { ?>
				<div class="pageinner">
					<?php wp_pagenavi(); ?>
				</div>
				<?php } ?>			
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
