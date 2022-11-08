window.addEventListener('DOMContentLoaded',()=>{

	let show_img_flag= false

	let zakaz_btn = document.querySelector('.zakazWrapp div.calc_btn')
	if(zakaz_btn){
		zakaz_btn.addEventListener('click', zakazAllProd)
	}

	let plusAndMin = document.querySelectorAll('.count-cont span')
	for(let i=0; i<plusAndMin.length; i++){
		plusAndMin[i].addEventListener('click', sumOrSubProd)
	}

	let delSvgBtn = document.querySelectorAll('.delProdSvgBtn')
	for(let i =0; i<delSvgBtn.length; i++){
		delSvgBtn[i].addEventListener('click', delProdAction)
	}


	let req_price_left = document.querySelector('.req_price_left')
	if(req_price_left){
		req_price_left.addEventListener('click', req_price_action)
	}

	let pictures = document.querySelectorAll('.example_img_cont picture')
	pictures.forEach((item)=>{
		item.addEventListener('click', show_img)
	})
	let close_btn = document.querySelector('.close_btn_examp')
	if(close_btn){
		close_btn.addEventListener('click', close_img_show)
	}

	let l_btn = document.querySelector('.examp_btn_left')
	let r_btn = document.querySelector('.examp_btn_right')
	if(l_btn){
		l_btn.addEventListener('click', btnRightAct)
	}
	if(r_btn){
		r_btn.addEventListener('click', btnLeftAct)
	}

	let like_cont = document.querySelectorAll('.img_like_cont')
	if(like_cont.length > 0){
		for(let i = 0; i<like_cont.length; i++){
			like_cont[i].addEventListener('click', delFavourImg)
		}
	}
	
	let time_prot = Date.now()

	function zakazAllProd(){
		arr = []
		let prodCont = document.querySelectorAll('.catalogProdItem')
		for(let i =0; i<prodCont.length; i++){
			let artic = prodCont[i].querySelector('.brand-cont span:first-child')
			artic = artic.innerText.slice(5)
			let inp = prodCont[i].querySelector('input').value
			let obj = {
				code : artic,
				amount: inp,
			}
			arr.push(obj)
			
		}
		clientData.dataProd = arr
		clientData.click_link = "Страница избранное -> Заказать все товары"
		clientData.text_header = "Обратная связь"
		
		call_me_view()
	}

	function sumOrSubProd(){
		let val
		let parent = this.parentNode.parentNode.parentNode.parentNode
		if(this.innerText == "+"){
			val = Number(this.previousElementSibling.value) + 1 
			this.previousElementSibling.value = val
		}else{
			if(this.nextElementSibling.value == "1"){
				val = 1
			}else{
				val = Number(this.nextElementSibling.value) - 1
				this.nextElementSibling.value = val 
			}
		}
		let sum = parent.querySelector('.sum-ware span:first-child')
		let prise = parent.querySelector('.prise-cont > div span:first-child')
		prise = Number(prise.innerText)
		if(parent.getAttribute('data-category-prod') == "лента"){
			sum.innerText = (prise * 5) * val
		}else{
			sum.innerText = prise * val
		}
	}

	async function delProdAction(){
		let code = this.parentNode.querySelector('.brand-cont span:first-child')
		code = code.innerText.slice(5)

		let res = await fetch(`delProductFromFavour.php?code=${code}`)
		this.parentNode.remove()
		let itemProd = document.querySelectorAll('.catalogProdItem')
		if(itemProd.length == 0){
			let grid_ware = document.querySelector('.grid_ware')
			grid_ware.insertAdjacentHTML('beforebegin', "<h2>Пусто</h2>")
			grid_ware.remove()
			document.querySelector('.zakazCont').remove()
		}
	}

	function req_price_action(){
		let act_pic = document.querySelector('.examp_action')
		let webp = act_pic.querySelector('source').getAttribute('srcset')
		let jpg = act_pic.querySelector('img').getAttribute('src')
		


		close_img_show()
		clientData.foto_id = act_pic.querySelector('img').getAttribute('data-foto-id')
		clientData.foto_src = [webp, jpg]
		clientData.text_header = "Заявка на расчет"
		clientData.click_link = "Страница избранное -> отправить на просчет"
		setTimeout(()=>{
			call_me_view()
		}, 400)
	}

	function delFavourImg(){
		let curPic 
		if(this.classList.contains('like_cont_940')){
			curPic = document.querySelector('.examp_right')
		}else{
			curPic = document.querySelector('.examp_action')
		}
		let curImg = curPic.querySelector('img')
		let fotoId = curImg.getAttribute('data-foto-id')
		let allPic = document.querySelectorAll('.example_img_cont picture')

		
		let arr_id_img = JSON.parse(localStorage.like_img)
		let ind 
		for(let i in arr_id_img){
			if(arr_id_img[i] == fotoId){
				ind = i
			}
		}
		arr_id_img.splice(ind,1)
		localStorage.setItem('like_img', JSON.stringify(arr_id_img))

		delPHPaction(fotoId)

		
		allPic = document.querySelectorAll('.example_img_cont picture')
		if(this.classList.contains('like_cont_940')){
			if(allPic.length >= 3){				
				let r_940 = curPic.nextElementSibling
				if(!r_940){
					r_940 = allPic[0]
				}
				r_940.style.transition = "none"
				r_940.classList = "examp_right_940"
				setTimeout(()=>{
					r_940.style.transition = ""
					curPic.remove()
					r_940.classList = "examp_right"
				},10)
				
			}else{
				curPic.remove()
				document.querySelector('.like_cont_940').remove()
			}
		}else{
			if(clientWidth >= 940){
				if(allPic.length >=3){
					let next = curPic.previousElementSibling
					if(!next){
						next = allPic[allPic.length - 1]
					}
					next.style.transition = "none"
					next.classList = "examp_left"
					curPic.remove()
					setTimeout(()=>{
						next.style.transition = ""
						next.classList = "examp_action"
					}, 10)
						
				}else{
					curPic.remove()
					document.querySelector('.examp_btns div:first-child').style.visibility = "hidden"
				}
			}else{
				if(allPic.length > 1){	
					let next = curPic.nextElementSibling
					if(!next){
						next = allPic[0]
					}
					next.style.transition = "none"
					next.classList = "examp_right"
					setTimeout(()=>{
						next.style.transition = ""
						curPic.remove()
						next.classList = "examp_action"
					},10)
				}else{
					curPic.remove()
				}
			}
		}

		setTimeout(()=>{
			allPic = document.querySelectorAll(".example_img_cont picture")
			if(allPic.length == 0){
				let exam_flex = document.querySelector('.examle_flex')
				exam_flex.previousElementSibling.insertAdjacentHTML('afterend', "<h2>Пусто</h2>")
				exam_flex.remove()
			}else{
				let pic = document.querySelector('.examp_action')
				if(!pic){
					pic = document.querySelector('.examp_right')
				}	
				let ind
				for(let i in allPic){
					if(allPic[i] == pic){
						ind = i
					}
				}
				let curCount = document.querySelector('.count_img_cont > span span:first-child')
				let sum = document.querySelector('.count_img_cont > span span:last-child')
				curCount.innerText = Number(ind) + 1
				sum.innerText = allPic.length
			}
		}, 20)
	}

	async function delPHPaction(fotoId){
		fetch(`${root_dir}scripts_php/fotoExampLikeAction.php?fotoId=${fotoId}`)
	}

	function btnLeftAct(){
		if(Date.now() > time_prot){
			time_prot = Date.now() + 600
			let l = document.querySelector('.examp_left')
			let a = document.querySelector('.examp_action')
			let r = document.querySelector('.examp_right')
			let r_940 = document.querySelector('.examp_right_940')

			let pic = document.querySelectorAll('.example_img_cont picture')
			if(pic.length == 2){
				if(clientWidth < 940){
					let next = a.nextElementSibling
					if(!next){
						next = pic[0]
					}
					next.style.transition = "none"
					next.classList = "examp_right"
					setTimeout(()=>{
						next.style.transition = ""
						a.classList = "examp_left"
						next.classList = "examp_action"
					})
				}
			}
			if(pic.length == 3){
				let next = r.nextElementSibling
				if(!next){
					next = pic[0]
				}
				next.style.transition = "none"
				next.classList = "examp_right_940"
				setTimeout(()=>{
					next.style.transition = ""
					a.classList = "examp_left"
					r.classList = "examp_action"
					next.classList = "examp_right"
				},10)
			}
			if(pic.length > 3){
				let next = r.nextElementSibling
				if(!next){
					next = pic[0]
				}
				next.style.transition = "none"
				next.classList = "examp_right_940"
				setTimeout(()=>{
					next.style.transition = ''
					a.classList = "examp_left"
					r.classList = 'examp_action'
					next.classList = 'examp_right'
					if(l){
						l.classList = "examp_none"
					}
				})
			}

			let count = document.querySelector('.count_img_cont > span span:first-child')
			n = Number(count.innerText)
			if(n == pic.length){
				count.innerText = 1
			}else{
				count.innerText = n + 1
			}

		}
	}
	function btnRightAct(){
		if(Date.now() > time_prot){
			time_prot = Date.now() + 600
			let l = document.querySelector('.examp_left')
			let a = document.querySelector('.examp_action')
			let r = document.querySelector('.examp_right')
			let r_940 = document.querySelector('.examp_right_940')

			let pic = document.querySelectorAll('.example_img_cont picture')
			if(pic.length == 2){
				if(clientWidth < 940){
					let prev = a.previousElementSibling
					if(!prev){
						prev = pic[pic.length - 1]
					}
					prev.style.transition = "none"
					prev.classList = "examp_left"
					setTimeout(()=>{
						prev.style.transition = ''
						a.classList = "examp_right"
						prev.classList = "examp_action"
					},10)
				}
			}
			if(pic.length == 3){
				let prev = a.previousElementSibling
				if(!prev){
					prev = pic[pic.length - 1]
				}
				prev.style.transition = "none"
				prev.classList = "examp_left"
				setTimeout(()=>{
					prev.style.transition = ""
					a.classList = "examp_right"
					r.classList = "examp_right_940"
					prev.classList = "examp_action"
				},10)
			}
			if(pic.length > 3){
				let prev = a.previousElementSibling
				if(!prev){
					prev = pic[pic.length - 1]
				}
				prev.style.transition = 'none'
				prev.classList = "examp_left"
				setTimeout(()=>{
					prev.style.transition = ""
					prev.classList = "examp_action"
					a.classList = "examp_right"
					r.classList = "examp_right_940"
					if(r_940){
						r_940.classList = "examp_none"
					}
				},10)
	
			}

			let count = document.querySelector('.count_img_cont > span span:first-child')
			n = Number(count.innerText)
			if(1 == n){
				count.innerText = pic.length
			}else{
				count.innerText = n - 1
			}
		}
	}

	function show_img(){
		let cont = document.querySelector('.example_img_cont')
		if(!cont.classList.contains('show_img_cont')){
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
				btnLeftAct()
				show_img_flag = true
			}
			let act_img = document.querySelector('.examp_action')
			if(act_img.like){
				main_like.classList = "svg_like svg_like_show svg_like_cheked_show"
			}else{
				main_like.classList = "svg_like svg_like_show"
			}

			changeHashViewMode('a')

			let pics = document.querySelectorAll('.example_img_cont picture')
			if(pics.length == 2){
				if(!this.classList.contains("examp_action")){
					if(pics[0] == this){
						pics[1].classList = "examp_right" 
					}else{
						pics[0].classList = "examp_right"
					}
					this.classList = "examp_action"
				}
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

		let cont940 = document.querySelector('.like_cont_940')
		if(cont940){
			cont940.style.display = ""
		}

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
			btnRightAct()
			show_img_flag = false
		}
		changeHashViewMode('d')
		let svg = document.querySelector('.examp_btns div:first-child svg')
		svg.classList.remove('svg_like_show')

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

})