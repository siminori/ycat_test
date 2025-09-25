<?php
global $meta;

?>



	<!-- パンくずリスト -->
	<div class="breadcrumb-list scroll-bar">
		<ol>
			<li><a href="<?=get_bloginfo("url"); ?>/">HOME</a></li>
			<li><a href="<?=get_bloginfo("url"); ?>/blog/">ブログ</a></li>
			<?php // ブログカテゴリー名 ?>
			<li class="active"><?php single_tag_title(); ?></li>
		</ol>
	</div>


	<?php wp_reset_query(); ?>
	<?php if(have_posts()):?>
	<ul class="blogLst">
	<?php while(have_posts()): the_post(); ?>
		<li class="blogLst__item">
			<p class="blogLst__item__img">
			   <?php if (has_post_thumbnail()) : ?>
					<?php the_post_thumbnail('thumb-320x300'); ?>
				<?php else : ?>
					<?php if( catch_that_image() != "") : ?>
					<img src="<?php echo catch_that_image(); ?>" alt="<?php echo  get_the_title(); ?>" class="thum" />
					<?php endif; ?>
				<?php endif; ?>
			</p>
			<div class="blogLst__item__info">
				<p class="blogLst__item__info__date"><?php the_time('Y.m.d') ?></p>
				<p class="blogLst__item__info__tit"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
			</div>
		</li>
	<?php endwhile;?>
	</ul>
	<?php endif; ?>

