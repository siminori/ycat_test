<?php
/*----------------------
Template Name:page-index


サイトのTOPページです。

index は　投稿　のトップページです

-----------------------*/

global $meta;

?>
<?php //======================== ?>
<?php get_template_part('include_meta'); ?>
<?php //======================== ?>

<div id="wrapper">

	<?php //======================== ?>
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
			}
		]
	}
	</script>

	<?php //======================== ?>
	<?php get_template_part('include_toggle'); ?>
	<?php //======================== ?>

	<?php //======================== ?>
	<?php get_template_part('include_nav');?>
	<?php //======================== ?>

	<main id="sb-site" class="sb-slide">

		<?php
		// ****************************************
		// メインビジュアル
		// ****************************************
		?>
		<ul class="mainVisual">
			<li class="mainVisual__item"><img src="<?=get_bloginfo('template_directory'); ?>/img/mainVisual01.png" alt="成田空港・羽田空港を中心に横浜と日本各地を結ぶバスターミナル" /></li>
		</ul>


		<?php
		// ****************************************
		// 運行情報の表示
		// ****************************************
		//$narita = get_Signboad('narita');
		//$haneda = get_Signboad('haneda');

		$narita = get_Signboad2('narita');
		$haneda = get_Signboad2('haneda');

		if( $narita['mark'] == "○" || $narita['mark'] == "―" ){
			$narita_markFlag = "green";
		} else{
			$narita_markFlag = "red";
		}

		if( $haneda['mark'] == "○" || $haneda['mark'] == "―" ){
			$haneda_markFlag = "green";
		} else{
			$haneda_markFlag = "red";
		}

		?>

		<div class="topSignboard">
			<div class="topSignboard__item narita">
				<div class="topSignboard__item__top">

					<div class="topSignboard__item__top__info <?=$narita_markFlag;?>">
						<p class="topSignboard__item__top__info__mark"><?=$narita['mark']?></p>
						<p class="topSignboard__item__top__info__msg">
							<?=$narita['reason2']?><br />

							<?php if( $narita['status'] != "運休" && $narita['status'] != "始発案内" ): ?>
							(<?=$narita['time2']?>分)
							<?php endif; ?>

						</p>
					</div>

					<p class="topSignboard__item__top__name"><a href="<?=get_bloginfo("url"); ?>/route/narita/">成田空港</a><!--<span>&nbsp;</span>---></p>
					<p class="topSignboard__item__top__btn"><a href="<?=get_bloginfo("url"); ?>/route/narita/ycat2narita/#signboad"><span>空港行き<br class="pcOFF">運行情報</span></a></p>
				</div>
				<ul class="topSignboard__item__btn">
					<li class="topSignboard__item__btn__item"><a href="<?=get_bloginfo("url"); ?>/route/narita/#fare">運賃</a></li>
					<li class="topSignboard__item__btn__item"><a href="<?=get_bloginfo("url"); ?>/route/narita/ycat2narita/">時刻表<br />YCAT→成田空港</a></li>
					<li class="topSignboard__item__btn__item"><a href="<?=get_bloginfo("url"); ?>/route/narita/narita2ycat/">時刻表<br />成田空港→YCAT</a></li>
				</ul>
			</div>
			<div class="topSignboard__item haneda">
				<div class="topSignboard__item__top">
					<div class="topSignboard__item__top__info <?=$haneda_markFlag;?>">
						<p class="topSignboard__item__top__info__mark"><?=$haneda['mark']?></p>
						<p class="topSignboard__item__top__info__msg">
							<?=$haneda['reason2']?><br />
							<?php if( $haneda['status'] != "運休" && $haneda['status'] != "始発案内" ): ?>
							(<?=$haneda['time2']?>分)
							<?php endif; ?>
						</p>
					</div>
					<p class="topSignboard__item__top__name"><a href="<?=get_bloginfo("url"); ?>/route/haneda/">羽田空港<span>(東京国際空港)</span></a></p>
					<p class="topSignboard__item__top__btn"><a href="<?=get_bloginfo("url"); ?>/route/haneda/ycat2haneda/#signboad"><span>空港行き<br class="pcOFF">運行情報</span></a></p>
				</div>
				<ul class="topSignboard__item__btn">
					<li class="topSignboard__item__btn__item"><a href="<?=get_bloginfo("url"); ?>/route/haneda/#fare">運賃</a></li>
					<li class="topSignboard__item__btn__item"><a href="<?=get_bloginfo("url"); ?>/route/haneda/ycat2haneda/">時刻表<br />YCAT→羽田空港</a></li>
					<li class="topSignboard__item__btn__item"><a href="<?=get_bloginfo("url"); ?>/route/haneda/haneda2ycat/">時刻表<br />羽田空港→YCAT</a></li>
				</ul>
			</div>
		</div>

		<div class="content">
			<div class="routeSearch__box">
		<?php //======================== ?>
		<?php get_template_part('include_routeSearch_form');?>
		<?php //======================== ?>
			</div>
		</div>

		<?php
		// ****************************************
		// インフォメーション
		// ****************************************
		?>
		<!-- インフォメーション -->



		<div class="topInfo">
			<div class="titBtnArea">
				<div class="tit01 col">
					<p class="tit01__en">Information</p>
					<h2 class="tit01__ja">インフォメーション</h2>
				</div>	
				<a href="<?=get_bloginfo("url"); ?>/info/" class="titBtnArea__btn spOFF">一覧</a>
			</div>

			<ul class="tab-group">
				<li class="tab is-active"><span>すべて</span></li>
				<li class="tab"><span>お知らせ</span></li>
				<li class="tab"><span>イベント</span></li>
				<li class="tab"><span>路線の情報</span></li>
			</ul>

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
			<div class="topInfo__important">
				<p class="topInfo__important__label"><span>重要なお知らせ</span></p>
				<ul class="topInfo__important__lst">
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<li class="topInfo__important__lst__item">
						<a href="<?=get_permalink();?>"><?=get_the_title();?></a>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php wp_reset_query(); ?>

			<div class="panel-group">
					<div class="panel is-show">
						<?php
						/*=======================
						すべて
						  =====================*/
						$args = array(
							'post_type' => 'info',
							'posts_per_page' => 4,
						);
						$loop = new WP_Query($args);
						?>
						<?php if($loop->have_posts()):?>
						<ul class="topInfo__lst all">
							<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<li class="topInfo__lst__item">
								<a href="<?=get_permalink();?>">
									<div class="topInfo__lst__item__head">
										<span class="topInfo__lst__item__head__label"><span>すべて</span></span>
										<span class="topInfo__lst__item__head__date"><?=get_the_time('Y/m/d');?></span>
									</div>
									<p class="topInfo__lst__item__tit"><?=get_the_title();?></p>
								</a>
							</li>
							<?php endwhile; ?>
						</ul>
						<?php endif; ?>
						<?php wp_reset_query(); ?>

					</div>
					<div class="panel">
						<?php
						/*=======================
						お知らせ
						  =====================*/
						$args = array(
							'post_type' => 'info',
							'posts_per_page' => 4,
							'tax_query' => array(
							 'relation' => 'AND',
								array(
									'taxonomy' => 'info_cat',
									'field' => 'slug',
									'terms' => array('event','important','rosen'),
									'operator' => 'NOT IN', 
								),
								array(
									'taxonomy' => 'info_cat',
									'field' => 'slug',
									'terms' => array(
										'notice'
									),
									'operator' => 'IN', 
								),
							),
						);
						$loop = new WP_Query($args);
						?>
						<?php if($loop->have_posts()):?>
						<ul class="topInfo__lst notice">
							<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<li class="topInfo__lst__item">
								<a href="<?=get_permalink();?>">
									<div class="topInfo__lst__item__head">
										<span class="topInfo__lst__item__head__label"><span>お知らせ</span></span>
										<span class="topInfo__lst__item__head__date"><?=get_the_time('Y/m/d');?></span>
									</div>
									<p class="topInfo__lst__item__tit"><?=get_the_title();?></p>
								</a>
							</li>
							<?php endwhile; ?>
						</ul>
						<?php endif; ?>
						<?php wp_reset_query(); ?>
					</div>
					<div class="panel">
						<?php
						/*=======================
						イベント
						  =====================*/
						$args = array(
							'post_type' => 'info',
							'posts_per_page' => 4,
							'tax_query' => array(
							 'relation' => 'AND',
								array(
									'taxonomy' => 'info_cat',
									'field' => 'slug',
									'terms' => array('notice','important','rosen'),
									'operator' => 'NOT IN', 
								),
								array(
									'taxonomy' => 'info_cat',
									'field' => 'slug',
									'terms' => array(
										'event'
									),
									'operator' => 'IN', 
								),
							),
						);
						$loop = new WP_Query($args);
						?>
						<?php if($loop->have_posts()):?>
						<ul class="topInfo__lst event">
							<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<li class="topInfo__lst__item">
								<a href="<?=get_permalink();?>">
									<div class="topInfo__lst__item__head">
										<span class="topInfo__lst__item__head__label"><span>イベント</span></span>
										<span class="topInfo__lst__item__head__date"><?=get_the_time('Y/m/d');?></span>
									</div>
									<p class="topInfo__lst__item__tit"><?=get_the_title();?></p>
								</a>
							</li>
							<?php endwhile; ?>
						</ul>
						<?php endif; ?>
						<?php wp_reset_query(); ?>
					</div>
					<div class="panel">
						<?php
						/*=======================
						路線の情報
						  =====================*/
						$args = array(
							'post_type' => 'info',
							'posts_per_page' => 4,
							'tax_query' => array(
							 'relation' => 'AND',
								array(
									'taxonomy' => 'info_cat',
									'field' => 'slug',
									'terms' => array('event','important','event'),
									'operator' => 'NOT IN', 
								),
								array(
									'taxonomy' => 'info_cat',
									'field' => 'slug',
									'terms' => array(
										'rosen'
									),
									'operator' => 'IN', 
								),
							),
						);
						$loop = new WP_Query($args);
						?>
						<?php if($loop->have_posts()):?>
						<ul class="topInfo__lst rosen">
							<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<li class="topInfo__lst__item">
								<a href="<?=get_permalink();?>">
									<div class="topInfo__lst__item__head">
										<span class="topInfo__lst__item__head__label"><span>路線の情報</span></span>
										<span class="topInfo__lst__item__head__date"><?=get_the_time('Y/m/d');?></span>
									</div>
									<p class="topInfo__lst__item__tit"><?=get_the_title();?></p>
								</a>
							</li>
							<?php endwhile; ?>
						</ul>

						<?php endif; ?>
						<?php wp_reset_query(); ?>
					</div>
			</div>
			<a href="<?=get_bloginfo("url"); ?>/info/" class="titBtnArea__btn pcOFF">一覧</a>

		</div>

		<?php //======================== ?>
		<?php get_template_part('include_parts_routeInfoMenu');?>
		<?php //======================== ?>

		<?php //======================== ?>
		<?php get_template_part('include_parts_onlineTwitter');?>
		<?php //======================== ?>

		<?php //======================== ?>
		<?php get_template_part('include_parts_ycatInfo');?>
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


