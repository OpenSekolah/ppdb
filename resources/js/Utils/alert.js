import Swal from 'sweetalert2'
window.Swal = Swal;

const ToastAlert = Swal.mixin({
    toast: false,
    position: 'top-start',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true
})

window.ToastAlert = ToastAlert