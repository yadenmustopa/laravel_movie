<script>
// @ts-nocheck

    "use strict";
    // const Rest = require("@/module/Rest");
    import Rest from '@/module/Rest';
    import Filter from '@/components/Filter.svelte';
    import ModalCreate from '@/modal/Create.svelte';
    import ModalUpdate from '@/modal/Update.svelte';
    import ModalDeskripsi from '@/modal/Deskripsi.svelte';
    import {  confirm, openToast } from '@/module/sweetalert2';
    import Fa from 'svelte-fa/src/fa.svelte'
    import { faPencil, faTrash } from '@fortawesome/free-solid-svg-icons/index.es'
    import { fromNow } from '@/lib/handle_moment';
    import Pagination from '@/components/Pagination.svelte';

    let movies = [];
    let keyword = "";
    let sort_by = "";
    let filter = "";
    let page = "";
    let per_page = 10;
    let data_selected = {};
    let pagination;
    let count_all;

    starter();

    function starter()
    {
        getMovies();
    }

    function getMovies()
    {
        const Request = new Rest();

        const data = {
            page : page,
            search : keyword,
            filter : filter,
            order_by : sort_by,
            per_page : per_page,
        }

        let request = Request.request("/movie","GET", data );

        request.then( ( res ) => {
            movies = res.data.data;
            pagination = res.data.pagination;
            count_all = pagination.count_all;
            console.log({ res });
        })
    }


    function changeKeyword( e )
    {
        keyword = e.detail.value;
        getMovies();
    }


    function changeSortBy( e )
    {
        sort_by = e.detail.value;
        getMovies();
    }


    function changeFilter( e )
    {
        filter = e.detail.value;
        getMovies();
    }

    function changePerPage( e )
    {
        per_page = e.detail.value;
        getMovies();
    }


    async function remove( id, title )
    {
        let sure = await confirm( "Hapus!!!","Apakah Yakin Akan Menghapus "+ title );
        console.log()
        if( sure ){

            let Request = new Rest();

            let req = Request.request("/movie/"+ id , "DELETE" );

            req.then( ( res ) => {
                console.log({ res });
                getMovies();
                openToast( "success", "Berhasil Menghapus " + title );
            });
        }
    }

    function hasCreated( e )
    {
        console.log("has createed");
        getMovies();
    }

    function hasUpdated( e )
    {
        console.log("has createed");
        getMovies();
    }

    /**
     *
     * @param id
     * @param title
     * @param poster
     * @param description
     * @param genre
     * @param rating
     */
    function selectedData( id, title, poster, description, genre, rating )
    {
        data_selected = { id, title, poster, description, genre, rating }
    }


    function changePage( e ){
        page= e.detail.page_to;
        console.log({ page });
        getMovies();
    }
</script>

<style>
    figure img{
        max-width:250px !important;
        min-width:200px !important;
    }
</style>
<div class="grid grid-cols-1 md-grid-cols-5 lg:grid-cols-5" >
    <Filter
        { count_all }
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
                <figure class="ml-6"><img src="./assets/{ movie.poster }" alt="Movie"></figure>
                <div class="card-body">
                    <div class="flex justify-end">
                        <div class="">
                            <button class="btn btn-circle bg-error" on:click= { remove( movie.id, movie.title )}>
                                <Fa icon={ faTrash }></Fa>
                            </button>

                            <label for="modal-update" class="btn btn-circle bg-green modal-button" on:click = { () => selectedData( movie.id, movie.title, movie.poster, movie.description, movie.genre, movie.rating) }>
                                <Fa icon={ faPencil }></Fa>
                            </label>
                        </div>
                    </div>
                    <div class="w-full info mt-4">
                        <h2 class="card-title"><b>{ movie.title }</b></h2>
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
                        <div>{ fromNow( movie.created_at ) }</div>
                    </div>
                    <div class="card-actions justify-end mt-4">
                        <label for="modal-deskripsi" class="btn btn-primary" on:click = { () => selectedData( movie.id, movie.title, movie.poster, movie.description, movie.genre, movie.rating) }>Lihat Detail Deskripsi</label>
                    </div>
                </div>
            </div>
        { :else }
            <div class="alert alert-error shadow-lg mt-4">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span >Data Tidak Di temukan</span>
                </div>
            </div>
        { /each }

        <Pagination data={ pagination } _class="mt-4" on:click={ changePage }></Pagination>
    </div>
</div>

<ModalCreate on:created = { hasCreated }/>
<ModalUpdate { data_selected }  on:updated = { hasUpdated }/>
<ModalDeskripsi { data_selected } />
