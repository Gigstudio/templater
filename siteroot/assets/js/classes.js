//////////////////////////////////////////// CLASSES ////////////////////////////////////////////////////////
class Tool{
	constructor(json){
		this.name = json.name;
		this.shortname = json.name.substr(0,2);
		this.selectable = json.selectable || false;
		this.dynamic = json.dynamic || false;
		this.color = json.icon_color || null;
		this.icontype = json.icon_type;
		this.element = this.createButton(json);
		this.cmd = json.command;
		this.par = json.parameter;
	}
	get visible(){return !this.element.classList.contains("hidden");}
	set visible(val){this.element.classList.toggle("hidden", !val);}

	get title(){return this.element.getElementsByTagName('SPAN')[0].innerHTML;}
	set title(val){this.element.getElementsByTagName('SPAN')[0].innerHTML = val || '&nbsp;';}

	get hint(){return this.element.title;}
	set hint(val){this.element.title = val;}

	get icon(){return this.element.getElementsByTagName('I')[0].className || null;}
	set icon(val){
		if(this.icontype == 'icon')	this.element.getElementsByTagName('I')[0].className = val;
		if(this.icontype == 'image'){
			let image = this.element.getElementsByTagName('IMG')[0];
			image.src = val || 'images/empty.png';
			let hgt = parseFloat(window.getComputedStyle(this.element, null).getPropertyValue('font-size'));
			image.style.height = (hgt*1.5)+'px';
			image.style.top = (hgt*0.2)+'px';
		}
		if(this.icontype == 'avatar'){
			let image = this.element.getElementsByTagName('DIV')[0].firstChild;
			// console.log(this.element);
			image.src = val || 'images/empty.png';
		}
	}

	get selected(){return this.element.classList.contains('selected');}
	set selected(val){this.element.classList.toggle('selected', this.selectable && val);}

	get target(){return this._target;}
	set target(val){this._target = val;}

	createButton(src){
		let tool = document.createElement('a');
		let sp = '&nbsp;';
		tool.className = 'menu-item';
		tool.id = src.name;
		tool.classList.toggle('hidden', !src.visible);
		tool.title = src.hint;
		if(src.selfheight) tool.style.fontSize = src.selfheight;
		let oLable = document.createElement('span');
		if(src.translatable) tool.setAttribute('localize', src.name);
		let oImg = document.createElement(this.icontype == 'icon' ? 'i' : (this.icontype == 'image' ? 'img' : 'div'));
		if(this.icontype == 'button') tool.classList.add('button');
		if(this.icontype == 'icon' && src.icon) {
			oImg.className = src.icon;
			if(this.color) oImg.style.color = this.color;
		}
		else if(this.icontype == 'image') {
			oImg.src = src.icon || 'images/empty.png';
			oImg.style.cssText = "display: inline-block; position: relative;";
			if(src.imageheight){
				oImg.style.height = src.imageheight+'px';
			}
		}
		else if(this.icontype == 'avatar' && src.icon){
			oImg.className = 'avatar';
			let avtr = document.createElement('img');
			avtr.src = src.icon || 'images/empty.png';
			oImg.appendChild(avtr);
		}
		oLable.innerHTML = this.icontype == 'image' && !src.text ? '' : (src.text || sp);
		tool.appendChild(oLable);
		if(src.icon && this.icontype != 'none') src.icon_position && src.icon_position == "left" ? tool.insertBefore(oImg, oLable) : tool.appendChild(oImg);
		tool.addEventListener('click', (e)=>{
			e = e || window.event;
			let target = e.target || e.srcElement;
			// if(this.selectable && this.selected) return;
			if(this.cmd && commands.hasOwnProperty(this.cmd)) {
				commands[this.cmd](this);
			}
			else if(this.cmd){
				console.log('Command "' + this.cmd + '" not found.');
			}
		}, false);
		return tool;
	}
}

////-------------////
class Usercard{
	// #cardfields;
	// #detailfields;

