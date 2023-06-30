const alertSuccess = document.getElementById("alertSuccess");
const alertDanger = document.getElementById("alertDanger");

setTimeout(() => {
    if(alertSuccess)
    {
        alertSuccess.style.display = 'none';
    }
    if(alertDanger)
    {
        alertDanger.style.display = "none";
    }
}, 3000);