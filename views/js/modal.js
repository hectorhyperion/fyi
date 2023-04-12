'use strict'; 
const modal = document.querySelector('.modal')
const overlay = document.querySelector('.overlay')
const btnCloseModal = document.querySelector('.close-modal')
const btnsOpenModal = document.querySelectorAll('.show-modal')

const openModal= function () {
      modal.classList.remove('hidden')
   overlay.classList.remove('hidden')
}

const closeModal = function (){
    modal.classList.add('hidden')
    overlay.classList.add('hidden')
    }
    //open model and overlaye
for(let e = 0;  e < btnsOpenModal.length;  e++)
btnsOpenModal[e] .addEventListener('click' , openModal);

//close modal
btnCloseModal.addEventListener('click' , closeModal )
//close overlay
overlay.addEventListener('click', closeModal)
//key press 
document.addEventListener('keydown', function(e){
    //checking for event classs and close it using a pressed key
    if (e.key === 'Escape') {
       if (!modal.classList.contains('  hidden')) {
            closeModal()
       }
    }
})