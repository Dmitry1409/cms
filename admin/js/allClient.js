

window.addEventListener("DOMContentLoaded", ()=>{

	class ChangeFildItems{
		constructor(){

			document.querySelector("input[name=telehon]").addEventListener("input", this.changeInput.bind(this))

			this.arr_handler_client_bl = []
			this.arr_handler_cl_row = []
			this.arr_handler_obl_list = []

			this.addEventList()
			
			this.statusFindedClient;
			this.idTimeOut;

			this.obj_status = ["нужно", "замер назначен","замер выполнен","монтаж назначен", "монтаж выполнен"]
			this.client_st = ["новый", "повторно", "замер назначен", "замер выполнен","монтаж назначен", "монтаж выполнен","ушли", "нет связи"]

			this.addObjHtml = `<span class='flex-column'>
									<select>
										<option value="статус">статус</option>
										<option value="нужно">нужно</option>
										<option value="сделано">сделано</option>
										<option value="сделано не удачно">сделано не удачно</option>
										<option value="отказ">отказ</option>
									</select>
									<input autocomplete="off" placeholder='Тип объекта' type='text'>
									<input autocomplete="off" placeholder='Опис' type='text'>
									<input autocomplete="off" placeholder='Адр' type='text' >
									<button id='add_obj_id'>отправить</button>
								</span>`	
		}
		addEventList(){
			let cl_blocks = document.querySelectorAll('.cl_block_id')
			for(let i=0; i<cl_blocks.length; i++){
				let e = this.add_btn_in_cl_block.bind(this)
				this.arr_handler_client_bl.push(e)
				cl_blocks[i].addEventListener('click', e)
			}

			let client_row = document.querySelectorAll('.client-row')
			for(let i=0; i<client_row.length; i++){
				let r = this.client_row_click_act.bind(this)
				this.arr_handler_cl_row.push(r)
				client_row[i].addEventListener('click', r)
			}

			let obj_l = document.querySelectorAll('.obj_id_class')
			for(let i = 0; i<obj_l.length; i++){
				let ob = this.obj_main_view.bind(this)
				this.arr_handler_obl_list.push(ob)
				obj_l[i].addEventListener('click', ob)
			}
		}
		async exec_fetch(arr){
			let fd = new FormData()
			for(let key  in arr){
				fd.append(key, arr[key])
			}
			let res = await fetch('handlerCRM.php', {method: 'POST',body: fd})
			return checkRespondServer(res)
		}
		async delTelFetch(e){
			if(confirm(`Удалить телефон: ${e.currentTarget.previousElementSibling.innerText}`)){
				let arr = {'comand': "deleteTel",
							'tel_id': e.currentTarget.parentNode.getAttribute('tel_id')
						}
				if(this.exec_fetch(arr)){
					e.currentTarget.parentNode.remove()
				}
			}
		}
		changeClientStatus(e){
			if(confirm(`Изменить статус на: '${e.currentTarget.value}'`)){
				let cl_id = e.currentTarget.parentNode.parentNode.getAttribute('client_id')
				let arr = {'comand':'change_fild',
						'table':"clients",
						"tabcol":'status',
						'newval': e.currentTarget.value,
						'rowid':cl_id}
				this.exec_fetch(arr)
			}else{
				e.currentTarget.value = e.currentTarget.parentNode.getAttribute('cl_status')
			}
		}
		addTelClient(e){
			if(confirm(`Добавить новый телефон: ${e.currentTarget.value}`)){
				let cl_id = e.currentTarget.parentNode.getAttribute('client_id')
				let arr = {"comand": "addPhone", "client_id":cl_id, "tel": e.currentTarget.value}
				this.exec_fetch(arr)			
			}
		}
		change_name_client(e){
			if(confirm(`Изменить имя клиента на: '${e.currentTarget.value}'`)){
				let cl_id = e.currentTarget.parentNode.parentNode.getAttribute('client_id')
				let arr = {"comand": 'change_fild',
				 			'table':"clients",
				 			"tabcol": "name",
				 			"newval": e.currentTarget.value,
				 			"rowid": cl_id
				 		}
				this.exec_fetch(arr)
			}
		}
		add_btn_in_cl_block(e){
			e.stopPropagation()

			e.currentTarget.parentNode.style.height = e.currentTarget.parentNode.scrollHeight + "px" 
			let name = e.currentTarget.querySelector('span:nth-child(2)')
			let status = e.currentTarget.querySelector('span:nth-child(3)')
			if(name.innerText != ""){
				name.innerHTML = `<input class='change_name_id' style='width: 140px' type='text' value='${name.innerText}'>`
			}else{
				name.innerHTML = "<input class='change_name_id' style='width: 140px' placeholder='Имя клиента' type='text'>"
			}
			let o = ""
			for(let i=0; i<this.client_st.length; i++){
				if(status.innerText == this.client_st[i]){
					o += `<option value='${this.client_st[i]}' selected>${this.client_st[i]}</option>`
					continue
				}
				o += `<option value='${this.client_st[i]}'>${this.client_st[i]}</option>`
			}

			status.innerHTML = `<select class='select_chang_id'>${o}</select>`
			let tel = e.currentTarget.querySelectorAll('.tel_id')
			for(let i=0; i<tel.length; i++){
				tel[i].insertAdjacentHTML("beforeend", `<img class="del_tel_id" style="margin-left: 15px; width:15px;" src="../img/close.png" >`)
			}

			e.currentTarget.querySelector('.select_chang_id').addEventListener('change', this.changeClientStatus.bind(this))

			let del = e.currentTarget.querySelectorAll('.del_tel_id')
			for(let i =0; i<del.length; i++){
				del[i].addEventListener('click', this.delTelFetch.bind(this))
			}

			e.currentTarget.insertAdjacentHTML('beforeend', `<input class='new_tel_id' style='width: 140px;' type='number' placeholder='Новый тел'>`)

			e.currentTarget.querySelector('.new_tel_id').addEventListener('change', this.addTelClient.bind(this))

			e.currentTarget.querySelector(".change_name_id").addEventListener('change', this.change_name_client.bind(this))

			for(let i=0; i<this.arr_handler_client_bl.length; i++){
				e.currentTarget.removeEventListener('click', this.arr_handler_client_bl[i])
			}
		}
		add_obj_view(e){
			console.log("eee")
			e.currentTarget.parentNode.insertAdjacentHTML('afterend', this.addObjHtml)
			e.currentTarget.parentNode.parentNode.querySelector('#add_obj_id').addEventListener('click', this.addObjFetch.bind(this))
			e.currentTarget.parentNode.parentNode.style.height = e.currentTarget.parentNode.parentNode.scrollHeight + "px"
		}
		addObjFetch(e){
			console.log('fetch')
			let inpts = e.currentTarget.parentNode.querySelectorAll('input')
			let sel = e.currentTarget.parentNode.querySelector('select')
			if(sel.value == "статус"){
				sel.style.border = "1px solid red"
				return
			}else{
				sel.style.border = ""
			}
			if(!inpts[0].value){
				inpts[0].style.border = "1px solid red"
				return
			}else{
				inpts[0].style.border = ""
			}
			if(!inpts[1].value){
				inpts[1].style.border = "1px solid red"
				return
			}else{
				inpts[1].style.border = ""
			}

			// проверяем это найденный блок или в главном списке 
			let cl_id = document.querySelector('.head_finded_cl')
			if(cl_id){
				cl_id = cl_id.getAttribute('client_id')
			}else{
				cl_id = e.currentTarget.parentNode.parentNode.querySelector('.cl_block_id').getAttribute('client_id')
			}	
			let arr = {"comand": "addObject",
						"status": sel.value,
						"description": inpts[1].value,
						"client_id": cl_id
						}
			
			if(inpts[0].value){
				arr.typeObj= inpts[0].value
			}
			if(inpts[2].value){
				arr.address = inpts[2].value
			}			
			this.exec_fetch(arr)
		}
		client_row_click_act(e){
			let svg = `<svg class='svg_up_client_row'  version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						  viewBox="0 0 284.929 284.929" 
						 xml:space="preserve">
							<g>
								<path d="M282.082,76.511l-14.274-14.273c-1.902-1.906-4.093-2.856-6.57-2.856c-2.471,0-4.661,0.95-6.563,2.856L142.466,174.441
									L30.262,62.241c-1.903-1.906-4.093-2.856-6.567-2.856c-2.475,0-4.665,0.95-6.567,2.856L2.856,76.515C0.95,78.417,0,80.607,0,83.082
									c0,2.473,0.953,4.663,2.856,6.565l133.043,133.046c1.902,1.903,4.093,2.854,6.567,2.854s4.661-0.951,6.562-2.854L282.082,89.647
									c1.902-1.903,2.847-4.093,2.847-6.565C284.929,80.607,283.984,78.417,282.082,76.511z"/>
							</g>
						</svg>`
			let d = e.currentTarget
			d.style.height = d.scrollHeight + "px"
			d.insertAdjacentHTML('afterbegin', svg)
			d.querySelector('.svg_up_client_row').addEventListener('click', this.client_row_up.bind(this))
			let obj_list = d.querySelectorAll('.obj_id_class')
			obj_list[obj_list.length -1].insertAdjacentHTML("beforeend", `<img class='add_obj_id' style='width:15px;' src='../img/plus.png' >`)

			d.querySelector('.add_obj_id').addEventListener('click', this.add_obj_view.bind(this))
			for(let i=0; i<this.arr_handler_cl_row.length; i++){
				d.removeEventListener('click', this.arr_handler_cl_row[i])
			}
		}
		client_row_up(e){
			e.stopPropagation()

			e.currentTarget.parentNode.querySelector('.add_obj_id').remove()
			e.currentTarget.parentNode.style.height = ""
			let event = this.client_row_click_act.bind(this)
			e.currentTarget.parentNode.addEventListener('click', event)
			this.arr_handler_cl_row.push(event)
			e.currentTarget.remove()
		}
		changeObjStatus(e){
			if(confirm(`Изменить статус на: '${e.currentTarget.value}'`)){
				let obj_id = e.currentTarget.parentNode.parentNode.getAttribute('obj_id')
				let arr = {"comand": "change_fild",
							"table": "object",
							"tabcol": "status",
							"newval": e.currentTarget.value,
							"rowid": obj_id
							}
				if(this.exec_fetch(arr)){
					e.currentTarget.parentNode.setAttribute('obj_status', e.currentTarget.value)
				}
			}else{
				e.currentTarget.value = e.currentTarget.parentNode.getAttribute('obj_status')
			}
		}
		descTextAreaChange(e){
			if(confirm(`Изменить статус на: '${e.currentTarget.value}'`)){
				let obj_id = e.currentTarget.parentNode.parentNode.getAttribute('obj_id')
				let arr = {"comand": "change_fild",
							"table": "object",
							"tabcol": "description",
							"newval": e.currentTarget.value,
							"rowid": obj_id
							}
				this.exec_fetch(arr)
			}
		}
		addres_text_area_change(e){
			if(confirm(`Изменить статус на: '${e.currentTarget.value}'`)){
				let obj_id = e.currentTarget.parentNode.parentNode.getAttribute('obj_id')
				let arr = {"comand": "change_fild",
							"table": "object",
							"tabcol": "address",
							"newval": e.currentTarget.value,
							"rowid": obj_id
							}
				this.exec_fetch(arr)
			}
		}
		obj_main_view(e){
			let elem = e.currentTarget
			let status = elem.querySelector("span:nth-child(2)")
			let s = ""
			for(let i=0; i<this.obj_status.length; i++){
				if(this.obj_status[i]==status.innerText){
					s += `<option selected value='${this.obj_status[i]}'>${this.obj_status[i]}</option>`
				}else{
					s += `<option value='${this.obj_status[i]}'>${this.obj_status[i]}</option>`
				}
			}
			status.innerHTML = `<select class='obj_status_id' style='width: 125px;'>${s}</select>`

			elem.querySelector('.obj_status_id').addEventListener("change", this.changeObjStatus.bind(this))

			let desc = elem.querySelector("span:nth-child(3)")
			desc.innerHTML = `<textarea class="text_area_desc_id" style="width: 120px;" >${desc.innerText}</textarea>`

			elem.querySelector('.text_area_desc_id').addEventListener('change', this.descTextAreaChange.bind(this))

			let addr = elem.querySelector("span:nth-child(4)")

			if(addr.innerText == ""){
				addr.innerHTML = "<textarea class='addr_chang_id' style='width: 120px;' placeholder='адрс объекта'></textarea>"
			}else{
				addr.innerHTML = `<textarea class='addr_chang_id' placeholder='адрс объекта' style='width: 120px;'>${addr.innerText}</textarea>`
			}

			elem.querySelector('.addr_chang_id').addEventListener('change', this.addres_text_area_change.bind(this))

			elem.parentNode.style.height = elem.parentNode.scrollHeight + "px"
				

			for(let i=0; i<this.arr_handler_obl_list.length; i++){
				elem.removeEventListener('click', this.arr_handler_obl_list[i])
			}
		}
		changeInput(){
			if(this.idTimeOut){
				clearTimeout(this.idTimeOut)
				this.idTimeOut = setTimeout(this.seekTel.bind(this), 1000)
			}else{
				this.idTimeOut = setTimeout(this.seekTel.bind(this), 1000)
			}
		}
		async seekTel(){
			let cl_bl = document.querySelector('.finded_cl_bl')
			if(cl_bl){
				cl_bl.remove()
			}
			let tel = document.querySelector("input[name=telehon]").value
			if(tel.length > 2){
				let cl_tel = clearCharTelehon(tel)
				let res = await fetch(`api/searchInBasaTel.php?tel=${cl_tel}`)
				this.insertFindedTel(await res.json())
			}
		}
		insertFindedTel(obj_cl){			
			if(obj_cl['id']){
				let before_elem = document.querySelector('.addClientId')
				let html = `<div class='finded_cl_bl'>`
					html += `<div client_id=${obj_cl['id']} class='head_finded_cl'>`
						html += `<span client_id=${obj_cl['id']} class='flex-column'>`
							if(obj_cl['name']){
								html += `<input class='change_name_id' style='width: 140px' type='text' value='${obj_cl['name']}'>`
							}else{
								html += `<input class='change_name_id' placeholder='Имя клиента' style='width: 140px' type='text' value=''>`
							}
							html += `<span><select id='sel_finded_cl_id' style='width: 140px;'>`
							for(let i=0; i<this.client_st.length; i++){
								if(this.client_st[i]==obj_cl['status']){
									html += `<option selected value='${this.client_st[i]}'>${this.client_st[i]}</option>`
									this.statusFindedClient = this.client_st[i]
								}else{
									html += `<option value='${this.client_st[i]}'>${this.client_st[i]}</option>`
								}
							}
							html += "</select></span>"

							
						html += `</span>`
						html += `<span client_id=${obj_cl['id']} class='flex-column'>`
							for(let i =0; i<obj_cl['tel_val'].length; i++){
								html += `<span tel_id=${obj_cl['tel_val'][i]['id']}><a href='tel:${obj_cl['tel_val'][i]['val']}'>${obj_cl['tel_val'][i]['val']}</a>
									<img class='img_id_del' style='margin-left: 10px; width: 15px;' src='../img/close.png'></span>`
							}
							html += `<input style='width: 90px;' class='add_tel_id' type='number' placeholder='новый номер' >`
						html += `</span>`
					html += `</div>`
					html += `<div class="flex-wrap">`
						for(let i=0; i<obj_cl['obj_val'].length; i++){
							html += `<span obj_id=${obj_cl['obj_val'][i]['id']} class='flex-column obj_border obj_view_id' >`
								html += `<span>Объект id:${obj_cl['obj_val'][i]['id']}</span>`
								html += `<span>Статус: ${obj_cl['obj_val'][i]['status']}</span>`
								html += `<span>${obj_cl['obj_val'][i]['description']}</span>`
								html += `<span>${obj_cl['obj_val'][i]['address']}</span>`
							html += `</span>`
						}
						html += `<img id='add_obj_view_id' style='width: 15px; height: 15px;' src='../img/plus.png'>`
					html += `</div>`

					html += `<div class="flex-wrap">`
						for(let i=0; i<obj_cl['events'].length; i++){
							html += `<span class='flex-column obj_border'>`
								html += `<span>${obj_cl['events'][i]['type']}:${obj_cl['events'][i]['status']}</span>`
								if(obj_cl['events'][i]['type'] == "ис. звонок"){
									html += `<span><span style='font-weight: bold;'>Результат: </span>${obj_cl['events'][i]['comment']}</span>`
								}
								html += `<span>${obj_cl['events'][i]['start']}</span>`
								if(obj_cl['events'][i]['ref_zamer']){
									html += `<span><a href='showZamer?idZamer=${obj_cl['events'][i]['ref_zamer']}'>Замер №${obj_cl['events'][i]['ref_zamer']}</a></span>`
								}
							html += `</span>`
						}
					html += `</div>`
				html += `</div>`
				before_elem.insertAdjacentHTML("afterend", html)
				let delTel = document.querySelectorAll('.img_id_del')
				for(let i=0; i<delTel.length; i++){
					delTel[i].addEventListener('click', this.delTelFetch.bind(this))
				}
				let insert_obj = document.querySelectorAll('.obj_view_id')
				for(let i=0; i<insert_obj.length; i++){
					let handler = this.obj_main_view.bind(this)
					this.arr_handler_obl_list.push(handler)
					insert_obj[i].addEventListener('click', handler)
				}

				document.querySelector('.change_name_id').addEventListener('change', this.change_name_client.bind(this))
				document.querySelector('.add_tel_id').addEventListener('change', this.addTelClient.bind(this))
				document.querySelector('#add_obj_view_id').addEventListener('click', this.add_obj_view.bind(this))
				document.querySelector('#sel_finded_cl_id').addEventListener('change', this.changeClientStatus.bind(this))
			}else{
				let inp = document.querySelector('input[name=telehon]')
				inp.insertAdjacentHTML('beforebegin', "<span class='noFinded'>Не найдено</span>")
				setTimeout(()=>{
					let h = document.querySelector('.noFinded')
					h.style.opacity = 0
					setTimeout(()=>{
						h.remove()
					},1000)
				},1000)
			}
		}
	}
	let st_ch_b = document.querySelectorAll('.status_client_checked')
	for(let i=0; i<st_ch_b.length; i++){
		st_ch_b[i].addEventListener('change', change_check_box_action)
	}
	let change_fild = new ChangeFildItems()

	document.querySelector('.addClientId').addEventListener("click", addClient)

	document.querySelector('.sort_by_date').addEventListener('click', sort_by_date_view)

	function sort_by_date_view(){
		let svg = document.querySelector('.svg_sort_data')
		if(svg.classList.contains('svg_up')){
			svg.classList.remove('svg_up')
		}else{
			svg.classList.add('svg_up')
		}
		getSortedClientFetch(select_data_checkbox(), get_val_by_data())
	}

	function get_val_by_data(){
		let svg = document.querySelector('.svg_sort_data')
		let out;
		if(svg.classList.contains('svg_up')){
			out = "ASC"
		}else{
			out = "DESC"
		}
		return out
	}

	function select_data_checkbox(){
		for(let i=0; i<st_ch_b.length; i++){
			if(st_ch_b[i].value == "все"){
				if(st_ch_b[i].checked){
					return '["все"]'
				}
			}
		}
		let out = [];
		for(let i=0; i<st_ch_b.length; i++){
			if(st_ch_b[i].checked){
				out.push(st_ch_b[i].value)
			}
		}

		return JSON.stringify(out)
	}
	
	function change_check_box_action(){
		if(this.checked){
			if(this.value == "все"){
				for(let i=0; i<st_ch_b.length; i++){
					if(st_ch_b[i].value != "все"){
						st_ch_b[i].checked = false
					}
				}
			}else{
				for(let i=0; i<st_ch_b.length; i++){
					if(st_ch_b[i].value == "все"){
						st_ch_b[i].checked = false
					}
				}
			}
		}else{
			
		}
		getSortedClientFetch(select_data_checkbox(), get_val_by_data())
	}

	function delAllClient(){
		let cont = document.querySelector('.client_cont')
		cont.innerHTML = ""
	}

	function set_count_client(count){
		document.querySelector('.count_client_id').innerText = count
	}

	async function getSortedClientFetch(ch_box, by_data){
		delAllClient()
		if(ch_box == "[]"){
			set_count_client(0)
			return
		}
		let fd = new FormData()
		fd.append("arr", ch_box)
		fd.append('by_data', by_data)
		let res = await fetch(`api/getSortedClient.php`, {method: 'POST', body: fd})
		// console.log(await res.text())
		let arr = await res.json()
		if(arr.length == 0){
			set_count_client(0)
			return
		}else{
			set_count_client(arr.length)
		}
		insertSortedClient(arr)
	}
	function insertSortedClient(arr){
		let cont = document.querySelector('.client_cont')
		let s = ""
		for(let i=0; i<arr.length; i++){
			s += "<div class='client-row'>"
				s += `<div style='align-self: flex-start;' client_id=${arr[i]['id']} class='block-column cl_block_id'>`
					s += `<span>id:${arr[i]['id']}</span>`
					if(!arr[i]['name']){
						s += `<span></span>`
					}else{
						s += `<span>${arr[i]['name']}</span>`
					}
					s += `<span cl_status='${arr[i]['status']}' >${arr[i]['status']}</span>`
					for(let j=0; j<arr[i]['tel_arr'].length; j++){
						s += `<span tel_id='${arr[i]['tel_arr'][j]['id']}' class='tel_id'>
						<a href=tel:${arr[i]['tel_arr'][j]['val']}>${arr[i]['tel_arr'][j]['val']}</a></span>`
					}
				s += "</div>"

				for(let j=0; j<arr[i]['obj_arr'].length; j++){
					s += `<span obj_id=${arr[i]['obj_arr'][j]['id']} class='obj_id_class block-column'>`
						s += `<span >Объект id:${arr[i]['obj_arr'][j]['id']}</span>`
						s += `<span obj_status='${arr[i]['obj_arr'][j]['status']}'>${arr[i]['obj_arr'][j]['status']}</span>`
						s += `<span>${arr[i]['obj_arr'][j]['description']}</span>`
						s += `<span>${arr[i]['obj_arr'][j]['address']}</span>`
						if(arr[i]['obj_arr'][j]['ref_zamer']){
							let zam = JSON.parse(arr[i]['obj_arr'][j]['ref_zamer'])
							s += "<span style='display: flex; flex-direction: column;'>"
							for(let k =0; k<zam.length; k++){
								s += `<a href='showZamer?idZamer=${zam[k]}'>замер № ${zam[k]}</a>`
							}
							s += "</span>"
						}
					s += "</span>"
				}

				for(let j=0; j<arr[i]['event_arr'].length; j++){
					s += "<span class='block-column'>"
						s += `<span>id:${arr[i]['event_arr'][j]['id']}</span>`
						s += `<span>${arr[i]['event_arr'][j]['type']}:${arr[i]['event_arr'][j]['status']}</span>`
						if(arr[i]['event_arr'][j]['type'] == "ис. звонок"){
							s += `<span><span style='font-weight: bold;'>Результат: </span>${arr[i]['event_arr'][j]['comment']}</span>`
						}
						s += `<span>${arr[i]['event_arr'][j]['start']}</span>`
					s += "</span>"
				}

				for(let j=0; j<arr[i]['sheta_arr'].length; j++){
					s += "<span class='block-column'>"
						s += `<span>Счет id:${arr[i]['sheta_arr'][j]['id']}</span>`
						s += `<span>Дата: ${arr[i]['sheta_arr'][j]['data']}</span>`
						s += `<span>Объект id: ${arr[i]['sheta_arr'][j]['ref_obj']}</span>`
					s += "</span>"
				}

			s += "</div>"
		}
		cont.innerHTML = s

		change_fild.addEventList()	
	}
	
	async function addClient(){

		let inputs = document.querySelectorAll('.addClientWrap input, .addClientWrap textarea')

		let fd = new FormData();

		fd.append('comand', "addClient")

		if(inputs[0].value){
			fd.append('name', inputs[0].value)
		}
		if(inputs[1].value){
			if(inputs[1].value.slice(0,2) != "+7" && inputs[1].value[0] != "8"){
				inputs[1].style.border = "1px solid red"
				return
			}
			fd.append('tel', clearCharTelehon(inputs[1].value))
			inputs[1].style.border = ""
		}else{
			inputs[1].style.border = "1px solid red"
			return
		}
		if(inputs[2].value){
			fd.append('address', inputs[2].value)
		}
		if(inputs[3].value){
			fd.append('typeObj', inputs[3].value)
		}
		if(inputs[4].value){
			fd.append('desc', inputs[4].value)
			inputs[4].style.border = ""
		}else{
			inputs[4].style.border = "1px solid red"
			return
		}
		if(inputs[5].value){
			fd.append('from', inputs[5].value)
		}

		let res = await fetch('handlerCRM.php', {method: 'POST', body: fd})
		let ot = await res.text()
		
		if(ot == "succes"){
			showMsg()
		}else{
			showMsg("r", ot)
		}
	}
	
})