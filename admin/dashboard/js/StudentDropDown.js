const StudentDropDown = document.getElementById("StudentDropDown");
const studentContent = document.getElementById("studentContent");


StudentDropDown.addEventListener('click', showStudentsMenu);


function showStudentsMenu () {
    studentContent.classList.toggle('active');
    StudentDropDown.classList.toggle('active');
}



// cleared Students
const ClearedStudentDropDown = document.getElementById("ClearedStudentDropDown");
const ClearedStudentContent = document.getElementById("ClearedStudentContent");


ClearedStudentDropDown.addEventListener('click', showClearedStudentsMenu);


function showClearedStudentsMenu () {
    ClearedStudentContent.classList.toggle('active');
    ClearedStudentDropDown.classList.toggle('active');
}