	constructor(user){
		// this.#cardfields = {
		// 	'avatar': {
		// 		'localize': 'profile_image',
		// 		'title': '',
		// 		'field':'image_path',
		// 		'control': 'avatar'
		// 	},
		// 	'fname': {
		// 		'localize': 'profile_fname',
		// 		'title': 'Имя',
		// 		'field':'fname',
		// 		'control': 'text'
		// 	},
		// 	'lname': {
		// 		'localize': 'profile_lname',
		// 		'title': 'Фамилия',
		// 		'field':'lname',
		// 		'control': 'text'
		// 	},
		// 	'gender': {
		// 		'localize': 'profile_gender',
		// 		'title': 'Пол',
		// 		'field':'gender',
		// 		'control': 'radio',
		// 		'elements': {1: 'М', 2: 'Ж'}
		// 	},
		// 	'birthday': {
		// 		'localize': 'profile_birthday',
		// 		'title': 'Дата рождения',
		// 		'field':'birthday',
		// 		'control': 'calendar',
		// 		'elements': {'day': 'ДД', 'month': 'ММ', 'year': 'ГГГГ'}
		// 	},
		// 	'rating': {
		// 		'localize': 'profile_rating',
		// 		'title': 'Ваш рейтинг',
		// 		'field':'rating',
		// 		'control': 'stars'
		// 	},
		// 	'orders': {
		// 		'localize': 'profile_history',
		// 		'title': 'История покупок',
		// 		'field':'',
		// 		'control': 'list'
		// 	}
		// };
		// this.#detailfields = {
		// 	'regdata': {
		// 		'localize': 'profile_regdata',
		// 		'title': 'Регистрационные данные',
		// 		'field':'',
		// 		'control': 'changepassform'
		// 	},
		// 	'phone': {
		// 		'localize': 'profile_phone',
		// 		'title': 'Номер телефона',
		// 		'field':'phone',
		// 		'control': 'text'
		// 	},
		// 	'address': {
		// 		'localize': 'profile_address',
		// 		'title': 'Почтовый адрес',
		// 		'field':'address_id',
		// 		'control': 'addressform'
		// 	},
		// 	'subscription': {
		// 		'localize': 'profile_address',
		// 		'title': 'Почтовый адрес',
		// 		'field':'subscriptions_id',
		// 		'control': 'subscriptionform'
		// 	}
		// };
		this.user = user;
		this.container = document.getElementById('profiledata');
		this.headertitle = document.getElementById('profile_title') || null;
	}


}


////-------------////
class Header{
	#fonts;

	constructor(json){
		this.#fonts = {
			'extralarge': {
				'root': '16px',
				'extra': '1.5em',
				'title': '4em',
				'subtitle': '1.8em'
			},
			'large': {
				'root': '16px',
				'extra': '1.2em',
				'title': '3em',
				'subtitle': '1.5em'
			},
			'normal': {
				'root': '16px',
				'extra': '0.9em',
				'title': '1em',
				'subtitle': '1.2em'
			},
			'small': {
				'root': '16px',
				'extra': '0.8em',
				'title': '1.5em',
				'subtitle': '1em'
			},
			'extrasmall': {
				'root': '16px',
				'extra': '0.7em',
				'title': '0.8em',
				'subtitle': '0.5em'
			}
		}
		this.name = json.name;
		this.container = document.getElementById(json.container);
		this.transition = json.animationtime || 0;
		this.type = json.type;
		this.body = this.createContainer();
		this.extraobj = this.createElement('extra',json.extra);
		this.titleobj = this.createElement('title',json.title);
		this.subtitleobj = this.createElement('subtitle',json.subtitle);
	}

	get extra(){return this.extraobj.firstChild.textContent;}
	set extra(val){this.extraobj.firstChild.textContent = val;}

	get title(){return this.titleobj.firstChild.textContent;}
	set title(val){this.titleobj.firstChild.textContent = val;}

	get subtitle(){return this.subtitleobj.firstChild.textContent;}
	set subtitle(val){this.subtitleobj.firstChild.textContent = val;}

	get position(){return this._position;}
	set positiob(val){
		this._position = val;
	}

	get size(){return this._size;}
	set size(val){
		this._size = val;
		// this.body.style.fontSize = this.#fonts[val]['root'];
		this.extraobj.style.fontSize = this.#fonts[val]['extra'];
		this.extraobj.style.fontStyle = 'italic';
		this.titleobj.style.fontSize = this.#fonts[val]['title'];
		this.subtitleobj.style.fontSize = this.#fonts[val]['subtitle'];
	}

	init(){
		if(this.container && this.body) this.container.appendChild(this.body);
		if(this.body && this.extra) {
			this.extraobj.style.color = 'var(--c09)';
			this.body.appendChild(this.extraobj);
		}
		if(this.body && this.titleobj) this.body.appendChild(this.titleobj);
		if(this.body && this.subtitleobj) this.body.appendChild(this.subtitleobj);
		this.size = this.type;
	}

	createContainer(){
		let body = document.createElement('div');
		body.className = 'pageheader';
		body.style.transition = 'all '+parseFloat(this.transition/1000,2)+'s';
		return body;
	}

	createElement(type, src){
		if(!src || src.constructor !== Object) return null;
		let element = document.createElement('div');
		if(src.translatable) element.setAttribute('localize', src.translatekey);
		let source = src.text.constructor !== Array ? [src.text] : src.text;
		for(let i = 0; i < source.length; i++){
			let txt = document.createElement('span');
			txt.textContent = source[i];
			if(type == 'title') txt.id = this.name+'_title';
			txt.style.display = 'block';
			element.appendChild(txt);
		}
		return element;
	}
}

