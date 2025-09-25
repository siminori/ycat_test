/*=================================
関数：（即時関数）ロールオーバー画像設定
引数：なし
使用方法１：
    画像にファイル名に「xxxx_on.jpg」、「xxxx_off.jpg」という画像を2枚用意
    ※画像の拡張指名は「jpg」以外でも問題なく動く
使用方法２：
    常に状態をキープする場合は画像のクラスに「class="active"」を指定する
    ※マウスオーバーによる状態変化を行いたくない場合
================================= */
//jQuery(function () {
//    (function rollOverImg() {
//        jQuery("img").hover(function () {
//            this.src = this.src.replace("_off", "_on");
//        }, function () {
//            if (!jQuery(this).hasClass('active')) {
//                this.src = this.src.replace("_on", "_off");
//            }
//        });
//    })();
//});
/*=================================
関数：（即時関数）マウスオーバー：透過
引数：なし
使用方法１：
    画像にファイル名に「xxxx_on.jpg」、「xxxx_off.jpg」という画像を2枚用意
    ※画像の拡張指名は「jpg」以外でも問題なく動く
使用方法２：
    常に状態をキープする場合は画像のクラスに「class="active"」を指定する
    ※マウスオーバーによる状態変化を行いたくない場合
================================= */
(function opacityImg() {
    jQuery(function () {
        jQuery.hamFunction.opacityRollOver({
            /*適応させる部分の変更*/
            fnClass: '.over',
            /*デフォルトの透明度指定*/
            opacityDef: 1.0,
            /*フェードの時間指定*/
            fadeTime: 200,
            /*マウスオーバー時の透明度の指定*/
            opacityOn: 0.6,
            /*マウスアウト時の最初の透明度の指定*/
            opacityOff: 1.0
        });
    });
    jQuery.hamFunction = {
        opacityRollOver: function (options) {
            var c = jQuery.extend(options);
            jQuery(c.fnClass).each(function () {
                jQuery(this).css('opacity', c.opacityDef)
                    .hover(function () {
                    jQuery(this).fadeTo(c.fadeTime, c.opacityOn);
                }, function () {
                    jQuery(this).fadeTo(c.fadeTime, c.opacityOff);
                });
            });
        }
    };
})();
/*=================================
関数：pageLink (ページ内リンクスクロール関数）
引数：ヘッダーの高さ（デフォルト = 0）
使用方法１：
    ページトップ等のページ内リンクをスクロールで表現
使用方法２：
    別ページへのページ内リンクがクリックされた場合、ヘッダー固定分だけ表示をずらす
================================= */
function pageLink(headerHight) {
    if (headerHight === void 0) { headerHight = 0; }
    // ページ内リンククリック時のスクロール処理
    jQuery('a[href^=#]').click(function () {
        var href = jQuery(this).attr("href");
        var target = jQuery(href == "#" || href == "" ? 'html' : href);
        var position = target.offset().top - headerHight; //ヘッダの高さ分位置をずらす
        jQuery("html, body").animate({
            scrollTop: position
        }, 550, "swing");
        return false;
    });
    // 別ページへのページ内リンクがクリックされた場合に高さを調整する
    // 別ページへのページ内リンクの場合はスクロールアニメーションは処理されない
    jQuery(window).on('load', function () {
        var url = jQuery(location).attr('href');
        if (url.indexOf("#") != -1) {
            var anchor = url.split("#");
            var target = jQuery('#' + anchor[anchor.length - 1]);
            if (target.length) {
                var pos = Math.floor(target.offset().top) - headerHight; //ヘッダの高さ分位置をずらす
                jQuery("html, body").animate({
                    scrollTop: pos
                }, 0);
            }
        }
    });
}
/* 使用例------------- */
//jQuery(function () {
//    pageLink(100);
//});
/*=================================
関数：pageScrollFloatDisplay
引数１：scrollHeight：何ピクセルスクロールしたら要素が表示されるか
引数２：className：スクロール時に表示させたい要素のクラス名　※ クラス名はドットを含むこと
引数３：positionPoint：top , right bottom , left のを連想配列形式で設定
※設定例　{top:"auto",right:"50px",bottom:"100px":left:"auto"}
================================= */
function pageScrollFloatDisplay(scrollHeight, className, positionPoint) {
    jQuery(function () {
        var topFooterBtn = jQuery(className);
        topFooterBtn.hide();
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > scrollHeight) {
                //ページトップボタンの書式
                topFooterBtn.css({
                    "position": "fixed",
                    "top": positionPoint["top"],
                    "right": positionPoint["right"],
                    "bottom": positionPoint["bottom"],
                    "left": positionPoint["left"],
                    "z-index": "99999",
                    "margin": "auto"
                });
                topFooterBtn.fadeIn();
            }
            else {
                //ボタンの非表示方法
                topFooterBtn.fadeOut();
            }
        });
    });
}
/* 使用例------------- */
//jQuery(function () {
//    pageScrollFloatDisplay(100, ".pageTop", { top: "auto", right: "50px", bottom: "100px", left: "auto" });
//});
/*=================================
関数：appendFlexChild
引数１：display:flex が指定された親タグ（クラス名 or タグ名など）
引数２：display:flex が指定された子タグ
引数３：display:flex で分割される列の数（3列なら3と指定）
※append された子タグについてはborderや background書式などcssにて適切にリセットすること
================================= */
function appendFlexChild(parentElm, childTag, columnNum) {
    jQuery(function () {
        // display:flex に指定された子要素数を取得
        var childLength = jQuery(parentElm + " " + childTag).length;
        // 子要素数をカラム数で割ったあまりを取得
        var remainder = childLength % columnNum;
        // カラム数からあまりを引いた数が不足した子要素分となる
        var appendChildNum = columnNum - remainder;
        console.log(appendChildNum);
        var elem = "";
        // 不足子要素数とカラム数が一致しない場合のみ子要素を追加（一致する場合は不足する子要素がないため追加しない）
        if (appendChildNum != columnNum) {
            for (var i = -1; ++i < appendChildNum;) {
                elem += '<' + childTag + ' class="emptyChild"></' + childTag + '>';
            }
            // display:flex　の親タグに子要素を追加する
            jQuery(parentElm).append(elem);
        }
    });
}
/* 使用例------------- */
//appendFlexChild(".sample_menu", "li", 3);

