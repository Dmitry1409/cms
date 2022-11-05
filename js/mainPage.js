
window.addEventListener('load', ()=>{
	if(location.hash){
			let hash  = location.hash.split('_')[0]
			let d = document.querySelector(hash)
			location.hash = ""
			d.scrollIntoView({
				behavior: "smooth",
				block: 'start'
			})
		}
})

window.addEventListener('DOMContentLoaded',()=>{
	

	document.querySelector('.aferta_btn').addEventListener('click', aferta_btn_action)
	document.querySelector('.calcul_body div.calc_btn').addEventListener('click', calculate_action)


	

	let tech_elem = document.querySelectorAll('.tech_elem')
	for(let i = 0; i < tech_elem.length; i++){
		tech_elem[i].addEventListener('mouseover', tech_elem_over_action)
		tech_elem[i].addEventListener('mouseout', tech_elem_out_action)
	}


	let time_feedback = Date.now()
	document.querySelector('.feed_left').addEventListener('click', feed_left_action)
	document.querySelector('.feed_right').addEventListener('click', feed_right_action)

	let sortFeedBackBtns = document.querySelectorAll('.feedBackSortCont > div')
	for(let i=0; i<sortFeedBackBtns.length; i++){
		sortFeedBackBtns[i].addEventListener('click', sortFeedBackAction)
	}

	document.querySelector('.add_feedback_section .calc_btn').addEventListener('click', add_feedback_action)

	let scope_svg = document.querySelectorAll('.add_feedback_section svg')
	for(let i = 0; i<scope_svg.length; i++){
		scope_svg[i].addEventListener('click', feedback_scope_view_action)
	}

	let imgs_feedback = document.querySelectorAll('.feed4countWrapp img')
	for(let i=0; i<imgs_feedback.length; i++){
		imgs_feedback[i].addEventListener('click', feedbackImgsShow)
	}


	let fotoGalObj = {
						imgs: "",
						curIndex: ""
	}


	let feedBackObj = {
		sortFlag : false,
		remainsComents: [],
		allComents : [],
		sortArr: [],
		statusClicks: {
			"С фото": {'status':"disable","n_comand": 0},
			"Дата:": {'status': "disable", "n_comand": 0},
			"Оценка:": {'status': 'disable', "n_comand": 0}
		}
	}

	
	document.querySelector('.add_feedback_btn_open_cont > div').addEventListener('click', add_feedback_open)
	

	function add_feedback_open(){
		let sect = document.querySelector('.dopWrapFeedback')
		console.log(sect.scrollHeight)
		sect.style.height = sect.scrollHeight + "px"
		this.remove()
	}

	async function sortFeedBackAction(){
		let clickBtn = {}
		let thisSpan = this.querySelector('span')
		clickBtn.name = thisSpan.innerText
		if(clickBtn.name == "С фото"){
			if(this.classList.contains('feedSortFotoActiv')){
				this.classList.remove('feedSortFotoActiv')
				clickBtn.status = "disable"
			}else{
				this.classList.add('feedSortFotoActiv')
				clickBtn.status = "activ"
			}
		}else{
			let clickSvg = this.querySelector('svg')
			if(clickSvg.classList.contains('svg_sort_rotate_down')){
				clickSvg.classList = "svg_sortdata_feedBack svg_sort_rotate_up"
				clickBtn.status = "up"
			}else if(clickSvg.classList.contains('svg_sort_rotate_up')){
				clickSvg.classList = "svg_sortdata_feedBack"
				clickBtn.status = "disable"
			}else{
				clickSvg.classList  = "svg_sortdata_feedBack svg_sort_rotate_down"
				clickBtn.status = "down"
			}
		}

		feedBackObj.statusClicks[clickBtn.name]['status'] = clickBtn.status
		feedBackObj.statusClicks[clickBtn.name]['n_comand'] = 0

		let keys = ["С фото", "Дата:", "Оценка:"]

		let reqArr = []

		for(let i=0; i<keys.length; i++){
			if(keys[i]!= clickBtn.name){
				feedBackObj.statusClicks[keys[i]]['n_comand'] += 1
			}
			let status = feedBackObj.statusClicks[keys[i]]['status']
			let n_comand = feedBackObj.statusClicks[keys[i]]['n_comand']
			if(feedBackObj.statusClicks[keys[i]]['status'] != "disable"){
				reqArr.push([keys[i], status, n_comand])
			}
		}

		let result = []
		while(reqArr.length > 0){
			let ind 
			for(let i =0; i<reqArr.length; i++){
				let fl = true
				for(let j=0; j<reqArr.length; j++){
					if(reqArr[i][0] == reqArr[j][0]) continue
					if(reqArr[i][2] > reqArr[j][2]) fl = false
				}
				if(fl){
					ind = i
					result.push(reqArr[i])
					break
				}
			}
			reqArr.splice(ind,1)
		}


		if(result.length > 0){
			feedBackObj.sortFlag = true	
			let res = await fetch(`scripts_php/sortFeedBack.php?arr=${JSON.stringify(result)}`)
			let val = await res.json()

			let res_val = [...val.splice(-6), ...val.splice(0, 9)]


			feedBackObj.sortArr = val
			deleteFeedBacksItem()
			insertFeedBackItems(res_val, "beforeend", true)
			setCountFeedBack()
		}else{
			feedBackObj.sortFlag = false
			if(feedBackObj.allComents.length == 0){
				await getAllComents()
			}
			feedBackObj.remainsComents = feedBackObj.allComents.slice()
			let val = feedBackObj.remainsComents.splice(0, 15)			
			deleteFeedBacksItem()
			insertFeedBackItems(val, "beforeend", true)
			setCountFeedBack()
		}

	}
	function setCountFeedBack(){
		let count = document.querySelector('.feedback_btns_contein span')
		count.querySelector('span:first-child').innerText = 1
	}
	async function getAllComents(){
		let res = await fetch("scripts_php/getAllComents.php")
		let val = await res.json()
		feedBackObj.allComents = val
	}

	function setEventListenerFeedBack(){
		let imgs_feedback = document.querySelectorAll('.feed4countWrapp img')
		for(let i=0; i<imgs_feedback.length; i++){
			imgs_feedback[i].addEventListener('click', feedbackImgsShow)
		}
	}

	async function prepareValFeedBack(right=true){
		let val
		if(feedBackObj.sortFlag){
			if(right){
				val = feedBackObj.sortArr.splice(0, 10)
			}else{
				val = feedBackObj.sortArr.splice(-10)
			}

		}else{
			if(feedBackObj.allComents.length == 0){
				await getAllComents()
				feedBackObj.remainsComents = feedBackObj.allComents.slice()
				feedBackObj.remainsComents.splice(0 ,15)
			}
			if(right){
				val = feedBackObj.remainsComents.splice(0, 10)
			}else{
				val = feedBackObj.remainsComents.splice(-10)
			}
		
		}
		if(right){
			insertFeedBackItems(val, "beforeend", false)
		}else{
			insertFeedBackItems(val.reverse(), "afterbegin", false)
		}
	}


	function insertFeedBackItems(val, where_insert, check_cls){
		let cont = document.querySelector('.feed_main_cont')
		for(let i =0; i<val.length; i++){
			let html_svg = ""
			for(let j =0; j<5; j++){
				let polyg_cls = null
				if(j<val[i]['scope']){
					polyg_cls = "scope_svg_action"
				}
				html_svg += `<svg class="all_feed_back_svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 426.667 426.667" xml:space="preserve">
							<polygon class="polygon_scope ${polyg_cls}" points="213.333,10.441 279.249,144.017 426.667,165.436 320,269.41 345.173,416.226 213.333,346.91 
							81.485,416.226 106.667,269.41 0,165.436 147.409,144.017 "></polygon>
						</svg>`
			}
			let avatar_src = "img/empty_avatar.png"
			if(val[i]['avatar_file_name']){
				avatar_src = "upload_img/avatars/400x400/"+val[i]['avatar_file_name']
			}
			let fotoCont = ''
			if(val[i]['foto_file_name_arr']){
				let foto_arr = JSON.parse(val[i]['foto_file_name_arr'])
				fotoCont += "<div class='feed4countWrapp'>"
				for(let j =0; j<foto_arr.length; j++){
					let p = `upload_img/foto_review/100x100/${foto_arr[j]}`
					fotoCont += `<img src='upload_img/foto_review/100x100/${foto_arr[j]}'>`
				}
				fotoCont += "</div>"
			}

			let time = new Date (val[i]['timestamp']*1000)
			let date_s = ""
			let m = time.getMonth() + 1
			if(m < 10) m = String(0) + String(m)
			date_s += time.getDate()+"/"+m+"/"+time.getFullYear()+"г."

			let cont_cls
			if(check_cls){				
				if(i<5) cont_cls = "feedback_none"
				if(i==5) cont_cls = "feedback_left"
				if(i==6) cont_cls = "feedback_action"
				if(i==7) cont_cls = "feedback_right"
				if(i==8) cont_cls = "feedback_740"
				if(i==9) cont_cls = "feedback_940"
				if(i>9) cont_cls = "feedback_none"
			}else{
				cont_cls = "feedback_none"
			}

			let html = `<div class='feedback_cont ${cont_cls}'>
							<div class="feed_back_avatar">
								<img src=${avatar_src}>
							</div>
							<div class="feedback_heder_color"></div>
							<h3>${val[i]['name_client']}</h3>
							<p>${val[i]['text_review']}</p>
							${fotoCont}
							<div class="feedScopeDateCont">
								<div class="scope_feedback">
									<span>Оценка: </span>
									<div>${html_svg}</div>
								</div>
								<span>${date_s}</span>
							</div>
						</div>`
			cont.insertAdjacentHTML(where_insert, html)

			setEventListenerFeedBack()
		}
	}

	function deleteFeedBacksItem(){
		let items = document.querySelectorAll(".feed_main_cont > div")
		for(let i =0; i<items.length; i++){
			items[i].remove()
		}
	}

	function feedBackImgShowRightAct(){
		if(fotoGalObj.timeProtect < Date.now()){
			let pics = document.querySelectorAll('.fotoGalaryCont picture')

			let l = document.querySelector('.fotoGalaryPicleft')
			let a = document.querySelector('.fotoGalaryPicAct')
			let r = document.querySelector('.fotoGalaryPicRight')

			r.style.transition = '0s'
			l.classList = 'fotoGalaryPicAct'
			a.classList = 'fotoGalaryPicRight'
			r.classList = "fotoGalaryPicleft"

			setTimeout(()=>{
				r.style.transition = ""
			},400)
			let fl
			let left_ind = fotoGalObj.curIndex - 2

			if(fotoGalObj.curIndex == 0){		
				left_ind = fotoGalObj.imgs.length - 2 
				fl = true
			}else if(fotoGalObj.curIndex == 1){
				left_ind = fotoGalObj.imgs.length - 1
			}

			let n_img = fotoGalObj.imgs[left_ind]


			getAndSetSrc(n_img, l.querySelector('img'))

			if(fl){
				fotoGalObj.curIndex = fotoGalObj.imgs.length - 1
				return
			}
			fotoGalObj.curIndex -=1
			fotoGalObj.timeProtect = Date.now() + 600
		}
	}

	function feedBackImgShowLeftAct(){
		if(fotoGalObj.timeProtect < Date.now()){
			let l = document.querySelector('.fotoGalaryPicleft')
			let a = document.querySelector('.fotoGalaryPicAct')
			let r = document.querySelector('.fotoGalaryPicRight')

			l.style.transition = "0s"
			l.classList = "fotoGalaryPicRight"
			a.classList = "fotoGalaryPicleft"
			r.classList = "fotoGalaryPicAct"

			setTimeout(()=>{
				l.style.transition = ""
			},400)


			let fl
			let left_ind = fotoGalObj.curIndex + 2
			if(fotoGalObj.curIndex == (fotoGalObj.imgs.length - 1)){		
				left_ind = 1
				fl = true
			}else if(fotoGalObj.curIndex == (fotoGalObj.imgs.length - 2)){
				left_ind = 0
			}

			let n_img = fotoGalObj.imgs[left_ind]


			getAndSetSrc(n_img, l.querySelector('img'))

			
			if(fl){
				fotoGalObj.curIndex = 0
				return
			}
			fotoGalObj.curIndex +=1
			fotoGalObj.timeProtect = Date.now() + 600
		}
	}

	function feedbackImgsShow(){
		fotoGalObj.timeProtect = Date.now()
		let parent = this.parentNode
		let imgs = parent.querySelectorAll('img')
		fotoGalObj.imgs = imgs
		for(let i=0; i<imgs.length; i++){
			if(imgs[i] == this) fotoGalObj.curIndex = i
		}
		console.log(fotoGalObj.curIndex)
		ar_ind = [fotoGalObj.curIndex-1, fotoGalObj.curIndex, fotoGalObj.curIndex + 1]
		if(fotoGalObj.curIndex == 0){
			ar_ind[0] = imgs.length -1
		}
		if(fotoGalObj.curIndex == imgs.length -1){
			ar_ind[2] = 0
		}
		let pics = document.querySelectorAll('.fotoGalaryCont picture')
			
		for(let i =0; i<3; i++){
			getAndSetSrc(imgs[ar_ind[i]], pics[i].querySelector('img'))
		}
		pics[0].classList = "fotoGalaryPicleft"
		pics[1].classList = "fotoGalaryPicAct"
		pics[2].classList = "fotoGalaryPicRight"



		let body = document.querySelector('body')
		body.style.overflow = "hidden"
		let galCont = document.querySelector('.fotoGalaryCont')
		galCont.style.display = "flex"
		let closeBtn = document.querySelector('.fotoGalCloseBtn')
		closeBtn.addEventListener('click', fotoGalaryDisAct)

		document.querySelector('.fotoGalaryLefttBtn').addEventListener('click', feedBackImgShowRightAct)
		document.querySelector('.fotoGalaryRightBtn').addEventListener('click', feedBackImgShowLeftAct)

	}
	function getAndSetSrc(from_elem, to_elem){
		let src = from_elem.getAttribute('src')
		src = src.slice(src.indexOf("/100x100/")+9)
		src = "upload_img/foto_review/800x800/"+src
		to_elem.setAttribute('src', src)
	}

	function fotoGalaryDisAct(){
		galCont = document.querySelector('.fotoGalaryCont')
		galCont.style.display = "none"
		let body = document.querySelector('body')
		body.style.overflow = ""
	}

	function generelClearFeedBack(){
		clearTextInputFeedBack()
		clearScopeInvalidClass()
		removeScope()
		updateInputFile()
	}
	function clearScopeInvalidClass(){
		document.querySelector('form div.scope_cont').classList.remove('invalidValueCalculate')
	}
	function clearTextInputFeedBack(){
		let inpts = document.querySelectorAll(".add_feedback_section textarea, input[type='text']")
		for(let i=0; i< inpts.length; i++){
			inpts[i].value = ""
		}
	}

	function removeScope(){
		let plgns = document.querySelectorAll('.scope_cont polygon')
		for(let i = 0; i<plgns.length; i++){
			plgns[i].classList.remove('scope_svg_action')
		}
	}

	function updateInputFile(){
		let inp = document.querySelectorAll('.inputs_file_cont input[type="file"]')
		for(let i =0; i<inp.length; i++){
			if(inp[i].files.length > 0){
				let name = inp[i].getAttribute('name')
				let multp = inp[i].getAttribute('multiple')
				let p = inp[i].parentNode
				let n_inp = document.createElement('input')
				n_inp.setAttribute('type', 'file')
				n_inp.setAttribute('accept', 'image/*')
				n_inp.setAttribute('name', name)
				if(multp){
					n_inp.setAttribute('multiple', "multiple")
				}
				inp[i].remove()
				p.append(n_inp)
			}
		}
	}

	async function add_feedback_action(){
		if(!this.querySelector('.btn_animate').classList.contains('display_none')){
			let field_name = document.querySelector('.add_feedback_section input[name="name_client"]')
			let feedback_textaria = document.querySelector('.add_feedback_section textarea[name="feedback_text"]')

			field_name.classList.remove('invalidValueCalculate')
			feedback_textaria.classList.remove('invalidValueCalculate')
			clearScopeInvalidClass()
			let fl = true
			if(!(/^[a-zа-яё .]{3,50}$/i.test(field_name.value))){
				addWarningField(field_name, "invalidValueCalculate")
				fl = false
			}
			if(!(/^.+$/i.test(feedback_textaria.value))){
				addWarningField(feedback_textaria, "invalidValueCalculate")
				fl = false
			}
			
			let scope = 0

			for(let i=0; i<scope_svg.length; i++){
				if(scope_svg[i].querySelector('polygon').classList.contains('scope_svg_action')){
					scope +=1
				}
			}
			if(scope == 0){
				let scope_cont = document.querySelector('.scope_cont')
				addWarningField(scope_cont, "invalidValueCalculate")
				fl = false
			}

			if(true){
				let formData = new FormData()

				formData.append('client_name', field_name.value)
				formData.append('text_review', feedback_textaria.value)
				formData.append('scope', scope)


				let avatar_inp = document.querySelector('.add_feedback_section input[name="image_avatar"]')
				let foto_inp = document.querySelector('.add_feedback_section input[name="image_review"')

				if(avatar_inp.files.length == 1){
					
					formData.append('avatar', avatar_inp.files[0], avatar_inp.files[0].name)
				}

				if(foto_inp.files.length > 0){
					for(let i=0; i< foto_inp.files.length; i++){
						formData.append(i, foto_inp.files[i], foto_inp.files[i].name)
					}
				}
				showCalcultAnim(this)
				
				let res = await fetch('scripts_php/add_feedback.php', {
					method: "POST",
					body: formData
				})
				let ot = await res.text()
				setTimeout(()=>{
					delAnimCalcut(this)
					generelClearFeedBack()		
					if(res.ok){
						if(ot == "success"){
							let h = "Ваш отзыв доставлен!"
							let b = "Спасибо за обратную связь."
							open_report_modal(h, b)
						}else{
							let h = "Ваш отзыв не доставлен!"
							let b = `Сообщите пожалуйста администратору сайта об ошибке: ${ot}`
							open_report_modal(h, b)
						}
					}else{
						let h = "Ваш отзыв не доставлен!"
						let b = `Сообщите пожалуйста администратору сайта об ошибке: ${res.status}`
						open_report_modal(h, b)
					}
				},1000)
			}
		}
	}

	function feedback_scope_view_action(){
		let ind 
		for(let i = 0; i<scope_svg.length; i++){
			if(this == scope_svg[i]){
				ind = i
				break
			}
		}
		for(let i=0; i<scope_svg.length; i++){
			if(i <= ind){
				scope_svg[i].querySelector('polygon').classList.add('scope_svg_action')
			}
			if(i > ind){
				scope_svg[i].querySelector('polygon').classList.remove('scope_svg_action')
			}
		}
	}

	function calculate_action(){
		delWarnigClassCalcult()
		delResultCalcult()

		let btnAnim = document.querySelector('.expresCalculBtn div:first-child')

		if(btnAnim.classList.contains('display_none')) return

		let fl = true
		let inpArr = document.querySelectorAll('.calcul_body input')
		if(!(/^[0-9]*$/.test(inpArr[0].value))){
			addWarningField(inpArr[0], "invalidValueCalculate")
			fl = false
		}
		if(!(/^[0-9]*$/.test(inpArr[1].value))){
			addWarningField(inpArr[1], "invalidValueCalculate")
			fl = false
		}
		if(!(/^[1-9]+[.,]?[0-9]*$/.test(inpArr[2].value))){
			addWarningField(inpArr[2], "invalidValueCalculate")
			fl = false
		}

		if(fl){
			rooms = inpArr[0].value
			spots = inpArr[1].value
			sq = inpArr[2].value
			let price = document.querySelector('.calcul_body form')
			let foil_price = price.getAttribute('data-price-foil')
			let spot_price = price.getAttribute('data-price-spot')
			let lamp_price = price.getAttribute('data-price-lamp')
			let minOrder = price.getAttribute('data-price-minorder')
			let discount = price.getAttribute('data-price-discount')

			let sum = 0
			if(sq <= 3){
				sum = Number(minOrder)
			}else if(sq <= 18 && sq > 3){
				sum = Number(minOrder) + 200*(sq - 3)
			}else{
				sum = sq * Number(foil_price)
			}
			if(rooms > 1){
				sum = sum * 1.2
			}
			if(spots >= 3){
				sum += Number(spot_price) * spots 
			}
			if(spots && spots < 3){
				sum += Number(lamp_price)
			}

			let rand_time = ((Math.random() * 2) + 1) * 1000
			let btnAnim = document.querySelector('.calculate_cont .calc_btn')
			console.log(btnAnim)
			showCalcultAnim(btnAnim)
			setTimeout(()=>{
				insertResultCalcult(price, "afterend", sum, discount)
				clientData.click_link = "Главная страница экспресс расчет"
				delAnimCalcut(btnAnim)
				let reset_btn = document.querySelector('.calcult_result_cont > div div:first-child')
				reset_btn.addEventListener('click', reset_calcult)
				let send_req = document.querySelector('.calcult_result_cont > div div:last-child')
				send_req.addEventListener('click', send_order_calc)
			},rand_time)			
		}
	}

	function aferta_btn_action(){
		clientData.click_link = "Главная страница кнопка оформить на сайте скидка 1000 руб"
		call_me_view()
	}

	function feed_left_action(){
		if(Date.now() > time_feedback){
			time_feedback = Date.now() + 450
			let act = document.querySelector('.feedback_action')
			let r = document.querySelector('.feedback_right')
			let l = document.querySelector('.feedback_left')
			let f_740 = document.querySelector('.feedback_740')
			let f_940 = document.querySelector('.feedback_940')

			l.classList = 'feedback_cont feedback_action'
			act.classList = 'feedback_cont feedback_right'
			r.classList = 'feedback_cont feedback_740'
			f_740.classList = 'feedback_cont feedback_940'
			f_940.classList = "feedback_cont feedback_none"

			let l_prev = l.previousElementSibling

			if(l_prev){
				l_prev.classList = "feedback_cont feedback_left"
			}else{
				let ch = document.querySelector('.feed_main_cont').children
				ch[ch.length - 1].classList = "feedback_cont feedback_left"
			}
			let count = document.querySelector('.feedback_btns_contein span')
			let f_count = count.querySelector('span:first-child')
			if(f_count.innerText == 1){
				f_count.innerText = count.querySelector('span:last-child').innerText
			}else{
				f_count.innerText = Number(f_count.innerText) - 1
			}

			let l_item  = document.querySelector('.feedback_left')
			let all_item = document.querySelectorAll('.feedback_cont')
			let ind_item 
			for(let i=0;i<all_item.length;i++){
				if(l_item == all_item[i]){
					ind_item = i
					break
				}
			}

			if(ind_item < 5){
				prepareValFeedBack(false)	
			}
		}

	}
	function feed_right_action(){
		if(Date.now() > time_feedback){
			time_feedback = Date.now() + 450
			let act = document.querySelector('.feedback_action')
			let r = document.querySelector('.feedback_right')
			let l = document.querySelector('.feedback_left')
			let f_740 = document.querySelector('.feedback_740')
			let f_940 = document.querySelector('.feedback_940')

			act.classList = 'feedback_cont feedback_left'
			r.classList = 'feedback_cont feedback_action'
			f_740.classList = 'feedback_cont feedback_right'
			f_940.classList = 'feedback_cont feedback_740'
			l.classList = 'feedback_cont feedback_none'

			let next_940 = f_940.nextElementSibling
			if(next_940){
				next_940.classList = "feedback_cont feedback_940"
			}else{
				let child = document.querySelector('.feed_main_cont').children
				child[0].classList = "feedback_cont feedback_940"
			}

			let count = document.querySelector('.feedback_btns_contein span')
			let f_count = count.querySelector('span:first-child')
			if(f_count.innerText == count.querySelector('span:last-child').innerText){
				f_count.innerText = 1
			}else{
				f_count.innerText = Number(f_count.innerText) + 1
			}


			let r_item  = document.querySelector('.feedback_940')
			let all_item = document.querySelectorAll('.feedback_cont')
			let ind_item 
			for(let i=0;i<all_item.length;i++){
				if(r_item == all_item[i]){
					ind_item = i
					break
				}
			}
			if((all_item.length - ind_item) < 5){
				prepareValFeedBack()
			}
		}
	}

	function tech_elem_out_action(){
		if(clientWidth >= 940){			
			let header = this.querySelector('h3')
			header.style.bottom = "30px"
			this.querySelector(".btn_tech").style.top = "80%"
			this.querySelector("img").style.filter = ""
		}
	}

	function tech_elem_over_action(){
		if(clientWidth >= 940){
			let header = this.querySelector('h3')
			header.style.bottom = "40px"
			this.querySelector(".btn_tech").style.top = "0"
			this.querySelector("img").style.filter = "blur(7px)"
		}
	}
})