////-------------////
class Menu{
	constructor(json){
		this.name = json.name;
		this.container = document.getElementById(json.container);
		this.transition = 0;
		this.states = json.states;
		this.initState = this.defineInitState(json);
		this.body = this.createContainer();
		this.elementCount = 0;
		this.elements = {};
		this.createElements(json.items);
		this.triggers = json.triggers && json.triggers.constructor === Array ? json.triggers : [];
	}

	get closed(){
		return this.body ? this.body.classList.contains('hidden') : true;
	}

	get state(){
		return this._state;
	}
	set state(val){
		this._state = val;
		this.rect = (this.control && this.states[val].type == 'floating') ? this.defineFloatingRect() : this.defineStaticRect();
		this.applyState(val);
	}

	get rect(){return this._rect;}
	set rect(val){this._rect = val;}

	get selectedItem(){return this._selectedItem;}
	set selectedItem(val){
		this._selectedItem = val;
		for(let o in this.elements){
			this.elements[o].selected = false;
		}
		val.selected = val.selectable ? true : false;
		if(val.selectable){
			if(this.control && this.control.icon && this.control.dynamic) this.control.icon = val.icon;
			if(this.control && this.control.title && this.control.dynamic) this.control.title = val.shortname;
		}
	}

	get visibles(){return Object.keys(this.elements).filter((el)=>{return this.elements[el].visible;}).length;}

	init(){
		if(this.container && this.body) this.container.appendChild(this.body);
		this.state = this.initState;
	}

	isNested(child, parent){
		let targets = parent.constructor === Array ? parent : new Array(parent);
		if(targets.indexOf(child) >= 0) return true;
		let node = child.parentNode;
		while(node != null){
			if(targets.indexOf(node) >= 0) return true;
			node = node.parentNode;
		}
		return false;
	}

	open(delay){
		// console.log('opening with thansition ' + delay);
		this.body.style.transition = 'all ' + parseFloat(delay/1000,2) + 's';
		// console.log('init transform - ' + this.body.style.transform);
		// console.log('showing menu...');
		this.body.style.display = (this.states[this.state].x == 'wide' || this.states[this.state].x == 'center') ? 'flex' : 'block';
		setTimeout(() => {
			this.body.style.transform = (this.states[this.state].direction == 'up' || this.states[this.state].direction == 'down') 
				? "scaleY(1)" : "scaleX(1)";
		},5);
		setTimeout(() => {
			this.body.style.transition = 'all 0s';
			// console.log('transformed to ' + this.body.style.transform);
			// console.log('Menu opened');
		},delay);
	}

