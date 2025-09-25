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

		<?php breadcrumb(); ?>
		<?php schemaOrg_BreadcrumbList();?>



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

	</main>
</div>

<?php //======================== ?>
<?php get_template_part('chatbot2/chatbot');?>
<?php //======================== ?>

<?php //======================== ?>
<?php get_template_part('include_body_footer');?>
<?php //======================== ?>


<?php
// if(have_rows( 'longSetting_narita' , 'option' )):
// 	while(have_rows( 'longSetting_narita' , 'option' )): the_row();
// 		var_dump(get_sub_field('longSetting_lst_buscompany'));
// 	endwhile;
// endif;
?>


