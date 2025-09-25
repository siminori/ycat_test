<?php
/*
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

■　カスタムタクソノミー（カスタム投稿機能の基本情報）

■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */

$myPostType = array();


//============================================================================
//
// ▼ 時刻表
//
//============================================================================

	//$myPostTypeName       = "timetable";      // 設定1： POSTタイプのラベル名
	//$myPostTypeName_label = "時刻表"; // 設定2： POSTタイプのラベル名
	//
	//$myPostType[$myPostTypeName]['post_type']                      = $myPostTypeName;
	//$myPostType[$myPostTypeName]['post_type_labels_name']          = $myPostTypeName_label;
	//$myPostType[$myPostTypeName]['post_type_labels_singular_name'] = $myPostTypeName;
	//
	//// ▼ カテゴリ―機能
	//$myPostType[$myPostTypeName]['taxonomy_cat']                   = array(
	//);
	//
	//// ▼ タグ機能
	//$myPostType[$myPostTypeName]['taxonomy_tag']                   = array(
	//);
	//
	//$myPostType[$myPostTypeName]['taxonomy_post_type']             = $myPostTypeName;
	//$myPostType[$myPostTypeName]['taxonomy_cat_display']           = false ;  // 設定3：カテゴリー有効化：true , 無効：false
	//$myPostType[$myPostTypeName]['taxonomy_tag_display']           = false ; // 設定4：タグ機能　有効化：true , 無効：false
	//$myPostType[$myPostTypeName]['taxonomy_page_display']          = false; // 設定5：固定ページとして利用する　有効化：true , 無効：false
	//$myPostType[$myPostTypeName]['revisions_display']              = true; // 設定6：リビジョンを利用する　有効化：true , 無効：false

