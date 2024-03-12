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
		clientData.click_link = "Главная страница кнопка акция потолок за 8500"
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