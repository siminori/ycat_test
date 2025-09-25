<div class="fancyBoxs" style="display:none;">
	<!-- モーダルウィンドウ - 検索画面 -->
	<div id="animatedModal01">
		<div class="animatedModal__inner">
			<div class="modal-content">
				<h3 class="modal-content__main">YCAT - ホームページ検索</h3>

				<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<table class="modal-content__tbl searchTbl">
						<tr>
							<td><input class="searchKeyword" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" /></td>
							<td><input class="searchBtn" type="submit" value="検索" /></td>
						</tr>
					</table>
				</form>
				<h3 class="modal-content__sub">YCATへのアクセス方法をお探しですか？</h3>
				<ul class="modal-content__lst">
					<li><a href="<?=get_bloginfo("url"); ?>/access/car/">お車でのアクセス</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/access/ycat2station/">歩いてYCATから横浜駅へ</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/access/station2ycat/">歩いて横浜駅からYCATへ</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/access/yokohama-sky/">歩いてスカイビル前から横浜駅へ</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/access/pede/">歩いてペデストリアンデッキへ</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/access/station2ycat_night/">歩いて横浜駅からYCATへ（深夜時間）</a></li>
				</ul>
				<h3 class="modal-content__sub">YCATのフロアマップをお探しですか？</h3>
				<ul class="modal-content__lst">
					<li><a href="<?=get_bloginfo("url"); ?>/guide/floormap/busstop/">バスのりば</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/guide/floormap/1st_lobby/">第1ロビー</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/guide/floormap/2nd_lobby/">第2ロビー</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/guide/floormap/3rd_lobby/">第3ロビー</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/guide/floormap/yokohama-sky/">スカイビル前停留所</a></li>
					<li><a href="<?=get_bloginfo("url"); ?>/guide/floormap/pede/">ペデストリアンデッキ</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- モーダルウィンドウ - 言語選択 -->
	<div id="animatedModal02">
		<div class="animatedModal__inner">
			<div class="modal-content">
				<h3 class="modal-content__main">言語を選択してください</h3>
				<ul class="modal-content_gengo">
					<li> <a href="<?=get_bloginfo("url"); ?>/" class="langJapanLnk">日本語</a> </li>
					<!-- li><a href="https://translation2.j-server.com/LUCYCAT/ns/w0/jaen/https://camel-yellow-12a011ea5f882c43.znlc.jp/wp_ycat/" target="_blank">English</a> </li-->
					<!-- li><a href="https://translation2.j-server.com/LUCYCAT/ns/w0/jako/https://camel-yellow-12a011ea5f882c43.znlc.jp/wp_ycat/" target="_blank">한글</a> </li-->
					<!-- li><a href="https://translation2.j-server.com/LUCYCAT/ns/w0/jazh/https://camel-yellow-12a011ea5f882c43.znlc.jp/wp_ycat/" target="_blank">中文簡体</a> </li-->
					<!-- li><a href="https://translation2.j-server.com/LUCYCAT/ns/w0/jazhb/https://camel-yellow-12a011ea5f882c43.znlc.jp/wp_ycat/" target="_blank">中文繁体</a> </li-->

					<li><a href="https://translation2.j-server.com/LUCYCAT/ns/w0/jaen/<?=get_the_permalink();?>" target="_blank">English</a> </li>
					<li><a href="https://translation2.j-server.com/LUCYCAT/ns/w0/jako/<?=get_the_permalink();?>" target="_blank">한글</a> </li>
					<li><a href="https://translation2.j-server.com/LUCYCAT/ns/w0/jazh/<?=get_the_permalink();?>" target="_blank">中文簡体</a> </li>
					<li><a href="https://translation2.j-server.com/LUCYCAT/ns/w0/jazhb/<?=get_the_permalink();?>" target="_blank">中文繁体</a> </li>
				</ul>
			</div>
		</div>
	</div>
</div>