/*=================================
関数：imgToYoutube
引数１：なし

HTMLタグ構成

<div class="imgToYoutube">
	<div class="youtubeImg"><img src="damy.jpg" /></div>
	<iframe style="display:none" width="560" height="315" src="" src_data="https://www.youtube-nocookie.com/embed/OLjQtlUly7k?autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

親ボックスclass => imgToYoutube
子要素IMGclass => youtubeImg
iframe => 必ず youtubeImg の隣接になるように設置
iframe => style="display:none"を設置
iframe => srcの属性を空にし src_data に src属性の値を設置
iframe => 自動再生にする場合は src_dataに　?autoplay=1 を設定する

================================= */
function imgToYoutube(){
	$(".imgToYoutube").on('click',function(){
		$(this).find('iframe').each(function() {
			if($(this).attr("src_data")){
				src_data = $(this).attr("src_data");
				$(this).attr("src",src_data);
				$(this).removeAttr("src_data");
				$(this).css({'display':'block'})
			}
		});
		$(this).find('.youtubeImg').each(function() {
			$(this).remove();
		});
	});
}
/* 使用例------------- */
//imgToYoutube();
/*=================================
関数：resizeImagePercent
引数１：css セレクター
引数２：比率（ 0.5 => 50%縮小 , 0.9 => 10%縮小…）
オリジナルの(本来の)サイズを基準にして、画像を指定倍に拡大・縮小する関数
================================= */

function resizeImagePercent( a_targetImage , a_resizeRate ) {
	jQuery( a_targetImage ).each(function(i, o){
	   resizeImg_width  = jQuery( o ).width();
	   resizeImg_height = jQuery( o ).height();
	   jQuery( o ).width(  resizeImg_width * a_resizeRate );
	   jQuery( o ).height( resizeImg_height * a_resizeRate );
	});
}
/* 使用例------------- */
//resizeImagePercent(".tit01__en img", 0.7 );

