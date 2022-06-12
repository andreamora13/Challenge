<template>
    <div class="container" >
        <br>
            <div class="card" >
                <div class="card-header">
                    <b>Notas Activas</b>
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

                                            <button type="button" v-on:click="archivarNota(nota.id)" class="btn btn-warning">Archivar</button>
                                            <router-link :to="{name:'Editar',params:{id:nota.id,archived:nota.archived}}" class="btn btn-info">Editar</router-link>
                                            
                                            <button type="button" v-on:click="borradoNota(nota.id)" class="btn btn-danger">Borrar</button>
                                            
                                        </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
            </div>
            
        
    

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
        this.consultarNota();

    },
    methods:{
        //http://localhost/empleados/
        consultarNota(){
            fetch('http://localhost/notas/')
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
            fetch('http://localhost/notas/?archivar='+id)
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

