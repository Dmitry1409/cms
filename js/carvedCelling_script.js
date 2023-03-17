
window.addEventListener('DOMContentLoaded',()=>{
	document.querySelector('.FPcontArrow').addEventListener('click', arrowCarwedAction)

	async function arrowCarwedAction(){
		let curLen = document.querySelector('.FPcountCont > span')
		let len = curLen.querySelector('span:last-child').innerText
		curLen = curLen.querySelector('span:first-child').innerText

		if(Number(len) != Number(curLen)){	
			let res = await fetch(`../scripts_php/getUrlApply.php?len=${curLen}`)
			if(res.ok){
				let val = await res.json()
				insertImgCarved(val)
			}else{
				alert('Не удалось получить изображения. Соообщите пожалуйста администратору сайта об ошибке. Код возврата: '+res.status)
			}
		}else{
			removeImgCarved()
		}
	}

	fotoGalObj.picInd = document.querySelectorAll('.fotoGalIndex')

	for(let i=0; i<fotoGalObj.picInd.length; i++){
		fotoGalObj.picInd[i].addEventListener('click', fotoGaleryInit)
	}

	function removeImgCarved(){
		let allImg = document.querySelectorAll('.carvedGridItem')
		for(let i =0; i<allImg.length; i++){
			if(i >= 12){
				allImg[i].remove()
			}
		}
		let arrow = document.querySelector('.arrow-8')
		arrow.classList.remove('arrRotate')
		let count = document.querySelector('.FPcountCont > span')
		count = count.querySelector('span:first-child')
		count.innerText = 12

	}

	function insertImgCarved(val){
		let grid = document.querySelector('.carvedGrid')
		for(let i=0; i<val.length; i++){
			let html = `<div class='carvedGridItem'>
							<img src=${val[i]}>
						</div>`
			grid.insertAdjacentHTML('beforeend', html)
		}
		let count = document.querySelector('.FPcountCont > span')
		let len = count.querySelector('span:last-child')
		count = count.querySelector('span:first-child')
		count.innerText = Number(count.innerText) + val.length
		len = Number(len.innerText)
		if(len == Number(count.innerText)){
			let arrow = document.querySelector('.arrow-8')
			arrow.classList.add('arrRotate')

		}
	}
})