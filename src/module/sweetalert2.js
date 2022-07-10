import Swal from 'sweetalert2';



function openToast(icon = "success", title ="", position = "center"){

    const Toast = Swal.mixin({
        toast: true,
        // @ts-ignore
        position: position,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: icon,
        title: title
      })
}

// @ts-ignore
// @ts-ignore
export {
    openToast
}
