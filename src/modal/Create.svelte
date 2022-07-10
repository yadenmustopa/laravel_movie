<script>
    import { createEventDispatcher } from 'svelte';
    import Rest from '@/module/Rest';
    import { openToast } from '@/module/sweetalert2';

    const dispatch = createEventDispatcher;

    let title = "";
    let poster = "";
    let description = "";
    let genre = "";
    let rating = "";
    let button_close;

    function create()
    {
        let Request = new Rest();
        let data = { title, poster : poster[0], description, genre, rating };

        var form_data = new FormData();

        for ( var key in data ) {
            form_data.append(key, data[key]);
        }
        // @ts-ignore
        let req = Request.request("/movie","POST", form_data, { 'Content-Type':'multipart/form-data'} );

        req.then( (res)=> {
            console.log({ res });
            openToast('success',res.data.message);
            button_close.click();
            triggerDispatch();
        })
    }

    function triggerDispatch()
    {
        dispatch('created',{ value : TRUE });
    }
</script>

<input type="checkbox" id="modal-create" class="modal-toggle" />
<div class="modal">
  <div class="modal-box ">
    <label for="modal-create" class="btn btn-sm btn-circle absolute right-2 top-2" bind:this={ button_close }>✕</label>
    <h3 class="text-lg font-bold">Tambah Movie</h3>
    <div class="flex justify-center">
        <div>
            <div class="form-control w-full max-w-xs mt-4">
                <input type="text" placeholder="Title" class="input input-bordered input-success w-full max-w-xs" bind:value={ title }/>
            </div>
            <div class="form-control w-full max-w-xs mt-4">
                <input type="file" placeholder="Title" class="input input-bordered input-success w-full max-w-xs" bind:files={ poster }/>
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
                <input type="text" placeholder="Rating" min="1" max="10" class="input input-bordered input-success w-full max-w-xs" bind:value = {rating}/>
            </div>

            <div class="form-control w-full max-w-xs mt-4">
                <button type="button" class="btn btn-primary" on:click = { create }>Simpan</button>
            </div>
        </div>

    </div>
  </div>
</div>
