

async function checkRespondServer(res){
	if(res.ok){	
		let text = await res.text()
		if(text == "succes"){
			showMsg()
			return true
		}else{
			showMsg('r', text)
			return false
		}
	}else{
		showMsg('r', `Проблемы с запросом. Статус: ${res.status}`)
		return false
	}
}

function showMsg(col='g', text='Успех'){
	let time
	let msg = document.querySelector('.msg')
	msg.innerText = text
	if(col == "g"){
		time = 2000
		msg.classList = 'msg_action msg_succ msg'
	}else if(col == "r"){
		time = 8000
		msg.classList = "msg_err msg_action msg"
	}
	setTimeout(()=>{
		msg.classList.remove('msg_action')
		msg.style.right = (-msg.offsetWidth)+"px"
	}, time)
}	