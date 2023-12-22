// TODO
// 1. "Поймать" ширину экрана и подставить нужный файл логотипа!
(function(){
    let logo = document.getElementById('logotype').getElementsByTagName('IMG')[0],
        topnav = document.getElementById('topmenu'),
        hamb = document.getElementById('hamburger'),
        mainmenu = document.getElementById('main_links');
    newfile = changeLogo(window.innerWidth <= 1120 ? 'ticonred.png' : 'ttype.png');
    if(newfile) logo.src = newfile;
    setMenuVisibility(mainmenu, window.innerWidth > 800);

    window.addEventListener("resize", function(){
        setMenuVisibility(mainmenu, window.innerWidth > 800);
        if(window.scrollY > 0) return;
        newfile = changeLogo(window.innerWidth <= 1120 ? 'ticonred.png' : 'ttype.png');
        if(!newfile) return;
        logo.src = newfile;
        // for(o in menus){
            // menus[o].rect = (menus[o].control && menus[o].states[menus[o].state].type == 'floating') ? menus[o].defineFloatingRect() : menus[o].defineStaticRect();
            // menus[o].applyStyle(menus[o].rect);
            // menus[o].initTriggers(e);
        // }
    });

    document.addEventListener('scroll', ()=>{
        let limit = Math.max( document.body.scrollHeight, document.body.offsetHeight, 
            document.documentElement.clientHeight, document.documentElement.scrollHeight, document.documentElement.offsetHeight );
        console.log(window.scrollY);
        console.log(limit - window.innerHeight);
        topnav.classList.toggle('scrolled', window.scrollY > 0);
        if(window.innerWidth <=800) setMenuVisibility(mainmenu, false);
        if(window.innerWidth > 1120){
            newfile = changeLogo(window.scrollY > 0 ? 'ticonred.png' : 'ttype.png');
            if(!newfile) return;
            logo.src = newfile;
        }
    });

    document.addEventListener('click', (e)=>{
        let visible = window.getComputedStyle(mainmenu).getPropertyValue('display');
        if(isNested(e.target, hamb)){
            setMenuVisibility(mainmenu, visible == 'none');
        }
        else{
            setMenuVisibility(mainmenu, window.innerWidth > 800);
        }
    });

    function setMenuVisibility(target, flag){
        target.style.display = flag ? 'flex' : 'none';
    }

    function changeLogo(file){
        let logo = document.getElementById('logotype').getElementsByTagName('IMG')[0],
            srcfile = logo.src.split('/'),
            elNum = srcfile.length-1,
            newName = '';
        if(srcfile[elNum] == file) return;
        srcfile[elNum] = file;
        newName = srcfile.join('/');
        return newName;
    }

    // function showMenu(){
	// 	let x = document.getElementById("main_links");
	// 	x.classList.toggle("hidden", !x.classList.contains("hidden"));
    // }

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

// 	function serializeObject(form){
// 	    if(!form || form.nodeName !== "FORM") return;
// 	    let o = {};
// 	    for(let i = 0; i < form.elements.length; i++){
// 	        if(form.elements[i].name === "" || form.elements[i].name === 'pass_check') continue;
// 	        if(o[form.elements[i].name] !== undefined){
// 	            if(!o[form.elements[i].name].push){
// 	                o[form.elements[i].name] = [o[form.elements[i].name]];
// 	            }
// 	            o[form.elements[i].name].push(form.elements[i].type == 'checkbox' ? (form.elements[i].checked ? '1' : '0') : (form.elements[i].value || ''));
// 	        } else {
// 	            o[form.elements[i].name] = form.elements[i].type == 'checkbox' ? (form.elements[i].checked ? '1' : '0') : (form.elements[i].value || '');
// 	        }
// 	    }
// 	    o['language'] = currentLanguage;
// 	    return o;
// 	}

// 	function sendfb(){
// 		console.log("SENDING...");
// 	}

// //set cookie
// 	function setCookie(cname, cvalue, exdays){
// 		let d = new Date();
// 		d.setTime(d.getTime() + (exdays*24*60*60*1000));
// 		var expires = "expires="+d.toUTCString();
// 		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/" + ";SameSite=Lax";
// 	}

// //get or read cookie
// 	function getCookie(cname){
// 		let name = cname + "=";
// 		let decodedCookie = decodeURIComponent(document.cookie);
// 		let ca = decodedCookie.split(';');
// 		for (let i = 0; i < ca.length; i++){
// 			let c = ca[i];
// 			while (c.charAt(0) == ' '){
// 				c = c.substring(1);
// 			}
// 			if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
// 		}
// 		return "";
// 	}

// 	function createContainer(src){
// 		let d = document.createElement(src.type == "navigation" ? "nav" : "div"),
// 			container = src.childof == "body" ? document.body : document.getElementById(src.childof);
// 		d.className = src.type;
// 		if(src.position) d.classList.add(src.position);
// 		d.id = src.name;
// 		if(src.name == 'main_menu') d.setAttribute('localize', '123');
// 		if(container) container.appendChild(d);
// 		return d;
// 	}

// 	function defineCommands(){
// 		let commands = {
// 			'changeLanguage': async function(obj){
// 				if(!obj || typeof(obj) != 'object') return;
// 				lng_menu = menus['languages'];
// 				if(obj.selectable) obj.selected = true;
// 				if(lng_menu.control) lng_menu.selectedItem = obj;
// 				let newLocale = obj.shortname;
// 				let old = currentLanguage ? currentLanguage.substr(0,2) : '';
// 				if(newLocale == old) return;
// 				currentLanguage = obj.par;
// 				setCookie('language', currentLanguage, 30);
// 				translatePage(translate, newLocale);
// 			},
// 			'link': function(target){
// 				let link = target.par,
// 					url = window.location.href;
// 				if(!permissions[userdata.access].deni.includes(link)) {
// 					return true;
// 				}
// 				else {
// 					showSnack(dictionary[lng.split('-')[0]].msg_noaccess.text || 'Access denied');
// 					return false;
// 				}
// 			},
// 			'addlink': function(target){
// 				let paramName = 'inslink',
// 					paramValue = target.par,
// 					url = window.location.href,
// 					hash = location.hash;
// 				url = url.replace(hash, '');
// 				if (url.indexOf(paramName + "=") >= 0){
// 					let prefix = url.substring(0, url.indexOf(paramName + "="));
// 					let suffix = url.substring(url.indexOf(paramName + "="));
// 					suffix = suffix.substring(suffix.indexOf("=") + 1);
// 					suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
// 					url = prefix + paramName + "=" + paramValue + suffix;
// 				} else {
// 					if (url.indexOf("?") < 0){
// 						url += "?" + paramName + "=" + paramValue;
// 					} else {
// 						url += "&" + paramName + "=" + paramValue;
// 					}
// 				}
// 				window.location.href = url + hash;
// 			},
// 			'email': function(target){
// 				// console.log(target.par);
// 				let addr = target.par;
// 				const regexExp = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/gi;
// 				if(regexExp.test(addr)){
// 					window.open('mailto:' + addr, '_blank');
// 					// window.location.href = ('mailto:' + addr);
// 				}
// 			},
// 			'login': function(obj){
// 				window.location.assign('login.php');
// 			},
// 			'logout': function(){
// 				setCookie("login_jwt", "", -1);
// 				window.location.assign('index.php');
// 			},
// 			'changeview':function(obj){
// 				if(!obj || typeof(obj) != 'object') return;
// 				let locator = window.location.pathname.split('/');
// 				let page = locator[locator.length-1].split('.')[0];
// 				switch(page){
// 					case 'admin':{
// 						let task_menu = menus['admintasks'];
// 						if(obj.selectable) obj.selected = true;
// 						task_menu.selectedItem = obj;
// 						let workspace = document.getElementById('workspace');
// 						for(let i = 1; i < workspace.children.length; i++){
// 							workspace.children[i].classList.toggle('hidden', true);
// 						}
// 						document.getElementById('list_'+obj.par).classList.toggle('hidden', false);
// 					}
// 				}
// 			}
// 		};
// 		return commands;
// 	}

// //logging out
// 	function logout(){
// 		setCookie("login_jwt", "", -1);
// 		window.location.assign('index.php');
// 	}

// 	async function fetchTranslationsFor(newLocale) {
// 		const response = await fetch(`languages/${newLocale}.json`);
// 		return await response.json();
// 	}

// 	function translatePage(src, lng){
// 		for(let i = 0; i < src.length; i++){
// 			let key = src[i].getAttribute('localize'),
// 				curdict = dictionary[lng];
// 			let corr = curdict[key];
// 			translateElement(src[i],corr);
// 			for(var child=src[i].firstChild; child!==null; child=child.nextSibling) {
// 				translateElement(child, corr);
// 			}
// 		}
// 	}

// 	function translateElement(el, dict){
// 		if(!dict) return;
// 		if(el.nodeType === Node.TEXT_NODE) return;
// 		if(el.title && dict.title) el.title = dict.title;
// 		if(el.placeholder && dict.title) el.placeholder = dict.title;
// 		// if(el.value && dict.text) el.value = dict.text;
// 		if(el.children.length == 0 && el.textContent && dict.text) el.textContent = dict.text;
// 	}

// 	function getTranslatable(){
// 		let res = [],
// 			elements = document.querySelectorAll('[localize]');
// 		for (let i = 0; i < elements.length; i++) {
// 			res.push(elements[i]);
// 		}
// 		return res;
// 	}

// 	async function buildTranslateSystem(){
// 		lng = navigator.language || navigator.userLanguage;
// 		storedLng = getCookie('language');

// 		if(menus.hasOwnProperty('languages')){
// 			lng_menu = menus['languages'];
// 			let xhr = new XMLHttpRequest();
// 			xhr.onload = function(){
// 				let out = JSON.parse(this.responseText);
// 				for(let o in out){
// 					let obj = JSON.parse(out[o]);
// 					let newctr = {
// 						"name": o,
// 						"text": obj.title,
// 						"translatable": false,
// 						"visible": true,
// 						"selectable": true,
// 						"hint": obj.title,
// 						"command": "changeLanguage",
// 						"parameter": obj.tag,
// 						"icon_position": "left",
// 						"icon_type": "icon",
// 						"icon": "fi fi-"+(obj.tag.split('-')[1].toLowerCase() || '')
// 					}
// 					lng_menu.addElement(newctr);
// 					dictionary[o] = obj.dictionary;
// 				}
// 				let m_line = lng_menu.elements[(storedLng || lng).substr(0,2)];
// 				if(m_line) {
// 					commands['changeLanguage'](m_line);
// 				}
// 				ready = true;
// 			};
// 			xhr.open("GET", "api/get_languages.php", true);
// 			xhr.send(null);
// 		}
// 	}

// 	function setupMenu(user){
// 		// console.log(user);
// 		// console.log(permissions[user.access]);
// 		let locator = window.location.pathname.split('/');
// 		let page = locator[locator.length-1].split('.')[0] || 'index';
// 		for(let i in menus){
// 			for(let mi in menus[i].elements){
// 				if(permissions[user ? user.access : '5'].deni.includes(mi)) {
// 					// console.log(mi);
// 					menus[i].elements[mi].element.href = 'javascript: void(0)';
// 					menus[i].elements[mi].visible = false;
// 					// console.log(menus[i].elements[mi]);
// 				}
// 				if(page && menus[i].elements[mi].selectable && menus[i].elements[mi].name.includes(page)){
// 					menus[i].selectedItem = menus[i].elements[mi];
// 				} 
// 			}
// 		}
// 		if(menus.usersettings && menus.usersettings.elements){
// 			if(user) menus.usersettings.elements['user'].icon = user.image;
// 			menus.usersettings.elements.user.visible = user && user.access && user.access != 5;
// 			menus.usersettings.elements.login.visible = !user || !user.access || user.access == 5;
// 			if(user) menus.usersettings.elements.user.hint = user.fname || user.email || '';
// 			// menus.usermenu.elements.admin.visible = user.access && user.access < 4;
// 		}
// 	}

// //show snackbar at bottom
// 	function showSnack(msg) {
// 		let x = document.getElementById("snackbar");
// 		if(!x) return;
// 		x.className = "toast";
// 		x.innerHTML = msg;
// 		setTimeout(function(){ x.className = x.className.replace("toast", ""); }, 3000);
// 	}

// 	function startCountdown(){
// 		let sent = getCookie('sent');
// 		if(sent){
// 			let btn = document.getElementById('fb_button');
// 			let val = btn.value;
// 			let distance = sent - new Date().getTime();
// 			console.log(distance);
// 			let x = setInterval(()=>{ 
// 				let now = new Date().getTime();
// 				let tmr = sent - now;
// 				let minutes = Math.floor((tmr % (1000 * 60 * 60)) / (1000 * 60));
// 				let seconds = Math.floor((tmr % (1000 * 60)) / 1000) + 1;
// 				btn.value = '( ' + (minutes*60+seconds) + ' )';
// 				if(tmr < 0){
// 					btn.classList.toggle('disabled', false);
// 					clearInterval(x);
// 					btn.title = '';
// 					setCookie("sent", "", -1);
// 					btn.value = val;
// 				}
// 			}, 1000);
// 		}
// 	}

// 	function saveProfileData(data){
// 		data = Object.keys(data).filter((key) => !key.includes('cb_')).reduce((obj, key) => {
// 			return Object.assign(obj, {
// 				[key]: data[key]
// 			});
// 		}, {});
// 		address = Object.keys(data).filter((key) => key.includes('address_')).reduce((obj, key) => {
// 			return Object.assign(obj, {
// 				[key.substring(8)]: data[key]
// 				// [key.split('_')[1]]: data[key]
// 			});
// 		}, {});
// 		data.subscriptions_id = parseInt([data.subscriptions_news,data.subscriptions_advert,data.subscriptions_birth,data.subscriptions_events].join(''),2).toString();
// 		data = Object.keys(data).filter((key) => (!key.includes('address_')) && !(key.includes('subscriptions_') && !(key == 'subscriptions_id'))).reduce((obj, key) => {
// 			return Object.assign(obj, {
// 				[key]: data[key]
// 			});
// 		}, {});
// 		console.log(data);
// 		data['address'] = address;
// 		// console.log(userdata);
// 		// console.log(data);

// 		const u = "api/update_user.php";
// 		const formData = new FormData();
// 		formData.append("data", JSON.stringify(data));
// 		if(imgForUpload){
// 			formData.append("files", imgForUpload);
// 		}
// 		fetch(u, {
// 			method: "post",
// 			body: formData
// 		})
// 		.then(response => response.json())
// 		.then(success => {
// 			let out = success.message;//JSON.parse(this.responseText);
// 			// let out = (this.responseText);
// 			console.log(out[currentLanguage]);
// 			showSnack(out[currentLanguage]);
// 			needSave = false;
// 			location.reload();
// 			// document.getElementById('saveformbtn').classList.toggle('disabled',!needSave);
// 			// out = success.file;
// 			// content.changeAvatar(out);
// 			// if(out != userdata.image){
// 			// 	newdata.image = out;
// 			// 	// needSave = true;
// 			// 	changeSaveBtnState();
// 			// }
// 		})
// 		.catch(error => console.log(error));

// 		// var form_data = JSON.stringify(data);
// 		// console.log('imgForUpload');
// 		// console.log(imgForUpload);
// 		// let xhr = new XMLHttpRequest();
// 		// xhr.onload = function(){
// 		// 	let out = JSON.parse(this.responseText);
// 		// 	// let out = (this.responseText);
// 		// 	console.log(out);
// 		// };

// 		// xhr.open("POST", "api/update_user.php", true);
// 		// xhr.send(form_data);
// 	}

// 	function setupPage(user){
// 		let newdata = JSON.parse(JSON.stringify(user));
// 		let locator = window.location.pathname.split('/');
// 		let page = locator[locator.length-1].split('.')[0] || 'index';
// 		switch(page){
// 			case 'userprofile':{
// 				let savebtn = document.getElementById('saveformbtn');
// 				savebtn.classList.add('disabled');
// 				savebtn.addEventListener('click',()=>{
// 					if(savebtn.classList.contains('disabled')) return;
// 					let form_data = serializeObject(document.forms['userdata']);
// 					// console.log(form_data);
// 					saveProfileData(form_data);
// 				});
// 				function imgExists(url, callback){
// 					let img = new Image();
// 					img.onload = function() {callback(true);}
// 					img.onerror = function() {callback(false);}
// 					img.src = url;
// 				}
// 				let form = document.forms['userdata'];
// 				form.addEventListener('change',(e)=>{
// 					// console.log(e);
// 					if(e.target.name.substr(0,3) == 'cb_') return;
// 					if(Object.keys(newdata).includes(e.target.name)) {
// 						newdata[e.target.name] = e.target.type == 'checkbox' ? (e.target.checked ? '1' : '0') : e.target['value'];
// 						// console.log(newdata[e.target.name]);
// 					}
// 					// console.log(e.target.name.substring(8));
// 					if(Object.keys(newdata.address).includes(e.target.name.substring(8))) {
// 						newdata.address[e.target.name.substring(8)] = e.target.value;
// 					}
// 					if(e.target.name.substr(0,14) == 'subscriptions_'){
// 						// console.log(e.target.name);
// 						newdata.subscription = 
// 							[(form.subscriptions_news.checked ? '1' : '0'),
// 							(form.subscriptions_advert.checked ? '1' : '0'),
// 							(form.subscriptions_birth.checked ? '1' : '0'),
// 							(form.subscriptions_events.checked ? '1' : '0')];
// 						// console.log(newdata.subscription);
// 					}
// 					savebtn.classList.toggle('disabled',JSON.stringify(newdata) == JSON.stringify(userdata));
// 					needSave = !savebtn.classList.contains('disabled');
// 					console.log(JSON.stringify(newdata));
// 					console.log(JSON.stringify(user));
// 				});
// 						// console.log(form.image);
// //change avatar	
// 				let changephoto = document.getElementById('changephoto');
// 				let inputfile = document.getElementById('img_local');
// 				let avatar = document.getElementById('useravatar');
// 				changephoto.addEventListener('click', () => inputfile.click());
// 				inputfile.addEventListener("input", e => {
// 					function imgExists(url, callback){
// 						let img = new Image();
// 						img.onload = function() {callback(true);}
// 						img.onerror = function() {callback(false);}
// 						img.src = url;
// 					}

// 					e.preventDefault();
// 					let f = e.target.files[0];
// 					if(f.size > 2097152){
// 						e.target.value = '';
// 						showSnack('Размер файла не должен превышать 2МБ.');
// 						return;
// 					}
// 					const reader = new FileReader();
// 					reader.readAsDataURL(f);
// 					reader.onloadend = () => {
// 						let bg = window.URL.createObjectURL(f);
// 						imgExists(bg, function(isUrl){
// 							if(isUrl){
// 								imgForUpload = f;
// 								avatar.src = bg;
// 								form.image.value = f;
// 								const evnt = new Event('change');
// 								Object.defineProperty(evnt, 'target', {writable: false, value: form.image});
// 								form.dispatchEvent(evnt);
// 								window.URL.createObjectURL(f);
// 								// im.changeimg.previews[p].style.backgroundImage = "url('"+bg+"')";
// 							} else {
// 								// im.changeimg.previews[p].style.backgroundImage = "url('"+userdata.image+"')";
// 								imgForUpload = null;
// 							}
// 						});
// 						// avatar.src = bg;
// 						// console.log(form.image);
// 						// form.image.value = bg;
// 						// const evnt = new Event('change');
// 						// Object.defineProperty(evnt, 'target', {writable: false, value: form.image});
// 						// form.dispatchEvent(evnt);
// 					};
// 				});
// 				break;
// 			}
// 		}
// 	}

// ////////////////////////////////////////// START POINT //////////////////////////////////////////////////
// 	let containers = {},
// 		lng,
// 		currentLanguage = '',
// 		translate,
// 		dictionary = {},
// 		ready = false,
// 		needSave = false,
// 		imgForUpload = null,
// 		menus = {};
// //HTTP Request: construct page
// 	let source = new XMLHttpRequest();
// 	function emptify(u){
// 		for(let k in u){
// 			if(u[k] == null) u[k] = '';
// 			else if(typeof u[k] == "object") u[k] = emptify(u[k]);
// 		}
// 		return u;
// 	}
// 	userdata = emptify(userdata);
// 	source.onload = function(){
// 		let json = JSON.parse(this.responseText);
// 		commands = defineCommands();
// //Parse source json
// 		for(let o in json){
// 			switch(o){
// 				case "container":{
// 					let code = json[o];
// 					if(code && code.constructor === Array){
// 						for(let i = 0; i < code.length; i++){
// 							let item = createContainer(code[i]);
// 							containers[item.id] = item;
// 						}
// 					}
// 					break;
// 				}
// 				case"menu":{
// 					let code = json[o];
// 					if(code && code.constructor === Array){
// 						for(let i = 0; i < code.length; i++){
// 							let item = new Menu(code[i]);
// 							menus[item.name] = item;
// 							item.init();
// 						}
// 					}
// 					break;
// 				}
// 			}
// 		}
// //Bind menus with they controls		
// 		if(Object.keys(menus).length > 0){
// 			for(m in menus){
// 				let buttons = menus[m].elements;
// 				for(i in buttons){
// 					let btn = buttons[i],
// 						cmd = buttons[i].cmd,
// 						re = /\s*,\s*/,
// 						pointers = buttons[i].par.split(re);
// 					for(let k = 0; k < pointers.length; k++){
// 						obj = menus[pointers[k]];
// 						if(obj) {
// 							obj.bindControl(buttons[i]);
// 							obj.state = obj.initState;
// 						}
// 					}
// 				}
// 			}
// 		}
// //Define permissions
// 		permissions = {
// 			'1':{
// 				'deni':[]
// 			},
// 			'2':{
// 				'deni':['users']
// 			},
// 			'3':{
// 				'deni':['users']
// 			},
// 			'4':{
// 				'deni':['users','admin']
// 			},
// 			'5':{
// 				'deni':['users','admin','profile','user']
// 			}
// 		}

// 		buildTranslateSystem();
// 		translate = getTranslatable();
// 		setupMenu(userdata);
// 		// console.log(userdata);
// 		setupPage(userdata);
// 		console.log(menus);

// //select first menu item admin page
// 		// let s = menus.admintasks.elements.newslist || null;
// 		// if(s) commands['changeview'](s);


// //------//
// //listeners		
// 	    document.addEventListener("mouseup", function(e){
// 			e = e || window.event;
// 			if(e.detail == 0) return; //click on scroll bar?
// 			for(o in menus){
// 				menus[o].initTriggers(e);
// 			}
// 	    });
// 	    document.addEventListener("keyup", function(e){
// 			e = e || window.event;
// 			for(o in menus){
// 				menus[o].initTriggers(e);
// 			}
// 	    });
// 	    window.addEventListener("resize", function(e){
// 	    	e = e || window.event;
// 			for(o in menus){
// 				menus[o].rect = (menus[o].control && menus[o].states[menus[o].state].type == 'floating') ? menus[o].defineFloatingRect() : menus[o].defineStaticRect();
// 				menus[o].applyStyle(menus[o].rect);
// 				menus[o].initTriggers(e);
// 			}
// 	    });
// 	    window.addEventListener("mousewheel", function(e){
// 	    	e = e || window.event;
// 	    	let over = e.srcElement;
// 	    	for(let el in menus){
// 	    		if(isNested(over,menus[el].body)) return;
// 				menus[el].initTriggers(e);
// 	    	}
// 	    });
// 		window.onbeforeunload = function(){
// 			if(needSave){
// 				return "Несохраненные данные могут быть потеряны! Продолжить?";
// 			} else {
// 				return;
// 			}
// 		}
// 	    let contentholder = document.getElementById('content_holder') || null;
// 	    let logo = document.getElementById('logotype').getElementsByTagName('IMG')[0] || null;
// 	    if(contentholder && logo){
// 		    contentholder.addEventListener("scroll", function(e){
// 		    	if(window.innerWidth <= 800) return;
// 		    	let sc = contentholder.scrollTop > 50 ? 0 : 1;
// 		    	logo.style.transform = 'scaleY('+sc+')';
// 		    	logo.style.top = (sc == 1 ? 0 : -105)+'px';
// 		    });
// 	    }

// 	    let fbform = document.forms.feedback_form;
// 	    if(fbform){
// 	    	let btn = document.getElementById('fb_button');
//     		let sent = getCookie('sent');
//     		if(sent){
//     			if(new Date().getTime() < sent){
// 	    			btn.classList.toggle('disabled', true);
// 	    			startCountdown();
//     			}
//     			else{
//     				setCookie("sent", "", -1);
//     			}
//     		}
// 	    	btn.addEventListener('click',(e)=>{
// 				let senderemail = fbform.fb_email,
// 					sendername = fbform.fb_name,
// 					sendertxt = fbform.fb_text;
// 				if(!senderemail.validity.valid || senderemail.value.length < 6){
// 					showSnack(currentLanguage == 'en-US' ? 'Wrong email format.' : 'Неверный формат eMail.');
// 					senderemail.focus();
// 					return;
// 				}
// 				if(sendername.value.length < 1){
// 					showSnack(currentLanguage == 'en-US' ? 'Please, enter your name or how else we can call you?' : 'Как к Вам обращаться?');
// 					sendername.focus();
// 					return;
// 				}
// 				if(sendertxt.value.length < 1){
// 					showSnack(currentLanguage == 'en-US' ? 'Type something' : 'Напишите свое сообщение');
// 					sendertxt.focus();
// 					return;
// 				}
// 				let form_data = JSON.stringify(serializeObject(fbform));
// 				console.log(form_data);
// 				let xhr = new XMLHttpRequest();
// 				xhr.onreadystatechange = function(){
// 					if(this.readyState == 4){
// 						// closeEmail();
// 			            // console.log(this.response.message[lng]);
// 						if(this.status == 200){
// 							// console.log(this.response.letter);
// 							showSnack(this.response.message[lng]);
// 							fbform.reset();
// 							btn.disabled = true;
// 							btn.classList.toggle('disabled', true);
// 							let exp = new Date().getTime()+(1000*60*3);
// 							setCookie('sent',exp,3/1440);
// 							startCountdown();
// 			// !!! УДАЛИТЬ после подключения почтовой службы!!! ///
// 			                // document.getElementById('test').innerHTML = this.response.letter;
// 						}
// 					}
// 				};
// 				xhr.responseType = 'json';
// 				xhr.open("POST", "api/send_feedback.php", true);
// 				xhr.setRequestHeader("Content-type", "application/json");
// 				xhr.send(form_data);
// 	    	});
// 	    }
// 	}
// 	source.open("GET", "source/navigation.json", true);
// 	source.send(null);
})();
