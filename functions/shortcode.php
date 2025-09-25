<?php

/*■■■■■■■■■■■■■■■■■■■■■■
 *
 * 自作ショートコード
 *
 *■■■■■■■■■■■■■■■■■■■■■■ */


// ===================================================================
//
// 投稿画面で使用するショートコード
//
// ===================================================================

function tmpdir_shortcode(){ return get_bloginfo('template_url'); }
add_shortcode('tempdir', 'tmpdir_shortcode');

function homedir_shortcode(){ return get_bloginfo('url'); }
add_shortcode('homedir', 'homedir_shortcode');



// ===================================================================
//
// PC - SPのショートコード（囲み形）
//
//
// ■ 利用方法
// [is_PC]ここにPC用のコンテンツを入力[/is_PC]
// [is_SP]ここにPC用のコンテンツを入力[/is_SP]
//
//
// ■ 導入条件：fnc_user_agent() 関数が登録されていること
//
// ===================================================================


function is_PC_shortcode( $atts, $content = null ) {
    if(fnc_user_agent() == "PC") {
        return '' . $content . '';
    } else {
        return '';
    }
}
function is_SP_shortcode( $atts, $content = null ) {
    if(fnc_user_agent() == "SP") {
        return '' . $content . '';
    } else {
        return '';
    }
}
add_shortcode('is_PC', 'is_PC_shortcode');
add_shortcode('is_SP', 'is_SP_shortcode');



// ===================================================================
//
// 当日日付による表示内容を切り替えるのショートコード（囲み形）
//
//
// ■ 利用方法
//
// ◎ 現在の日時を【超えない】場合に表示する内容
//
// [is_dayDiffBaseNotOver "2019/4/24 10:32"]●超えてない●[/is_dayDiffBaseNotOver]
//
//
// ◎ 現在の日時を【超えた】場合に表示する内容
//
// [is_dayDiffBaseOver "2019/4/24 10:32"]●超えた●[/is_dayDiffBaseOver]
//
//
// ↑↑↑↑↑↑↑↑↑
//
// 設定日付によって表示・非表示を切り分ける場合は
// NotOver , Over でそれぞれそろえた日時で揃えてつかうこと
//
//
//
// ■ 導入条件：fnc_day_diff() 関数が登録されていること
//
// ===================================================================

# ◎ 現在の日時を【超えない】場合に表示する内容
function is_dayDiffBaseNotOver_shortcode( $arg , $content = null ) {

	$dateDiff = fnc_day_diff( $arg[0], date('Y-m-d H:i') ) ;

	if( $dateDiff < 0 ):
		return ''. $content . '';
	else:
		return '';
	endif;

}
add_shortcode('is_dayDiffBaseNotOver', 'is_dayDiffBaseNotOver_shortcode');


# ◎ 現在の日時を【超えた】場合に表示する内容
function is_dayDiffBaseOver_shortcode( $arg , $content = null ) {

	$dateDiff = fnc_day_diff( $arg[0], date('Y-m-d H:i') ) ;

	if( $dateDiff < 0 ):
		return '';
	else:
		return ''. $content . '';
	endif;

}
add_shortcode('is_dayDiffBaseOver', 'is_dayDiffBaseOver_shortcode');


// ===================================================================
//
// インフォメーション - 路線情報
//
// ===================================================================
function post_type_INFOROSEN_shortcode($atts) {

	$html = "";

	$atts = shortcode_atts(array(
		"cat" => '',
	),$atts);

	if(  $atts['cat'] <> "" ){



		$args = array(
			'post_type' => 'info',
			'posts_per_page' => -1,
			'tax_query' => array(
				array(
					'taxonomy' => 'info_cat',
					'field' => 'slug',
					'terms' => array(
						$atts['cat']
					),
				),
			),
		);

		$loop = new WP_Query($args);

		if($loop->have_posts()):

		$html .= '<h3 class="tit03">';
		$html .= '	<span class="tit03__ja">お知らせ</span>';
		$html .= '	<span class="tit03__en">Notice</span>';
		$html .= '</h3>';

		$html .= '<div class="infoBox">';
		$html .= '<ul class="infoBox__lst">';
		while ( $loop->have_posts() ) : $loop->the_post();
		$html .= '	<li class="infoBox__lst__item">	';
		$html .= '		<span class="infoBox__lst__item__date">'.get_the_time('Y/m/d').'</span>';
		$html .= '		<span class="infoBox__lst__item__label notice"><span>お知らせ</span></span>';
		$html .= '		<p class="infoBox__lst__item__tit">';
		$html .= '			<a href="'.get_permalink().'">'.get_the_title().'</a>';
		$html .= '		</p>';
		$html .= '	</li>';
		endwhile;
		$html .= '<ul>';
		$html .= '</div>';
		endif;
		wp_reset_query();
	}
	return $html;
}
add_shortcode('post_type_INFOROSEN', 'post_type_INFOROSEN_shortcode');



// ===================================================================
//
// 路線検索フォーム
//
// ===================================================================

function post_type_ROUTESEARCH_shortcode($terms) {

    ob_start();
	get_template_part('include_routeSearch_form');
    $html = ob_get_contents();
    ob_end_clean();

	return $html;
		
}
add_shortcode('post_type_ROUTESEARCH', 'post_type_ROUTESEARCH_shortcode');

##### // ===================================================================
##### //
##### // よくある質問
##### //
##### // ===================================================================
##### 
##### //よくある質問をページターム毎に読み出すショートコード
##### function post_type_QA_shortcode($terms) {
##### 
##### 	// カスタム投稿：よくある質問を引数termsにより設定する
##### 
##### 	$args = array(
##### 	'post_type' => 'qa',
##### 	'posts_per_page' => 5,
##### 	'tax_query' => array( /* カスタム分類 */
##### 			array(
##### 				'taxonomy' => 'qa-cat',
##### 				'field' => 'slug',
##### 				'terms' => $terms,
##### 			)
##### 		)
##### 	);
##### 
##### 	$loop = new WP_Query($args);
##### 	if($loop->have_posts()):
##### 		$html = "";
##### 		while ( $loop->have_posts() ) : $loop->the_post();
##### 			$html .= "<dl>";
##### 			$html .= "<dt>".get_the_title()."</dt>";
##### 			$html .= "<dd>".get_the_content()."</dd>";
##### 			$html .= "</dl>";
##### 		endwhile;
##### 	endif;
##### 
##### 
##### 	if ( ! $loop->have_posts()){ $html = ""; }
##### 	wp_reset_query();
##### 	return $html;
##### 		
##### }
##### add_shortcode('post_type_QA', 'post_type_QA_shortcode');


