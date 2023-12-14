function serializeObject(form){
    if(!form || form.nodeName !== "FORM") return;
    let o = {};
    for(let i = 0; i < form.elements.length; i++){
        if(form.elements[i].name === "" || form.elements[i].name === 'pass_check') continue;
        if(o[form.elements[i].name] !== undefined){
            if(!o[form.elements[i].name].push){
                o[form.elements[i].name] = [o[form.elements[i].name]];
            }
            o[form.elements[i].name].push(form.elements[i].value || '');
        } else {
            o[form.elements[i].name] = form.elements[i].value || '';
        }
    }
    return o;
}

//set cookie
function setCookie(cname, cvalue, exdays){
	let d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	let expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/" + ";SameSite=Lax";
}

//get or read cookie
function getCookie(cname){
	let name = cname + '=';
	let decodedCookie = decodeURIComponent(document.cookie);
	let ca = decodedCookie.split(';');
	for (let i = 0; i < ca.length; i++){
		let c = ca[i];
		while (c.charAt(0) == ' '){
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0){
			return c.substring(name.length, c.length);
		}
	}
	return '';
}

//retype password validation
let checkPass = function(pass,check){
    if(check.value == pass.value && pass.value != ''){
        check.style.borderColor = 'rgb(180,255,160)';
        return true;
    }else{
        check.style.borderColor = 'rgb(255,80,60)';
        return false;
    }
}
  
 //retype password validation
let checkpass = function(){
    let inp = document.getElementById('pass_check');

    if(document.getElementById('pass_check').value == 
        document.getElementById('reg_passwd').value && 
        document.getElementById('reg_passwd').value != ''){
        inp.style.borderColor = 'rgb(180,255,160)';
        inp.previousElementSibling.style.borderColor = 'rgb(180,255,160)';
    }else{
        inp.style.borderColor = 'rgb(255,80,60)';
        inp.previousElementSibling.style.borderColor = 'rgb(255,80,60)';  
    }
}
  
  //clear info board
function clearInfo(){
    let info = document.getElementById('info');
    info.style.display = 'none';
    info.class = 'info-plate';
};
  
//show snackbar at bottom
function showSnack(msg) {
    let x = document.getElementById("snackbar");
    x.className = "toast";
    x.innerHTML = msg;
    setTimeout(function(){ x.className = x.className.replace("toast", ""); }, 3000);
}
  
function isNested(child, parent){
    let targets = parent.constructor === Array ? parent : new Array(parent);
    if(targets.indexOf(child) >= 0) return true;
    let node = child.parentNode;
    while(node != null){
        if(targets.indexOf(node) >= 0) return true;
        node = node.parentNode;
    }
    return false;
}

function showInfo(msg, flag){
    let info = document.getElementById('info');
    info.className = 'info-plate';
    info.style.color = 'var(--c17)';
    if(flag) info.classList.add(flag);
    info.innerHTML = msg;
}

//sign up
function resetPass(){
	let dictionary = {
		'ru-RU':{
			'passempty_errormsg': 'Пароль не должен быть пустым.<br>',
			'passcheck_errormsg': 'Пароли не совпадают.',
			'signup_successmsg': 'Пароль успешно обновлен. Теперь можете выполнить <a href="../login.php"><span style="font-size: 1.2em">вход</span></a>.'
		},
		'en-US':{
			'passempty_errormsg': 'Password must not be empty.<br>',
			'passcheck_errormsg': 'Password mismatch.',
			'signup_successmsg': 'Your password has been updated successfully. <a href="../login.php"><span style="font-size: 1.2em">Click here</span></a> to Login.'
		}
	}
	let form = document.forms['update'];
	let error='', flag;

	if(form.reg_passwd.value == ''){
		error += dictionary[language]['passempty_errormsg'];
		flag = 'error';
	}
	if(form.reg_passwd.value != form.pass_check.value){
		error += dictionary[language]['passcheck_errormsg'];
		flag = 'error';
	}
    if(error) {
        showInfo(error,flag);
        return;
    }
	let form_data = JSON.stringify(serializeObject(form));

	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
            console.log(xhr.responseText);
            showInfo(dictionary[language]['signup_successmsg'], 'success');
            setTimeout(function(){
                window.location.assign('../login.php');
            }, 30000);
		} else if(this.readyState == 4){
            showInfo(xhr.responseText.message[language], 'error')
		}
		form.reset();
	};
	xhr.open("POST", "../api/update_pass.php", true);
	xhr.setRequestHeader("Content-type", "application/json");
	xhr.send(form_data);
}

///// START POINT /////
(function(){
    function showPass(e){
        if(e.getElementsByTagName('I').length < 1) return;
        for(let i = 0; i < passes.length; i++){
            passes[i].setAttribute('type', 'text');
        }
        e.getElementsByTagName('I')[0].classList.replace('fa-eye','fa-eye-slash');
    }

    function hidePass(e){
        if(e.getElementsByTagName('I').length < 1) return;
        for(let i = 0; i < passes.length; i++){
            passes[i].setAttribute('type', 'password');
        }
        e.getElementsByTagName('I')[0].classList.replace('fa-eye-slash','fa-eye');
    }

    setCookie("login_jwt", "", -1);
    let eyes = document.getElementsByClassName('tip-icon');
    let inputs = document.getElementsByTagName('input');
    let passes = [];
    for(let i = 0; i < inputs.length; i++){
        if(inputs[i].type.toLowerCase() == 'password') passes.push(inputs[i]);
    }
    for(let t = 0; t < eyes.length; t++){
        eyes[t].addEventListener('mousedown', (e)=>{
            showPass(eyes[t]);
        });
        eyes[t].addEventListener('mouseup', (e)=>{
            hidePass(eyes[t]);
        });
        eyes[t].addEventListener('mouseleave', (e)=>{
            hidePass(eyes[t]);
        });
    }

    let changeForm = document.getElementById('resetpass_form');
    changeForm.addEventListener('keyup', function(e){
		if(e.code == 'Enter' || e.code == 'NumpadEnter'){
		    e.preventDefault();
		    document.getElementById('changepass_button').click();
		}
    });

    language = getCookie('language') || 'en-US';
})();