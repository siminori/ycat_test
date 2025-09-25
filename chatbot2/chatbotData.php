<?php


require_once( '../../../../wp-load.php' );


header('Content-Type: application/x-javascript; charset=utf-8');

$site = get_bloginfo("url");

$script = <<< EOF


/* ==================================
 * チャットボックスの応答メッセージ
 * ================================== */
var chatData = {
	replyType00 :
		{
			str01 : [
				"<p>",
				" こんにちは!<br />どんな情報をお探しですか？",
				"</p>",
				"<ul class='chatbotBtns'>",
				"	<li><a href='$site/faq/'>成田空港線</a></li>",
				"	<li><a href='$site/faq/#haneda'>羽田空港線</a></li>",
				"	<li><a href='$site/faq/#long'>中・長距離線</a></li>",
				"	<li><a href='$site/faq/#higashiohgishima'>東扇島線</a></li>",
				"	<li><a href='$site/faq/#yokosuka'>葉山・横須賀西地区線</a></li>",
				"	<li><a href='$site/faq/#seaparadise'>横浜・八景島シーパラダイス線</a></li>",
				"	<li><a href='$site/faq/#makuhari'>幕張線</a></li>",
				"	<li><a href='$site/faq/#facility'>施設について</a></li>",
				"	<li><a href='$site/faq/#other'>その他</a></li>",
				"	<li><span class='fancybox over' id='animatedModal03-Btn' href='#animatedModal01'>ホームページを検索する</span></li>",
				"	<!-- <li> <a href='javascript:void(0)' onClick='btnFunc(\"replyType02\")'>製品の資料をダウンロードしたい</a> </li> -->",
				"</ul>"
			].join("")
		},
	replyType01 :
		{
			str01 : [
				"<p>",
				"▼ おススメ製品はこちら",
				"</p>",
				"<ul class='chatbotBtns'>",
				"	<li><a href='javascript:void(0)' onClick='btnFunc('replyType07')'>xxxx</a></li>",
				"</ul>",
				"<hr />",
				"<hr />",
				"<ol>",
				"	<li><a href='javascript:void(0)' onClick='btnFunc('replyType99')'>最初の質問に戻る</a></li>",
				"</ol>"
			].join("")
		}
};


EOF;


echo $script;
