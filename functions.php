<?php

/* ==================================================================
■　エラー出力の有無
※実際はwp-configの機能を使ったほうがよいのかも…
==================================================================== */


// 全ての PHP エラーを表示する
//error_reporting(E_ALL);

// 全てのエラー出力をオフにする
//error_reporting(0);


/* ==================================================================
■　TimeZoneを日本時間に設定する
※Wordpressの時間連れを修正する
==================================================================== */

date_default_timezone_set('Asia/Tokyo');


/* ==================================================================
	■　Wordpress本体の更新通知を消す
	https://www.webernote.net/wordpress/hide-update.html
==================================================================== */

add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );


/* ==================================================================
	■　Wordpressプラグインの更新通知を消す
	https://www.webernote.net/wordpress/hide-update.html
==================================================================== */

//add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );


/* ==================================================================
■　追加機能を呼び出し
==================================================================== */


// ★　必須　絶対消したらダメ！


require_once ('functions/post_type_add.php');      // ■ カスタム投稿を追加
require_once ('functions/seo_meta_set.php');       // ■ タイトル、キーワード、説明文を表示制御
require_once ('functions/shortcode.php');          // ■ ショートコード
require_once ('functions/original_functions.php'); // ■ 自作関数系


/* ==================================================================
■　各種更新通知を非表示にする

参考
https://deep-blog.jp/engineer/14891/

==================================================================== */

//本体の更新通知を非表示
add_filter("pre_site_transient_update_core", "__return_null");
//プラグインの更新通知を非表示
//add_filter("pre_site_transient_update_plugins", "__return_null");
//テーマの更新通知を非表示
add_filter("pre_site_transient_update_themes", "__return_null");



/* ==================================================================
■　wp_head 不要部分の削除
==================================================================== */

remove_action('wp_head', 'wp_generator');						// 「meta name generator」の削除
remove_action('wp_head', 'wlwmanifest_link');					// 「link rel wlwmanifest」の削除
remove_action('wp_head', 'rsd_link');							// 「link rel EditURI rsd」の削除
remove_action('wp_head', 'index_rel_link');					// 「link rel index」の削除
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');	// 「link rel prev|next」の削除
remove_action('wp_head', 'feed_links_extra', 3);

#WordPressで勝手に読み込まれてる絵文字系の設定(wpemojiSettings)を削除する方法
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles', 10 );

//
//
// WordPressでは、投稿や固定ページに半角で入力したシングルクォーテーション「'」やダブルクォーテーション「"」は、画面に表示されるときに全角「‘」「’」「“」「”」に変換されます。
//
// 対策
//　↓
// http://www.nishi2002.com/4329.html
//
remove_filter('the_content', 'wptexturize');
remove_filter('the_excerpt', 'wptexturize');
remove_filter('the_title', 'wptexturize');


/* ==================================================================
■　WP ログイン画面カスタマイズ
==================================================================== */

function my_custom_login_logo() {
	echo '<style type="text/css">
		.login h1 a { width:100%;background-image:url('.get_bloginfo('template_directory').'/img/logo.png);background-size:90%;max-size:200px; }
		.login form{
			border:solid 1px #ddd;
			}
		#login #nav {
		display:none;
		}
		</style>';
}
add_action('login_head', 'my_custom_login_logo');

/* ==================================================================
■　サムネイルのサイズ設定
サムネイルサイズ名のルールは「thumb-幅x高」
==================================================================== */

add_image_size( 'thumb-320x300', 320, 300 ,true);
add_image_size( 'thumb-100x100', 100, 100 ,true);
add_image_size( 'thumb-160x100', 160, 100 ,true);


/* ==================================================================
■　管理画面・アイキャッチ画像の有効化
==================================================================== */

add_theme_support( 'post-thumbnails' );



/* ==================================================================
■　抜粋入力欄を表示する場合のカスタマイズ
==================================================================== */

function new_excerpt_mblength($length){
	return 1000;		// 抜粋で表示したい文字数
}
add_filter('excerpt_mblength', 'new_excerpt_mblength');


/* ==================================================================
■　ビジュアルエディタ用CSS
==================================================================== */

add_editor_style('editor-style.css');
 
function custom_editor_settings( $initArray ) {
    $initArray['body_class'] = 'editor-area';
    return $initArray;
}
 
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );

/* ==================================================================
■　管理画面の編集 - css

プラグイン「adminmize」あるからもはやこの設定は不要なきがする…

==================================================================== */

