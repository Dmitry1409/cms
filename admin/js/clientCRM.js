window.addEventListener("DOMContentLoaded", ()=>{
	class EventCalendar{
		constructor(){
			this.interElem = null
			this.movProxy = null
			this.leaveProxy = null
			this.collActDiv = []
			this.clockModAbsol = document.querySelector('.clock_modal_absol')
			this.clock_div = document.querySelectorAll(".clock_modal_absol > div")
			for(let i=0; i<this.clock_div.length; i++){
				this.clock_div[i].addEventListener('pointerdown', this.downClockDiv.bind(this))
				this.clock_div[i].addEventListener('pointerup', this.upClockDiv.bind(this))
			}
			this.html = `<div class='insertDivClock'>
							<textarea placeholder="Описание события" rows="2" cols="25"></textarea>
							<select>
								<option value="замер">Замер</option>
								<option value="монтаж">Монтаж</option>
								<option value="звонок">Звонок</option>
								<option value="доставка">Доставка</option>
								<option value="другое">Другое</option>
							</select>
							<div class='dopSelectEvent'></div>
							<svg class="svg_close_event" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
								<defs>
									<style>.cls-1{fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style>
								</defs>
								<title/>
								<g id="cross"><line class="cls-1" x1="7" x2="25" y1="7" y2="25"/><line class="cls-1" x1="7" x2="25" y1="25" y2="7"/>
								</g>
							</svg>			
						</div>`
		}

		async getInsertInDopBlock(){
			let typeEv = document.querySelector('.insertDivClock select')
			let res = await fetch(`getDataForEvent.php?eventType=${typeEv.value}`)
			console.log(await res.text())
		}

		insertHTML(inElem){
			if(this.interElem){
				this.interElem.insertAdjacentHTML("beforeend", this.html)
				this.interElem = null
				this.addHandlers()
			}
			this.getInsertInDopBlock()
		}
		addHandlers(){
			document.querySelector('.svg_close_event').addEventListener('click', this.eventDel.bind(this))
		}
		eventDel(e){
			for(let i=0;i<this.collActDiv.length; i++){
				this.collActDiv[i].classList.remove("clock_action")
				let ch = this.collActDiv[i].children
				if(ch.length > 0){
					for(let j=0; j<ch.length; j++){
						ch[j].remove()
					}
				}
			}
		}

		getBoundRectDiv(){
			this.divBoundRect = []
			for(let i=0; i<this.clock_div.length; i++){
				let a = []
				a.push(this.clock_div[i])
				a.push(this.clock_div[i].getBoundingClientRect())
				this.divBoundRect.push(a)
			}
		}

		pointerMoveClock(e){
			for(let i=0; i<this.divBoundRect.length; i++){
				if(e.y > this.divBoundRect[i][1].top && e.y < this.divBoundRect[i][1].bottom ){
					if(!this.divBoundRect[i][0].classList.contains("clock_action")){
						this.divBoundRect[i][0].classList.add('clock_action')
						this.collActDiv.push(this.divBoundRect[i][0])
					}
				}
			}
		}

		downClockDiv(e){
			if(!e.currentTarget.classList.contains('clock_action')){
				this.collActDiv.push(e.currentTarget)
				this.movProxy = this.pointerMoveClock.bind(this)
				this.clockModAbsol.addEventListener('pointermove', this.movProxy)
				this.leaveProxy = this.leaveOut.bind(this)
				this.clockModAbsol.addEventListener('pointerleave', this.leaveProxy)		
				this.interElem = e.currentTarget
				e.currentTarget.classList.add("clock_action")
			}
		}

		upClockDiv(e){
			if(this.interElem){
				this.insertHTML()
				this.clockModAbsol.removeEventListener('pointermove', this.movProxy)
				this.clockModAbsol.removeEventListener("pointerleave", this.leaveProxy)
				// document.querySelector('.svg_close_event').addEventListener("click", delEventAction)
			}		
		}
		leaveOut(e){
			this.clockModAbsol.removeEventListener("pointerleave", this.leaveProxy)
			this.clockModAbsol.removeEventListener('pointermove', this.movProxy)
			this.insertHTML()
			
		}
	}


	scrollCalendar()

	document.querySelector('.inp_wrap_modal button').addEventListener('click', addEventAct)



	let d = document.querySelectorAll(".week > div")
	for(let i=0; i<d.length; i++){
		d[i].addEventListener('click', dayShow)
	}
	// let event = new EventCalendar()


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
		console.log(arr_e)
		let div_par = document.querySelector('.dayModalWrapp > div')
		let html = ""
		for(let i=0; i<arr_e.length; i++){
			html += `<div class="eventWrappDay">`
				html += `<div style="text-align: center; font-weight: bold;">${arr_e[i]['type']}</div>`		
				let tel = ``
				let telAr = arr_e[i]['client']['tel_arr']
				for(let j =0; j<telAr.length; j++){
					tel += `<a href='tel:${telAr[j]}'>${telAr[j]}</a>`
				}
				html += `<div class="block-flexy">`
					html += `<div>
								<div>Клиент: ${arr_e[i]['client']['name']}</div>
								<div class="evTelWr">Телефоны: ${tel}</div>
							</div>`
					html += `<div>
								<div>Объект: ${arr_e[i]['obj']['type']}</div>
								<div style="font-weight: bold;">Адрес: ${arr_e[i]['obj']['address']}</div>
							</div>`
					html += `<div>
								<div>Статус: ${arr_e[i]['obj']['status']}</div>
								<div>Описание: ${arr_e[i]['obj']['description']}</div>
							</div>`
				html += `</div>`
				if(arr_e[i]['start'].length > 9){
					html += `<div class="start_finish"><span>Начало: ${arr_e[i]['start'].slice(9)}</span>
									<span>Конец: ${arr_e[i]['finish'].slice(9)}</span>
							</div>`
				}
			html += "</div>"
		}

		if(html){
			html = "<div class='cont_eventDay'>"+html+"</div>"
			div_par.insertAdjacentHTML('beforeend', html)
		}

	}

	async function zamerModalAct(){
		let insClient = document.querySelector('.insertClients')
		let res = await fetch(`getNewClients.php`)
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

	function checkDataTimeInput(str){
		if(str.length>9){
			let sp = str.split(' ')
			if(!/\d\d\.\d\d\.\d\d$/.test(sp[0])){
				return false
			}
			console.log(sp[1])
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

		let where = document.querySelector('.inserChoiseBlock > div:first-child')
		
		if(where.innerText == "выбрать:"){
			where.style.border = "1px solid red"
			return
		}

		fd = new FormData()
		fd.append('comand', "addEvent")
		fd.append("start", start.value)
		fd.append('finish', finish.value)
		fd.append('type', select.value)
		if(select.value == "замер"){
			let obj_id = document.querySelector('.inserChoiseBlock').querySelector('.obj-cont-modal').getAttribute("obj_id")
			fd.append('obj_id', obj_id)
			let client_id = document.querySelector('.inserChoiseBlock').querySelector('.name_phon_wrapp').getAttribute("client_id")
			fd.append('client_id', client_id)
		}

		let res = await fetch('handlerCRM.php', {method: 'POST',body: fd});

		if(res.ok){
			let o = await res.text()
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
		// console.log(this.parentNode.querySelector("div:first-child"))
		// ch_bl.append(this)
		document.querySelector('.insertClients').remove()
	}
	function changeSelectModalAction(){
		switch(this.value){
			case "замер":
				zamerModalAct();
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