############## // ===================================================================
############## //
############## // 時刻表を呼び出す
############## //
############## // ===================================================================
############## 
############## function post_type_TIMETABLE_shortcode($terms) {
############## 
############## 	$tabCnt = 0;
############## 	$html = "";
############## 
############## 	// ▼ タブ機能
############## 	if(get_field('timetableRelation')):
############## 
############## 		$isActive = " is-active";
############## 
############## 		//時刻表データの数をカウント
############## 		while(the_repeater_field('timetableRelation')):
############## 			$tabCnt++;
############## 		endwhile;
############## 
############## 		if( $tabCnt > 1 ){
############## 			$html .= '<!--タブ-->';
############## 			$html .= '<ul class="tab-group route">';
############## 
############## 				while(the_repeater_field('timetableRelation')):
############## 					$html .= '	<li class="tab'.$isActive.'"><span style="background-color:'.get_sub_field('timetableRelation_color').'">'.get_sub_field('timetableRelation_title').'</span></li>';
############## 					$isActive = "";
############## 					$tabCnt++;
############## 				endwhile;
############## 
############## 			$html .= '</ul>';
############## 		}
############## 
############## 	endif;
############## 
############## 	// ▼ タブ内コンテンツ
############## 	if(get_field('timetableRelation')):
############## 
############## 		$cnt = 1;
############## 		$isShow = " is-show";
############## 
############## 		$html .= '<!--タブを切り替えて表示するコンテンツ-->';
############## 		$html .= '<div class="panel-group">';
############## 
############## 			while(the_repeater_field('timetableRelation')):
############## 
############## 				//設定した時刻表のIDを取得する
############## 				$timetableID = get_sub_field('timetablerelation_data')->ID;
############## 
############## 				$html .= '	<div class="panel'.$isShow.'">';
############## 
############## 
############## 
############## 				$html .= '		<p class="panel-tit route">';
############## 
############## 				if( get_sub_field('timetableRelation_title') ) {
############## 
############## 					$html .= '			<span class="route__label" style="background-color:'.get_sub_field('timetableRelation_color').'"><span>'.get_sub_field('timetableRelation_title').'</span></span>';
############## 					$html .= '			<span class="route__txt">'.get_the_title().'</span>';
############## 
############## 				} else {
############## 
############## 					$html .= '			<span class="route__txt noTab">'.get_the_title().'</span>';
############## 				}
############## 
############## 				$html .= '		</p>';
############## 
############## 				$html .= '		'. get_Timetable( $timetableID ,$cnt) ; // IDで時刻表を呼び出す関数
############## 
############## 				$html .= '	</div>';
############## 
############## 				$isShow = "";
############## 
############## 				$cnt++;
############## 
############## 			endwhile;
############## 
############## 		$html .= '</div>';
############## 
############## 	endif;
############## 
############## 	wp_reset_postdata();
############## 
############## 	return $html;
############## 		
############## }
############## add_shortcode('post_type_TIMETABLE', 'post_type_TIMETABLE_shortcode');
############## 
############## 
############## /*-------------
############## IDで時刻表を呼び出す関数
############## 
############## ショートコード：post_type_TIMETABLE_shortcode　で利用
############## -------------*/
############## function get_Timetable( $pageID ,$cnt){
############## 
############## 	$html = "";
############## 
##############  	$args = array(
############## 		'post_type' => 'timetable',
############## 		'page_id' => $pageID
##############  	);
############## 
############## 	if( $pageID <> "" ){
############## 
############## 		$loop = new WP_Query($args);
############## 		if($loop->have_posts()):
############## 			$html = "";
############## 			while ( $loop->have_posts() ) : $loop->the_post();
############## 
############## 
############## 			$html .= '<div class="content content-timetabl contentCnt'.$cnt++.'">'."\n";
############## 
############## 
############## 				$busstopCnt =  0;
############## 				if(have_rows('timetable_header')):
############## 					while(have_rows('timetable_header')): the_row();
############## 						$busstopCnt =  count(get_sub_field('timetable_details'));
############## 						$busstopCnt =  sprintf( '%02d' , $busstopCnt );
############## 					endwhile;
############## 				endif;
############## 
############## 
############## 				//echo '<p class="pcOFF slideInfo">← 左右にスライドできます →</p>';
############## 
############## 				if( $busstopCnt >= 7 ) {
############## 					$html .= '<p class="slideInfo pcOFF">← 時刻表は左右にスライドできます →</p>'."\n";
############## 				}
############## 
############## 				$html .= '<div class="timetableBox busstopCnt_'.$busstopCnt.' timetableCnt'.$cnt++.'">'."\n";
############## 					$html .= '<table class="timetableBox__tbl">'."\n";
############## 						$html .= '<caption>'.get_the_title().'</caption>'."\n";
############## 						$html .= '<thead>'."\n";
############## 							$html .= '<tr>'."\n";
############## 								$html .= '<th rowspan="2" class="labelTH">運行<br class="pcOFF" />会社</th>'."\n";
############## 
############## 								if(have_rows('timetable_header')):
############## 									while(have_rows('timetable_header')): the_row();
############## 										foreach( get_sub_field('timetable_details') as $k => $v):
############## 
############## 											if( $v['timetable_busstop_hattyaku'] == "発"):
############## 												$hattyaku = "hatu";
############## 											else: 
############## 												$hattyaku = "tyaku";
############## 											endif;
############## 
############## 											$html .= '<th class="'.$hattyaku.'">'."\n";
############## 
############## 												$linktrue =  ($v['timetable_busstop_lnk'] != "") ? " class='linktrue'" : ""; 
############## 
############## 												$html .= '<p'.$linktrue.'>'."\n";
############## 												if( $v['timetable_busstop_txt'] <> "" ) : 
############## 													$html .= $v['timetable_busstop_txt'];
############## 												else : 
############## 													$html .= $v['timetable_busstop']->name;
############## 												endif;
############## 												$html .= '</p>'."\n";
############## 
############## 												if( $v['timetable_busstop_lnk'] != ""):
############## 													$html .= '<a href="'.$v['timetable_busstop_lnk'].'">のりば</a>'."\n";
############## 												endif;	
############## 
############## 											$html .= '</th>'."\n";
############## 										endforeach;
############## 
############## 									endwhile;
############## 								endif;
############## 
############## 							$html .= '</tr>'."\n";
############## 							$html .= '<tr class="thead_hattyaku">'."\n";
############## 								//echo '<th>&nbsp;</th>';
############## 
############## 								if(have_rows('timetable_header')):
############## 									while(have_rows('timetable_header')): the_row();
############## 										foreach( get_sub_field('timetable_details') as $k => $v):
############## 											if( $v['timetable_busstop_hattyaku'] == "発"):
############## 												$hattyaku = "hatu";
############## 											else: 
############## 												$hattyaku = "tyaku";
############## 											endif;
############## 											$html .= '<th class="'.$hattyaku.'">'."\n";
############## 													$html .= $v['timetable_busstop_hattyaku'];
############## 											$html .= '</th>'."\n";
############## 										endforeach;
############## 
############## 									endwhile;
############## 								endif;
############## 
############## 							$html .= '</tr>'."\n";
############## 
############## 						$html .= '</thead>'."\n";
############## 						$html .= '<tbody>'."\n";
############## 
############## 							if(have_rows('timetable')):
############## 								while(have_rows('timetable')): the_row();
############## 								$html .= '<tr>'."\n";
############## 									$html .= '<td class="timetableBox__tbl__company">'.get_sub_field('timetable_buscompany').'</td>'."\n";
############## 									foreach( get_sub_field('timetable_details') as $k => $v):
############## 										$html .= '<td class="timetableBox__tbl__info">'."\n";
############## 											// -------------------------------------
############## 
############## 											$startend = $v['timetable_startend'];
############## 
############## 											$html .= '<p class="timetableBox__tbl__info__name"><span>'.$v['timetable_busstop']->name."</span></p>"."\n";
############## 
############## 											$html .= '<p class="timetableBox__tbl__info__data"><span>'."\n";
############## 												if( $startend == "発" || $startend == "着" ) :
############## 													$html .= ''. $v['timetable_hour'] . ":" .$v['timetable_minutes'] ."";
############## 												elseif( $startend == "通過" ) :
############## 													$html .= '》';
############## 												elseif( $startend == "発着無" ) :
############## 													$html .= '―';
############## 												endif;
############## 											$html .= '</p></span>'."\n";
############## 
############## 											if( $v['timetable_notemark'] <> ""):
############## 												$html .= '<p class="timetableBox__tbl__info__mark" style="color:#fc8000;">'.$v['timetable_notemark']."</p>"."\n";
############## 											endif; 
############## 
############## 											// -------------------------------------
############## 										$html .= '</td>'."\n";
############## 									endforeach;
############## 								$html .= '</tr>'."\n";
############## 								endwhile;
############## 							endif;
############## 						$html .= '</tbody>'."\n";
############## 
############## 					$html .= '</table>'."\n";
############## 				$html .= '</div>'."\n";
############## 			$html .= '</div>'."\n";
############## 
############## 		endwhile; endif;
############## 
############## 		wp_reset_query();
############## 	}
############## 	return $html;
############## 
############## }
############## 
############## /*-------------
############## 時刻表を呼び出す関数( 時刻表設定画面の確認画面用 )
############## -------------*/
############## function get_Timetable2(){
############## 
############## 	$html = "";
############## 
############## 
############## 
############## 			$html .= '<div class="content content-timetabl contentCnt'.$cnt++.'">'."\n";
############## 
############## 
############## 				$busstopCnt =  0;
############## 				if(have_rows('timetable_header')):
############## 					while(have_rows('timetable_header')): the_row();
############## 						$busstopCnt =  count(get_sub_field('timetable_details'));
############## 						$busstopCnt =  sprintf( '%02d' , $busstopCnt );
############## 					endwhile;
############## 				endif;
############## 
############## 
############## 				//echo '<p class="pcOFF slideInfo">← 左右にスライドできます →</p>';
############## 
############## 				if( $busstopCnt >= 7 ) {
############## 					$html .= '<p class="slideInfo pcOFF">← 時刻表は左右にスライドできます →</p>'."\n";
############## 				}
############## 
############## 				$html .= '<div class="timetableBox busstopCnt_'.$busstopCnt.' timetableCnt'.$cnt++.'">'."\n";
############## 					$html .= '<table class="timetableBox__tbl">'."\n";
############## 						$html .= '<caption>'.get_the_title().'</caption>'."\n";
############## 						$html .= '<thead>'."\n";
############## 							$html .= '<tr>'."\n";
############## 								$html .= '<th rowspan="2" class="labelTH">運行<br class="pcOFF" />会社</th>'."\n";
############## 
############## 								if(have_rows('timetable_header')):
############## 									while(have_rows('timetable_header')): the_row();
############## 										foreach( get_sub_field('timetable_details') as $k => $v):
############## 
############## 											if( $v['timetable_busstop_hattyaku'] == "発"):
############## 												$hattyaku = "hatu";
############## 											else: 
############## 												$hattyaku = "tyaku";
############## 											endif;
############## 
############## 											$html .= '<th class="'.$hattyaku.'">'."\n";
############## 
############## 												$linktrue =  ($v['timetable_busstop_lnk'] != "") ? " class='linktrue'" : ""; 
############## 
############## 												$html .= '<p'.$linktrue.'>'."\n";
############## 												if( $v['timetable_busstop_txt'] <> "" ) : 
############## 													$html .= $v['timetable_busstop_txt'];
############## 												else : 
############## 													$html .= $v['timetable_busstop']->name;
############## 												endif;
############## 												$html .= '</p>'."\n";
############## 
############## 												if( $v['timetable_busstop_lnk'] != ""):
############## 													$html .= '<a href="'.$v['timetable_busstop_lnk'].'">のりば</a>'."\n";
############## 												endif;	
############## 
############## 											$html .= '</th>'."\n";
############## 										endforeach;
############## 
############## 									endwhile;
############## 								endif;
############## 
############## 							$html .= '</tr>'."\n";
############## 							$html .= '<tr class="thead_hattyaku">'."\n";
############## 								//echo '<th>&nbsp;</th>';
############## 
############## 								if(have_rows('timetable_header')):
############## 									while(have_rows('timetable_header')): the_row();
############## 										foreach( get_sub_field('timetable_details') as $k => $v):
############## 											if( $v['timetable_busstop_hattyaku'] == "発"):
############## 												$hattyaku = "hatu";
############## 											else: 
############## 												$hattyaku = "tyaku";
############## 											endif;
############## 											$html .= '<th class="'.$hattyaku.'">'."\n";
############## 													$html .= $v['timetable_busstop_hattyaku'];
############## 											$html .= '</th>'."\n";
############## 										endforeach;
############## 
############## 									endwhile;
############## 								endif;
############## 
############## 							$html .= '</tr>'."\n";
############## 
############## 						$html .= '</thead>'."\n";
############## 						$html .= '<tbody>'."\n";
############## 
############## 							if(have_rows('timetable')):
############## 								while(have_rows('timetable')): the_row();
############## 								$html .= '<tr>'."\n";
############## 									$html .= '<td class="timetableBox__tbl__company">'.get_sub_field('timetable_buscompany').'</td>'."\n";
############## 									foreach( get_sub_field('timetable_details') as $k => $v):
############## 										$html .= '<td class="timetableBox__tbl__info">'."\n";
############## 											// -------------------------------------
############## 
############## 											$startend = $v['timetable_startend'];
############## 
############## 											$html .= '<p class="timetableBox__tbl__info__name"><span>'.$v['timetable_busstop']->name."</span></p>"."\n";
############## 
############## 											$html .= '<p class="timetableBox__tbl__info__data"><span>'."\n";
############## 												if( $startend == "発" || $startend == "着" ) :
############## 													$html .= ''. $v['timetable_hour'] . ":" .$v['timetable_minutes'] ."";
############## 												elseif( $startend == "通過" ) :
############## 													$html .= '》';
############## 												elseif( $startend == "発着無" ) :
############## 													$html .= '―';
############## 												endif;
############## 											$html .= '</p></span>'."\n";
############## 
############## 											if( $v['timetable_notemark'] <> ""):
############## 												$html .= '<p class="timetableBox__tbl__info__mark" style="color:#fc8000;">'.$v['timetable_notemark']."</p>"."\n";
############## 											endif; 
############## 
############## 											// -------------------------------------
############## 										$html .= '</td>'."\n";
############## 									endforeach;
############## 								$html .= '</tr>'."\n";
############## 								endwhile;
############## 							endif;
############## 						$html .= '</tbody>'."\n";
############## 
############## 					$html .= '</table>'."\n";
############## 				$html .= '</div>'."\n";
############## 			$html .= '</div>'."\n";
############## 
############## 
############## 	return $html;
############## 
############## }
############## 
############## /*-------------
############## IDで時刻表を呼び出す関数
############## -------------*/
############## function get_Timetable3(){
############## 
############## 	$html = "";
############## 
############## 
############## 	$html .= '<table class="timetableBox__tbl">'."\n";
############## 		$html .= '<caption>'.get_the_title().'</caption>'."\n";
############## 		$html .= '<thead>'."\n";
############## 			$html .= '<tr>'."\n";
############## 				$html .= '<th rowspan="2" class="labelTH">運行<br class="pcOFF" />会社</th>'."\n";
############## 
############## 				if(have_rows('timetable_header')):
############## 					while(have_rows('timetable_header')): the_row();
############## 						foreach( get_sub_field('timetable_details') as $k => $v):
############## 
############## 							if( $v['timetable_busstop_hattyaku'] == "発"):
############## 								$hattyaku = "hatu";
############## 							else: 
############## 								$hattyaku = "tyaku";
############## 							endif;
############## 
############## 							$html .= '<th class="'.$hattyaku.'">'."\n";
############## 
############## 								$linktrue =  ($v['timetable_busstop_lnk'] != "") ? " class='linktrue'" : ""; 
############## 
############## 								$html .= '<p'.$linktrue.'>'."\n";
############## 								if( $v['timetable_busstop_txt'] <> "" ) : 
############## 									$html .= $v['timetable_busstop_txt'];
############## 								else : 
############## 									$html .= $v['timetable_busstop']->name;
############## 								endif;
############## 								$html .= '</p>'."\n";
############## 
############## 								if( $v['timetable_busstop_lnk'] != ""):
############## 									$html .= '<a href="'.$v['timetable_busstop_lnk'].'">のりば</a>'."\n";
############## 								endif;	
############## 
############## 							$html .= '</th>'."\n";
############## 						endforeach;
############## 
############## 					endwhile;
############## 				endif;
############## 
############## 			$html .= '</tr>'."\n";
############## 			$html .= '<tr class="thead_hattyaku">'."\n";
############## 				//echo '<th>&nbsp;</th>';
############## 
############## 				if(have_rows('timetable_header')):
############## 					while(have_rows('timetable_header')): the_row();
############## 						foreach( get_sub_field('timetable_details') as $k => $v):
############## 							if( $v['timetable_busstop_hattyaku'] == "発"):
############## 								$hattyaku = "hatu";
############## 							else: 
############## 								$hattyaku = "tyaku";
############## 							endif;
############## 							$html .= '<th class="'.$hattyaku.'">'."\n";
############## 									$html .= $v['timetable_busstop_hattyaku'];
############## 							$html .= '</th>'."\n";
############## 						endforeach;
############## 
############## 					endwhile;
############## 				endif;
############## 
############## 			$html .= '</tr>'."\n";
############## 
############## 		$html .= '</thead>'."\n";
############## 		$html .= '<tbody>'."\n";
############## 
############## 			if(have_rows('timetable')):
############## 				while(have_rows('timetable')): the_row();
############## 				$html .= '<tr>'."\n";
############## 					$html .= '<td class="timetableBox__tbl__company">'.get_sub_field('timetable_buscompany').'</td>'."\n";
############## 					foreach( get_sub_field('timetable_details') as $k => $v):
############## 						$html .= '<td class="timetableBox__tbl__info">'."\n";
############## 							// -------------------------------------
############## 
############## 							$startend = $v['timetable_startend'];
############## 
############## 							$html .= '<p class="timetableBox__tbl__info__name"><span>'.$v['timetable_busstop']->name."</span></p>"."\n";
############## 
############## 							$html .= '<p class="timetableBox__tbl__info__data"><span>'."\n";
############## 								if( $startend == "発" || $startend == "着" ) :
############## 									$html .= ''. $v['timetable_hour'] . ":" .$v['timetable_minutes'] ."";
############## 								elseif( $startend == "通過" ) :
############## 									$html .= '》';
############## 								elseif( $startend == "発着無" ) :
############## 									$html .= '―';
############## 								endif;
############## 							$html .= '</p></span>'."\n";
############## 
############## 							if( $v['timetable_notemark'] <> ""):
############## 								$html .= '<p class="timetableBox__tbl__info__mark" style="color:#fc8000;">'.$v['timetable_notemark']."</p>"."\n";
############## 							endif; 
############## 
############## 							// -------------------------------------
############## 						$html .= '</td>'."\n";
############## 					endforeach;
############## 				$html .= '</tr>'."\n";
############## 				endwhile;
############## 			endif;
############## 		$html .= '</tbody>'."\n";
############## 
############## 	$html .= '</table>'."\n";
############## 
############## 	return $html;
############## 
############## }
############## 
############## 
############## // ===================================================================
############## //
############## // 時刻表をPDFを呼び出す
############## //
############## // ===================================================================
############## function post_type_TIMETABLEPDF_shortcode($terms) {
############## 
############## 	$showPDF = false;
############## 
############## 	if(have_rows('timetablepdf')):
############## 	$html .= '<div class="routePdf">' . "\n";
############## 	$html .= '	<p class="routePdf__tit">時刻表（PDF）の<br class="pcOFF" />ダウンロードはこちらから</p>'. "\n";
############## 	while(have_rows('timetablepdf')): the_row();
############## 
############## 		if( get_sub_field('timetablepdf_disp') == "表示する" ){
############## 			$html .= '<p class="routePdf__btn"><a href="'.get_sub_field('timetablepdf_file').'" target="_blank"><span>'.get_sub_field('timetablepdf_title').'</span></a></p>' ."\n";
############## 			$showPDF = true;
############## 		}
############## 		
############## 	endwhile;
############## 	$html .= '</div>'."\n";
############## 	endif;
############## 
############## 
############## 	if( ! $showPDF ){
############## 		$html = "";
############## 	}
############## 
############## 	return $html;
############## 		
############## }
############## add_shortcode('post_type_TIMETABLEPDF', 'post_type_TIMETABLEPDF_shortcode');

