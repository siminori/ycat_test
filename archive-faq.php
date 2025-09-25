<?php

global $meta;

// 自動生成されるタグを制御する方法(br削除等)
//remove_filter ('the_content', 'wpautop');

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
				<li class="breadcrumb__lst__item"><span>よくある質問</span></li>
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
						"@id": "<?php echo get_bloginfo("url"); ?>/faq/",
						"name": "よくある質問"
					}
				}
			]
		}
		</script>


		<!-- ページヘッダータイトル（画像背景）-->
		<div class="pageHeader">
			<h1 class="pageHeader__txt"><span>よくあるご質問</span></h1>
		</div>

		<?php
		// -----------------------------------
		// タームを取得（カテゴリー）
		// ※並び替えは管理画面の（Term Order）を利用すると変更可能
		// -----------------------------------
		?>


		<?php 
		  $my_tax = 'faq_cat';  //取得したいタクソノミー名

		  $parent_terms = get_terms( $my_tax, array('hide_empty' => true, 'parent' => 0) );  //第一階層のタームだけ取得

		  if ( !empty( $parent_terms ) ) :


			//第1ループ
			foreach ( $parent_terms as $pt ) : 
			  $pt_id = $pt->term_id;
			  $pt_name = $pt->name;
			  $pt_slug = $pt->slug;
			  $pt_url = get_term_link($pt);


			  	// ■ 大カテゴリー START
				echo '<div id="'.$pt_slug.'" class="ac-menu content qa-content">';


			  		// 【大カテゴリー：大見出し】
					echo '<input id="ac-'.$pt_slug.'" type="checkbox">';
					echo '<h2 class="tit08" id="faq_'.$pt_id.'"><label for="ac-'.$pt_slug.'" class="ac-label">'.$pt_name.'</label></h2>';


			  		// 【大カテゴリー：コンテンツ START】
					echo '<div class="ac-menu-inside">';
						echo '<div class="qa-content_inner">';

						  $child_terms = get_terms( $my_tax, array('hide_empty' => true, 'parent' => $pt_id) );

							// ****************************************
							// 子要素のよくある質問がある場合
							// ****************************************
						  $ct_id = "";
						  $ct_name = "";
						  $ct_slug = "";
						  $ct_url = "";

							$excludeLst = array();

						  if ( !empty( $child_terms ) ) :

						   //第2ループ
							foreach ( $child_terms as $ct ) : 
							  $ct_id = $ct->term_id;
							  $ct_name = $ct->name;
							  $ct_slug = $ct->slug;
							  $ct_url = get_term_link($ct);


								// ■ 中カテゴリー START
								// 【中カテゴリー：見出し】
								echo '<input id="acd-check_'.$ct_slug.'" type="checkbox">';
								echo '<h3 class="qaTit_middle"><label for="acd-check_'.$ct_slug.'" class="ac-label">'.$ct_name.'</label></h3>';

								echo '<div class="qaBox__content-middle acd-content">';

									echo '	<div class="qaList">';

										$args = array(
										'posts_per_page'   => -1,//(2)マイナス1は全件表示
										'post_type' => 'faq',//(3)
										'faq_cat' => $ct->slug,//(4)
										'orderby'          => 'date',//(5)
										'order'          => 'ASC'//(6)降順　新しい日付から古い日付
										);
										$my_posts = get_posts( $args );
										if ( $my_posts ) { // 該当する投稿があったら

										foreach ( $my_posts as $post ) :
											setup_postdata( $post );

											// ■ よくある質問の内容 START
											echo '<input id="acd-check_'.$pt_slug.'_'.$cat->slug .'_'. $post->ID.'" class="acd-check" type="checkbox">';
											echo '<label class="acd-label qaBox__tit" for="acd-check_'.$pt_slug.'_'.$cat->slug .'_'. $post->ID.'">';
											echo '	<p>'.get_the_title().'</p>';
											echo '</label>';

											echo '<div class="qaBox__content acd-content">';
											echo '	<div class="blogDetail">';
														the_content();
											echo '	</div>';
											echo '</div>';
											// ■ よくある質問の内容 END

											$excludeLst[] = $post->ID;

										endforeach;
										}
										wp_reset_postdata();

									echo '	</div>';
								echo '	</div>';
								// ■ 中カテゴリー END




							endforeach;  //End : 第２ループ



									$args = array(
									'posts_per_page'   => -1,//(2)マイナス1は全件表示
									'post_type' => 'faq',//(3)
									'faq_cat' => $pt->slug,//(4)
									'orderby'          => 'date',//(5)
									'order'          => 'ASC', //(6)降順　新しい日付から古い日付
									'post__not_in' => $excludeLst
									);
									$my_posts = get_posts( $args );
									if ( $my_posts ) { // 該当する投稿があったら

										echo '	<h3 class="tit05">その他のご質問</h3>';
										echo '	<div class="qaList">';
										foreach ( $my_posts as $post ) :
											setup_postdata( $post );
											echo '<input id="acd-check_'.$pt_slug.'_'.$cat->slug .'_'. $post->ID.'" class="acd-check" type="checkbox">';
											echo '<label class="acd-label qaBox__tit" for="acd-check_'.$pt_slug.'_'.$cat->slug .'_'. $post->ID.'">';
											echo '	<p>'.get_the_title().'</p>';
											echo '</label>';
											echo '<div class="qaBox__content acd-content">';
											echo '	<div class="blogDetail">';
														the_content();
											echo '	</div>';
											echo '</div>';
										endforeach;
										echo '	</div>';
									}
									wp_reset_postdata();



						// ****************************************
						// 子要素のよくある質問がない場合
						// ****************************************
						else:

								echo '	<h3 class="tit05">'.$ct_name.'</h3>';
								echo '	<div class="qaList">';

									$args = array(
									'posts_per_page'   => -1,//(2)マイナス1は全件表示
									'post_type' => 'faq',//(3)
									'faq_cat' => $pt->slug,//(4)
									'orderby'          => 'date',//(5)
									'order'          => 'ASC'//(6)降順　新しい日付から古い日付
									);
									$my_posts = get_posts( $args );
									if ( $my_posts ) { // 該当する投稿があったら

									foreach ( $my_posts as $post ) :
										setup_postdata( $post );
										echo '<input id="acd-check_'.$pt_slug.'_'.$cat->slug .'_'. $post->ID.'" class="acd-check" type="checkbox">';
										echo '<label class="acd-label qaBox__tit" for="acd-check_'.$pt_slug.'_'.$cat->slug .'_'. $post->ID.'">';
										echo '	<p>'.get_the_title().'</p>';
										echo '</label>';
										echo '<div class="qaBox__content acd-content">';
										echo '	<div class="blogDetail">';
													the_content();
										echo '	</div>';
										echo '</div>';


									endforeach;
									}
									wp_reset_postdata();

								echo '	</div>';

						endif;

						echo '</div>';


					echo '</div>'; // 【大カテゴリー：コンテンツ END】
				echo '</div>'; // ■ 大カテゴリー END


			endforeach;  //End : 第1ループ

		  endif;
		?>



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
