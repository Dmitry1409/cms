let totalAct_fl = false
let dataProd = {}
getAllProd()

async function getAllProd(){
	let res = await fetch("api/getAllprodPricing.php")
	js = await res.json()
	for(i=0; i<js.length; i++){
		dataProd[js[i]['id']] = js[i]
	}
}

function totalAction(){
	if(!totalAct_fl){
		plusAction()
		let tr = document.querySelector("tbody").querySelector('tr:last-child')
		tr.querySelector('input[name=name]').value = "Итого"
		totalAct_fl = true
	}
	let tr = document.querySelectorAll(".tableWrap tbody tr")
	let sum = 0
	for(let i=0; i<tr.length; i++){
		let inp = tr[i].querySelectorAll("input")
		if(inp[0].value == "Итого"){
			inp[4].value = sum
			continue
		}
		sum += Number(inp[4].value)
	}
	
}

function getTextSumm(sum){
	let ob = {"1": "одна тысяча",
				"2": "две тысячи",
				"3": "три тысячи",
				"4": "четыре тысячи",
				"5": "пять тысяч",
				"6": "шесть тысяч",
				"7": "семь тысяч",
				"8": "восемь тысяч",
				"9": "девять тысяч"
				}

	let ob2 = {
		"1": "сто",
		"2": "двести",
		"3": "триста",
		"4": "четыреста",
		"5": "пятьсот",
		"6": "шестьсот",
		"7": "семьсот",
		"8": "восемьсот",
		"9": "девятьсот",
	}
	let ob3 ={
		"1":"один",
		"2":"два",
		"3":"три",
		"4":"четыре",
		"5":"пять",
		"6":"шесть",
		"7":"семь",
		"8":"восемь",
		"9":"девять",
	}
	let ob4 ={
		"2":"двадцать",
		"3":"тридцать",
		"4":"сорок",
		"5":"пятьдесят",
		"6":"шестьдесят",
		"7":"семьдесят",
		"8":"восемьдесят",
		"9":"девяносто"
	}
	let ob5 = {
		"10":"десять",
		"11":"одиннадцать",
		"12":"двенадцать",
		"13":"тринадцать",
		"14":"четырнадцать",
		"15":"пятнадцать",
		"16":"шестнадцать",
		"17":"семнадцать",
		"18":"восемнадцать",
		"19":"девятнадцать"
	}

	sum = String(sum)
	out = ""
	if(sum.length == 4){
		out += ob[sum[0]][0].toUpperCase() +  ob[sum[0]].slice(1)
		out += " "
		if(sum[1] != "0"){
			out += ob2[sum[1]]
			out += " "
		}	
	
		if(Number(sum.slice(2))>= 20){
			out += ob4[sum[2]]
			out += " "
			out += ob3[sum[3]]
		}else{			
			if(Number(sum.slice(2) >= 10 && Number(sum.slice(2) <= 19))){
				out += ob5[sum.slice(2)]
			}else{
				if(sum[3] !="0"){
					out += ob3[sum[3]]
				}
			}
		}		
	}else if(sum.length == 5){
		if(Number(sum.slice(0, 2))>= 20){
			out += ob4[sum[0]][0].toUpperCase() + ob4[sum[0]].slice(1)
			out += " "
			if(sum[1] != "0"){
				out += ob[sum[1]]
			}else{
				out += "тысяч"
			}
		}else{
			out += ob5[sum.slice(0,2)][0].toUpperCase() + ob5[sum.slice(0,2)].slice(1)
			out += " тысяч"

		}
		if(sum[2]!="0"){
			out += " "
			out += ob2[sum[2]]
		}
		if(Number(sum.slice(3))>= 20){
			out += " "
			out += ob4[sum[3]]
			out += " "
			out += ob3[sum[4]]
		}else if(Number(sum.slice(3) >= 10 && Number(sum.slice(3) <= 19))){
			out += " "
			out += ob5[sum.slice(3)]
		}else{
			if(sum[4]!="0"){
				out += " "
				out += ob3[sum[4]]
			}
		}
	}else if(sum.length == 6){
		out += ob2[sum[0]][0].toUpperCase() + ob2[sum[0]].slice(1)
		if(Number(sum.slice(1,3)) >= 20){
			out += " "
			out += ob4[sum[1]]
			if(sum[2]!="0"){
				out += " "
				out += ob[sum[2]]
			}else {
				out += " тысяч"
			}
		}else if(Number(sum.slice(1,3)) <= 19 && Number(sum.slice(1,3)) >=10){
			out += " "
			out += ob5[sum.slice(1,3)]
			out += " тысяч"
		}else{
			if(sum[2] != "0"){				
				out += " "
				out += ob[sum[2]]
			}else{
				out += " тысяч"
			}
		}

		if(sum[3]!="0"){
			out += " "
			out += ob2[sum[3]]
		}
		if(Number(sum.slice(4))>= 20){
			out += " "
			out += ob4[sum[4]]
			if(sum[5]!="0"){
				out += " "
				out += ob3[sum[5]]
			}
		}else if(Number(sum.slice(4) >= 10 && Number(sum.slice(4) <= 19))){
			out += " "
			out += ob5[sum.slice(4)]
		}else{
			if(sum[5]!="0"){
				out += " "
				out += ob3[sum[5]]
			}
		}
	}


	if(out[out.length - 1] !=" "){
		out += " "
	}
	return out
}

