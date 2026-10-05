window.addEventListener('DOMContentLoaded',()=>{
	if(location.hash){
		let hash  = location.hash.split('_')[0]
		let d = document.querySelector(hash)
		location.hash = ""
		d.scrollIntoView({
			behavior: "smooth",
			block: 'start'
		})
	}

	document.querySelector('.afert_btn_click').addEventListener('click', aferta_btn_action)
	document.querySelector('.sales_btn_click').addEventListener('click', sales_btn_action)
	document.querySelector('.calcul_body div.calc_btn').addEventListener('click', calculate_action)


	let tech_elem = document.querySelectorAll('.tech_elem')
	if(tech_elem){		
		for(let i = 0; i < tech_elem.length; i++){
			tech_elem[i].addEventListener('mouseover', tech_elem_over_action)
			tech_elem[i].addEventListener('mouseout', tech_elem_out_action)
			tech_elem[i].addEventListener('click', techLinkAct)
		}
	}

	

	howMuchDoneAction()
	
	techProceesing()

	function techProceesing(){

		function tech_bt_act(){
			bt.remove()
			cont.style.height = cont.scrollHeight + "px"
		}
		let cont = document.querySelector('.tech_grid')
		let elem = cont.querySelectorAll(".tech_elem")
		let h_e = elem[0].offsetHeight + 10
		let over
		if(clientWidth < 640){
			over = h_e * 6 + 150
		}else if( clientWidth > 640 && clientWidth < 940){
			over = h_e * 3 + 150
		}else{
			over = h_e*2 + 150
		}
		cont.style.overflow = "hidden"
		cont.style.height = over + "px"

		let bt = document.querySelector('.tech_down_bt')
		bt.addEventListener("click", tech_bt_act)

	}


	function howMuchDoneAction(){

		let flHowMuchStart = true
		let cont = document.querySelector('.howMuchDoneSection')
		let howMuchSpans = document.querySelectorAll('.howMuchDoneSection > div > span span:first-child')
		let howMuchCont = document.querySelectorAll('.howMuchCont')
		let howMuchDoneData = []
		let duractAnim = [500, 1000, 1500, 2000, 2500, 3000]
		let arrIdInterv = [0,0,0,0,0,0]				
		document.addEventListener('scroll', howMuchStart)				
		for(let i = 0; i<howMuchSpans.length; i++){
			howMuchDoneData.push(howMuchSpans[i].innerText)
			howMuchSpans[i].innerText = ""
		}
		

		function setValueInterv(ind_elem){
			let stepVal = Math.ceil(duractAnim[ind_elem] / 10)
			stepVal = Math.ceil(howMuchDoneData[ind_elem] / stepVal)
			arrIdInterv[ind_elem] = setInterval(()=>{
				howMuchSpans[ind_elem].innerText = Number(howMuchSpans[ind_elem].innerText) + stepVal
				if(Number(howMuchSpans[ind_elem].innerText) > Number(howMuchDoneData[ind_elem])){
					howMuchSpans[ind_elem].innerText = howMuchDoneData[ind_elem]
					clearInterval(arrIdInterv[ind_elem])
					howMuchViewEffect(howMuchSpans[ind_elem])
				} 
			}, 10)
		}
		function howMuchViewEffect(elem){
			let d = elem.parentNode.parentNode
			d.style.transition = ".3s"
			d.classList.add('boxShadEffect')
			d.classList.add('borderEffect')
		}
		function howMuchStart(){
			cont_rect = cont.getBoundingClientRect()			
			if(cont_rect.y < 500){
				if(flHowMuchStart){
					flHowMuchStart = false
					for(let i = 0; i< howMuchSpans.length; i++){
						setValueInterv(i)
					}
					document.removeEventListener('scroll', howMuchStart)
				}
			}
		}
	}

	function techLinkAct(){
		window.location.href = this.querySelector('a').href
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
			if(sum > 20000){
				discount = sum * 0.2
			}
			let rep_msg = ""
			if(rooms){
				rep_msg += `<h3>Колличество комнат - ${rooms} </h3>`
			}
			if(spots){
				rep_msg += `<h3>Колличество освещения - ${spots}</h3>`
			}
			rep_msg += `<h3>Общая площадь - ${sq}</h3>`
			rep_msg += `<h3>Сумма - ${sum}</h3>`
			rep_msg += `<h3>Скидка - ${discount}</h3>`
			rep_msg = encodeURI(rep_msg)
			fetch(`${root_dir}mailer/report_in_mail.php?tema=Калькулятор_главная&msg=${rep_msg}`) 
			call_me_action()
			let rand_time = ((Math.random() * 2) + 1) * 1000
			let btnAnim = document.querySelector('.calculate_cont .calc_btn')
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
		clientData.click_link = "Главная страница кнопка учавствовать в акции 100 клиенту бессплатно"
		call_me_view()
	}
	function sales_btn_action(){
		let sale_mp = document.querySelectorAll('.zagolov_sale_mp')
		for(let i=0; i<sale_mp.length; i++){
			if(!sale_mp[i].classList.contains('zagol_opacity_sale')){
				clientData.click_link = sale_mp[i].innerText
				break
			}
		}
		call_me_view()
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

window.addEventListener('load', ()=>{

	let id_intv_sale


	let left_btn_sale = document.querySelector('.left_btn_sale')
	let right_btn_sale = document.querySelector('.right_btn_sale')

	left_btn_sale.addEventListener('click', go_left)
	right_btn_sale.addEventListener('click', go_right)

	many_sale_act_load_act()

	document.addEventListener('scroll', sale_set_interv)

	function sale_set_interv(){
		let cont = document.querySelector('.sales_block')
		if(visibleElem(cont)){
			if(!id_intv_sale){
				id_intv_sale = setInterval(go_right, 4000)
			}
		}else{
			clearInterval(id_intv_sale)
			id_intv_sale = null
		}
	}

	async function many_sale_act_load_act(){
		let res = await fetch("scripts_php/get_many_sale.php")
		let js = await res.json()
		insert_sale(js)
	}

	function insert_sale(js){
		let txt = document.querySelector('.zagolov_sale_mp')
		let img = document.querySelector('.img_absol_sale_mp')
		let p = document.querySelector('.sale_point_id')
		for(let i=0; i<js.length; i++){
			let h_img  = `<img class="img_absol_sale_mp sale_img_hidden" style="border-radius: 4px;" src="img/sales/${js[i]['img_src']}">`
			img.insertAdjacentHTML('beforebegin', h_img)
			let t = `<h2 class="zagolov_sale_mp zagol_opacity_sale">${js[i]['text']}</h2>`
			txt.insertAdjacentHTML('beforebegin', t)
			p.insertAdjacentHTML('beforeend', "<div></div>")
		}
	}

	function go_right(e){
		if(e){
			clearInterval(id_intv_sale)
			id_intv_sale = null
		}
		let img = document.querySelectorAll('.img_absol_sale_mp')
		let zag = document.querySelectorAll('.zagolov_sale_mp')
		let point = document.querySelectorAll('.sale_point_id > div')

		for(let i=0; i<img.length; i++){
			if(!img[i].classList.contains('sale_img_hidden')){
				img[i].classList.add('sale_img_hidden')
				zag[i].classList.add('zagol_opacity_sale')
				if((i+1)>=img.length){
					img[0].classList.remove('sale_img_hidden')
					zag[0].classList.remove('zagol_opacity_sale')
				}else{						
					img[i+1].classList.remove('sale_img_hidden')
					zag[i+1].classList.remove('zagol_opacity_sale')
				}
				break
			}
		}
		for(let i=0; i<point.length; i++){
			if(point[i].classList.contains('banPointAct_sale')){
				point[i].classList.remove('banPointAct_sale')
				if((i+1) >= point.length){
					point[0].classList.add('banPointAct_sale')
				}else{
					point[i+1].classList.add('banPointAct_sale')
				}
				break
			}
		}
	}

	function go_left(e){
		if(e){
			clearInterval(id_intv_sale)
			id_intv_sale = null
		}		
		let img = document.querySelectorAll('.img_absol_sale_mp')
		let zag = document.querySelectorAll('.zagolov_sale_mp')
		let point = document.querySelectorAll('.sale_point_id > div')

		for(let i=0; i<img.length; i++){
			if(!img[i].classList.contains('sale_img_hidden')){
				img[i].classList.add('sale_img_hidden')
				zag[i].classList.add('zagol_opacity_sale')
				if((i-1) < 0){
					img[img.length-1].classList.remove('sale_img_hidden')
					zag[img.length-1].classList.remove('zagol_opacity_sale')
				}else{						
					img[i-1].classList.remove('sale_img_hidden')
					zag[i-1].classList.remove('zagol_opacity_sale')
				}
				break
			}
		}

		for(let i=0; i<point.length; i++){
			if(point[i].classList.contains('banPointAct_sale')){
				point[i].classList.remove('banPointAct_sale')
				if((i-1) < 0){
					point[point.length-1].classList.add('banPointAct_sale')
				}else{
					point[i-1].classList.add('banPointAct_sale')
				}
				break
			}
		}
	}
})