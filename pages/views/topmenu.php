	<nav id="topmenu" class="navigation top">
		<div class="column">
		<?php if(file_exists(PATH_ASSETS . 'images/' . MAIN_LOGO_FILE)): 
			echo '
				<a class="menu-item" id="logotype" href="' . HOME_URL . '">
					<span></span>
					<img src="'.HOME_URL.'assets/images/' . MAIN_LOGO_FILE . '">
				</a>';
			endif ?>
		</div>
		{{mainmenu}}
		<div class="part right" style="justify-content: space-around;">
			<div class="row hide_1050"></div>
			<div class="row">
				<div class="menu-holder" id="operate_links">
					<?php if(!isset($this->data['user']) || $this->data['user']['access_id'] == 5){ ?>
					<a href="<?=HOME_URL.'login'?>" class="button" id="login" title="Вход/Регистрация">
						<span>Вход</span>
						<i class="fa-solid fa-right-to-bracket"></i>
					</a>
					<?php }else{ ?>
					<a class="menu-item" id="user" title="<?=$this->data['user']['email']?>">
						<span>&nbsp;</span>
						<div class="avatar"></div>
					</a>
					{{usermenu}}
					<?php } ?>
					
				</div>
			</div>
		</div>
	</nav>