// ===================================================================
//
// 時刻表単一呼び出し
//
// ===================================================================

function post_type_TIMETABLE_SINGLE_shortcode($atts) {

	$html = "";

	$atts = shortcode_atts(array(
		"category" => '',
	),$atts);

	$html = get_Timetable($atts['category']);

	return $html;
		
}
add_shortcode('post_type_TIMETABLE_SINGLE', 'post_type_TIMETABLE_SINGLE_shortcode');



/*-------------
時刻表を呼び出す関数
-------------*/
function get_Timetable( $TERMS , $test = false , $POSTID = "" ){

	$FROM_ycat = false;
	$html = '';


	if( $test == true && $POSTID != "" ) {
		$args = array(
			'post_type' => 'route_busstopfile',
			'posts_per_page' => 1,
			'p' => $POSTID
		);

	} else {

		$args = array(
			'post_type' => 'route_busstopfile',
			'posts_per_page' => 1,
			'orderby' => 'date',
			'order' => 'DESC',
			'tax_query' => array(
				array(
					'taxonomy' => 'route_busstopfile_cat',
					'field' => 'slug',
					'terms' => array(
						$TERMS	
					),
				),
			),
		);

	}

	if (preg_match("/^ycat/", $TERMS)):
		$FROM_ycat = " fromYcat";
	endif;

	$loop = new WP_Query($args);

	if($loop->have_posts()):
	while ( $loop->have_posts() ) : $loop->the_post();


		// ****************************************
		// CSV出力
		// ****************************************

		// ACFに投稿されたCSVファイルを出力
		$csv = get_field('route_busstopfile_csv');
		$filepath = $csv['url'];


		setlocale(LC_ALL, 'ja_JP.UTF-8');
		 
		$data = file_get_contents($filepath);
		$data = mb_convert_encoding($data, 'UTF-8', 'sjis-win');
		$temp = tmpfile();
		$csv  = array();
		 
		fwrite($temp, $data);
		rewind($temp);
		 
		while (($data = fgetcsv($temp, 0, ",")) !== FALSE) {
			$csv[] = $data;
		}
		fclose($temp);

		// ========================================
		
		 $headerName = $csv[0];
		 $headerLink = $csv[1];
		 $headerHatuTyaku = $csv[2];

		$html .= '<div class="content content-timetabl'.$FROM_ycat.'">'."\n";

			$busstopCnt =  count($headerName);

			if( $busstopCnt >= 7 ) {
				$html .= '<p class="slideInfo pcOFF">← 時刻表は左右にスライドできます →</p>'."\n";
			}

			$html .=  '<div class="timetableBox busstopCnt_'.$busstopCnt.'">'."\n";
			$html .=  "<table class='timetableBox__tbl colCount_".$busstopCnt."'>\n";
				$html .= "<thead>\n";	
					// ****************************************
					// バス停名 / のりばリンク
					// ****************************************
					$html.= "<tr>\n";	
					$cnt = 1;
					foreach($headerName as $k => $row){


						if( $headerHatuTyaku[$k] == "発" ) {
							$class_hatutyaku = "hatu";
						} elseif( $headerHatuTyaku[$k] == "着" ) {
							$class_hatutyaku = "tyaku";
						}



						if( $cnt == 1){
							$html .= "\t<th rowspan='2' class='unkou'>運行<br />会社</th>\n";
						} else {
							$html .= "\t<th class='".$class_hatutyaku."'>\n";
							if( $headerLink[$k] <> "" ) :
								$html .= '<p class="linktrue">';
								$html .= "\t\t".nl2br($headerName[$k]);
								$html .= '</p>';

								// httpない場合はサイト内のリンクとする
								if( strpos($headerLink[$k], 'http') !== true)   {
									$headerLink[$k] = get_bloginfo("url") ."/".$headerLink[$k];
								} else {
									$headerLink[$k] = $headerLink[$k];
								}

								$html .= '<a href="'.$headerLink[$k].'">のりば</a>';
							else : 
								$html .= '<p>';
								$html .= "\t\t".nl2br($headerName[$k]);
								$html .= '</p>';
							endif;
							$html .= "\t</th>\n";
						}
						$cnt++;
					}
					$html .= "</tr>\n";	
					// ****************************************
					// 発着
					// ****************************************
					$html .= "<tr>\n";	
					$cnt = 1;
					foreach($headerHatuTyaku as $k => $row){
						if( $cnt > 1){
							if( $headerHatuTyaku[$k] == "発" ) {
								$class_hatutyaku = "hatu";
							} elseif( $headerHatuTyaku[$k] == "着" ) {
								$class_hatutyaku = "tyaku";
							}
							$html .= '<th class="'.$class_hatutyaku.'">'."\n";
							$html .= '<p>'.$headerHatuTyaku[$k].'<p>'."\n";
							$html .= "</th>\n";
						}
						$cnt++;
					}
					$html .= "</tr>\n";	
				$html .= "</thead>\n";	
				
				// ****************************************
				// 時刻表本体
				// ****************************************
				$cnt = 1;
				$html .= "<tbody>\n";
				foreach($csv as $row){
					// CSVの3行目以降が時刻表のデータなので3行目から出力する
					if( $cnt > 3 ){
						$tdcnt = 1;
						foreach( $row as $data){
							// データが「|」で配列に変更
							$tdData = explode("|",$data);

							if( $tdcnt == 1 ){
							$html .= '<td class="timetableBox__tbl__info unkou">'."\n";
							} else {
							$html .= '<td class="timetableBox__tbl__info">'."\n";
							}

							$html .= '<p class="timetableBox__tbl__info__data">';
							if( isset($tdData[1]) ){
								$html .= '<span style="color:#fc8000;">'.$tdData[1].'</span>'."\n";
							}
							$html .= '<span>'.$tdData[0].'</span>';
							$html .= '</p>'."\n";

							$html .= "</td>\n";	
							$tdcnt++;
						}
						$html .= "</tr>\n";	
					}
					$cnt++;
				}
				$ntml .= "</tbody>\n";
			$html .= "</table>\n";
			$html .= "</div>\n";
		$html .= "</div>\n";

	endwhile;
	endif;
	wp_reset_query();

	return $html ;
}

// ===================================================================
//
// 時刻表単一呼び出し（幕張メッセ）
//
// ===================================================================

function post_type_TIMETABLE_MAKUHARI_shortcode($atts) {

	$html = "";

	$atts = shortcode_atts(array(
		"category" => '',
	),$atts);

	//$html = get_Timetable_makuhari();
	$html = get_Timetable_makuhari('makuhari');

	return $html;
		
}
add_shortcode('post_type_TIMETABLE_MAKUHARI', 'post_type_TIMETABLE_MAKUHARI_shortcode');



// ===================================================================
//
// 幕張メッセ時刻表ボタン表示
//
// ===================================================================

function is_TIMETABLE_MAKUHARI_shortcode( $atts, $content = null ) {

	$args = array(
		'post_type' => 'route_busstopfile_m',
		'orderby' => 'date',
		'order' => 'DESC',

	);
	$loop = new WP_Query($args);

	//echo $loop->post_count;

	if( $loop->post_count > 0 ){
        return '' . $content . '';
	} else {
        return '';
	}

}
add_shortcode('is_TIMETABLE_MAKUHARI', 'is_TIMETABLE_MAKUHARI_shortcode');


/*-------------
時刻表を呼び出す関数（幕張メッセ）
-------------*/
function get_Timetable_makuhari( $TERMS , $test = false , $POSTID = "" ){

	$FROM_ycat = false;
	$html = '';


	$args = array(
		'post_type' => 'route_busstopfile_m',
		'orderby' => 'date',
		'order' => 'DESC',

	);


	$loop = new WP_Query($args);

	if($loop->have_posts()):
	while ( $loop->have_posts() ) : $loop->the_post();


		// ****************************************
		// CSV出力
		// ****************************************

		// ACFに投稿されたCSVファイルを出力（）  == 時刻表CSV(YCAT->幕張メッセ)
		$csv = get_field('route_busstopfile_csv');
		$filepath = $csv['url'];

		setlocale(LC_ALL, 'ja_JP.UTF-8');
		 
		$data = file_get_contents($filepath);
		$data = mb_convert_encoding($data, 'UTF-8', 'sjis-win');
		$temp = tmpfile();
		$csv  = array();
		 
		fwrite($temp, $data);
		rewind($temp);
		 
		while (($data = fgetcsv($temp, 0, ",")) !== FALSE) {
			$csv[] = $data;
		}
		fclose($temp);
		
		$headerName = $csv[0];
		$headerLink = $csv[1];
		$headerHatuTyaku = $csv[2];


		// ****************************************
		// CSV出力
		// ****************************************

		// ACFに投稿されたCSVファイルを出力（）  == 時刻表CSV(幕張メッセ - YCAT)
		$csv2 = get_field('route_busstopfile_csv_makuhari_ycat');
		$filepath = $csv2['url'];

		setlocale(LC_ALL, 'ja_JP.UTF-8');
		 
		$data = file_get_contents($filepath);
		$data = mb_convert_encoding($data, 'UTF-8', 'sjis-win');
		$temp = tmpfile();
		$csv2  = array();
		 
		fwrite($temp, $data);
		rewind($temp);
		 
		while (($data = fgetcsv($temp, 0, ",")) !== FALSE) {
			$csv2[] = $data;
		}
		fclose($temp);
		
		$headerName2 = $csv2[0];
		$headerLink2 = $csv2[1];
		$headerHatuTyaku2 = $csv2[2];

		// ========================================
		$html .= '<div class="content content-timetabl'.$FROM_ycat.'">'."\n";


			$html .= '<h3 class="tit06">'.get_the_title().'</h3>';
			$html .= '<p class="txt01" style="text-align:right;">'.get_field('route_busstopfile_kaitei').'</p>';

	
			//$busstopCnt =  count($headerName);

			//if( $busstopCnt >= 7 ) {
			//	$html .= '<p class="slideInfo pcOFF">← 時刻表は左右にスライドできます →</p>'."\n";
			//}



			$html .= '<h3 class="tit05">'.get_the_title().'（YCATから幕張メッセ）</h3>';

			//$html .=  '<div class="timetableBox busstopCnt_'.$busstopCnt.'" style="margin-bottom:80px;">'."\n";
			//$html .=  "<table class='timetableBox__tbl colCount_".$busstopCnt."'>\n";
			$html .=  '<div class="timetableBox busstopCnt_2" style="margin-bottom:80px;">'."\n";
			$html .=  "<table class='timetableBox__tbl colCount_2'>\n";
				$html .= "<thead>\n";	
					// ****************************************
					// バス停名 / のりばリンク
					// ****************************************
					$html.= "<tr>\n";	
					$cnt = 1;
					foreach($headerName as $k => $row){


						if( $headerHatuTyaku[$k] == "発" ) {
							$class_hatutyaku = "hatu";
						} elseif( $headerHatuTyaku[$k] == "着" ) {
							$class_hatutyaku = "tyaku";
						}



						if( $cnt == 1){
							$html .= "\t<th rowspan='2' class='unkou'>運行<br />会社</th>\n";
						} else {
							$html .= "\t<th class='".$class_hatutyaku."'>\n";
							if( $headerLink[$k] <> "" ) :
								$html .= '<p class="linktrue">';
								$html .= "\t\t".nl2br($headerName[$k]);
								$html .= '</p>';

								// httpない場合はサイト内のリンクとする
								if( strpos($headerLink[$k], 'http') !== true)   {
									$headerLink[$k] = get_bloginfo("url") ."/".$headerLink[$k];
								} else {
									$headerLink[$k] = $headerLink[$k];
								}

								$html .= '<a href="'.$headerLink[$k].'">のりば</a>';
							else : 
								$html .= '<p>';
								$html .= "\t\t".nl2br($headerName[$k]);
								$html .= '</p>';
							endif;
							$html .= "\t</th>\n";
						}
						$cnt++;
					}
					$html .= "</tr>\n";	
					// ****************************************
					// 発着
					// ****************************************
					$html .= "<tr>\n";	
					$cnt = 1;
					foreach($headerHatuTyaku as $k => $row){
						if( $cnt > 1){
							if( $headerHatuTyaku[$k] == "発" ) {
								$class_hatutyaku = "hatu";
							} elseif( $headerHatuTyaku[$k] == "着" ) {
								$class_hatutyaku = "tyaku";
							}
							$html .= '<th class="'.$class_hatutyaku.'">'."\n";
							$html .= '<p>'.$headerHatuTyaku[$k].'<p>'."\n";
							$html .= "</th>\n";
						}
						$cnt++;
					}
					$html .= "</tr>\n";	
				$html .= "</thead>\n";	
				
				// ****************************************
				// 時刻表本体
				// ****************************************
				$cnt = 1;
				$html .= "<tbody>\n";
				foreach($csv as $row){
					// CSVの3行目以降が時刻表のデータなので3行目から出力する
					if( $cnt > 3 ){
						$tdcnt = 1;
						foreach( $row as $data){
							// データが「|」で配列に変更
							$tdData = explode("|",$data);

							if( $tdcnt == 1 ){
							$html .= '<td class="timetableBox__tbl__info unkou">'."\n";
							} else {
							$html .= '<td class="timetableBox__tbl__info">'."\n";
							}

							$html .= '<p class="timetableBox__tbl__info__data">';
							if( isset($tdData[1]) ){
								$html .= '<span style="color:#fc8000;">'.$tdData[1].'</span>'."\n";
							}
							$html .= '<span>'.$tdData[0].'</span>';
							$html .= '</p>'."\n";

							$html .= "</td>\n";	
							$tdcnt++;
						}
						$html .= "</tr>\n";	
					}
					$cnt++;
				}
				$ntml .= "</tbody>\n";
			$html .= "</table>\n";
			$html .= "</div>\n";




			//$busstopCnt =  count($headerName2);

			//if( $busstopCnt >= 7 ) {
			//	$html .= '<p class="slideInfo pcOFF">← 時刻表は左右にスライドできます →</p>'."\n";
			//}

			$html .= '<h3 class="tit05">'.get_the_title().'（幕張メッセからYCAT）</h3>';
			//$html .=  '<div class="timetableBox busstopCnt_'.$busstopCnt.'" style="margin-bottom:80px;">'."\n";
			//$html .=  "<table class='timetableBox__tbl colCount_".$busstopCnt."'>\n";
			$html .=  '<div class="timetableBox busstopCnt_2" style="margin-bottom:80px;">'."\n";
			$html .=  "<table class='timetableBox__tbl colCount_2'>\n";
				$html .= "<thead>\n";	
					// ****************************************
					// バス停名 / のりばリンク
					// ****************************************
					$html.= "<tr>\n";	
					$cnt = 1;
					foreach($headerName2 as $k => $row){


						if( $headerHatuTyaku2[$k] == "発" ) {
							$class_hatutyaku = "hatu";
						} elseif( $headerHatuTyaku2[$k] == "着" ) {
							$class_hatutyaku = "tyaku";
						}



						if( $cnt == 1){
							$html .= "\t<th rowspan='2' class='unkou'>運行<br />会社</th>\n";
						} else {
							$html .= "\t<th class='".$class_hatutyaku."'>\n";
							if( $headerLink2[$k] <> "" ) :
								$html .= '<p class="linktrue">';
								$html .= "\t\t".nl2br($headerName2[$k]);
								$html .= '</p>';

								// httpない場合はサイト内のリンクとする
								if( strpos($headerLink2[$k], 'http') !== true)   {
									$headerLink2[$k] = get_bloginfo("url") ."/".$headerLink2[$k];
								} else {
									$headerLink2[$k] = $headerLink2[$k];
								}

								$html .= '<a href="'.$headerLink2[$k].'">のりば</a>';
							else : 
								$html .= '<p>';
								$html .= "\t\t".nl2br($headerName2[$k]);
								$html .= '</p>';
							endif;
							$html .= "\t</th>\n";
						}
						$cnt++;
					}
					$html .= "</tr>\n";	
					// ****************************************
					// 発着
					// ****************************************
					$html .= "<tr>\n";	
					$cnt = 1;
					foreach($headerHatuTyaku2 as $k => $row){
						if( $cnt > 1){
							if( $headerHatuTyaku2[$k] == "発" ) {
								$class_hatutyaku = "hatu";
							} elseif( $headerHatuTyaku2[$k] == "着" ) {
								$class_hatutyaku = "tyaku";
							}
							$html .= '<th class="'.$class_hatutyaku.'">'."\n";
							$html .= '<p>'.$headerHatuTyaku2[$k].'<p>'."\n";
							$html .= "</th>\n";
						}
						$cnt++;
					}
					$html .= "</tr>\n";	
				$html .= "</thead>\n";	
				
				// ****************************************
				// 時刻表本体
				// ****************************************
				$cnt = 1;
				$html .= "<tbody>\n";
				foreach($csv2 as $row){
					// CSVの3行目以降が時刻表のデータなので3行目から出力する
					if( $cnt > 3 ){
						$tdcnt = 1;
						foreach( $row as $data){
							// データが「|」で配列に変更
							$tdData = explode("|",$data);

							if( $tdcnt == 1 ){
							$html .= '<td class="timetableBox__tbl__info unkou">'."\n";
							} else {
							$html .= '<td class="timetableBox__tbl__info">'."\n";
							}

							$html .= '<p class="timetableBox__tbl__info__data">';
							if( isset($tdData[1]) ){
								$html .= '<span style="color:#fc8000;">'.$tdData[1].'</span>'."\n";
							}
							$html .= '<span>'.$tdData[0].'</span>';
							$html .= '</p>'."\n";

							$html .= "</td>\n";	
							$tdcnt++;
						}
						$html .= "</tr>\n";	
					}
					$cnt++;
				}
				$ntml .= "</tbody>\n";
			$html .= "</table>\n";
			$html .= "</div>\n";







		$html .= "</div>\n";

	endwhile;
	endif;
	wp_reset_query();

	return $html ;
}



