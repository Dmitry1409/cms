window.addEventListener("DOMContentLoaded", ()=>{
	let slider_obj = {
		firstX: undefined,
		secondX: undefined,
		fl_move: undefined,
		moveY: 0,
		id_interval: 0,
		id_timeout: 0,
		fl_scroll: true,
		time_shtamp: 0
	}

	let clientWidth = document.documentElement.clientWidth

	let slider_point = document.querySelectorAll('.slider_point')
	for(let i =0; i < slider_point.length; i++){
		slider_point[i].addEventListener('click', action_slid_pointer)
	}

	window.addEventListener('scroll', scrollAction)
	
	window.onresize = function(){
		clientWidth = document.documentElement.clientWidth
		if(clientWidth < 640){
			document.querySelector('.slider_img_cont').addEventListener('pointerdown' , slider_down)
		}
		if(clientWidth >= 640){
			document.querySelector('.slider_img_cont').removeEventListener('pointerdown', slider_down)
			clearInterval(slider_obj.id_interval)
			clearTimeout(slider_obj.id_timeout)
		}
	}

	if(clientWidth < 640){
		document.querySelector('.slider_img_cont').addEventListener('pointerdown' , slider_down)
	}

	function scrollAction(e){
		if(slider_obj.fl_scroll){
			let slid = document.querySelector('.portfolio_section').getBoundingClientRect()
			if(slid.y - document.documentElement.clientHeight < -300){
				if(clientWidth < 640){		
					slider_action_right()
					slider_obj.id_interval = setInterval(slider_action_right, 3000)
					slider_obj.fl_scroll = false
				}
			}
		}
	}

	function slider_down(e){
		slider_obj.moveY = e.clientY
		clearInterval(slider_obj.id_interval)
		clearTimeout(slider_obj.id_timeout)
		let slid_cont = document.querySelector('.slider_img_cont')
		slid_cont.ondragstart = () => false
		slider_obj.fl_move = false
		slider_obj.fl_location = true
		e.preventDefault()
		let act = document.querySelector('.slider_img_action')
		act.querySelector('.blue_filter').style.background = "transparent"
		slider_obj.firstX  = e.clientX
		document.addEventListener("pointerup", slider_up)
		document.addEventListener('pointermove', slider_move)
	}

	function slider_move(e){
		slider_obj.fl_move = true
		let act = document.querySelector('.slider_img_action')
		let left = document.querySelector('.slider_img_left')
		let right = document.querySelector(".slider_img_right")
		if(Date.now()> slider_obj.time_shtamp){
			slider_obj.fl_location = false
			slider_obj.secondX = e.clientX
			window.scrollBy(0, slider_obj.moveY - e.clientY)
			slider_obj.moveY = e.clientY
			
			if(e.clientX > slider_obj.firstX ){
				let sum = (e.clientX - slider_obj.firstX )
				act.style.transition = "unset"
				act.style.left = sum + "px"
				left.style.transition = "unset"
				left.style.left = "-"+(clientWidth - sum) + "px"
			}
			if(e.clientX < slider_obj.firstX ){
				let sum = slider_obj.firstX  - e.clientX
				act.style.transition = "unset"
				act.style.left = "-"+(sum + "px")
				right.style.transition = "unset"
				right.style.left = (clientWidth - sum) + "px"
			}
		}
	}

	function slider_up(e){
		slider_obj.id_timeout = setTimeout(()=>{
			slider_obj.id_interval = setInterval(slider_action_right, 3000)
		}, 3000)
		let a = document.querySelector('.slider_img_action')
		a.querySelector('.blue_filter').style.background = ""
		document.removeEventListener('pointermove', slider_move)
		document.removeEventListener('pointerup', slider_up)
		let res = slider_obj.secondX - slider_obj.firstX 
		let act = document.querySelector('.slider_img_action')
		let left = document.querySelector('.slider_img_left')
		let right = document.querySelector(".slider_img_right")
		if(slider_obj.fl_move){
			if(res > 0){
				if(res > 40){
					if(Date.now() > slider_obj.time_shtamp){
						slider_obj.time_shtamp = Date.now() + 500
						act.classList = "slider_img_right"
						left.classList = "slider_img_action"
						right.classList = "slider_disp_none"
						let previos = left.previousElementSibling
						if(previos){
							previos.classList = "slider_img_left"
						}else{
							let child = document.querySelector('.slider_img_cont').children
							child[child.length-1].classList = "slider_img_left"
						}						
						let prev_point = document.querySelector('.pointer_active').previousElementSibling
						if(prev_point){
							document.querySelector('.pointer_active').classList.remove('pointer_active')
							prev_point.classList.add('pointer_active')
						}else{
							document.querySelector('.pointer_active').classList.remove('pointer_active')
							let child = document.querySelector('.pointer_cont').children
							child[child.length - 1].classList.add('pointer_active')
						}
					}
				}
			}
			if(res < 0){
				if(res < -40){
					if(Date.now()> slider_obj.time_shtamp){
						slider_obj.time_shtamp = Date.now() + 500
						let next = right.nextElementSibling
						if(next){
							next.classList = "slider_img_right"
						}else{
							document.querySelector('.slider_img_cont').children[0].classList = "slider_img_right"
						}
						act.classList = "slider_img_left"
						right.classList = "slider_img_action"
						left.classList = "slider_disp_none"

						let next_point = document.querySelector('.pointer_active').nextElementSibling
						if(next_point){
							document.querySelector('.pointer_active').classList.remove('pointer_active')
							next_point.classList.add('pointer_active')
						}else{
							let child = document.querySelector('.pointer_cont').children
							document.querySelector('.pointer_active').classList.remove('pointer_active')
							child[0].classList.add('pointer_active')
						}
					}
				}
			}
			act.style.transition = ""
			right.style.transition = ""
			left.style.transition = ""
			act.style.left = ""
			right.style.left = ""
			left.style.left = ""
		}
	}	

	function action_slid_pointer(){
		function reset_trans(){
			for(let i = 0; i<img_cont.length; i++){
				img_cont[i].style.transition = ""
			}
		}
		let speed_trans = 100
		let pointer = document.querySelectorAll(".slider_point")
		let ind_act, ind_this

		clearInterval(slider_obj.id_interval)
		clearTimeout(slider_obj.id_timeout)
		slider_obj.id_timeout = setTimeout(()=>{
			slider_obj.id_interval = setInterval(slider_action_right, 3000)
		}, 3000)


		if(this.classList.contains('pointer_active')){
			return
		}
		for(let i =0; i<pointer.length; i++){
			if(this == pointer[i]){
				ind_this = i
			}
			if(pointer[i].classList.contains('pointer_active')){
				ind_act = i
			}
		}		
		
		let img_cont = document.querySelectorAll(".slider_img_cont div")
		for(let i = 0; i<img_cont.length; i++){
			img_cont[i].style.transition = "left .100s linear"
		}
		
		let resul = ind_this - ind_act
		let time_resul = resul
		if(resul < 0){
			time_resul = resul * -1
		}
	
		if(Date.now() > slider_obj.time_shtamp){
			slider_obj.time_shtamp = Date.now() + time_resul * speed_trans		
			if(resul > 0){
				for(let i = 0; i<resul; i++){
					setTimeout(slider_action_right, speed_trans * i, null, false)
					if(i+1 == resul){
						setTimeout(reset_trans, (i+1) * speed_trans)
					}
				}
			}else{
				resul = resul * -1
				for(let i = 0; i<resul; i++){
					setTimeout(slider_action_left, speed_trans * i,null, false)
					if(i+1 == resul){
						setTimeout(reset_trans, (i+1) * speed_trans)
					}
				}
			}
		}
	}

	function slider_action_right(e, time_req = true){
		if(time_req){
			if(Date.now() > slider_obj.time_shtamp){
				slider_obj.time_shtamp = Date.now() + (500)
				fl = true
			}else{
				fl = false
			}
		}else{
			fl = true
		}
		if(fl){
			let img_r = document.querySelector('.slider_img_right')
			let img_a = document.querySelector('.slider_img_action')
			let img_l = document.querySelector('.slider_img_left')

			let next_right = img_r.nextElementSibling
			img_a.classList = "slider_img_left"
			img_l.classList = "slider_disp_none"
			img_r.classList = "slider_img_action"
			

			let activ_pointer = document.querySelector('.pointer_active')
			let next_pointer = activ_pointer.nextElementSibling
			activ_pointer.classList.remove('pointer_active')
			if(next_pointer){
				next_pointer.classList.add('pointer_active')
			}else{
				document.querySelector('.pointer_cont').children[0].classList.add('pointer_active')
			}

			if(next_right){
				next_right.classList = "slider_img_right"
			}else{
				document.querySelector('.slider_img_cont').children[0].classList = 'slider_img_right'
			}
		}
	}

	function slider_action_left(e, time_req = true){
		let fl
		if(time_req){
			if(Date.now() > slider_obj.time_shtamp){
				slider_obj.time_shtamp = Date.now() + 500
				fl = true
			}else{
				fl = false
			}
		}else{
			fl = true
		}
		if(fl){
			let img_r = document.querySelector('.slider_img_right')
			let img_a = document.querySelector('.slider_img_action')
			let img_l = document.querySelector('.slider_img_left')

			let previos = img_l.previousElementSibling

			img_l.classList = "slider_img_action"
			img_a.classList = "slider_img_right"
			img_r.classList = "slider_disp_none"

			let activ_pointer = document.querySelector('.pointer_active')
			let next_pointer = activ_pointer.previousElementSibling
			activ_pointer.classList.remove('pointer_active')
			if(next_pointer){
				next_pointer.classList.add('pointer_active')
			}else{
				let chil_p = document.querySelector('.pointer_cont').children
				chil_p[chil_p.length - 1].classList.add('pointer_active')
			}

			if(previos){
				previos.classList = "slider_img_left"
			}else{
				let child = document.querySelector('.slider_img_cont').children
				child[child.length -1].classList = "slider_img_left"
			}
		}
	}
})