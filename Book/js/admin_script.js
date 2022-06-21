let navbar = document.querySelector('.header .navbar');
let accountBox = document.querySelector('.header .account_box');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   accountBox.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{

   accountBox.classList.toggle('active');
   navbar.classList.remove('active');
}
document.querySelector('.theme_toggler .light').onclick = () =>{
document.body.style.background="white";
document.querySelector('.title').style.color="#333";
}
document.querySelector('.theme_toggler .dark').onclick = () =>{
   document.body.style.background="black";
   document.querySelector('.title').style.color="#fff";
   }
   
window.onscroll = () =>{
   navbar.classList.remove('active');
   accountBox.classList.remove('active');
}

document.querySelector('#close-update').onclick = () =>{
   document.querySelector('.edit-product-form').style.display = 'none';
   window.location.href = 'admin_products.php';
}

document.querySelector('#close-update').onclick = () => {
   document.querySelector('.edit-product-form').style.display ='none';
   window.location.href ='admin_products.php';
}