/*-------------
時刻表を呼び出す関数（印刷用）
-------------*/
function get_TimetablePrint( $TERMS , $test = false , $POSTID = "" ){

	$FROM_ycat = false;
	$html = '';

	if( $test == false && $POSTID != "" ) {

		$args = array(
			'post_type' => 'route_busstopfile',
			'posts_per_page' => 1,
			'p' => $POSTID
		);

	} else {

		$args = array(
			'post_type' => 'route_busstopfile',
			'posts_per_page' => 1,
			'orderby' => 'date',
			'order' => 'DESC',
			'tax_query' => array(
				array(
					'taxonomy' => 'route_busstopfile_cat',
					'field' => 'slug',
					'terms' => array(
						$TERMS	
					),
				),
			),
		);

	}

	if (preg_match("/^ycat/", $TERMS)):
		$FROM_ycat = " fromYcat";
	endif;

	$loop = new WP_Query($args);

	if($loop->have_posts()):
	while ( $loop->have_posts() ) : $loop->the_post();

		$kaitei = get_field('route_busstopfile_kaitei');

		// ****************************************
		// CSV出力
		// ****************************************

		// ACFに投稿されたCSVファイルを出力
		$csv = get_field('route_busstopfile_csv');
		$filepath = $csv['url'];


		setlocale(LC_ALL, 'ja_JP.UTF-8');
		 
		$data = file_get_contents($filepath);
		$data = mb_convert_encoding($data, 'UTF-8', 'sjis-win');
		$temp = tmpfile();
		$csv  = array();
		 
		fwrite($temp, $data);
		rewind($temp);
		 
		while (($data = fgetcsv($temp, 0, ",")) !== FALSE) {
			$csv[] = $data;
		}
		fclose($temp);

		// ========================================
		
		 $headerName = $csv[0];
		 $headerLink = $csv[1];
		 $headerHatuTyaku = $csv[2];

			$busstopCnt =  count($headerName);

			$html .= "<p class='kaitei'>".$kaitei."</p>";
			$html .=  "<table class='timetableBox__tbl'>\n";
				$html .= "<thead>\n";	
					// ****************************************
					// バス停名 / のりばリンク
					// ****************************************
					$html.= "<tr>\n";	
					$cnt = 1;
					foreach($headerName as $k => $row){

						if( $cnt == 1){
							$html .= "\t<th rowspan='2'>運行<br />会社</th>\n";
						} else {
							$html .= "\t<th>\n";



							if( $headerLink[$k] <> "" ) :
								$html .= '<p class="linktrue">';
								$html .= "\t\t".nl2br($headerName[$k]);
								$html .= '</p>';

								// httpない場合はサイト内のリンクとする
								if( strpos($headerLink[$k], 'http') !== true)   {
									$headerLink[$k] = get_bloginfo("url") ."/".$headerLink[$k];
								} else {
									$headerLink[$k] = $headerLink[$k];
								}

								$html .= '<a href="'.$headerLink[$k].'">のりば</a>';
							else : 
								$html .= '<p>';
								$html .= "\t\t".nl2br($headerName[$k]);
								$html .= '</p>';
							endif;
							$html .= "\t</th>\n";
						}
						$cnt++;
					}
					$html .= "</tr>\n";	
					// ****************************************
					// 発着
					// ****************************************
					$html .= "<tr>\n";	
					$cnt = 1;
					foreach($headerHatuTyaku as $k => $row){
						if( $cnt > 1){
							if( $headerHatuTyaku[$k] == "発" ) {
								$class_hatutyaku = "hatu";
							} elseif( $headerHatuTyaku[$k] == "着" ) {
								$class_hatutyaku = "tyaku";
							}
							$html .= '<th class="'.$class_hatutyaku.'">'."\n";
							$html .= '<p>'.$headerHatuTyaku[$k].'<p>'."\n";
							$html .= "</th>\n";
						}
						$cnt++;
					}
					$html .= "</tr>\n";	
				$html .= "</thead>\n";	
				
				// ****************************************
				// 時刻表本体
				// ****************************************
				$cnt = 1;
				$html .= "<tbody>\n";
				foreach($csv as $row){
					// CSVの3行目以降が時刻表のデータなので3行目から出力する
					if( $cnt > 3 ){
						$html .= "<tr>\n";	
						foreach( $row as $data){
							// データが「|」で配列に変更
							$tdData = explode("|",$data);
							$html .= '<td class="timetableBox__tbl__info">'."\n";
							$html .= '<p class="timetableBox__tbl__info__data"><span>'.$tdData[0].'</span></p>'."\n";
							if( isset($tdData[1]) ){
								$html .= '<p class="timetableBox__tbl__info__mark" style="color:#fc8000;">'.$tdData[1].'</p>'."\n";
							}
							$html .= "</td>\n";	

						}
						$html .= "</tr>\n";	
					}
					$cnt++;
				}
				$ntml .= "</tbody>\n";
			$html .= "</table>\n";

	endwhile;
	endif;
	wp_reset_query();

	return $html ;
}
/*-------------
時刻表を呼び出す関数（印刷用 プレビュー用）
-------------*/
function get_TimetablePrintPreview( $TERMS , $test = false , $POSTID = "" ){

	$FROM_ycat = false;
	$html = '';


	$args = array(
		'post_type' => 'route_busstopfile',
		'posts_per_page' => 1,
		'orderby' => 'date',
		'order' => 'DESC',
		'page_id' => $_GET['postid'],
		'tax_query' => array(
			array(
				'taxonomy' => 'route_busstopfile_cat',
				'field' => 'slug',
				'terms' => array(
					$TERMS	
				),
			),
		),
	);

	if (preg_match("/^ycat/", $TERMS)):
		$FROM_ycat = " fromYcat";
	endif;

	$loop = new WP_Query($args);

	if($loop->have_posts()):
	while ( $loop->have_posts() ) : $loop->the_post();

		$kaitei = get_field('route_busstopfile_kaitei');

		// ****************************************
		// CSV出力
		// ****************************************

		// ACFに投稿されたCSVファイルを出力
		$csv = get_field('route_busstopfile_csv');
		$filepath = $csv['url'];


		setlocale(LC_ALL, 'ja_JP.UTF-8');
		 
		$data = file_get_contents($filepath);
		$data = mb_convert_encoding($data, 'UTF-8', 'sjis-win');
		$temp = tmpfile();
		$csv  = array();
		 
		fwrite($temp, $data);
		rewind($temp);
		 
		while (($data = fgetcsv($temp, 0, ",")) !== FALSE) {
			$csv[] = $data;
		}
		fclose($temp);

		// ========================================
		
		 $headerName = $csv[0];
		 $headerLink = $csv[1];
		 $headerHatuTyaku = $csv[2];

			$busstopCnt =  count($headerName);

			$html .= "<p class='kaitei'>".$kaitei."</p>";
			$html .=  "<table class='timetableBox__tbl'>\n";
				$html .= "<thead>\n";	
					// ****************************************
					// バス停名 / のりばリンク
					// ****************************************
					$html.= "<tr>\n";	
					$cnt = 1;
					foreach($headerName as $k => $row){

						if( $cnt == 1){
							$html .= "\t<th rowspan='2'>運行<br />会社</th>\n";
						} else {
							$html .= "\t<th>\n";



							if( $headerLink[$k] <> "" ) :
								$html .= '<p class="linktrue">';
								$html .= "\t\t".nl2br($headerName[$k]);
								$html .= '</p>';

								// httpない場合はサイト内のリンクとする
								if( strpos($headerLink[$k], 'http') !== true)   {
									$headerLink[$k] = get_bloginfo("url") ."/".$headerLink[$k];
								} else {
									$headerLink[$k] = $headerLink[$k];
								}

								$html .= '<a href="'.$headerLink[$k].'">のりば</a>';
							else : 
								$html .= '<p>';
								$html .= "\t\t".nl2br($headerName[$k]);
								$html .= '</p>';
							endif;
							$html .= "\t</th>\n";
						}
						$cnt++;
					}
					$html .= "</tr>\n";	
					// ****************************************
					// 発着
					// ****************************************
					$html .= "<tr>\n";	
					$cnt = 1;
					foreach($headerHatuTyaku as $k => $row){
						if( $cnt > 1){
							if( $headerHatuTyaku[$k] == "発" ) {
								$class_hatutyaku = "hatu";
							} elseif( $headerHatuTyaku[$k] == "着" ) {
								$class_hatutyaku = "tyaku";
							}
							$html .= '<th class="'.$class_hatutyaku.'">'."\n";
							$html .= '<p>'.$headerHatuTyaku[$k].'<p>'."\n";
							$html .= "</th>\n";
						}
						$cnt++;
					}
					$html .= "</tr>\n";	
				$html .= "</thead>\n";	
				
				// ****************************************
				// 時刻表本体
				// ****************************************
				$cnt = 1;
				$html .= "<tbody>\n";
				foreach($csv as $row){
					// CSVの3行目以降が時刻表のデータなので3行目から出力する
					if( $cnt > 3 ){

						//先頭列　運行会社あるものだけを表示
						if( $row[0] != "" ):

							$html .= "<tr>\n";	

							foreach( $row as $data){


										// データが「|」で配列に変更
										$tdData = explode("|",$data);
										$html .= '<td class="timetableBox__tbl__info">'."\n";


										$html .= '<p class="timetableBox__tbl__info__data"><span>'.$tdData[0].'</span></p>'."\n";
										if( isset($tdData[1]) ){
											$html .= '<p class="timetableBox__tbl__info__mark" style="color:#fc8000;">'.$tdData[1].'</p>'."\n";
										}


										$html .= "</td>\n";	

								}
							$html .= "</tr>\n";	

						endif;
					}
					$cnt++;
				}
				$ntml .= "</tbody>\n";
			$html .= "</table>\n";

	endwhile;
	endif;
	wp_reset_query();

	return $html ;
}