	close(delay){
		// console.log('closing with thansition ' + delay);
		this.body.style.transition = 'all ' + parseFloat(delay/1000,2) + 's';
		// console.log('init transform - ' + this.body.style.transform);
		this.body.style.transform = (this.states[this.state].direction == 'up' || this.states[this.state].direction == 'down') 
			? "scaleY(0)" : "scaleX(0)";
		// console.log('transformed to ' + this.body.style.transform);
		// console.log('hiding menu...');
		setTimeout(() => {
			this.body.style.display = 'none';
			this.body.style.transition = 'all 0s';
			// console.log('Menu hided, transition set to 0');
		},delay);
	}

	bindControl(ctr){
		// console.log(ctr);
		this.control = ctr;
	}

	defineInitState(src){
		let state = src.initialstate;
		let arr = src.triggers;
		let operators;
		let filtered = arr ? arr.filter(function(v, i){return ((v['type'] == 'resize' && v.control == 'window.innerWidth'));}) : [];
		for(let i = 0; i < filtered.length; i++){
			operators = {
				'morethan': () => {return ('window.innerWidth>'+filtered[i].par);},
				'lessthan': () => {return ('window.innerWidth<='+filtered[i].par);},
				'equal': () => {return ('window.innerWidth=='+filtered[i].par);}
			};
			let cmd = 'if(filtered[i].compare && '+operators[filtered[i].compare.toLowerCase()]()+')';
			cmd += ' state = filtered[i].target;';
			eval(cmd);
		}
		return state;
	}

	applyState(s){
		// console.log(' ');
		// console.log(this.name.toUpperCase());
		// console.log('Applying state ' + s);
		// console.log('Initial transition: ' + this.body.style.transition);
		// console.log('Initial transform: ' + this.body.style.transform);
		let src = this.states[s];
		let origin;
//transform direction
		switch(src.direction){
			case 'right': 
				origin = '0% 50%';
				break;
			case 'down': 
				origin = '50% 0%';
				break;
			case 'left': 
				origin = '100% 50%';
				break;
			case 'up': 
				origin = '50% 100%';
				break;
		}
		this.body.style.transformOrigin = origin;
		// console.log('TransformOrigin changed');
		if(!src.visible) {
			// console.log('Sending close command');
			this.close(this.transition); 
		}
		this.body.style.fontSize = src['fontsize'] || parseInt(src['itemheight'])/2+'px';
//elements order
		this.body.classList.toggle('vertical', src.orientation == 'vertical');
		this.body.style.flexDirection = src.orientation == 'vertical' ? 'column' : 'row';
		this.body.style.alignItems = src.itemorientation == 'left' ? 'flex-start' : src.itemorientation == 'right' ? 'flex-end' : src.itemorientation == 'center' ? 'center' : 'space-between';
		for(let item in this.elements){
			let obj = this.elements[item].element.style;
			obj.width = parseInt(src.itemwidth) ? src.itemwidth : 'auto';
			obj.textAlign = parseInt(src.itemwidth) ? src.itemorientation : 'initial';
			obj.lineHeight = parseInt(src.itemheight) ? src.itemheight : 'initial';
			// obj.fontSize = parseInt(src.fontsize) ? src.fontsize : 'initial';
			obj.height = parseInt(src.itemheight) ? src.itemheight : 'auto';
		}
		// console.log('Elements direction changed');
//menu placement
		this.body.classList.toggle('floating', src.type == 'floating');
		switch(src.x){
			case 'wide': {
				this.body.style.justifyContent = 'space-between';
				break;
			}
			default: {
				this.body.style.float = (src.x == 'right' || src.x == 'left') ? src.x : '';
				break;
			}
		}
		// console.log('Class changed');
		// setTimeout(() => {
			// this.body.style.display = src.visible ? ((src.x == 'right' || src.x == 'left') ? 'block' : 'flex') : 'none';
		// },this.transition);
		// console.log(this.transition);
		this.applyStyle(this.rect);
		if(src.visible){
			// console.log('Sending open command');
			this.open(this.transition); 
		}
	}

	applyStyle(style){
		for(let key in style){
			this.body.style[key] = style[key];
		}
	}

