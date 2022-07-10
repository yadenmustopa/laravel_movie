<script>
    import { onMount } from 'svelte';
  import logo from '@/assets/natindo.png';
//   import Counter from '@/lib/Counter.svelte';
    import List from '@/components/List.svelte';
    import Filter from '@/components/Filter.svelte';
    import TailwindCss from '@/TailwindCss.svelte';
</script>
<TailwindCss />
<div class="w-100 flex justify-center">
    <img src={ logo } style=";width:40rem" >
</div>
<main class="h-screen  transition-all duration-300">
  <!-- <img src={logo} alt="Svelte Logo" class="center"/> -->
  <!-- <h1 class="text-3xl font-bold underline">
    Hello world
  </h1> -->
  <div class="">
    <div class="bg-light-blue-500 pt-14 pb-28 px-3 md:px-8 h-auto">
        <div class="container mx-auto max-w-full">
            <List/>
        </div>
    </div>
  </div>

</main>

<style>
  :root {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen,
      Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  }

  main {
    text-align: center;
    padding: 1em;
    margin: 0 auto;
  }

  img {
    height: 16rem;
    width: 16rem;
  }

  h1 {
    color: #ff3e00;
    text-transform: uppercase;
    font-size: 4rem;
    font-weight: 100;
    line-height: 1.1;
    margin: 2rem auto;
    max-width: 14rem;
  }

  p {
    max-width: 14rem;
    margin: 1rem auto;
    line-height: 1.35;
  }

  @media (min-width: 480px) {
    h1 {
      max-width: none;
    }

    p {
      max-width: none;
    }
  }
</style>
