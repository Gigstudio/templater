// function serializeObject(form){
//     if(!form || form.nodeName !== "FORM") return;
//     let o = {};
//     for(let i = 0; i < form.elements.length; i++){
//         if(form.elements[i].name === "" || form.elements[i].name === 'pass_check') continue;
//         if(o[form.elements[i].name] !== undefined){
//             if(!o[form.elements[i].name].push){
//                 o[form.elements[i].name] = [o[form.elements[i].name]];
//             }
//             o[form.elements[i].name].push(form.elements[i].value || '');
//         } else {
//             o[form.elements[i].name] = form.elements[i].value || '';
//         }
//     }
//     return o;
// }

// //set cookie
// function setCookie(cname, cvalue, exdays){
// 	let d = new Date();
// 	d.setTime(d.getTime() + (exdays*24*60*60*1000));
// 	let expires = "expires="+d.toUTCString();
// 	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/" + ";SameSite=Lax";
// }

// //get or read cookie
// function getCookie(cname){
// 	let name = cname + '=';
// 	let decodedCookie = decodeURIComponent(document.cookie);
// 	let ca = decodedCookie.split(';');
// 	for (let i = 0; i < ca.length; i++){
// 		let c = ca[i];
// 		while (c.charAt(0) == ' '){
// 			c = c.substring(1);
// 		}
// 		if (c.indexOf(name) == 0){
// 			return c.substring(name.length, c.length);
// 		}
// 	}
// 	return '';
// }

// function closeEmail(){
//     document.forms.email_form.input_email.value = '';
//     document.getElementById('modalemail').style.display = 'none';
// }

// //retype password validation
// let checkPass = function(pass,check){
//     if(check.value == pass.value && pass.value != ''){
//         check.style.borderColor = 'rgb(180,255,160)';
//         return true;
//     }else{
//         check.style.borderColor = 'rgb(255,80,60)';
//         return false;
//     }
// }
  
  //retype password validation
let checkpass = function(){
    let inp = document.getElementById('check_password');

    if(document.getElementById('check_password').value == 
        document.getElementById('reg_password').value && 
        document.getElementById('reg_password').value != ''){
        inp.style.borderColor = 'rgb(180,255,160)';
        inp.previousElementSibling.style.borderColor = 'rgb(180,255,160)';
    }else{
        inp.style.borderColor = 'rgb(255,80,60)';
        inp.previousElementSibling.style.borderColor = 'rgb(255,80,60)';  
    }
}
  
//   //clear info board
// function clearInfo(){
//     let info = document.getElementById('info');
//     info.style.display = 'none';
//     info.class = 'info-plate';
// };
  
// function passRemind(){
// 	document.forms.email_form.input_email.value = document.forms.signin_form.email.value;
// 	document.getElementById('modalemail').style.display = 'block';
// }
	
// function sendRecovery(){
// 	let email = document.forms.email_form.input_email;
// 	if(!email.validity.valid || email.value.length < 6){
// 		showSnack('Неверный формат eMail.');
// 		email.focus();
// 		return;
// 	}
//     let lng = getCookie('language') || 'en-US';
// 	let form_data = JSON.stringify({email: email.value, language: lng});
// 	let xhr = new XMLHttpRequest();
// 	xhr.onreadystatechange = function(){
// 		if(this.readyState == 4){
// 			closeEmail();
//             // console.log(this.response.message);
// 			showSnack(this.response.message[lng]);
// 			if(this.status == 200){
// 				console.log(this.response.key);
// // !!! УДАЛИТЬ после подключения почтовой службы!!! ///
//                 document.getElementById('test').innerHTML = this.response.letter;
// 			}
// 		}
// 	};
// 	xhr.responseType = 'json';
// 	xhr.open("POST", "api/pass_recover.php", true);
// 	xhr.setRequestHeader("Content-type", "application/json");
// 	xhr.send(form_data);
// }