/*-------------
時刻表を呼び出す関数（時刻表検索用）
-------------*/
function get_TimetableSearchData( $TERMS , $test = false , $POSTID = "" ){

	$FROM_ycat = false;

	if( $test == false && $POSTID != "" ) {

		$args = array(
			'post_type' => 'route_busstopfile',
			'posts_per_page' => 1,
			'p' => $POSTID
		);

	} else {

		$args = array(
			'post_type' => 'route_busstopfile',
			'posts_per_page' => 1,
			'orderby' => 'date',
			'order' => 'DESC',
			'tax_query' => array(
				array(
					'taxonomy' => 'route_busstopfile_cat',
					'field' => 'slug',
					'terms' => array(
						$TERMS	
					),
				),
			),
		);

	}

	if (preg_match("/^ycat/", $TERMS)):
		$FROM_ycat = " fromYcat";
	endif;

	$loop = new WP_Query($args);

	if($loop->have_posts()):
	while ( $loop->have_posts() ) : $loop->the_post();


		// ****************************************
		// CSV出力
		// ****************************************

		// ACFに投稿されたCSVファイルを出力
		$csv = get_field('route_busstopfile_csv');
		$filepath = $csv['url'];


		setlocale(LC_ALL, 'ja_JP.UTF-8');
		 
		$data = file_get_contents($filepath);
		$data = mb_convert_encoding($data, 'UTF-8', 'sjis-win');
		$temp = tmpfile();
		$csv  = array();
		 
		fwrite($temp, $data);
		rewind($temp);
		 
		while (($data = fgetcsv($temp, 0, ",")) !== FALSE) {
			$csv[] = $data;
		}
		fclose($temp);

		// ========================================
		
		 $headerName = $csv[0];
		 $headerLink = $csv[1];
		 $headerHatuTyaku = $csv[2];

		 $GETDATA['headerName']   = $headerName;
		 $GETDATA['headerHatuTyaku'] = $headerHatuTyaku;


		// ****************************************
		// 時刻表本体
		// ****************************************

		$cnt = 1;
		foreach($csv as $row){
			// CSVの3行目以降が時刻表のデータなので3行目から出力する
			if( $cnt > 3 ){

				//foreach( $row as $data):
				//	// データが「|」で配列に変更
				//	//$tdData = explode("|",$data);
				//	//$GETDATA['body'][] = $tdData[0];
				//endforeach;	

				$GETDATA['timedata'][] = $row;

			}
			$cnt++;
		}

	endwhile;
	endif;
	wp_reset_query();

	return $GETDATA;
}

// ===================================================================
//
// 時刻表をPDFを呼び出す
//
// ===================================================================
function post_type_TIMETABLEPDF_shortcode($terms) {

	//$showPDF = false;

	//if(have_rows('timetablepdf')):
	//$html .= '<div class="routePdf">' . "\n";
	//$html .= '	<p class="routePdf__tit">時刻表（PDF）の<br class="pcOFF" />ダウンロードはこちらから</p>'. "\n";
	//while(have_rows('timetablepdf')): the_row();

	//	if( get_sub_field('timetablepdf_disp') == "表示する" ){
	//		$html .= '<p class="routePdf__btn"><a href="'.get_sub_field('timetablepdf_file').'" target="_blank"><span>'.get_sub_field('timetablepdf_title').'</span></a></p>' ."\n";
	//		$showPDF = true;
	//	}
	//	
	//endwhile;
	//$html .= '</div>'."\n";
	//endif;


	//if( ! $showPDF ){
	//	$html = "";
	//}

	$html .= do_shortcode('[post_type_TIMETABLEPRINTCSV]');

	return $html;
		
}
add_shortcode('post_type_TIMETABLEPDF', 'post_type_TIMETABLEPDF_shortcode');

// ===================================================================
//
// 時刻表印刷ボタン制御
//
// ===================================================================
function post_type_TIMETABLEPRINTCSV_shortcode($terms) {

	global $post;
	$slug = $post->post_name;

	$html = "";


	$html .= '<div class="routePdf">';
	//$html .= 	'<p class="routePdf__tit">時刻表の<br class="pcOFF">印刷はこちらから</p>';
	$html .= 	'<p class="routePdf__btn">';
	$html .= 		'<a href="javascript:void(0)" id="printBtn01">'.get_the_title().'<br />時刻表の印刷はこちら</a>';
	$html .= 		'</p>';
	$html .= '</div>';

	//$html .= '<p style="text-align:center;margin:100px 0;"><button id="printBtn01" class="printBtn" style="padding:20px 80px;">時刻表の印刷はこちら</button></p>';
	$html .= '<script>'."\n";
	$html .= 'printURL = "";'."\n";
	$html .= 'printURL = printURL + "'.get_bloginfo('url').'";'."\n";
	$html .= 'printURL = printURL + "/print/?";'."\n";

	switch( $slug ):

	// ****************************************
	// 成田空港　（成田空港 ⇒ YCAT）
	// ****************************************
	case  'narita2ycat': 
		$html .= 'printURL = printURL + "slug[0]=narita2ycat";'."\n";
		$html .= 'printURL = printURL + "&tit[0]=成田空港からYCAT";'."\n";
		$html .= 'printURL = printURL + "&flag=";'."\n";
		break;

	// ****************************************
	// 成田空港　（YCAT ⇒ 成田空港）
	// ****************************************
	case  'ycat2narita': 
		$html .= 'printURL = printURL + "slug[0]=ycat2narita";'."\n";
		$html .= 'printURL = printURL + "&tit[0]=YCATから成田空港";'."\n";
		$html .= 'printURL = printURL + "&flag=";'."\n";
		break;

	// ****************************************
	// 羽田空港　（YCAT ⇒ 羽田空港）
	// ****************************************
	case  'ycat2haneda': 
		//$html .= 'printURL = printURL + "slug[0]=ycat2haneda";'."\n";
		//$html .= 'printURL = printURL + "&tit[0]=YCATから羽田空港";'."\n";
		//$html .= 'printURL = printURL + "&flag=";'."\n";
		//break;

		// 平日・土日祝のカテゴリーに変わったため変更（2023/03/01）
		$html .= 'printURL = printURL + "slug[0]=ycat2haneda_heijitu";'."\n";
		$html .= 'printURL = printURL + "&slug[1]=ycat2haneda_donitisyuku";'."\n";
		$html .= 'printURL = printURL + "&tit[0]=YCAT⇒羽田空港（平日）";'."\n";
		$html .= 'printURL = printURL + "&tit[1]=YCAT⇒羽田空港（土日祝）";'."\n";
		$html .= 'printURL = printURL + "&flag=";'."\n";


		break;

	// ****************************************
	// 羽田空港　（羽田空港 ⇒ YCAT）
	// ****************************************
	case  'haneda2ycat': 
		//$html .= 'printURL = printURL + "slug[0]=haneda2ycat";'."\n";
		//$html .= 'printURL = printURL + "&tit[0]=羽田空港からYCAT";'."\n";
		//$html .= 'printURL = printURL + "&flag=";'."\n";

		// 平日・土日祝のカテゴリーに変わったため変更（2023/03/01）
		$html .= 'printURL = printURL + "slug[0]=haneda2ycat_heijitsu";'."\n";
		$html .= 'printURL = printURL + "&slug[1]=haneda2ycat_donichishuku";'."\n";
		$html .= 'printURL = printURL + "&tit[0]=羽田空港⇒YCAT（平日）";'."\n";
		$html .= 'printURL = printURL + "&tit[1]=羽田空港⇒YCAT（土日祝）";'."\n";
		$html .= 'printURL = printURL + "&flag=";'."\n";

		break;

	// ****************************************
	// お台場　（YCAT ⇒ お台場）
	// ****************************************
	case  'ycat2daiba': 
		$html .= 'printURL = printURL + "slug[0]=ycat2daiba_heijitu";'."\n";
		$html .= 'printURL = printURL + "&tit[0]=YCATからお台場";'."\n";
		$html .= 'printURL = printURL + "&flag=";'."\n";
		break;

	// ****************************************
	// お台場　（お台場 ⇒ YCAT）
	// ****************************************
	case  'daiba2ycat': 
		$html .= 'printURL = printURL + "slug[0]=daiba2ycat_heijitu";'."\n";
		$html .= 'printURL = printURL + "&tit[0]=お台場からYCAT";'."\n";
		$html .= 'printURL = printURL + "&flag=";'."\n";
		break;

	// ****************************************
	// お台場　（お台場 ⇒ YCAT）
	// ****************************************
	case  'daiba2ycat': 
		$html .= 'printURL = printURL + "slug[0]=daiba2ycat_heijitu";'."\n";
		$html .= 'printURL = printURL + "&tit[0]=お台場からYCAT";'."\n";
		$html .= 'printURL = printURL + "&flag=";'."\n";
		break;

	// ****************************************
	// 東扇島　（YCAT ⇒ 東扇島）
	// ****************************************
	case 'ycat2higashiohgishima':


		//$html .= 'printURL = printURL + "slug[0]=ycat2higashiohgishima_heijitu";'."\n";
		//$html .= 'printURL = printURL + "&slug[1]=ycat2higashiohgishima_doyou";'."\n";
		//$html .= 'printURL = printURL + "&slug[2]=ycat2higashiohgishima_nichisyuku";'."\n";
		//$html .= 'printURL = printURL + "&tit[0]=YCATから東扇島(平日)";'."\n";
		//$html .= 'printURL = printURL + "&tit[1]=YCATから東扇島(土)";'."\n";
		//$html .= 'printURL = printURL + "&tit[2]=YCATから東扇島(日祝)";'."\n";
		//$html .= 'printURL = printURL + "&flag=";'."\n";

		// 2021年11月22日のよるに下記に切り替える ↑　はコメントアウト(削除してもOK）

		$html .= 'printURL = printURL + "slug[0]=ycat2higashiohgishima_heijitu";'."\n";
		$html .= 'printURL = printURL + "&slug[1]=ycat2higashiohgishima_doyou";'."\n";
		$html .= 'printURL = printURL + "&slug[2]=ycat2higashiohgishima_nichi";'."\n";
		$html .= 'printURL = printURL + "&slug[3]=ycat2higashiohgishima_syuku";'."\n";
		$html .= 'printURL = printURL + "&tit[0]=YCATから東扇島(平日)";'."\n";
		$html .= 'printURL = printURL + "&tit[1]=YCATから東扇島(土)";'."\n";
		$html .= 'printURL = printURL + "&tit[2]=YCATから東扇島(日)";'."\n";
		$html .= 'printURL = printURL + "&tit[3]=YCATから東扇島(祝日)";'."\n";
		$html .= 'printURL = printURL + "&flag=";'."\n";


		break;

	// ****************************************
	// 東扇島　（東扇島 ⇒ YCAT）
	// ****************************************
	case 'higashiohgishima2ycat':
		//$html .= 'printURL = printURL + "slug[0]=higashiohgishima2ycat_heijitu";'."\n";
		//$html .= 'printURL = printURL + "&slug[1]=higashiohgishima2ycat_doyou";'."\n";
		//$html .= 'printURL = printURL + "&slug[2]=higashiohgishima2ycat_nichisyuku";'."\n";
		//$html .= 'printURL = printURL + "&tit[0]=東扇島からYCAT(平日)";'."\n";
		//$html .= 'printURL = printURL + "&tit[1]=東扇島からYCAT(土)";'."\n";
		//$html .= 'printURL = printURL + "&tit[2]=東扇島からYCAT(日祝)";'."\n";
		//$html .= 'printURL = printURL + "&flag=";'."\n";

		// 2021年11月22日のよるに下記に切り替える ↑　はコメントアウト(削除してもOK）

		$html .= 'printURL = printURL + "slug[0]=higashiohgishima2ycat_heijitu";'."\n";
		$html .= 'printURL = printURL + "&slug[1]=higashiohgishima2ycat_doyou";'."\n";
		$html .= 'printURL = printURL + "&slug[2]=higashiohgishima2ycat_nichi";'."\n";
		$html .= 'printURL = printURL + "&slug[3]=higashiohgishima2ycat_syuku";'."\n";
		$html .= 'printURL = printURL + "&tit[0]=東扇島からYCAT(平日)";'."\n";
		$html .= 'printURL = printURL + "&tit[1]=東扇島からYCAT(土)";'."\n";
		$html .= 'printURL = printURL + "&tit[2]=東扇島からYCAT(日)";'."\n";
		$html .= 'printURL = printURL + "&tit[3]=東扇島からYCAT(祝日)";'."\n";
		$html .= 'printURL = printURL + "&flag=";'."\n";

		break;

	// ****************************************
	// 葉山・横須賀西地区（YCAT ⇒ 葉山・横須賀西地区）
	// ****************************************
	case 'ycat2yokosuka':
		$html .= 'printURL = printURL + "slug[0]=ycat2yokosuka_heijitu";'."\n";
		$html .= 'printURL = printURL + "&slug[1]=ycat2yokosuka_donichisyuku";'."\n";
		$html .= 'printURL = printURL + "&tit[0]=YCATから葉山・横須賀西地区(平日)";'."\n";
		$html .= 'printURL = printURL + "&tit[1]=YCATから葉山・横須賀西地区(土日祝)";'."\n";
		$html .= 'printURL = printURL + "&flag=";'."\n";
		break;

	// ****************************************
	// 葉山・横須賀西地区（葉山・横須賀西地区 ⇒ YCAT）
	// ****************************************
	case 'yokosuka2ycat':
		$html .= 'printURL = printURL + "slug[0]=yokosuka2ycat_heijitu";'."\n";
		$html .= 'printURL = printURL + "&slug[1]=yokosuka2ycat_donichisyuku";'."\n";
		$html .= 'printURL = printURL + "&tit[0]=葉山・横須賀西地区からYCAT(平日)";'."\n";
		$html .= 'printURL = printURL + "&tit[1]=葉山・横須賀西地区からYCAT(土日祝)";'."\n";
		$html .= 'printURL = printURL + "&flag=";'."\n";
		break;

	// ****************************************
	// 横浜・八景島シーパラダイス（YCAT ⇒ 横浜・八景島シーパラダイス）
	// ****************************************
	case 'ycat2seaparadise':
		$html .= 'printURL = printURL + "slug[0]=ycat2seaparadise_heijitu";'."\n";
		$html .= 'printURL = printURL + "&slug[1]=ycat2seaparadise_donichisyuku";'."\n";
		$html .= 'printURL = printURL + "&tit[0]=YCATから横浜・八景島シーパラダイス(平日)";'."\n";
		$html .= 'printURL = printURL + "&tit[1]=YCATから横浜・八景島シーパラダイス(土日祝)";'."\n";
		$html .= 'printURL = printURL + "&flag=";'."\n";
		break;

	// ****************************************
	// 横浜・八景島シーパラダイス（横浜・八景島シーパラダイス ⇒ YCAT）
	// ****************************************
	case 'seaparadise2ycat':
		$html .= 'printURL = printURL + "slug[0]=seaparadise2ycat_heijitu";'."\n";
		$html .= 'printURL = printURL + "&slug[1]=seaparadise2ycat_donichisyuku";'."\n";
		$html .= 'printURL = printURL + "&tit[0]=横浜・八景島シーパラダイスからYCAT(平日)";'."\n";
		$html .= 'printURL = printURL + "&tit[1]=横浜・八景島シーパラダイスからYCAT(土日祝)";'."\n";
		$html .= 'printURL = printURL + "&flag=";'."\n";
		break;

	endswitch;


	//// 2021年11月22日以降は不要なので削除　START --

	//if( $_GET['p'] == "1915" ){
	//	$html .= 'printURL = printURL + "slug[0]=ycat2higashiohgishima_heijitu";'."\n";
	//	$html .= 'printURL = printURL + "&slug[1]=ycat2higashiohgishima_doyou";'."\n";
	//	$html .= 'printURL = printURL + "&slug[2]=ycat2higashiohgishima_nichi";'."\n";
	//	$html .= 'printURL = printURL + "&slug[3]=ycat2higashiohgishima_syuku";'."\n";
	//	$html .= 'printURL = printURL + "&tit[0]=YCATから__東扇島(平日)";'."\n";
	//	$html .= 'printURL = printURL + "&tit[1]=YCATから__東扇島(土)";'."\n";
	//	$html .= 'printURL = printURL + "&tit[2]=YCATから__東扇島(日)";'."\n";
	//	$html .= 'printURL = printURL + "&tit[3]=YCATから__東扇島(祝日)";'."\n";
	//	$html .= 'printURL = printURL + "&flag=";'."\n";

	//} elseif ( $_GET['p'] == "1922" ){

	//	$html .= 'printURL = printURL + "slug[0]=higashiohgishima2ycat_heijitu";'."\n";
	//	$html .= 'printURL = printURL + "&slug[1]=higashiohgishima2ycat_doyou";'."\n";
	//	$html .= 'printURL = printURL + "&slug[2]=higashiohgishima2ycat_nichi";'."\n";
	//	$html .= 'printURL = printURL + "&slug[3]=higashiohgishima2ycat_syuku";'."\n";
	//	$html .= 'printURL = printURL + "&tit[0]=東扇島からYCAT(平日)";'."\n";
	//	$html .= 'printURL = printURL + "&tit[1]=東扇島からYCAT(土)";'."\n";
	//	$html .= 'printURL = printURL + "&tit[2]=東扇島からYCAT(日)";'."\n";
	//	$html .= 'printURL = printURL + "&tit[3]=東扇島からYCAT(祝日)";'."\n";
	//	$html .= 'printURL = printURL + "&flag=";'."\n";

	//}
	//// 2021年11月22日以降は不要なので削除　END   --


	$html .= '	jQuery(function() {'."\n";
	$html .= '		jQuery("#printBtn01").click(function(){'."\n";
	$html .= "			window.open( printURL ,'route','width=500,toolbar=yes,menubar=yes,scrollbars=yes');"."\n";
	$html .= '			return false;'."\n";
	$html .= '		});'."\n";
	$html .= '	});'."\n";
	$html .= '</script>';

	/* ---------------
	 *
	 * ここで出てくる「 slug[n] 」 は wp管理画面の
	 *
	 * 時刻表CSV -> バスルートカテゴリーに設定されているスラッグ名です
	 * 時刻表CSV -> バスルートカテゴリーに設定されているスラッグ名です
	 *
	 *
	 *
	$html .= 'printURL = printURL + "slug[0]=ycat2higashiohgishima_heijitu";'."\n"; 
	$html .= 'printURL = printURL + "&slug[1]=ycat2higashiohgishima_doyou";'."\n";
	 *
	 *
	 * ---------------*/

	return $html;
		
}
add_shortcode('post_type_TIMETABLEPRINTCSV', 'post_type_TIMETABLEPRINTCSV_shortcode');


