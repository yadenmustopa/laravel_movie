<script>
    import { createEventDispatcher } from 'svelte';
    import Rest from '@/module/Rest';
    import { openToast } from '@/module/sweetalert2';
    import DefaultPoster from '@/assets/default.png';
    import Fa from 'svelte-fa/src/fa.svelte'
    import { faCamera } from '@fortawesome/free-solid-svg-icons/index.es'

    const dispatch = createEventDispatcher();

    let title = "";
    let poster = "";
    let description = "";
    let genre = "";
    let rating = "";
    let button_close;
    let input_poster;
    let image ;


    function create()
    {
        let Request = new Rest();
        let data = { title, poster : poster[0], description, genre, rating };

        var form_data = new FormData();

        for ( var key in data ) {
            form_data.append(key, data[key]);
        }
        // @ts-ignore
        let req = Request.request("/movie","POST",{}, form_data, { 'Content-Type':'multipart/form-data'} );

        req.then( (res)=> {
            console.log({ res });
            openToast('success',res.data.message);
            button_close.click();
            triggerDispatch();
        })
    }

    function triggerDispatch()
    {
        reset();
        dispatch('created',{ value : true });
    }


    function chooseImage()
    {
        input_poster.click();
    }

    function changePoster()
    {
        const file = input_poster.files[0];

        if (file) {
          const reader = new FileReader();
          reader.addEventListener("load", function () {
            image.setAttribute("src", reader.result);
          });
          reader.readAsDataURL(file);
                return;
        }

    }

    function reset()
    {
        title = "";
        poster = "";
        description = "";
        genre = "";
        rating = "";
        image = null;
    }

</script>
<style>
    .image-preview img{
        max-width:320px !important;
    }
</style>

<input type="checkbox" id="modal-create" class="modal-toggle" />
<div class="modal">
  <div class="modal-box ">
    <label for="modal-create" class="btn btn-sm btn-circle absolute right-2 top-2" bind:this={ button_close }>✕</label>
    <h3 class="text-lg font-bold">Tambah Movie</h3>
    <div class="flex justify-center">
        <div>
            <div class="wrap-image-priview w-full">
                <div class="image-preview w-full">
                    <img bind:this={ image } src="" class="{ ( ! image ) ? 'hidden' : '' }" >
                    <img src={ DefaultPoster }  class="{ ( poster ) ? 'hidden' : ''}" >
                </div>
                <div class="w-full mt-4">
                    <button type="button" class="btn btn-square btn-info color-white text-white w-full" on:click = { chooseImage }>
                        <Fa icon={ faCamera }></Fa> &nbsp; Pilih Gambar
                    </button>
                    <!-- <button type="button" class="btn btn-square btn-info color-white text-white w-full" on:click = { chooseImage }>
                        <Fa icon={ faCamera }></Fa> &nbsp; Hapus Gambar
                    </button> -->
                </div>
            </div>


            <div class="form-control w-full max-w-xs mt-4 hidden">
                <input type="file" placeholder="Title" class="input input-bordered input-success w-full max-w-xs" bind:this={ input_poster } bind:files={ poster } on:change= { changePoster }/>
            </div>
            <div class="form-control w-full max-w-xs mt-4">
                <input type="text" placeholder="Title" class="input input-bordered input-success w-full max-w-xs" bind:value={ title }/>
            </div>
            <div class="form-control w-full max-w-xs mt-4">
                <textarea type="text" placeholder="Description" class="textarea textarea-accent input-success w-full max-w-xs" bind:value={ description }/>
            </div>
            <div class="form-control w-full max-w-xs mt-4">
                <select class="select select-success w-full max-w-xs" bind:value = { genre }>
                    <option value ="" disabled selected >Pilih Genre</option>
                    <option value ="action">Action</option>
                    <option value ="romance">Romance</option>
                    <option value ="anime">Anime</option>
                    <option value="horor">Horor</option>
                    <option value="drama">Drama</option>
                    <option value="crime">Crime</option>
                    <option value="comedy">Comedy</option>
                    <option value="fantasy">Fantasy</option>
                </select>
            </div>
            <div class="form-control w-full max-w-xs mt-4">
                <input type="text" placeholder="Rating Misal : 8.5" min="1" max="10" class="input input-bordered input-success w-full max-w-xs" bind:value = {rating}/>
            </div>

            <div class="form-control w-full max-w-xs mt-4">
                <button type="button" class="btn btn-primary" on:click = { create }>Simpan</button>
            </div>
        </div>

    </div>
  </div>
</div>
