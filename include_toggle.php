<?php /*=======================
SPヘッダー
==============================*/?>
<div id="spheader" class="pcOFF">

	<!-- スマホヘッダー（ロゴ・ボタン）-->
	<header id="fixed-top" class="sb-slide">
		<?php if(is_front_page()): ?>
		<h1 class="logo">
			<a href="<?php echo get_bloginfo("url"); ?>/">
				<img src="<?php echo get_bloginfo('template_directory'); ?>/img/sp/sp_logo.png">
			</a>
		</h1>
		<?php else: ?>
		<p class="logo">
			<a href="<?php echo get_bloginfo("url"); ?>/">
				<img src="<?php echo get_bloginfo('template_directory'); ?>/img/sp/sp_logo.png">
			</a>
		</p>
		<?php endif; ?>
		<ul class="headerButtons">
			<li class="menu sb-toggle-left btnLang">
				<a href="javascript:void(0)" id="open-left">
					<img src="<?php echo get_bloginfo('template_directory'); ?>/img/sp/sp_menu_lang.png">
				</a>
			</li>
			<li class="menu sb-toggle-right btnMenu">
				<a href="javascript:void(0)" id="open-right">
					<img src="<?php echo get_bloginfo('template_directory'); ?>/img/sp/sp_menu.png">
				</a>
			</li>
		</ul>
	</header>
	<div id="slidar_menu_lang" class="sb-slidebar sb-left sb-style-push sb-width-custom" data-sb-width="100%">
		<div class="sb-left-inner">
			<p class="sb-close">
				<img src="<?php echo get_bloginfo('template_directory'); ?>/img/sp/closeBtn.png">
			</p>
			<p class="logo">
				<a href="<?php echo get_bloginfo("url"); ?>">
					<img src="<?php bloginfo("template_directory"); ?>/img/heade_logo.png" />
				</a>
			</p>

			<?php //======================== ?>
			<?php get_template_part('include_toggle_lang'); ?>
			<?php //======================== ?>

		</div>
	</div>
	<div id="slidar_menu" class="sb-slidebar sb-right sb-style-push sb-width-custom" data-sb-width="100%">
		<div class="sb-right-inner">
			<p class="sb-close">
				<img src="<?php echo get_bloginfo('template_directory'); ?>/img/sp/closeBtn.png">
			</p>
			<p class="logo">
				<a href="<?php echo get_bloginfo("url"); ?>">
					<img src="<?php bloginfo("template_directory"); ?>/img/heade_logo.png" />
				</a>
			</p>

			<div class="acMenu">
				<!-- ■バス路線案内 / 時刻表・運賃-->
				<label for="menu_bar01">■バス路線案内 / 時刻表・運賃</label>
				<input type="checkbox" id="menu_bar01" class="accordion" />
				<ul id="links01">
					<li><a href="<?=get_bloginfo("url"); ?>/route/narita/">成田空港</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/route/haneda/">羽田空港（東京国際空港）</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/route/long/">中長距離・夜行</a></li>
<!--					<li><a href="<?=get_bloginfo("url"); ?>/route/daiba/">お台場(東京ビッグサイト)</a></li>-->
					<li><a href="<?=get_bloginfo("url"); ?>/route/higashiohgishima/">東扇島</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/route/yokosuka/">葉山・横須賀西地区</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/route/seaparadise/">横浜・八景島シーパラダイス</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/route/makuhari/">幕張メッセ(イベント日限定)</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/route/operation/">本日の運行予定</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/route/companylist/">運行バス会社一覧</a></li>
				</ul>
				<!-- ■アクセス-->
				<label for="menu_bar02">■アクセス</label>
				<input type="checkbox" id="menu_bar02" class="accordion" />
				<ul id="links02">
					<li><a href="<?=get_bloginfo("url"); ?>/access/ycat2station/">歩いてYCATから横浜駅へ</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/access/station2ycat/">歩いて横浜駅からYCATへ</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/access/station2ycat_night/">歩いて横浜駅からYCATへ(深夜時間)</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/access/car/">お車でのアクセス</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/access/pede/">歩いてペデストリアンデッキへ</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/access/yokohama-sky/">歩いてスカイビル前から横浜駅へ</a></li>
				</ul>
				<!-- ■ご利用案内-->
				<label for="menu_bar03">■ご利用案内</label>
				<input type="checkbox" id="menu_bar03" class="accordion" />
				<ul id="links03">
					<li><a href="<?=get_bloginfo("url"); ?>/guide/floormap/">フロアマップ</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/service/">サービス施設案内</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/support/">お手伝いが必要なお客様へ</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/guide/shop/">YCAT SHOP（売店）</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/guide/lost/">お忘れ物について</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/sightseeing/">観光案内</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/guide/areainfo/">YCAT周辺情報</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/merit/">バスのメリット</a></li>
				</ul>
			</div>
			<ul class="parent txt">
				<li><a href="<?=get_bloginfo("url"); ?>/info/">インフォメーション</a></li>
				<li><a href="<?=get_bloginfo("url"); ?>/faq/">よくあるご質問</a></li>
				<li><a href="<?=get_bloginfo("url"); ?>/businesses/">事業者向け営業案内</a></li>
				<li><a href="<?=get_bloginfo("url"); ?>/company/">会社情報</a></li>
				<li><a href="<?=get_bloginfo("url"); ?>/privacy/">プライバシーポリシー</a></li>
				<li><a href="<?=get_bloginfo("url"); ?>/link/">リンク</a></li>
				<li><a href="<?=get_bloginfo("url"); ?>/sitemap/">サイトマップ</a></li>
			</ul>



		</div>
	</div>

	<div class="spHeaderMenu sb-slide">
		<ul class="spHeaderMenu__lst">
			<li class="spHeaderMenu__lst__item">
				<a href="<?=get_bloginfo("url"); ?>/route/">
					<img src="<?=get_bloginfo('template_directory'); ?>/img/sp/menu_icon_sp_bus.png" alt="バス路線案内　時刻表・運賃" />
					<span>バス路線案内<br />時刻表・運賃</span>
				</a>
			</li>
			<li class="spHeaderMenu__lst__item">
				<a href="<?=get_bloginfo("url"); ?>/access/">
					<img src="<?=get_bloginfo('template_directory'); ?>/img/sp/menu_icon_sp_access.png" alt="アクセス" />
					<span>アクセス</span>
				</a>
			</li>
			<li class="spHeaderMenu__lst__item">
				<a href="<?=get_bloginfo("url"); ?>/info/">
					<img src="<?=get_bloginfo('template_directory'); ?>/img/sp/menu_icon_sp_info.png" alt="インフォメーション" />
					<span>インフォ<br />メーション</span>
				</a>
			</li>
			<li class="spHeaderMenu__lst__item">
				<a href="<?=get_bloginfo("url"); ?>/guide/">
					<img src="<?=get_bloginfo('template_directory'); ?>/img/sp/menu_icon_sp_annai.png" alt="ご利用案内" />
					<span>ご利用案内</span>
				</a>
			</li>
			<li class="spHeaderMenu__lst__item">
				<a href="<?=get_bloginfo("url"); ?>/faq/">
					<img src="<?=get_bloginfo('template_directory'); ?>/img/sp/menu_icon_sp_qa.png" alt="よくあるご質問" />
					<span>よくある<br />ご質問</span>
				</a>
			</li>
		</ul>
	</div>
</div>