// ===================================================================
//
// 運行状況を呼び出す
//
// ===================================================================

function post_type_OPERATIONSTATUS_shortcode($atts) {


	$html = "";

	$atts = shortcode_atts(array(
		"rosen" => '',
	),$atts);


	$signboad = get_Signboad2($atts['rosen']);

	if( $signboad['mark'] == "○" || $signboad['mark'] == "―" ){
		$markFlag = "green";
	} else{
		$markFlag = "red";
	}

	$html .= '<h3 class="tit03" id="signboad">';
	$html .= '	<span class="tit03__ja">運行状況</span>';
	$html .= '	<span class="tit03__en">Operation Status</span>';
	$html .= '</h3>';
	$html .= '<div class="operationStatus '.$markFlag.'">';
	$html .= '	<div class="inner">';
	$html .= '		<p class="operationStatus__mark"><span>'.$signboad['mark'].'</span></p>';
	$html .= '		<div class="operationStatus__info">';
	$html .= '			<p class="operationStatus__info__reason">';
	$html .= '				'.strip_tags($signboad['reason2']);
					if( $signboad['status'] != "運休" && $signboad['status'] != "始発案内" ):
	$html .= '				('. $signboad['time2'].'分)';
					endif;
	$html .= '			</p>';
	$html .= '			<p class="operationStatus__info__msg">'.$signboad['text'].'</p>';
	$html .= '		</div>';
	$html .= '	</div>';
	$html .= '</div>';

	return $html;
		
}
add_shortcode('post_type_OPERATIONSTATUS', 'post_type_OPERATIONSTATUS_shortcode');