//============================================================================
//
// ▼ 時刻表設定
//
//============================================================================

	//$myPostTypeName       = "timetableini";      // 設定1： POSTタイプのラベル名
	//$myPostTypeName_label = "時刻表【設定】"; // 設定2： POSTタイプのラベル名
	//
	//$myPostType[$myPostTypeName]['post_type']                      = $myPostTypeName;
	//$myPostType[$myPostTypeName]['post_type_labels_name']          = $myPostTypeName_label;
	//$myPostType[$myPostTypeName]['post_type_labels_singular_name'] = $myPostTypeName;
	//
	//// ▼ カテゴリ―機能
	//$myPostType[$myPostTypeName]['__busstop_higashiohgishima']                   = array(
	//	//array(
	//	//	"cat"            => $myPostTypeName."__busstop_route", // post_typeに紐づくが自由に設定可能
	//	//	"label"          => "路線名",
	//	//	"singular_label" => "路線名",
	//	//),
	//	//// -----------------------
	//	//array(
	//	//	"cat"            => $myPostTypeName."__busstop_narita", // post_typeに紐づくが自由に設定可能
	//	//	"label"          => "バス停(成田空港) - 成田 to YCAT",
	//	//	"singular_label" => "バス停(成田空港) - 成田 to YCAT",
	//	//),
	//
	//	//	"cat"            => $myPostTypeName."__busstop_ycat_narita", // post_typeに紐づくが自由に設定可能
	//	//	"label"          => "バス停(成田空港) - YCAT to 成田",
	//	//	"singular_label" => "バス停(成田空港) - YCAT to 成田",
	//
	//	//// -----------------------
	//	//array(
	//	//	"cat"            => $myPostTypeName."__busstop_haneda", // post_typeに紐づくが自由に設定可能
	//	//	"label"          => "バス停(羽田空港) - 羽田 to YCAT",
	//	//	"singular_label" => "バス停(羽田空港) - 羽田 to YCAT",
	//	//),
	//	//	"cat"            => $myPostTypeName."__busstop_ycat_haneda", // post_typeに紐づくが自由に設定可能
	//	//	"label"          => "バス停(羽田空港) - 羽田 to YCAT",
	//	//	"singular_label" => "バス停(羽田空港) - 羽田 to YCAT",
	//	//// -----------------------
	//	//array(
	//	//	"cat"            => $myPostTypeName."__busstop_higashiohgishima", // post_typeに紐づくが自由に設定可能
	//	//	"label"          => "バス停(東扇島) - 東扇島 to YCAT",
	//	//	"singular_label" => "バス停(東扇島) - 東扇島 to YCAT",
	//	//),
	// //
	//	//	"cat"            => $myPostTypeName."__busstop_ycat_higashiohgishima", // post_typeに紐づくが自由に設定可能
	//	//	"label"          => "バス停(東扇島) - 東扇島 to YCAT",
	//	//	"singular_label" => "バス停(東扇島) - 東扇島 to YCAT",
	//
	//	//// -----------------------
	//	//array(
	//	//	"cat"            => $myPostTypeName."__busstop_yokosuka", // post_typeに紐づくが自由に設定可能
	//	//	"label"          => "バス停(葉山・横須賀西地区) - 葉山 to YCAT",
	//	//	"singular_label" => "バス停(葉山・横須賀西地区) - 葉山 to YCAT",
	//	//),
	//	//// -----------------------
	//	//array(
	//	//	"cat"            => $myPostTypeName."__busstop_seaparadise", // post_typeに紐づくが自由に設定可能
	//	//	"label"          => "バス停(八景島シーパラダイス) - 八景 to YCAT",
	//	//	"singular_label" => "バス停(八景島シーパラダイス) - 八景 to YCAT",
	//	//),
	//	//// -----------------------
	//	//array(
	//	//	"cat"            => $myPostTypeName."__busstop_odaiba", // post_typeに紐づくが自由に設定可能
	//	//	"label"          => "バス停(お台場) - お台場 to YCAT",
	//	//	"singular_label" => "バス停(お台場) - お台場 to YCAT",
	//	//),
	//	//// -----------------------



	//	//array(
	//	//	"cat"            => $myPostTypeName."__company", // post_typeに紐づくが自由に設定可能
	//	//	"label"          => "運行会社",
	//	//	"singular_label" => "運行会社",
	//	//),
	//	//array(
	//	//	"cat"            => $myPostTypeName."-cat2", // post_typeに紐づくが自由に設定可能
	//	//	"label"          => "△△カテゴリ",
	//	//	"singular_label" => "▲▲カテゴリー",
	//	//),
	//);
	//
	//// ▼ タグ機能
	//$myPostType[$myPostTypeName]['taxonomy_tag']                   = array(
	//	//array(
	//	//	"tag"            => $myPostTypeName."-tag1", // post_typeに紐づくが自由に設定可能
	//	//	"label"          => "〇〇タグ",
	//	//	"singular_label" => "●●タグ",
	//	//),
	//);
	//
	//$myPostType[$myPostTypeName]['taxonomy_post_type']             = $myPostTypeName;
	//$myPostType[$myPostTypeName]['taxonomy_cat_display']           = true;  // 設定3：カテゴリー有効化：true , 無効：false
	//$myPostType[$myPostTypeName]['taxonomy_tag_display']           = true; // 設定4：タグ機能　有効化：true , 無効：false
	//$myPostType[$myPostTypeName]['taxonomy_page_display']          = true; // 設定5：固定ページとして利用する　有効化：true , 無効：false
	//$myPostType[$myPostTypeName]['revisions_display']              = false; // 設定6：リビジョンを利用する　有効化：true , 無効：false

//============================================================================
//
// ▼ バス停【設定】
//
//============================================================================

	// $myPostTypeName       = "busstopini";      // 設定1： POSTタイプのラベル名
	// $myPostTypeName_label = "バス停【設定】"; // 設定2： POSTタイプのラベル名
	// 
	// $myPostType[$myPostTypeName]['post_type']                      = $myPostTypeName;
	// $myPostType[$myPostTypeName]['post_type_labels_name']          = $myPostTypeName_label;
	// $myPostType[$myPostTypeName]['post_type_labels_singular_name'] = $myPostTypeName;
	// 
	// // ▼ カテゴリ―機能
	// $myPostType[$myPostTypeName]['taxonomy_cat']                   = array(
	// );
	// 
	// // ▼ タグ機能
	// $myPostType[$myPostTypeName]['taxonomy_tag']                   = array(
	// );
	// 
	// $myPostType[$myPostTypeName]['taxonomy_post_type']             = $myPostTypeName;
	// $myPostType[$myPostTypeName]['taxonomy_cat_display']           = false;  // 設定3：カテゴリー有効化：true , 無効：false
	// $myPostType[$myPostTypeName]['taxonomy_tag_display']           = false; // 設定4：タグ機能　有効化：true , 無効：false
	// $myPostType[$myPostTypeName]['taxonomy_page_display']          = true; // 設定5：固定ページとして利用する　有効化：true , 無効：false
	// $myPostType[$myPostTypeName]['revisions_display']              = false; // 設定6：リビジョンを利用する　有効化：true , 無効：false



