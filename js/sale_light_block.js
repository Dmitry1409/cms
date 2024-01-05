let init_light_link = 0
window.addEventListener("DOMContentLoaded", ()=>{
	let sl_dom_el = document.querySelector('.ligth_sale_link_img_cont')
	if(sl_dom_el){
		if(init_light_link == 0){
			init_light_link = 1
			let lig_sale_obj={
				domEl: document.querySelector('.ligth_sale_link_img_cont'),
				anim: false,
				img_ind:0,
				img:[["1.jpg", "20% 20%", "50% 70%"],
					["2.jpg", "0% 0%", "70% 0%"],
					["3.jpg", "0% 30%", "70% 50%"],
					["4.jpg", "0% 50%", "50% 80%"],
					["5.jpg", "0% 0%", "80% 20%"]]
			}

			window.addEventListener('scroll', check_sale_elem)

			setInSaleLigth()

			function setInSaleLigth(){
				lig_sale_obj.domEl.style.transition = ""
				lig_sale_obj.domEl.style.backgroundImage = `url('${root_dir}img/sales/sl/${lig_sale_obj.img[lig_sale_obj.img_ind][0]}')`
				lig_sale_obj.domEl.style.backgroundPosition = lig_sale_obj.img[lig_sale_obj.img_ind][1]
				setTimeout(()=>{	
					lig_sale_obj.domEl.style.transition = "background-position 5s ease-out"
					lig_sale_obj.domEl.style.backgroundPosition = lig_sale_obj.img[lig_sale_obj.img_ind][2]
					lig_sale_obj.img_ind +=1
					if(lig_sale_obj.img_ind == lig_sale_obj.img.length ){
						lig_sale_obj.img_ind = 0
					}
				},10)
			}


			function check_sale_elem(){
				if(visibleElem(lig_sale_obj.domEl)){
					if(!lig_sale_obj.anim){
						lig_sale_obj.anim = true
						lig_sale_obj.img.sort(()=> Math.random()-0.5)
						setInSaleLigth()
						lig_sale_obj.idIntP = setInterval(setInSaleLigth,5000)
					}
				}else{
					if(lig_sale_obj.anim){
						lig_sale_obj.anim = false
						clearInterval(lig_sale_obj.idIntP)
					}
				}
			}
		}
	}
});