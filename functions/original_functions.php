<?php

/*■■■■■■■■■■■■■■■■■■■■■■
 *
 * 自作のオリジナル関数群
 *
 *■■■■■■■■■■■■■■■■■■■■■■ */


// ===================================================================
// ユーザーエージェント判定
// ===================================================================


function fnc_user_agent(){

	$ua=$_SERVER['HTTP_USER_AGENT'];
	$user_agent = ""; 

	//if((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false)) {
	if((strpos($ua,'iPhone')!==false)||(strpos($ua,'Android')!==false)) {

		$user_agent = 'SP';

	} else {
		$user_agent = 'PC';
	}

	return $user_agent;

}


// ===================================================================
// スラッグからID取得
// ===================================================================
function get_post_id($slug) {
	$str = get_page_by_path($slug);$pid = $pid -> ID;
	return $str;
}

// ===================================================================
// ID からスラッグを取得
// ===================================================================
function get_page_slug($page_id) {
	$str = get_page($page_id);
	return $str -> post_name;
}


// ===================================================================
// 日付差を取得する
//
// 使用例）
// $dateDiff = fnc_day_diff("2019/5/01 00:00" , date('Y-m-d H:i') ) ;
// if( $dateDiff < 0 ):
// else:
// endif;
// ===================================================================

function fnc_day_diff($date1, $date2) {
 
	// 日付をUNIXタイムスタンプに変換
	$timestamp1 = strtotime($date1);
	$timestamp2 = strtotime($date2);
 
	// 何秒離れているかを計算
	//$seconddiff = abs($timestamp2 - $timestamp1);
	$seconddiff = $timestamp2 - $timestamp1;
 
	// 日数に変換
	$daydiff = $seconddiff / (60 * 60 * 24);
 
	// 戻り値
	return $daydiff;
 
}




// ===================================================================
//　続きを読む　関数
//　get_the_content ではタグが排出されるため
// ===================================================================

function fnc_mb_strimwidth($long_sentence = "" , $num ){
	$long_sentence = str_replace(array("\r\n","\r","\n"), '', $long_sentence);
	$long_sentence = strip_tags(htmlspecialchars_decode($long_sentence));
	$long_sentence = mb_strimwidth($long_sentence, 0, $num, "…", "utf-8");
	return $long_sentence;
}


// ===================================================================
//　テストサイトか判定する
//　get_the_content ではタグが排出されるため
// ===================================================================

function is_test_url(){

	$isTest = FALSE;
	$site_url = site_url();
	$site_url_str = ""; // < WPのテストURLを指定

	if( $site_url == $site_url_str ){
		$isTest = TRUE;
	}


	return $isTest;
}

// ===================================================================
/**
 * 現在のページの最上位ページのデータを取得します。(現在のページが最上位の場合は現在のページ)
 * ※ pageという名前ですが実際にはカスタム投稿の階層構造を持つものでも利用できます。
 */
// ===================================================================
//
function get_toplevel_page() {
	global $post;
	if ( $post->ancestors ) {
		$id = $post->ancestors[count($post->ancestors) - 1];
		return get_post($id);
	}
	return $post;
}


// ===================================================================
//親IDを取得する
//
//　使い方：
//　echo get_top_parent_page_id($post->ID)
// ===================================================================

function get_top_parent_page_id() {
    global $post;
    $ancestors = $post->ancestors;
    if ($ancestors) {// 固定ページが子であるかどうかをチェック
        return end($ancestors); //一番上の階層の親のIDを取得
    } else { //　固定ページが親である場合は自分のそのID
        return $post->ID;
    }
}


// ===================================================================
//ページのIDを取得・ページのクラスを取得
//
//　使い方：
//　echo get_top_parent_page_id($post->ID)
// ===================================================================
#function myFnc_get_body_slug(){
#
#	global $post;
#
#	$page = get_post( get_the_ID());
#	$slug = $page->post_name;
#
#	$meta_body['ID'] = 'none';
#	$meta_body['CLASS'] = 'none';
#
#	// HOME -------------------------------------------------------------------------
#	if(is_home()){
#		$meta_body['ID'] = 'index';
#		$meta_body['CLASS'] = 'index';
#	// CATEOGRY -------------------------------------------------------------------------
#	}elseif(is_category()){
#		$meta_body['ID'] = 'category';
#		$meta_body['CLASS'] = $post->ID;;
#
#		//if(is_category('news')){
#		//	$meta_body['ID'] = 'category';
#		//	$meta_body['CLASS'] = $post->ID;
#		//}
#
#	// ARCHIVE
#	}elseif(is_archive()){
#		$meta_body['ID'] = 'archive';
#		$meta_body['CLASS'] = $post->ID;
#
#	// SINGLE -------------------------------------------------------------------------
#	}elseif(is_single()){
#		$meta_body['ID'] = 'single';
#		$meta_body['CLASS'] = $post->ID;
#	} else {
#		// PAGE -------------------------------------------------------------------------
#		$meta_body['ID'] = $slug;
#		$meta_body['CLASS'] = $post->ID;
#	}
#
#	return $meta_body;
#}

