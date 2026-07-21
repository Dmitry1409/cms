window.addEventListener("DOMContentLoaded",()=>{
	document.querySelector('.lamp_button_down_id').addEventListener('click', lamp_down_act)
	let lamp_cont = document.querySelector('.track25_cvetil_cont')
	let lamp_item = document.querySelector('.track25_svet_grid_item')
	let span_count = document.querySelector('.lamp_count_id > span >span:first-child')
	console.log(lamp_item.scrollHeight)
	if(clientWidth < 700){
		lamp_cont.style.height = ((lamp_item.scrollHeight * 3)+12)+"px"
		span_count.innerText = '6' 
	}else{
		lamp_cont.style.height = ((lamp_item.scrollHeight * 2)+9)+"px" 
		span_count.innerText = '8'
	}
	function lamp_down_act(){
		lamp_cont.style.height = lamp_cont.scrollHeight + "px"
		span_count.innerText = "14"
	}
})