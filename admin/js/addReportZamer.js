window.addEventListener('DOMContentLoaded',()=>{

	let timest1
	let len_img = 0;
	let cur_img = 0;
	let allData = {
		rooms: []
		// rooms: [{name:"", sq:0, per_all:0, factur:"", per: {beton:0, ceram:0}}]
	}
	let calc_obj = {
		per: 0,
		sq: 0
	}
	addEventList()

	document.querySelector('.calculate_btn_id').addEventListener('click', collectData)
	document.querySelector('.menu_img').addEventListener('click', dopMenuAction)
	document.querySelector('.add_room_id').addEventListener('click', add_room)
	let but_dop = document.querySelectorAll('.inner_block_dop > span')
	for(let i=0; i<but_dop.length; i++){
		but_dop[i].addEventListener('click', add_dop_but_action)
	}

	function add_dop_but_action(){
		let d = {"Люстра": "lustr_id",
				"Споты наши":"spot_nah_id",
				"Споты клиента": "spot_client_id",
				"Обвод тр": "obvod_id",
				"Вент.": "vent_id",
				"Доп. углы": "dop_ugl",
				"Накладная гардина": "gard_nak_id",
				"Разделитель": "razdelitel_id",
				"Скрытая гардина": "shad_gar_id",
				"Световые линии": "svet_line_id",
				"Парящий": "flying_id",
				"Теневой": "shadov_id",
				"Имитация стены": "imatation_wall_id",
				"Дополнительно": "other_prod_id"
				}
		let inst_block = document.querySelector('.focus_room').querySelector('.insert_dopy')
		let html = document.querySelector("."+d[this.innerText])
		inst_block.insertAdjacentHTML("beforeend", html.outerHTML)		
	}

	function add_room(){
		let focus = document.querySelectorAll('.focus_room')
		let html = document.querySelector('.room_id_templat').cloneNode(true)
		html.classList.remove('room_id_templat')
		html.classList.add('room_block')
		html.classList.add('focus_room')
		html = html.outerHTML
		for(let i=0; i<focus.length; i++){
			if(focus[i].classList.contains('room_id_templat')){
				continue
			}
			focus[i].classList.remove('focus_room')
			let ch = focus[i].querySelector('input[name=focus_room_box]')
			ch.checked = false 
		}
		this.insertAdjacentHTML("beforebegin", html)
		addEventList()
	}
	function dopMenuAction(){
		let cont = document.querySelector('.add_dop_panel')
		if(cont.classList.contains('open_dop_menu')){
			cont.classList.remove('open_dop_menu')
		}else{
			cont.classList.add('open_dop_menu')
		}
	}

	function focus_input_change(){
		let blocks = document.querySelectorAll('.focus_room')
		for(let i=0; i<blocks.length; i++){
			if(this.parentNode != blocks[i]){
				blocks[i].classList.remove('focus_room')
				blocks[i].querySelector('input[name=focus_room_box]').checked = false

			}
		}
		if(this.checked){
			this.parentNode.classList.add('focus_room')
		}else{
			this.parentNode.classList.remove('focus_room')
		}
	}

	function addEventList(){
		let dop_el = document.querySelectorAll('.add_dop_elem')
		for(let i=0; i<dop_el.length; i++){
			dop_el[i].addEventListener('click', add_dop)
		}
		let ck_b = document.querySelectorAll('input[name=focus_room_box]')
		for(let i=0; i<ck_b.length; i++){
			ck_b[i].addEventListener('change', focus_input_change)
		}
	}
	function add_dop(){
		this.insertAdjacentHTML("beforebegin", this.previousElementSibling.outerHTML)
		addEventList()
	}
	function collectData(){
		document.querySelector('.calculate_btn_id').remove()
		timest1 = Date.now()
		let room_bl = document.querySelectorAll('.room_block')
		for(let i=0; i<room_bl.length; i++){
			let inp = room_bl[i].querySelector('input[name=foto]')
			if(inp.files.length > 0){
				len_img++
			}
		}

		for(let i=0; i<room_bl.length; i++){
			let a = room_bl[i].querySelector('input[name=A]')
			let obj = {}

			if(a.value != ""){
				let b = room_bl[i].querySelector('input[name=B]')
				if(b.value == ""){
					continue
				}
				let per = (Number(a.value) + Number(b.value))*2
				let sq = Number(a.value) * Number(b.value)
				obj['перим.'] = parseInt(per *100)/100
				obj['площадь'] = parseInt(sq *100)/100
				obj['стена А'] = a.value
				obj['стена Б'] = b.value
			}else{
				if(room_bl[i].querySelector('input[name=length]').value == ""){
					continue
				}
				if(room_bl[i].querySelector('input[name=square]').value == ""){
					continue
				}
				obj['перим.'] = Number(room_bl[i].querySelector('input[name=length]').value)
				obj['площадь'] = Number(room_bl[i].querySelector('input[name=square]').value)
			}

			obj['название комнаты'] = room_bl[i].querySelector('input[name=name_room]').value
			
			let main_factur = document.querySelector('.main_factur')
			if(main_factur.value != "выбрать"){
				obj['полотно'] = main_factur.value
			}else{
				let sec_fac = room_bl[i].querySelector('select[name=factur_room]')
				if(sec_fac.value != "фактура"){
					obj['полотно'] = sec_fac.value
				}else{
					let alt_fac = room_bl[i].querySelector('input[name=alt_factur]')
					obj['полотно'] = alt_fac.value
				}
			}

			let type = room_bl[i].querySelectorAll('.type_wall_id')
			let per_obj = {}
			for(let j=0; j<type.length; j++){
				let s = type[j].querySelector('select')
				let s_val = type[j].querySelector('input')
				if(s_val.value == ""){
					per_obj[s.value] = obj['перим.']
				}else{
					per_obj[s.value] = Number(s_val.value)
				}
			}

			obj['стены'] = per_obj
			obj['помещение'] = room_bl[i].querySelector('input[name=name_room]').value


			let foto = room_bl[i].querySelector('input[name=foto]')
			if(foto.files.length == 1){
				let reader = new FileReader()
				reader.onload = function(e){
					CompressImage(e.target.result, obj)
				}
				reader.readAsDataURL(foto.files[0])
			}
		

			addDict(room_bl[i].querySelectorAll('.lustr_id'), 'select','input', 'люстры', obj)
			
			addDict(room_bl[i].querySelectorAll('.spot_client_id'), 'input[name=diam_client_spot]','input[name=count_client_spot]', 'споты клиента', obj)
			addDict(room_bl[i].querySelectorAll('.obvod_id'), 'input[name=obvod_diam]','input[name=obvod_count]', 'обвод тр', obj)

			getArr(room_bl[i].querySelectorAll('.vent_id'),'input[name=шт]', 'вент', obj)

			let imitation = room_bl[i].querySelector('.imatation_wall_id input')
			if(imitation){
				if(imitation.value != ""){
					obj['имитация стены'] = Number(imitation.value)
				}
			}
			
			let dop_ugl = room_bl[i].querySelector('.dop_ugl input')
			if(dop_ugl){		
				if(dop_ugl.value !=""){
					obj['доп. углы'] = Number(dop_ugl.value)
				}
			}

			let razdelitel = room_bl[i].querySelector('.razdelitel_id input')
			if(razdelitel){		
				if(razdelitel.value !=""){
					obj['разделитель'] = Number(razdelitel.value)
				}
			}

			
			getArr(room_bl[i].querySelectorAll('.spot_nah_id'),"input[name='шт']", 'споты наши', obj)
			
			getArr(room_bl[i].querySelectorAll('.gard_nak_id'),"input[name='м.п']", 'гардина накладная', obj)

			getArr(room_bl[i].querySelectorAll('.shad_gar_id'),"input[name='м.п']", 'гардина скрытая', obj)
			
			getArr(room_bl[i].querySelectorAll('.svet_line_id'), "input[name='м.п']", "световые линии", obj)

			getArr(room_bl[i].querySelectorAll('.flying_id'), "input[name='м.п']",'парящий', obj)

			getArr(room_bl[i].querySelectorAll('.shadov_id'), "input[name='м.п']", "теневой", obj)

			getArr(room_bl[i].querySelectorAll('.other_prod_id'), "input[name='кол.']", "дополнительно", obj)

			allData.rooms.push(obj)
		}
	
		if(len_img == 0){
			console.log('без фото')
			sendZamer()
		}
		console.log(allData)
		console.log("Собраный данные",Date.now() - timest1)

		function getArr(arr, check_key, name_dict, output){
			let a = []
			for(let i=0; i<arr.length; i++){
				let count = arr[i].querySelector(check_key)
				if(count.value != ""){
					let o = {}
					let inp_l = arr[i].querySelectorAll('input, select')
					for(let j=0; j<inp_l.length; j++){
						if(inp_l[j].type == "checkbox"){
							o[inp_l[j].getAttribute('name')] = inp_l[j].checked
							continue
						}
						o[inp_l[j].getAttribute('name')] = inp_l[j].value
					}
					a.push(o)
				}
			}
			if(a.length > 0){
				output[name_dict] = a
			}
	
		}

		function addDict(arr_list, key1,key2, k_all, output){
			let a = {}
			let fl = false
			for(let i =0; i<arr_list.length; i++){
				let k = arr_list[i].querySelector(key1)
				let inp = arr_list[i].querySelector(key2)
				if(inp.value != ""){
					a[k.value] = Number(inp.value)
					fl = true
				}
			}
			if(fl){
				output[k_all] = a
			}
		}
	}

	async function sendZamer(){
		console.log("старт стрингифай",Date.now() - timest1)
		let fd = new FormData()
		fd.append('dict', JSON.stringify(allData))
		let url = new URL(window.location.href)
		let idEvent = url.searchParams.get('idEvent')
		if(idEvent){
			fd.append('idEvent', idEvent)
		}else{
			fd.append('idZamer', url.searchParams.get('idZamer'))
		}

		console.log("финишь стрингифай",Date.now() - timest1)

		let res = await fetch(`postZamer.php`, {
			method: "POST",
			body: fd
		})

		console.log("получен ответ",Date.now() - timest1)	

		checkRespondServer(res)

		if(res.ok){
			setTimeout(()=>{
				window.location.href = './clientCRM'
			},2000)
		}
	}


	function CompressImage(base64, arr){
		let can = document.createElement('canvas')
		let img = document.createElement('img')
		img.onload =  function(){
			let orWidth = img.width
			let orHeight = img.height
			const maxWidth = 1024
			const maxHeight = 768
			if(orWidth > orHeight){
				if(orWidth > maxWidth){
					orHeight = Math.round((orHeight *= maxWidth / orWidth))
					orWidth = maxWidth
				}
			}else{
				if(orHeight > maxHeight){
					orWidth = Math.round((orWidth *= maxHeight / orHeight))
					orHeight = maxHeight
				}
			}
			can.width = orWidth
			can.height = orHeight
			let ctx = can.getContext('2d')
			ctx.drawImage(img, 0, 0, orWidth, orHeight)
			let comData = can.toDataURL('image/jpeg', 0.7)

			arr['фото'] = comData.split(',')[1]

			if(cur_img == len_img -1){
				sendZamer()
			}	
			cur_img++

		}

		img.src = base64
	}
})