document.addEventListener('DOMContentLoaded',()=>{

	let hashTags_name_table = "hashTags"
	let id_img_column_name = "id_img"

	let imgObj_name_table = "imageObj"
	let hashTags_column_name = "hashTag_id" 


	let btn = document.querySelectorAll('button[name="tab"]')[0]
	btn.addEventListener('click', ()=>{
		
		if(menu.header.childNodes.length < 1) ajax.get("comand=tab")

	})


	function receive_ajax(){
		if(this.readyState == 4){
			if(this.status == 200){
				params.blockAjax = false
				if(params.resText){
					ajax.serverRespons = this.responseText
				}else{
					ajax.serverRespons = JSON.parse(this.responseText)
				}
				params.nextFunc()
				
			}
		}
	}



	class Menu{
		constructor(elem, elem2, elem3){
			this.header = elem
			this.content = elem2
			this.msg = elem3
		}

		showHeader(){
			let img = document.createElement('img')
			img.setAttribute('src', "../img/plus.png")
			img.setAttribute('name', "addTable")
			this.header.append(img)
			img.addEventListener('click', this.addTable.bind(this))
			let res = ajax.serverRespons
			for(let i =0; i< res.length; i++){
				let s = document.createElement('a')
				s.innerText = res[i]['name']
				s.setAttribute('sql', res[i]['sql'])
				this.header.append(s)
				s.addEventListener('click', ()=>{
					params.targetElem = s
					menu.openTable(0)
				})
			}
		}
		
		resultAddTable(name_tb, sql){
			if(ajax.serverRespons == 1){
				this.showMsg()
				this.clearResult()
				let a = document.createElement('a')
				let sq = "CREATE TABLE "+name_tb+" ("+sql+")"
				a.setAttribute('sql', sq)
				a.innerText = name_tb
				ajax.serverRespons = 0
				a.addEventListener('click', ()=>{
					params.targetElem = a
					menu.openTable(0)
				})
				this.header.append(a)
			}
			else this.showMsg('r', ajax.serverRespons)
			params.resText = false
		}

		showMsg(col="g", text="Успех"){
			let time
			this.msg.innerText = text
			if(col == "g"){
				time = 2000
				this.msg.classList = 'msg_action msg_succ msg'
			}else if(col == "r"){
				time = 8000
				this.msg.classList = "msg_err msg_action msg"
			}
			setTimeout(()=>{
				this.msg.classList.remove('msg_action')
				this.msg.style.right = (-this.msg.offsetWidth)+"px"
			}, time)
		}
		
		addTable(){
			this.clearResult()
			table.addTable()
		}

		openTable(req){
			if(!params.blockAjax){
				if(req == 0){
					params.nextFunc = menu.openTable.bind(this, 1)
					params.resText = false
					ajax.get("comand=data_of_table&name_table="+params.targetElem.innerText)
				}
				if(req ==1){
					menu.clearResult()
					params.targetElem.classList.add('name_table_open')
					let cl_img = document.createElement('img')
					cl_img.setAttribute('src', "../img/close.png")
					params.targetElem.after(cl_img)
					cl_img.addEventListener('click', menu.dropTable.bind(null, 0))
					
					let nameTable = params.targetElem.innerText

					if(nameTable == imgObj_name_table){
						imgObj.createImgTab()
						return
					}

					table.createTable()

					if(nameTable == hashTags_name_table){
						hashTags.disableInputs()
					}
				}
			}
		}

		dropTable(req){
			if(!params.blockAjax){
				if(req == 0){
					if(confirm("Удалить таблицу: "+ params.targetElem.innerText)){
						params.nextFunc = menu.dropTable.bind(null, 1)
						params.resText = true
						ajax.get("comand=dropTable&name_table="+params.targetElem.innerText)
					}
				}
				if(req == 1){
					if(ajax.serverRespons == 1){
						menu.showMsg()
						params.targetElem.remove()
						menu.clearResult()
					}else{
						menu.showMsg('r', params.serverRespons)
					}
					params.resText = false
				}
			}
		}

		clearResult(){
			let name_tables = this.header.childNodes
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
			let out = this.content.children
			let ind = out.length
			for(let j = ind; j!=0 ; j--){
				out[j-1].remove()
			}
		}
	}

	class Table{

		createTable(){

			let col_name = []
			let col_query_text = []
			
			parseColumns()

			let tab = document.createElement('table')
			let thead = document.createElement('thead')
			let tbody = document.createElement('tbody')

			createHeadTab()

			createInputs()

			if(ajax.serverRespons.length > 0){
				createBodyTab()
			}

			tab.append(thead)

			tab.append(tbody)
			menu.content.append(tab)

			function createInputs(){
				let tr = document.createElement('tr')

				for(let i = 0; i<col_name.length; i++){
					let th = document.createElement('th')
					let area = document.createElement('textarea')
					area.setAttribute('type', 'text')
					area.setAttribute('name', col_name[i])
					th.append(area)
					tr.append(th)
				}

				let img = document.createElement('img')
				img.setAttribute('src', "../img/plus.png")
				img.classList = 'img_add_row'
				img.addEventListener('click', table.add_row.bind(null, 0))
				tr.append(img)
				thead.append(tr)

			}

			function parseColumns(){
				let sql = params.targetElem.getAttribute('sql')
				let sl = sql.slice(sql.indexOf('(')+ 1, -1)
				let L_sql = sl.split(',')
				for(let i = 0; i<L_sql.length; i++){
					col_name.push(L_sql[i].slice(0, L_sql[i].indexOf(" ")).trim())
					col_query_text.push(L_sql[i].slice(L_sql[i].indexOf(" ")).trim())
				}
			}

			function createHeadTab(){
			
				let tr = document.createElement('tr')
				let tr2 = document.createElement('tr')
				for(let i=0; i<col_name.length; i++){
					let th = document.createElement('th')
					let th2 = document.createElement('th')
					th.innerText = col_name[i]
					th2.innerText = col_query_text[i]
					tr.append(th)
					tr2.append(th2)
				}
				thead.append(tr)
				thead.append(tr2)
			}

			function createBodyTab(){
				
				for(let i = 0; i < ajax.serverRespons.length; i++){
					let tr = document.createElement('tr')
					for(let j=0; j<col_name.length; j++){
						let td = document.createElement('td')
						let elem
						let data = ajax.serverRespons[i][col_name[j]]
						if(typeof(data) == "string"){
							if(data.length > 20){
								elem = document.createElement('textarea')
							}else{
								elem = document.createElement('input')
							}
						}else{
							elem = document.createElement('input')
						}
						elem.value = data
						elem.addEventListener('focus', table.focusInput)
						elem.addEventListener('blur', table.blurInput)
						td.append(elem)
						tr.append(td)
					}
					let img = document.createElement('img')
					img.setAttribute('src', "../img/close.png")
					img.classList = 'im_del_row'
					img.addEventListener('click', table.delete_row.bind(tr, 0))
					tr.addEventListener('mouseenter', table.show_cl_icon)
					tr.addEventListener('mouseleave', table.shadow_cl_icon)
					tr.append(img)
					tbody.append(tr)
				}
			}		
		}

		focusInput(){
			if(!params.focusBlock){
				params.cellElem = this
				params.cellOldValue = this.value
			}			
		}

		blurInput(){
			if(this == params.cellElem){
				if(this.value != params.cellOldValue){
					params.cellNewValue = this.value
					if(confirm(`Изменить значение ${params.cellOldValue} на ${this.value}?`)){
						params.focusBlock = true
						table.updateCell(this)
					}else{
						this.value = params.cellOldValue
					}
				}
			}
		}

		updateCell(inputEvent){
			if(typeof(inputEvent) == "object"){
				let name_tb = document.querySelector('.name_table_open').innerText		
				let th = document.querySelector('thead tr').querySelectorAll('th')
				let tr = inputEvent.parentNode.parentNode
				let inputs = tr.querySelectorAll('input, textarea')
				let ind_col
				for(let i =0; i<inputs.length; i++){
					if(inputEvent == inputs[i]) ind_col = i
				}
				inputEvent.value = params.cellOldValue
				let par = table.collectDataRow(tr)
				params.nextFunc = table.updateCell.bind(null, 1)
				params.resText = true
				let query = `comand=updateCell&name_table=${name_tb}&col=${th[ind_col].innerText}&newVal=${params.cellNewValue}`
				ajax.post(par+= query)
				params.cellElem = inputEvent
			}
			if(inputEvent == 1){
				if(ajax.serverRespons == '1'){
					menu.showMsg()
					params.cellElem.value = params.cellNewValue
				}else{
					params.cellElem.value = params.cellOldValue
					menu.showMsg('r', ajax.serverRespons)
				}
				params.resText = false
				params.focusBlock = false
			}
		}

		show_cl_icon(){
			let cross = this.querySelectorAll('img')
			if(cross.length > 1){
				cross[1].style.opacity = 1
			}else{
				cross[0].style.opacity = 1
			}
			let td = this.querySelectorAll('td')
			for(let i = 0; i< td.length; i++){
				td[i].style.border = "solid 1px black"
			}
		}

		shadow_cl_icon(){
			let cross = this.querySelectorAll('img')
			if(cross.length > 1){
				cross[1].style.opacity = 0
			}else{
				cross[0].style.opacity = 0
			}
			let td = this.querySelectorAll('td')
			for(let i = 0; i< td.length; i++){
				td[i].style.border = "unset"
			}
		}
		collectDataRow(tr){
			let th = document.querySelector('thead tr').querySelectorAll('th')
			let inp = tr.querySelectorAll("input, textarea")
			let par = ""
			for(let i=0; i<inp.length; i++){
				if(th[i].innerText == "") continue
				par += th[i].innerText+"="+inp[i].value+"&"
			}
			return par
		}
		delete_row(req){
			if(req == 0){
				let par = table.collectDataRow(this)

				if(confirm('Удалить строку: '+ par)){
					let name_tb
					let a = menu.header.querySelectorAll('a') 
					for(let i=0; i<a.length; i++){
						if(a[i].classList.contains('name_table_open')){
							name_tb = a[i].innerText
						}
					}
					params.nextFunc = table.delete_row.bind(this, 1)
					params.resText = true
					par += "comand=delete_row&name_table="+name_tb
					ajax.post(par)
				}
			}
			if(req ==1){
				if(ajax.serverRespons == 1){
					menu.showMsg()
					this.remove()
				}else{
					menu.showMsg('r', ajax.serverRespons)
				}
				params.resText = false
			}
		}
		addTable(){
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
			let out = menu.content
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
				if(!params.blockAjax){
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
					let sql_colum = ""
					for(let i=0; i<colums.length; i++){
						let r =""
						for(let k in colums[i]){
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
					params.nextFunc = menu.resultAddTable.bind(menu, name_tb, sql_colum)
					params.resText = true
					ajax.post(par)
				}
			})
		}

		add_row(req){
			if(!params.blockAjax){
				let inputs = menu.content.querySelectorAll('thead textarea')
				if(req == 0){		
					params.nextFunc = table.add_row.bind(null, 1)
					ajax.get('comand=table_info&table_name='+params.targetElem.innerText)
				}
				if(req == 1){
					let par = ""
					for(let i=0; i<inputs.length; i++){
						if(ajax.serverRespons[i]['pk']) continue
						if (inputs[i].value=="") continue
						par = par + inputs[i].name + "="+inputs[i].value+"&"
					}
					par = par+'comand=add_record_table&name_table='+params.targetElem.innerText
					params.nextFunc = table.add_row.bind(null, 2)
					params.resText = true
					ajax.post(par)
				}
				if(req == 2){
					if(ajax.serverRespons == 1){
						for(let i=0; i<inputs.length; i++){
							inputs[i].value = ""
						}
						params.nextFunc = table.viewRow
						ajax.get('comand=get_last_row&name_table='+params.targetElem.innerText)
						menu.showMsg()
					}
					else menu.showMsg('r', ajax.serverRespons)
					params.resText = false
				}
			}
		}
		viewRow(){
			let tbody = document.querySelectorAll('.con_table tbody')[0]
			let tr = document.createElement('tr')
			for (let k in ajax.serverRespons){
				let td = document.createElement('td')
				let elem
				if(typeof(ajax.serverRespons[k]) == "string"){
					if(ajax.serverRespons[k].length > 25){
						elem = document.createElement('textarea')
					}else{
						elem = document.createElement('input')
					}
				}else{
					elem = document.createElement('input')
				}
				// let inp = document.createElement('input')
				elem.addEventListener('focus', table.focusInput)
				elem.addEventListener('blur', table.blurInput)
				elem.value = ajax.serverRespons[k]
				td.append(elem)
				tr.append(td)
			}
			tbody.append(tr)
			let img = document.createElement('img')
			img.setAttribute('src', "../img/close.png")
			img.classList = 'im_del_row'
			img.addEventListener('click', table.delete_row.bind(tr, 0))
			tr.append(img)
			tr.addEventListener('mouseenter', table.show_cl_icon)
			tr.addEventListener('mouseleave', table.shadow_cl_icon)
		}
	}

	class ImageObj extends Table{

		openThisTabl = false

		hashTags = {}

		dataTable = {}

		

		createImgTab(){

			let dt = this.dataTable
			ajax.serverRespons.forEach(function(item, i){
				dt[item['id']] = item
			})
			this.dataTable = dt


			let div = document.createElement('div')
			div.classList = "scan_dir"
			let btn = document.createElement('button')
			btn.innerText = "Сканировать"
			btn.addEventListener('click', this.scanDir.bind(this, 1))	
			let inp = document.createElement('textarea')
			div.append(inp)
			div.append(btn)
			menu.content.append(div)



			this.createTable()




			let tr_th = document.querySelectorAll('thead > tr')

			for(let i=0; i < tr_th.length; i++){
				let th = tr_th[i].querySelector('th:first-child')
				let f_th = document.createElement('td')
				th.after(f_th)
				th.after(document.createElement('td'))
				if(i == tr_th.length -1){
					let n_td = document.createElement('td')
					n_td.innerText ="Хэштеги"
					f_th.after(n_td)		
				}else{
					f_th.after(document.createElement('td'))
				}

			}

			let tr = document.querySelectorAll("tbody tr")

			for (let i =0; i < tr.length; i++){
				let td = tr[i].querySelector("td:first-child")
				let new_td = document.createElement('td')
				new_td.classList = "imgTableCell"
				let pic = document.createElement('picture')
				let src = document.createElement('source')
				src.setAttribute('srcset', "../" + ajax.serverRespons[i]['webp'])
				pic.append(src)
				let img = document.createElement('img')
				img.setAttribute('src', "../"+ajax.serverRespons[i]['jpg'])
				pic.append(img)
				new_td.append(pic)
				td.after(new_td)
				new_td.after(document.createElement('td'))

				let input_4 = tr[i].querySelector('td:nth-child(4')
				input_4 = input_4.querySelector('input')
				input_4.setAttribute('disabled', 'disabled')

			}



			params.resText = false
			params.nextFunc = this.insSelects.bind(this)
			ajax.get(`comand=data_of_table&name_table=${hashTags_name_table}`)
		}


		insSelects(n){


			let dt_hash = this.hashTags

			for(let i = 0; i<ajax.serverRespons.length; i++){
				dt_hash[ajax.serverRespons[i]['id']] = ajax.serverRespons[i]
			}
			this.hashTags = dt_hash

			let htmlSel = "<select class=select_hashTag multiple>"
			let keys = Object.keys(this.hashTags)
			keys.forEach(function(k, item){
				let s = `<option value=${dt_hash[k]['id']}>${dt_hash[k]['name']}</option>`
				htmlSel +=s
			})
			htmlSel += "</select>"


			let tr = document.querySelectorAll("tbody tr")
			for(let i = 0; i<tr.length; i++){
				let idTr = tr[i].querySelector('td:first-child')
				idTr = idTr.querySelector('input').value
				


				let img_td = tr[i].querySelector('td:nth-child(2)')
				let new_td = document.createElement('td')
				new_td.insertAdjacentHTML('beforeend', htmlSel)
				img_td.after(new_td)
				let sel = tr[i].querySelector('select')
				sel.addEventListener("blur" , this.blurSelect.bind(this, tr[i], sel))

				let hashTagTd = tr[i].querySelector('td:nth-child(4)')

				let hashTag_id = this.dataTable[idTr][hashTags_column_name]
				if(hashTag_id != ''){
					hashTag_id = JSON.parse(hashTag_id)

					for(let j = 0; j<hashTag_id.length; j++){
						let div = document.createElement('div')
						div.innerText = this.hashTags[hashTag_id[j]]['name']
						div.classList = 'divHashTag'
						div.addEventListener('click', this.delHashTag.bind(this, idTr, hashTag_id[j], tr[i]))
						hashTagTd.append(div)
					}
				}
			}
			
		}

		delHashTag(idTr, idHashTag, tr){
			let par = `comand=delHashTag&idImg=${idTr}&idHashTag=${idHashTag}`
			params.nextFunc = this.viewDelHashTag.bind(this, idHashTag, tr)
			params.resText = true
			ajax.post(par)
		}
		viewDelHashTag(idHashTag, tr){
			if(ajax.serverRespons == 1){

				menu.showMsg()

				let td = tr.querySelectorAll('td')
				let div = td[3].querySelectorAll('div')
				let indDiv
				for(let i=0; i<div.length; i++){
					if(div[i].innerText == this.hashTags[idHashTag]["name"]){
						indDiv = i
					}
				}
				div[indDiv].remove()
				let input = td[4].querySelector('input')
				let hashTag = input.value
				hashTag = JSON.parse(hashTag)
				let newHash = []
				for(let i=0; i<hashTag.length; i++){
					if(hashTag[i] != idHashTag){
						newHash.push(hashTag[i])
					}
				}
				input.value = JSON.stringify(newHash)
				
			}else{
				menu.showMsg('r', ajax.serverRespons)
			}
		}

		blurSelect(tr, sel){
			let chose = []
			for(let i = 0; i < sel.length; i++){
				if(sel[i].selected){
					chose.push(sel[i].value)
				}
			}
		
			let oldhash


			let inputs = tr.querySelectorAll('input, textarea')
			if(chose.length > 0){
				if(inputs[1].value == "" || inputs[1].value === null){
					oldhash = []
				}else{
					oldhash = JSON.parse(inputs[1].value)
				}
			}
			

			let clear_val = []

			for(let i =0; i<chose.length; i++){
				if(oldhash.indexOf(Number(chose[i])) < 0){
					clear_val.push(Number(chose[i]))
				}
			}

			if(clear_val.length > 0){
				params.resText = true
				params.nextFunc = this.resInsSel.bind(this, clear_val, tr)
				let query = `id=${inputs[0].value}&comand=addHashTag&value=${JSON.stringify(clear_val)}`
				ajax.post(query)
			}

		}

		resInsSel(clear_val, tr){


			if(ajax.serverRespons =="1"){

				// Отображение изменений
				let inputs = tr.querySelectorAll('input, textarea')
				let td = tr.querySelectorAll('td')
				let idTr = inputs[0].value
				for (let i = 0; i < clear_val.length; i++){
					let n_td = document.createElement('div')
					n_td.classList = "divHashTag"
					n_td.innerText = this.hashTags[clear_val[i]]['name']
					n_td.addEventListener('click', this.delHashTag.bind(this, idTr, clear_val[i], tr))
					td[3].append(n_td)
				}

				if(inputs[1].value == '' || inputs[1].value == null ){
					inputs[1].value = JSON.stringify(clear_val)
				}else{
					let arr = JSON.parse(inputs[1].value)
					for(let i=0; i<clear_val.length; i++){
						arr.push(clear_val[i])
					}
					inputs[1].value = JSON.stringify(arr)
				}

				menu.showMsg()

			}else{
				menu.showMsg("r", ajax.serverRespons) 
			}
			params.resText = false
		}

		
		scanDir(n){
			if(n == 1){
				let textarea = document.querySelector(".scan_dir textarea")
				params.resText = true
				params.nextFunc = this.scanDir.bind(this, 2)
				ajax.handlerUrl = "scanImage.php"
				ajax.get('comand=scan_dir&path='+textarea.value)
			}
			if(n == 2){
				if(ajax.serverRespons == 0){
					alert("Ничего не найдено")
				}else{
					if(confirm(`Добавить в базу данных ${ajax.serverRespons} записей?`)){
						params.nextFunc = this.scanDir.bind(this, 3)
						ajax.get("comand=add_record")
					}
				}
			}
			if(n == 3){
				if(ajax.serverRespons == 1){
					menu.showMsg()
				}else{
					menu.showMsg("r", ajax.serverRespons)
				}
				ajax.handlerUrl = "handlerDB.php"
			}		
		}

	}

	class hashTags extends Table{
		disableInputs(){
			let tr = document.querySelectorAll('tbody tr')
			for(let i=0; i<tr.length; i++){
				let input = tr[i].querySelector('td:nth-child(3)').querySelector('input')
				if(!input){
					input = tr[i].querySelector('td:nth-child(3)').querySelector('textarea')
				}
				input.setAttribute('disabled', "disabled")
			}
		}
	}
	

	class Ajax{

		handlerUrl = "handlerDB.php" 

		post(par){
			if(!params.blockAjax){		
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
				params.blockAjax = true
			}
		}

		get(get_params){
			if(!params.blockAjax){	
				var httpRequest;
				if (window.XMLHttpRequest) { // Mozilla, Safari, ...
				    httpRequest = new XMLHttpRequest();
				} else if (window.ActiveXObject) { // IE
				    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
				}

				httpRequest.overrideMimeType('text/xml');

				httpRequest.open('GET', this.handlerUrl+"?"+get_params, true);

				httpRequest.onreadystatechange = receive_ajax

				httpRequest.send(null);
				params.blockAjax = true
			}
		}
	}


	ajax = new Ajax()
	let ms = document.querySelectorAll('.msg')[0] 
	menu = new Menu(document.querySelectorAll('.result')[0], document.querySelectorAll('.con_table')[0], ms)
	table = new Table()
	imgObj = new ImageObj()
	hashTags = new hashTags()





	let params = {
		nextFunc : menu.showHeader.bind(menu),
		targetElem: null,
		blockAjax: undefined,
		focusBlock: false
		
	}

})




