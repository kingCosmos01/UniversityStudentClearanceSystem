
const HodDropDownBtn = document.getElementById("HodDropDown");
const hodContent = document.getElementById("hodContent");



HodDropDownBtn.addEventListener('click', showHodMenu);


function showHodMenu (){
    hodContent.classList.toggle('active');
    HodDropDownBtn.classList.toggle('active');
}


