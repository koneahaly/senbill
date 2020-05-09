let togg1 = document.getElementById("display_cb");
let togg2 = document.getElementById("display_om");
let togg3 = document.getElementById("display_fc");
let d1 = document.getElementById("cb_1");
let d2 = document.getElementById("om_1");
let d2 = document.getElementById("fc_1");

togg1.addEventListener("click", () => {
  if(getComputedStyle(d1).display != "none"){
    d1.style.display = "none";
  } else {
    d3.style.display = "none";
    d2.style.display = "none";
    d1.style.display = "block";
  }
})

function togg(){
  if(getComputedStyle(d2).display != "none"){
    d2.style.display = "none";
  } else {
    d1.style.display = "none";
    d3.style.display = "none";
    d2.style.display = "block";
  }
};
togg2.onclick = togg;

function last_togg(){
  if(getComputedStyle(d3).display != "none"){
    d3.style.display = "none";
  } else {
    d1.style.display = "none";
    d2.style.display = "none";
    d3.style.display = "block";
  }
};
togg3.onclick = last_togg;
