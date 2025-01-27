const loginForm = document.querySelector(".loginForm");
const signUpForm = document.querySelector(".SignUpForm");

function openSignInForm() {
  console.log("open signin called");
  loginForm.style.display = "none";
  signUpForm.style.display = "block";
}
function openLoginForm() {
  console.log("open login called");
  loginForm.style.display = "block";
  signUpForm.style.display = "none";
}