/*-------------
運行状況を呼び出す関数
-------------*/
function get_Signboad2( $rosen = "" ){

	$set_shihatu = false;
	$date = new DateTime();
	$date->setTimeZone(new DateTimeZone('Asia/Tokyo'));


	// ****************************************
	//運行情報
	// ****************************************

	$args = array(
		'post_type' => 'signboad',
		'posts_per_page' => 1,
		'name' => $rosen,
	);
	$loop = new WP_Query($args);

	if($loop->have_posts()):
	while ( $loop->have_posts() ) : $loop->the_post();



		$status = get_field('signboad_status');

		// ▼　通常運行時 ---------------------------------
		if( $status == "（〇）通常運行" ){

			$st = get_field('signboad_status_normal');

			$msg['status'] = "通常運行"; 
			$msg['reason'] = "通常運行"; 
			$msg['reason2'] = "通常運行"; 
			$msg['mark'] = "○";
			$msg['text'] = $st['signboad_status_normal_text'];
			$msg['time'] = "平常運転（".$st['signboad_status_normal_time']."分）";
			$msg['time2'] = $st['signboad_status_normal_time'];


		// ▼　遅延 ---------------------------------
		} elseif( $status == "（△）遅延" ) {

			$st            = get_field('signboad_status_not_normal');

			$msg['status'] = "遅延";
			$msg['reason'] = $st['signboad_status_not_normal_reason'];

			$msg['reason2'] = "[遅延]<br />";
			switch ($msg['reason']) {
				case "自然渋滞により"; $msg['reason2']               = $msg['reason2']."自然渋滞"; break;
				case "事故渋滞の影響により"; $msg['reason2']         = $msg['reason2']."事故渋滞"; break;
				case "工事渋滞により"; $msg['reason2']               = $msg['reason2']."工事渋滞"; break;
				case "故障車による渋滞の影響により"; $msg['reason2'] = $msg['reason2']."故障車渋滞"; break;
				case "空港内混雑の影響により"; $msg['reason2']       = $msg['reason2']."空港内混雑"; break;
				case "悪天候の影響により"; $msg['reason2']           = $msg['reason2']."悪天候"; break;
				case "台風の影響により"; $msg['reason2']             = $msg['reason2']."台風"; break;
				case "雪の影響により"; $msg['reason2']               = $msg['reason2']."雪"; break;
				case "地震の影響により"; $msg['reason2']             = $msg['reason2']."地震"; break;
				case "交通規制の影響により"; $msg['reason2']         = $msg['reason2']."交通規制"; break;
				case "その他の影響により"; $msg['reason2']           = $msg['reason2']."その他"; break;
			}

			$msg['mark']   = "△";
			$msg['time']   = "遅延運転（".$st['signboad_status_not_normal_time']."分）";
			$msg['time2'] = $st['signboad_status_not_normal_time'];


			if( $rosen == "narita" ){
				$msg['text'] = "成田行きのバスは".$st['signboad_status_not_normal_reason']."遅延しています。成田空港（第3旅客ターミナル）まで".$st['signboad_status_not_normal_time']."分の予定です。なお、所要時間の数値に関しましては、正確な時間をお約束するものではありません。";
			} elseif( $rosen == "haneda" ){
				$msg['text'] = "羽田行きのバスは".$st['signboad_status_not_normal_reason']."遅延しています。羽田空港（第1ターミナル）まで".$st['signboad_status_not_normal_time']."分の予定です。なお、所要時間の数値に関しましては、正確な時間をお約束するものではありません。";
			}

			//
		// ▼　運休 ---------------------------------
		} elseif( $status == "（×）運休" ) {
			$st            = get_field('signboad_status_not_normal');

			$msg['status'] = "運休";
			$msg['reason'] = $st['signboad_status_not_normal_reason'];

			$msg['reason2'] = "[運休]<br />";
			switch ($msg['reason']) {
				case "自然渋滞により"; $msg['reason2']               = $msg['reason2']."自然渋滞"; break;
				case "事故渋滞の影響により"; $msg['reason2']         = $msg['reason2']."事故渋滞"; break;
				case "工事渋滞により"; $msg['reason2']               = $msg['reason2']."工事渋滞"; break;
				case "故障車による渋滞の影響により"; $msg['reason2'] = $msg['reason2']."故障車渋滞"; break;
				case "空港内混雑の影響により"; $msg['reason2']       = $msg['reason2']."空港内混雑"; break;
				case "悪天候の影響により"; $msg['reason2']           = $msg['reason2']."悪天候"; break;
				case "台風の影響により"; $msg['reason2']             = $msg['reason2']."台風"; break;
				case "雪の影響により"; $msg['reason2']               = $msg['reason2']."雪"; break;
				case "地震の影響により"; $msg['reason2']             = $msg['reason2']."地震"; break;
				case "交通規制の影響により"; $msg['reason2']         = $msg['reason2']."交通規制"; break;
				case "その他の影響により"; $msg['reason2']           = $msg['reason2']."その他"; break;
			}
			$msg['mark']   = "×";


			if( $rosen == "narita" ){
				$msg['text'] = "成田行きのバスは".$st['signboad_status_not_normal_reason']."運休しています。";
			} elseif( $rosen == "haneda" ){
				$msg['text'] = "羽田行きのバスは".$st['signboad_status_not_normal_reason']."運休しています。";
			}

		}

		if(  $status != "（×）運休"  ){

			// ▼　始発案内切替 ---------------------------------

			$st        = get_field('signboad_shihatu');

			$today     = $date->format('Y/m/d');
			$todayTime = $date->format('Y/m/d H:i');
			$startTime = $today . " " . $st['signboad_shihatu_start_time'];
			$endTime   = $today . " " . $st['signboad_shihatu_end_time'];

			// 現在の時間が「始発バス案内（表示開始時間）」を超える場合（以上）
			if (  strtotime("now") - strtotime($startTime) > 0) {
					$set_shihatu = true;
			}

			// 現在の時間が「始発バス案内（表示終了時間）」を超えない場合（以下）
			if ( strtotime("now") - strtotime($endTime)   < 0 ) {
				$set_shihatu = true;
			}

			if ( $set_shihatu ) {
				$msg['status'] = '始発案内';
				$msg['reason'] = '始発案内';
				//$msg['reason2'] = "始発バスは<br />".date("H:i",strtotime($st['signboad_shihatu_end_time']  . "+1 minute"))."です";
				$msg['reason2'] = "始発バス<br />".date("H:i",strtotime($st['signboad_shihatu_end_time']));
				$msg['mark']   = '―';
				$msg['text'] = $st['signboad_shihatu_text'];
				$msg['time'] = "平常運転（".$st['signboad_status_normal_time']."分）";
			}
		}

	endwhile;
	endif;
	wp_reset_query();

	return $msg ;

}
/*-------------
運行状況を呼び出す関数
-------------*/
function get_Signboad( $rosen = "" ){

	$set_shihatu = false;
	$date = new DateTime();
	$date->setTimeZone(new DateTimeZone('Asia/Tokyo'));



	// ****************************************
	//羽田空港 - 運行情報
	// ****************************************
	if( $rosen == "haneda" ){

		$_NAME = "haneda";

		$status = get_field('signboad_'.$_NAME.'_status','option');

		// ▼　通常運行時 ---------------------------------
		if( $status == "（〇）通常運行" ){

			$st = get_field('signboad_'.$_NAME.'_status_normal' ,'option');

			$msg['status'] = "通常運行"; 
			$msg['reason'] = "通常運行"; 
			$msg['reason2'] = "通常運行"; 
			$msg['mark'] = "○";
			$msg['text'] = $st['signboad_'.$_NAME.'_status_normal_text'];
			$msg['time'] = "平常運転（".$st['signboad_'.$_NAME.'_status_normal_time']."分）";
			$msg['time2'] = $st['signboad_'.$_NAME.'_status_normal_time'];


			// // ▼　始発案内切替 ---------------------------------
			// $st            = get_field('signboad_'.$_NAME.'_shihatu' ,'option');


			// $today     = $date->format('Y/m/d');
			// $todayTime = $date->format('Y/m/d H:i');
			// $startTime = $today . " " . $st['signboad_'.$_NAME.'_shihatu_start_time'];
			// $endTime = $today . " " . $st['signboad_'.$_NAME.'_shihatu_end_time'];

			// // 現在の時間が「始発バス案内（表示開始時間）」を超える場合（以上）
			// if (  strtotime("now") - strtotime($startTime) > 0) {
			// 		$set_shihatu = true;
			// }

			// // 現在の時間が「始発バス案内（表示終了時間）」を超えない場合（以下）
			// if ( strtotime("now") - strtotime($endTime)   < 0 ) {
			// 	$set_shihatu = true;
			// }


			// if ( $set_shihatu ) {
			// 	$msg['status'] = '始発案内';
			// 	$msg['reason'] = '始発案内';
			// 	$msg['reason2'] = "始発バスは<br />".date("H:i",strtotime($st['signboad_'.$_NAME.'_shihatu_end_time']  . "+1 minute"))."です";
			// 	$msg['mark']   = '―';
			// 	$msg['text'] = $st['signboad_'.$_NAME.'_shihatu_text'];
			// 	$msg['time'] = "平常運転（".$st['signboad_'.$_NAME.'_status_normal_time']."分）";
			// 	$msg['time2'] = $st['signboad_'.$_NAME.'_status_normal_time'];
			// }



		// ▼　遅延 ---------------------------------
		} elseif( $status == "（△）遅延" ) {

			$st            = get_field('signboad_'.$_NAME.'_status_not_normal' ,'option');

			$msg['status'] = "遅延";
			$msg['reason'] = $st['signboad_'.$_NAME.'_status_not_normal_reason'];

			$msg['reason2'] = "[遅延]<br />";
			switch ($msg['reason']) {
				case "自然渋滞により"; $msg['reason2']               = $msg['reason2']."自然渋滞"; break;
				case "事故渋滞の影響により"; $msg['reason2']         = $msg['reason2']."事故渋滞"; break;
				case "工事渋滞により"; $msg['reason2']               = $msg['reason2']."工事渋滞"; break;
				case "故障車による渋滞の影響により"; $msg['reason2'] = $msg['reason2']."故障車渋滞"; break;
				case "空港内混雑の影響により"; $msg['reason2']       = $msg['reason2']."空港内混雑"; break;
				case "悪天候の影響により"; $msg['reason2']           = $msg['reason2']."悪天候"; break;
				case "台風の影響により"; $msg['reason2']             = $msg['reason2']."台風"; break;
				case "雪の影響により"; $msg['reason2']               = $msg['reason2']."雪"; break;
				case "地震の影響により"; $msg['reason2']             = $msg['reason2']."地震"; break;
				case "交通規制の影響により"; $msg['reason2']         = $msg['reason2']."交通規制"; break;
				case "その他の影響により"; $msg['reason2']           = $msg['reason2']."その他"; break;
			}

			$msg['mark']   = "△";
			$msg['time']   = "遅延運転（".$st['signboad_'.$_NAME.'_status_not_normal_time']."分）";
			$msg['time2'] = $st['signboad_'.$_NAME.'_status_not_normal_time'];
			$msg['text'] = "羽田行きのバスは".$st['signboad_'.$_NAME.'_status_not_normal_reason']."遅延しています。羽田空港（第1ターミナル）まで".$st['signboad_'.$_NAME.'_status_not_normal_time']."分の予定です。なお、所要時間の数値に関しましては、正確な時間をお約束するものではありません。";

			//
		// ▼　運休 ---------------------------------
		} elseif( $status == "（×）運休" ) {
			$st            = get_field('signboad_'.$_NAME.'_status_not_normal' ,'option');

			$msg['status'] = "運休";
			$msg['reason'] = $st['signboad_'.$_NAME.'_status_not_normal_reason'];

			$msg['reason2'] = "[運休]<br />";
			switch ($msg['reason']) {
				case "自然渋滞により"; $msg['reason2']               = $msg['reason2']."自然渋滞"; break;
				case "事故渋滞の影響により"; $msg['reason2']         = $msg['reason2']."事故渋滞"; break;
				case "工事渋滞により"; $msg['reason2']               = $msg['reason2']."工事渋滞"; break;
				case "故障車による渋滞の影響により"; $msg['reason2'] = $msg['reason2']."故障車渋滞"; break;
				case "空港内混雑の影響により"; $msg['reason2']       = $msg['reason2']."空港内混雑"; break;
				case "悪天候の影響により"; $msg['reason2']           = $msg['reason2']."悪天候"; break;
				case "台風の影響により"; $msg['reason2']             = $msg['reason2']."台風"; break;
				case "雪の影響により"; $msg['reason2']               = $msg['reason2']."雪"; break;
				case "地震の影響により"; $msg['reason2']             = $msg['reason2']."地震"; break;
				case "交通規制の影響により"; $msg['reason2']         = $msg['reason2']."交通規制"; break;
				case "その他の影響により"; $msg['reason2']           = $msg['reason2']."その他"; break;
			}
			$msg['mark']   = "×";
			$msg['text'] = "羽田行きのバスは".$st['signboad_'.$_NAME.'_status_not_normal_reason']."運休しています。";

		}
		if(  $status != "（×）運休"  ){

			// ▼　始発案内切替 ---------------------------------

			$st        = get_field('signboad_'.$_NAME.'_shihatu' ,'option');

			$today     = $date->format('Y/m/d');
			$todayTime = $date->format('Y/m/d H:i');
			$startTime = $today . " " . $st['signboad_'.$_NAME.'_shihatu_start_time'];
			$endTime   = $today . " " . $st['signboad_'.$_NAME.'_shihatu_end_time'];

			// 現在の時間が「始発バス案内（表示開始時間）」を超える場合（以上）
			if (  strtotime("now") - strtotime($startTime) > 0) {
					$set_shihatu = true;
			}

			// 現在の時間が「始発バス案内（表示終了時間）」を超えない場合（以下）
			if ( strtotime("now") - strtotime($endTime)   < 0 ) {
				$set_shihatu = true;
			}

			if ( $set_shihatu ) {
				$msg['status'] = '始発案内';
				$msg['reason'] = '始発案内';
				//$msg['reason2'] = "始発バスは<br />".date("H:i",strtotime($st['signboad_'.$_NAME.'_shihatu_end_time']  . "+1 minute"))."です";
				$msg['reason2'] = "始発バス<br />".date("H:i",strtotime($st['signboad_'.$_NAME.'_shihatu_end_time']));
				$msg['mark']   = '―';
				$msg['text'] = $st['signboad_'.$_NAME.'_shihatu_text'];
				$msg['time'] = "平常運転（".$st['signboad_'.$_NAME.'_status_normal_time']."分）";
			}
		}

	// ****************************************
	//成田空港 - 運行情報
	// ****************************************
	} elseif( $rosen == "narita" ) {

		$_NAME = "narita";

		$status = get_field('signboad_'.$_NAME.'_status','option');

		// ▼　通常運行時 ---------------------------------
		if( $status == "（〇）通常運行" ){

			$st = get_field('signboad_'.$_NAME.'_status_normal' ,'option');

			$msg['status'] = "通常運行"; 
			$msg['reason2'] = "通常運行"; 
			$msg['mark'] = "○";
			$msg['text'] = $st['signboad_'.$_NAME.'_status_normal_text'];
			$msg['time'] = "平常運転（".$st['signboad_'.$_NAME.'_status_normal_time']."分）";
			$msg['time2'] = $st['signboad_'.$_NAME.'_status_normal_time'];



		// ▼　遅延 ---------------------------------
		} elseif( $status == "（△）遅延" ) {

			$st            = get_field('signboad_'.$_NAME.'_status_not_normal' ,'option');

			$msg['status'] = "遅延";
			$msg['reason'] = $st['signboad_'.$_NAME.'_status_not_normal_reason'];


			$msg['reason2'] = "[遅延]<br />";
			switch ($msg['reason']) {
				case "自然渋滞により"; $msg['reason2']               = $msg['reason2']."自然渋滞"; break;
				case "事故渋滞の影響により"; $msg['reason2']         = $msg['reason2']."事故渋滞"; break;
				case "工事渋滞により"; $msg['reason2']               = $msg['reason2']."工事渋滞"; break;
				case "故障車による渋滞の影響により"; $msg['reason2'] = $msg['reason2']."故障車渋滞"; break;
				case "空港内混雑の影響により"; $msg['reason2']       = $msg['reason2']."空港内混雑"; break;
				case "悪天候の影響により"; $msg['reason2']           = $msg['reason2']."悪天候"; break;
				case "台風の影響により"; $msg['reason2']             = $msg['reason2']."台風"; break;
				case "雪の影響により"; $msg['reason2']               = $msg['reason2']."雪"; break;
				case "地震の影響により"; $msg['reason2']             = $msg['reason2']."地震"; break;
				case "交通規制の影響により"; $msg['reason2']         = $msg['reason2']."交通規制"; break;
				case "その他の影響により"; $msg['reason2']           = $msg['reason2']."その他"; break;
			}

			$msg['mark']   = "△";
			$msg['time']   = "遅延運転（".$st['signboad_'.$_NAME.'_status_not_normal_time']."分）";
			$msg['time2'] = $st['signboad_'.$_NAME.'_status_not_normal_time'];
			$msg['text'] = "成田行きのバスは".$st['signboad_'.$_NAME.'_status_not_normal_reason']."遅延しています。成田空港（第3旅客ターミナル）まで".$st['signboad_'.$_NAME.'_status_not_normal_time']."分の予定です。なお、所要時間の数値に関しましては、正確な時間をお約束するものではありません。";

			//
		// ▼　運休 ---------------------------------
		} elseif( $status == "（×）運休" ) {
			$st            = get_field('signboad_'.$_NAME.'_status_not_normal' ,'option');

			$msg['status'] = "運休";
			$msg['reason'] = $st['signboad_'.$_NAME.'_status_not_normal_reason'];

			$msg['reason2'] = "[運休]<br />";
			switch ($msg['reason']) {
				case "自然渋滞により"; $msg['reason2']               = $msg['reason2']."自然渋滞"; break;
				case "事故渋滞の影響により"; $msg['reason2']         = $msg['reason2']."事故渋滞"; break;
				case "工事渋滞により"; $msg['reason2']               = $msg['reason2']."工事渋滞"; break;
				case "故障車による渋滞の影響により"; $msg['reason2'] = $msg['reason2']."故障車渋滞"; break;
				case "空港内混雑の影響により"; $msg['reason2']       = $msg['reason2']."空港内混雑"; break;
				case "悪天候の影響により"; $msg['reason2']           = $msg['reason2']."悪天候"; break;
				case "台風の影響により"; $msg['reason2']             = $msg['reason2']."台風"; break;
				case "雪の影響により"; $msg['reason2']               = $msg['reason2']."雪"; break;
				case "地震の影響により"; $msg['reason2']             = $msg['reason2']."地震"; break;
				case "交通規制の影響により"; $msg['reason2']         = $msg['reason2']."交通規制"; break;
				case "その他の影響により"; $msg['reason2']           = $msg['reason2']."その他"; break;
			}
			$msg['mark']   = "×";
			$msg['text'] = "成田行きのバスは".$st['signboad_'.$_NAME.'_status_not_normal_reason']."運休しています。";

		}


		// ▼　始発案内切替 ---------------------------------
		if(  $status != "（×）運休"  ){

			$st        = get_field('signboad_'.$_NAME.'_shihatu' ,'option');

			$today     = $date->format('Y/m/d');
			$todayTime = $date->format('Y/m/d H:i');
			$startTime = $today . " " . $st['signboad_'.$_NAME.'_shihatu_start_time'];
			$endTime   = $today . " " . $st['signboad_'.$_NAME.'_shihatu_end_time'];

			// 現在の時間が「始発バス案内（表示開始時間）」を超える場合（以上）
			if (  strtotime("now") - strtotime($startTime) > 0) {
					$set_shihatu = true;
			}

			// 現在の時間が「始発バス案内（表示終了時間）」を超えない場合（以下）
			if ( strtotime("now") - strtotime($endTime)   < 0 ) {
				$set_shihatu = true;
			}

			if ( $set_shihatu ) {
				$msg['status'] = '始発案内';
				$msg['reason'] = '始発案内';
				//$msg['reason2'] = "始発バスは<br />".date("H:i",strtotime($st['signboad_'.$_NAME.'_shihatu_end_time']  . "+1 minute"))."です";
				$msg['reason2'] = "始発バス<br />".date("H:i",strtotime($st['signboad_'.$_NAME.'_shihatu_end_time']));
				$msg['mark']   = '―';
				$msg['text'] = $st['signboad_'.$_NAME.'_shihatu_text'];
				$msg['time'] = "平常運転（".$st['signboad_'.$_NAME.'_status_normal_time']."分）";
			}
		}
	}

	return $msg ;

}

