let log;
let input;
init();


function init() {
    input = document.getElementById('name');
    log = document.getElementById('mc_uuid');

    input.addEventListener('focusout', fetchText)
}

async function fetchText(event) {
    fetch('/api/mcuuid/' + event.target.value)
        .then((res) => res.json())
        .then((res) => {
            console.log(res['id'])
            let test = document.getElementById('mc_uuid')
            test.value = res['id'];
        })
        .catch((res) => {
            let test = document.getElementById('mc_uuid')
            test.value = null;
    })
}



