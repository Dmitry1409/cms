window.addEventListener('DOMContentLoaded', ()=>{

	document.addEventListener('scroll', scrollAction)
	let slidFlag = false
	let id_inter_slid
	let id_timeOut
	let timeOutVal = 7000
	let intervalVal = 3000

	let time_protect = Date.now()

	let current_img

	let show_img_flag= false

	let hashTagActObj = {
			fl: false,
			arr: []
	}



	current_img = document.querySelector('.count_img_cont > span span:first-child')
	if(clientWidth >= 940){
		current_img.innerText = 2
	}

	let contrlHash = document.querySelectorAll('.controlHashItem')
	for(let i=0; i<contrlHash.length; i++){
		contrlHash[i].addEventListener('click', contrlHashAction)
	}

	let btn_left = document.querySelector('.examp_btn_left')
	let btn_rgt  = document.querySelector('.examp_btn_right')
	if(btn_left){
		btn_left.addEventListener('click', examp_left_action)
	}
	if(btn_rgt){
		btn_rgt.addEventListener('click', examp_right_action)
	}


	let pictures = document.querySelectorAll('.example_img_cont picture')
	pictures.forEach((item)=>{
		item.addEventListener('click', show_img)
	})

	let cls_btn = document.querySelector('.close_btn_examp')
	if(cls_btn){
		cls_btn.addEventListener('click', close_img_show)
	}

	let like_btns = document.querySelectorAll('.img_like_cont')
	like_btns.forEach(function(item){
		item.addEventListener('click', like_img_action)
	})

	let request_price_wrapp = document.querySelectorAll('.request_price_wrapp')

	for (let i=0; i < request_price_wrapp.length; i++){
		request_price_wrapp[i].addEventListener('click', howPrice)
	}


	async function contrlHashAction(){
		let arr = []
		let btns = document.querySelectorAll('.controlHashItem')
		for(let i = 0; i<btns.length; i++){
			if(btns[i].classList.contains('hashContrActiv')){
				if(this == btns[i]){
					return
				}else{
					btns[i].classList.remove('hashContrActiv')
				}
			}
		}
		this.classList.add('hashContrActiv')
		arr.push(this.innerText.slice(1))

		let res = await fetch(`${root_dir}scripts_php/fotoExampHasTagAction.php?hashTags=${JSON.stringify(arr)}`)
		if(res.ok){
			resetSliderInterval()
			let val = await res.json()
			insertImgHashTagAct(val)
		}else{
			alert('Не удалось получить изображения от сервера, сообщите пожалуйста администратору сайта. Код ошибки: '+res.status)
		}
	}
	function scrollAction(){
		if(!id_inter_slid){
			let hashCont = document.querySelector('.controlHashTagCont')
			if(!hashCont) return
			rectHash = hashCont.getBoundingClientRect()
			if(rectHash.y < 200){
				slidFlag = true
				examp_right_action(null, true , true)
				id_inter_slid = setInterval(()=>{
					examp_right_action(null, true , true)
				}, intervalVal)
			}
		}
	}
	function insertImgHashTagAct(val){
		let pic = document.querySelectorAll('.example_img_cont picture')

		for(let i =0; i<pic.length; i++){
			pic[i].remove()
		}
		let cont = document.querySelector('.example_img_cont')
		for(let i = 0; i<12; i++){
			let cl 
			if(i<3){
				cl = 'examp_none'
			}
			if(i == 3){
				cl = 'examp_left'
			}
			if(i == 4){
				cl = 'examp_action'
			}
			if(i == 5){
				cl = 'examp_right'
			}
			if(i == 6){
				cl = 'examp_right_940'
			}
			if(i > 6){
				cl = 'examp_none'
			}
			let alt = ''
			elem = `<picture class=${cl}>
						<div class=hashNameCont>`
							for(j=0; j<val[i]['hashName'].length; j++){
								elem += `<div>
											<span class=hashItem>${val[i]['hashName'][j]}</span>
										</div>`
								alt += val[i]['hashName'][j]+" "
							}
			elem += "</div>"
			elem += `<source srcset=${root_dir+val[i]['webp']} type='image/webp'>
					<img data-foto-id=${val[i]['id']} src=${root_dir+val[i]['jpg']} alt='${alt}'>
					</picture>`
			cont.insertAdjacentHTML('beforeend', elem)
		}
		pic = document.querySelectorAll('.example_img_cont picture')
		pic.forEach(function(item){
			item.addEventListener('click', show_img)
		})
		
		hashTagActObj.fl = true
		hashTagActObj.arr = val.slice(12)
		let countImg = document.querySelector('.count_img_cont > span')
		countImg.querySelector('span:first-child').innerText = 1
		countImg.querySelector('span:last-child').innerText = val.length

		removeReqPriceBlock()
	}
	function howPrice(){
		let act_pic

		if(this.classList.contains("req_price_left")){
			act_pic = document.querySelector('.examp_action')
		}else{
			act_pic = document.querySelector('.examp_right')
		}
		let exm_img_cont = document.querySelector('.example_img_cont')
		if(exm_img_cont.classList.contains('show_img_cont')){
			act_pic = document.querySelector('.examp_action')
			close_img_show()
		}

		

		let webp = act_pic.querySelector('source').getAttribute('srcset')
		let jpg = act_pic.querySelector('img').getAttribute('src')

		clientData.foto_id = act_pic.querySelector('img').getAttribute('data-foto-id')
		clientData.foto_src = [webp, jpg]
		clientData.text_header = "Расчет по фото"
		clientData.click_link = "Примеры работ фото- сколько стоит"

		call_me_view()


	}
	function parseSRC(elem){
		let s = elem.querySelector('source')
		let i = elem.querySelector('img')
		return [location.href+s.getAttribute('srcset'), location.href+i.getAttribute('src')]
	}
	function like_img_action(){
		plusCountFavorMenu()
		resetSliderInterval()
		let target_img
		if(this.classList.contains('like_cont_940')){
			target_img = document.querySelector('.examp_right')
		}else{
			target_img = document.querySelector('.examp_action')
		}

		let svg = this.querySelector('svg')


		if(this.classList.contains('like_cont_940')){
			let req_price = document.querySelector('.req_price_right')
			if(target_img.like){
				req_price.classList.remove('req_price_right_action')
			}else{
				req_price.classList.add('req_price_right_action')
			}
		}else{
			let req_price
			if(document.querySelector('.example_img_cont').classList.contains('show_img_cont')){
				req_price = document.querySelector('.req_price_right')
				if(target_img.like){
					req_price.classList.remove('req_price_right_action')
				}else{
					req_price.classList.add('req_price_right_action')
				}
			}else{
				req_price = document.querySelector('.req_price_left')
				if(target_img.like){
					req_price.classList.remove('req_price_left_action')
				}else{
					req_price.classList.add('req_price_left_action')

				}
			}
		}
		
		let id_img = target_img.querySelector('img').getAttribute('data-foto-id')

		if(target_img.like){
			target_img.like = null
			putOrRemoveLike(svg)

		}else{
			target_img.like = "yes"
			putOrRemoveLike(svg)
		}
		
		fotoLikePHPaction(id_img)	
	}
	async function fotoLikePHPaction(fotoId){
		let res = await fetch(`${root_dir}scripts_php/fotoExampLikeAction.php?comand=addFoto&fotoId=${fotoId}`)
	}
	function putOrRemoveLike(svg){
		let like_text = svg.nextElementSibling

		if(svg.classList.contains('svg_like_show')){
			if(svg.classList.contains('svg_like_cheked_show')){
				svg.classList = 'svg_like svg_like_show'
				like_text.innerHTML = "Добавить<br>в избранное"
			}else{
				svg.classList = 'svg_like svg_like_show svg_like_cheked_show'
				like_text.innerHTML = "В<br>избранном"
			}
		}else{
			if(svg.classList.contains('svg_like_cheked')){
				svg.classList = 'svg_like'
				like_text.innerHTML = "Добавить<br>в избранное"
			}else{
				svg.classList = "svg_like svg_like_cheked"
				like_text.innerHTML = "В<br>избранном"
			}
		}
	}
	function show_img(){
		let cont = document.querySelector('.example_img_cont')
		if(!cont.classList.contains('show_img_cont')){
			resetSliderInterval()
			document.querySelector('body').style.overflow = "hidden"
			let meta = document.querySelector('meta[name="viewport"]')
			meta.remove()
			n_meta = document.createElement('meta')
			n_meta.setAttribute('name', "viewport")
			n_meta.setAttribute('content', "width=device-width, initial-scale=1.0")

			document.querySelector('head').append(n_meta)

			let close = document.querySelector('.close_btn_examp')
			close.style.display = "block"
			
			let parent = cont.parentNode
			parent.classList.remove('shell_price')
			parent.classList.add('shell_examp')

			document.querySelector('.like_cont_940').style.display = "none"

			let btns = document.querySelector('.examp_btns')
			btns.classList.add('exapm_view')

			cont.classList.add("show_img_cont")

			let main_like = document.querySelector('.img_like_cont svg')

			if(!this.classList.contains('examp_action')){
				examp_right_action(null, chan_like=false)
				show_img_flag = true
			}
			let act_img = document.querySelector('.examp_action')
			if(act_img.like){
				main_like.classList = "svg_like svg_like_show svg_like_cheked_show"
			}else{
				main_like.classList = "svg_like svg_like_show"
			}

			changeHashViewMode('a')
		}
	}
	function changeHashViewMode(com){
		let hashtagCont = document.querySelectorAll('.hashNameCont')
		for(let i = 0; i<hashtagCont.length; i++){
			if(com == "a"){
				hashtagCont[i].classList.add('hashViewMode')	
			}
			if(com == "d"){
				hashtagCont[i].classList.remove('hashViewMode')
			}
		}
	}
	function close_img_show(){
		document.querySelector('body').style.overflow = ""
		let meta = document.querySelector('meta[name="viewport"]')
		meta.remove()
		n_meta = document.createElement('meta')
		n_meta.setAttribute('name', "viewport")
		n_meta.setAttribute('content', "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0")
		
		document.querySelector('head').append(n_meta)

		let btns = document.querySelector('.examp_btns')
		btns.classList.remove('exapm_view')

		document.querySelector('.like_cont_940').style.display = ""

		let close = document.querySelector('.close_btn_examp')
		let cont = document.querySelector('.example_img_cont')
		let parent = cont.parentNode
		cont.classList.remove("show_img_cont")
		close.style.display = "none"
		parent.classList.remove('shell_examp')
		parent.classList.add('shell_price')

		let like_940 = document.querySelector('.like_cont_940 svg')
		let main_like = document.querySelector('.img_like_cont svg') 
		if(show_img_flag){
			examp_left_action(null, chan_like = false)
			show_img_flag = false
		}
		let act_img = document.querySelector('.examp_action')
		let right_img = document.querySelector('.examp_right')
		if(act_img.like){
			main_like.classList = "svg_like svg_like_cheked"
		}else{
			main_like.classList = 'svg_like'
		}

		if(right_img.like){
			like_940.classList = "svg_like svg_like_cheked"
		}else{
			like_940.classList = "svg_like"
		}

		changeHashViewMode('d')
	}
	function changer_like(next_img, svg){
		let like_text = svg.nextElementSibling
		if(next_img.like){
			if(svg.classList.contains('svg_like_show')){
				svg.classList = 'svg_like svg_like_show svg_like_cheked_show'
			}else{
				svg.classList = 'svg_like svg_like_cheked'
			}
			like_text.innerHTML = "В<br>избранном"
		}else{
			if(svg.classList.contains('svg_like_show')){
				svg.classList = 'svg_like svg_like_show'
			}else{
				svg.classList = 'svg_like'
			}
			like_text.innerHTML = "Добавить<br>в избранное"
		}
	}
	function resetSliderInterval(){
		clearInterval(id_inter_slid)
		clearTimeout(id_timeOut)
		id_timeOut = setTimeout(()=>{
			id_inter_slid = setInterval(()=>{
				examp_right_action(null, true , true)
			}, intervalVal)
		}, timeOutVal)
	}
	function examp_right_action(e, chan_like = true, flInterval){
		if(Date.now() > time_protect){
			if(!flInterval){
				resetSliderInterval()
			}
			time_protect = Date.now() + 500

			let left = document.querySelector('.examp_left')
			let act = document.querySelector('.examp_action')
			let right = document.querySelector('.examp_right')
			let right_940 = document.querySelector('.examp_right_940')


			left.classList = 'examp_none'
			act.classList = 'examp_left'
			right.classList = "examp_action"
			right_940.classList = "examp_right"

			let next = right_940.nextElementSibling
			if(next){
				next.classList = 'examp_right_940'
			}else{
				let ch = document.querySelector('.example_img_cont').children
				ch[0].classList = 'examp_right_940'
			}

			let count_img = document.querySelector('.count_img_cont > span span:last-child')
			let max_count = Number(count_img.innerText)
			let count_number = Number(current_img.innerText)
			if(max_count > count_number){
				current_img.innerText = Number(current_img.innerText) + 1
			}else{
				current_img.innerText = 1
			}

			let pictures = document.querySelectorAll('.example_img_cont picture')
			let ind_act
			
			pictures.forEach(function(item, i){
				if(item == right_940){
					ind_act = i
				}
			})
			let count_to_end = pictures.length - ind_act
			if(count_to_end < 5){
				if(pictures.length < max_count){
					if(hashTagActObj.fl){
						insertImage(hashTagActObj.arr.slice(0, 10), 'beforeend')
						hashTagActObj.arr = hashTagActObj.arr.slice(10)
					}else{
						getImgUrl(pictures.length, 'beforeend')				
					}
				}
			}
			if(chan_like){
				let svg = document.querySelector('.img_like_cont svg')
				let like_cont_940 = document.querySelector('.like_cont_940')	
				if(getComputedStyle(like_cont_940).display == "none"){
					changer_like(right, svg)
				}else{
					let svg_940 = like_cont_940.querySelector('svg')
					changer_like(right_940, svg_940)
					changer_like(right, svg)
				}
			}

			removeReqPriceBlock()
		}
	}
	function examp_left_action(e, chan_like = true){
		if(Date.now()>time_protect){

			resetSliderInterval()
			
			time_protect = Date.now() + 500


			let left = document.querySelector('.examp_left')
			let act = document.querySelector('.examp_action')
			let right = document.querySelector('.examp_right')
			let right_940 = document.querySelector('.examp_right_940')


			left.classList = "examp_action"
			act.classList = "examp_right"
			right.classList = "examp_right_940"
			right_940.classList = "examp_none"

			let prev = left.previousElementSibling
			if(prev){
				prev.classList = "examp_left"
			}else{
				let ch = document.querySelector('.example_img_cont').children
				ch[ch.length -1].classList = "examp_left"
			}

			let count_img = document.querySelector('.count_img_cont > span span:last-child')
			let max_count = Number(count_img.innerText)
			let count_number = Number(current_img.innerText)

			if(count_number > 1){
				current_img.innerText = Number(current_img.innerText) - 1
			}else{
				current_img.innerText = max_count
			}

			let pictures = document.querySelectorAll('.example_img_cont picture')
			let ind_act
			
			pictures.forEach(function(item, i){
				if(item == left){
					ind_act = i
				}
			})

			if(ind_act < 4){
				if(pictures.length < max_count){
					if(hashTagActObj.fl){
						insertImage(hashTagActObj.arr.slice(0, 10), 'afterbegin')
						hashTagActObj.arr = hashTagActObj.arr.slice(10)
					}else{
						getImgUrl(pictures.length, 'afterbegin')
					}
				}
			}

			if(chan_like){
				let svg = document.querySelector('.img_like_cont svg')
				let like_cont_940 = document.querySelector('.like_cont_940')
				if(getComputedStyle(like_cont_940).display == "none"){
					changer_like(left, svg)
				}else{
					let svg_940 = like_cont_940.querySelector('svg')
					changer_like(act, svg_940)
					changer_like(left, svg)
				}
			}

			removeReqPriceBlock()

		}
	}
	function removeReqPriceBlock(){
		let r_price = document.querySelector('.req_price_right')
		let l_price = document.querySelector('.req_price_left')
		r_price.classList.remove('req_price_right_action')
		l_price.classList.remove('req_price_left_action')
	}
	async function getImgUrl(len, where_insert){
		let response = await fetch(`${root_dir}scripts_php/getUrlImageWorkExamp.php?len=`+len)
		if(response.status == 200){
			let res = await response.json()
			insertImage(res, where_insert)	
		}else{
			alert("Не удалось получить изображения. Сообщите пожалуйста об этой ошибке администратору сайта. Код ошибки: "+response.status)
		}
	}
	function insertImage(res, where_insert){
		let img_cont = document.querySelector('.example_img_cont')
		for(let i =0; i<res.length; i++){
			let alt = ""
			elem = `<picture class=examp_none>
						<div class=hashNameCont>`
							for(j=0; j<res[i]['hashName'].length; j++){
								alt += res[i]['hashName'][j]
								elem += `<div>
											<span class=hashItem>${res[i]['hashName'][j]}</span>
										</div>`
							}
			elem += "</div>"
			elem += `<source srcset=${root_dir+res[i]['webp']} type='image/webp'>
				<img data-foto-id=${res[i]['id']} src=${root_dir+res[i]['jpg']} alt='${alt}''>
					</picture>`
			img_cont.insertAdjacentHTML(where_insert, elem)
		}
		let pic = document.querySelectorAll('.example_img_cont picture')
		pic.forEach(function(item){
			item.addEventListener('click', show_img)
		})

		if(img_cont.classList.contains('show_img_cont')){
			changeHashViewMode('a')
		}
	}
})