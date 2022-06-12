<template>
  <nav >
    <ul>
    <li><router-link to="/">Inicio</router-link></li>
    |
    <li><router-link to="/listar">Lista </router-link></li>
    |
    <li><router-link to="/crear">Crear</router-link></li>
    |
    <li><router-link :to="{name:'Archivo',params:{id:0}}" >Archivo</router-link></li>
    </ul>

  </nav>
  <router-view/> 
</template>


