
const addHODBtn = document.getElementById('addBtn');
const overlay = document.getElementById('overlay');
const closeBtn = document.getElementById('closeBtn');
const _form = document.getElementById('addBox');

addHODBtn.addEventListener('click', getForm);
closeBtn.addEventListener('click', closeForm);

function getForm() {
    overlay.style.display = 'block';
    _form.classList.add('active');
};

function closeForm () {
    overlay.style.display = 'none';
    _form.classList.remove('active');
};

