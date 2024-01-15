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
</nav>
