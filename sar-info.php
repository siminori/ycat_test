<?php


$version = "0.0.1";

if(isset($_GET["cmd"])){

	$option = addslashes(htmlspecialchars(escapeshellcmd($_GET["cmd"])));
	unset($_GET["cmd"]);
	
	switch($option){

		case "cpu":
			$cmd 	 = "/usr/bin/sar -u";
			$head	 = "CPU使用率確認";
			$title	 = "CPU使用率";
			break;
		
		case "load":
			$cmd     = "/usr/bin/sar -q";
			$head	 = "Load Average";
			$title   = "Load Average";
			break;
		
		case "swap":
			$cmd     = "/usr/bin/sar -W";
			$head	 = "スワップ（メモリ）使用率確認";
			$title   = "スワップ使用率";
			break;

	}

	exec($cmd, $output, $flag);

	$result = "";

	if($flag != "0"){
		echo "値の取得に失敗しました\n";
		exit;
	}


	foreach($output as $value){

		$result .= $value . "\n";

	}


$out = <<<END
                <table class="table_head">
				<tr>
					<th>$head</th>
				</tr>
				</table>
				
                <table class="table_01">
				<tr class="source">
					<th>$title</th>
					<td><pre>$result</pre></td>
				</tr>
                </table>
				<div class="pagetop"><p><a href="#Top">ページTOPへ戻る</a></p></div>

END;

}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="robots" content="noindex,nofollow">
<meta http-equiv="content-language" content="ja">
<title>稼働状態 </title>
		
<style>

/*--------------------------------------------------------------------------
   reset
---------------------------------------------------------------------------*/

html,body,div,span,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,abbr,address,cite,code,del,dfn,em,ins,kbd,q,samp,small,strong,
sub,sup,var,b,i,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,
figcaption,figure,footer,header,hgroup,menu,nav,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent;}
body{line-height:1;}
article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block;}
nav ul{list-style:none;}
ul,ol,li,dl,dt,dd{list-style-type:none;list-style-position:outside;}
blockquote,q{quotes:none;}
blockquote:before,blockquote:after,q:before,q:after{content:none;}
a{margin:0;padding:0;font-size:100%;vertical-align:baseline;background:transparent;}
ins{background-color:#ff9;color:#000;text-decoration:none;}
img{vertical-align:top;border:0;}
em{font-style:normal;}
mark{background-color:#ff9;color:#000;font-style:italic;font-weight:bold;}
del{text-decoration:line-through;}
abbr[title],dfn[title]{border-bottom:1px dotted;cursor:help;}
table{border-collapse:collapse;border-spacing:0;}
hr{display:block;height:1px;border:0;border-top:1px solid #ccc;margin:0;padding:0;}
input,select,textarea{font-family:inherit;font-style:inherit;font-weight:inherit;font-size:100%;margin:0;padding:0;vertical-align:baseline;}

/*--------------------------------------------------------------------------
   html以下
---------------------------------------------------------------------------*/

html{
	overflow-y:scroll;
	font-size:62.5%;
}

body{
	background:#FCFCFC;
	min-width: 740px;
	color:#455D6B;
	font-family:"游ゴシック","YuGothic","メイリオ","Meiryo",'ヒラギノ角ゴ ProN W3',"Hiragino Kaku Gothic ProN","ヒラギノ角ゴ Pro W3","Hiragino Kaku Gothic Pro","ＭＳ Ｐゴシック","MS PGothic",sans-serif;
	font-size:14px;
	font-size:1.4rem;
	line-height: 2;
	letter-spacing: .02em;
	-webkit-text-size-adjust:100%;
}
a{
	color:#00529d;
	text-decoration:none;
}
a:hover{
	color:#4786D4;
	text-decoration:none;
}
div.article{
	width:auto;
	padding:20px 30px;
}

ul.control{
	padding:10px 0;
}
ul.control li{
	display:inline-block;
	margin:0 15px 0 0;
}
ul.control li a{
	background:linear-gradient(to bottom, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0) 100%) repeat scroll 0 0 #023c84;
	padding:5px 15px;
	color:#FFF;
	text-decoration:none;
	border-radius:4px;
	border:2px solid #024da8;
	display:block;
	transition:all 0.3s linear 0.175s;	
}
ul.control li a:hover{
	background:linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0) 100%) repeat scroll 0 0 #012D63;
}

ul.control + div{
	background:#FBFBFB;
	width:506px;
	border:1px solid #e5e5e5;
	padding:10px 15px;
	margin:15px 0 25px;
	text-align:center;
}

.table_head{
	width: 100%;
	margin:0 0 20px;
}
.table_head th{
	padding:0 20px;
	/*color:#043E85;*/
	font-size:25px;
	font-size:2.5rem;
	text-align:left;
	border-left:5px solid #012D63;
}
.table_01{
	width: 100%;
	border:1px solid #B3B3B3;
}
.table_01 th{
	background:#E3E9EE;
	/*background:#2D353C;*/
	width:10%;
	min-width: 70px;
	padding:15px;
	font-size:15px;
	font-size:1.5rem;
	text-align:center;
	line-height:1.4;
	vertical-align:middle;
	letter-spacing:-0.01em;
	border-bottom:1px solid #B3B3B3;
}
.table_01 td{
	background:#FFF;
	width:90%;
	padding:10px 15px;
	vertical-align:middle;
	border-left:1px solid #B3B3B3;
}
.table_01 tr.source th{
	vertical-align:top;
}
.table_01 tr.source td{
	background:#242a30;
	padding:20px 25px;
	border-top:1px solid #999;
	border-bottom:1px solid #999;
}
pre{
	color:#FFF;
	font-size:15px;
	font-size:1.5rem;
	line-height:1.8;
}
ol li:before{
	content:"・";
	display:inline-block;
}
ol li{
	padding:0 0 0 15px;
	margin:0 0 0 1em;
	text-indent:-1em;
	line-height:1.8;
}

.pagetop{
	width:100%;
	margin:15px 0 0;
	text-align:center;
}
.pagetop p{
	width:200px;
	margin:0 auto;
	padding:10px 0;
	/*border:1px solid #e5e5e5;*/
}

</style>

</head>

<body>

<div class="article" id="Top">

<ul class="control">
<li><a href="./sar-info.php?cmd=load">Load Average</a></li>
<li><a href="./sar-info.php?cmd=cpu">CPU使用率確認</a></li>
<li><a href="./sar-info.php?cmd=swap">スワップ（メモリ）使用率確認</a></li>
</ul>

<div>&#x2605;画面の確認方法は<a href="http://faq.zenlogic.jp/faqs/FAQ01207" target="_blank">こちら</a></div>

<?php
  
  echo $out;
  
?>

</div>

</body>

</html>