//function remove_footer_all_admin() {
//
//
//	if (!current_user_can('administrator')) { //administrator以外の場合メニューをunsetする
//
//
//		echo '<style type="text/css">';
//		echo '#shortcode_get_custom_field_values { display:none; } ';
//		echo '#tagsdiv-post_tag                  { display:none; }';
//		echo '.update-nag                        { display:none; }';
//		echo '#contextual-help-link-wrap         { display:none; }';
//		echo '.akismet-right-now                 { display:none; }';
//		echo '#wp-version-message                { display:none; }';
//		echo '.table_discussion                  { display:none; }';
//		echo '#revisionsdiv                      { display:none; }';
//		echo '#commentsdiv                       { display:none; }';
//		echo '#wordbooker_secondary_target       { display:none; }';
//		echo '#no_display_wb                     { display:none; }';
//		echo '#no_display_tw                     { display:none; }';
//		echo '#excerpt                           { height:7em; }';
//		echo '</style>';
//
//	}
//}
//add_action('admin_head', 'remove_footer_all_admin');



/* ==================================================================
■　管理画面のフッター？をカスタマイズ
==================================================================== */
// function custom_admin_footer() {
//     echo 'お困りの際は<a href="http://www.urban-sp.jp/" title="アーバン企画" target="_blank">アーバン企画</a>までお気軽にお問い合わせ下さい。TEL:045-320-5161';
// }
// add_filter('admin_footer_text', 'custom_admin_footer');



/* ==================================================================
■　管理画面 ダッシュボードのウィジェット非表示
==================================================================== */

function my_remove_dashboard_widgets(){

	// 管理者以外のとき適用する
	if (!current_user_can('administrator')){
		global $wp_meta_boxes;

		// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);		// 現在の状況
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);	// 被リンク
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);			// プラグイン
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);	// 最近のコメント
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);		// クイック投稿
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);		// 最近の下書き
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);			// WordPress開発ブログ
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);			// WordPressフォーラム

	}
}
add_action('wp_dashboard_setup', 'my_remove_dashboard_widgets');



/* ==================================================================
■　管理画面　一覧にスラッグ名を表示させる
==================================================================== */

// function add_page_columns_name($columns) {
//     $columns['slug'] = "スラッグ";
//     return $columns;
// }
// function add_page_column($column_name, $post_id) {
//     if( $column_name == 'slug' ) {
//         $post = get_post($post_id);
//         $slug = $post->post_name;
//         echo attribute_escape($slug);
//     }
// }
// add_filter( 'manage_pages_columns', 'add_page_columns_name');
// add_action( 'manage_pages_custom_column', 'add_page_column', 10, 2);



/* ==================================================================
■　bodyタグに様々なクラス名を設定する

※WordPressの標準関数 body_class() を拡張する関数

使用方法) <body <?php body_class();?>>

==================================================================== */

function pagename_class($classes = '') {
	if( ! is_front_page()){
		//if (is_page()) {
			$page = get_page(get_the_ID());
			$classes[] = $page->post_name;
		//}
	}
    return $classes;
}
add_filter('body_class','pagename_class');


/* ==================================================================
■　カスタム投稿別に検索結果のテンプレートを準備する

※通常検索結果画面は「search.php」を利用するが、
　カスタム投稿だけの検索結果を表示対象とるする場合などに便利

==================================================================== */

add_filter('template_include','custom_search_template');
function custom_search_template($template){
  if ( is_search() ){
    $post_types = get_query_var('post_type');
    foreach ( (array) $post_types as $post_type )
      $templates[] = "search-{$post_type}.php";
    $templates[] = 'search.php';
    $template = get_query_template('search',$templates);
  }
  return $template;
}

/* ==================================================================
■　サイト内検索を　AND　から　OR　へ
==================================================================== */

//add_filter('posts_search', function($search) { return str_replace(')) AND ((', ')) OR ((', $search); });



/* ==================================================================
■　カテゴリチェック時に並び替えが変更されないようにする
==================================================================== */

add_filter( 'wp_terms_checklist_args', 'ps_wp_terms_checklist_args' , 10, 2 );
function ps_wp_terms_checklist_args( $args, $post_id ){
	
	if ( $args['checked_ontop'] !== false ){
		$args['checked_ontop'] = false;
	}
 
	return $args;
}


