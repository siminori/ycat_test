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
				<li class="breadcrumb__lst__item"><span>検索結果：「<?php the_search_query(); ?>」</span></li>
			</ol>
		</div>		


		<!-- ページヘッダータイトル（画像背景）-->
		<div class="pageHeader">
			<h1 class="pageHeader__txt"><span>検索結果</span></h1>
		</div>
		<div class="content">
			<div class="tit02 col">
				<h2 class="tit02__ja"><span>検索結果：「<?php the_search_query(); ?>」</span></h2>
			</div>
		</div>




			<?php if(have_posts()): ?>

				<div class="content-mini">
					<!-- 検索ワードを出力 -->
					<p class="tit07">「<?php the_search_query(); ?>」に該当するコンテンツが見つかりました。</p>
					<p style="text-align:right;margin-bottom:25px;">検索結果：<?php echo $wp_query->found_posts; ?>件</p>

					<ul class="searchLst">
					<?php while(have_posts()): the_post(); ?>
						<li class="searchLst__item">
							<a href="<?php the_permalink(); ?>" style="text-decoration:none;">
								<h3><?php the_title(); ?></h3>
								<p class="txt01">
										<?php echo mb_strimwidth(get_the_excerpt(),0,400,'[...]','UTF-8'); ?>
								</p>
							</a>
						</li>
					<?php endwhile; ?>
					</ul>
				</div>

				<div class="content-mini">
					<div class="searchForm404">
						<p class="tit07">必要な情報は見つかりましたか？</p>
						<form method="get" action="<?php bloginfo("url"); ?>/" class="search-form">
							<input type="text" name="s" id="s" value="" placeholder="もう一度サイト内を検索する" />
							<input type="submit" value="検索する" />
						</form>
					</div>
				</div>



			<!-- 検索ワードに該当する記事がない場合の処理-->
			<?php else: ?>

				<div class="content-mini">
					<p class="tit05">「<span><?php the_search_query(); ?></span>」の検索結果が見つかりませんでした。</p>
					<div>
						<p class="txt01">別のキーワードでお試しください。</p>
						<?php get_search_form(); ?>
					</div>
				</div>


			<?php endif;  ?>



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