	defineStaticRect(){
		let src = this.states[this._state];
		let rect = {
			'left': 'initial',
			'top': 'initial',
			'width': 'initial',
			'height': 'initial'
		};
		if(src.orientation == 'horizontal' && parseInt(src.height)) {
			rect['width'] = src.x == 'wide' ? '100%' : 'initial';
			rect['height'] = src.height;
		}
		else if(src.orientation == 'vertical' && parseInt(src.width)) {
			rect['width'] = src.width;
			rect['height'] = 'initial';
		}
		else {
			rect['width'] = src.x == 'wide' ? '100%' : 'initial';
			rect['width'] = src.width == 'default' ? (src.x == 'wide' ? '100%' : 'initial') : src.width;
			rect['height'] = 'initial';
		}
		return rect;
	}

	calculateInitWidth(src){
		let mult = src.orientation == 'horizontal' ? this.elementCount : 1;
		return parseInt(src.width) > 0 
			? parseInt(src.width) 
			: parseInt(src.itemwidth) > 0 
				? parseInt(src.itemwidth) * mult 
				: parseFloat(window.getComputedStyle(this.body, null).getPropertyValue('width'));
	}

	calculateInitHeight(src){
		let mult = src.orientation == 'vertical' ? this.elementCount : 1;
		let res = parseInt(src.height) > 0 
			? parseInt(src.height) 
			: parseInt(src.itemheight) > 0 
				? ((parseInt(src.itemheight) * mult) + (4 * this.visibles)) 
				: parseFloat(window.getComputedStyle(this.body, null).getPropertyValue('height'));
		return res;
	}

	defineFloatingRect(){
		this.elementCount = this.visibles;
		let rect = {};
		let btn = this.control.element;
		let left, top, width, height;
		let init = {
			"width": this.states[this.state] && parseInt(this.states[this.state].width) > 0
				? parseInt(this.states[this.state].width)
				: this.calculateInitWidth(this.states[this.state]),
			"height": this.states[this.state] && parseInt(this.states[this.state].height) > 0
				? parseInt(this.states[this.state].height)
				: this.calculateInitHeight(this.states[this.state]),
			"left": this.states[this.state].x == 'right' 
				? btn.getBoundingClientRect().right - 
					(this.states[this.state].width && parseInt(this.states[this.state].width) > 0 
						? parseInt(this.states[this.state].width)	
						: this.calculateInitWidth(this.states[this.state])) 
				: btn.getBoundingClientRect().left,
			"right": btn.getBoundingClientRect().right,
			"top": btn.getBoundingClientRect().top,
			"bottom": btn.getBoundingClientRect().bottom
		};
		let mainContainer = document.body,
			contentContainer = document.getElementById('mainframe'),
			topnav = document.getElementById('main_menu');
		let limit = {
			"width": parseFloat(window.getComputedStyle(mainContainer, null).getPropertyValue('width')) 
				- parseFloat(window.getComputedStyle(mainContainer, null).getPropertyValue('padding-left'))
				- parseFloat(window.getComputedStyle(mainContainer, null).getPropertyValue('padding-right')),
			"height": parseFloat(window.getComputedStyle(contentContainer, null).getPropertyValue('height')),
			"left": parseFloat(window.getComputedStyle(mainContainer, null).getPropertyValue('padding-left')),
			"right": parseFloat(window.getComputedStyle(mainContainer, null).getPropertyValue('width')) 
				- parseFloat(window.getComputedStyle(mainContainer, null).getPropertyValue('padding-right')),
			"top": parseFloat(window.getComputedStyle(topnav, null).getPropertyValue('height')),
			"bottom": parseFloat(window.getComputedStyle(contentContainer, null).getPropertyValue('height'))
				+ parseFloat(window.getComputedStyle(topnav, null).getPropertyValue('height'))
		};
		switch(this.states[this.state].direction){
			case 'down':{
				left = this.states[this.state].x == 'left' 
					? limit.left 
					: this.states[this.state].x == 'right' 
						? limit.right - init.width 
						: ((init.left + init.width) > limit.right ? (limit.right - init.width) : init.left);
				width = init.width;
				top = init.bottom;
				height = (init.height + init.bottom) > limit.bottom ? (limit.bottom - init.bottom) : init.height;
				break;
			}
			case 'left':{
				left = (init.left - init.width) < limit.left ? limit.left : init.left - init.width;
				width = init.width > (init.left - limit.left) ? (init.left - limit.left) : init.width;
				top = init.top;
				height = init.height;
				break;
			}
			case 'up':{
				left = this.states[this.state].x == 'left' 
					? limit.left 
					: this.states[this.state].x == 'right' 
						? limit.right - init.width 
						: ((init.left + init.width) > limit.right ? (limit.right - init.width) : init.left);
				// left = (init.left + init.width) > limit.right ? (limit.right - init.width) : init.left;
				width = init.width;
				top = init.top - init.height < limit.top ? limit.top : init.top - init.height;
				height = init.height > limit.height ? limit.height : init.height;
				break;
			}
			case 'right':{
				left = init.right;
				width = init.width > (limit.right - init.right) ? (limit.right - init.right) : init.width;
				top = init.top;
				height = init.height;
				break;
			}
		}
		rect["left"] = left + 'px';
		rect["width"] = width + 'px';
		rect["top"] = top + 'px';
		rect["height"] = height + 'px';
		return rect;
	}