/* ==================================================================
■　デフォルトをhtmlエディタにする

必要に応じてコメントを開放すること

==================================================================== */



//function my_remove_caption() {
//    return true;
//}
//add_filter( 'disable_captions', 'my_remove_caption' );


/* ==================================================================
■　WordPress srcset内のショートコードがそのまま表示されてしまう現象を解決！
【参考】http://blog.yuko-design.com/wordpress/3431/


ショートコードが <script src="[tempdir]"> , <link href="[tempdir]" > でショートコードが展開されないのでショートコードが展開できるようにする
==================================================================== */

add_filter( 'wp_kses_allowed_html', 'my_wp_kses_allowed_html', 10, 2 );
function my_wp_kses_allowed_html( $tags, $context ) {
	$tags['link']['href'] = true;
	$tags['script']['src'] = true;
	return $tags;
}



/* ==================================================================
■　カスタムフィールドもプレビューできるようにする
==================================================================== */

function get_preview_id($postId) {
    global $post;
    $previewId = 0;
    if ( isset($_GET['preview'])
            && ($post->ID == $postId)
                && $_GET['preview'] == true
                    &&  ($postId == url_to_postid($_SERVER['REQUEST_URI']))
        ) {
        $preview = wp_get_post_autosave($postId);
        if ($preview != false) { $previewId = $preview->ID; }
    }
    return $previewId;
}
 
add_filter('get_post_metadata', function($meta_value, $post_id, $meta_key, $single) {
    if ($preview_id = get_preview_id($post_id)) {
        if ($post_id != $preview_id) {
            $meta_value = get_post_meta($preview_id, $meta_key, $single);
        }
    }
    return $meta_value;
}, 10, 4);
 
add_action('wp_insert_post', function ($postId) {
    global $wpdb;
    if (wp_is_post_revision($postId)) {
        if (count($_POST['fields']) != 0) {
            foreach ($_POST['fields'] as $key => $value) {
                $field = get_field($key);
                if ( !isset($field['name']) || !isset($field['key']) ) continue;
                if (count(get_metadata('post', $postId, $field['name'], $value)) != 0) {
                    update_metadata('post', $postId, $field['name'], $value);
                    update_metadata('post', $postId, "_" . $field['name'], $field['key']);
                } else {
                    add_metadata('post', $postId, $field['name'], $value);
                    add_metadata('post', $postId, "_" . $field['name'], $field['key']);
                }
            }
        }
        do_action('save_preview_postmeta', $postId);
    }
});

/* ==================================================================
■　ACFのオプションページ

ページ共通のACF専用のオプションページを用意したい場合に開放

==================================================================== */

 if( function_exists('acf_add_options_page') ) {

     $option_page = acf_add_options_page(array(
         'page_title' => '中長距離・夜行', // 設定項目１ <= 設定ページで表示される名前
         'menu_title' => '中長距離・夜行', // 設定項目２ <= ナビに表示される名前
         'menu_slug' => 'longSetting', // 設定項目３ <= slug
         'capability' => 'edit_posts',
         'redirect' => false
     ));

     $option_page = acf_add_options_page(array(
         'page_title' => 'YCAT周辺情報', // 設定項目１ <= 設定ページで表示される名前
         'menu_title' => 'YCAT周辺情報', // 設定項目２ <= ナビに表示される名前
         'menu_slug' => 'areainfoSetting', // 設定項目３ <= slug
         'capability' => 'edit_posts',
         'redirect' => false
     ));

     //$option_page = acf_add_options_page(array(
     //    'page_title' => '運行状況', // 設定項目１ <= 設定ページで表示される名前
     //    'menu_title' => '運行状況', // 設定項目２ <= ナビに表示される名前
     //    'menu_slug' => 'signboadSetting', // 設定項目３ <= slug
     //    'capability' => 'edit_posts',
     //    'redirect' => false
     //));


	// カスタム投稿に対する設定ページの追加
	// acf_add_options_sub_page(array(
    //    'menu_title'    => 'よくある質問設定',
    //    'page_title'     => '設定',
    //    'parent_slug'    => 'edit.php?post_type=qa',
    //    'menu_slug' => 'qa-option',
    //));
 }

/* ==================================================================
■　ウイジェット

ウィジェットが必要な場合はコメント開放

※ブログ用のサイバーをウィジェットで用意する場合などはかなり便利

==================================================================== */

