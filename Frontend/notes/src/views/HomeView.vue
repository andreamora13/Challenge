<template>
  <div class="home">
    <br>
    <center>
    <h1 style="color:white">Empieza a crear tus notas</h1>
    <img alt="Vue logo" src="../assets/note.png">
    <HelloWorld msg="Welcome to Your Vue.js App"/>
    </center>
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'

export default {
  name: 'HomeView',
  components: {
    HelloWorld
  }
}
</script>