// //============================================================================
// //
// // ▼ よくある質問
// //
// //============================================================================
// 
// 	$myPostTypeName       = "qa";      // 設定1： POSTタイプのラベル名
// 	$myPostTypeName_label = "よくある質問"; // 設定2： POSTタイプのラベル名
// 	
// 	$myPostType[$myPostTypeName]['post_type']                      = $myPostTypeName;
// 	$myPostType[$myPostTypeName]['post_type_labels_name']          = $myPostTypeName_label;
// 	$myPostType[$myPostTypeName]['post_type_labels_singular_name'] = $myPostTypeName;
// 	
// 	// ▼ カテゴリ―機能
// 	$myPostType[$myPostTypeName]['taxonomy_cat']                   = array(
// 		array(
// 			"cat"            => $myPostTypeName."-cat1", // post_typeに紐づくが自由に設定可能
// 			"label"          => "〇〇カテゴリー",
// 			"singular_label" => "●●カテゴリー",
// 		),
// 	);
// 	
// 	// ▼ タグ機能
// 	$myPostType[$myPostTypeName]['taxonomy_tag']                   = array(
// 		array(
// 			"tag"            => $myPostTypeName."-tag1", // post_typeに紐づくが自由に設定可能
// 			"label"          => "〇〇タグ",
// 			"singular_label" => "●●タグ",
// 		),
// 	);
// 	
// 	$myPostType[$myPostTypeName]['taxonomy_post_type']             = $myPostTypeName;
// 	$myPostType[$myPostTypeName]['taxonomy_cat_display']           = true;  // 設定3：カテゴリー有効化：true , 無効：false
// 	$myPostType[$myPostTypeName]['taxonomy_tag_display']           = false; // 設定4：タグ機能　有効化：true , 無効：false
// 	$myPostType[$myPostTypeName]['taxonomy_page_display']          = false; // 設定5：固定ページとして利用する　有効化：true , 無効：false




/*
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

■ カスタムタクソノミーを管理画面に追加

■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */

function create_post_type() {

	global $myPostType;
	$menu_position = 5;

	foreach($myPostType as $k => $v){

		// カスタム投稿を固定ページとして扱うか
		if( $v['taxonomy_page_display'] ){
			$capability_type = 'page';
			$page_attributes = 'page-attributes';
			$hierarchical = true;
		} else {
			$capability_type = 'post';
			$page_attributes = '';
			$hierarchical = false;
		}	
		//=============================

		register_post_type( $v['post_type'], /* post-type */
			array(
				'labels' => array(
					'name' => __( $v['post_type_labels_name'] ),
					'singular_name' => __( $v['post_type_labels_singular_name'] ),
				),
				'exclude_from_search' =>false ,
				'public' => true,

				'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ,'comments','page-attributes' ,$page_attributes ),
				'capability_type' => $capability_type, //カスタム投稿タイプを固定ページとして利用するか
				'hierarchical' => $hierarchical,


				'menu_position' => $menu_position++, //　メニューの表示位置
				'has_archive' => true,
			)
		);


		//カスタムタクソノミー【カテゴリー】(配列の指定により複数設定可能）
		//=============================
		if( $v['taxonomy_cat_display'] ): // << カテゴリーが有効の場合
			foreach( $v['taxonomy_cat'] as $cat_k => $cat_v ){
				register_taxonomy(
					$cat_v['cat'], 
					$v['taxonomy_post_type'], 
					array(
					  'hierarchical'          => true, // <<< カテゴリーの場合はここが「true」になる
					  'update_count_callback' => '_update_post_term_count',
					  'label'                 => $cat_v['label'],
					  'singular_label'        => $cat_v['singular_label'],
					  'public'                => true,
					  'show_ui'               => true
					)
				);
			}
		endif;

		//カスタムタクソノミー【タグ】(配列の指定により複数設定可能）
		//=============================
		if( $v['taxonomy_tag_display'] ): // << カテゴリーが有効の場合
			foreach( $v['taxonomy_tag'] as $tag_k => $tag_v ){
				register_taxonomy(
					$tag_v['tag'], 
					$v['taxonomy_post_type'], 
					array(
					  'hierarchical'          => false, // <<< タグの場合はここが「false」になる
					  'update_count_callback' => '_update_post_term_count',
					  'label'                 => $tag_v['label'],
					  'singular_label'        => $tag_v['singular_label'],
					  'public'                => true,
					  'show_ui'               => true
					)
				);
			}
		endif;

	} //foreach
}

add_action( 'init', 'create_post_type' );


