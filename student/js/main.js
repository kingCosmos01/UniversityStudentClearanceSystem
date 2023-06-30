const ctaTrigger = document.getElementById('dropDown');
const ctaBox = document.getElementById('ctaBox');


ctaTrigger.addEventListener('click', openCta);

function openCta() {
    ctaBox.classList.toggle('active');
};



const successModal = document.getElementById('alertSuccess');
const errorModal = document.getElementById('alertDanger');

CheckForResidenceStudentClearanceSuccess(successModal);

setTimeout(() => {
    successModal.style.display = 'none';
}, 4000);

setTimeout(() => {
    errorModal.style.display = 'none';
}, 4000);

function CheckForResidenceStudentClearanceSuccess(success)
{
    if(success)
    {
        window.location.href = "http://localhost/clearancems/hod/dashboard/residence/";
    }
}