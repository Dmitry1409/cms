

let clientWidth = document.documentElement.clientWidth

window.addEventListener('resize', ()=>{
		clientWidth = document.documentElement.clientWidth
	})

let time_main_menu = Date.now()

// clientData = {
	// timeProtect: Date.now(),
	// dataProd: [{code:"", amount:""}],
	// dataCalc: {},
	// text_header: "Отправить заявку",
	// click_link: "",
	// foto_id: "",
	// foto_src: ['webp', "jpg"]
// }
let clientData = {}

const root_dir = "/cms/"

let id_timeout_subMenu1
let id_timeout_subMenu2




window.addEventListener('DOMContentLoaded', ()=>{


	feedBackBtnId.addEventListener('click', ()=>{
		if(location.pathname == root_dir){
			if(clientWidth < 940){
				btn_action()
			}
			feedBackId.scrollIntoView({
				'behavior': 'smooth'
			})
		}else{
			location.href = location.origin+root_dir+"#feedBackId_ancher"
		}
	})

	expressCalcBtnId.addEventListener('click', ()=>{
		if(location.pathname == root_dir){
			if(clientWidth < 940){
				btn_action()
			}
			expressCalc.scrollIntoView({
				'behavior': 'smooth'
			})
		}else{
			location.href = location.origin+root_dir+"#expressCalc_ancher"
		}
	})

	workExampBtnId.addEventListener('click', ()=>{
		if(location.pathname == root_dir){
			if(clientWidth < 940){
				btn_action()
			}
			exampWork.scrollIntoView({
				'behavior': 'smooth'
			})
		}else{
			location.href = location.origin+root_dir+"#exampWork_ancher"
		}
	})

	questAnswerBtnId.addEventListener('click', ()=>{
		if(location.pathname == root_dir){
			if(clientWidth < 940){
				btn_action()
			}
			questAnswer.scrollIntoView({
				'behavior': 'smooth'
			})
		}else{
			location.href = location.origin+root_dir+"#questAnswer_ancher"
		}
	})

	document.querySelectorAll('.virt_btn_menu')[0].addEventListener('click', btn_action)

	document.querySelector('.background_menu').addEventListener('click', btn_action)

	let sub_menu_btn = document.querySelectorAll('.sub_menu_btn')
	for(let i=0; i<sub_menu_btn.length; i++){
		sub_menu_btn[i].addEventListener('click', sub_menu_action)
	}

	document.querySelector('.call_me_container').addEventListener('click', order_a_call)
	document.querySelector('.close_modal').addEventListener('click', close_modal_action)
	document.querySelector('.modal_backgraund').addEventListener('click', close_modal_action)
	document.querySelector('.header_lozung a').addEventListener('click', call_me_action)
	document.querySelector('.call_me_send').addEventListener('click', sendMailWithData)
	document.querySelector('.modal_report').addEventListener('click', close_report_modal)

	let questBlocks = document.querySelectorAll('.questBlock')
	for(let i =0; i<questBlocks.length; i++){
		questBlocks[i].addEventListener('click', answerClickAction)
	}

	let idTimeOutAnswer

	checkCurrentLocation()

	function answerClickAction(){
		let openAnswer = document.querySelector('.openAnswer')
		let nextElem  = this.nextElementSibling
		if(openAnswer){
			openAnswer.style.height = "0px"
			openAnswer.classList.remove('openAnswer')
			let prev = openAnswer.previousElementSibling
			prev.querySelector('.answerIconCont div:last-child').style.opacity = ""
			if(openAnswer == nextElem){
				return
			}
		}
		clearTimeout(idTimeOutAnswer)
		nextElem.style.height = nextElem.scrollHeight +'px'
		nextElem.classList.add('openAnswer')
		this.querySelector('.answerIconCont div:last-child').style.opacity = 0

		idTimeOutAnswer = setTimeout(()=>{
			nextElem.style.height = '0px'
			nextElem.classList.remove('openAnswer')
			this.querySelector('.answerIconCont div:last-child').style.opacity = 1
		},20000)
	}

	
	function checkCurrentLocation(){
		let dirs = ['lightLines', 'multiLevel', 'dubleVisionPrint', 'carvedCelling', 'shadowProfil', 'ligthNiches', 'hiddenCurtain',
					'textureColor', 'starsSky', 'lighting', 'MSD', 'BAUF', 'Pongs', 'Teqtum', 'favourites']
		let href = window.location.href
		let a = document.querySelectorAll('.menu_flex_wrap a')
		for(let i = 0; i<dirs.length; i++){
			if(href.indexOf(dirs[i]) > -1){
				for(let k=0; k<a.length; k++){
					if(a[k].href.indexOf(dirs[i]) > -1){
						a[k].style.color = "var(--main-col-1)"
						let p = a[k].parentNode.parentNode
						if(p.classList.contains('cont_940')){
							p.style.color = "var(--main-col-1)"
						}
						return
					}
				}
			}
		}
		a[0].style.color = "var(--main-col-1)"
	}
})


