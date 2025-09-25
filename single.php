<?php
global $meta;
?>



		<?php if(have_posts()): while(have_posts()): the_post(); ?>
			<?=get_the_title();?>
			<?php the_time('Y.m.d'); ?>
			<?=the_content(); ?>
		<?php endwhile; endif; ?>


