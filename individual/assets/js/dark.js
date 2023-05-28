//read color from localstorage
let whitecolor = localStorage.getItem("white");
let blackcolor = localStorage.getItem("black");
let maincolor = localStorage.getItem("nav-main");
let switchercolor = localStorage.getItem("switcher-main");
let active_elt = localStorage.getItem("active");



if(maincolor !== null  && switchercolor !== null && whitecolor !== null  && blackcolor !== null ){
  //passing particular value to a particular root variable
  document.documentElement.style.setProperty("--nav-main", maincolor);
  document.documentElement.style.setProperty("--switchers-main", switchercolor);
  document.documentElement.style.setProperty("--white", whitecolor);
  document.documentElement.style.setProperty("--black", blackcolor);
  
  
} 

//end of getting color from localstorage


// Js code to make color box enable or disable
let colorIcons = document.querySelector(".color-icon"),
icons = document.querySelector(".color-icon .icons");

icons.addEventListener("click" , ()=>{
  colorIcons.classList.toggle("open");
})

// getting all .btn elements
let buttons = document.querySelectorAll(".btn");

for (var button of buttons) {
  button.addEventListener("click", (e)=>{ //adding click event to each button
    let target = e.target;

    let open = document.querySelector(".open");
    if(open) open.classList.remove("open");

    document.querySelector(".active").classList.remove("active");
    target.classList.add("active");

    // js code to switch colors (also day night mode)
    let root = document.querySelector(":root");
    let dataColor = target.getAttribute("data-color"); //getting data-color values of clicked button
    let color = dataColor.split(" "); //splitting each color from space and make them array

    //passing particular value to a particular root variable
    root.style.setProperty("--white", color[0]);
    root.style.setProperty("--black", color[1]);
    root.style.setProperty("--nav-main", color[2]);
    root.style.setProperty("--switchers-main", color[3]);

    //save color in locastorage
    //localStorage.setItem("main-color",color[2]);
     localStorage.setItem("active", target);
    localStorage.setItem("white", color[0]);
    localStorage.setItem("black", color[1]);
    localStorage.setItem("nav-main", color[2]);
    localStorage.setItem("switcher-main", color[3]);
    

    let iconName = target.className.split(" ")[2]; //getting the class name of icon

    let coloText = document.querySelector(".home-content span");

    if(target.classList.contains("fa-moon")){ //if icon name is moon
      target.classList.replace(iconName, "fa-sun") //replace it with the sun
      colorIcons.style.display = "none";
      coloText.classList.add("darkMode");
    }else if (target.classList.contains("fa-sun")) { //if icon name is sun
      target.classList.replace("fa-sun", "fa-moon"); //replace it with the sun
      colorIcons.style.display = "block";
      coloText.classList.remove("darkMode");
      document.querySelector(".btn.blue").click();
    }
  });
}
