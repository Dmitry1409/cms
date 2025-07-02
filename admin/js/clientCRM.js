
let ch_glob_var
window.addEventListener("DOMContentLoaded", ()=>{

	class AddEvent{
		constructor(){
			this.changeSelect = document.querySelector('.inp_wrap_modal select')
			this.changeSelect.addEventListener('change', this.changeSelectModalAction.bind(this))
			this.insClient = document.querySelector('.choised_cart_insert')
			this.choiceBlock = document.querySelector('.inserChoiseBlock')
			this.add_block = document.querySelector('.add_block_modal')
			this.id_set_time
			document.querySelector('.inp_wrap_modal button').addEventListener('click', this.addEventAct.bind(this))

		}
		changeSelectModalAction(e){
			this.changeSelect.style.border =""
			this.clearModalDay()
			switch(this.changeSelect.value){
				case "вх. звонок":
					this.incommingCall()
					break;
				case "другое":
					this.otherEventAct()
					break;
				default:
					ch_glob_var = this.changeSelect.value
			}
		}
		clearModalDay(){
			this.insClient.innerHTML = ""
			this.add_block.innerHTML = ""
		}
		otherEventAct(){
			this.add_block.innerHTML = `<input placeholder="Заголовок" type="text" name="headerevent">
										<textarea placeholder="Описание" ></textarea>`
		}

		incommingCall(){
			let html = `<div class="addClientWrap">
							<input autocomplete="off" placeholder="Имя" type="text" name="clientName">
							<input autocomplete="off" placeholder="Телефон" type="tel" name="telehon">
							<input style="width: 80%;" autocomplete="off" placeholder="Адрес объекта" type="text" name="address">
							<input autocomplete="off" placeholder="Тип объекта" type="text" name="typeObj">
							<textarea style="width: 80%;" autocomplete="off" rows="2" name="desc" placeholder="Описание" name="desc"></textarea>
							<input autocomplete="off" type="text" placeholder="Откуда нас нашел" name="from">
						</div>`
			this.add_block.insertAdjacentHTML('beforeend', html)
			document.querySelector('input[name=telehon]').addEventListener('input', this.chekTel_in_basa.bind(this))
		}
		chekTel_in_basa(){
			if(this.id_set_time){
				clearTimeout(this.id_set_time)
			}
			this.id_set_time = setTimeout(this.chek_tel_in_basa_fetch.bind(this), 1000)
		}
		async chek_tel_in_basa_fetch(){
			let tel = document.querySelector('input[name=telehon]').value
			tel = clearCharTelehon(tel)
			let res = await fetch(`api/searchInBasaTel.php?tel=${tel}`)
			res = await res.json()
			if(res.id){
				showMsg('r', 'Клиент есть в базе')
			}else{
				showMsg('g', 'Клиент не найден')
			}
		}

		client_Block_Html(item){
			let html = `<div client_id='${item['id']}' class='name_phon_wrapp'>`
				if(!item['name']){
					html += `<span style='font-weight: bold;'>Имя не известно</span>`
				}else{
					html += `<span style='font-weight: bold;'>${item['name']}</span>`
				}
				html += `<div class='tel-cont-day'>`
					for(let j=0; j<item['ref_tel'].length; j++){
						html += `<span>${item['ref_tel'][j]}</span>`
					}
				html += `</div>`
			html += "</div>"
			return html
		}

		object_block_Html(item){
			let html = `<div obj_id='${item['id']}' class='obj-cont-modal'>`
				html += `<span style='font-weight: bold;'>${item['type']}</span>`
				html += `<span><span style='font-weight: bold;'>Статус: </span>${item['status']}</span>`
				html += `<span>${item['description']}</span>`
				html += `<span><span style='font-weight: bold;'>Адрес: </span>${item['address']}</span>`
			html += "</div>"
			return html
		}
		isChekedClient(){
			if(this.insClient.innerText == ""){
				return false
			}else{
				return true
			}
		}
		chBlocWarn(){
			this.choiceBlock.style.border = "1px solid red"
		}
		chBlocResetWarn(){
			this.choiceBlock.style.border = ""
		}
		chBlockReset(){
			if(this.isChekedClient()){
				this.choiceBlock.innerHTML = "<div>выбрать:</div>"
			}
		}
		clearCharTelehon(tel){
			let clear = "8";
			let indx = 1
			if(tel.slice(0,2) == "+7"){
				indx = 2
			}
			for(let i=indx; i<tel.length; i++){
				if(tel[i] != " " &&tel[i] >= 0 && tel[i]<= 9){
					clear += tel[i]
				}
			}
			return clear
		}
		async addEventAct(){
			let start = document.querySelector('.inp_wrap_modal input[name=start]')
			let finish = document.querySelector('.inp_wrap_modal input[name=finish]')

			if(!checkDataTimeInput(start.value)){
				start.style.border = "1px solid red"
				return
			}else{
				start.style.border = ""
			}
			if(!checkDataTimeInput(finish.value)){
				finish.style.border = "1px solid red"
				return
			}else{
				finish.style.border = ""
			}

			if(this.changeSelect.value == "тип события"){
				this.changeSelect.style.border = "1px solid red"
				return
			}else{
				this.changeSelect.style.border =""
			}

			if(this.changeSelect.value == "заказать" || this.changeSelect.value == "доставка"||this.changeSelect.value == "замер"
				||this.changeSelect.value == "монтаж"){
				if(!this.isChekedClient()){
					this.chBlocWarn()
					return
				}else{
					this.chBlocResetWarn()
				}
			}

			

			let fd = new FormData()
			fd.append('comand', "addEvent")
			fd.append("start", start.value)
			fd.append('finish', finish.value)
			fd.append('type', this.changeSelect.value)
			let ins_ch_bl = document.querySelector('.choised_cart_insert')
			if(this.changeSelect.value == "заказать" || this.changeSelect.value == "доставка"|| this.changeSelect.value == "монтаж"){
				let zakaz_id = ins_ch_bl.querySelector('#zakaz_id')
				fd.append('zakaz_id', zakaz_id.innerText)
			}
			if(this.changeSelect.value == "замер" || this.changeSelect.value == "монтаж" || this.changeSelect.value == "ис. звонок"){
				let obj_id = ins_ch_bl.querySelector('.obj-cont-modal').getAttribute("obj_id")
				fd.append('obj_id', obj_id)
				let client_id = ins_ch_bl.querySelector('.name_phon_wrapp').getAttribute("client_id")
				fd.append('client_id', client_id)
			}
			if(this.changeSelect.value == "другое"){
				let header = this.add_block.querySelector('input[name=headerevent]')
				let disc = this.add_block.querySelector('textarea')
				if(header.value){
					fd.append("header", header.value)
				}
				if(!disc.value){
					disc.style.border = '1px solid red'
					return
				}else{
					disc.style.border = ""
				}

				fd.append("disc", disc.value)
			}
			if(this.changeSelect.value == "вх. звонок"){
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
					if(tel.value.slice(0,2) != "+7" && tel.value[0] != "8"){
						tel.style.border = "1px solid red"
						return
					}
					fd.append("telehon", this.clearCharTelehon(tel.value))
				}
				let add = document.querySelector('input[name=address]')
				if(add.value !=""){
					fd.append('address', add.value)
				}
				let typeObj = document.querySelector('input[name=typeObj]')
				if(typeObj.value != ""){
					fd.append('typeObj', typeObj.value)
				}
				let desc = document.querySelector('textarea[name=desc]')
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

			insert_load_indicator(this.add_block)
			
			let res = await fetch('handlerCRM.php', {method: 'POST',body: fd});

			if(await checkRespondServer(res)){
				remove_load_indicator()
				setTimeout(()=>{
					location.reload()
				}, 1000)

			}	
		}
	}
	class DayShow{
		constructor(){
			this.modalWrapp = document.querySelector('.dayModalWrapp')
			this.arr_handler_open_block = []
			document.querySelector('.modalDayClose').addEventListener('click', this.closeModalDay.bind(this))

		}
		async decorModalAndFetch(e){
			let click_border = document.querySelector('.click_border')

			if(click_border){
				click_border.classList.remove("click_border")
			}
			
			e.currentTarget.classList.add('click_border')

			let month_par = e.currentTarget.parentNode.parentNode
			let month = month_par.querySelector('h2').innerText
			this.modalWrapp.querySelector("h3").innerText = month + " "+e.currentTarget.innerText
			this.modalWrapp.style.display = "flex"
			setTimeout(()=>{
				this.modalWrapp.style.opacity = 1
			}, 10)

			let start = document.querySelector('.inp_wrap_modal input[name=start]')
			let nm = month_par.getAttribute("numbMonth")
			let year = document.querySelector('.year_btn_action').innerText
			let nd = Number(e.currentTarget.innerText)
			if(nd <= 9){
				nd = "0"+nd
			}
			start.value = nd+"."+nm+"."+year.slice(2,4)+" "
			let finish = document.querySelector('.inp_wrap_modal input[name=finish]')
			finish.value = nd+"."+nm+"."+year.slice(2,4)+" "

			let cont_load_indicator = this.modalWrapp.querySelector('.add_block_modal')

			insert_load_indicator(cont_load_indicator)

			let events = await fetch(`getDayEvents.php?day=${nd}&month=${nm}&year=${year}`)

			if(events.ok){
				events = await events.json()
				remove_load_indicator()
				this.insertEvents(events)
			}else{
				showMsg('r', events.status+" "+events.statusText)
			}
		}

		change_fild_view(e){
			let html = `<input rowid='${e.currentTarget.getAttribute('rowid')}'
			 tabcol='${e.currentTarget.getAttribute('tabcol')}' table='${e.currentTarget.getAttribute("table")}'
			  class='add_input_id' type='text' value='${e.currentTarget.innerText}'>`
			e.currentTarget.parentNode.insertAdjacentHTML("beforeend", html)
			e.currentTarget.remove()
			let add_inps = document.querySelectorAll('.add_input_id')
			for(let i=0; i<add_inps.length; i++){
				console.log(add_inps[i])
				add_inps[i].addEventListener('change', this.change_fild_fetch)
			}
		}
		async change_fild_fetch(e){
			if(confirm(`Изменить поле на ${this.value}`)){
				let fd = new FormData()
				fd.append('comand', "change_fild")
				fd.append('table',this.getAttribute('table'))
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
				fd.append('newval', e.currentTarget.value)
				let res = await fetch('handlerCRM.php', {method: 'POST',body: fd})
				let ot = await res.text()
				console.log(ot)
				if(ot== "succes"){
					showMsg()
				}else{
					showMsg('r', ot)
				}
			}
		}

		client_obj_html(item){
			let tel = ``
			let telAr = item['client']['tel_arr']
			for(let j =0; j<telAr.length; j++){
				tel += `<div>`
				tel += `<div><a href='tel:${telAr[j]}'>${telAr[j]}</a></div>`
				tel += `<a href='${"https://t.me/7"+telAr[j].slice(1)}'>телег</a>`
				tel += `<a href='${"whatsapp://send?phone=7"+telAr[j].slice(1)}'>ватсапп</a>`
				tel += `</div>`
			}
			let html = `<div class="block-flexy">`
				html += `<div>
							<div>Клиент: <span table='clients' tabCol='name' rowID='${item['client']['id']}' class='change_fild_id'>${item['client']['name']}</span></div>
							<div class="evTelWr" style='display: flex;'>Телефоны: ${tel}</div>
						</div>`
				html += `<div>
							<div>Объект: ${item['obj']['type']}</div>
							<div style="font-weight: bold;">
								Адрес: <a href='yandexnavi://map_search?text=${item['obj']['address']}' tabcol='address' rowid='${item['obj']['id']}' table='object' class='change_fild_id'>${item['obj']['address']}</a></div>
						</div>`
				html += `<div>
							<div>Статус: ${item['obj']['status']}</div>
							<div>Описание: <span table='object' tabcol='description' rowid='${item['obj']['id']}' class='change_fild_id'>${item['obj']['description']}</span></div>
						</div>`
			html += `</div>`
			return html
		}

		out_going_call(item){
			let com = "<input type='text'>"

			if(item['comment']){
				com = item['comment']
			}
			let html = "<div>"
				html += `<span style='font-weight: bold;'>Результат звонка:</span><br>`
				html += `<span class='change_fild_id'  table='events' tabcol='comment' rowid='${item['id']}'>${com}</span>`
			html += "</div>"
			console.log(item)
			return html

		}

		zamer_html_put(item){
			let html = ''
			if(item['status'] == "выполнено"){
				html += `<a class="link_event" href='showZamer?idZamer=${item['ref_zamer']}'>показать</a>`
			}else{
				html += `<a class="link_event" href='addReportZamer?idEvent=${item['id']}'>отправить</a>`
			}
			html += this.client_obj_html(item)

			return html
		}
		zakazat_html_put(item){
			let html = `<a href='showZamer?idZamer=${item['ref_zamer']}''>Показать замер № ${item['ref_zamer']}</a>`
			html += this.client_obj_html(item)
			return html
		}
		deliv_html_put(item){
			let html = `<div style='margin-bottom:10px; display: flex; justify-content: space-around;'>
							<span style='width: 40%; font-size: 12px; border: 1px solid grey; display: flex; flex-direction: column;'>
								<div style='font-weight:bold'>Заказ: №${item['ref_zakupki']}</div>`

				if(item['zakupki_status'] == "ожидает отправки"){
					html += `<div style='font-weight:bold'>Статус: ожидает отправки ${item['zakupki_data_send']}</div>`
				}else{
					html += `<div style='font-weight:bold'>Статус: ${item['zakupki_status']}</div>`
				}
				html +=	`</span>
							<a style="max-height: 1em;" href='showZamer?idZamer=${item['ref_zamer']}''>Показать замер № ${item['ref_zamer']}</a>
						</div>`
			html += this.client_obj_html(item)
			return html
		}
		other_html(item){
			return `<div>статус: ${item['status']}</div>
					<div>описание: ${item['comment']}</div>`
		}

		async change_status_fetch(e){
			let event_id = e.currentTarget.parentNode.parentNode.getAttribute('event_id')
			if(confirm(`Изменить статус на: ${e.currentTarget.value}`)){
				let fd = new FormData
				fd.append('comand', "change_fild")
				fd.append('table', "events")
				fd.append('tabcol', "status")
				fd.append('rowid', event_id)
				fd.append('newval', e.currentTarget.value)
				let res = await fetch('handlerCRM.php', {method: 'POST',body: fd})
				let o = await res.text()
				console.log(o)
				if(o == "succes"){
					showMsg()
				}else{
					showMsg('r', o)
				}
			}
		}

		change_status_view(e){
			let wrap_event = e.currentTarget.parentNode.parentNode
			let html = this.get_select_html(wrap_event.getAttribute('type_event'), e.currentTarget.innerText)
			e.currentTarget.outerHTML = html
			wrap_event.querySelector('.select_status_id').addEventListener('change', this.change_status_fetch.bind(this))
		}

		get_select_html(type, status){
			let dict = {
				"замер": ["будет","перенесено","отменен"],
				"монтаж": ["назначен","выполнен","перенесен", "отменен"],
				"вх. звонок": ["было", "обработан"],
				"ис. звонок": ["будет", "отменен","обработан","не дозвониться"],
				"заказать": ["ожидает отправки","отправлен", "отправить", "отменен"],
				"доставка": ["будет","отменен","перенесено", "выполнено"],
				"другое": ["не выполнено", "выполнено", "отменен"]
			}
			let html = ""
			for(let i=0; i<dict[type].length; i++){
				if(dict[type][i]==status){
					html += `<option selected value='${dict[type][i]}'>${dict[type][i]}</option>`
				}else{
					html += `<option value='${dict[type][i]}'>${dict[type][i]}</option>`
				}
			}
			return "<select class='select_status_id'>"+ html +"</select>"
		}

		insertEvents(arr_e){
			let col ={
				"замер": "zam_day",
				"монтаж": "mount_day",
				"вх. звонок": "in_coll_day",
				"заказать": "zakaz_day",
				"доставка": "deliv_day",
				"ис. звонок": "out_col_day"
			}
			let div_par = document.querySelector('.dayModalWrapp > div')
			let html = ""
			for(let i=0; i<arr_e.length; i++){
				html += `<div event_id='${arr_e[i]['id']}' type_event='${arr_e[i]['type']}' class="eventWrappDay hid_event_block ${col[arr_e[i]['type']]}">`
					if(arr_e[i]['type'] == "другое"){
						if(arr_e[i]['header']){
							html += `<div style="text-align: center; font-weight: bold;">${arr_e[i]["header"]}</div>`
						}else{
							html += `<div style="text-align: center; font-weight: bold;">${arr_e[i]['type']}: <span class='change_status_id'>${arr_e[i]['status']}</span></div>`
						}
					}else{
						html += `<div style="text-align: center; font-weight: bold;">${arr_e[i]['type']}: <span class='change_status_id'>${arr_e[i]['status']}</span></div>`
					}
					switch(arr_e[i]['type']){
						case "замер":
							html += this.zamer_html_put(arr_e[i])
							break;
						case "вх. звонок":
							html += this.client_obj_html(arr_e[i])
							break;
						case "доставка":
							html += this.deliv_html_put(arr_e[i])
							break;
						case "заказать":
							html += this.zakazat_html_put(arr_e[i])
							break;
						case "монтаж":
							html += this.deliv_html_put(arr_e[i])
							break;
						case "ис. звонок":
							html += this.client_obj_html(arr_e[i])
							html += this.out_going_call(arr_e[i])
							break;
						case "другое":
							html += this.other_html(arr_e[i])
					}			
					html += `<div class="start_finish">
								<span>Начало: <span tabcol='start' rowid='${arr_e[i]['id']}' table='events' class='change_fild_id'>${arr_e[i]['start']}</span></span>
								<span>Конец: <span tabcol='finish' rowid='${arr_e[i]['id']}' table='events' class='change_fild_id'>${arr_e[i]['finish']}</span></span>
							</div>`

				html += "</div>"
			}

			if(html){
				html = "<div class='cont_eventDay'>"+html+"</div>"
				div_par.insertAdjacentHTML('beforeend', html)
				let ev_block = document.querySelectorAll('.eventWrappDay')
				for(let i=0; i<ev_block.length; i++){
					let ev = this.open_event_block.bind(this)
					this.arr_handler_open_block.push(ev)
					ev_block[i].addEventListener('click', ev)
				}
				let status = document.querySelectorAll('.change_status_id')
				for(let i=0; i<status.length; i++){
					status[i].addEventListener('click', this.change_status_view.bind(this))
				}
				let add_inp = document.querySelectorAll('.change_fild_id')
				for(let i =0; i<add_inp.length; i++){
					add_inp[i].addEventListener('click', this.change_fild_view.bind(this))
				}

			}
		}

		close_event_block(e){
			e.stopPropagation()
			e.currentTarget.parentNode.style.height = ""
			let f = this.open_event_block.bind(this)
			e.currentTarget.parentNode.addEventListener('click', f)
			this.arr_handler_open_block.push(f)
			e.currentTarget.remove()
		}

		open_event_block(e){
			let svg = `<div class='close_event_block' ><svg class='svg_up_event_block'  version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						  viewBox="0 0 284.929 284.929" 
						 xml:space="preserve">
							<g>
								<path d="M282.082,76.511l-14.274-14.273c-1.902-1.906-4.093-2.856-6.57-2.856c-2.471,0-4.661,0.95-6.563,2.856L142.466,174.441
									L30.262,62.241c-1.903-1.906-4.093-2.856-6.567-2.856c-2.475,0-4.665,0.95-6.567,2.856L2.856,76.515C0.95,78.417,0,80.607,0,83.082
									c0,2.473,0.953,4.663,2.856,6.565l133.043,133.046c1.902,1.903,4.093,2.854,6.567,2.854s4.661-0.951,6.562-2.854L282.082,89.647
									c1.902-1.903,2.847-4.093,2.847-6.565C284.929,80.607,283.984,78.417,282.082,76.511z"/>
							</g>
						</svg></div>`
			e.currentTarget.insertAdjacentHTML('beforeend', svg)
			for(let i=0; i<this.arr_handler_open_block.length; i++){
				e.currentTarget.removeEventListener("click",this.arr_handler_open_block[i])
			}

			e.currentTarget.style.height = e.currentTarget.scrollHeight + "px"

			e.currentTarget.querySelector('.close_event_block').addEventListener('click', this.close_event_block.bind(this))
		}

		closeModalDay(){
			this.modalWrapp.style.opacity = ""
			this.modalWrapp.querySelector('.inp_wrap_modal select').value = "тип события"
			setTimeout(()=>{
				this.modalWrapp.style.display = ""
				let cont = document.querySelector('.cont_eventDay')
				if(cont){
					cont.remove()
				}
				document.querySelector('.choised_cart_insert').innerHTML = ""
				
				add_event.chBlockReset()
				add_event.add_block.innerHTML = ""

			}, 500)
		}
	}
	
	class CalendarChange{
		constructor(){
			let d = document.querySelectorAll(".year_btn")
			for(let i=0; i<d.length; i++){
				d[i].addEventListener('click', this.year_btn_action.bind(this))
			}
		}
		isLiap(year){
			return ((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0)
		}
		async year_btn_action(e){
			document.querySelector('.year_btn_action').classList.remove('year_btn_action')
			e.currentTarget.classList.add('year_btn_action')
			let wrap_m = document.querySelector('.wrapp_m')
			wrap_m.innerHTML = ""
			insert_load_indicator(document.querySelector('.year_cont'))
			let res = await fetch(`api/changeCalendar.php?year=${e.currentTarget.innerText}`)
			res = await res.json()
			remove_load_indicator()
			this.create_calendar(res)
		}
		create_calendar(res){
			let cur_year = parseInt(document.querySelector('.year_btn_action').innerText)
			let fev = 28
			if(this.isLiap(cur_year)){
				fev = 29
			}
			let months = [["Январь",31, "01"],["Февраль",fev, "02"],["Март",31, "03"],["Апрель",30, "04"],
							["Май",31, "05"],["Июнь",30,"06"],["Июль",31,"07"],["Август",31,"08"],["Сентябрь",30,"09"],
							["Октябрь",31,"10"],["Ноябрь",30, "11"],["Декабрь",31,"12"]]
			
			let num_empty_day
			let cal_data = `${cur_year}.01.01`
			let d = new Date(cal_data)
			d = d.getDay()
			if(d==0){
				num_empty_day = 6
			}else{
				num_empty_day = d -1
			}

			let cSm = Math.ceil((new Date(cal_data).getTime()/1000) / 86400)%4

			let real_toDay = new Date().toISOString().replace('T', ' ').slice(0, 10)
			let html = ""
			for(let i=0; i<months.length; i++){
				html += `<div numbMonth='${months[i][2]}' class='month'>`
					html += `<h2>${months[i][0]}</h2>`
					for(let j=1; j<=months[i][1]; j++){
						if(j==1){
							html += "<div class='week'>"
							for(let k=0; k<num_empty_day; k++){
								html += "<div></div>"
							}
						}

						let day_with_zero 
						if(j< 10){
							day_with_zero = "0"+ String(j) 
						}

						let cur_day = `${cur_year}-${months[i][2]}-${day_with_zero}`

						let todayCl = null

						if(cur_day == real_toDay){
							todayCl = "today"
						}

						let smClass = null
						if(cSm==4){
							smClass = "sm2"
							cSm = 1
						}else if(cSm == 3){
							smClass = "sm1"
							cSm ++
						}else{
							smClass = "sm2"
							cSm ++
						}

						let ev_html = null
						let fl_e = false
						for(let e=0; e<res.length; e++){
							let start = res[e]['start']
							let finish = res[e]['finish']
							let e_m = start.slice(3,5)
							if(months[i][2] == e_m){	
								let e_d_s = Number(start.slice(0, 2))
								let e_d_f = Number(finish.slice(0,2))
								if(e_d_s<=j && j <= e_d_f){
									let n_col = null
									if(res[e]['type']=="замер"){
										n_col = "zam_col"
									}
									if(res[e]['type']=="монтаж"){
										n_col = "mount_col"
									}
									if(res[e]['type']=="вх. звонок"){
										n_col = "in_colling_col"
									}
									if(res[e]['type']=="заказать"){
										n_col = "zakazat_col"
									}
									if(res[e]['type']=="доставка"){
										n_col = "deliv_col"
									}
									if(res[e]['type']=="ис. звонок"){
										n_col = "out_coling_col"
									}
									if(res[e]['type']=="другое"){
										n_col = "other_col"
									}

									if(fl_e){
										ev_html += `<div class='n-point ${n_col}'></div>`
									}else{
										ev_html = `<div class='n_point_wrapp'><div class='n-point ${n_col}'></div>`
										fl_e = true
									}
								}
							}
						}

						if(fl_e){
							ev_html += "</div>"
						}

						if(ev_html){
							html += `<div class='no-empty ${smClass} ${todayCl}'>${j}${ev_html}</div>`
						}else{
							html += `<div class='no-empty ${smClass} ${todayCl}'>${j}</div>`
						}


						if((j+num_empty_day)%7 == 0){
							html += "</div>"
							html += "<div class='week'>"
						}

						if(j == months[i][1]){
							let a = months[i][1] - (7 - num_empty_day)
							let r = Math.floor(a/7)
							r = 7 - (a - (r*7))
							if(r >0){
								for(let k =0; k<r; k++){
									html += "<div></div>"
								}
							}
							num_empty_day = 7 - r
							html += "</div>"
						}
					}

					html += "</div>"
				html += "</div>"
			}
			let wrapp_m = document.querySelector('.wrapp_m')
			wrapp_m.insertAdjacentHTML("afterbegin", html)

			let day = document.querySelectorAll(".week > div.no-empty")
			for(let i=0; i<day.length; i++){
				day[i].addEventListener('click', day_show.decorModalAndFetch.bind(day_show))
			}

			scrollCalendar()
		}

	}
	scrollCalendar()

 	let add_event = new AddEvent()

 	let day_show = new DayShow()

 	let chan_calen = new CalendarChange()

	let d = document.querySelectorAll(".week > div.no-empty")
	for(let i=0; i<d.length; i++){
		d[i].addEventListener('click', day_show.decorModalAndFetch.bind(day_show))
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

	

	function scrollCalendar(){
		let cont = document.querySelector('.monthCont')
		let today = document.querySelector('.today')
		if(!today){
			return
		}
		let todayMonth = today.parentNode.parentNode
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