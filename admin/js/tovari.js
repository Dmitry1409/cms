
document.addEventListener("DOMContentLoaded",()=>{
	document.querySelector("input[name='search']").addEventListener('input', timeoutSearch)
	let idtimeout

	let td_table = document.querySelectorAll("tbody td:nth-child(n+2)")
	for(let i=0; i<td_table.length; i++){
		td_table[i].addEventListener('click', changeTableClick)
	}

	function changeTableClick(){
		let colname = this.getAttribute('colname')
		let attObj = {
			'name': 'name="name" style="width: 100%;" type="text"',
			'metric': 'name="metric" style="width: 30px;" type="text"',
			'price': 'name="price" style="width: 50px;" type="number"'
		}
		this.innerHTML = `<input ${attObj[colname]} value="${this.innerText}">`
		this.removeEventListener('click', changeTableClick)
		this.querySelector('input').addEventListener('change', tableChangeInput)
	}

	function tableChangeInput(){
		let rowid = this.parentNode.parentNode.getAttribute('rowid')
		let colname = this.getAttribute('name')
		if(confirm(`Поменять ${colname} на ${this.value} в строке ${rowid}`)){
			let fd = new FormData()
			fd.append('comand', "change_fild")
			fd.append('table', 'complect')
			fd.append('rowid', rowid)
			fd.append('tabcol', colname)
			fd.append('newval', this.value)
			fetch_change_result(fd)

		}
	}

	async function timeoutSearch(t){
		if(idtimeout){
			clearTimeout(idtimeout)
			idtimeout = setTimeout(fetchSearch.bind(null, this.value), 300)
		}else{
			idtimeout = setTimeout(fetchSearch.bind(null,this.value), 300)
		}
	}

	function clearResult(){
		let d = document.querySelector('.result')
			d.innerHTML = ""
	}
	async function fetchSearch(t){
		if(t.length < 2){
			clearResult()
			return
		}
		let res = await fetch(`api/searchTovari.php?name=${t}`)
		// console.log(await res.text())
		// return
		insertResult(await res.json())
	}
	function insertResult(r){
		let d = document.querySelector('.result')
		clearResult()
		let outhtml = "<table><thead><tr><td style='width: 300px;'>Наименование</td><td>ед.</td><td>Цена</td></tr></thead><tbody>"
		for(let i=0; i<r.length; i++){
			let html = `<tr rowid='${r[i]['id']}'>
							<td><input name='name' style="width: 100%;" type="text" value='${r[i]['name']}'></td>
							<td><input name='metric' style="width: 30px;" type="text" value='${r[i]['metric']}'></td>
							<td><input name='price' style="width: 50px;" type="number" value='${r[i]['price']}'></td>
						</tr>`
			outhtml += html
		}
		outhtml +="</tbody></table>"
		d.innerHTML = outhtml
		let inp = document.querySelectorAll("tbody input")
		for(let i=0; i<inp.length; i++){
			inp[i].addEventListener('change', changeInputResult)
		}
	}
	function changeInputResult(){
		let rowid= this.parentNode.parentNode.getAttribute('rowid')
		let name = this.parentNode.parentNode.querySelector('input[name="name"]').value
		let self_name= this.getAttribute('name')
		if(confirm(`Поменять ${self_name} на ${this.value} в строке ${rowid} наименование ${name}`)){
			let fd = new FormData()
			fd.append('comand', "change_fild")
			fd.append('table', 'complect')
			fd.append('rowid', rowid)
			fd.append('tabcol', self_name)
			fd.append('newval', this.value)
			fetch_change_result(fd)

		}
	}
	async function fetch_change_result(fd){
		let res = await fetch('handlerCRM.php', {method: "POST", body: fd})
		checkRespondServer(res)
	}
})