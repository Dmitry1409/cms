

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

let YDTargetFunc = function(tarId){
	ym(91462500,'reachGoal', tarId)
}


let id_timeout_subMenu1
let id_timeout_subMenu2

initNumbMain = 0
window.addEventListener('DOMContentLoaded', ()=>{

	initNumbMain +=1


	if(initNumbMain == 1){
		let venLinkId = document.querySelector('#vendorsLinkId')
		if(venLinkId){
			venLinkId.addEventListener('click', ()=>{
				if(location.pathname == root_dir){
					if(clientWidth < 940){
						btn_action()
					}
					vendorsSectionId.scrollIntoView({
						'behavior': 'smooth'
					})
				}else{
					location.href = location.origin+root_dir+"#vendorsSectionId"
				}
			})
		}


		let footerRooms = document.querySelectorAll(".foot-room-item")
		if(footerRooms){
			for(let i =0; i<footerRooms.length; i++){
				footerRooms[i].addEventListener('click', footerRoomsAct)
			}
		}
		
		kontaktBtnId.addEventListener('click', ()=>{
			if(clientWidth < 940){
					btn_action()
				}
			kontaktSectId.scrollIntoView({
					'behavior': 'smooth'
				})
		})

		feedBackBtnId.addEventListener('click', ()=>{
			if(clientWidth < 940){
					btn_action()
				}
			feedBackId.scrollIntoView({
					'behavior': 'smooth'
				})
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
			if(exampWork)
				exampWork.scrollIntoView({
					'behavior': 'smooth'
				})
			if(clientWidth < 940){
				btn_action()
			}
		})

		questAnswerBtnId.addEventListener('click', ()=>{
				questAnswer.scrollIntoView({
					'behavior': 'smooth'
				})
				if(clientWidth < 940){
					btn_action()
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

		checkCurrentLocation()

		
		checkMaskTel()
	}

	if(initNumbMain == 2){
		let venLinkId = document.querySelector('#vendorsLinkId')
		if(venLinkId){
			venLinkId.addEventListener('click', ()=>{
				if(location.pathname == root_dir){
					vendorsSectionId.scrollIntoView({
						'behavior': 'smooth'
					})
				}else{
					location.href = location.origin+root_dir+"#vendorsSectionId"
				}
			})
		}
		checkMaskTel()
	} 


	let footerRooms = document.querySelectorAll(".foot-room-item")
	if(initNumbMain == 2){
		if(footerRooms){
			for(let i =0; i<footerRooms.length; i++){
				footerRooms[i].addEventListener('click', footerRoomsAct)
			}
		}
	}
	

	let questBlocks = document.querySelectorAll('.questBlock')
	if(questBlocks){
		for(let i =0; i<questBlocks.length; i++){
			questBlocks[i].addEventListener('click', answerClickAction)
		}	
	}
	


	let idTimeOutAnswer

	

	function footerRoomsAct(){
		if(location.pathname.indexOf("favourites") > -1){
			location.href = location.origin+root_dir+"#exampWork_ancher"
		}
		let exampWork = document.querySelector('#exampWork')
		if(exampWork){
			exampWork.scrollIntoView({
				'behavior': 'smooth'
			})
			setTimeout(()=>{
				changeHashTag(this)
			},1000)
		}
	}
	function changeHashTag(span){
		let tags = document.querySelectorAll(".controlHashItem")
		span = span.innerText.toLowerCase()
		for(let i=0; i<tags.length; i++){
			if(tags[i].innerText.indexOf(span) > -1){
				let event = new Event('click')
				tags[i].dispatchEvent(event)
				return
			}
		}
	}

	async function checkMaskTel(){
		let r = await fetch(`${root_dir}scripts_php/maskTelHandler.php`)
		if(r.ok){
			let o = await r.text()
			if(o == "noClick"){
				insertMaskTel()
			}
		}
	}
	function insertMaskTel(){
		let html = `<div class="mask-tel">
						<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 width="70%" height="70%" viewBox="0 0 512 512" fill="rgba(255,255,255, 0.9)" xml:space="preserve">
							<path d="M256,96C144.341,96,47.559,161.021,0,256c47.559,94.979,144.341,160,256,160c111.656,0,208.439-65.021,256-160
								C464.441,161.021,367.656,96,256,96z M382.225,180.852c30.082,19.187,55.572,44.887,74.719,75.148
								c-19.146,30.261-44.639,55.961-74.719,75.148C344.428,355.257,300.779,368,256,368c-44.78,0-88.428-12.743-126.225-36.852
								c-30.08-19.188-55.57-44.888-74.717-75.148c19.146-30.262,44.637-55.962,74.717-75.148c1.959-1.25,3.938-2.461,5.929-3.65
								C130.725,190.866,128,205.613,128,221c0,70.691,57.308,128,128,128c70.691,0,128-57.309,128-128
								c0-15.387-2.725-30.134-7.703-43.799C378.285,178.39,380.266,179.602,382.225,180.852z M256,205c0,26.51-21.49,48-48,48
								s-48-21.49-48-48s21.49-48,48-48S256,178.49,256,205z"/>
						</svg>
					</div>`

		let headcont = document.querySelector('.tel-rel')
		let footercont = document.querySelector('.footer_inf_cont')
		if(!headcont.querySelector('.mask-tel')){
			headcont.insertAdjacentHTML('afterbegin', html)
			headcont.addEventListener('click', maskTelClickAction)
		}
		if(footercont){
			footercont.insertAdjacentHTML('afterbegin', html)
			footercont.addEventListener('click', maskTelClickAction)
		}	
	}
	function maskTelClickAction(){
		let allMask = document.querySelectorAll('.mask-tel')
		for(let i=0; i<allMask.length; i++){
			allMask[i].remove()
		}
		let headcont = document.querySelector('.tel-rel')
		let footercont = document.querySelector('.footer_inf_cont')
		if(footercont){
			footercont.removeEventListener('click', maskTelClickAction)
		}
		headcont.removeEventListener('click', maskTelClickAction)
		sendMaskTelClick()
	}

	async function sendMaskTelClick(){
		fetch(`${root_dir}scripts_php/maskTelHandler.php?click=yes`)
		YDTargetFunc('3244353252')
	}

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

window.addEventListener('load', ()=>{
	let idBanIntrv
	let idBanTimOut
	let valTimeout = 5000

	let bannerTimeProtect = Date.now()
	let banButt = document.querySelectorAll('.headerContrlItem')
	if(banButt){
		for(let i = 0; i<banButt.length; i++){
			banButt[i].addEventListener('click', bannerAction)
		}
	}

	getAllBanner()
	setIntBann()

	function setIntBann(){
		idBanTimOut = setTimeout(()=>{
			let rb = document.querySelector('.rightButBan')
			let e = new Event("click")
			e.auto = true
			rb.dispatchEvent(e)
			idBanIntrv = setInterval(()=>{
				rb.dispatchEvent(e)
			}, 5000)
		}, valTimeout)
	}

	function bannerAction(e){
		function chPoint(fl){
			let p = document.querySelectorAll('.bannPoint div')
			let ip
			for(let i=0; i<p.length; i++){
				if(p[i].classList.contains('banPointAct')){
					ip = i
					break
				}
			}
			let next
			if(fl =="r"){
				if(ip + 1 == p.length){
					next = 0
				}else{
					next = ip + 1
				}
			}else{
				if(ip == 0){
					next = p.length - 1
				}else{
					next = ip - 1
				}
			}
			p[ip].classList = ""
			p[next].classList = "banPointAct"
		}
		function chSpan(nodSpan, text){
			let sa
			let sna
			if(nodSpan[0].classList.contains("banner_active")){
				sa = nodSpan[0]
				sna = nodSpan[1]
			}else{
				sa = nodSpan[1]
				sna = nodSpan[0]
			}
			
			sa.classList = "banner_opac_z"
			sna.innerText = text
			sna.classList = "banner_active"
			setTimeout(()=>{
				sa.innerText = text
			},3000)
		}

		if(Date.now() > bannerTimeProtect){
			if(!e.auto){
				clearTimeout(idBanTimOut)
				clearInterval(idBanIntrv)
				valTimeout = 10000
				setIntBann()
			}	
			let p = document.querySelectorAll('.header_lozung picture')
			let ai
			for(let i=0; i<p.length; i++){
				if(p[i].classList.contains('banner_active')){
					ai = i
					break;
				}
			}
			let next 
			if(this.classList.contains('rightButBan')){
				chPoint('r')
				if(ai + 1 == p.length){
					next = 0
				}else{
					next = ai + 1
				}
			}else{
				chPoint('l')
				if(ai - 1 < 0){
					next = p.length - 1
				}else{
					next = ai - 1
				}
			}
			p[ai].classList.add("banner_opac_z")
			p[ai].classList.remove('banner_active')
			setTimeout(()=>{
				p[ai].classList.add('banner_dis_none')
			},3000)

			p[next].classList.remove('banner_dis_none')
			setTimeout(()=>{
				p[next].classList.add('banner_active')
				p[next].classList.remove('banner_opac_z')
			},30)

			let span1 = document.querySelector('.header_title_wrapp > span:first-child').querySelectorAll("span")
			let span2 = document.querySelector('.header_title_wrapp > span:nth-child(2)').querySelectorAll("span")

			chSpan(span1, p[next].getAttribute('mainText'))

			chSpan(span2, p[next].getAttribute('secText'))
	
			bannerTimeProtect = Date.now() + 3000
		}
	}

	async function getAllBanner(){
		let r = await fetch(`${root_dir}scripts_php/getAllBanner.php`)
		let a =  await r.json()
		insertBanner(a)
		insertBannerPoint(a)
	}
	function insertBannerPoint(a){
		let cont = document.querySelector(".bannPoint")
		for(let i = 0; i<a.length; i++){
			let d = document.createElement('div')
			if(i == 0){
				d.classList = "banPointAct"
			}
			cont.append(d)
		}
	}
	function insertBanner(arr){
		let p = document.querySelector(".header_lozung")
		let imgIdRow = p.querySelector("picture").getAttribute('idRow')
		for(let i = 0; i<arr.length; i++){
			let w = arr[i]['imgSrc'].split(".")[0]
			w = `${root_dir}img/rekHeader/webp/${w}.webp`
			let h = `<picture class = 'headerPicture banner_dis_none banner_opac_z' idRow=${arr[i]['id']} maintext='${arr[i]["mainText"]}' sectext='${arr[i]["secText"]}'>
						<source srcset='${w}' type='image/webp'/>
						<img src=${root_dir}img/rekHeader/jpg/${arr[i]['imgSrc']}>
					</picture>`

				if(imgIdRow != arr[i]['id']){
					p.insertAdjacentHTML('beforeend', h)
				}
		}
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
					checkedAndSendYandexDirect()
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
async function checkedAndSendYandexDirect(){
	let ch = await fetch(`${root_dir}scripts_php/checkYDTarget.php`)
	if(ch.ok){
		let ch_ot = await ch.text()
		if(ch_ot == "nosend"){
			if(YDTargetFunc){
				YDTargetFunc('323513')
			}
		}
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