function plusAction(){
	html = `<tr>
				<td><img class="close_png" src="/cms/img/close.png"></td>
				<td><input name='name' style="width: 200px;" type="text"></td>
				<td><input name='metr' style="width: 50px;" type="text"></td>
				<td><input name='count' style="width: 50px;" type="text"></td>
				<td><input name='price' style="width: 100px;" type="text"></td>
				<td><input name='sum' style="width: 100px;" type="text"></td>
			</tr>`
	document.querySelector("tbody").insertAdjacentHTML("beforeend", html)
	let c = document.querySelectorAll(".close_png")
	for(let i =0; i<c.length; i++){
		c[i].addEventListener("click", delAction)
	}
	let input_count = document.querySelectorAll("input[name=count], input[name=price]")
	for(let i=0; i<input_count.length; i++){
		input_count[i].addEventListener("input", changeInpCount)
	}
}

function delAction(){
	this.parentNode.parentNode.remove()
}

function changeInpCount(){
	let par = this.parentNode.parentNode
	let td = ""
	if(this.getAttribute("name") == "count"){
		td = "price"
	}else{
		td = "count"
	}

	let p = par.querySelector(`input[name=${td}]`)
	if(p.value != ""){
		if(this.value != ""){
			par.querySelector('input[name=sum]').value = p.value * this.value
		}
	}
	
}

window.addEventListener("DOMContentLoaded",()=>{


	document.querySelector("button[name=total]").addEventListener('click', totalAction)
	document.querySelector(".plus_png").addEventListener("click", plusAction)
	document.querySelector(".close_png").addEventListener("click", delAction)
	let input_count = document.querySelectorAll("input[name=count], input[name=price]")
	for(let i=0; i<input_count.length; i++){
		input_count[i].addEventListener("input", changeInpCount)
	}

	function insertProd(el){
		let id_pr = el.getAttribute("data_id")
		let lastRow = document.querySelector('tbody')
		lastRow = lastRow.querySelector('tr:last-child')
		let f_inp = lastRow.querySelector('td:nth-child(2)')
		f_inp = f_inp.querySelector('input')
		if(f_inp.value !=""){
			plusAction()
			lastRow = document.querySelector('tbody').querySelector('tr:last-child')
		}
		lastRow.querySelector("td:nth-child(2)").querySelector('input').value = dataProd[id_pr]['name']
		lastRow.querySelector("td:nth-child(3)").querySelector('input').value = dataProd[id_pr]['metric']
		lastRow.querySelector("td:nth-child(5)").querySelector('input').value = dataProd[id_pr]['price']
	}

	function liAction(e){
		if(e.target != e.currentTarget){
			return
		}
		let ch_ul = this.childNodes[1]
		if(!ch_ul){
			if(this.getAttribute('data_id')){
				insertProd(this)
			}
			return
		}
		if(ch_ul.classList.contains("openul")){
			let all_open_child_ul = this.querySelectorAll(".openul")
			let sum_px = all_open_child_ul[0].scrollHeight
			for(let i=0; i<all_open_child_ul.length; i++){
				all_open_child_ul[i].style.height = ""
				all_open_child_ul[i].classList.remove("openul")
			}
			let fl = true
			let ev = "ch_ul"
			while(fl){
				ev += ".parentNode"
				let p = eval(ev)
				if(p.tagName == "UL"){
					if(p.classList.contains("openul")){
						p.style.height = (p.scrollHeight - sum_px) + "px"
					}else{
						fl = false
					}
				}
			}
		}else{		
			let fl = true
			let ev = "this"
			while(fl){
				ev += ".parentNode"
				let p = eval(ev)
				if(p.tagName == "UL"){
					if(p.classList.contains("openul")){
						p.style.height = (p.scrollHeight + ch_ul.scrollHeight) + "px"
					}else{
						fl = false
					}
				}
			}
			ch_ul.style.height = ch_ul.scrollHeight + "px"
			ch_ul.classList.add("openul")
		}
	}

	let li = document.querySelectorAll("li")
	for(let i = 0; i<li.length; i++){
		li[i].addEventListener('click', liAction)
	}

})