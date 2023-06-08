//javaScript code for the button that's will click on it to go to the start of the page
let btn= document.getElementById('scrolbtn');  //this is the button that's we want to program it , firstly it's hidden because we wrote in it's style in css the display equal to none
window.onscroll = function(){  //this function will be executed when we sroll, that's checks the size of  scroly to display the tto if it's greater than 400otherwise  hidden it.
    if(scrollY >= 400)
        btn.style.display = 'block';// make the display css propety of thi btton eqal to block in order to make it seen and unhidden
    else
        btn.style.display ='none'; //hidden the button
}

btn.onclick = function(){    //when we click on this button we go to the beginning of page by bsetting the left and top scroll equal to zero
    scroll({
        left:0,
        top:0,
        behavior: "smooth",
    })
}
//------------------------------------------------------------------------------------