	initTriggers(e){
		let start = this.state;
		for(let i = 0; i < this.triggers.length; i++){
			let trigger = this.triggers[i];
			if(trigger.type != e.type) continue;
			if(trigger.source != start) continue;
			// console.log(this.name+': '+start+' - '+trigger.source);
			let target = (['click','mousedown','mouseup'].includes(e.type)) ? (e.target || e.srcElement) : null; 
			let sp = trigger.control == 'e.key' ? '"' : '';
			let operators = {
				'morethan': () => {return (trigger.control+'>'+sp+trigger.par+sp);},
				'lessthan': () => {return (trigger.control+'<='+sp+trigger.par+sp);},
				'equal': () => {return (trigger.control+'=='+sp+trigger.par+sp);},
				'isnested': () => {return 'this.isNested(target,this.control.element)'}
			};
			let cmd = trigger.compare ? 'if('+operators[trigger.compare.toLowerCase()]()+')' : '';
			cmd += ' if(this.state == start) this.runCommand(trigger);';
			if(trigger.compare.toLowerCase() == 'isnested' && !this.control) continue;
			eval(cmd);
		}
	}

	runCommand(trigger){
		// console.log('Running trigger "' + trigger.type + '" for menu "' + this.name + '" in ' + this.state + ' state');
		// console.log('Execute command ' + trigger.command);
		switch(trigger.command){
			case 'applyState':{
				this.transition = trigger.transitiontime;
				this.state = trigger.target;
				break;
			}
		}
	}

	createContainer(){
		let body = document.createElement('div');
		body.className = 'menu-holder';
		body.style.transition = 'all 0s';
		return body;
	}

	createElements(src){
		if(!src || src.constructor !== Array) return;
		let controls = {};
		for(let i = 0; i < src.length; i++){
			let item = this.addElement(src[i]);
		}
	}

	addElement(src){
		let tmpl = {
			"name": "",
			"text": "",
			"translatable": false,
			"visible": true,
			"selectable": false,
			"dynamic": false,
			"selfheight": "",
			"hint": "",
			"command": "",
			"parameter": "",
			"icon_color": "",
			"icon_position": "",
			"icon_type": "",
			"imageheight": "",
			"icon": ""
		};
		for(let i of Object.keys(tmpl)){
			tmpl[i] = src[i] || '';
		}
		let item = new Tool(tmpl);
		if(tmpl.command == 'link'){
			let link = tmpl.parameter,
				url = window.location.href;
			let external = link.split('.').length > 1;
			if(!url.includes(link) || url.includes('?')) {
				item.element.href = link + (link.includes('#') ? '' : '.php');
				if(external) item.element.target = '_blanc';
			}
		}
		this.body.appendChild(item.element);
		if(item.visible) this.elementCount++;
		this.elements[item.name] = item;
	}
}