// ===================================================================
// パンくずリスト
// 参考 http://wind-mill.co.jp/iwashiblog/2014/08/pankuzu-breadcrumb/
// 
// 使用例
//
// <？ breadcrumg(); ？>
//
// ※基本的に固定ページでしか動作しないかな…
//
// ===================================================================

function breadcrumb(){
    global $post;

    $str ='';
    if(!is_home()&&!is_admin()){
			$str.= '<div class="breadcrumb">';
			$str.= '<ol class="breadcrumb__lst">';
			$str.= '<li class="breadcrumb__lst__item"><a href="'. home_url() .'">トップページ</a></li>';
	 
			if(is_page()){
				if($post -> post_parent != 0 ){
					$ancestors = array_reverse(get_post_ancestors( $post->ID ));
					foreach($ancestors as $ancestor){
						$str.='<li class="breadcrumb__lst__item"><a href="'. get_permalink($ancestor).'">'. get_the_title($ancestor) .'</a></li>';
					}
				}
			}
			$str.='<li class="breadcrumb__lst__item"><span>'.get_the_title().'</span></li>';
			$str.='</ol>';
			$str.='</div>';
    }
    echo $str;
}


// ===================================================================
//
// ===================================================================

function schemaOrg_BreadcrumbList(){

    global $post;
	$count = 1;
	$schemaOrg = '';


    if(!is_home()&&!is_admin()){

			// ================================
			$schemaOrg .= "\n".'<script type="application/ld+json">'."\n";
			$schemaOrg .= '{';
			$schemaOrg .= '	"@context": "http://schema.org",'."\n";
			$schemaOrg .= '	"@type": "BreadcrumbList",'."\n";
			$schemaOrg .= '	"itemListElement": ['."\n";
			// ================================
	 
			$schemaOrg .= '		{'."\n";
			$schemaOrg .= '			"@type": "ListItem",'."\n";
			$schemaOrg .= '			"position": '.$count++.','."\n";
			$schemaOrg .= '			"item": {'."\n";
			$schemaOrg .= '				"@id": "'.	get_bloginfo('url').'",'."\n";
			$schemaOrg .= '				"name": "YCAT"'."\n";
			$schemaOrg .= '			}'."\n";
			$schemaOrg .= '		},'."\n";

			if(is_page()){
				if($post -> post_parent != 0 ){
					$ancestors = array_reverse(get_post_ancestors( $post->ID ));
					foreach($ancestors as $ancestor){

							// ================================
							$schemaOrg .= '		{'."\n";
							$schemaOrg .= '			"@type": "ListItem",'."\n";
							$schemaOrg .= '			"position": '.$count++.','."\n";
							$schemaOrg .= '			"item": {'."\n";
							$schemaOrg .= '				"@id": "'.get_permalink($ancestor).'",'."\n";
							$schemaOrg .= '				"name": "'.get_the_title($ancestor).'"'."\n";
							$schemaOrg .= '			}'."\n";
							$schemaOrg .= '		},'."\n";
							// ================================
					}
				}
			}

			// ================================
			$schemaOrg .= '		{'."\n";
			$schemaOrg .= '			"@type": "ListItem",'."\n";
			$schemaOrg .= '			"position": '.$count.','."\n";
			$schemaOrg .= '			"item": {'."\n";
			$schemaOrg .= '				"@id": "'.get_permalink().'",'."\n";
			$schemaOrg .= '				"name": "'.get_the_title().'"'."\n";
			$schemaOrg .= '			}'."\n";
			$schemaOrg .= '		}'."\n";
			// ================================

			$schemaOrg .= '	]'."\n";
			$schemaOrg .= '}'."\n";
			$schemaOrg .= '</script>'."\n";

			// ================================

    }
    echo $schemaOrg;
}