//register_sidebar(
//	array(
//		'name' => 'サイドバー1',
//		'id' => 'sidebar1',
//		'before_widget' => '<div>',
//		'after_widget' => '</div>',
//		'before_title' => '<h3>',
//		'after_title' => '</h3>'
//	)
//);

/* ==================================================================
■　アップロードファイル名を特定の書式に変更

書式　18124303_sat_5b8e6.jpg
書式　日付時間分秒_曜日_ファイル名のハッシュレート.jpg

※日本語ファイル名とか、いろいろあるファイル名を一本化

==================================================================== */
function rename_file_md5($fileName) {
    $i = strrpos($fileName, '.');
    if ($i) $Exts = '.'.substr($fileName, $i + 1);
    else $Exts = '';
    //$fileName = md5(time().$fileName).$Exts;
    $fileName = date('dHis')."_".date('D')."_".substr( md5(time().$fileName),0,5).$Exts;
    return strtolower($fileName);
}
add_filter('sanitize_file_name', 'rename_file_md5', 10);


/* ==================================================================
■　 get_template_partをショートコード化して投稿の編集画面から呼べるようにしたい

参考：https://migi.me/wordpress/get-template-part-short-code/


投稿画面のエディタ内で、テンプレートを呼び出したい箇所に以下のようなショートコードを書きます。

サンプルでは「template-contact.php」というテンプレートファイルを呼び出すときの書き方になります。

引数は読み込みたいテンプレートの名称を指定します。関数版のget_template_partと使い方は一緒です。

[template get_template_part="include_parts_routeInfoMenu"]

==================================================================== */
function wrap_get_template_part($atts) {
    extract(shortcode_atts(
        array(
            'get_template_part' => '',
        ), $atts)
    );

    ob_start();
    get_template_part( $get_template_part);
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}
add_shortcode( 'template', 'wrap_get_template_part' );



/* ==================================================================
■　投稿の個別ページのみパーマリンクを変更する

参考
https://www.warna.info/archives/2721/

使用方法

articel => blog 等に変更してつかう

==================================================================== */


// function add_article_post_permalink( $permalink ) {
//     $permalink = '/article' . $permalink;
//     return $permalink;
// }
// add_filter( 'pre_post_link', 'add_article_post_permalink' );
//  
// function add_article_post_rewrite_rules( $post_rewrite ) {
//     $return_rule = array();
//     foreach ( $post_rewrite as $regex => $rewrite ) {
//         $return_rule['article/' . $regex] = $rewrite;
//     }
//     return $return_rule;
// }
// add_filter( 'post_rewrite_rules', 'add_article_post_rewrite_rules' );


// // ----------------------------------
// // 管理画面にfacebook用メタボックスを追加する
// // 管理画面にfacebook用メタボックスを追加する
// // 管理画面にfacebook用メタボックスを追加する
// // 管理画面にfacebook用メタボックスを追加する
// // 管理画面にfacebook用メタボックスを追加する
// // 管理画面にfacebook用メタボックスを追加する
// // 管理画面にfacebook用メタボックスを追加する
// // ----------------------------------
// function fnc_metaBox_facebookSharek_input() {
// 
// 
// 	//facebookシェアボタンを表示するときの popup.js のjsファイルへのパスを記述
// 	//popup.jpは任意の場所に設定し、下記URLは適宜書き換えること
// 	//$popup_js_path = get_bloginfo('template_directory').'/wp-admin/popup.js';
// 	$popup .= "<script>";
// 	$popup .= "window.onload = function() {";
// 	$popup .= "	var node_a = document.getElementsByTagName('a');";
// 	$popup .= "		for (var i in node_a) {";
// 	$popup .= "			if (node_a[i].className == 'popup') {";
// 	$popup .= "				node_a[i].onclick = function() {";
// 	$popup .= "					return winOpen(this.href)";
// 	$popup .= "				};";
// 	$popup .= "			}";
// 	$popup .= "		}";
// 	$popup .= "};";
// 	$popup .= "function winOpen(url) {";
// 	$popup .= "	window.open(";
// 	$popup .= "	url,'popup',";
// 	$popup .= "	'width=500,height=300,scrollbars=1,resizable=1');";
// 	$popup .= "	return false;";
// 	$popup .= "};";
// 
// 	$popup .= '(function($) {';
// 	$popup .= '	var url = $("#sample-permalink").attr("href");';
// 	$popup .= '';
// 	$popup .= '	$("#facebook_share_link").attr("href","https://www.facebook.com/sharer/sharer.php?u="+url);';
// 	$popup .= '	/*WP管理画面の投稿を確認するボタンがない場合は新規投稿時なのでメタボックスを隠す*/';
// 	$popup .= '	if( typeof url === "undefined" ){';
// 	$popup .= '		$("#facebook_share").css("display","none");';
// 	$popup .= '	}';
// 	$popup .= '})(jQuery);';
// 
// 
// 	$popup .= "</script>";
// 
// 	echo $popup;
// 
// 	
// 	//メタボックスの内容を作成する
// 	//echo '<script type="text/javascript" src="'.$popup_js_path.'"></script>';
// 	echo '<a href="" class="popup"  id="facebook_share_link" style="background:#0085ba;color:#fff;padding:5px;display:block;text-decoration:none;text-align:center;border-radius:4px;">';
// 	echo 'facebookにシェアする';
// 	echo '</a>';
// 
// }
//  
// // メタボックスを追加する関数
// function fnc_metaBox_facebookSharek_output() {
//     add_meta_box('facebook_share', 'facebookシェア', 'fnc_metaBox_facebookSharek_input', array('post','works'), 'side', 'low' );
// }
//  
// // フックする
// add_action('admin_menu', 'fnc_metaBox_facebookSharek_output' );


