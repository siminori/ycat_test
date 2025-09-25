		<div class="chatBotBox">


			<span class="chatBotBox__miniIcon">
				<?php if( fnc_user_agent() == "PC" ) : ?>
				<img src="<?=get_bloginfo('template_directory'); ?>/chatbot2/img/chatbot_banner.png" class="chatBotBox__miniIcon__img" alt="" />
				<?php else : ?>
				<img src="<?=get_bloginfo('template_directory'); ?>/chatbot2/img/chatbot_banner_small.png" class="chatBotBox__miniIcon__img" style="width:80px;height:55px;text-align:right;right:0;" alt="" />
				<?php endif; ?>

				<img src="<?=get_bloginfo('template_directory'); ?>/chatbot2/img/chatbot_banner_close.png" class="chatBoxBox__miniIcon__close" alt="" />
			</span>
			<span class="chatBotBox__miniIcon_small">
				<img src="<?=get_bloginfo('template_directory'); ?>/chatbot2/img/chatbot_banner_small.png" alt="" />
			</span>
			<div class="chatBotBox__inner">
				 <!-- チャットヘッダー -->
				 <div class="chatBotBox__header">
					 <p class="chatBotBox__tit">お困りですか？</p>
					 <input type="button" class="chatBotBox__close" value="">
				 </div>
				 
				 <!--チャット表示画面-->
				 <div id= "chatField">
					<ul id= "chat-ul"></ul>
				 </div>
				 
				<span id="chatBotthinkTime"><img src="<?=get_bloginfo('template_directory'); ?>/chatbot2/img/chatBotthinkTime.gif" alt="" /></span>

			</div>
		</div>

		<script src="<?=get_bloginfo('template_directory'); ?>/chatbot2/chatbotData.php" defer></script>
		<script src="<?=get_bloginfo('template_directory'); ?>/chatbot2/chatbot.js" defer></script>
		<link href="<?=get_bloginfo('template_directory'); ?>/chatbot2/chatbot.css" rel="stylesheet">

