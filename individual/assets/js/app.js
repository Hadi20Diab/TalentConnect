function show(){
    var password = document.getElementById("password");
    var showPassword = document.getElementById("showPassword");

    if(showPassword.checked){
        password.setAttribute("type", "text");

    }
    else{
        password.setAttribute("type", "password");
    }
}


const pass1 = document.getElementById("pass1");
const pass2 = document.getElementById("pass2");

const showPass = document.getElementById("showPass");

showPass.addEventListener("click" , ()=>{
    if(showPass.checked){
        pass1.setAttribute("type", "text");
        pass2.setAttribute("type", "text");

    }
    else{
        pass1.setAttribute("type", "password");
        pass2.setAttribute("type", "password");
    }
 
});
    