// //show snackbar at bottom
// function showSnack(msg) {
//     let x = document.getElementById("snackbar");
//     x.className = "toast";
//     x.innerHTML = msg;
//     setTimeout(function(){ x.className = x.className.replace("toast", ""); }, 3000);
// }
  
// function isNested(child, parent){
//     let targets = parent.constructor === Array ? parent : new Array(parent);
//     if(targets.indexOf(child) >= 0) return true;
//     let node = child.parentNode;
//     while(node != null){
//         if(targets.indexOf(node) >= 0) return true;
//         node = node.parentNode;
//     }
//     return false;
// }

// function showInfo(msg, flag){
//     let info = document.getElementById('info');
//     info.className = 'info-plate';
//     if(flag) info.classList.add(flag);
//     info.innerHTML = msg;
// }

// //sign up
// function signup(){
// 	let form = document.forms['signup_form'];
// 	let error='', flag;

// 	if(form.reg_email.value == ''){
// 		error += dictionary['emailempty_errormsg'].text;
// 		flag = 'error';
// 	}
// 	if(!form.reg_email.validity.valid){
// 		error += dictionary['emailformat_errormsg'].text;
// 		flag = 'error';
// 	}
// 	if(form.reg_passwd.value == ''){
// 		error += dictionary['passempty_errormsg'].text;
// 		flag = 'error';
// 	}
// 	if(form.reg_passwd.value != form.pass_check.value){
// 		error += dictionary['passcheck_errormsg'].text;
// 		flag = 'error';
// 	}
//     if(error) {
//         showInfo(error,flag);
//         return;
//     }
// 	let form_data = JSON.stringify(serializeObject(form));

// 	let xhr = new XMLHttpRequest();
// 	xhr.onreadystatechange = function(){
// 		if(this.readyState == 4 && this.status == 200){
//             console.log(xhr.responseText);
//             showInfo(dictionary['signup_successmsg'].text, 'success')
// 			let sw = document.getElementById('switch');
// 			sw.checked = !sw.checked;
// 		} else if(this.readyState == 4){
//             showInfo(xhr.responseText.message[lng], 'error')
// 		}
// 		form.reset();
// 		document.forms['signin_form'].reset();
// 	};
// 	xhr.open("POST", "api/create_user.php", true);
// 	xhr.setRequestHeader("Content-type", "application/json");
// 	xhr.send(form_data);
// }

// //login
// function signin(){
// 	let form = document.forms['signin_form'];
// 	if(form.email.value == ''){
// 		showInfo(dictionary['emailempty_errormsg'].text,'error');
// 		return;
// 	}
// 	let form_data = JSON.stringify(serializeObject(form));
//     let staylogged = form.stay.checked ? 30 : 1;
// 	let xhr = new XMLHttpRequest();
// 	xhr.onreadystatechange = function(){
// 		if(this.readyState == 4 && this.status == 200){
//             showInfo(dictionary['signin_successmsg'].text, 'success')
//             // console.log(staylogged);
// 			setCookie('login_jwt', JSON.parse(this.responseText).login_jwt, staylogged);
//             let access = JSON.parse(this.responseText).access;
//             let page = access == 1 ? 'admin' : 'index';
//             console.log(JSON.parse(this.responseText));
//             setTimeout(()=>{
//                 window.location.href = page + '.php';
//             },1000);
// 		} else if(this.readyState == 4){
//             showInfo(JSON.parse(this.responseText).message[lng], 'error')
// 		}
// 		info.style.display = 'block';
// 		document.forms['signup_form'].reset();
// 		form.reset();
// 	};
// 	xhr.open("POST", "api/login.php", true);
// 	xhr.setRequestHeader("Content-type", "application/json");
// 	xhr.send(form_data);
// 	return false;
// }

// function getFileNames(dir){
//     let res = [];
//     return res;
// }

// async function translate(lng){
//     const fetchContent = await fetchTranslationsFor(lng.split('-')[0]);
//     dictionary = fetchContent.dictionary;
//     // setCookie('language', currentLanguage, 30);
//     translatePage(dictionary);
// }

