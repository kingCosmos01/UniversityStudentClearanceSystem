
const HodDropDownBtn = document.getElementById("HodDropDown");
const hodContent = document.getElementById("hodContent");

const departmentsDropDown = document.getElementById('DepartmentsDropDown');
const departmentsContent = document.getElementById('DepartmentsContent');



HodDropDownBtn.addEventListener('click', showHodMenu);
departmentsDropDown.addEventListener('click', ShowDepartmentsContent);


function showHodMenu (){
    hodContent.classList.toggle('active');
    HodDropDownBtn.classList.toggle('active');
}

function ShowDepartmentsContent() {
    departmentsContent.classList.toggle('active');
    departmentsDropDown.classList.toggle('active');
}



// Add Department
const addDepartmentBtn = document.getElementById('addDepartmentBtn');
const addDepartmentModalOverlay = document.getElementById('addDepartmentOverlay');
const addDepartmentModal = document.getElementById('addDepartmentBox');
const closeAddDepartmentModalBtn = document.getElementById('closeDepartmentBoxBtn');

addDepartmentBtn.addEventListener('click', ShowAddDepartmentModal);
closeAddDepartmentModalBtn.addEventListener('click', CloseAddDepartmentModal);


function ShowAddDepartmentModal ()
{
    addDepartmentModalOverlay.style.display = "block";
    addDepartmentModal.classList.add('active');   
}

function CloseAddDepartmentModal() 
{
    addDepartmentModalOverlay.style.display = "none";
    addDepartmentModal.classList.remove('active');   
    addDepartmentModal.classList.toggle(modalVisibility);   
    
}

function modalVisibility()
{
    let visibility = addDepartmentModal.style.display = "none";
    return visibility;
}