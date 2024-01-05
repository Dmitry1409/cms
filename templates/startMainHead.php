<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0
				maximum-scale=1.0, user-scalable=0">
				
	<link rel="stylesheet" type="text/css" href=<?php echo $GLOBALS['root_dir']."css/main.css" ?>>
	<link rel="stylesheet" type="text/css" href=<?php echo $GLOBALS['root_dir']."css/normalize.css" ?>>
	<script defer type="text/javascript" src=<?php echo $GLOBALS['root_dir']."js/main.js"?>></script>
	<script type="text/javascript">
		window.addEventListener('load', ()=>{
			let done = document.querySelector('.howMuchDoneSection')
			getMainPageHtml()
			async function getMainPageHtml(){
				let r = await fetch('templates/getMainHtml.php')
				let html = await r.text()
				done.insertAdjacentHTML('afterend', html)
				let head = document.querySelector('head')

				let e = new Event('DOMContentLoaded')
				let sExm = document.createElement('script')
				sExm.src = "js/exampWorkFoto.js"
				sExm.type = "text/javascript"
				sExm.onload = function(){
					window.dispatchEvent(e)
				}			
				head.append(sExm)

				let sFeed = document.createElement('script')
				sFeed.src = 'js/feedBackClient.js'
				sFeed.type = "text/javascript"
				sFeed.onload = function(){
					window.dispatchEvent(e)
				}
				head.append(sFeed)

				let mP = document.createElement('script')
				mP.src = "js/mainPage.js"
				mP.type = "text/javascript"
				mP.onload = function(){
					window.dispatchEvent(e)
				}
				head.append(mP)
			}
		})
		let countInitStart = 0
		window.addEventListener('DOMContentLoaded',()=>{
			let flHowMuchStart
			countInitStart += 1
			let cont = document.querySelector('.howMuchDoneSection')
			let howMuchSpans = document.querySelectorAll('.howMuchDoneSection > div > span span:first-child')
			let howMuchCont = document.querySelectorAll('.howMuchCont')
			let howMuchDoneData = []
			let duractAnim = [500, 1000, 1500, 2000, 2500, 3000]
			let arrIdInterv = [0,0,0,0,0,0]
			if(countInitStart == 1){				
				flHowMuchStart = true
				document.addEventListener('scroll', howMuchStart)				
				for(let i = 0; i<howMuchSpans.length; i++){
					howMuchDoneData.push(howMuchSpans[i].innerText)
					howMuchSpans[i].innerText = ""
				}
			}

			function setValueInterv(ind_elem){
				let stepVal = Math.ceil(duractAnim[ind_elem] / 10)
				stepVal = Math.ceil(howMuchDoneData[ind_elem] / stepVal)
				arrIdInterv[ind_elem] = setInterval(()=>{
					howMuchSpans[ind_elem].innerText = Number(howMuchSpans[ind_elem].innerText) + stepVal
					if(Number(howMuchSpans[ind_elem].innerText) > Number(howMuchDoneData[ind_elem])){
						howMuchSpans[ind_elem].innerText = howMuchDoneData[ind_elem]
						clearInterval(arrIdInterv[ind_elem])
						howMuchViewEffect(howMuchSpans[ind_elem])
					} 
				}, 10)
			}
			function howMuchViewEffect(elem){
				let d = elem.parentNode.parentNode
				d.style.transition = ".3s"
				d.classList.add('boxShadEffect')
				d.classList.add('borderEffect')
			}
			function howMuchStart(){
				cont_rect = cont.getBoundingClientRect()			
				if(cont_rect.y < 500){
					if(flHowMuchStart){
						flHowMuchStart = false
						for(let i = 0; i< howMuchSpans.length; i++){
							setValueInterv(i)
						}
						document.removeEventListener('scroll', howMuchStart)
					}
				}
			}
		})
	</script>
	<script type="text/javascript" src='<?php echo $GLOBALS["root_dir"]."js/simpleCeilOffer.js"?>'></script>
	<link rel="apple-touch-icon" sizes="180x180" href='<?php echo $GLOBALS["root_dir"]."img/favicon_io/apple-touch-icon.png"?>'>
	<link rel="icon" type="image/png" sizes="32x32" href='<?php echo $GLOBALS["root_dir"]."img/favicon_io/favicon-32x32.png"?>'>
	<link rel="icon" type="image/png" sizes="16x16" href='<?php echo $GLOBALS["root_dir"]."img/favicon_io/favicon-16x16.png"?>'>
	<link rel="manifest" href='<?php echo $GLOBALS["root_dir"]."site.webmanifest"?>'>
	<!-- Yandex.Metrika counter -->
	<!-- <script type="text/javascript" >
		   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
		   m[i].l=1*new Date();
		   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
		   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
		   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

		   ym(91462500, "init", {
		        clickmap:true,
		        trackLinks:true,
		        accurateTrackBounce:true,
		        webvisor:true
		   });
		</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/91462500" style="position:absolute; left:-9999px;" alt="" /></div></noscript> -->
	<!-- /Yandex.Metrika counter -->