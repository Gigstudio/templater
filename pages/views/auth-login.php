<?php

$switchon = $this->data['activeform'] == 'register';

$error_field = ($this->data['error'] && count($this->data['error'])) > 0 ? array_keys($this->data['error'])[0] : false;
$error = $this->data['error'] ? array_values($this->data['error'])[0] : false;
$input = $this->data['user_input'] ? $this->data['user_input'] : false;

$email_error = $error_field == 'email' ? ' error' : '';
$password_error = $error_field == 'password' ? ' error' : '';
$reg_email_error = $error_field == 'reg_email' ? ' error' : '';
$reg_password_error = ($error_field == 'reg_password' || $error_field == 'check_password') ? ' error' : '';

$email_value = $input !== false ? ($input['email'] ?? $input['reg_email']) : '';

$switchon = $error !== false && ($error_field == 'reg_email' || $error_field == 'reg_password' || $error_field == 'check_password');
$remind_link = $error && $error['errorDescription'] == 'activationrequired' 
    ? 'activate' 
    : 'passRemind';

?>
    <div class="modal-bg">
        <input class="switcher hidden" type="checkbox" name="switch" id="switch" <?php echo $switchon ? 'checked' : ''; ?>>
        <div class="forms-holder">
            <input class="hidden" id="showpasscheck" type="checkbox"/>
            <form class="signform" id="signup_form" method="post" name="signup-form">
                <input class="hidden" name="activeform" type="text" value="register"/>
                <div class="input-group" style="justify-content: center;">
                    <img class="logo-round-small" src="<?php echo HOME_URL . 'assets/images/ttype.png'; ?>" style="height: 40px;">
                </div>
                <div class="input-group">
<!-- add ' error' to classlist of label and input if needed -->
                    <label class="input-icon<?=$reg_email_error?>" for="reg_email"><i class="fas fa-envelope"></i></label>
<!-- value needed here -->
                    <input 
                        id="reg_email" 
                        name="reg_email" 
                        type="email" 
                        class="form-input<?=$reg_email_error?>" 
                        value="<?=$email_value?>" 
                        placeholder="Email" 
                        autocomplete="email" 
                        required />
                </div>
                <div class="input-group">
<!-- add ' error' to classlist of label and input if needed -->
                    <label class="input-icon<?=$reg_password_error?>" for="reg_password"><i class="fas fa-unlock"></i></label>
<!-- value needed here -->
                    <input 
                        id="reg_password" 
                        name="reg_password" 
                        type="password" 
                        class="form-input<?=$reg_password_error?>" 
                        value="<?=''?>" 
                        placeholder="Пароль" 
                        autocomplete="new-password"
                        onkeyup="checkpass();" 
                        required />
                </div>
                <div class="input-group">
<!-- add ' error' to classlist of label and input if needed -->
                    <label class="input-icon<?=$reg_password_error?>" for="check_password"><i class="fas fa-unlock-alt"></i></label>
<!-- value needed here -->
                    <input 
                        id="check_password" 
                        name="check_password" 
                        type="password" 
                        class="form-input<?=$reg_password_error?>" 
                        value="<?=''?>" 
                        placeholder="Повтор пароля" 
                        autocomplete="new-password"
                        onkeyup="checkpass();" 
                        required />
                </div>
                <div class="input-group group-right">
                    <label class="tip-icon" for="showpasscheck">
                        <i class='fas fa-eye'></i>
                        <span class="link">Показать пароль</span>
                    </label>
                </div>
                <div class="input-group for-button">
<!-- add ' disabled' if needed -->
                    <input class="button<?=''?>" type="submit" id="signup_button" value="Зарегистрироваться" >
                </div>
                <div class="input-group" style="padding: 8px 0">
                    <i class="fas fa-exclamation-triangle" style="color: var(--c09); font-size: 40px;"></i>
                    <span style="font-size: 12px; font-style: italic; line-height: 1.2em; margin: 8px 0 0 16px;">
                        <span>Нажимая кнопку "Регистрация", Вы подтверждаете свое согласие с положениями </span>
                        <a href="<?php echo HOME_URL ?>terms" target="_blank">пользовательского соглашения</a>
                    </span>
                </div>
            </form>
            <form class="signform" id="signin_form" method="post" name="signin-form">
                <input class="hidden" name="activeform" type="text" value="login"/>
                <div class="input-group" style="justify-content: center;">
                    <img class="logo-round-small" src="<?php echo HOME_URL . 'assets/images/ttype.png'; ?>" style="height: 40px;">
                </div>
                <div class="input-group">
<!-- add ' error' to classlist of label and input if needed -->
                    <label class="input-icon<?=$email_error?>" for="email"><i class="fas fa-unlock-alt"></i></label>
<!-- value needed here -->
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        class="form-input<?=$email_error?>" 
                        value="<?=$email_value?>" 
                        placeholder="Email" 
                        autocomplete="email"
                        required />
                </div>
                <div class="input-group<?php if($error && $error['errorDescription'] == 'loginrequired') echo ' blink'; ?>">
<!-- add ' error' to classlist of label and input if needed -->
                    <label class="input-icon<?=$password_error?>" for="password"><i class="fas fa-unlock"></i></label>
<!-- value needed here -->
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        class="form-input<?=$password_error?>" 
                        value="<?=''?>" 
                        placeholder="Пароль" 
                        autocomplete="new-password"
                        required />
                </div>
                <div class="input-group group-right">
                    <label class="tip-icon">
                        <input class="stay" type="checkbox" name="stay" id="stay">
                        <span class="link">Запомнить меня</span>
                    </label>
                    <label class="tip-icon" for="showpasscheck">
                        <span class="link">Показать пароль</span>
                        <i class='fas fa-eye'></i>
                    </label>
                </div>
                <div class="input-group for-button">
                    <input class="button" type="submit" id="signin_button" value="Войти">
                </div>
                <!-- <div class="hr"></div> -->
            </form>
            <div class="login-foot-link">
            <?php if($remind_link == 'activate'){ ?>
                <a class="link<?php if($error && $error['errorDescription'] == 'activationrequired') echo ' blink'; ?>" href="<?= HOME_URL ?>login?action=reactivate&email=<?=$email_value ?>">Повторно выслать письмо для активации</a>
            <?php } else { ?>
                <span class="link<?php if($error && $error['errorDescription'] == 'userexists') echo ' blink'; ?>" onclick="passRemind();">Забыли пароль?</span>
            <?php } ?>
            </div>
        </div>
        <div class="login-pane cover">
            <h2 class="white-text" id="white_header">
            </h2>
            <hr class="white-text">
            <p class="info-plate<?php echo $error ? ' '.$error['errorLevel'] : ''; ?>" id="info">
                <?php echo $error ? $error['errorMessage'] : ''; ?>
            </p>
            <label for="switch" class="switch<?php if($error && $error['errorDescription'] == 'nouser') echo ' blink'; ?>" id="switch_tip">
                <i class="fas fa-arrow-circle-right"></i>
            </label>
        </div>
    </div>
    <!-- <div class="roundlogo"></div> -->
