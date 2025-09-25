
<!-- スクロールでページ上部に theader固定（時刻表用に） -->
<script src="<?=get_bloginfo('template_directory'); ?>/js/mkoryak-floatThead/dist/jquery.floatThead.min.js"></script>
<script>
jQuery(function () {
    var table = jQuery('.timetableBox__tbl');
    table.floatThead({
        position: 'absolute'
    });
});
</script>


<!-- 表内クリック時に色をつける -->
<script>
jQuery(function () {

  jQuery(".timetableBox__tbl td").click(function () {
    var idx = $(this).index() + 1;
    var tds = $(this).closest(".timetableBox__tbl").find("td:nth-child(" + idx + ")");

	// 初期化
    tds.css("background-color", "");
    jQuery('.timetableBox__tbl td').css("background-color", "");
    jQuery('.timetableBox__tbl td').siblings().css('background', '');

	// 色設定
    tds.css("background-color", "#ccebff");
    jQuery(this).css("background-color", "#50ade8");
    jQuery(this).siblings().css('background', '#ccebff');

 });



});
</script>

<!-- マウスドラッグスクロール（時刻表用に）-->
<!-- <script src="https://cdn.it-the-best.com/jquery/plugin/listmousedrag/2.6.1/listmousedragscroll.min.js" id="js_listmousedragscroll"></script> -->
<script src="<?=get_bloginfo('template_directory'); ?>/js/listmousedragscroll.mini.js"></script>
<script>
jQuery(function () {
	jQuery(".timetableBox").setListmousedragscroll();
});
</script>


<?php if( fnc_user_agent() == "SP" ): ?>
<!-- SCROLL HINT（時刻表用に） -->
<link rel="stylesheet" href="https://unpkg.com/scroll-hint@latest/css/scroll-hint.css">
<script src="https://unpkg.com/scroll-hint@latest/js/scroll-hint.min.js"></script>
<script>
new ScrollHint('.timetableBox', {
  i18n: {
    scrollable: 'スクロールできます'
  }
});

</script>
<?php endif; ?>

<script src="<?=get_bloginfo('template_directory'); ?>/js/jqDoubleScroll-master/jquery.doubleScroll.js"></script>
<script>
/// jQuery(document).ready(function() {
///    //jQuery('.timetableBox').doubleScroll();
///    //jQuery('.timetableBox').doubleScroll({resetOnWindowResize: true});
/// 
/// });
</script>
<style>
.doubleScroll-scroll-wrapper{
	margin-bottom:5px;
}
</style>

<script>

jQuery(function () {
	jQuery('table').hover( function(){jQuery("#popup_red").show();},function(){jQuery("#popup_red").hide();});

	 jQuery('table').hover(function(){	//色領域にマウスカーソルがホバーしているとき開始
		function MouseMoveFunc(e){	//マウスカーソルが移動するたびに実行する関数
 

			// マウスカーソルの座標を取得
			// var mouse_x = e.clientX - 200 ;	//マウスカーソルのX座標 5px右へ調整
			// var mouse_y = jQuery(window).scrollTop() + e.clientY + 5;	//マウスカーソルのY座標 現在のスクロール位置＋5px下へ調整



			// マウスカーソルの座標を取得
			//var mouse_x = e.clientX - 200 ;	//マウスカーソルのX座標 5px右へ調整
			//var mouse_y = jQuery(window).height() / 2;	//マウスカーソルのY座標 現在のスクロール位置＋5px下へ調整

			jQuery("#popup").css({ "display":"block" });		

			// 吹き出しの位置座標を取得したマウスカーソルの座標に変換
			jQuery("#popup").css({ "position": "absolute", });
			jQuery("#popup").center();

		}
 
		if(document.addEventListener){
			document.addEventListener("mousemove" , MouseMoveFunc);
		}else if(document.attachEvent){
			document.attachEvent("onmousemove" , MouseMoveFunc);
		}

	});


	window.onmousewheel = function(event){
		jQuery("#popup").css({ "display":"none" });		
	}


	jQuery.fn.center = function () {
		this.css("position","absolute");
		this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) - 40 + "px");
		this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) - 40 + "px");
		return this;
	}

});
</script>
