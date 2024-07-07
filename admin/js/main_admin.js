window.addEventListener("DOMContentLoaded", ()=>{

})



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