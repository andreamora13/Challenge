<template>
    <div class="container">
        <br>
        <div class="card">
            <div class="card-header">
                <b>Notas Archivadas </b>
            </div>
            <div class="card-body">
               <table class="table">
                   <thead>
                       <tr>
                           <th>ID</th>
                           <th>Title</th>
                           <th>Content</th>
                           <th>Date</th>
                       </tr>
                   </thead>
                   <tbody>
                       <tr v-for="nota in notas" :key="nota.id">
                           <td>{{nota.id}}</td>
                           <td>{{nota.title}}</td>
                           <td>{{nota.content}}</td>
                           <td>{{nota.date}}</td>
                           <td>
                                <div class="btn-group" role="group" aria-label="">

                                    <button type="button" v-on:click="archivarNota(nota.id)" class="btn btn-warning">Desarchivar</button>
                                    <router-link :to="{name:'Editar',params:{id:nota.id,archived:nota.archived}}" class="btn btn-info">Editar</router-link>
                                    
                                    <button type="button"  v-on:click="borradoNota(nota.id)" class="btn btn-danger">Borrar</button>
                                    
                                </div>
                               
                           </td>
                       </tr>
                      
                   </tbody>
               </table>
            </div>
            
        </div>
                <!-- Button trigger modal -->
        
    </div>
   
</template>
<script>
export default {
    data(){
        return{
            notas:[]
        }
    },
    created:function(){
        this.obtenerInfo();

    },
    methods:{
        obtenerInfo(){
            
            fetch('http://localhost/notas/?archivo='+this.$route.params.id)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                this.notas=[]
                if(typeof datosRespuesta[0].success==='undefined')
                {
                    this.notas=datosRespuesta;
                }
                
            })
            .catch(console.log)
        },
        borradoNota(id){
            var resultado = window.confirm('Estas seguro de borrar la nota?');
            if (resultado === true) {
                this.borrarNota(id);
                window.alert('Nota eliminada');
            } else { 
               
               window.alert('No se elimino');
            }
        },
        borrarNota(id){
            console.log(id);
            fetch('http://localhost/notas/?borrar='+id)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                window.location.href="listar"
            })
            .catch(console.log)
        },
        archivarNota(id){
            console.log(id);
            fetch('http://localhost/notas/?desarchivar='+id)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                window.location.href="listar"
            })
            .catch(console.log)
        }
        
    }
}


</script>


<style>
    /* The Modal (background) */
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    }

    .close:hover,
    .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
    }

</style>>