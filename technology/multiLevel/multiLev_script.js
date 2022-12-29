
window.addEventListener('DOMContentLoaded',()=>{
	let startScrollFlag = true
	let clientHeight = document.documentElement.clientHeight
	let svg_cont = document.querySelectorAll('.cont_svg')
	let yOffset = svg_cont[2].getBoundingClientRect().y
	
	document.querySelector('.aferta_btn').addEventListener('click', aferta_btn_action)
	document.querySelector('.calcul_body .calc_btn').addEventListener('click', calc_btn_action)
	
		
	document.addEventListener('scroll',()=>{

		if(window.pageYOffset > (yOffset - clientHeight)){
			if(startScrollFlag){
				startScroll()
			}
		}

	})

	function calc_btn_action(){
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
		if(!(/^[1-9]*[.,]?[0-9]*$/.test(inpArr[1].value))){
			addWarningField(inpArr[1], "invalidValueCalculate")
			fl = false
		}
		if(!(/^[0-9]*$/.test(inpArr[2].value))){
			addWarningField(inpArr[2], "invalidValueCalculate")
			fl = false
		}

		if(fl){
			multiLev = inpArr[1].value
			spots = inpArr[2].value
			sq = inpArr[0].value
			let price = document.querySelector('.calcul_body form')
			let foil_price = price.getAttribute('data-price-foil')
			let spot_price = price.getAttribute('data-price-spot')
			let lamp_price = price.getAttribute('data-price-lamp')
			let minOrder = price.getAttribute('data-price-minorder')
			let multiLev_price = price.getAttribute('data-price-multilevel')
			let discount = price.getAttribute('data-price-discount')

			let sum = 0
			if(sq <= 3){
				sum = Number(minOrder)
			}else if(sq <= 18 && sq > 3){
				sum = Number(minOrder) + 200*(sq - 3)
			}else{
				sum = sq * Number(foil_price)
			}
			if(multiLev){
				sum += Number(multiLev) * Number(multiLev_price)
			}
			if(spots >= 3){
				sum += Number(spot_price) * spots 
			}
			if(spots && spots < 3){
				sum += Number(lamp_price)
			}

			let rand_time = ((Math.random() * 2) + 1) * 1000

			let anBtn = document.querySelector('.design .calc_btn')
			console.log(anBtn)
			showCalcultAnim(anBtn)

			setTimeout(()=>{
				insertResultCalcult(price, "afterend", sum, discount)
				clientData.click_link = "Страница многоуровневые потолки калькулятор"
				delAnimCalcut(anBtn)
				let reset_btn = document.querySelector('.calcult_result_cont > div div:first-child')
				reset_btn.addEventListener('click', reset_calcult)
				let send_req = document.querySelector('.calcult_result_cont > div div:last-child')
				send_req.addEventListener('click', send_order_calc)
			},rand_time)			
		}
	}

	function aferta_btn_action(){
		clientData.click_link = "Страница многуровневые кнопка дизайн в подарок"
		call_me_view()
	}

	function startScroll(){
		startScrollFlag = false

		svg_cont[0].scroll({
			left:200,
			behavior: "smooth"
		})
		setTimeout(()=>{
			svg_cont[1].scroll({
			left: 400,
			behavior: "smooth"
			})
		},500)
		setTimeout(()=>{
			svg_cont[2].scroll({
				left: 600,
				behavior: "smooth"
			})
		}, 700)	
	}
})