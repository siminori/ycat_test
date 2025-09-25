<?php
/*----------------------
Template Name:page-print
-----------------------*/
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>印刷</title>
<style>
	@page { size:landscape; }
	*{
		font-family: "Yu Gothic", "游ゴシック", "YuGothic", "游ゴシック体", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, Osaka, "ＭＳ Ｐゴシック", "MS PGothic", sans-serif;
		margin:0;
		padding:0;
	}
	.wrapper{
		padding:30px ;
	}
	.slideInfo {
		display:none;
	}
	h1{
		text-align:center;
		font-size:20px;
		margin-bottom:10px;
	}
	h1 span{
		font-size:13px;
	}
	table{
		width:calc(100% - 20px);
		margin:0 auto 50px;
		border:solid 1px #000;
		table-layout:fixed;
		border-collapse:collapse;
	}
	th{
		background:#eee;
		font-size:11px;
		padding:10px 3px;
		border:solid 1px #000;
		text-align:center;
	}
	th a{
		display:none;
	}
	td{
		font-size:11px;
		padding:10px 3px;
		border:solid 1px #000;
		text-align:center;
	}
	.printBtn{
		text-align:center;
	}
	.printBtn button{
		padding:5px 20px;
		font-size:16px;
	}
	.kaitei{
		text-align:right;
		padding:10px 0;
	}
	@media print{
		.wrapper{
			padding:0px ;
		}
		.printBtn{
			display:none;
		}
		table{
			margin-bottom:0;
		}
		th{
			font-size:10px;
		}
		th,td{
			font-size:10px;
			padding:3px;
		}
		.kaitei{
			font-size:11px;
		}
		/* 改ページ */
		.pagebreak {
			break-after: page;
		}
	}
</style>
</head>
<body>
<div class="wrapper">
<!-- <pre>
	<?php 
		$tag = array();
		$tag['slug'] = $_GET['slug'];
		$tag['tit'] = $_GET['tit'];
		var_dump($tag);
	?>
</pre>
 -->

	<?php foreach ($tag['slug'] as $k => $v) : ?>

		<h1><?=$tag['tit'][$k];?></h1>

		<?php if( $_GET['preview'] == true ) : ?>
			<?php echo get_TimetablePrintPreview($v); /* shortcord.phpに記載 */ ?>
		<?php else : ?>
			<?php echo get_TimetablePrint($v); /* shortcord.phpに記載 */ ?>
		<?php endif ; ?>


		<div class="pagebreak"></div>

	<?php endforeach; ?>

		<p class="printBtn"><button onclick="window.print();">印刷</button></p>

</div>
</body>
</html>
