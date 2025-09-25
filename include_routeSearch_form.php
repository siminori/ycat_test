<?php

	session_start();



	global $post;
	$slug = $post->post_name;

	$selected = " selected = 'selected' ";
	$checked  = " checked = 'checked' ";

	$hh[5] = "5時台"; $hh[6] = "6時台"; $hh[7] = "7時台"; $hh[8] = "8時台"; $hh[9] = "9時台"; $hh[10] = "10時台"; $hh[11] = "11時台"; $hh[12] = "12時台"; $hh[13] = "13時台"; $hh[14] = "14時台";
	$hh[15] = "15時台"; $hh[16] = "16時台"; $hh[17] = "17時台"; $hh[18] = "18時台"; $hh[19] = "19時台"; $hh[20] = "20時台"; $hh[21] = "21時台"; $hh[22] = "22時台"; $hh[23] = "23時台"; $hh[24] = "24時台";

	// $mm[00] = "00分"; $mm[01] = "01分"; $mm[02] = "02分"; $mm[03] = "03分"; $mm[04] = "04分"; $mm[05] = "05分"; $mm[06] = "06分"; $mm[07] = "07分"; $mm[08] = "08分"; $mm[09] = "09分"; $mm[10] = "10分";
	// $mm[11] = "11分"; $mm[12] = "12分"; $mm[13] = "13分"; $mm[14] = "14分"; $mm[15] = "15分"; $mm[16] = "16分"; $mm[17] = "17分"; $mm[18] = "18分"; $mm[19] = "19分"; $mm[20] = "20分";
	// $mm[21] = "21分"; $mm[22] = "22分"; $mm[23] = "23分"; $mm[24] = "24分"; $mm[25] = "25分"; $mm[26] = "26分"; $mm[27] = "27分"; $mm[28] = "28分"; $mm[29] = "29分"; $mm[30] = "30分";
	// $mm[31] = "31分"; $mm[32] = "32分"; $mm[33] = "33分"; $mm[34] = "34分"; $mm[35] = "35分"; $mm[36] = "36分"; $mm[37] = "37分"; $mm[38] = "38分"; $mm[39] = "39分"; $mm[40] = "40分";
	// $mm[41] = "41分"; $mm[42] = "42分"; $mm[43] = "43分"; $mm[44] = "44分"; $mm[45] = "45分"; $mm[46] = "46分"; $mm[47] = "47分"; $mm[48] = "48分"; $mm[49] = "49分"; $mm[50] = "50分";
	// $mm[51] = "51分"; $mm[52] = "52分"; $mm[53] = "53分"; $mm[54] = "54分"; $mm[55] = "55分"; $mm[56] = "56分"; $mm[57] = "57分"; $mm[58] = "58分"; $mm[59] = "59分";

	if( $_GET['s_rosen'] == "" ) :
		if( $slug == 'narita' ) :
			$_GET['s_rosen'] = "narita";
		elseif( $slug == 'haneda' ) :
			$_GET['s_rosen'] = "haneda";
		elseif( is_front_page() ):
			$_GET['s_rosen'] = "narita";
		endif;
	else:
	endif;

	// 検索した内容をセッション変数に設定する
	if ( ! is_front_page() ){
		if( isset( $_GET['s_rosen']) ){
			$_SESSION['s_rosen'] = $_GET['s_rosen'];
		}
		if( isset( $_GET['s_hatyaku']) ){
			$_SESSION['s_hatyaku'] = $_GET['s_hatyaku'];
		}

		if( isset( $_GET['s_dayOfWeek']) ){
			$_SESSION['s_dayOfWeek'] = $_GET['s_dayOfWeek'];
		}

		if( isset( $_GET['s_time']) ){
			$_SESSION['s_time'] = $_GET['s_time'];
		}
		if( isset( $_GET['s_busstop']) ){
			$_SESSION['s_busstop'] = $_GET['s_busstop'];
		}
	}
?>