/* ==================================================================
■　WordPress srcset内のショートコードがそのまま表示されてしまう現象を解決！
【参考】http://blog.yuko-design.com/wordpress/3431/
ショートコードが <script src="[tempdir]"> , <link href="[tempdir]" > でショートコードが展開されないのでショートコードが展開できるようにする
==================================================================== */
//add_filter( 'wp_kses_allowed_html', 'my_wp_kses_allowed_html', 10, 2 );
//function my_wp_kses_allowed_html( $tags, $context ) {
//	$tags['link']['href'] = true;
//	$tags['input']['src'] = true;
//	$tags['script']['src'] = true;
//	return $tags;
//}





//////////////////////////////////// add_action('acf/input/admin_enqueue_scripts', 'my_acf_field_group_admin_enqueue_scripts');


//add_action('acf/init', 'my_acf_field_group_admin_enqueue_scripts');
//add_action('acf/render_field', 'my_acf_field_group_admin_enqueue_scripts');
//add_action('acf/field_group/admin_footer', 'my_acf_field_group_admin_enqueue_scripts');
//add_action('acf/input/admin_footer', 'my_acf_field_group_admin_enqueue_scripts');


////////////////////////////////// function my_acf_field_group_admin_enqueue_scripts() {
////////////////////////////////// 	//wp_enqueue_script( 'my-r-js', get_bloginfo('template_directory') . '/js/test.php', false, '1.0.0' );
////////////////////////////////// 	wp_enqueue_script( 'my-r-js', get_bloginfo('template_directory') . '/admin_acf/acf_timetable_custom.php', false, '1.0.0' );
////////////////////////////////// }


//function add_post_taxonomy_restrict_filter() {
//
//	//global $post_type;
//
//	//if ( 'route_busstopfile' == $post_type ) :
//
//	//	// $add_data = $_GET['route_busstopfile_cat'];
//
//	//	// echo '<select name="route_busstopfile_cat">';
//	//	// 	echo '<option value="">バスルートを選択</option>';
//	//	// 	$terms = get_terms('route_busstopfile_cat');
//	//	// 	foreach ($terms as $term) :
//	//	// 		echo '<option value="'.$term->slug.'" '.(($add_data == $term->slug ) ? 'selected="selected"' : '').'  >'.$term->name.'</option>';
//
//	//	// 	endforeach;
//
//	//	// echo '</select>';
//
//	//endif;	
//}
//add_action( 'restrict_manage_posts', 'add_post_taxonomy_restrict_filter' );


/* ==================================================================
■　【WordPress】ビジュアルモードでspanタグが消えたら、TinyMCEエディタの設定をしよう
【参考】https://blog.yuhiisk.com/archive/2017/05/11/tiny-mce-before-init-setting.html
==================================================================== */
function my_tiny_mce_before_init( $init_array ) {
    $init_array['valid_elements']          = '*[*]';
    $init_array['extended_valid_elements'] = '*[*]';

    return $init_array;
}
add_filter( 'tiny_mce_before_init' , 'my_tiny_mce_before_init' );
