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

/**
 *
 * @param { String } title
 * @param { String } text
 */
function confirm( title = "Yakin !", text = "Apakah Yakin Akan Menghapus?")
{
   return Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
            return Promise.resolve(true);
        }

        return;
      })
}

// @ts-ignore
// @ts-ignore
export {
    openToast, confirm
}
