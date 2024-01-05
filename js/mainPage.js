
initNumbMP = 0
window.addEventListener('DOMContentLoaded',()=>{
	initNumbMP += 1
	let f = false
	if(initNumbMP < 2){
		f = true
	}

	if(location.hash){
		let hash  = location.hash.split('_')[0]
		let d = document.querySelector(hash)
		location.hash = ""
		d.scrollIntoView({
			behavior: "smooth",
			block: 'start'
		})
	}

	if(f){
		document.querySelector('.afert_btn_click').addEventListener('click', aferta_btn_action)
		document.querySelector('.sales_btn_click').addEventListener('click', sales_btn_action)
		document.querySelector('.calcul_body div.calc_btn').addEventListener('click', calculate_action)
	}


	let tech_elem = document.querySelectorAll('.tech_elem')
	if(f){		
		for(let i = 0; i < tech_elem.length; i++){
			tech_elem[i].addEventListener('mouseover', tech_elem_over_action)
			tech_elem[i].addEventListener('mouseout', tech_elem_out_action)
			tech_elem[i].addEventListener('click', techLinkAct)
		}
	}
	

	function techLinkAct(){
		console.log(this)
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