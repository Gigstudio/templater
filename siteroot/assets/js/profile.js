(function(){
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

//set cookie
	function setCookie(cname, cvalue, exdays){
		let d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/" + ";SameSite=Lax";
	}

//get or read cookie
	function getCookie(cname){
		let name = cname + "=";
		let decodedCookie = decodeURIComponent(document.cookie);
		let ca = decodedCookie.split(';');
		for (let i = 0; i < ca.length; i++){
			let c = ca[i];
			while (c.charAt(0) == ' '){
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
		}
		return "";
	}

	function createContainer(src){
		let d = document.createElement(src.type == "navigation" ? "nav" : "div"),
			container = src.childof == "body" ? document.body : document.getElementById(src.childof);
		d.className = src.type;
		if(src.position) d.classList.add(src.position);
		d.id = src.name;
		if(src.name == 'main_menu') d.setAttribute('localize', '123');
		container.appendChild(d);
		return d;
	}

	function defineCommands(){
		let commands = {
			'changeLanguage': async function(obj){
				if(!obj || typeof(obj) != 'object') return;
				lng_menu = menus['languages'];
				if(obj.selectable) obj.selected = true;
				if(lng_menu.control) lng_menu.selectedItem = obj;
				let newLocale = obj.shortname;
				let old = currentLanguage ? currentLanguage.substr(0,2) : '';
				if(newLocale == old) return;
				currentLanguage = obj.par;
				setCookie('language', currentLanguage, 30);
				translatePage(translate, newLocale);
			},
			'link': function(target){
				console.log(userdata);
				let link = target.par;
				let external = link.split('.').length > 1;
				if(!permissions[userdata.access].deni.includes(link)) {
					external ? window.open(link,'_blanc') : window.location.assign(link + (link.includes('#') ? '' : '.php'));
				}
				else showSnack(dictionary[lng.split('-')[0]].msg_noaccess.text || 'Access denied');
			},
			'login': function(obj){
				window.location.assign('login.php');
			},
			'logout': function(){
				setCookie("login_jwt", "", -1);
				window.location.assign('index.php');
			},
			'changeview':function(obj){
				if(!obj || typeof(obj) != 'object') return;
				let locator = window.location.pathname.split('/');
				let page = locator[locator.length-1].split('.')[0];
				switch(page){
					case 'admin':{
						let task_menu = menus['admintasks'];
						if(obj.selectable) obj.selected = true;
						task_menu.selectedItem = obj;
						let workspace = document.getElementById('workspace');
						for(let i = 1; i < workspace.children.length; i++){
							workspace.children[i].classList.toggle('hidden', true);
						}
						document.getElementById('list_'+obj.par).classList.toggle('hidden', false);
					}
				}
			},
			'pageback': function(){
				history.back();
			},
			'saveform': function(e){
				if(e.element.classList.contains('disabled')) return;
				console.log(e);
			}
		};
		return commands;
	}

	function setupPage(){
		let header = headers.profile;
		if(!header) return;
		header.title = userdata.fname || userdata.email || 'User';
		if(menus['formcontrol'] && menus['formcontrol'].elements.buttonsave){
			changeSaveBtnState();
		}
	}

	function changeSaveBtnState(){
			menus.formcontrol.elements.buttonsave.element.classList.toggle('disabled', JSON.stringify(newdata) == JSON.stringify(userdata));
	}

	async function fetchTranslationsFor(newLocale) {
		const response = await fetch(`languages/${newLocale}.json`);
		return await response.json();
	}

	function translatePage(src, lng){
		for(let i = 0; i < src.length; i++){
			let key = src[i].getAttribute('localize'),
				curdict = dictionary[lng];
			let corr = curdict[key];
			translateElement(src[i],corr);
			for(var child=src[i].firstChild; child!==null; child=child.nextSibling) {
				translateElement(child, corr);
			}
		}
	}

	function translateElement(el, dict){
		if(!dict) return;
		if(el.nodeType === Node.TEXT_NODE) return;
		if(el.title && dict.title) el.title = dict.title;
		if(el.placeholder && dict.title) el.placeholder = dict.title;
		if(el.value && dict.text) el.value = dict.text;
		if(el.children.length == 0 && el.textContent && dict.text) el.textContent = dict.text;
	}

	function getTranslatable(){
		let res = [],
			elements = document.querySelectorAll('[localize]');
		for (let i = 0; i < elements.length; i++) {
			res.push(elements[i]);
		}
		return res;
	}

	async function buildTranslateSystem(){
		lng = navigator.language || navigator.userLanguage;
		storedLng = getCookie('language');

		if(menus.hasOwnProperty('languages')){
			lng_menu = menus['languages'];
			let xhr = new XMLHttpRequest();
			xhr.onload = function(){
				let out = JSON.parse(this.responseText);
				for(let o in out){
					let obj = JSON.parse(out[o]);
					let newctr = {
						"name": o,
						"text": obj.title,
						"translatable": false,
						"visible": true,
						"selectable": true,
						"hint": obj.title,
						"command": "changeLanguage",
						"parameter": obj.tag,
						"icon_position": "left",
						"icon_type": "icon",
						"icon": "fi fi-"+(obj.tag.split('-')[1].toLowerCase() || '')
					}
					lng_menu.addElement(newctr);
					dictionary[o] = obj.dictionary;
				}
				let m_line = lng_menu.elements[(storedLng || lng).substr(0,2)];
				if(m_line) {
					commands['changeLanguage'](m_line);
				}
				ready = true;
			};
			xhr.open("GET", "api/get_languages.php", true);
			xhr.send(null);
		}
	}

	function createContent(data){
		console.log(data);
		// return;
		let ignor = ['id','access','subscribed','blocked','password','cover_image'],
			person = ['fname','lname','gender','birthday','created','rating'];
		let filtered = Object.keys(data).filter((key) => !ignor.includes(key)).reduce((obj, key) => {
			return Object.assign(obj, {
				[key]: data[key]
			});
		}, {});
		res = {};
		res['blocks'] = [
			{
				'name': 'personal',
				'data': {
					'fname': newdata.fname,
					'lname': newdata.lname,
					'gender': newdata.gender,
					'birthday': newdata.birthday
				}
			},{
				'name': 'contacts',
				'data': {
					'email': newdata.email,
					'phone': newdata.phone
				}
			},
			{
			'name': 'address',
				'data': newdata.address
			},{
			'name': 'subscription',
				'data': newdata.subscription
			},{
			'name': 'about',
				'data': {
					'about': newdata.about
				}
			}
		]
		res['container'] = document.getElementById('profiledata') || null;
		res['usercard'] = {};
// frame with form
		let datacontent = document.createElement('form');
		datacontent.name = 'userdata';
		datacontent.className = 'card';
		datacontent.classList.add('data');
		let idfield = document.createElement('INPUT');
		idfield.type = 'hidden';
		idfield.value = userdata.id;
		datacontent.appendChild(idfield);
		let imagefield = document.createElement('INPUT');
		imagefield.type = 'hidden';
		imagefield.value = userdata.image;
		datacontent.appendChild(imagefield);
		res.container.appendChild(datacontent);
		res['form'] = datacontent;
		for(let b = 0; b < res.blocks.length; b++){
			createBlock(res.blocks[b]);
		}
// frame with card
		let usercard = document.createElement('div');
		usercard.className = 'card';
		usercard.classList.add('info');
		res.usercard['container'] = usercard;
		res.container.appendChild(usercard);
		let ah = document.createElement('div');
		ah.className = 'detailrow';
		ah.classList.add('avatarholder');
		ah.setAttribute('localize', 'changeavatar');
		let avt = document.createElement('div');
		avt.className = 'avatar';
		avt.title = 'Изменить';
		avt.addEventListener('click', changeAvatar);
		let avatar = document.createElement('img');
		avatar.src = newdata.image;
		avt.appendChild(avatar);
		ah.appendChild(avt);
		// let dt = new Date(res.usercard.data.created + "Z");
		// console.log(dt.toLocaleString());
		usercard.appendChild(ah);
		res.usercard['avatar'] = avt;

		res.changeAvatar = function(file){
			avatar.src = file;
			imagefield.value = file;
		}

		return res;
	}

	function createBlock(src){
		let types = {
			'fname': ['span', 'text'],
			'lname': ['span', 'text'],
			'gender': ['', 'checkbox'],
			'birthday': ['', 'div'],
			'email': ['span', 'text'],
			'phone': ['span', 'text'],
			'street': ['span', 'text'],
			'build': ['span', 'text'],
			'apart': ['span', 'text'],
			'locality': ['span', 'text'],
			'area': ['span', 'text'],
			'region': ['span', 'text'],
			'country': ['span', 'text'],
			'postal_index': ['span', 'text'],
			'additional': ['span', 'textarea'],
			'news': ['checkbox', 'text'],
			'advert': ['checkbox', 'text'],
			'birth': ['checkbox', 'text'],
			'events': ['checkbox', 'text'],
			'about': ['span', 'textarea']
		}
		console.log(src);
		let block = document.createElement('div');
		let datacontainer = document.createElement('div');
		let cover = document.createElement('div');
		let header = document.createElement('div');
		block.className = 'detail';
		datacontainer.className = 'detailbody';
		cover.className = 'datacover';
		header.className = 'dataheader';
		header.setAttribute('localize','data'+src.name);
		let covertitle = document.createElement('span');
		covertitle.textContent = src.name;
		header.appendChild(covertitle);
		let edit = document.createElement('label');
		edit.htmlFor = 'cb_'+src.name;
		edit.textContent = 'изменить';
		let icon = document.createElement('label');
		icon.className = 'fa-solid fa-pen-to-square';
		edit.appendChild(icon);
		header.appendChild(edit);
		let control = document.createElement('input');
		control.type = 'checkbox';
		control.name = control.id = 'cb_'+src.name;
		control.className = 'cb';
		control.classList.add('hidden');
		block.appendChild(header);
		block.appendChild(control);
		block.appendChild(cover);
		block.appendChild(datacontainer);
		for(let o in src.data){
			console.log(o);
			if(src.data[o] && types[o][0]){
				let coveritem = document.createElement(types[o][0] == 'checkbox' ? 'input' : types[o][0]);
				if(types[o][0] == 'checkbox') {
					coveritem.type = 'checkbox';
					coveritem.checked = src.data[o] == '1';
					coveritem.disabled = true;
				}
				else coveritem.textContent = src.data[o];
				cover.appendChild(coveritem);
			}
		}
		res.form.appendChild(block);
	}

	function changeAvatar(){
		let im = interactives.changeimg;
		for(let p in im.previews){
			im.previews[p].style.backgroundImage = "url('"+userdata.image+"')";
		}
		im.ok_btn.onclick = (e)=>{
			e.preventDefault();
			if(im.imgForUpload){
				const u = "api/store_avatar.php";
				const formData = new FormData();
				formData.append("files", im.imgForUpload);
				formData.append("user_id", userdata.id);
				fetch(u, {
					method: "post",
					body: formData
				})
				.then(response => response.json())
				.then(success => {
					out = success.file;
					content.changeAvatar(out);
					if(out != userdata.image){
						newdata.image = out;
						needSave = true;
						changeSaveBtnState();
					}
				})
				.catch(error => console.log(error));
			}
			im.hide();
		};
		im.show();
	}

	function createInteractives(){
		let im = {
			changeimg: {
				modal: document.getElementById('menu_bg'),
				ok_btn: null,
				cancel_btns: {},
				img_tab: document.getElementById('img_menu_holder'),
				img_input: document.getElementById('img_local'),
				previews: {},
				form: document.forms.changeavatar,
				imgForUpload: null,
				show: function(){
					this.modal.style.display = 'block';
				},
				hide: function(){
					this.ok_btn.onclick = null;
					this.clearForm();
					this.modal.style.display = 'none';
				},
				clearForm: function(){
					this.form.files.value = '';
					this.imgForUpload = null;
				}
			} 
		}
		im.changeimg.ok_btn = im.changeimg.modal.getElementsByClassName('ok-btn')[0];
		im.changeimg.cancel_btns = im.changeimg.modal.getElementsByClassName('cancel-btn');
		im.changeimg.previews = Array.from(im.changeimg.modal.getElementsByClassName('img-preview'));
		for(let i = 0; i < im.changeimg.cancel_btns.length; i++){
			im.changeimg.cancel_btns[i].onclick = (e)=>{
				e.preventDefault();
				im.changeimg.hide();
			}
		}
		function imgExists(url, callback){
			let img = new Image();
			img.onload = function() {callback(true);}
			img.onerror = function() {callback(false);}
			img.src = url;
		}
		im.changeimg.img_input.oninput = (e)=>{
			let f = e.target.files[0];
			if(f.size > 2097152){
				e.target.value = '';
				// f = null;
				showSnack('Размер файла не должен превышать 2МБ.');
				return;
			}
			let bg = window.URL.createObjectURL(f);
			imgExists(bg, function(isUrl){
				im.changeimg.imgForUpload = isUrl ? f : null;
				for(let p in im.changeimg.previews){
					if(isUrl){
						im.changeimg.imgForUpload = f;
						im.changeimg.previews[p].style.backgroundImage = "url('"+bg+"')";
					} else {
						im.changeimg.previews[p].style.backgroundImage = "url('"+userdata.image+"')";
						im.changeimg.imgForUpload = null;
					}
				}
			});
			window.URL.createObjectURL(f);
		}
		// console.log(im);
		return im;
	}

//show snackbar at bottom
	function showSnack(msg) {
		let x = document.getElementById("snackbar");
		if(!x) return;
		x.className = "toast";
		x.innerHTML = msg;
		setTimeout(function(){ x.className = x.className.replace("toast", ""); }, 3000);
	}


////////////////////////////////////////// START POINT //////////////////////////////////////////////////
	// if(!userdata) window.location.assign('login.php');
	let containers = {},
		menus = {},
		interactives = {},
		headers = {},
		content = {},
		lng,
		currentLanguage = '',
		translate,
		dictionary = {},
		ready = false,
		needSave = false;
	let newdata = {...userdata};
	// const newdata = Object.keys(userdata).reduce((a,c) => {
	// 	a[c] = c=='id' ? userdata[c] : undefined;
	// 	return a;
	// }, {});
	// newdata.image = '';
	// console.log('data is '+(JSON.stringify(newdata) == JSON.stringify(userdata) ? '' : 'NOT ')+'equal');
//HTTP Request: construct page
	let source = new XMLHttpRequest();
	source.onload = function(){
		let json = JSON.parse(this.responseText);
//Parse source json
		commands = defineCommands();
		for(let o in json){
			switch(o){
				case "container":{
					let code = json[o];
					if(code && code.constructor === Array){
						for(let i = 0; i < code.length; i++){
							let item = createContainer(code[i]);
							containers[item.id] = item;
						}
					}
					break;
				}
				case"menu":{
					let code = json[o];
					if(code && code.constructor === Array){
						for(let i = 0; i < code.length; i++){
							let item = new Menu(code[i]);
							menus[item.name] = item;
							item.init();
						}
					}
					break;
				}
				case "header": {
					let code = json[o];
					if(code && code.constructor === Array){
						for(let i = 0; i < code.length; i++){
							let item = new Header(code[i]);
							headers[item.name] = item;
							item.init();
						}
					}
					break;
				}
			}
		}
//Bind menus with they controls		
		if(Object.keys(menus).length > 0){
			for(m in menus){
				let buttons = menus[m].elements;
				for(i in buttons){
					let btn = buttons[i],
						cmd = buttons[i].cmd,
						re = /\s*,\s*/,
						pointers = buttons[i].par.split(re);
					for(let k = 0; k < pointers.length; k++){
						obj = menus[pointers[k]];
						if(obj) {
							obj.bindControl(buttons[i]);
							obj.state = obj.initState;
						}
					}
				}
			}
		}
		content = createContent(userdata);
		buildTranslateSystem();
		translate = getTranslatable();
		interactives = createInteractives();
		setupPage();
		console.log(menus);
		console.log(content);
		// console.log(headers);
//------//
//listeners		
	    document.addEventListener("mouseup", function(e){
			e = e || window.event;
			if(e.detail == 0) return; //click on scroll bar?
			for(o in menus){
				menus[o].initTriggers(e);
			}
	    });
	    document.addEventListener("keyup", function(e){
			e = e || window.event;
			if(e.key && e.key.toLowerCase() == 'escape'){
				for(let im in interactives){
					interactives[im].hide();
				}
			}
			for(o in menus){
				menus[o].initTriggers(e);
			}
	    });
	    window.addEventListener("resize", function(e){
	    	e = e || window.event;
			for(o in menus){
				menus[o].rect = (menus[o].control && menus[o].states[menus[o].state].type == 'floating') ? menus[o].defineFloatingRect() : menus[o].defineStaticRect();
				menus[o].applyStyle(menus[o].rect);
				menus[o].initTriggers(e);
			}
	    });
	    window.addEventListener("mousewheel", function(e){
	    	e = e || window.event;
	    	let over = e.srcElement;
	    	for(let el in menus){
	    		if(isNested(over,menus[el].body)) return;
	    	}
			for(o in menus){
				menus[o].initTriggers(e);
			}
	    });
		window.onbeforeunload = function(){
			if(needSave){
				return "Несохраненные данные могут быть потеряны! Продолжить?";
			} else {
				return;
			}
		}
	}
	source.open("GET", "source/profile.json", true);
	source.send(null);
})();