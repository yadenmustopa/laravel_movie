<script>
// @ts-nocheck

    "use strict";
    // const Rest = require("@/module/Rest");
    import Rest from '@/module/Rest';
    import Filter from '@/components/Filter.svelte';
    import ModalCreate from '@/modal/Create.svelte';
    import Fa from 'svelte-fa/src/fa.svelte'
    import { faPencil, faTrash } from '@fortawesome/free-solid-svg-icons/index.es'

    let movies = [];
    let keyword = "";
    let sort_by = "";
    let filter = "";
    let per_page = 10;

    starter();

    function starter()
    {
        getMovies();
    }

    function getMovies()
    {
        const Request = new Rest();

        const data = {
            search : keyword,
            filter : filter,
            sort_by : sort_by,
            per_page : per_page,
        }

        let request = Request.request("/movie","GET", data );

        request.then( ( res ) => {
            movies = res.data;
        })
    }


    function changeKeyword( e )
    {
        keyword = e.detail.value;
    }


    function changeSortBy( e )
    {
        sort_by = e.detail.value;
    }


    function changeFilter( e )
    {
        filter = e.detail.value;
    }

    function changePerPage( e )
    {
        filter = e.detail.value;
    }
</script>
<div class="grid grid-cols-1 md-grid-cols-5 lg:grid-cols-5" >
    <Filter
        on:change_keyword = { changeKeyword }
        on:change_sort_by = { changeSortBy }
        on:change_filter = { changeFilter }
        on:change_per_page = { changePerPage }
    />

    <div class="lg:col-start-3 md-col-end-5 lg:col-end-5 px-4 mb-14 w-full" >
        <div class="flex justify-end">
            <label for="modal-create" class="btn btn-primary modal-button">Tambah</label>
        </div>

        { #each movies as movie }
            <div class="card card-side bg-base-100 shadow-xl mt-4 w-full" >
                <figure><img src="https://placeimg.com/200/280/arch" alt="Movie"></figure>
                <div class="card-body">
                    <div class="flex justify-between">
                        <h2 class="card-title">{ movie.title }</h2>
                        <div class="">
                            <button class="btn btn-circle bg-error">
                                <Fa icon={ faTrash }></Fa>
                            </button>

                            <button class="btn btn-circle bg-green">
                                <Fa icon={ faPencil }></Fa>
                            </button>
                        </div>
                    </div>
                    <div class="w-full info">
                        <div class="flex justify-between">
                            <div><b>Genre : </b></div>
                            <div>{ movie.genre }</div>
                        </div>
                        <div class="flex justify-between">
                            <div><b>Rating : </b></div>
                            <div>{ movie.rating }</div>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div><b>Dibuat : </b></div>
                        <div>{ movie.created_at }</div>
                    </div>
                    <div class="card-actions justify-end mt-4">
                        <button class="btn btn-primary">Lihat Detail</button>
                    </div>
                </div>
            </div>
        { :else }
            <div class="alert alert-error shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Error! Task failed successfully.</span>
                </div>
            </div>
        { /each }
    </div>
</div>

<ModalCreate on:created = { getMovies }/>
