function close_modal_cl_choise(){
	let wr = document.querySelector('.choise_modal_wrapp')
	document.querySelector('.inserts_cart').innerHTML = ""
	wr.style.display = ""
	document.querySelector('.tel_serch_wrapp').style.display = ""
}

window.addEventListener("DOMContentLoaded",()=>{
	let id_settimeout
	document.querySelector('.close_modal_choise').addEventListener("click", close_modal_cl_choise)
	document.querySelector('#serch_tel_choise').addEventListener('input', search_tel_choise_modal)

	let op_cl = document.querySelector('.choise_modal_button_id')
	if(op_cl){
		op_cl.addEventListener('click', open_client_choise)
	}
	let op_shet = document.querySelector('.open_shet_bt_id')
	if(op_shet){
		op_shet.addEventListener('click', open_shet_act)
	}

	async function fetch_client_chose(){
		let loc_var = 'замер'

		if(typeof ch_glob_var !== "undefined"){
			loc_var = ch_glob_var
		}
		let res = await fetch(`api/getChoiseCart.php?metod=${loc_var}`)
		if(res.ok){
			remove_load_indicator()
		}
		res = await res.json()
		insert_client_block(res)
	}

	function search_tel_choise_modal(){
		if(id_settimeout){
			clearTimeout(id_settimeout)
			id_settimeout = setTimeout(()=>{
				fetch_search_tel(this.value)
				insert_load_indicator(document.querySelector('.load_cont'))
			},1000)
			return	
		}
		id_settimeout = setTimeout(()=>{		
			fetch_search_tel(this.value)
			insert_load_indicator(document.querySelector('.load_cont'))
		}, 1000)
	}
	async function fetch_search_tel(num){
		num = clearCharTelehon(num)
		let res = await fetch(`api/searchInBasaTel.php?tel=${num}`)
		if(res.ok){
			remove_load_indicator()
		}
		res = await res.json()
		let insert_bl = document.querySelector('.inserts_cart')
		insert_bl.innerHTML = ""
		console.log(res)
		let out = {"метод": "замер",
					"value": []}
		out.value.push(res)
		console.log(out)
		insert_client_block(out)

	}

	function timeConverter(UNIX_timestamp){
	  var a = new Date(UNIX_timestamp * 1000);
	  var months = ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'];
	  var year = a.getFullYear();
	  var month = months[a.getMonth()];
	  var date = a.getDate();
	  var hour = a.getHours();
	  var min = a.getMinutes();
	  if(min < 10){
	  	min = "0" + min
	  }
	  var sec = a.getSeconds();
	  var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
	  return time;
	}

	function client_Block_Html(item){
		let html = `<div client_id='${item['id']}' class='name_phon_wrapp'>`
			if(!item['name']){
				html += `<span style='font-weight: bold;'>Имя не известно</span>`
			}else{
				html += `<span style='font-weight: bold;'>${item['name']}</span>`
			}
			html += `<div class='tel-cont-day'>`
				for(let j=0; j<item['tel_val'].length; j++){
					html += `<span>${item['tel_val'][j]['val']}</span>`
				}
			html += `</div>`
		html += "</div>"
		return html
	}

	function object_block_Html(item){
		let html = `<div obj_id='${item['id']}' class='obj-cont-modal'>`
			html += `<span style='font-weight: bold;'>${item['type']}</span>`
			html += `<span><span style='font-weight: bold;'>Статус: </span>${item['status']}</span>`
			html += `<span>${item['description']}</span>`
			html += `<span><span style='font-weight: bold;'>Адрес: </span>${item['address']}</span>`
		html += "</div>"
		return html
	}

	function insert_client_block(res){	
		console.log(res)
		let insert_bl = document.querySelector('.inserts_cart')
		let html = ``
		for(let i=0; i<res['value'].length; i++){
			html += `<div class='cartClientMod'>`
			if(res['metod']=='заказать'|| res['metod']== 'монтаж' || res['metod']=='доставка'){
				html += `<div class='zakaz_wrap_id'>`
					html += `<div><span style='font-weight: bold;'>Закупка номер: </span><span id='zakaz_id'>${res['value'][i]['id']}</span></div>`
					html += `<div><span style='font-weight: bold;'>создан: </span>${timeConverter(res['value'][i]['created'])}</div>`
				html += `</div>`
				html += client_Block_Html(res['value'][i]['client'])
				html += object_block_Html(res['value'][i]['client']['obj_val'][0])
			}else{	
				html += client_Block_Html(res['value'][i])
				for(let j=0; j<res['value'][i]['obj_val'].length; j++){
					html += object_block_Html(res['value'][i]['obj_val'][j])
				}
			}
			html += `</div>`
		}
		insert_bl.insertAdjacentHTML('beforeend', html)

		let cart = document.querySelectorAll('.obj-cont-modal')
		for(let i=0; i<cart.length; i++){
			cart[i].addEventListener('click', cart_action_insert)
		}
	}

	function cart_action_insert(){
		let cl = this.parentNode.querySelector('.name_phon_wrapp')
		let zakaz_bl = this.parentNode.querySelector('.zakaz_wrap_id')
		let html = `<div class='cartClientMod'>`
		if(zakaz_bl){
			html += zakaz_bl.outerHTML
		}
		html += cl.outerHTML
		html += this.outerHTML
		html += "</div>"
		document.querySelector(".choised_cart_insert").innerHTML = html
		close_modal_cl_choise()
	}

	async function fetch_shet_chose(){
		let res = await fetch('api/getShetChoise.php')
		res = await res.json()
		remove_load_indicator()
		insert_shet_modal(res)
	}

	function insert_shet_modal(res){
		let html = ``
		for(let i=0; i<res.length; i++){
			html += `<div shet_id=${res[i]['shet']['id']} class='cartClientMod cont_hover'>`
			html += `<div class='zakaz_wrap_id'>`
				html += `<div><span style='font-weight: bold;'>Счет №: </span><span id='zakaz_id'>${res[i]['shet']['id']}</span></div>`
				html += `<div><span style='font-weight: bold;'>создан: </span>${timeConverter(res[i]['shet']['created'])}</div>`
			html += `</div>`
			html += client_Block_Html(res[i]['client'])
			html += object_block_Html(res[i]['object'])
			html += `</div>`
		}
		let insert_bl = document.querySelector('.inserts_cart')
		insert_bl.insertAdjacentHTML('beforeend', html)

		let cart = document.querySelectorAll('.cartClientMod')
		for(let i=0; i<cart.length; i++){
			cart[i].addEventListener('click', shet_click_action)
		}
	}

	function open_shet_act(){
		let wr = document.querySelector('.choise_modal_wrapp')
		wr.style.display = "flex"
		insert_load_indicator(document.querySelector('.load_cont'))
		fetch_shet_chose()
	}

	function open_client_choise() {
		let wr = document.querySelector('.choise_modal_wrapp')
		wr.style.display = "flex"

		if(typeof ch_glob_var !== "undefined"){
			if(ch_glob_var != "монтаж" && ch_glob_var != "заказать" && ch_glob_var != "доставка"){
				document.querySelector('.tel_serch_wrapp').style.display = "block"
			}
		}
		insert_load_indicator(document.querySelector('.load_cont'))
		fetch_client_chose()
	}
	
})
