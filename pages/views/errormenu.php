<div class="block header">
	<nav id="topmenu" class="navigation top">
		<div class="part left">
		<?php if(file_exists(PATH_ASSETS . 'images/' . MAIN_LOGO_FILE)): 
			echo '
				<a class="menu-item" id="logotype">
					<span></span>
					<img src="'.HOME_URL.'assets/images/' . MAIN_LOGO_FILE . '">
				</a>';
			endif ?>
		</div>
		<div class="part right">
			<div class="menu-holder" id="operate_links">
				<?php if(!isset($this->data['user']) || $this->data['user']['access_id'] == 5){ ?>
				<a href="<?=HOME_URL.'login'?>" class="button" id="login" title="Вход/Регистрация">
					<span>Вход</span>
					<i class="fa-solid fa-right-to-bracket"></i>
				</a>
				<?php }else{ ?>
				<a onclick="ShowMenu('user_menu')" class="menu-item" id="user" title="<?=$this->data['user']['email']?>">
					<span>&nbsp;</span>
					<div class="avatar"></div>
				</a>
				{{usermenu}}
				<?php } ?>
				
			</div>
		</div>
	</nav>
	<div class="searchblock">
		<div class="big-errorheader">
			<?=$this->data['errcode']?>
		</div>
		<div class="errormessage">
			<?=$this->data['errmessage']?>
		</div>
	</div>
</div>
