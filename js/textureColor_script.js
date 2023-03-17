
window.addEventListener('DOMContentLoaded',()=>{

	
	let yzor_img = document.querySelectorAll('.color_yzory_grid img')

	for(let i=0; i<yzor_img.length; i++){
		yzor_img[i].addEventListener('click', yzorScaleAction)
	}

	let glass_anim = document.querySelectorAll('.glass_anim')


	let id_interval = setInterval(()=>{
		let i = rand_index(glass_anim.length)
		glass_anim[i].classList.toggle('glass_action')
	}, 200)

	fotoGalObj.picInd = document.querySelectorAll('.fotoGalIndex')

	for(let i=0; i<fotoGalObj.picInd.length; i++){
		fotoGalObj.picInd[i].addEventListener('click', fotoGaleryInit)
	}


	function yzorScaleAction(){
		if(this.classList.contains('yzory_scale')){
			this.classList.remove('yzory_scale')
			return
		}
		let yzor_img = document.querySelectorAll('.color_yzory_grid img')
		for(let i=0; i<yzor_img.length; i++){
			if(yzor_img[i].classList.contains('yzory_scale')){
				yzor_img[i].classList.remove('yzory_scale')
				return
			}
		}
		this.classList.add('yzory_scale')
		setTimeout(()=>{
			this.classList.remove('yzory_scale')
		}, 3000)
	}
	function rand_index(len){
		return Math.floor(Math.random() * len)
	}

})