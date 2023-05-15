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


var pass1 = document.getElementById("pass1");
var pass2 = document.getElementById("pass2");

var showPass = document.getElementById("showPass");

function showPassword(){
    if(showPass.checked){
        pass1.setAttribute("type", "password");
        pass2.setAttribute("type", "password");

    }
    else{
        pass1.setAttribute("type", "text");
        pass2.setAttribute("type", "text");
    }

}
    
