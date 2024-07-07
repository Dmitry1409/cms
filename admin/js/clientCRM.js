window.addEventListener("DOMContentLoaded", ()=>{
	
	scrollCalendar()

	document.querySelector('.inp_wrap_modal button').addEventListener('click', addEventAct)



	let d = document.querySelectorAll(".week > div")
	for(let i=0; i<d.length; i++){
		d[i].addEventListener('click', dayShow)
	}



	document.querySelector('.modalDayClose').addEventListener('click', closeModalDay)
	

	function closeModalDay(){
		let modal = document.querySelector('.dayModalWrapp')
		modal.style.opacity = ""
		setTimeout(()=>{
			modal.style.display = ""
			let cont = document.querySelector('.cont_eventDay')
			if(cont){
				cont.remove()
			}
		}, 500)
	}

	async function dayShow(){
		let month_par = this.parentNode.parentNode
		month = month_par.querySelector('h2').innerText
		let modal = document.querySelector('.dayModalWrapp')
		modal.querySelector("h3").innerText = month + " "+this.innerText
		modal.style.display = "flex"
		document.querySelector('.inp_wrap_modal select').addEventListener('change', changeSelectModalAction)
		setTimeout(()=>{
			modal.style.opacity = 1
		}, 10)
		let start = document.querySelector('.inp_wrap_modal input[name=start]')
		let nm = month_par.getAttribute("numbMonth")
		let d = new Date()
		d = d.getFullYear()%100
		let nd = Number(this.innerText)
		if(nd <= 9){
			nd = "0"+nd
		}
		start.value = nd+"."+nm+"."+d+" "
		let finish = document.querySelector('.inp_wrap_modal input[name=finish]')
		finish.value = nd+"."+nm+"."+d+" "
		let events = await fetch(`getDayEvents.php?day=${nd}&month=${nm}`)

		if(events.ok){
			events = await events.json()
			insertEvents(events)
		}else{
			showMsg('r', events.status+" "+events.statusText)
		}
	}

	function insertEvents(arr_e){
		let div_par = document.querySelector('.dayModalWrapp > div')
		let html = ""
		for(let i=0; i<arr_e.length; i++){
			html += `<div class="eventWrappDay">`
				html += `<div style="text-align: center; font-weight: bold;">${arr_e[i]['type']}: ${arr_e[i]['status']}</div>`		
				let tel = ``
				let telAr = arr_e[i]['client']['tel_arr']
				for(let j =0; j<telAr.length; j++){
					tel += `<a href='tel:${telAr[j]}'>${telAr[j]}</a>`
				}
				html += `<div class="block-flexy">`
					html += `<div>
								<div>Клиент: <span table='clients' tabCol='name' rowID='${arr_e[i]['client']['id']}' class='change_fild_id'>${arr_e[i]['client']['name']}</span></div>
								<div class="evTelWr">Телефоны: ${tel}</div>
							</div>`
					html += `<div>
								<div>Объект: ${arr_e[i]['obj']['type']}</div>
								<div style="font-weight: bold;">Адрес: <span tabcol='address' rowid='${arr_e[i]['obj']['id']}' table='object' class='change_fild_id'>${arr_e[i]['obj']['address']}</span></div>
							</div>`
					html += `<div>
								<div>Статус: ${arr_e[i]['obj']['status']}</div>
								<div>Описание: <span table='object' tabcol='description' rowid='${arr_e[i]['obj']['id']}' class='change_fild_id'>${arr_e[i]['obj']['description']}</span></div>
							</div>`
					if(arr_e[i]['type'] == "замер"){
						if(arr_e[i]['status'] == "выполнено"){
							html += `<a class="link_event" href='showZamer?idZamer=${arr_e[i]['ref_zamer']}'>показать</a>`
						}else{
							html += `<a class="link_event" href='addReportZamer?idEvent=${arr_e[i]['id']}'>отправить</a>`
						}
					}
				html += `</div>`
				html += `<div class="start_finish"><span>Начало: <span tabcol='start' rowid='${arr_e[i]['id']}' table='events' class='change_fild_id'>${arr_e[i]['start']}</span></span>
								<span>Конец: <span tabcol='finish' rowid='${arr_e[i]['id']}' table='events' class='change_fild_id'>${arr_e[i]['finish']}</span></span>
						</div>`
			html += "</div>"
		}

		if(html){
			html = "<div class='cont_eventDay'>"+html+"</div>"
			div_par.insertAdjacentHTML('beforeend', html)
			let add_inp = document.querySelectorAll('.change_fild_id')
			for(let i =0; i<add_inp.length; i++){
				add_inp[i].addEventListener('click', change_fild_view)
			}

		}

	}

	function change_fild_view(){
		let html = `<input rowid='${this.getAttribute('rowid')}'
		 tabcol='${this.getAttribute('tabcol')}' table='${this.getAttribute("table")}'
		  class='add_input_id' type='text' value='${this.innerText}'>`
		this.parentNode.insertAdjacentHTML("beforeend", html)
		this.remove()
		let add_inps = document.querySelectorAll('.add_input_id')
		for(let i=0; i<add_inps.length; i++){
			add_inps[i].addEventListener('change', change_fild_fetch)
		}

	}
	async function change_fild_fetch(){
		if(confirm(`Изменить поле на ${this.value}`)){
			let fd = new FormData()
			fd.append('comand', "change_fild")
			fd.append('table', this.getAttribute('table'))
			fd.append('rowid', this.getAttribute('rowid'))
			let tabcol = this.getAttribute('tabcol')
			fd.append('tabcol', tabcol)
			if(tabcol =="finish" || tabcol == "start"){
				if(!checkDataTimeInput(this.value)){
					this.style.border = "1px solid red"
					return
				}else{
					this.style.border = ""
				}
			}
			fd.append('newval', this.value)
			let res = await fetch('handlerCRM.php', {method: 'POST',body: fd})
			let o = await res.text()
			if(o == "succes"){
				showMsg()
			}else{
				showMsg('r', o)
			}
		}
	}

	async function zamerModalAct(){
		let insClient = document.querySelector('.insertClients')
		let res = await fetch(`getNewClients.php`)
		// console.log(await res.json())
		res = await res.json()
		html = ``
		for(let i=0; i<res.length; i++){
			html += `<div class='cartClientMod'>`
			html += `<div client_id='${res[i]['id']}' class='name_phon_wrapp'>`
			if(!res[i]['name']){
				html += `<span style='font-weight: bold;'>Имя не известно</span>`
			}else{
				html += `<span style='font-weight: bold;'>${res[i]['name']}</span>`
			}
				html += `<div class='tel-cont-day'>`
				for(let j=0; j<res[i]['ref_tel'].length; j++){
					html += `<span>${res[i]['ref_tel'][j]}</span>`
				}
				html += `</div>`
			html += "</div>"		
				for(let j=0; j<res[i]['ref_obj'].length; j++){
					html += `<div obj_id='${res[i]['ref_obj'][j]['id']}' class='obj-cont-modal'>`
						html += `<span style='font-weight: bold;'>${res[i]['ref_obj'][j]['type']}</span>`
						html += `<span><span style='font-weight: bold;'>Статус: </span>${res[i]['ref_obj'][j]['status']}</span>`
						html += `<span>${res[i]['ref_obj'][j]['description']}</span>`
						html += `<span><span style='font-weight: bold;'>Адрес: </span>${res[i]['ref_obj'][j]['address']}</span>`
					html += `</div>`
				}			
			html +="</div>"
		}
		insClient.insertAdjacentHTML('beforeend', html)

		let cart = document.querySelectorAll('.obj-cont-modal')
		for(let i=0; i<cart.length; i++){
			cart[i].addEventListener('click', cartClientAct)
		}
				
	}
	function incommingCall(){
		let html = `<div class="addClientWrap">
						<input placeholder="Имя" type="text" name="clientName">
						<input placeholder="Телефон" type="number" name="telehon">
						<input placeholder="Адрес объекта" type="text" name="address">
						<input placeholder="Тип объекта" type="text" name="typeObj">
						<input name="desc" placeholder="Описание" name="desc">
						<input type="text" placeholder="Откуда нас нашел" name="from">
					</div>`
		let add_block = document.querySelector('.add_block_modal')
		add_block.insertAdjacentHTML('beforeend', html)
	}


	function checkDataTimeInput(str){
		if(str.length>9){
			let sp = str.split(' ')
			if(!/\d\d\.\d\d\.\d\d$/.test(sp[0])){
				return false
			}
			if(!/\d\d:\d\d$/.test(sp[1])){
				return false
			}
			return true
		}else{
			return /\d\d\.\d\d\.\d\d$/.test(str.trim())
		}
	}

	async function addEventAct(){
		let start = document.querySelector('.inp_wrap_modal input[name=start]')
		let finish = document.querySelector('.inp_wrap_modal input[name=finish]')

		if(!checkDataTimeInput(start.value)){
			start.style.border = "1px solid red"
			return
		}else{
			start.style.border = ""
		}
		if(!checkDataTimeInput(finish.value)){
			start.style.border = "1px solid red"
			return
		}else{
			start.style.border = ""
		}

		let select = document.querySelector('.inp_wrap_modal select')
		if(select.value == "-"){
			select.style.border = "1px solid red"
			return
		}

		fd = new FormData()
		fd.append('comand', "addEvent")
		fd.append("start", start.value)
		fd.append('finish', finish.value)
		fd.append('type', select.value)
		if(select.value == "замер"){
			let where = document.querySelector('.inserChoiseBlock > div:first-child')
			if(where.innerText == "выбрать:"){
				where.style.border = "1px solid red"
				return
			}
			let obj_id = document.querySelector('.inserChoiseBlock').querySelector('.obj-cont-modal').getAttribute("obj_id")
			fd.append('obj_id', obj_id)
			let client_id = document.querySelector('.inserChoiseBlock').querySelector('.name_phon_wrapp').getAttribute("client_id")
			fd.append('client_id', client_id)
		}
		if(select.value == "вх. звонок"){
			let clName = document.querySelector('input[name=clientName]')
			if(clName.value != ""){
				fd.append("name", clName.value)
			}
			let tel = document.querySelector('input[name=telehon]')
			if(tel.value == ""){
				tel.style.border = "1px solid red"
				return
			}else{
				tel.style.border = ""
				fd.append("telehon", tel.value)
			}
			let add = document.querySelector('input[name=address]')
			if(add.value !=""){
				fd.append('address', add.value)
			}
			let typeObj = document.querySelector('input[name=typeObj]')
			if(typeObj.value != ""){
				fd.append('typeObj', typeObj.value)
			}
			let desc = document.querySelector('input[name=desc]')
			if(desc.value == ""){
				desc.style.border = "1px solid red"
				return
			}else{
				desc.style.border = ""
				fd.append('desc', desc.value)
			}
			let from = document.querySelector('input[name=from]')
			if(from.value !=""){
				fd.append('from', from.value)
			}
		}
		
		let res = await fetch('handlerCRM.php', {method: 'POST',body: fd});

		if(res.ok){
			let o = await res.text()
			console.log(o)
			if(o == "succes"){
				showMsg()
				setTimeout(()=>{
					location.reload()
				}, 1000)
			}else{
				showMsg('r', o)
			}
		}else{
			console.log(res)
			showMsg('r', `Проблемы с запросом. Статус: ${res.status}`)
		}	
	}

	function cartClientAct(){
	
		let ch_bl = document.querySelector('.inserChoiseBlock')
		let ch_child = ch_bl.children
		for(let i=0; i<ch_child.length; i++){
			ch_child[i].remove()
		}
		let html = this.parentNode.querySelector("div:first-child").outerHTML
		html += this.outerHTML
		ch_bl.insertAdjacentHTML('beforeend', html)
		document.querySelector('.insertClients').remove()
	}
	function changeSelectModalAction(){
		switch(this.value){
			case "замер":
				zamerModalAct();
				break;
			case "вх. звонок":
				incommingCall()
				break;
		}
	}


	function scrollCalendar(){
		let cont = document.querySelector('.monthCont')
		let todayMonth = document.querySelector('.today').parentNode.parentNode
		let allMonth = document.querySelectorAll('.month')
		let mindex
		for(let i=0; i<allMonth.length; i++){
			if(allMonth[i] === todayMonth){
				mindex = i
			}
		}
		let clientWidth = window.innerWidth
		let offset = 0
		if(clientWidth < 800){
			offset = (clientWidth * mindex) - 60
		}else{
			let r = Math.floor(clientWidth / 3)
			offset = ((mindex - 1) * r) - 40
		}
		todayMonth.scrollIntoView({inline: "center"})
	}

})