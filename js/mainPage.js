
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

	let flHowMuchStart = true
	document.addEventListener('scroll', howMuchStart)
	let howMuchSpans = document.querySelectorAll('.howMuchDoneSection > div > span span:first-child')
	let howMuchCont = document.querySelectorAll('.howMuchCont')

	let howMuchDoneData = []
	let duractAnim = [1000, 2000, 3000, 4000, 5000, 6000]
	let arrIdInterv = [0,0,0,0,0,0]
	for(let i = 0; i<howMuchSpans.length; i++){
		howMuchDoneData.push(howMuchSpans[i].innerText)
		howMuchSpans[i].innerText = ""
	}

	let tech_elem = document.querySelectorAll('.tech_elem')
	for(let i = 0; i < tech_elem.length; i++){
		tech_elem[i].addEventListener('mouseover', tech_elem_over_action)
		tech_elem[i].addEventListener('mouseout', tech_elem_out_action)
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
		let cont = document.querySelector('.howMuchDoneSection')
		let cont_rect = cont.getBoundingClientRect()
		if(cont_rect.y < 500){
			if(flHowMuchStart){
				flHowMuchStart = false
				for(let i = 0; i< howMuchSpans.length; i++){
					setValueInterv(i)
				}
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