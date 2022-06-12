<template>
    <div class="container">
        <br>
        <div class="card">
            <div class="card-header">
                <b>Editar Nota</b>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="editarNota">
                    <div class="form-group">
                      <label for="">Title</label>
                      <input type="text"
                        class="form-control" required name="title" v-model="nota.title"  id="title" aria-describedby="helpId" placeholder="">
                      
                    </div>
               
                    <div class="form-group">
                      <label for="">Content</label>
                      <input type="text"
                        class="form-control" required name="content" v-model="nota.content"  id="content" aria-describedby="helpId" placeholder="">
                     
                    </div>
                    <br>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" class="btn btn-primary">Editar</button>
                        
                        <router-link :to="{name:'Listar'}" class="btn btn-warning">Cancelar</router-link>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            nota:{}
        }

    },
    created:function(){
        this.obtenerInfo();

    },
    methods:{
        obtenerInfo(){
            
            fetch('http://localhost/notas/?consultar='+this.$route.params.id)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                this.nota=datosRespuesta[0];
                
            })
            .catch(console.log)
        
        },
        
        editarNota(){

            var datos={id:this.$route.params.id, title:this.nota.title, content:this.nota.content, archived:this.$route.params.archived}
            fetch('http://localhost/notas/?actualizar='+this.$route.params.id,{
                method:"POST",
                body:JSON.stringify(datos)
            })
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta=>{
                    console.log(datosRespuesta);
                    window.location.href='../listar'
            }))
            .catch(console.log)
            
        }
    }
}
</script>