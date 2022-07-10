<script>
    "use strict";

    import { onMount, createEventDispatcher } from 'svelte';
    import {} from 'svelte';

    const dispatch = createEventDispatcher;

    $:if( keyword || ! keyword ){
        // @ts-ignore
        dispatch("change_keyword",{ value : keyword });
    }
    $:if( sort_by || ! sort_by ){
        // @ts-ignore
        dispatch("change_sort_by",{ value : keyword });
    }
    $:if( filter || ! filter ){
        // @ts-ignore
        dispatch("change_filter",{ value : keyword });
    }
    $:if( per_page ){
        // @ts-ignore
        dispatch("change_per_page", { value : per_page });
    }


    let keyword = "";
    let sort_by = "";
    let filter   = "";
    let per_page = "10";

    function resetFilter()
    {
        keyword = "";
        sort_by = "";
        filter   = "";
    }
</script>
<div class="lg:col-start-2 md:col-start-2 lg:col-end-2 px-4 mb-14">
    <div class="w-full bg-white rounded-xl overflow-hdden shadow-md p-4">
            <div class="relative flex w-full flex-wrap items-stretch mb-3">
                <input type="text" placeholder="Search…" class="input input-success input-bordered w-full" bind:value={ keyword }/>

            </div>

            <div class="relative flex w-full flex-wrap items-stretch mb-3">
                <select class="select select-success w-full " bind:value = { sort_by }>
                    <option value ="" disabled selected >Urutkan Berdasarkan</option>
                    <option value ="id:DESC">Terbaru</option>
                    <option value ="id:ASC">Terlama</option>
                    <option value ="rating:DESC">Rating Terbaik</option>
                    <option value="rating:ASC">Rating Terendah</option>
                    <option value="updated_at:DESC">Terbaru Di update</option>
                    <option value="updated_at:ASC">Terlama Di Update</option>
                </select>
            </div>

            <div class="relative flex w-full flex-wrap items-stretch mb-3">
                <select class="select select-success w-full " bind:value = { filter }>
                    <option value ="" disabled selected >Pilih Genre</option>
                    <option value ="genre:action">Action</option>
                    <option value ="genre:romance">Romance</option>
                    <option value ="genre:anime">Anime</option>
                    <option value="genre:horor">Horor</option>
                    <option value="genre:drama">Drama</option>
                    <option value="genre:crime">Crime</option>
                    <option value="genre:comedy">Comedy</option>
                    <option value="genre:fantasy">Fantasy</option>
                </select>

            </div>

            <div class="relative flex w-full flex-wrap items-stretch mb-3">
                            <select class="select select-success w-full " bind:value = { per_page }>
                                <option value ="10" selected >10</option>
                                <option value ="15">15</option>
                                <option value ="25">25</option>
                                <option value ="50">50</option>
                                <option value="100">100</option>
                            </select>
            </div>

            <div class="relative items-stretch mb-3 w-full">

                <button type="button" class="btn btn-error w-full" on:click={ resetFilter }>Reset Filter</button>
            </div>
    </div>
</div>

