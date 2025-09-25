<?php
/*
Template Name: page-route_serch
Template Post Type: route
*/

global $meta;


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
				<li class="breadcrumb__lst__item"><a href="<?php echo get_bloginfo("url"); ?>/route/">バス路線案内 / 時刻表・運賃</a></li>
				<li class="breadcrumb__lst__item"><span>時刻表検索</span></li>
			</ol>
		</div>		

		<!-- ページヘッダータイトル（画像背景）-->
		<div class="pageHeader">
			<h1 class="pageHeader__txt"><span>時刻表検索</span></h1>
		</div>
		<div class="content">
			<div class="tit02">
				<h2 class="tit02__ja"><span>時刻表検索</span></h2>
			</div>
		</div>


		<div class="content-mini">
			<?php //======================== ?>
			<?php get_template_part('include_routeSearch_form'); /* function/shortcode.phpで呼び出し使用*/?>
			<?php //======================== ?>
		</div>

		<?php if( isset($_GET) ): ?>
		<?php $searchHit = false; ?>
		<div class="content-mini">
			<div class="routeSearchTit" id="serchTit">
				<?php if( $_GET['s_hatyaku'] == "in"): ?>

					<span><?=$_GET['s_time'];?>時台 出発</span>
					<p><?=$_GET['s_busstop'];?> ⇒ YCAT</p>

				<?php elseif( $_GET['s_hatyaku'] == "out") : ?>

					<span><?=$_GET['s_time'];?>時台 出発</span>
					<p>YCAT ⇒ <?=$_GET['s_busstop'];?></p>

				<?php endif; ?>
			</div>
			<?php
				/*=======================
				時刻表を取得
				  =====================*/

				//平日・土休日で取得するCSVを変更する（2023/04/13変更）
				//if( $_GET["searchRoute_id"] == "narita_in"){
				//	$sDATA = get_TimetableSearchData('narita2ycat');

				//} elseif( $_GET["searchRoute_id"] == "narita_out"){
				//	$sDATA = get_TimetableSearchData('ycat2narita');

				//} elseif( $_GET["searchRoute_id"] == "haneda_in"){
				//	$sDATA = get_TimetableSearchData('haneda2ycat');

				//} elseif( $_GET["searchRoute_id"] == "haneda_out"){
				//	$sDATA = get_TimetableSearchData('ycat2haneda');

				//}

				if( $_GET["searchRoute_id"] == "narita_in"){
					$sDATA = get_TimetableSearchData('narita2ycat');

				} elseif( $_GET["searchRoute_id"] == "narita_out"){
					$sDATA = get_TimetableSearchData('ycat2narita');


				} elseif( $_GET["searchRoute_id"] == "haneda_in"){


					//平日・土休日で取得するCSVを変更する（2023/04/13変更）
					if( $_GET['s_dayOfWeek'] == "weekday"){
						$sDATA = get_TimetableSearchData('haneda2ycat_heijitsu');
					}
					if( $_GET['s_dayOfWeek'] == "holiday"){
						$sDATA = get_TimetableSearchData('haneda2ycat_donichishuku');
					}


				} elseif( $_GET["searchRoute_id"] == "haneda_out"){

					//平日・土休日で取得するCSVを変更する（2023/04/13変更）
					if( $_GET['s_dayOfWeek'] == "weekday"){
						$sDATA = get_TimetableSearchData('ycat2haneda_heijitu');
					}
					if( $_GET['s_dayOfWeek'] == "holiday"){
						$sDATA = get_TimetableSearchData('ycat2haneda_donitisyuku');
					}


				}

			
				//if( is_user_logged_in()) :
				//	echo $_GET['s_dayOfWeek'];	
				//endif;


				/*=======================
				時刻表を整形（不用な1列目を削除）
				  =====================*/
				// ■ バス停名データセット（1列目は不用）
				$cnt = 1;
				foreach( $sDATA['headerName'] as $k => $v){
					if( $cnt > 1 ){
						$tmp = str_replace(array("\r\n", "\r", "\n"), '', $v);
						$headerName[] =  preg_replace("/( |　)/", "", $tmp );
					}
					$cnt++;
				}
				//var_dump($headerName);
				// ■ 発着データセット（1列目は不用）
				$cnt = 1;
				$headerHatuTyaku = array();
				foreach( $sDATA['headerHatuTyaku'] as $k => $v){
					if( $cnt > 1 ){
						$headerHatuTyaku[] = str_replace(array("\r\n", "\r", "\n"), '', $v);
					}
					$cnt++;
				}
				//
				// ■ 時刻データセット（1列目は不用）
				$arrayCnt = 0;
				foreach( $sDATA['timedata'] as $k => $v){
					$cnt = 1;
					foreach( $v as $kk => $vv ){


						if( $cnt > 1 ){
							$timedata[$arrayCnt][] = str_replace("\r\n", '', $vv);
						}
						$cnt++;
					}
					$arrayCnt++;
				}
				//echo "<pre>";
				//var_dump($timedata);
				//echo "</pre>";


				$showTable = false;

				/*=======================
				出発（out）
				  =====================*/
				if( $_GET['s_hatyaku'] == "out"){

					foreach( $timedata as $key => $row):

						$hit = false;
						$html01 = "";
						$html02 = "";
						$searchHit = false;
						$searchHit2 = false;

						foreach( $row as $kID => $cell):

							$time = explode( '|' , $cell);
							$time = explode( ':' , $time[0]);

							// 検索時刻と一致するか
							if( $_GET['s_time'] == $time[0] ):
								// 検索バス停と一致するか
								//if( $_GET['s_busstop'] == $headerName[$kID]):
								if( $headerName[$kID] == "YCAT"):

									// 発駅か
									if($headerHatuTyaku[$kID] == "発"):
										$html02 .= "<tr><th style='text-align:left;'>";
										$html02 .= "<p class='routeSearchTbl__label'>".$headerHatuTyaku[$kID]."</p>";
										$html02 .=  "<p class='routeSearchTbl__info'>";
										$html02 .=  "<span>".$headerName[$kID]."</span>";
										$html02 .=  "".$time[0].":".$time[1] ."";
										$html02 .=  "</p>";
										$html02 .= "</th></tr>";
										$html02 .= "<tr><td style='text-align:left;background:#fff;'>↓</td></tr>";
										$hit = true;
										$searchHit = true;
									endif; 
								endif; 
							endif;


						endforeach;

						$html01 = "";
						if( $hit ){
							foreach( $row as $kID => $cell):
								$time = explode( '|' , $cell);
								$time = explode( ':' , $time[0]);

								// 検索バス停と一致するか
								if( $_GET['s_busstop'] == $headerName[$kID]):

									//echo $_GET['s_busstop']."-".$headerName[$kID].$time[0]."<br />";

									// 着駅か
									if($headerHatuTyaku[$kID] == "着"):
										if( is_numeric($time[0]) ):
											$html02 .= "<tr><td style='text-align:left;'>";
											$html02 .= "<p class='routeSearchTbl__label'>".$headerHatuTyaku[$kID]."</p>";
											$html02 .=  "<p class='routeSearchTbl__info'>";
											$html02 .=  "<span>".$headerName[$kID]."</span>";
											$html02 .=  "".$time[0].":".$time[1] ."";
											$html02 .=  "</p>";
											$html02 .= "</td></tr>";
											$searchHit2 = true;
										endif;
									endif; 
								endif; 


							endforeach;


							if($searchHit && $searchHit2):

								echo "<table class='routeSearchTbl'>";
								echo $html02;
								echo $html01;
								echo "</table>";

								$showTable = true;
							endif; 
						}

					endforeach;

				}
				/*=======================
				到着（in）
				  =====================*/
				if( $_GET['s_hatyaku'] == "in"){

					foreach( $timedata as $key => $row):

						$hit = false;
						$html01 = "";
						$html02 = "";
						$searchHit = false;
						$searchHit2 = false;

						foreach( $row as $kID => $cell):
							$time = explode( '|' , $cell);
							$time = explode( ':' , $time[0]);

							// 検索時刻と一致するか
							if( $_GET['s_time'] == $time[0] ):

								// 検索バス停と一致するか
								if( $_GET['s_busstop'] == $headerName[$kID]):

									// 着駅か
									if($headerHatuTyaku[$kID] == "発"):
										$html01 .= "<tr><th style='text-align:left;'>";
										$html01 .= "<p class='routeSearchTbl__label'>".$headerHatuTyaku[$kID]."</p>";
										$html01 .=  "<p class='routeSearchTbl__info'>";
										$html01 .=  "<span>".$headerName[$kID]."</span>";
										$html01 .=  "".$time[0].":".$time[1] ."";
										$html01 .=  "</p>";
										$html01 .= "</th></tr>";
										$html01 .= "<tr><td style='text-align:left;background:#fff;'>↓</td></tr>";
										$hit = true;
										$searchHit = true;
									endif; 
								endif; 
							endif;


						endforeach;

						$html02 = "";
						if( $hit ){
							foreach( $row as $kID => $cell):
								$time = explode( '|' , $cell);
								$time = explode( ':' , $time[0]);

								// 検索バス停と一致するか
								if( $headerName[$kID] == "YCAT" ):

									// 発駅か
									if($headerHatuTyaku[$kID] == "着"):
										$html02 .= "<tr><td style='text-align:left;'>";
										$html02 .= "<p class='routeSearchTbl__label'>".$headerHatuTyaku[$kID]."</p>";
										$html02 .=  "<p class='routeSearchTbl__info'>";
										$html02 .=  "<span>".$headerName[$kID]."</span>";
										$html02 .=  "".$time[0].":".$time[1] ."";
										$html02 .=  "</p>";
										$html02 .= "</td></tr>";
										$searchHit2 = true;
									endif; 
								endif; 


							endforeach;



							if($searchHit && $searchHit2):

								echo "<table class='routeSearchTbl'>";
								echo $html01;
								echo $html02;
								echo "</table>";

								$showTable = true;

							endif; 
						}

					endforeach;


				}	


				?>
		</div>
		<?php endif; ?>

		<?php if( $_GET['searchRoute_id'] != "" && $showTable == false){ ?>
		<div class="content-mini" >
			<p class="txt01">

				以下の条件に該当する内容は見つかりませんでした。<br />

				路　　　線：<?php echo ($_GET['s_rosen'] == "narita") ? "成田空港" : "羽田空港" ; ?><br />
				ターミナル：<?php echo $_GET['s_busstop']; ?><br />
				乗　　　車：<?php echo $_GET['s_time']; ?>時台出発<br />

			</p>
		</div>
		<?php } ?>

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

