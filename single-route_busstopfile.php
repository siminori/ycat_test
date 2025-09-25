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
				<li class="breadcrumb__lst__item"><a href="<?php echo get_bloginfo("url"); ?>/route/">時刻表CSV</a></li>
				<li class="breadcrumb__lst__item">
					<?php echo  get_the_title();?>
					<?=get_field('route_busstopfile_kaitei') ?"（改定日：". get_field('route_busstopfile_kaitei')."）": "" ;?>
				</li>
			</ol>
		</div>		

		<!-- ページヘッダータイトル（画像背景）-->
		<div class="pageHeader">
			<h1 class="pageHeader__txt"><span style="color:#f00;background:#fff;">時刻表CSV表示テスト</span></h1>
		</div>
		<div class="content">
			<div class="tit02">
				<h2 class="tit02__ja"><span>
					<?php echo  get_the_title();?>
					<?=get_field('route_busstopfile_kaitei') ?"<br /><span style='font-size:50%;'>（改定日：". get_field('route_busstopfile_kaitei')."）</span>": "" ;?>
				</span></h2>
			</div>
		</div>

		<?php
		// 記事のターム情報を取得
		$termSlug = "";
		$post_terms = get_the_terms( $post->ID, 'route_busstopfile_cat' );

		// 親以外のターム情報 = 記事のターム（カテゴリー）を取得する
		foreach ( $post_terms as $term ):
			if($term->parent){
				$termName = $term->name;
				$termSlug = $term->slug;
				break;
			}
		endforeach;

		if( $termSlug <> "" ):
			echo get_Timetable($termSlug , true , $post->ID);
		endif;	

		?>

		<p style="text-align:center;"><button id="printBtn01"  class="printBtn">印 刷</button></p>
		<script>
			<?php
				// ****************************************
				// 時刻表CSV を編集からの時刻表はその記事にアップされた時刻表を表示する
				// ****************************************
			?>
			printURL = "";
			printURL = printURL + "<?=get_bloginfo('url');?>";
			printURL = printURL + "/print/?";


			printURL = printURL + "slug[0]=<?=$termSlug;?>";
			printURL = printURL + "&tit[0]=<?=get_the_title();?>";

			printURL = printURL + "&preview=true";
			printURL = printURL + "&postid=<?=$post->ID;?>";


			jQuery(function() {
				jQuery("#printBtn01").click(function(){
					window.open( printURL ,'route','width=500,toolbar=yes,menubar=yes,scrollbars=yes');
					return false;
				});
			});
		</script>


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
