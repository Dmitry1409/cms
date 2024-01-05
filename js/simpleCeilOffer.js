let init_fl_simpl_sale = 0
window.addEventListener("DOMContentLoaded",()=>{
	let all_cart = [];
	
	let btn = document.querySelectorAll(".cart_sale_btn")
	if(btn.length != 0){
		if(init_fl_simpl_sale == 0){
			init_fl_simpl_sale = 1
			for(let i=0; i<btn.length; i++){
				btn[i].addEventListener("click", sale_btn_act)
			}

			let btn_add_cart = document.querySelector('.add_cart_sale_id')
			btn_add_cart.addEventListener('click', add_cart_action)

			async function add_cart_action(){
				if(all_cart.length == 0){
					let q = root_dir + "scripts_php/returnAllCartSimpleCeil.php"
					let res = await fetch(q)
					let res_ob = await res.json()
					all_cart = res_ob
				}
				let c = document.querySelectorAll('.cart_ceil_id').length
				if(c != all_cart.length){
					insertCartSale(all_cart)
				}else{
					removeCart()
				}
			}

			function removeCart(){
				let c = document.querySelectorAll('.cart_ceil_id')
				for(let i=0; i<c.length; i++){
					if(i> 5){
						c[i].remove()
					}
				}
				let ar =  document.querySelector(".add_cart_sale_id > div")
				ar.classList.remove('arrRotate')
				let count = document.querySelector(".count_sale_id > span span:first-child")
				c = document.querySelectorAll('.cart_ceil_id')
				count.innerText = c.length
			}

			function insertCartSale(a){
				let count_cart = document.querySelectorAll('.cart_ceil_id')
				let l = count_cart.length
				let out = a.slice(l, l+2)
				
				let date = new Date()
				let y = String(date.getFullYear())
				y = y.slice(2)
				let today = `Актуально на ${date.getDate()}.${date.getMonth() + 1}.${y}г.`
				let last_Elem = count_cart[count_cart.length-1]


				for(let i=0; i<out.length; i++){
					let elem_js = JSON.parse(out[i]['service'])
					let ser_elem_html = ""
					for(let j=0; j<elem_js.length; j++){
						ser_elem_html += `<div>
					 				    		<svg width="15px" height="15px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
									    		.st0{fill:#41AD49;}
					 				    		</style><g><polygon class="st0" points="434.8,49 174.2,309.7 76.8,212.3 0,289.2 174.1,463.3 196.6,440.9 196.6,440.9 511.7,125.8 434.8,49     "/></g>
					 				    		</svg>
					 				    		<span class="text_sale_cart">
					 				    			${elem_js[j]}
					 				    		</span>
					 				    </div>`
					}

					let html = `<div class="cart_ceil_ofert cart_ceil_id">	  
								    <div class="cart_sale_prise">
								    	${out[i]['prise']} руб.
								    </div>
								    <div class="sales_img_cont">
								    	<img src='${root_dir + out[i]['img_src']}'>
								    </div>
								    <div class="elem_cart_sale">
								    	${ser_elem_html}
								    </div>
								    <div>
								    	<div class="cart_sale_btn">Заказать</div>
								    	<p class="text_sale_cart">${today}</p>
								    </div>
								</div>`
					
					last_Elem.insertAdjacentHTML("afterend", html)
				}
				
				let c = document.querySelector(".count_sale_id > span span:first-child")
				l = document.querySelectorAll('.cart_ceil_id').length
				c.innerText = l
				if(l == all_cart.length){
					let ar =  document.querySelector(".add_cart_sale_id > div")
					ar.classList.add('arrRotate')
				}

				addListenerInCart()
			}

			function addListenerInCart(){
				let c = document.querySelectorAll('.cart_sale_btn')
				for(let i=0; i<c.length; i++){
					c[i].addEventListener('click', sale_btn_act)
				}
			}

			function sale_btn_act(){

				let pr = this.parentNode.parentNode
				let img_src = pr.querySelector(".sales_img_cont img").getAttribute("src")
				let prise = pr.querySelector('.cart_sale_prise').innerText
				clientData.simpleCeil = {img_sr: img_src,
										prise: prise}
				clientData.click_link = "Заказать на странице простой потолок"

				call_me_view()
			}
		}
	}
})