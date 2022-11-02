import './bootstrap'
import '../sass/app.scss'


let table;
init();

function init() {
    table = document.querySelector('#category-filter');
    table.addEventListener('click', Filter);

    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })
}


function Filter(e) {
    if (e.target.id === 'openFilter' ) {
        return;
    }
    table.submit();
}



