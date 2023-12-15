<?php 
use Templater\System\Engine\Application;
?>

<!DOCTYPE html>
<html lang="<?=Application::$app->config->get('default_language')?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=Application::$app->config->get('sitetitle').' | '.$this->messages[$this->er_code]['header']?></title>
    <link rel="shortcut icon" href="<?=HOME_URL . 'siteroot/assets/images/' . SITE_ICON_FILE?>" type='image/svg'/>
    <link href="<?=HOME_URL . 'siteroot/assets/css/colors.css'?>" rel="stylesheet">
    <link href="<?=HOME_URL . 'siteroot/assets/css/fonts.css'?>" rel="stylesheet">
    <link href="<?=HOME_URL . 'siteroot/assets/css/default.css'?>" rel="stylesheet">
</head>
<body>
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
	</nav>
	<div class="searchblock">
		<div class="big-errorheader">
			<?=$this->er_code?>
		</div>
		<div class="errormessage">
			<?=$this->messages[$this->er_code]['message']?>
		</div>
		<p class="errorresolve">
			<?=$this->messages[$this->er_code]['resolve']?>
        </p>
	</div>
</div>

</body>
</html>