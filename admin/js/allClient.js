window.addEventListener("DOMContentLoaded", ()=>{
	document.querySelector('.addClientId').addEventListener("click", addClient)
	let addTelButt = document.querySelectorAll('.addTelID')
	for(let i=0; i<addTelButt.length; i++){
		addTelButt[i].addEventListener('click', addTelAction)
	}
	let addObjButt = document.querySelectorAll('.addObjID')
	for(let i=0; i<addObjButt.length; i++){
		addObjButt[i].addEventListener('click', addObjAction)
	}

	function addObjAction(){
		let html = `<select>
						<option value="статус">статус</option>
						<option value="нужно">нужно</option>
						<option value="сделано">сделано</option>
						<option value="сделано не удачно">сделано не удачно</option>
						<option value="отказ">отказ</option>
					</select>
					<input autocomplete="off" placeholder='Тип объекта' type='text'>
					<input autocomplete="off" placeholder='Описание' type='text'>
					<input autocomplete="off" placeholder='Адрес' type='text' >`
		this.insertAdjacentHTML('beforebegin', html)
		this.removeEventListener('click', addObjAction)
		this.onclick = addObjFetch
	}

	async function addObjFetch(){
		let inpts = this.parentNode.querySelectorAll('input')
		let sel = this.parentNode.querySelector('select')
		if(sel.value == "статус"){
			sel.style.border = "1px solid red"
			return
		}else{
			sel.style.border = ""
		}
		if(!inpts[0].value){
			inpts[0].style.border = "1px solid red"
			return
		}else{
			inpts[0].style.border = ""
		}
		if(!inpts[1].value){
			inpts[1].style.border = "1px solid red"
			return
		}else{
			inpts[1].style.border = ""
		}
		let tr = this.parentNode.parentNode.parentNode
		
		let fd = new FormData()
		fd.append('status', sel.value)
		fd.append('type', inpts[0].value)
		fd.append('description', inpts[1].value)
		fd.append('client_id', tr.getAttribute('client_id'))
		if(inpts[2].value){
			fd.append('address', inpts[2].value)
		}
		fd.append('comand', "addObject")
		let res = await fetch('handlerCRM.php', {method: "POST", body: fd})
		checkRespond(res)
		// console.log(await res.text())
			
	}
	 async function checkRespond(res){
		if(res.ok){
			let ot = await res.text()
			if(ot == 'succes'){
				showMsg()
			}else{
				showMsg("r", ot)
			}
		}else{
			showMsg('r', `Проблемы с запросом. Статус: ${res.status}`)
		}
	}

	function addTelAction(){
		let html = "<input class='newTelId' placeholder='Телефон' type='number'>"
		this.insertAdjacentHTML('beforebegin', html)
		this.removeEventListener('click', addTelAction)
		this.onclick = addTelFetch
	}
	async function addTelFetch(){
		let tr = this.parentNode.parentNode
		let cl_id = tr.getAttribute("client_id")
		let inp = tr.querySelector('.newTelId')
		if(!inp.value){
			inp.style.border = "1px solid red"
			return
		}else{
			inp.style.border = ""
		}
		let fd = new FormData()
		fd.append('client_id', cl_id)
		fd.append('tel', inp.value)
		fd.append('comand', "addPhone")
		let res = await fetch('handlerCRM.php', {method: 'POST',body: fd})
		checkRespond(res)
	}

	async function addClient(){
		let inputs = document.querySelectorAll('.addClientWrap input, .addClientWrap textarea')
		let par = `?comand=addClient`
		if(inputs[0].value){
			par += `&name=${inputs[0].value}`
		}
		if(inputs[1].value){
			par+= `&tel=${inputs[1].value}`
			inputs[1].style.border = ""
		}else{
			inputs[1].style.border = "1px solid red"
			return
		}
		if(inputs[2].value){
			par += `&address=${inputs[2].value}`
		}
		if(inputs[3].value){
			par += `&type=${inputs[3].value}`
			inputs[3].style.border = ""
		}else{
			inputs[3].style.border = '1px solid red'
			return
		}
		if(inputs[4].value){
			par += `&desc=${inputs[4].value}`
			inputs[4].style.border = ""
		}else{
			inputs[4].style.border = "1px solid red"
			return
		}
		if(inputs[5].value){
			par += `&from=${inputs[5].value}`
		}

		let res = await fetch('handlerCRM.php'+par)
		let ot = await res.text()
		if(ot == "succes"){
			showMsg()
		}else{
			showMsg("r", ot)
		}
	}
	
})