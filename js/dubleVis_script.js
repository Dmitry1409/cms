window.addEventListener('DOMContentLoaded', ()=>{

	document.querySelector('.FPcontArrow').addEventListener('click', addImgAction)

	document.querySelector('.aferta_btn').addEventListener('click', aferta_btn_action)

	document.querySelector('.calcul_body .calc_btn').addEventListener('click', calc_btn_print)

	
	let FPbtns = document.querySelectorAll('.FPControlPanel div')
	for(let i=0; i<FPbtns.length; i++){
		FPbtns[i].addEventListener('click', FPbtnAction)
	}



	let img = document.querySelectorAll('.fotoPrintCont img')
	if(clientWidth < 900){
		for(let i = 0; i< img.length; i++){
			if(i % 2 == 0){
				let ar = []
				ar.push(Number(img[i].getAttribute('data-width')))
				ar.push(Number(img[i+1].getAttribute('data-width')))
				let wArr = calcWidth(ar)

				img[i].parentNode.style.width = wArr[0] + 'px'
				img[i+1].parentNode.style.width = wArr[1] + 'px'

				let h = calcHeight(ar[0], wArr[0], Number(img[i].getAttribute('data-height'))) 

				img[i].parentNode.style.height = h+'px'
				img[i+1].parentNode.style.height = h+'px'
			}
		}
	}
	if(clientWidth >= 900){
		for(let i = 0; i<img.length; i++){
			if(i % 3 == 0){
				let ar = []
				ar.push(Number(img[i].getAttribute('data-width')))
				ar.push(Number(img[i+1].getAttribute('data-width')))
				ar.push(Number(img[i+2].getAttribute('data-width')))

				let wArr = calcWidth(ar)

				img[i].parentNode.style.width = wArr[0]+'px'
				img[i+1].parentNode.style.width = wArr[1]+'px'
				img[i+2].parentNode.style.width = wArr[2]+'px'

				let h = calcHeight(ar[0], wArr[0], Number(img[i].getAttribute('data-height')))
				img[i].parentNode.style.height = h+'px'
				img[i+1].parentNode.style.height = h+'px'
				img[i+2].parentNode.style.height = h+'px'
			}
		}
	}
	for(let i = 0; i<img.length; i++){
		img[i].addEventListener('click', imgScaleFP)
	}

	function aferta_btn_action(){
		clientData.click_link = "Страница DubleVision кнопка скидка 200 руб кв/м"
		call_me_view()
	}


	function calc_btn_print(){
		delWarnigClassCalcult()
		delResultCalcult()

		let btnAnim = document.querySelector('.expresCalculBtn div:first-child')

		if(btnAnim.classList.contains('display_none')) return

		let fl = true
		let inpArr = document.querySelectorAll('.calcul_body input')
		if(!(/^[1-9]+[.,]?[0-9]*$/.test(inpArr[0].value))){
			addWarningField(inpArr[0], "invalidValueCalculate")
			fl = false
		}
		if(!(/^[0-9]*[.,]?[0-9]*$/.test(inpArr[1].value))){
			addWarningField(inpArr[1], "invalidValueCalculate")
			fl = false
		}
		if(!(/^[0-9]*$/.test(inpArr[2].value))){
			addWarningField(inpArr[2], "invalidValueCalculate")
			fl = false
		}

		if(fl){
			print = inpArr[1].value
			spots = inpArr[2].value
			sq = inpArr[0].value
			let price = document.querySelector('.calcul_body form')
			let foil_price = price.getAttribute('data-price-foil')
			let spot_price = price.getAttribute('data-price-spot')
			let lamp_price = price.getAttribute('data-price-lamp')
			let minOrder = price.getAttribute('data-price-minorder')
			let print_price = price.getAttribute('data-price-print')
			let discount = price.getAttribute('data-price-discount')


			let sum = 0
			if(sq <= 3){
				sum = Number(minOrder)
			}else if(sq <= 18 && sq > 3){
				sum = Number(minOrder) + 200*(sq - 3)
			}else{
				sum = sq * Number(foil_price)
			}
			if(print){
				sum += Number(print) * Number(print_price)
			}
			if(spots >= 3){
				sum += Number(spot_price) * spots 
			}
			if(spots && spots < 3){
				sum += Number(lamp_price)
			}

			let rand_time = ((Math.random() * 2) + 1) * 1000

			let animbtn = document.querySelector('.calcWrappFP .calc_btn')

			showCalcultAnim(animbtn)

			setTimeout(()=>{
				insertResultCalcult(price, "afterend", sum, discount)
				clientData.click_link = "Страница даблвизион и фотопечати калькулятор"
				delAnimCalcut(animbtn)
				let reset_btn = document.querySelector('.calcult_result_cont > div div:first-child')
				reset_btn.addEventListener('click', reset_calcult)
				let send_req = document.querySelector('.calcult_result_cont > div div:last-child')
				send_req.addEventListener('click', send_order_calc)
			},rand_time)			
		}
	}
	
	function imgScaleFP(){
		if(this.classList.contains('scaleRightFP')){
			this.classList.remove('scaleRightFP')
			return
		}
		if(this.classList.contains('scaleLeftFP')){
			this.classList.remove('scaleLeftFP')
			return
		}
		if(this.classList.contains('scaleFP')){
			this.classList.remove('scaleFP')
			return
		}
		let imgs = document.querySelectorAll('.fotoPrintCont img')
		for(let i =0; i<imgs.length; i++){
			if(imgs[i].classList.contains('scaleRightFP')){
				imgs[i].classList.remove('scaleRightFP')
				return
			}
			if(imgs[i].classList.contains('scaleLeftFP')){
				imgs[i].classList.remove('scaleLeftFP')
				return
			}
			if(imgs[i].classList.contains('scaleFP')){
				imgs[i].classList.remove('scaleFP')
				return
			}
		}
		let rect = this.getBoundingClientRect()
		if(clientWidth < 900){
			if(rect.x < 40){
				this.classList.add('scaleRightFP')
			}else{
				this.classList.add('scaleLeftFP')
			}
		}else{
			if(rect.x < 140){
				this.classList.add('scaleRightFP')
			}else if(rect.right > (clientWidth - 140)){
				this.classList.add('scaleLeftFP')
			}else{
				this.classList.add('scaleFP')
			}
		}
		setTimeout(()=>{
			this.classList = ''
		},3000)
	}

	async function FPbtnAction(){
		if(!this.classList.contains('FPActiv')){
			let curAct = document.querySelector('.FPActiv')
			curAct.classList.remove('FPActiv')
			this.classList.add('FPActiv')

			let arrow = document.querySelector('.arrow-8')
			arrow.classList.remove('arrRotate')

			let divs = document.querySelectorAll('.FPwrapp')
			for(let i = 0; i<divs.length; i++){
				divs[i].remove()
			}

			let d
			switch(this.innerText){
				case "все":
					d="all"
					break
				case "абстракции":
					d = 'abstractions'
					break
				case "животные":
					d = "animals"
					break
				case "архитектура":
					d = "architecture"
					break
				case "исскуство":
					d = "art"
					break
				case "детское":
					d = "children"
					break
				case "подводный мир":
					d = "fish"
					break
				case "цветы":
					d = "flowers"
					break
				case "еда":
					d = "food"
					break
				case "картины":
					d = "maps"
					break
				case "природа":
					d = "nature"
					break
				case "орнаменты":
					d = "ornaments"
					break
				case "небо":
					d = "sky"
					break
				case "космос":
					d = "space"
					break
				case "стерео-эффект":
					d = "stereo"
					break
				case "текстуры":
					d = "texture"
					break
				case "транспорт":
					d = "transport"
					break
			}
			

			let res = await fetch(`../scripts_php/selectCategoryFP.php?category=${d}`)
			if(res.ok){
				val = await res.json()

				let len = document.querySelector('.FPcountCont > span')
				let count = len.querySelector('span:first-child')
				len = len.querySelector('span:last-child')
				len.innerText = val['len']
				count.innerText = val['imgs'].length
				if(val['imgs'].length == val['len']){
					arrow.classList.add('arrRotate')
				}
				insertImgFP(val['imgs'])

			}else{
				alert('Произошла ошибка сервера, сообщите пожалуйста администратору сайта. Код возврата: '+res.status)
			}

		}
	}

	function insertImgFP(arr){
		if(clientWidth < 900){
			for(let i = 0; i<arr.length; i++){
				if(i % 2 == 0){						
					let w = calcWidth([arr[i][1], arr[i+1][1]])
					let h = calcHeight(arr[i][1], w[0], arr[i][2])
					addDivImg(arr[i][0], w[0], h)
					addDivImg(arr[i+1][0], w[1], h)
				}
			}
		}
		if(clientWidth >= 900){
			for(let i= 0; i<arr.length; i++){
				if(i % 3 == 0){
					let w = calcWidth([arr[i][1], arr[i+1][1], arr[i+2][1]])
					let h = calcHeight(arr[i][1], w[0], arr[i][2])
					addDivImg(arr[i][0], w[0], h)
					addDivImg(arr[i+1][0], w[1], h)
					addDivImg(arr[i+2][0], w[2], h)
				}
			}
		}
	}

	function calcWidth(img_w_arr){
		if(img_w_arr.length == 2){
			let p = 1 / (img_w_arr[0] + img_w_arr[1])
			p1 = img_w_arr[0] * p 
			p2 = img_w_arr[1] * p
			return [(p1*clientWidth)-10, (p2*clientWidth)-10]
		}
		if(img_w_arr.length == 3){
			let p = 1 / (img_w_arr[0] + img_w_arr[1] + img_w_arr[2])
			p1 = img_w_arr[0] * p 
			p2 = img_w_arr[1] * p
			p3 = img_w_arr[2] * p
			let cw = clientWidth - 200 
 			return [(p1*cw)-10, (p2*(cw))-10, (p3*cw)-10]
		}
	}

	function calcHeight(init_w, sec_w, h){
		let p = 1 / init_w
		p = p * sec_w
		return h * p
	}

	function addDivImg(url, w, h){
		let fotoCont = document.querySelector('.fotoPrintCont')
		let d = document.createElement('div')
		let im = document.createElement('img')
		im.addEventListener('click', imgScaleFP)
		im.setAttribute('src', url)
		d.style.width = w + 'px'
		d.style.height = h + 'px'
		d.classList.add('FPwrapp')
		d.append(im)
		fotoCont.append(d)
	}

	function rotateArrow(){
		let arrow = document.querySelector('.arrow-8')
		arrow.classList.toggle('arrRotate')
	}

	function delImgFp(){
		let divs = document.querySelectorAll('.FPwrapp')
		let newArr = []
		for(let i =0; i<divs.length; i++){
			if(i>=12){
				divs[i].remove()
			}
		}
		let arrow = document.querySelector('.arrow-8')
		arrow.classList.remove('arrRotate')
	}

	async function addImgAction(){
		let arrow = document.querySelector('.arrow-8')

		let counter = document.querySelector('.FPcountCont > span')
		counter = counter.querySelector('span:first-child')

		if(arrow.classList.contains('arrRotate')){
			delImgFp()
			let imgs = document.querySelectorAll('.fotoPrintCont img')
			counter.innerText = imgs.length
			return
		}
	
		let fotoCont = document.querySelector('.fotoPrintCont')

		let curNum = document.querySelectorAll('.fotoPrintCont img')
		curNum = curNum.length
		let res = await fetch(`../scripts_php/addImgAction.php?curNum=${curNum}`)
		let arr = await res.json()
	
		if(res.ok){
			insertImgFP(arr['imgs'])
		}else{
			alert('Произошла ошибка сервера, сообщите пожалуйста администратору сайта. Код возврата: '+res.status)
		}
		
		let imgs = document.querySelectorAll('.fotoPrintCont img')
		counter.innerText = imgs.length
		let len = document.querySelector('.FPcountCont > span')
		len = len.querySelector('span:last-child')
		len = Number(len.innerText)
		if(imgs.length == len){
			rotateArrow()
		}
	}
})