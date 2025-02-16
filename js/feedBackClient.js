

window.addEventListener("DOMContentLoaded", ()=>{

	let time_feedback = Date.now()

	let flIntervalFeed = false


	let fotoGalObj = {
						imgs: "",
						curIndex: ""
	}

	let id_intervalFeed
	let id_timeOutFeed
	let flFancyFeedBack = false

	let foto = {
		length: 0,
		count: 0,
		avatar: [],
		arr: []
	}

	let formData = new FormData()



	Fancybox.bind(document.getElementById("feedBackContId"), "[data-fancybox]", {
  		on: {
	    close: () => {
	    	feedBackFancyInterval()
	    },
	    initLayout: () =>{
	    	feedBackFancyInterval()
	    },
	  },
	});

	

	

	let feedBackObj = {
		sortFlag : false,
		remainsComents: [],
		allComents : [],
		sortArr: [],
		statusClicks: {
			"С фото": {'status':"disable","n_comand": 0},
			"Дата:": {'status': "disable", "n_comand": 0},
			"Оценка:": {'status': 'down', "n_comand": 0}
		}
	}

	document.addEventListener('scroll', scrollActionFeedBack)

	
		
	document.querySelector('.add_feedback_section .calc_btn').addEventListener('click', add_feedback_action)

	document.querySelector('.feed_left').addEventListener('click', feed_left_action)
	document.querySelector('.feed_right').addEventListener('click', feed_right_action)

	let sortFeedBackBtns = document.querySelectorAll('.feedBackSortCont > div')
	for(let i=0; i<sortFeedBackBtns.length; i++){
		sortFeedBackBtns[i].addEventListener('click', sortFeedBackAction)
	}

	let scope_svg = document.querySelectorAll('.add_feedback_section svg')
	for(let i = 0; i<scope_svg.length; i++){
		scope_svg[i].addEventListener('click', feedback_scope_view_action)
	}

	
	document.querySelector('.add_feedback_btn_open_cont > div').addEventListener('click', add_feedback_open)

	let cont_feed = document.querySelector('.feedback_section')


	function feedBackFancyInterval(){
		if(flFancyFeedBack){
			flFancyFeedBack = false
			setTimeOutIntervalFeed(valTime0 = 6000)
		}else{
			clearTimeout(id_timeOutFeed)
			clearInterval(id_intervalFeed)
			flFancyFeedBack = true		
		}
	}

	function setTimeOutIntervalFeed(valTimeO=30000, valInter=4000){
		clearTimeout(id_timeOutFeed)
		clearInterval(id_intervalFeed)

		id_timeOutFeed = setTimeout(()=>{
			feed_right_action(null, true)
			id_intervalFeed = setInterval(()=>{
				feed_right_action(null, true)
			}, valInter)
		}, valTimeO)
	}

	function scrollActionFeedBack(){
		if(visibleElem(cont_feed)){
			if(!flIntervalFeed){
				flIntervalFeed = true
				setTimeOutIntervalFeed(4000, 4000)
			}
		}else{
			if(flIntervalFeed) flIntervalFeed = false
			clearTimeout(id_timeOutFeed)
			clearInterval(id_intervalFeed)
		}
	}

	function add_feedback_open(){
		let sect = document.querySelector('.dopWrapFeedback')
		sect.style.height = sect.scrollHeight + "px"
		this.remove()
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
			if(!(/^[^]+$/i.test(feedback_textaria.value))){
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

			if(fl){
				showCalcultAnim(this)
				formData.append('client_name', field_name.value)
				formData.append('text_review', feedback_textaria.value)
				formData.append('scope', scope)


				// let avatar_inp = document.querySelector('.add_feedback_section input[name="image_avatar"]')
				let foto_inp = document.querySelector('.add_feedback_section input[name="image_review"')
				let fl_foto = false
				// if(avatar_inp.files.length == 1){
				// 	fl_foto = true
				// 	foto['length'] += avatar_inp.files.length
				// 	let reader = new FileReader()
				// 	reader.onload = function(e){
				// 		CompressImage(e.target.result, foto.avatar)
				// 	}
				// 	reader.readAsDataURL(avatar_inp.files[0])
				// }

				if(foto_inp.files.length > 0){
					fl_foto = true
					foto['length'] += foto_inp.files.length
					for(let i=0; i< foto_inp.files.length; i++){
						let reader = new FileReader()

						reader.onload = function(e){
							CompressImage(e.target.result, foto.arr)
						}
						reader.readAsDataURL(foto_inp.files[i])
					}
				}
				if(!fl_foto){
					sendFeedBack()
				}
				
			}
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

			arr.push(comData.split(',')[1])

			if(foto.length > 0){
				if(foto.count == foto.length - 1){
					sendFeedBack()
				}

				foto.count ++
			}
		}		
		img.src = base64
	}

	async function sendFeedBack(){
		if(foto.arr.length > 0){
			formData.append('fotoArr', JSON.stringify(foto.arr))
		}
		// if(foto.avatar.length > 0){
		// 	formData.append('avatar', JSON.stringify(foto.avatar))
		// }

		let res = await fetch(`${root_dir}scripts_php/add_feedback.php`, {
			method: "POST",
			body: formData
		})
		

		let ot = await res.text()
		setTimeout(()=>{
			delAnimCalcut(document.querySelector('.add_feedback_section .calc_btn'))
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
	function feed_left_action(){
		if(Date.now() > time_feedback){
			time_feedback = Date.now() + 450

			setTimeOutIntervalFeed()

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
	function feed_right_action(e, auto){
		if(Date.now() > time_feedback){
			time_feedback = Date.now() + 450

			if(!auto){
				setTimeOutIntervalFeed()
			}

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
	async function sortFeedBackAction(){

		setTimeOutIntervalFeed()

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
			let res = await fetch(`${root_dir}scripts_php/sortFeedBack.php?arr=${JSON.stringify(result)}`)
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
	function shuffle(array) {
	  for (let i = array.length - 1; i > 0; i--) {
	    let j = Math.floor(Math.random() * (i + 1));
	    [array[i], array[j]] = [array[j], array[i]];
	  }
	  return array
	}
	async function getAllComents(){
		let res = await fetch(`${root_dir}scripts_php/getAllComents.php`)
		let val = await res.json()
		feedBackObj.allComents = val
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
			let avatar_src = `${root_dir}img/empty_avatar.png`
			if(val[i]['avatar_file_name']){
				avatar_src = `${root_dir}upload_img/avatars/400x400/`+val[i]['avatar_file_name']
			}
			let fotoCont = ''
			if(val[i]['foto_file_name_arr']){
				let foto_arr = JSON.parse(val[i]['foto_file_name_arr'])
				fotoCont += "<div class='feed4countWrapp'>"
				let rand = Math.ceil(Math.random() * 10000)
				for(let j =0; j<foto_arr.length; j++){
					fotoCont += `<a data-fancybox='gallery${rand}' href = '${root_dir}upload_img/foto_review/800x800/${foto_arr[j]}'> `
					fotoCont += `<img src='${root_dir}upload_img/foto_review/100x100/${foto_arr[j]}'>`
					fotoCont += "</a>"
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
							</div>
						</div>`
			cont.insertAdjacentHTML(where_insert, html)
		}
	}
	function deleteFeedBacksItem(){
		let items = document.querySelectorAll(".feed_main_cont > div")
		for(let i =0; i<items.length; i++){
			items[i].remove()
		}
	}
	function getAndSetSrc(from_elem, to_elem){
		let src = from_elem.getAttribute('src')
		src = src.slice(src.indexOf("/100x100/")+9)
		src = `${root_dir}upload_img/foto_review/800x800/`+src
		to_elem.setAttribute('src', src)
	}
	
})