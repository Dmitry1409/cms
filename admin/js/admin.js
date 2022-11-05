document.addEventListener("DOMContentLoaded",()=>{
	let btn = document.querySelector("button[name='tab']").addEventListener('click', tabAction)

	let params = {
		comand : "tab"
	}

	function tabAction(){
		ajax("comand=tab")
	}

	function ajaxPOST(par){
		var httpRequest;
		if (window.XMLHttpRequest) { // Mozilla, Safari, ...
		    httpRequest = new XMLHttpRequest();
		} else if (window.ActiveXObject) { // IE
		    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
		}

		httpRequest.overrideMimeType('text/xml');

		httpRequest.open('POST', "handlerDB.php", true);
		httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		httpRequest.onreadystatechange = receive_ajax

		httpRequest.send(par)
	}

	function ajax(get_params){
		// В результате, чтобы
		//  создать кросс-браузерный объект требуемого класса, вы можете сделать следующее:
		var httpRequest;
		if (window.XMLHttpRequest) { // Mozilla, Safari, ...
		    httpRequest = new XMLHttpRequest();
		} else if (window.ActiveXObject) { // IE
		    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
		}
		// Некоторые версии некоторых броузеров Mozilla не будут корректно работать,
		//  если ответ сервера не содержит заголовка XML mime-type.
		httpRequest.overrideMimeType('text/xml');

		// Далее вам необходимо решить, что вы будете делать после получения ответа сервера.
		// console.log('http://localhost/cms/admin/handlerDB.php?' +"comand="+ params.comand) 
		httpRequest.open('GET', 'handlerDB.php?'+get_params, true);

		httpRequest.onreadystatechange = receive_ajax

		httpRequest.send(null);

	}

	function receive_ajax(){
		if (this.readyState == 4){
			if(this.status == 200){
				if(params.resText){
					params.server_respons = this.responseText
				}else{
					params.server_respons = JSON.parse(this.responseText)
				}


				if (params.comand == 'tab') viewTable()

				if(params.comand == 'open_table'){
				 	open_table()
				}
				if(params.comand == 'actionRowRecord'){
					add_row(false)
				}
				if(params.comand =='add_table'){
					addTable(false)
				}
				if(params.comand=="dropTable"){
					dropTable(false)
				}

			}else if(this.status >= 500){

			}

		}
	}

	function dropTable(event=true){
		// console.log(this.previousSibling.innerText)
		if(event){
			if(confirm("Удалить таблицу: "+this.previousSibling.innerText)){
				params.comand = "dropTable"
				params.resText = true
				ajax("comand=dropTable&name_table="+ this.previousSibling.innerText)
			}
		}else{
			console.log(params.server_respons == 1)
			if(params.server_respons == 1){
				show_msg('Успешно', "green")
				setTimeout(()=>{location.reload()}, 1000)
			}else{
				show_msg('Ошибка: '+ params.server_respons, "red")
			}
		}
			
	}

	function open_table(){
		
		clear_result()

		let cl_img = document.createElement('img')
		cl_img.setAttribute('src', "../img/close.png")
		params.target_element.after(cl_img)

		cl_img.addEventListener('click', dropTable)

		let out_div = document.querySelectorAll('.con_table')[0]

		let sql = params.target_element.getAttribute('sql')
		let sl = sql.slice(sql.indexOf('(')+ 1, -1)
		let L_sql = sl.split(',')
		
		let tab = document.createElement('table')
		let thead = document.createElement('thead')
		let tbody = document.createElement('tbody')

		if(params.server_respons.length > 0){
			// console.log(Object.keys(params.server_respons[0]))			
			let L_columns = Object.keys(params.server_respons[0])
			params.target_element.classList.add('name_table_open')
		
			let tr_h = document.createElement('tr')
			let tr_h2 = document.createElement('tr')

			for(let i = 0; i < L_columns.length; i++){
				let r = document.createElement('th')
				r.innerText = L_columns[i]
				tr_h.append(r)
			}
			for(let i =0; i<L_columns.length; i ++){
				let h = document.createElement('th')
				h.innerText = L_sql[i].slice(L_sql[i].indexOf(' ')+1)
				tr_h2.append(h)
			}

			thead.append(tr_h)
			thead.append(tr_h2)
			
			for(let i =0; i<params.server_respons.length; i++){
				let tr = document.createElement('tr')
				for(let j=0; j<L_columns.length; j++){
					let td = document.createElement('td')
					td.innerText = params.server_respons[i][L_columns[j]]
					tr.append(td)
				}
				let im = document.createElement('img')
				im.setAttribute('src', "../img/close.png")
				im.classList = 'im_del_row'
				tr.append(im)
				im.addEventListener('click', delete_row)
				tr.addEventListener('mouseenter', show_cl_icon)
				tr.addEventListener('mouseleave', shadow_cl_icon)
				tbody.append(tr)
			}
			
		}else{		
			params.target_element.classList.add('name_table_open')
			let tr = document.createElement('tr')
			let tr2 = document.createElement('tr')
			for(let i=0; i<L_sql.length; i++){
				let th = document.createElement('th')
				let th2 = document.createElement('th')
				if(L_sql[i].trim().indexOf(' ') == -1){
					th.innerText = L_sql[i]
					th2.innerText = L_sql[i]
				}else{
					th.innerText = L_sql[i].slice(0,L_sql[i].indexOf(' ')).trim()
					th2.innerText = L_sql[i].slice(L_sql[i].indexOf(' ')).trim()
				}
				tr.append(th)
				tr2.append(th2)
			}
			thead.append(tr)
			thead.append(tr2)			
		}

		
		let tr3 = document.createElement('tr')
		tr3.classList = "row_img"
		let input = document.createElement('input')
		let L_input = []
		if(params.server_respons.length > 0){
			let L_columns = Object.keys(params.server_respons[0])
			for(let i = 0; i<L_columns.length; i++){
				let inp = document.createElement('input')
				inp.setAttribute('type', 'text')
				inp.setAttribute('name', L_columns[i])
				inp.classList = 'input_creat_record'
				L_input.push(inp)
			}
		}else{
			for(let i =0; i<L_sql.length; i++){
				let inp = document.createElement('input')
				inp.setAttribute('type', 'text')
				inp.setAttribute('name', L_sql[i].trim().slice(0,L_sql[i].indexOf(' ')).trim())
				inp.classList = 'input_creat_record'
				L_input.push(inp)
			}
		}
		for(let i = 0; i< L_input.length; i++){
			let td = document.createElement('td')
			td.append(L_input[i])
			tr3.append(td)
		}

		let img = document.createElement('img')
		img.setAttribute('src', "../img/plus.png")
		img.classList = 'img_add_row'
		img.addEventListener('click', add_row)
		tr3.append(img)
		thead.append(tr3)

		tab.append(thead)

		tab.append(tbody)
		out_div.append(tab)

	}

	function show_cl_icon(){
		let im = this.querySelectorAll('img')[0]
		im.style.opacity = '1'
	}
	function shadow_cl_icon(){
		this.querySelectorAll('img')[0].style.opacity = "0"
	}

	function delete_row(){
		console.log(this)
	}

	function clear_result(){
		let name_tables = document.querySelectorAll('.result')[0].childNodes
		for(let i=0; i<name_tables.length; i++){
			if(name_tables[i].classList.contains('name_table_open')){
				name_tables[i].classList.remove('name_table_open')
			}
			if(name_tables[i].tagName == "IMG"){
				if(name_tables[i].name == "" ){
					name_tables[i].remove()
				}
			}
		}
		let out = document.querySelectorAll('.con_table')[0].childNodes
		for(let j = 0; j<out.length; j++){
			out[j].remove()
		}
	}

	function add_row(click = true){
		document.querySelectorAll('.msg')[0].classList = "msg"
		let inputs = document.querySelectorAll('.con_table')[0].querySelectorAll('input')
		if(click){
			params.comand = "actionRowRecord"
			params.add_row = "ajaxGet"
			ajax('comand=table_info&table_name='+params.target_element.innerText)						
			
		}else{
			if(params.add_row == "ajaxGet"){
				let par = ""
				for(let i=0; i<inputs.length; i++){
					if(params.server_respons[i]['pk']) continue
					if (inputs[i].value=="") continue
					par = par + inputs[i].name + "="+inputs[i].value+"&"
				}
				par = par+'comand=add_record_table&name_table='+params.target_element.innerText
				delete params.add_row
				params.show_msg = true
				params.resText = true
				ajaxPOST(par)
				return
			}
			if(params.show_msg){
				let d = document.querySelectorAll('.msg')[0]
				if(params.server_respons == 1){					
					for(let i = 0; i<inputs.length; i++){
						inputs[i].value = ""
					}
					params.viewRow = true
					delete params.show_msg
					params.resText = false
					ajax('comand=get_last_row&name_table='+params.target_element.innerText)
					return
				}else{
					show_msg("Ошибка: "+params.server_respons, "red")
				}
			}
			if(params.viewRow){
				show_msg("Успешно", "green")
				let tbody = document.querySelectorAll('.con_table tbody')[0]
				let tr = document.createElement('tr')
				for (k in params.server_respons){
					let td = document.createElement('td')
					td.innerText = params.server_respons[k]
					tr.append(td)
				}
				tbody.append(tr)
				// params.resText = false
			}
		}
	}

	function show_msg(text, color){
		let d = document.querySelectorAll('.msg')[0]
		d.innerText = text
		if(color == 'green'){
			d.classList = 'msg_action msg_succ msg'
		}else if(color == "red"){
			d.classList = "msg_err msg_action msg"
		}
		setTimeout(()=>{
			d.classList.remove('msg_action')
			d.style.right = (-d.offsetWidth)+"px"
		}, 7000)
	}

	function addTable(click = true){

		clear_result()

		let h = `<div class="wrap_input">
					<input placeholder="имя колонки">
					<select>
						<option value="TEXT">TEXT</option>
						<option value="INTEGER">INT</option>
						<option value="REAL">REAL</option>
						<option value="NULL">NULL</option>
						<option value="BLOB">BLOB</option>
					</select>
					<span><input type="checkbox" name="NOT NULL">NN</span>
					<span><input type="checkbox" name="UNIQUE">UN</span>
					<span><input type="checkbox" name="PRIMARY KEY">PK</span>
					<span><input type="checkbox" name="AUTOINCREMENT">AU</span>
					<input style="width: 100px;" placeholder="default">
				</div>`
		let out = document.querySelectorAll(".con_table")[0]
		
		if(click){
			let html = `<div class="con_add_tab">
							<input class="inp_addtab" placeholder="имя таблицы">
							<button>Отправить</button>
						</div>`

			out.innerHTML = html


			let d = document.querySelectorAll('.con_add_tab')[0]
			d.insertAdjacentHTML('beforeend', h)
			d.insertAdjacentHTML("beforeend", `<img src="../img/plus.png" class="img_add_row">`)
			let img = document.querySelectorAll('.con_add_tab > img')[0]
			
			img.addEventListener('click', ()=>{
				img.insertAdjacentHTML('beforebegin', h)
			})
			let btn = document.querySelectorAll(".con_add_tab button")[0]
			btn.addEventListener('click', ()=>{
				let colums = []
				let wrap_input = document.querySelectorAll('.wrap_input')
				for(let i=0; i<wrap_input.length; i++){
					let ob = {}
					ob.name = wrap_input[i].querySelectorAll('input')[0].value
					ob.type = wrap_input[i].querySelectorAll('select')[0].value
					let inp = wrap_input[i].querySelectorAll('span input')
					ob.atr = ""
					for(let j=0; j<inp.length; j++){
						if(inp[j].checked){
							ob.atr += inp[j].name + " "
						}
					}
					let def = wrap_input[i].querySelectorAll('.wrap_input > input')[1]
					if(def.value != ""){
						ob.def = def.value
					}
					colums.push(ob)
				}
				sql_colum = ""
				for(let i=0; i<colums.length; i++){
					let r =""
					for(k in colums[i]){
						if(colums[i]['name']=="") continue

						if(k == "def"){
							r += "DEFAULT '"+ colums[i][k]+ "'"
							continue
						}
						r += colums[i][k] + " "
					}
					if(i != colums.length -1) r += ","
					
					sql_colum += r.trim()
				}
				let name_tb = document.querySelectorAll(".con_add_tab > input")[0].value
				let par = "name="+name_tb+"&sql="+sql_colum+"&comand=add_table"
				params.comand = "add_table"
				params.resText = true
				// console.log(par)
				ajaxPOST(par)
			})
		}else{
			if(params.server_respons==1) show_msg("Успех", "green")
			else show_msg(params.server_respons, 'red')
			params.resText = false
		}
	}

	function viewTable(){
		d = document.querySelectorAll('.result')[0]
		let img = document.createElement('img')
		img.setAttribute('src', "../img/plus.png")
		img.setAttribute('name', "open")
		d.append(img)
		img.addEventListener('click', addTable)
		let res = params.server_respons
		for(let i =0; i< res.length; i++){
			let s = document.createElement('a')
			s.innerText = res[i]['name']
			s.setAttribute('sql', res[i]['sql'])
			d.append(s)
			s.addEventListener('click', ()=>{
				params.comand = 'open_table'
				params.target_element = s
				ajax("comand=data_of_table&name_table="+s.innerText)
			})
		}
	}
})
