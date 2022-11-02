import Swal from "sweetalert2";

document.querySelector('#categories').addEventListener('click', function (e) {
    let clicked = e.target
    if (clicked.nodeName !== 'INPUT') {
        return
    }

    let data = {
        active: (clicked.checked)
    }

    axios.patch(`/admin/categories/${clicked.dataset.id}/update-visibility`, data)
        .then(function (res) {
            Swal.fire({
                icon: 'success',
                position: 'top',
                toast: 'true',
                timer: '2000',
                text: `Category is now ${(clicked.checked) ? "visible" : "hidden"}!`,
            })
        }).catch(function (error) {
        Swal.fire({
            icon: 'error',
            position: 'top',
            toast: 'true',
            timer: '2000',
            showConfirmButton: 'false',
            text: 'Something went wrong..',
        })
    })
});