<div class="routeSearch translationClass">
	<form action="<?=get_bloginfo("url"); ?>/rote/search/#serchTit" method="GET">
		<table class="tbl01">
			<tr>
				<th><span>路線</span></th>
				<td>
					<?php
						$lst = array();
						$lst['narita'] = "成田空港";
						$lst['haneda'] = "羽田空港";
					?>
	
					<?php foreach( $lst as $k => $v ): ?>	
					<label><input type="radio" name="s_rosen" value="<?=$k;?>"<?=($_GET['s_rosen']) == $k ? $checked : "" ;?> required><?=$v;?></label>
					<?php endforeach; ?>
				</td>
			</tr>
			<tr>
				<th><span>乗車</span></th>
				<td>
					<?php

					$lst = array();
					$lst['out'] = "YCAT⇒成田空港";
					$lst['in'] = "成田空港⇒YCAT";

					$cnt = 1;	
					foreach( $lst as $k => $v ): ?>	
					<label class="hatyakuLabel_<?=sprintf('%02d',$cnt++);?>"><input type="radio" name="s_hatyaku" value="<?=$k;?>"<?=($_GET['s_hatyaku']) == $k ? $checked : "" ;?> required><span><?=$v;?></span></label>
					<?php endforeach; ?>
				</td>
			</tr>

			<tr class="dayOfWeek_row">
				<th><span>ご利用の曜日</span></th>
				<td>
					<?php

					$lst = array();
					$lst['weekday'] = "平日";
					$lst['holiday'] = "土休日";

					$cnt = 1;	
					foreach( $lst as $k => $v ): ?>	
					<label class=""><input type="radio" name="s_dayOfWeek" value="<?=$k;?>"<?=($_GET['s_dayOfWeek']) == $k ? $checked : "" ;?> required><span><?=$v;?></span></label>
					<?php endforeach; ?>
				</td>
			</tr>


			<tr>
				<th><span>ターミナル</span></th>
				<td>
					<select name="s_busstop" class="s_busstop" required>
						<option class="none"></option>
					<?php
						$lst = array();
						$busstop = "narita_in";
						$lst[] = '成田空港第3ターミナル';
						$lst[] = '成田空港第2ターミナル';
						$lst[] = '成田空港第1ターミナル南ウイング';
						$lst[] = '成田空港第1ターミナル北ウイング';
					?>
						<?php foreach( $lst as $k => $v): ?>
						<option data-busstop="<?=$busstop;?>" class="<?=$busstop;?>"<?=($_GET['s_busstop']) == $v ? $selected: "" ;?> value="<?=$v;?>"><?=$v;?></option>
						<?php endforeach; ?>
					<?php
						$lst = array();
						$busstop = "narita_out";
						$lst[] = '成田空港第1ターミナル';
						$lst[] = '成田空港第2ターミナル';
						$lst[] = '成田空港第3ターミナル';
					?>
						<?php foreach( $lst as $k => $v): ?>
						<option data-busstop="<?=$busstop;?>" class="<?=$busstop;?>"<?=($_GET['s_busstop']) == $v ? $selected: "" ;?> value="<?=$v;?>"><?=$v;?></option>
						<?php endforeach; ?>
	
					<?php
						$lst = array();
						$busstop = "haneda_in";
						$lst[] ='羽田空港第3ターミナル';
						$lst[] ='羽田空港第2ターミナル';
						$lst[] ='羽田空港第1ターミナル';
					?>
						<?php foreach( $lst as $k => $v): ?>
						<option data-busstop="<?=$busstop;?>" class="<?=$busstop;?>"<?=($_GET['s_busstop']) == $v ? $selected: "" ;?> value="<?=$v;?>"><?=$v;?></option>
						<?php endforeach; ?>
	
					<?php
						$lst = array();
						$busstop = "haneda_out";
						$lst[] = '羽田空港第1ターミナル';
						$lst[] = '羽田空港第2ターミナル';
						$lst[] = '羽田空港第3ターミナル';
					?>
						<?php foreach( $lst as $k => $v): ?>
						<option data-busstop="<?=$busstop;?>" class="<?=$busstop;?>"<?=($_GET['s_busstop']) == $v ? $selected: "" ;?> value="<?=$v;?>"><?=$v;?></option>
						<?php endforeach; ?>
	
					</select>
				<td>
			</tr>
			<tr>
				<th><span>時間</span></th>
				<td>
					<select name="s_time" id="s_time" required>
						<option value=""></option>
						<?php foreach( $hh as $k => $v ): ?>
						<option value="<?=$k;?>"<?=($_GET['s_time']) == $k ? $selected: "" ;?>><?=$v;?></option>
						<?php endforeach; ?>
					</select>
					<!-- <select name="s_minutes" id="s_minutes">
						<option value=""></option>
						<?php //foreach( $mm as $k => $v ): ?>
						<option value="<?php //echo $k;?>"<?php // echo ($_GET['s_minutes']) == $k ? $selected: "" ;?>><?php //echo $v;?></option>
						<?php //endforeach; ?>
					</select> -->
				</td>
	
			</tr>
		</table>
		<input type="hidden" value="<?=$_GET['searchRoute_id']?>" name="searchRoute_id" />
		<div class="routeSearchBtn"> <input type="submit" value="検　　索" /> </div>
	</form>
