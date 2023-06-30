
const UploadDropDown = document.getElementById("UploadDropDown");
const UploadContent = document.getElementById("UploadContent");



UploadDropDown.addEventListener('click', ShowDocumentsTab);
var isChanged = false;

function ShowDocumentsTab (){ 
  
    UploadContent.classList.toggle('active');
    UploadDropDown.classList.toggle('active');
}