/*
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

管理画面メニューの「メディア」を追加したカスタム投稿メニューの下部に移動する
これはあくまでも一覧の表示を整理するためで必須ではない

参考：http://blog.qrious.jp/3297
カスタム投稿タイプを5個以上追加したらメディアの下に回っちゃうんです！！

■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */

function customize_menus(){
  global $menu;
  $menu[25] = $menu[10];  //メディアの移動
  unset($menu[10]);
}
add_action( 'admin_menu', 'customize_menus' );


/*
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

カスタム投稿タイプにリビジョンを追加する

参考
https://illbenet.jp/view/103

■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
function add_posttype_revisions() {

	global $myPostType;

	foreach($myPostType as $k => $v){

		//カスタムタクソノミー【カテゴリー】(配列の指定により複数設定可能）
		//=============================
		if( $v['revisions_display'] ): // << リビジョンが有効の場合
			add_post_type_support( __( $v['post_type_labels_singular_name'] ), 'revisions' );
		endif;	
	}
}

add_action('init', 'add_posttype_revisions');


/*
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

■ カスタムタクソノミーにフィルター （絞り込み機能追加）

■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */

//親タクソノミーの名称を含んだ名前でソート
function compareArray($a, $b) {
	if ( $a->name < $b->name ) return -1;
	if ( $a->name > $b->name ) return 1;
	return 0;
}

add_action( 'restrict_manage_posts', 'add_post_taxonomy_restrict_filter');
function add_post_taxonomy_restrict_filter() { 

	global $post_type; 
	global $myPostType;

	foreach($myPostType as $k => $v){

		if ( $k == $post_type) { 

			// ****************************************
			// カテゴリーの検索ドロップダウン
			// ****************************************

			if( $v['taxonomy_cat_display'] ): // << カテゴリーが有効の場合
				foreach( $v['taxonomy_cat'] as $cat_k => $cat_v ){

					echo '<select name="'.$cat_v['cat'].'">';
					echo '<option value="">'.$cat_v['label'].'指定なし</option>';
					$terms = array();
					$terms = get_terms($cat_v['cat'], 'orderby=term_group');

					//親タクソノミーの名称を取得して配列を変更
					foreach ($terms as $term) {
						if ($term->parent > 0) {
							$parents = get_term($term->parent, $cat_v['cat']);
							$parent = $parents->name . " ";
							$term->name = $parent . " " . $term->name;
						} else {
							$term->name = $term->name;
						}
					}
					uasort($terms, 'compareArray');
					foreach ($terms as $term) {
						//タクソノミーを選んだときにselectedがつくようにする
						if ($term->slug === $_REQUEST[$cat_v['cat']]) {
							$selected = " selected";
						} else {
							$selected = "";
						}
						echo '<option value="'.$term->slug.'"'.$selected.'>'.$term->name.'</option>';
					}
					echo '</select>';
				}
			endif;


			// ****************************************
			// タグの検索ドロップダウン
			// ****************************************

			if( $v['taxonomy_tag_display'] ): // << タグーが有効の場合
				foreach( $v['taxonomy_tag'] as $tag_k => $tag_v ){

					echo '<select name="'.$tag_v['tag'].'">';
					echo '<option value="">'.$tag_v['label'].'指定なし</option>';
					$terms = array();
					$terms = get_terms($tag_v['tag'], 'orderby=term_group');

					//親タクソノミーの名称を取得して配列を変更
					foreach ($terms as $term) {
						if ($term->parent > 0) {
							$parents = get_term($term->parent, $tag_v['tag']);
							$parent = $parents->name . " ";
							$term->name = $parent . " " . $term->name;
						} else {
							$term->name = $term->name;
						}
					}
					uasort($terms, 'compareArray');
					foreach ($terms as $term) {
						//タクソノミーを選んだときにselectedがつくようにする
						if ($term->slug === $_REQUEST[$tag_v['tag']]) {
							$selected = " selected";
						} else {
							$selected = "";
						}
						echo '<option value="'.$term->slug.'"'.$selected.'>'.$term->name.'</option>';
					}
					echo '</select>';
				}
			endif;
		}

	} //foreach
}

/*
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

■　カスタム投稿一覧画面にターム名を表示させる

■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */

// カスタム投稿一覧画面の列名に「カテゴリー（ターム）」という名称を追加する

function show_term_area( $defaults ) {
	global $myPostType;
	foreach($myPostType as $k => $v){
		$defaults['post_type'] = 'ターム';
	}
	return $defaults;
}
add_filter('manage_posts_columns', 'show_term_area', 15, 1);



// カスタム投稿一覧画面の列に投稿に設定されたカテゴリー（ターム）の一覧を表示する

