<template>
    <Navbar />
    <router-view/>
</template>

<script>
import Navbar from './components/Navbar'
export default {
  name: 'App',
  components: {
      Navbar
  }
}
</script>

<style>
* {
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
}

body {
    margin: 0;
    padding: 0;
}
</style>