// ===================================================================
//
// バス運行会社一覧
//
// ===================================================================
function post_type_BUSCOMPANY_shortcode($terms) {


		// タクソノミ取得
		$catargs = array(
		  'taxonomy' => 'buscompnay_cat'//(1)
		);
		$catlists = get_categories( $catargs );
		foreach($catlists as $cat) : // 取得したカテゴリの配列でループを回す

			$html .= '<div class="content">';
			$html .= '<p class="tit04">'.$cat->name.'</p>';
			//
				// -----------------------------------
				// 取得したターム（カテゴリー）ごとに一覧を取得
				// -----------------------------------
				$args = array(
					'posts_per_page'=> -1, 
					'post_type' => 'buscompany' , 
					'tax_query' => array(
						array(
							'taxonomy' => 'buscompnay_cat', //カスタム投稿のターム名称
							'field' => 'slug',
							'terms' => array( // カスタム投稿のどのタームで絞り込むか
								$cat->slug,
							),
						),
					),
				);
				$query = new WP_Query($args);

			$cnt = $query->post_count;

			if( $query -> have_posts() ):

				$html .= '<ul class="linkLst">';
				while ($query -> have_posts()) : $query -> the_post();

					$html .= '<li>';
					if( get_field('companylist_lnk') ){

						// http始まりの場合はそのまま利用
						if(strpos( get_field('companylist_lnk') ,'http') !== false){
							$link = get_field('companylist_lnk');
							$html .= "<a href=\"". $link ."\" target=\"_blank\">" . get_the_title() . "</a>";
						// /始まりの場合は自分自身のURLを付与
						} else {
							$link = get_bloginfo("url").get_field('companylist_lnk');
							$html .= "<a href=\"". $link ."\">" . get_the_title() . "</a>";
						}

					} else {
						$html .= "<a href=\"". get_bloginfo("url"). "/route/buslist/?buscompanyname=" . get_the_title() . "#tit\">" . get_the_title() . "</a>";
					}
					$html .= '</li>';
				endwhile;


				$html .= '<li></li>';

				$html .= '</ul>';
				$html .= '</div>';
			endif;
			wp_reset_query();



		 endforeach;


	return $html;
		
}
add_shortcode('post_type_BUSCOMPANY', 'post_type_BUSCOMPANY_shortcode');


// ===================================================================
//
// 中長距離・夜行 一覧出力
//
// ===================================================================
function post_type_LONGLST_shortcode($terms) {

		$html = '';

		// 各方面のリストを作成
		$lst = array();
		$lst['東北・北陸・上信越方面'] = 'longSetting_touhoku';
		$lst['東海・中京方面']         = 'longSetting_toukai';
		$lst['近畿方面']               = 'longSetting_kinki';
		$lst['中国・四国方面']         = 'longSetting_chugoku';

		// 検索状態の場合、検索対象の運行会社をタイトル表示
		if( isset( $_GET['buscompanyname'] ) ):

			$html .= '<p class="tit02" id="tit">';
			$html .= '	<span class="tit02__ja">'.$_GET['buscompanyname'].'</span>';
			$html .= '</p>';

		endif;

		// タブメニュー設定
		$html .= '<ul class="pageMenu">';
		foreach( $lst as $k => $v ):
			$html .= '	<li class="pageMenu__item"><a href="#'.$v.'">'.$k.'</a></li>';
		endforeach;
		$html .= '</ul>';


		// 各方面のリストでループ
		foreach( $lst as $k => $v ):
			if(have_rows( $v , 'option' )):

				$html .= '<h3 class="tit07" id="'.$v.'">'.$k.'</h3>';
				$html .= '<table class="tbl06">';

				$cnt = 0;
				$bLst = array();
				while(have_rows( $v , 'option' )): the_row();

					$buscompany = get_sub_field('longSetting_lst_buscompany','option');

					$html .= '	<tr>';
					$html .= '		<th>'.get_sub_field('longSetting_lst_area','option').'</th>';
					$html .= '		<td>';
					$html .= '			<a href="'.get_sub_field('longSetting_lst_buslink','option') . '" target="_blank">';
					$html .= '				'.get_sub_field('longSetting_lst_bus','option');
					$html .= '			</a>';
					$html .= '		</td>';
					$html .= '		<td>';

						foreach( $buscompany as $buscompanyLsts => $buscompanyItem ){
							$link = get_bloginfo("url").'/route/buslist/?buscompanyname='.$buscompanyItem->post_title.'#tit';
							$html .= '<a href="'.$link.'">'.$buscompanyItem->post_title."</a><br />";
						}

					$html .= '		</td>';
					$html .= '	</tr>';
					$cnt++;

				endwhile;
				//ヒットしない場合、NULLコンテンツを表示
				if( $cnt == 0 ){
					$html .= '	<tr>';
					$html .= '		<td class="colspan" style="color:#ccc;">'.$k.'の「'.$_GET['buscompanyname'].'」はありません</td>';
					$html .= '	</tr>';
				}
				$html .= '</table>';
			endif;
		endforeach;

		// 検索状態の場合、一覧へ戻るリンクを設置
		//if( isset( $_GET['buscompanyname'] ) ):
		//	$html .= '<div class="content col01">';
		//	$html .= '	<ul class="btnArea">';
		//	$html .= '		<li class="btnArea__item"><a href="'.get_bloginfo("url").'/route/buslst/" class="bg-blue01">中長距離・夜行</a></li>';
		//	$html .= '	</ul>';
		//	$html .= '</div>';
		//endif;

	return $html;
		
}
add_shortcode('post_type_LONGLST', 'post_type_LONGLST_shortcode');




// ===================================================================
//
// 運行バス会社 一覧出力
//
// 運行バス会社一覧・中長距離・夜行ページからのリンク先
//
//
// ===================================================================
function post_type_BUSLST_shortcode($terms) {

		$html = '';

		// 各方面のリストを作成
		$lst = array();
		$lst['東北・北陸・上信越方面']   = 'longSetting_touhoku';
		$lst['東海・中京方面']           = 'longSetting_toukai';
		$lst['近畿方面']                 = 'longSetting_kinki';
		$lst['中国・四国方面']           = 'longSetting_chugoku';

		$lst['成田空港方面']             = 'longSetting_narita';
		$lst['羽田空港方面']             = 'longSetting_haneda';
		$lst['お台場方面']               = 'longSetting_daiba';
		$lst['東扇島方面']               = 'longSetting_higashiohgishima';
		$lst['横須賀西地区方面']         = 'longSetting_yokosuka';
		$lst['八景島シーパラダイス方面'] = 'longSetting_seaparadise';
		$lst['幕張メッセ方面']           = 'longSetting_makuhari';


		// 検索状態の場合、検索対象の運行会社をタイトル表示
		if( isset( $_GET['buscompanyname'] ) ):
			$html .= '<p class="tit02" id="tit">';
			$html .= '	<span class="tit02__ja">'.$_GET['buscompanyname'].'</span>';
			$html .= '</p>';

		endif;

		// タブメニュー設定
		//$html .= '<ul class="pageMenu">';
		//foreach( $lst as $k => $v ):
		//	$html .= '	<li class="pageMenu__item"><a href="#'.$v.'">'.$k.'</a></li>';
		//endforeach;
		//$html .= '</ul>';


		// 各方面のリストでループ
		foreach( $lst as $k => $v ):
			wp_reset_query();
			if(have_rows( $v , 'option' )):
				$html .= '<h3 class="tit07" id="'.$v.'">'.$k.'</h3>';
				$html .= '<table class="tbl06">';

				$cnt = 0;

				while(have_rows( $v , 'option' )): the_row();

					$buscompany = get_sub_field('longSetting_lst_buscompany','option');
					foreach( $buscompany as $buscompanyLsts => $buscompanyItem ){

						// 検索状態の場合さらに該当るす運行会社のみを出力
						if( $buscompanyItem->post_title == $_GET['buscompanyname'] ){
							$html .= '	<tr>';
							$html .= '		<th>'.get_sub_field('longSetting_lst_area','option').'</th>';
							$html .= '		<td>';
							$html .= '			<a href="'.get_sub_field('longSetting_lst_buslink','option') . '" target="_blank">';
							$html .= '				'.get_sub_field('longSetting_lst_bus','option');
							$html .= '			</a>';
							$html .= '		</td>';
							$html .= '		<td>'.$buscompanyItem->post_title.'</td>';
							$html .= '	</tr>';
							$cnt++;
						}
					}

				endwhile;
				//ヒットしない場合、NULLコンテンツを表示
				if( $cnt == 0 ){
					$html .= '	<tr>';
					$html .= '		<td class="colspan" style="color:#ccc;">'.$k.'の「'.$_GET['buscompanyname'].'」はありません</td>';
					$html .= '	</tr>';
				}
				$html .= '</table>';
			endif;
		endforeach;

		// 検索状態の場合、一覧へ戻るリンクを設置
		if( isset( $_GET['buscompanyname'] ) ):
			$html .= '<div class="content">';
			$html .= '	<ul class="btnArea">';
			$html .= '		<li class="btnArea__item"><a href="'.get_bloginfo("url").'/route/long/" class="bg-blue01">中長距離・夜行</a></li>';
			$html .= '		<li class="btnArea__item"><a href="'.get_bloginfo("url").'/route/companylist/" class="bg-blue01">バス会社一覧</a></li>';
			$html .= '	</ul>';
			$html .= '</div>';
		endif;

	return $html;
		
}
add_shortcode('post_type_BUSLST', 'post_type_BUSLST_shortcode');


// ===================================================================
//
// YCAT周辺情報
//
// ===================================================================

function post_type_AREAINFO_shortcode($atts) {

	// have_rows('areainfo_5_walk','option');
	// have_rows('areainfo_10_walk_areainfo_5_walk','option'):
	// have_rows('areainfo_15_walk_areainfo_5_walk','option'):
	//
    extract( shortcode_atts( array(
		"repeatfield" => '',
	), $atts));

	$html = "";

	if(have_rows( $atts['repeatfield'] , 'option')):

		$rowsCnt = count( get_field($atts['repeatfield'] , 'option') );
		$blankCnt = ($rowsCnt % 3) ?( 3 - ($rowsCnt % 3) ) : 0;

		if( $rowsCnt == 3 ){
			$blankCnt = 1;
		}

		$html .= '<ul class="sightseeingLst">';
		while(have_rows( $atts['repeatfield'] ,'option')): the_row();

			$html .= '	<li class="sightseeingLst__item">';
			$html .= '		<h3 class="sightseeingLst__item__tit">'.get_sub_field('areainfo_facility_name').'</h3>';
			$html .= '		<p class="sightseeingLst__item__pic"><img src="'.get_sub_field('areainfo_facility_pic').'" alt='.strip_tags(get_sub_field('areainfo_facility_name')).'写真"></p>';
			$html .= '		<p class="sightseeingLst__item__txt">'.get_sub_field('areainfo_facility_text').'</p>';
			$html .= '		<ul class="sightseeingLst__item__btn">';
			$html .= '			<li class="btnsite"><a href="'.get_sub_field('areainfo_facility_link').'" target="_blank">オフィシャルサイト</a></li>';
			$html .= '		</ul>';
			$html .= '	</li>';

		endwhile;

		if( $rowsCnt == 3 ){
			$html .= str_repeat( '<li class="sightseeingLst__item spOFF"></li>' ,$blankCnt );
		} else {
			$html .= str_repeat( '<li class="sightseeingLst__item spOFF"></li>' ,$blankCnt );
		}


		$html .= '</ul>';
	endif;

	return $html;
		
}
add_shortcode('post_type_AREAINFO', 'post_type_AREAINFO_shortcode');
