<nav id="admintop" class="navigation top">
    <div class="part left">
	    {{searchfield}}
    </div>
    <div class="part right" style="justify-content: space-around;">
        <div class="menu-holder" id="operate_links">
            <?php if(!isset($this->data['user']) || $this->data['user']['access_id'] == 5){ ?>
            <a href="<?=HOME_URL.'login'?>" class="button small" id="login" title="Вход/Регистрация">
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
</nav>
