<script>
    import { createEventDispatcher } from 'svelte';
    import Rest from '@/module/Rest';
    import { openToast } from '@/module/sweetalert2';
    import DefaultPoster from '@/assets/default.png';
    import Fa from 'svelte-fa/src/fa.svelte'
    import { faCamera } from '@fortawesome/free-solid-svg-icons/index.es'

    const dispatch = createEventDispatcher();
    export let data_selected;

    $:if( data_selected ){
        assignToData();
        console.log({ data_selected });
    }

    let title;
    let description;
    let poster

    function assignToData()
    {
        title = data_selected.title;
        description= data_selected.description;
        poster= data_selected.poster;
    }


</script>
<style>
    .image-preview img{
        max-width:320px !important;
    }
</style>

<input type="checkbox" id="modal-deskripsi" class="modal-toggle" />
<div class="modal">
  <div class="modal-box ">
    <label for="modal-deskripsi" class="btn btn-sm btn-circle absolute right-2 top-2" >✕</label>
    <h3 class="text-lg font-bold">Descripsi/Sinopsis Film { title }</h3>
    <div class="flex justify-center">
        <div>
            <div class="wrap-image-priview w-full">
                <div class="image-preview w-full">
                    <img src= "./assets/{ poster }"  >
                </div>
            </div>

            <div class="form-control w-full max-w-xs mt-4">
                <div>{ description }</div>
            </div>
        </div>

    </div>
  </div>
</div>
