//
//
//
// jquery.cookieを利用
//
//
//
/* ==================================
// 画面への出力
// valはメッセージ内容，personは誰が話しているか
 * ================================== */
function output(val, person) {


  
    const ul = document.getElementById('chat-ul');

    // このdivにテキストを指定
    const div = document.createElement('div');

    if (person === 'robot') { // 相手

		botThinkTime('start');

		//setTimeout( ()=> {

		//	div.classList.add('chat-left');
		//	obj = chatData[val];

		//	Object.keys(obj).forEach(function (key) {


		//			chatBotTxt = obj[key];

		//			cleateLI = document.createElement("li");
		//			ul.appendChild(cleateLI);

		//			createDiv = document.createElement("div");
		//			createDiv.className = "chat-left";

		//			cleateLI.appendChild(createDiv).innerHTML = chatBotTxt;

		//	});

		//	botThinkTime('end');
		//	autoScroll();
		//}, 1500); 
		setTimeout(   (function(){  

			div.classList.add('chat-left');
			obj = chatData[val];

			Object.keys(obj).forEach(function (key) {


					chatBotTxt = obj[key];

					cleateLI = document.createElement("li");
					ul.appendChild(cleateLI);

					createDiv = document.createElement("div");
					createDiv.className = "chat-left";

					cleateLI.appendChild(createDiv).innerHTML = chatBotTxt;

			});

			botThinkTime('end');
			autoScroll();
		}()), 1500); 

    }


}



/* ==================================
// チャットボックス内のリンク押した時の処理
 * ================================== */

function btnFunc( val ) {
	output(val, 'robot');
}

/* ==================================
// チャットボックス内考え中表示
 * ================================== */
function botThinkTime( val ) {
	if( val == 'start' ){
		document.getElementById("chatBotthinkTime").style.display = "block" ;
	} else if( val == 'end' ){
		document.getElementById("chatBotthinkTime").style.display = "none" ;
	}
}




/* ==================================
// 01.チャットボックスの起動（アイコンクリック時）
// 02.チャットボックスの終了（×印クリック）
 * ================================== */
$(function() {

	// 00.チャットボットクローズボタンされている場合
	if( $.cookie('chatbotClose') == "true" ){
		$('.chatBotBox__miniIcon').css('display','none');
		$('.chatBotBox__miniIcon_small').css('display','block');
	}

	// 01.チャットボックスの起動（アイコンクリック時）
	$(".chatBotBox__miniIcon .chatBotBox__miniIcon__img , .chatBotBox__miniIcon_small").click(function () {

		// チャットボットを初期化
		$("#chat-ul").empty();


		// CSS 制御
		$(this).css('display','none');
		$('.chatBotBox').css('bottom','50px');
		$('.chatBotBox__inner').css('display','block');


		// 初期起動 ------------------
		output("replyType00", 'robot');
		//output("replyType100", 'robot');


	}); 

	// 02.チャットボックスの終了（×印クリック）
	$(".chatBotBox__close").click(function () {

		//チャットボットをクローズした場合情報を保持
		$.cookie('chatbotClose',true, { expires: 7 , path:'/' });


		$('.chatBotBox__miniIcon').css('display','block');

		$('.chatBotBox__inner').css('display','none');

		if( $.cookie('chatbotClose') == "true" ){
		
			$('.chatBotBox__miniIcon').css('display','none');
			$('.chatBotBox__miniIcon_small').css('display','block');
		}

		$("#chat-ul").empty();

	}); 

	// 03.チャットボットクローズボタン(最小化ボタン　×）
	$(".chatBoxBox__miniIcon__close").click(function () {
		$('.chatBotBox__miniIcon').css('display','none');
		$('.chatBotBox__miniIcon_small').css('display','block');
	});

});			





/* ==================================
 * チャットボックスのコンテンツ内をスクロール
 * ※要素追加時にチャットボックスの下部へ
 * ================================== */
var $scrollY = 0;
var timeOutID = "";
function autoScroll() {


    const field = document.getElementById('chatField');
	//console.log(field.scrollHeight);
    field.scroll(0, field.scrollHeight - field.clientHeight);


}


/* ==================================
 * チャットボックスの応答メッセージ
 * ================================== */
$(function() {
 
	//セレクトボックスが切り替わったら発動
	$('#chatBotSlecter').change(function() {

		//選択したvalue値を変数に格納
		var val = $(this).val();
		output(val, 'robot');

	});
});
