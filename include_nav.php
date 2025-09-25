<div class="sideMenu spOFF">

	<header class="header">

		<h1 class="header__logo">
			<a href="<?=get_bloginfo("url"); ?>">
				<img src="<?=get_bloginfo('template_directory'); ?>/img/heade_logo.png" alt="YCAT - 横浜シティ・エア・ターミナル" />
			</a>
		</h1>

		<?php
		// ****************************************
		// メニュー欄
		// ****************************************
		?>
		<nav class="menu">


			<ul class="menuMain">

				<li class="menuMain__item parentMenu">
				<span class="parentMenu__item menuRosen"><a href="<?=get_bloginfo("url"); ?>/route/">バス路線案内<br />時刻表・運賃</a></span>

					<!-- ▼ 第2階層メニュー 【バス路線案内時刻表・運賃】-->
					<div class="subMenu">
						<ul class="menuLst01">
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/route/narita/">成田空港</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/route/haneda/">羽田空港 (東京国際空港)</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/route/long/">中長距離・夜行</a></li>
							<!--<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/route/daiba/">お台場(東京ビッグサイト)</a></li>-->
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/route/higashiohgishima/">東扇島</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/route/yokosuka/">葉山・横須賀西地区</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/route/seaparadise/">横浜･八景島シーパラダイス</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/route/makuhari/">幕張メッセ（イベント日限定）</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/route/operation/">本日の運行予定</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/route/companylist/">運行バス会社一覧</a></li>
						</ul>
					</div>	
				</li>

				<li class="menuMain__item parentMenu">
					<span class="parentMenu__item menuAccess"><a href="<?=get_bloginfo("url"); ?>/access/">アクセス</a></span>

					<!-- ▼ 第2階層メニュー 【アクセス】-->
					<div class="subMenu">
						<ul class="menuLst01">
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/access/station2ycat/">歩いて横浜駅からYCATへ</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/access/ycat2station/">歩いてYCATから横浜駅へ</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/access/car/">お車でのアクセス</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/access/pede/">歩いてペデストリアンデッキへ</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/access/yokohama-sky/">歩いてスカイビル前から横浜駅へ</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/access/station2ycat_night/">歩いて横浜駅からYCATへ（深夜時間）</a></li>
						</ul>
					</div>	
				</li>

				<li class="menuMain__item">
					<a class="parentMenu__item menuInfo" href="<?=get_bloginfo("url"); ?>/info/">インフォメーション</a>
				</li>

				<li class="menuMain__item parentMenu">

					<span class="parentMenu__item menuAnnai"><a href="<?=get_bloginfo("url"); ?>/guide/">ご利用案内</a></span>

					<!-- ▼ 第2階層メニュー 【ご利用案内】-->
					<div class="subMenu">
						<ul class="menuLst01">
							<!-- <li>
								<div class="parentMenu2">

									<a href="<?=get_bloginfo("url"); ?>/guide/floormap/">フロアマップ</a>

									<?php //▽ 第3階層メニュー【フロアマップ】 ?>
									<div class="subMenu2">
										<ul class="menuLst01">
											<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/guide/floormap/busstop/">バスのりば</a></li>
											<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/guide/floormap/1st_lobby/">第1ロビー</a></li>
											<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/guide/floormap/2nd_lobby/">第2ロビー</a></li>
											<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/guide/floormap/3rd_lobby/">第3ロビー</a></li>
											<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/guide/floormap/yokohama-sky/">スカイビル前停留所</a></li>
											<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/guide/floormap/pede/">ペデストリアンデッキ</a></li>
										</ul>
									</div>	
								</div>
							</li> -->
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/guide/floormap/">フロアマップ</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/guide/shop/">YCAT SHOP（売店）</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/guide/service/">サービス施設案内</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/guide/support/">お手伝いが必要なお客様へ</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/guide/lost/">お忘れ物について</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/sightseeing/">観光案内</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/guide/areainfo/">YCAT周辺情報</a></li>
							<li class="menuLst01__item"><a href="<?=get_bloginfo("url"); ?>/merit/">バスのメリット</a></li>
						</ul>
					</div>	
				</li>
				<li class="menuMain__item"><a class="parentMenu__item menuQa" href="<?=get_bloginfo("url"); ?>/faq/">よくあるご質問</a></li>
			</ul>

			<!-- 検索・言語選択 -->	
			<ul class="menuBtns">
				<li class="menuBtns__item">
					<!-- <a class="over" id="animatedModal01-Btn" href="#animatedModal01">
						<p><img src="<?=get_bloginfo('template_directory'); ?>/img/icon_search.png" alt="検索" /></p>
						<span>検索</span>
					</a> -->
					<a class="fancybox over" id="animatedModal01-Btn" href="#animatedModal01">
						<p><img src="<?=get_bloginfo('template_directory'); ?>/img/icon_search.png" alt="検索" /></p>
						<span>検索</span>
					</a>
				</li>
				<li class="menuBtns__item">
					<!-- <a class="over" id="animatedModal02-Btn" href="#animatedModal02">
						<p><img src="<?=get_bloginfo('template_directory'); ?>/img/icon_lang.png" alt="Language" /></p>
						<span>Language</span>
					</a> -->
					<a class="fancybox over" id="animatedModal02-Btn" href="#animatedModal02">
						<p><img src="<?=get_bloginfo('template_directory'); ?>/img/icon_lang.png" alt="Language" /></p>
						<span>Language</span>
					</a>
				</li>
			</ul>

			<!-- その他のリンク -->	
			<ul class="menuOthers">
				<li class="menuOthers__item"><a href="<?=get_bloginfo("url"); ?>/businesses/">事業者向け営業案内</a></li>
				<li class="menuOthers__item"><a href="<?=get_bloginfo("url"); ?>/inquiry">お問い合わせ</a></li>
				<li class="menuOthers__item"><a href="<?=get_bloginfo("url"); ?>/company/">会社情報</a></li>
			</ul>

			<!-- SNSリンク -->	
			<ul class="snsLnk">
				<li><a href="https://twitter.com/Caty_YCAT" target="_blank" class="over" onClick="gtag('event', 'click', {'event_category': 'banner','event_label': 'twitter'});"><img src="<?=get_bloginfo('template_directory'); ?>/img/icon_sns_twitter.png" alt="twitter" /></a></li>

				<li><a href="https://www.facebook.com/yokohama.city.air.terminal" target="_blank" class="over" onClick="gtag('event', 'click', {'event_category': 'banner','event_label': 'Facebook'});"><img src="<?=get_bloginfo('template_directory'); ?>/img/icon_sns_facebook.png" alt="facebook" /></a></li>
				<li><a href="https://www.instagram.com/yokohama_ycat/?hl=ja" target="_blank" class="over" onClick="gtag('event', 'click', {'event_category': 'banner','event_label': 'instagram'});"><img src="<?=get_bloginfo('template_directory'); ?>/img/icon_sns_insta.png" alt="instagram" /></a></li>
			</ul>

		</nav>
	</header>

</div><!-- ./sideMenu -->