</div>

	<style>
	span.narita_in,
	span.narita_out,
	span.haneda_in,
	span.haneda_out{
		display:none;
	}


	.routeSearch table {
		width:90%;
	}
	.routeSearch table th span {
		background: #999;
		border-radius: 8px;
		color: #fff;
		display: block;
		width:60%;
		padding: 10px;
		position: relative;
		font-size:18px;
		text-align:center;
	}
	.routeSearch table th span:after{
		content:"";
		position:absolute;
		background:url(<?=get_bloginfo('template_directory'); ?>/img/search_arrow.png) no-repeat right center;
		background-size: cover;
		width:32px;
		height:48px;
		right:-26px;
		top:0;
		bottom:0;
		margin:auto;
	}		
	tr.dayOfWeek_row{
		display:none;
	}
	@media screen and (max-width: 600px) {
		.routeSearch table th span {
			width:90%;
			padding: 5px;
			font-size:14px;
			box-sizing:border-box;	
		}
		.routeSearch table th span:after{
			content:none;
		}
	}

	</style>
	<script>
	jQuery(function() {

		// -------------------------------
		// 初期設定：変数初期化
		// -------------------------------
		v_rosen   = "";
		v_hatyaku = "";
		v_busstop = "";

		// -------------------------------
		// 初期設定：ターミナルのoptionタグに「span」を付与する
		// -------------------------------
		jQuery(".s_busstop option").each(function(i){
				classStr = jQuery(this).attr('class');
				jQuery(this).wrap('<span class="'+classStr+'">');
		});
		// 3. 路線、乗車の選択を元に該当するoption の spanタグを削除する
		//
		<?php if( $_GET['s_rosen'] <> "" && $_GET['s_hatyaku']): ?>
		jQuery('option.<?=$_GET['s_rosen']."_".$_GET['s_hatyaku'];?>').unwrap();

		jQuery(".s_busstop").val("<?=$_GET['s_busstop']?>");
		jQuery(".s_busstop").find("option[value='<?=$_GET['s_busstop']?>']").attr("selected", "selected");
		<?php endif; ?>













		// -------------------------------
		// 初期設定：
		// -------------------------------
		<?php if( $_GET['searchRoute_id'] <> ""): ?>
		jQuery('select option.<?=$_GET['searchRoute_id']?>').css("display","block");
		<?php endif; ?>

		// -------------------------------
		// 初期設定：GET情報 s_rosenが設定されている場合「 s_rosen 」のテキスト表示を切り替える
		// -------------------------------
		<?php if( $_GET['s_rosen'] == "narita" ) : ?>
		//jQuery('.hatyakuLabel_01 span').text("YCAT⇒成田空港");
		//jQuery('.hatyakuLabel_02 span').text("成田空港⇒YCAT");
		<?php elseif( $_GET['s_rosen'] == "haneda" ) : ?>
		//jQuery('.hatyakuLabel_01 span').text("YCAT⇒羽田空港");
		//jQuery('.hatyakuLabel_02 span').text("羽田空港⇒YCAT");
		<?php endif; ?>


		<?php
		// ****************************************
		// PHP SESSION
		// ****************************************
		?>
		<?php if( isset( $_SESSION['s_rosen']) ): ?>
			<?php if( $_SESSION['s_rosen'] == "narita" ) : ?>
				jQuery('.hatyakuLabel_01 span').text("YCAT⇒成田空港");
				jQuery('.hatyakuLabel_02 span').text("成田空港⇒YCAT");

				//「平日 / 土休日」の行を隠す
				jQuery('.dayOfWeek_row').css("display", "none");

			<?php elseif( $_SESSION['s_rosen'] == "haneda" ) : ?>
				jQuery('.hatyakuLabel_01 span').text("YCAT⇒羽田空港");
				jQuery('.hatyakuLabel_02 span').text("羽田空港⇒YCAT");

				//「平日 / 土休日」の行を表示
				jQuery('.dayOfWeek_row').css("display", "table-row");

			<?php endif; ?>
				jQuery('input[name="s_rosen"]').val(['<?=$_SESSION['s_rosen']?>']);
		<?php endif; ?>

		<?php if( isset( $_SESSION['s_hatyaku']) ): ?>
				jQuery('input[name="s_hatyaku"]').val(['<?=$_SESSION['s_hatyaku']?>']);
		<?php endif; ?>

		<?php if( isset( $_SESSION['s_time']) ): ?>
				jQuery('select[name="s_time"]').val(['<?=$_SESSION['s_time']?>']);
		<?php endif; ?>

		<?php if( isset( $_SESSION['s_busstop']) ): ?>
			window.onload = function(){
				//jQuery('input[name="s_rosen"]').trigger("change")
				jQuery('input[name="s_hatyaku"]').trigger("change")
				jQuery('select[name="s_busstop"]').val(['<?=$_SESSION['s_busstop']?>']);
			}
		<?php endif; ?>



		
		jQuery('input[name="s_rosen"]').change(function() {
			// -------------------------------
			// s_rosen（路線）の選択を元に　乗車のラベルを「成田」or「羽田」の表示に切り替える
			// -------------------------------

			selectText =  $(this).val();

			if( selectText == "narita" ){
				jQuery('.hatyakuLabel_01 span').text("YCAT⇒成田空港");
				jQuery('.hatyakuLabel_02 span').text("成田空港⇒YCAT");

				//「平日 / 土休日」の行を隠す
				jQuery('.dayOfWeek_row').css("display", "none");

			} else if( selectText == "haneda" ){
				jQuery('.hatyakuLabel_01 span').text("YCAT⇒羽田空港");
				jQuery('.hatyakuLabel_02 span').text("羽田空港⇒YCAT");

				//「平日 / 土休日」の行を表示
				jQuery('.dayOfWeek_row').css("display", "table-row");

			}


			// -------------------------------
			// 表示の初期化
			// -------------------------------

			jQuery('input[name="searchRoute_id"]').val("");

			v_rosen = jQuery('input[name="s_rosen"]:checked').val() ;
			v_hatyaku = jQuery('input[name="s_hatyaku"]:checked').val() ;

			jQuery('input[name="searchRoute_id"]').val("");
			jQuery('select[name="s_busstop"]').prop("selectedIndex", 0);

			// -------------------------------
			// ターミナルの表示を切り替える
			// -------------------------------
			//
			// 1. spanTagの付いたoptiontagのspanを削除する
			//
			jQuery(".s_busstop span option").each(function(i){
					classStr = jQuery(this).attr('class');
					jQuery(this).unwrap();
			});
			//
			// 2. optiontagにspanを再度付与する
			//
			jQuery(".s_busstop option").each(function(i){
					classStr = jQuery(this).attr('class');
					jQuery(this).wrap('<span class="'+classStr+'">');
			});
			//
			// 3. 路線、乗車の選択を元に該当するoption の spanタグを削除する
			//
			jQuery('option.' + v_rosen + '_' + v_hatyaku).unwrap();



			jQuery('input[name="searchRoute_id"]').val(v_rosen + "_" + v_hatyaku);

		});
		jQuery('input[name="s_hatyaku"]').change(function() {

			// -------------------------------
			// 表示の初期化
			// -------------------------------

			jQuery('input[name="searchRoute_id"]').val("");
			v_rosen = jQuery('input[name="s_rosen"]:checked').val() ;
			v_hatyaku = jQuery('input[name="s_hatyaku"]:checked').val() ;
			jQuery('select[name="s_busstop"]').prop("selectedIndex", 0);

			// -------------------------------
			// ターミナルの表示を切り替える
			// -------------------------------
			//
			// 1. spanTagの付いたoptiontagのspanを削除する
			//
			jQuery(".s_busstop span option").each(function(i){
					classStr = jQuery(this).attr('class');
					jQuery(this).unwrap();
			});
			//
			// 2. optiontagにspanを再度付与する
			//
			jQuery(".s_busstop option").each(function(i){
					classStr = jQuery(this).attr('class');
					jQuery(this).wrap('<span class="'+classStr+'">');
			});
			//
			// 3. 路線、乗車の選択を元に該当するoption の spanタグを削除する
			//
			jQuery('option.' + v_rosen + '_' + v_hatyaku).unwrap();



			jQuery('input[name="searchRoute_id"]').val(v_rosen + "_" + v_hatyaku);
		});
		

	});
	</script>
<?php //var_dump( $_SESSION ); ?>