function plusCountFavorMenu(){
	let span = document.querySelector('.favourIndex span')
	if(!span.innerText){
		span.innerText = 1
		span.classList.add("favour_count_menu")

	}else{
		span.innerText = Number(span.innerText) + 1
	}
}

function delWarnigClassCalcult(){
	let inpArr = document.querySelectorAll('.calcul_body input')
	for(let i=0; i<inpArr.length; i++){
		inpArr[i].classList.remove('invalidValueCalculate')
	}
}
function reset_calcult(){
	delWarnigClassCalcult()
	delValueInputCalcult()
	delResultCalcult()
}
function delValueInputCalcult(){
	let inpArr = document.querySelectorAll('.calcul_body input')
	for(let i=0; i<inpArr.length; i++){
		inpArr[i].value = ""
	}
}
function delResultCalcult(){
	let cont = document.querySelector('.calcult_result_cont')
	if(cont){
		cont.remove()
	}
}
function showCalcultAnim(elem){
	let divs_btn = elem.querySelectorAll('div')
	elem.style.color = "transparent"
	divs_btn[0].classList.add('display_none')
	divs_btn[1].classList.remove('display_none')
	divs_btn[2].classList.remove('display_none')
}
function delAnimCalcut(elem){
	let divs_btn = elem.querySelectorAll('div')
	elem.style.color = ""
	divs_btn[0].classList.remove('display_none')
	divs_btn[1].classList.add('display_none')
	divs_btn[2].classList.add('display_none')
}
function insertResultCalcult(elem_anchor, position, sum, discount){
	let html = `<div class='calcult_result_cont'>
					<div>
						<span><span id=calc_sum>${sum}</span><span> руб/под ключ</span></span>
						<span><span id=calc_discount>${discount}</span><span> руб/скидка</span></span>
					</div>
					<div>
						<div class='calc_result_btn'>Сбросить</div>
						<div class='calc_result_btn'>Отправить заявку</div>
					</div>
				</div>`
	elem_anchor.insertAdjacentHTML(position, html)
}
function send_order_calc(){
	let inp = document.querySelectorAll('.calcul_body input')
	let ordObj = {}

	for(let i =0; i<inp.length; i++){
		if(inp[i].value && inp[i].value > 0){
			let key = inp[i].getAttribute('placeholder')
			ordObj[key] = inp[i].value
		}
	}
	ordObj['Сумма'] = document.querySelector('#calc_sum').innerText
	ordObj['Скидка'] = document.querySelector('#calc_discount').innerText
	clientData.dataCalc = ordObj
	
	call_me_view()
}
function open_report_modal(msg_header, msg_body ){
	let h2 = document.querySelector('.report_box h2')
	let p = document.querySelector('.report_box p')

	if(msg_header){
		h2.innerText = msg_header
	}else{
		h2.innerText = "Ваше сообщение доставлено!"
	}
	if(msg_body){
		p.innerText = msg_body
	}else{
		p.innerText = "С вами свяжутся в течении не более 30 мин."
	}

	let cont = document.querySelector('.modal_report')
	cont.style.display = "flex"
	setTimeout(()=>{
		cont.style.opacity = 1
	},10)
}
function reset_call_me_box(){

	document.querySelector('.call_me_cont input[type="checkbox"]').checked = false
	let nameField = document.querySelector('.call_me_cont input[name="call_me_name"]')
	let phoneField = document.querySelector('.call_me_cont input[name="call_me_phone"]')
	nameField.classList.remove('invalidField')
	nameField.value = ""
	phoneField.classList.remove('invalidField')
	phoneField.value = ""
	document.querySelector('.call_me_checkbox span').classList.remove('invalidFormText')
}
function close_report_modal(e){
	let cont = document.querySelector('.modal_report')
	cont.style.opacity = 0
	
	reset_call_me_box()

	setTimeout(()=>{
		cont.style.display = 'none'
		close_modal_action()
	},410)
}
function close_modal_action(e){
	let modal = document.querySelector('.modal_call_me')
	let cont = modal.querySelector('.call_me_cont')
	setTimeout(()=>{
		cont.style.height = "2px"
		cont.style.paddingTop = "unset"
		cont.style.paddingBottom = "unset"
		cont.style.overflow = "hidden"
		document.querySelector('.close_modal').style.display = "none"
	}, 100)
	setTimeout(()=>{
		cont.style.paddingLeft = 'unset'
		cont.style.paddingRight = "unset"
		cont.style.width = "2px"
	}, 1100)
	setTimeout(()=>{
		modal.style.display = "none"
	}, 1300)

	let picture = document.querySelector('.call_me_cont picture')
	if(picture){
		setTimeout(()=>{
			picture.remove()
		}, 1400)
	}
	reset_call_me_box()
	clientData = {}
}
async function sendMailWithData(){
	if(isValidClientFields()){
		let name = document.querySelector('.call_me_cont input[name="call_me_name"]').value
		let phone = document.querySelector('.call_me_cont input[name="call_me_phone"]').value
		let query = `${root_dir}mailer/send_mail.php?name=${name}&phone=${phone}&click_link=${clientData.click_link}`

		if(clientData.dataProd){
			query += `&dataProd=${JSON.stringify(clientData.dataProd)}`
		}
		if(clientData.dataCalc){
			query += `&dataCalc=${JSON.stringify(clientData.dataCalc)}`
		}
		if(clientData.foto_id){
			query += `&foto_id=${clientData.foto_id}`
		}
		let animateBtn = document.querySelector('.call_me_cont .call_me_send')
		reset_call_me_box()
		showCalcultAnim(animateBtn)

		let res = await fetch(query)
		let report = await res.text()


		setTimeout(()=>{
			delAnimCalcut(animateBtn)
			if(res.ok){					
				if(report == "success"){
					reset_calcult()
					open_report_modal()
				}else{
					let m = "Ваше сообщение не доставлено!"
					let b = `Сообщите пожалуйста администратору сайта об ошибке: ${report}`
					open_report_modal(m, b)
				}
			}else{
				let m = "Ваше сообщение не доставлено!"
				let b = `Сообщите пожалуйста администратору сайта об ошибке. Код ошибки: ${res.status}`
				open_report_modal(m, b)
			}

		},1000)

		
		
		clientData = {}
	}	
}
function isValidClientFields(){
	let fl = true
	let rexName = /^[a-zа-яё .]{3,50}$/i
	let rexPhone = /^[0-9+-]{5,}$/
	let nameField = document.querySelector('.call_me_cont input[name="call_me_name"]')
	let phoneField = document.querySelector('.call_me_cont input[name="call_me_phone"]')
	let checkBox = document.querySelector('.call_me_cont input[type="checkbox"]')
	let checkBoxText = document.querySelector('.call_me_checkbox span')

	if(!isValidText(nameField, rexName, "invalidField")) fl = false
	if(!isValidText(phoneField, rexPhone, "invalidField")) fl = false
	if(!checkBox.checked){
		fl = false
		addWarningField(checkBoxText, "invalidFormText")
	}else{
		removeWarning(checkBoxText)
	}

	return fl

	function removeWarning(elem){
		elem.classList.remove('invalidFormText')
		elem.classList.remove('invalidField')
	}

	function isValidText(field, rex, cls){
		let val = field.value
		if(val){
			if(rex.test(val)){
				removeWarning(field)
				return true
			}else{
				addWarningField(field, cls)
			}
		}else{
			addWarningField(field, cls)
		}
		return false
	}
}
function addWarningField(elem, cls){
	elem.classList.add(cls)
	setTimeout(()=>{
		elem.classList.remove(cls)
	}, 50)
	setTimeout(()=>{
		elem.classList.add(cls)
	}, 100)
	setTimeout(()=>{
		elem.classList.remove(cls)
	}, 150)
	setTimeout(()=>{
		elem.classList.add(cls)
	}, 200)
}
function call_me_view(){
	let header = document.querySelector('form label')
	header.innerText = "Отправить заявку"
	if(clientData.text_header){
		header.innerText = clientData.text_header
	} 

	if(clientData.foto_src){
		let checkbox = document.querySelector('.call_me_checkbox')
		html = `<picture>
					<source srcset=${clientData.foto_src[0]} type=image/webp>
					<img src=${clientData.foto_src[1]}>
				</picture>`
		checkbox.insertAdjacentHTML('afterend', html)
	}

	let modal = document.querySelector('.modal_call_me')
	modal.style.display = "flex"
	let cont = modal.querySelector('.call_me_cont')
	setTimeout(()=>{
		cont.style.width = "300px"
		cont.style.paddingLeft = "30px"
		cont.style.paddingRight = "30px"
	}, 200)
	setTimeout(()=>{
		cont.style.height = cont.scrollHeight + 60 + "px"
		cont.style.padding = "30px"
	}, 400)
	setTimeout(()=>{
		cont.style.overflow = "unset"
		document.querySelector('.close_modal').style.display = "flex"
	}, 1000)
}
function call_me_action(){
	clientData.click_link = "Главный хедер оставить заявку"
	call_me_view()
}
function order_a_call(){
	clientData.click_link = "Главный хедер заказать звонок"
	clientData.text_header = "Перезвоните мне"
	call_me_view()
}
function subMenuMouseLeave(e){
	clearTimeout(id_timeout_subMenu2)
	id_timeout_subMenu2 = setTimeout(()=>{	
		setTimeout(()=>{
			this.removeEventListener('mouseleave', subMenuMouseLeave)	
			this.removeEventListener('mouseenter', subMenuMouseEnter)
			this.classList.remove('open_sub_menu')
			let arrow = this.previousElementSibling
			arrow.querySelector('span:last-child').classList.remove('subMenuarrowOpen')
		}, 100)
		this.style.height = 0
	}, 3000)
}
function subMenuMouseEnter(){
	clearTimeout(id_timeout_subMenu1)
	clearTimeout(id_timeout_subMenu2)
	this.addEventListener('mouseleave', subMenuMouseLeave)	
}
function sub_menu_action(){
	let subMenu = this.nextElementSibling
	let mainMenu = document.getElementsByClassName('menu_flex_wrap')[0]
	let arrow = this.querySelector('.sub_menu_btn span:last-child')
	if(subMenu.classList.contains('open_sub_menu')){
		if(clientWidth < 940){
			mainMenu.style.height = (mainMenu.scrollHeight - subMenu.scrollHeight) + "px"
		}
		closeSubMenu()
		arrow.classList.remove('subMenuarrowOpen')
	}else{
		checkAndCloseSubMenu()
		if(clientWidth < 940){
			mainMenu.style.height = (mainMenu.scrollHeight + subMenu.scrollHeight) + "px"
		}else{
			id_timeout_subMenu1 = setTimeout(()=>{
				closeSubMenu()
			},4000)
			subMenu.addEventListener('mouseenter', subMenuMouseEnter)
		}
		subMenu.classList.add('open_sub_menu')
		subMenu.style.height = subMenu.scrollHeight + "px"
		
		arrow.classList.add('subMenuarrowOpen')
	}
	function closeSubMenu(){
		setTimeout(()=>{
			subMenu.classList.remove('open_sub_menu')
			arrow.classList.remove('subMenuarrowOpen')
		},100)
		subMenu.style.height = 0
	}
}
function checkAndCloseSubMenu(){
	let allSubMenu = document.querySelectorAll('.sub_menu')
	for(let i=0; i<allSubMenu.length; i++){
		if(allSubMenu[i].classList.contains('open_sub_menu')){
			contextElem = allSubMenu[i].previousElementSibling
			let f = sub_menu_action.bind(contextElem)
			setTimeout(()=>{
				f()
			}, 10)
		}
	}
}
function btn_action(e){
	if(Date.now() > time_main_menu){
		time_main_menu = Date.now() + 510
		let lines = document.querySelectorAll('div.btn_line')
		let btn_menu = document.querySelector('.menu_btn')
		let virt_btn = document.querySelector('.virt_btn_menu')
		if(btn_menu.classList.contains('btn_line_open')){
			document.querySelector('.background_menu').style.opacity = 0
			setTimeout(()=>{
				document.querySelector('.background_menu').style.display = "none"
			}, 510)
			btn_menu.classList.remove('btn_line_open')
			btn_menu.style.right = "0"
			virt_btn.style.right = "0"
			document.querySelectorAll('.container_menu')[0].style.right = "-250px"
			lines[0].style.transform = "unset"
			lines[1].style.visibility = "unset"
			lines[2].style.transform = "unset"
			checkAndCloseSubMenu()
			
		}else{
			document.querySelector('.background_menu').style.display = "block"
			setTimeout(()=>{
				document.querySelector('.background_menu').style.opacity = 1
			}, 10)
			btn_menu.classList.add('btn_line_open')
			btn_menu.style.right = "250px"
			virt_btn.style.right = "250px"
			document.querySelectorAll('.container_menu')[0].style.right = "0px"
			lines[0].style.transform = "rotateZ(45deg) translateY(6px) translateX(6px)"
			lines[1].style.visibility = "hidden"
			lines[2].style.transform = "rotateZ(-45deg) translateY(-7px) translateX(6px)"
			
		}
	}
}