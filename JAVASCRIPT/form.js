
const loginForm=document.querySelector('.loginForm');
const signUpForm=document.querySelector('.SignUpForm');

const pass_field = document.querySelector('.pass-key');
         const showBtn = document.querySelector('.show');
         showBtn.addEventListener('click', function(){
          if(pass_field.type === "password"){
            pass_field.type = "text";
            showBtn.style.color = "#3498db";
          }else{
            pass_field.type = "password";
            showBtn.style.color = "#222";
          }
         });


function openSignInForm(){
    console.log("open signin called");
    loginForm.style.display="none";
    signUpForm.style.display="block";    
}
function openLoginForm(){
    console.log("open login called");
    loginForm.style.display="block";
    signUpForm.style.display="none";
}