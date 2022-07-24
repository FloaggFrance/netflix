let dBody = document.querySelector('body')
let btn = document.querySelectorAll('.button-moove-scroll')

window.onload = ()=>{
	
}

document.querySelectorAll('.list-suggestion-film').forEach(ele => {
	let nimo= (ele.querySelectorAll('.scroll-ctn article').length+1) / 5
	for(let i=0; i < nimo; i++) {
		//if(ele.querySelector('#num_scroll').length !== undefined) {
			ele.querySelector('#num_scroll').innerHTML += '<span class="scroll-ctn-count"></span>'
			console.log(nimo)
		//}
	}
})

btn.forEach(btnMoove => {
	btnMoove.addEventListener('click', ()=>{
		if (btnMoove.parentElement) {
			let nodeElement = btnMoove.parentElement
			let elementScroll = nodeElement.querySelector('.contenaire-to-scroll')
			let scrollWidthBTN = nodeElement.querySelector('.contenaire-to-scroll .scroll-ctn').scrollWidth - nodeElement.querySelector('.contenaire-to-scroll .scroll-ctn').offsetWidth
			let btnLeft = nodeElement.querySelector('.button-moove-scroll.left')
			let btnRight = nodeElement.querySelector('.button-moove-scroll.right')

			console.log(scrollWidthBTN)
			console.log(nodeElement.querySelector('.scroll-ctn').scrollLeft)

			if(btnMoove.classList.contains('left')) {
				nodeElement.querySelector('.scroll-ctn').scrollLeft -= elementScroll.offsetWidth
				/* if(nodeElement.querySelector('.scroll-ctn').scrollLeft >= scrollWidthBTN) {
					btnRight.style.display = "block"
				}*/
			}

			if(btnMoove.classList.contains('right')) {
				nodeElement.querySelector('.scroll-ctn').scrollLeft += elementScroll.offsetWidth
				/* if(nodeElement.querySelector('.scroll-ctn').scrollLeft >= scrollWidthBTN) {
					btnRight.style.display = "block"
				}*/
			}
		}

	})
})