// async function fetchTranslationsFor(newLocale) {
//     const response = await fetch(`languages/${newLocale}.json`);
//     return await response.json();
// }

// function translatePage(dict){
//     let translate = textNodes();
//     for(let o in translate){
//         if(!dict[o]) continue;
//         let input = getFirst('INPUT', translate[o]);
//         let span = getFirst('SPAN', translate[o]);
//         let link = getFirst('A', translate[o]);
//         // console.log(link);
//         if(span && span.innerText && span.innerText.trim().length>0 && dict[o].text) span.innerText = dict[o].text;
//         if(span && span.title && span.title.trim().length>0 && dict[o].title) span.title = dict[o].title;
//         if(link && link.href  
//             && link.href.trim().length>0
//             && link.innerText 
//             && link.innerText.trim().length>0 
//             && dict[o].title) link.innerText = dict[o].title;
//         if(input && input.placeholder && input.placeholder.trim().length>0 && dict[o].title) input.placeholder = dict[o].title;
//         if(input && input.type == 'button' && input.value && input.value.trim().length>0 && dict[o].text) input.value = dict[o].text;
//     }
// }

// function getFirst(el, parent){
//     let targets = Array.from(parent.children);
//     let child = parent.firstElementChild;
//     while(targets.indexOf(child) >=0){
//         if(child.tagName == el) return child;
//         child = child.nextElementSibling;
//     }
//     return null;
// }

// function textNodes(){
//     let res = {},
//         elements = document.querySelectorAll('[localize]');
//     for (let i = 0; i < elements.length; i++) {
//         res[elements[i].getAttribute('localize')] = elements[i];
//     }
//     return res;
// }

// ///// START POINT /////
document.addEventListener('DOMContentLoaded', function() {
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

//     // let recoverybg = document.getElementById('modalemail');
//     // recoverybg.addEventListener('click', (e)=>{
//     //     e = e || window.event;
//     //     let target = e.target || e.srcElement;
//     //     if(!isNested(target, document.getElementsByClassName('passprompt')[0])) closeEmail();
//     // });

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

//     setCookie("login_jwt", "", -1);
//     let loginForm = document.getElementById('signin_form');
//     let regForm = document.getElementById('signup_form');
//     loginForm.addEventListener('keyup', function(e){
// 		if(e.code == 'Enter' || e.code == 'NumpadEnter'){
// 		    e.preventDefault();
// 		    document.getElementById('signin_button').click();
// 		}
//     });
//     regForm.addEventListener('keyup', function(e){
// 		if(e.code == 'Enter' || e.code == 'NumpadEnter'){
// 		    e.preventDefault();
// 		    document.getElementById('signup_button').click();
// 		}
//     });

//     lng = getCookie('language') || navigator.language || navigator.userLanguage;
//     let supportedLanguages = [];
//     let xhr = new XMLHttpRequest();
//     xhr.onload = function(){
//         dictionary = {};
//         let res = JSON.parse(this.responseText)['files'];
//         for(let o in res){
//             supportedLanguages.push(res[o].split('.')[0]);
//         }
//         let lang = supportedLanguages.includes(lng.split('-')[0]) ? lng : 'en-US';
//         translate(lang);

//         let switcher = document.getElementById('switch');
//         switcher.addEventListener('click', (e)=>{
//             let header = document.getElementById('white_header');
//             let tip = document.getElementById('switch_tip');
//             header.localize = 'signupheader';
//             header.firstElementChild.innerHTML = switcher.checked ? dictionary['signupheader'].text : dictionary['signinheader'].text;
//             tip.localize = 'signuptip';
//             tip.firstElementChild.innerHTML = switcher.checked ? dictionary['signuptip'].text : dictionary['signintip'].text;
//         });
//     };
//     xhr.open("POST", "includes/get_languages.php", true);
//     xhr.send();
}, false);