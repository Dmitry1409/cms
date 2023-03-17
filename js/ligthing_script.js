window.addEventListener('DOMContentLoaded',()=>{

	let toledoDate

	let btnsLight = document.querySelectorAll('.btnLighting')
	for(let i=0; i<btnsLight.length; i++){
		btnsLight[i].addEventListener('click', btnLightActiv)
	}

	document.querySelector('.FPcontArrow').addEventListener('click', addProduct)

	let sortBtn = document.querySelectorAll('.sortItem')
	for(let i =0; i<sortBtn.length; i++){
		sortBtn[i].addEventListener('click', sortAction)
	}

	getAllProduct()

	addListener()

	function addListener(){
		let countSpan = document.querySelectorAll('.count-cont span')
		for(let i =0; i<countSpan.length; i++){
			countSpan[i].addEventListener('click', sumOrSubProd)
		}
		let baskets = document.querySelectorAll('.btn-basket')
		for(let i=0; i<baskets.length; i++){
			baskets[i].addEventListener('click', basketAction)
		}
	}

	async function basketAction(){
		plusCountFavorMenu()
		let itemCont = this.parentNode.parentNode.parentNode
		let code = itemCont.querySelector('.brand-cont span:first-child').innerText.slice(5)
		let amount = Number(itemCont.querySelector('input').value)
		let obj = {
					'code': code,
					"amount": amount					
		}
		let res = await fetch(`scripts_php/lighting/addProdPersAcc.php?objProduct=${JSON.stringify(obj)}`)
		if(res.ok){
			this.classList.add('basket-added')
			this.innerText = "В избранном"
		}else{
			alert('Не удалось добавить товары в корзину. Сообщите пожалуйста об ошибке администратору сайта. Код ошибки: '+res.status)
		}
	}

	function sumOrSubProd(){
		if(this.innerText == "+"){
			this.previousElementSibling.value = Number(this.previousElementSibling.value) + 1
		}else{
			if(this.nextElementSibling.value == "1") return
			this.nextElementSibling.value = Number(this.nextElementSibling.value) - 1
		}
	}

	function sortAction(){
		let otherbtn
		for(let i =0; i<sortBtn.length; i++){
			if(this != sortBtn[i]){
				otherbtn = sortBtn[i]
			}
		}
		if(otherbtn.classList.contains('sortActive')){
			otherbtn.classList.remove('sortActive')
			this.classList.add('sortActive')
		}else{
			if(this.classList.contains('sortActive')){
				this.classList.remove('sortActive')
			}else{
				this.classList.add('sortActive')
			}
		}	
		getToledoData()
	}

	function addProduct(){
		let cont = document.querySelector('.catalogProductGrid')
		let val = toledoDate.slice(0, 12)
		toledoDate = toledoDate.slice(12)
		inserAdjac(val)
		checkArrow()
		checkCount()
	}

	async function getAllProduct(){
		let res = await fetch("scripts_php/lighting/getToledoProducts.php?comand=getAllProd")
		if(res.ok){
			let val = await res.json()
			toledoDate = val.slice(12)
		}
	}

	function checkArrow(){
		let arrow = document.querySelector('.arrow-8')
		if(toledoDate.length == 0){
			arrow.classList.add('arrRotate')
		}else{
			arrow.classList.remove('arrRotate')
		}
	}

	function btnLightActiv(){
		let act = document.querySelector('.btnActivLighting')
		let btnAll = document.querySelector('#BtnAll')
		btns = document.querySelectorAll('.btnLighting')
		if(!this.classList.contains('btnActivLighting')){
			act.classList.remove('btnActivLighting')
			this.classList.add('btnActivLighting')
		}else{
			return
		}
		getToledoData()
	}

	async function getToledoData(){
		let act = document.querySelectorAll('.btnActivLighting')
		cat = []
		for(let i=0; i<act.length; i++){
			cat.push(act[i].getAttribute('data-category'))
		}
		query = `scripts_php/lighting/getToledoProducts.php?category=${JSON.stringify(cat)}`

		let byAsc = document.querySelector('.sortCont > div:first-child')
		let byDesc = document.querySelector('.sortCont > div:last-child')
		if(byAsc.classList.contains('sortActive')){
			query += '&sortBy=ASC'
		}
		if(byDesc.classList.contains('sortActive')){
			query += '&sortBy=DESC'
		}
		res = await fetch(query)
		if(res.ok){
			val = await res.json()
			insertProduct(val)
		}else{
			alert('Не удалось получит данные от сервера. Сообщите пожалуйста администратору код ответа: '+res.status)
		}
	}

	function inserAdjac(val){
		let cont = document.querySelector('.catalogProductGrid')
		for(let i =0 ; i<val.length; i++){
			let bal
			if(val[i]['наличие'] > 0 ){
				bal = `В наличии<br>${val[i]['наличие']} шт.`
			}else{
				bal = "Под заказ"
			}
			let pr = val[i]['prise']
			let r = val[i]['ratio_prise']
			if(r[0] == "+"){
				pr = Math.ceil(Number(pr) + Number(r.slice(2)))
			}

			html = `<div class="catalogProdItem">
						<div>
							<div class="catalogImgCont">
								<img src="img/lightingPage/product/${val[i]['src']}">
							</div>
							<div class="catalDescriptCont">
								<div class="brand-cont">
									<span>Код: ${val[i]['code']}</span>
									<span>${val[i]['brand']}</span>
								</div>
								<div class="name-cont">${val[i]['name']}</div>
							</div>
						</div>
						<div>
							<div class="prise-cont">
								<div>
									<span>${pr}</span>
									<span>руб/${val[i]['ед_изм']}</span>
								</div>
								<span>${bal}</span>
							</div>
							<div class="basket-cont">
								<div class="count-cont">
									<span>–</span>
									<input type="text" maxlength="4" value="1">
									<span>+</span>
								</div>
								<div class="btn-basket">В избранное</div>
							</div>
						</div>
					</div>`

			cont.insertAdjacentHTML('beforeend', html)
		}
		addListener()

	}

	function checkCount(){
		let cur = document.querySelector('.FPcountCont > span')
		let all = cur.querySelector('span:last-child')
		cur = cur.querySelector('span:first-child')
		let item =  document.querySelectorAll('.catalogProdItem')
		cur.innerText = item.length
		all.innerText = Number(cur.innerText) + toledoDate.length
	}

	function insertProduct(date){
		let allProd = document.querySelectorAll('.catalogProdItem')
		for(let i=0; i<allProd.length; i++){
			allProd[i].remove()
		}
		let val = date.slice(0, 12)
		toledoDate = date.slice(12)
		inserAdjac(val)
		checkArrow()
		checkCount()
	}

	
})