function show_term_area_id($column_name, $id) {

	global $myPostType;

	foreach($myPostType as $k => $v){

		foreach( $v['taxonomy_cat'] as $cat_k => $cat_v ){
			if( $v['taxonomy_cat_display']){
				// カスタム投稿一覧画面の情報を判別する
				if( $_GET['post_type'] == $v['post_type'] ){
					$terms = $terms = get_the_terms( $id, $cat_v['cat'] );
					$cnt = 0;
					foreach( (array)$terms as $var) {
						echo $cnt == 0 ? "<p style='font-weight:bold;margin-bottom:0;background:#eee;padding:3px 5px;box-shadow:0px 0px 3px 2px #fcfcfc;border-radius:3px;'>▼ ".$cat_v['label']."</p>" : "";
						echo $cnt != 0 ? " <span style='color:#ccc;'>|</span> " : "";
						echo "$var->name";
						++$cnt;
					}
				}
			}
		}
		foreach( $v['taxonomy_tag'] as $tag_k => $tag_v ){
			if( $v['taxonomy_tag_display']){
				// カスタム投稿一覧画面の情報を判別する
				if( $_GET['post_type'] == $v['post_type'] ){
					$terms = $terms = get_the_terms( $id, $tag_v['tag'] );
					$cnt = 0;
					foreach( (array)$terms as $var) {
						echo $cnt == 0 ? "<p style='font-weight:bold;margin-bottom:0;background:#eee;padding:3px 5px;box-shadow:0px 0px 3px 2px #fcfcfc;border-radius:3px;'>▼ ".$tag_v['label']."</p>" : "";
						echo $cnt != 0 ? " <span style='color:#ccc;'>|</span> " : "";
						echo "$var->name";
						++$cnt;
					}
				}
			}
		}

	}
}
add_action('manage_posts_custom_column', 'show_term_area_id', 15, 2);




/*
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

■　通常の「投稿」の名前 を独自の物に変更する

■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */

// WordPressの「投稿」の名称を独自の名称に変更する場合は
// ここで名称を変更する

// function custom_post_labels( $labels ) {
// 
// 	$base_name = "ブログ";
// 
// 	$labels->name                  = $base_name; // 投稿
// 	$labels->slug                  = 'blog'; // 投稿
// 	$labels->singular_name         = $base_name; // 投稿
// 	$labels->add_new               = '新規追加'; // 新規追加
// 	$labels->add_new_item          = $base_name.'を追加'; // 新規投稿を追加
// 	$labels->edit_item             = '投稿の編集'; // 投稿の編集
// 	$labels->new_item              = '新規'.$base_name; // 新規投稿
// 	$labels->view_item             = $base_name.'を表示'; // 投稿を表示
// 	$labels->search_items          = $base_name.'を検索'; // 投稿を検索
// 	$labels->not_found             = $base_name.'が見つかりませんでした。'; // 投稿が見つかりませんでした。
// 	$labels->not_found_in_trash    = 'ゴミ箱内に'.$base_name.'が見つかりませんでした。'; // ゴミ箱内に投稿が見つかりませんでした。
// 	$labels->parent_item_colon     = ''; // (なし)
// 	$labels->all_items             = $base_name.'一覧'; // 投稿一覧
// 	$labels->archives              = $base_name.'アーカイブ'; // 投稿アーカイブ
// 	$labels->insert_into_item      = $base_name.'に挿入'; // 投稿に挿入
// 	$labels->uploaded_to_this_item = 'この'.$base_name.'へのアップロード'; // この投稿へのアップロード
// 	$labels->featured_image        = 'アイキャッチ画像'; // アイキャッチ画像
// 	$labels->set_featured_image    = 'アイキャッチ画像を設定'; // アイキャッチ画像を設定
// 	$labels->remove_featured_image = 'アイキャッチ画像を削除'; // アイキャッチ画像を削除
// 	$labels->use_featured_image    = 'アイキャッチ画像として使用'; // アイキャッチ画像として使用
// 	$labels->filter_items_list     = $base_name.'リストの絞り込み'; // 投稿リストの絞り込み
// 	$labels->items_list_navigation = $base_name.'リストナビゲーション'; // 投稿リストナビゲーション
// 	$labels->items_list            = $base_name.'リスト'; // 投稿リスト
// 	$labels->menu_name             = $base_name; // 投稿
// 	$labels->name_admin_bar        = $base_name; // 投稿
// 	return $labels;
// }
// add_filter( 'post_type_labels_post', 'custom_post_labels' );




