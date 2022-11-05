let fotoGalObj = {
					picInd: "",
					curIndex: ""
}
let timeProtect = Date.now()

function fotoGaleryInit(){
	
	let body = document.querySelector('body')
	body.style.overflow = "hidden"
	let galCont = document.querySelector('.fotoGalaryCont')
	galCont.style.display = "flex"
	let closeBtn = document.querySelector('.fotoGalCloseBtn')
	closeBtn.addEventListener('click', fotoGalaryDisAct)		
	document.querySelector('.fotoGalaryLefttBtn').addEventListener('click', fotoGalRightAct)
	document.querySelector('.fotoGalaryRightBtn').addEventListener('click', fotoGalLeftAct)
	

	let l =  document.querySelector('.fotoGalaryPicleft')
	let a = document.querySelector('.fotoGalaryPicAct')
	let r = document.querySelector('.fotoGalaryPicRight')

	for(let i=0; i<fotoGalObj.picInd.length; i++){
		if(this == fotoGalObj.picInd[i]){
			fotoGalObj.curIndex = i
			break
		}
	}
	
	let ar_ind = [fotoGalObj.curIndex -1 , fotoGalObj.curIndex, fotoGalObj.curIndex + 1]

	if(fotoGalObj.curIndex == 0){
		ar_ind[0] = fotoGalObj.picInd.length -1
	}else if(fotoGalObj.curIndex == (fotoGalObj.picInd.length - 1)){
		ar_ind[2] = 0
	}
	

	let srcJpg = fotoGalObj.picInd[ar_ind[0]].querySelector('img').getAttribute('src')
	srcWebp = fotoGalObj.picInd[ar_ind[0]].querySelector('source').getAttribute('srcset')
	l.querySelector('img').setAttribute('src', srcJpg)
	l.querySelector('source').setAttribute('srcset', srcWebp)
	let h3 = fotoGalObj.picInd[ar_ind[0]].getAttribute('fotoGalTitle')
	l.querySelector('h3').innerText = h3

	srcJpg = fotoGalObj.picInd[ar_ind[1]].querySelector('img').getAttribute('src')
	srcWebp = fotoGalObj.picInd[ar_ind[1]].querySelector('source').getAttribute('srcset')
	a.querySelector('img').setAttribute('src', srcJpg)
	a.querySelector('source').setAttribute('srcset', srcWebp)
	h3 = fotoGalObj.picInd[ar_ind[1]].getAttribute('fotoGalTitle')
	a.querySelector('h3').innerText = h3

	srcJpg = fotoGalObj.picInd[ar_ind[2]].querySelector('img').getAttribute('src')
	srcWebp = fotoGalObj.picInd[ar_ind[2]].querySelector('source').getAttribute('srcset')
	r.querySelector('img').setAttribute('src', srcJpg)
	r.querySelector('source').setAttribute('srcset', srcWebp)
	h3 = fotoGalObj.picInd[ar_ind[2]].getAttribute('fotoGalTitle')
	r.querySelector('h3').innerText = h3
}
function fotoGalLeftAct(){
	if(Date.now() > timeProtect){
		timeProtect = Date.now() + 400
		let l = document.querySelector('.fotoGalaryPicleft')
		let a = document.querySelector('.fotoGalaryPicAct')
		let r = document.querySelector('.fotoGalaryPicRight')
		
		l.style.transition = '0s'
		l.classList = 'fotoGalaryPicRight'
		a.classList = 'fotoGalaryPicleft'
		r.classList = "fotoGalaryPicAct"

		setTimeout(()=>{
			l.style.transition = ""
		},400)

		let fl
		let left_ind = fotoGalObj.curIndex + 2
		if(fotoGalObj.curIndex == (fotoGalObj.picInd.length - 1)){		
			left_ind = 1
			fl = true
		}else if(fotoGalObj.curIndex == (fotoGalObj.picInd.length - 2)){
			left_ind = 0
		}

		let srcJpg = fotoGalObj.picInd[left_ind].querySelector('img').getAttribute('src')
		l.querySelector('img').setAttribute('src', srcJpg)
		let srcWebp = fotoGalObj.picInd[left_ind].querySelector('source').getAttribute('srcset')
		l.querySelector('source').setAttribute('srcset', srcWebp)
		let h3 = fotoGalObj.picInd[left_ind].getAttribute('fotoGalTitle')
		l.querySelector('h3').innerText = h3

		if(fl){
			fotoGalObj.curIndex = 0
			return
		}
		fotoGalObj.curIndex +=1
	}
}

function fotoGalRightAct(){
	if(Date.now() > timeProtect){
		timeProtect = Date.now() + 400
		let l = document.querySelector('.fotoGalaryPicleft')
		let a = document.querySelector('.fotoGalaryPicAct')
		let r = document.querySelector('.fotoGalaryPicRight')
		
		r.style.transition = '0s'
		l.classList = 'fotoGalaryPicAct'
		a.classList = 'fotoGalaryPicRight'
		r.classList = "fotoGalaryPicleft"

		setTimeout(()=>{
			r.style.transition = ""
		},400)
		let fl
		let left_ind = fotoGalObj.curIndex - 2
		if(fotoGalObj.curIndex == 0){		
			left_ind = fotoGalObj.picInd.length - 2 
			fl = true
		}else if(fotoGalObj.curIndex == 1){
			left_ind = fotoGalObj.picInd.length - 1
		}

		let srcJpg = fotoGalObj.picInd[left_ind].querySelector('img').getAttribute('src')
		r.querySelector('img').setAttribute('src', srcJpg)

		let srcWebp = fotoGalObj.picInd[left_ind].querySelector('source').getAttribute('srcset')
		r.querySelector('source').setAttribute('srcset', srcWebp)
		let h3 = fotoGalObj.picInd[left_ind].getAttribute('fotoGalTitle')
		r.querySelector('h3').innerText = h3

		if(fl){
			fotoGalObj.curIndex = fotoGalObj.picInd.length - 1
			return
		}
		fotoGalObj.curIndex -=1
	}
}

function fotoGalaryDisAct(){
	galCont = document.querySelector('.fotoGalaryCont')
	galCont.style.display = "none"
	let body = document.querySelector('body')
	body.style.overflow = ""
}