// ===================================================================
//　記事内の最初の画像を取得する
//
//　■使用例（?が大文字になってるので注意）
//
// <？php if (has_post_thumbnail()) : ？>
// 	<？php the_post_thumbnail('large'); ？>
// <？php else : ？>
// 	<？php if( catch_that_image() != "") : ？>
// 	<img src="<？php echo catch_that_image(); ？>" alt="<？php get_the_title(); ？>" class="thum" />
// 	<？php endif; ？>
// <？php endif; ？>
//
//
// ===================================================================
function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all("/<img[^>]+src=[\"'](s?https?:\/\/[\-_\.!~\*'()a-z0-9;\/\?:@&=\+\$,%#]+\.(jpg|jpeg|png|gif))[\"'][^>]+>/i", $post->post_content, $matches);
    $first_img = $matches [1] [0];
  
	if(empty($first_img)){ //Defines a default image
        $first_img = get_bloginfo("template_directory")."/img/default.jpg";
    }
    return $first_img;
}

function my_first_image_thumb(){
  global $post;
  $img_url = '';
  //デフォルト画像の設定
  $defaute_url = get_stylesheet_directory_uri(). '/images/default.png';

  //最初の画像を取得してIDを取得
  preg_match_all('/<img.+?class=".+?wp-image-(.+).*?".*?>/i', $post->post_content, $matches);
  if(isset($matches[1][0])){
    $img_id = ($matches[1][0]);
  }

  //最初の画像があれば分岐
  if(!empty($img_id)){
    //最初の画像IDからサムネイルのパスを取得してセット
    $img_url = my_wp_get_attachment_medium_url($img_id);
  } else {
    //最初の画像がない場合、デフォルト画像のパスをセット
    $img_url = $defaute_url;
  }
  return $img_url;
}

//画像IDからサムネイルサイズのパスを取得
function my_wp_get_attachment_medium_url( $id ) {
  $thumbnail_array = image_downsize( $id, 'thumbnail' );
  $thumbnail_path = $thumbnail_array[0];
  return $thumbnail_path;
}



// ===================================================================
//　カスタム投稿別に検索結果のテンプレートを準備する
// ===================================================================
function enable_post_type_search_template($template){
    if ( is_search() ) {
        $post_types = get_query_var('post_type');
         
        foreach ( (array) $post_types as $post_type )
            $templates[] = "search-{$post_type}.php";
        $templates[] = 'search.php';
     
        $template = get_query_template('search',$templates);
    }
    return $template;
}
add_filter('template_include','enable_post_type_search_template');



// ===================================================================
// 現在のページ数の取得
// 総ページ数の取得
// ===================================================================
function show_page_number() {
    global $wp_query;

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $max_page = $wp_query->max_num_pages;
    echo $paged;  
}

function max_show_page_number() {
    global $wp_query;

    $max_page = $wp_query->max_num_pages;
    echo $max_page;  
}



// ===================================================================
// 現在の利用のブラウザー判定
// ===================================================================

function fnc_hitBrowser(){

	$b = "";

	// 判定するのに小文字にする
	$browser = strtolower($_SERVER['HTTP_USER_AGENT']);

	// ユーザーエージェントの情報を基に判定
	if (strstr($browser , 'edge')) {
		//echo('ご使用のブラウザはEdgeです。');
		$b = 'Edge';

	} elseif (strstr($browser , 'trident') || strstr($browser , 'msie')) {
		//echo('ご使用のブラウザはInternet Explorerです。');
		$b = 'Internet Explorer';

	} elseif (strstr($browser , 'chrome')) {
		//echo('ご使用のブラウザはGoogle Chromeです。');
		$b = 'Google Chrome';

	} elseif (strstr($browser , 'firefox')) {
		//echo('ご使用のブラウザはFirefoxです。');
		$b = 'Firefox';

	} elseif (strstr($browser , 'safari')) {
		//echo('ご使用のブラウザはSafariです。');
		$b = 'Safari';

	} elseif (strstr($browser , 'opera')) {
		//echo('ご使用のブラウザはOperaです。');
		$b = 'Opera';

	} else {
		//echo('知らん。');
		$b = 'other';

	}
	return $b;
}
