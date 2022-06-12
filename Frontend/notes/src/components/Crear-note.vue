<template>
    <div class="container">
        <br>
        <div class="card">
            <div class="card-header">
                <b>Crear Nota</b>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="agregarNota">
                    <div class="form-group">
                      <label for="">Title</label>
                      <input type="text"
                        class="form-control" required name="title" v-model="nota.title"  id="title" maxlength="100" aria-describedby="helpId" placeholder="">
                      
                    </div>
               
                    <div class="form-group">
                      <label for="">Content</label>
                      <input type="text"
                        class="form-control" required name="content" v-model="nota.content"  id="content"  maxlength="1000" aria-describedby="helpId" placeholder="">
                      
                    </div>
                    <br>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                        
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
    methods:{
        agregarNota(){
            
            var datos={title:this.nota.title, content:this.nota.content}
            fetch('http://localhost/notas/?insertar=1',{
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
