const CourseFormDropDown = document.getElementById("CourseFormDropDown");
const CourseFormContent = document.getElementById("CourseFormContent");


CourseFormDropDown.addEventListener('click', ShowCourseFormContent);


function ShowCourseFormContent () {
    CourseFormContent.classList.toggle('active');
    CourseFormDropDown.classList.toggle('active');
}


// AddException
const addExceptionModalOverlay = document.getElementById('addMessageBoxOverlay');
const addExceptionModalBtn = document.getElementById('addExceptionBtn');
const exceptionModal = document.getElementById('addMessageBox');
const closeExceptionModalBtn = document.getElementById('closeExceptionModalBtn');

function ShowAddExceptionModal() {
    addExceptionModalOverlay.style.display = 'block';
    exceptionModal.classList.toggle('active');
}

function CloseExceptionModal() {
    addExceptionModalOverlay.style.display = 'none';
    exceptionModal.classList.toggle('active');
}

addExceptionModalBtn.addEventListener('click', ShowAddExceptionModal);
closeExceptionModalBtn.addEventListener('click', CloseExceptionModal);