searchForm = document.querySelector('.search-form');

document.querySelector('#search-btn').onclick = () =>{
  searchForm.classList.toggle('active');
}

let loginForm = document.querySelector('.login-form-container');
let signupForm = document.querySelector('.signup-form-container');

document.querySelector('#login-btn').onclick = () =>{
  loginForm.classList.toggle('active');
}

document.querySelector('#close-login-btn').onclick = () =>{
  loginForm.classList.remove('active');
}
document.querySelector('#createAc').onclick = () =>{
  loginForm.classList.remove('active');
  signupForm.classList.add('active');
}
document.querySelector('#haveAcc').onclick = () => {
  signupForm.classList.remove('active');
  loginForm.classList.add('active');
}
document.querySelector('#close-signup-btn').onclick = () =>{
  signupForm.classList.remove('active');
}
window.onscroll = () =>{

  searchForm.classList.remove('active');

  if(window.scrollY > 80){
    document.querySelector('.header .header-2').classList.add('active');
  }else{
    document.querySelector('.header .header-2').classList.remove('active');
  }

}

window.onload = () =>{

  if(window.scrollY > 80){
    document.querySelector('.header .header-2').classList.add('active');
  }else{
    document.querySelector('.header .header-2').classList.remove('active');
  }

  // fadeOut();

}

// function loader(){
//   document.querySelector('.loader-container').classList.add('active');
// }

// function fadeOut(){
//   setTimeout(loader, 1000);
// }

var swiper = new Swiper(".books-slider", {
  loop:true,
  centeredSlides: true,
  autoplay: {
    delay: 9500,
    disableOnInteraction: false,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});

var swiper = new Swiper(".featured-slider", {
  spaceBetween: 10,
  loop:true,
  centeredSlides: true,
  autoplay: {
    delay: 9500,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    450: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
    },
    1024: {
      slidesPerView: 4,
    },
  },
});

var swiper = new Swiper(".arrivals-slider", {
  spaceBetween: 10,
  loop:true,
  centeredSlides: true,
  autoplay: {
    delay: 9500,
    disableOnInteraction: false,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});

var swiper = new Swiper(".reviews-slider", {
  spaceBetween: 10,
  grabCursor:true,
  loop:true,
  centeredSlides: true,
  autoplay: {
    delay: 9500,
    disableOnInteraction: false,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});

var swiper = new Swiper(".blogs-slider", {
  spaceBetween: 10,
  grabCursor:true,
  loop:true,
  centeredSlides: true,
  autoplay: {
    delay: 9500,
    disableOnInteraction: false,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});

// registration form validation
// const fullname = document.querySelector("#fullname");
// const form = document.querySelector("#form");

// form.addEventListener("submit", function(e){
//   if(fullname.value === '' || fullname.value === null){
//     document.querySelector(".error_name").innerHTML = "name is required";
//   }
//   if(fullname.value === '' || fullname.value === null){
//     document.querySelector(".error_name").innerHTML = "name is required";
//   }
//   e.preventDefault();
// })
// function seterror(id, error){
//   // sets error inside tag of id
//  element = document.getElementById(id);
//  element.getElementsByIdClassName('formError')[0].innerHTML = error;
// }

// function clearErrors(){
//   var errors = document.querySelector('.errorFields');

//   for(let item of errors){
//     item.innerHTML = "";
//   }
// }

function validateForm(){

  
  
  var returnVal = true;
  

  // perform validation and if validation fails, set the value of returnVal to false
  var name = document.forms['register_form']['fullname'].value;
  var phone = document.forms['register_form']['phone'].value;
  var username = document.forms['register_form']['username'].value;
  var password = document.forms['register_form']['password'].value;
  var confirm_pass = document.forms['register_form']['con_password'].value;
  var user_role = document.forms['register_form']['user_role'].value;

  // name validation
  if(name === '' || name === null){
    document.querySelector('.error_name').innerHTML = "Full Name is required";
    returnVal = false;
  }else if(!isNaN(name)){
    document.querySelector('.error_name').innerHTML = "Name can not be a number";
    returnVal = false;
  }else {
    document.querySelector('.error_name').innerHTML = "";
  }

  


  // phone number validation
  
  
  if(phone === '' || phone === null){
    document.querySelector('.error_phone').innerHTML = "phone number is required";
    returnVal = false;
  }else if(isNaN(phone)){
    document.querySelector('.error_phone').innerHTML = "This field requires phone number";
    returnVal = false;
  }else {
    document.querySelector('.error_phone').innerHTML = "";
  }

  

  


  // username validation
  
  
  if(username === '' || username === null){
      document.querySelector('.error_username').innerHTML = "Username is required.";
      returnVal = false;
  }else if(username >= 15){
    document.querySelector('.error_username').innerHTML = "Username is too long";
    returnVal = false;
  }else {
    document.querySelector('.error_username').innerHTML = "";
  }

  // password validation
  if(password === '' || password === null){
    document.querySelector('.error_password').innerHTML = "password is required";
    returnVal = false;
  }else if(password !== confirm_pass){
    document.querySelector('.error_password').innerHTML = "password not matches, try again";
    returnVal = false;
  }else if(password === 'password'){
    document.querySelector('.error_password').innerHTML = "password can not be password";
    returnVal = false;
  }else {
    document.querySelector('.error_password').innerHTML = "";
  }

  // comfirm password
  if(confirm_pass === '' || confirm_pass === null){
    document.querySelector('.error_con_pass').innerHTML = "confirm password is required";
    returnVal = false;
  }else {
    document.querySelector('.error_con_pass').innerHTML = "";
  }

  if(user_role === null){
    document.querySelector('.error_userrole').innerHTML = "Please select User Role";
    returnVal = false;
  }else {
    document.querySelector('.error_userrole').innerHTML = "";
  }
 
  return returnVal;
  
}