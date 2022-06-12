<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "notas";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);


// Consulta datos y recepciona un id para consultar dichos datos con dicho id
if (isset($_GET["consultar"])){
    
    $sqlnotes = mysqli_query($conexionBD,"SELECT * FROM notas WHERE  id=".$_GET["consultar"]);
    
    if(mysqli_num_rows($sqlnotes) > 0){
        $notas = mysqli_fetch_all($sqlnotes,MYSQLI_ASSOC);
        echo json_encode($notas );
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar un id ( para borrado )
if (isset($_GET["borrar"])){
    $sqlnotes = mysqli_query($conexionBD,"DELETE FROM notas WHERE id=".$_GET["borrar"]);
    if($sqlnotes){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Inserta un nuevo registro y recepciona en método post los datos de titulo y contenido
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $title=$data->title;
    $content=$data->content;
    $archived=1;
    
        if(($title!="")&&($content!="")&&($archived!="")){
            
    $sqlnotes = mysqli_query($conexionBD,"INSERT INTO notas(title,content,archived) VALUES('$title','$content','$archived') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}
// Actualiza datos y recepciona datos de nombre, correo y un id para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
    $title=$data->title;
    $content=$data->content;
    $archived=$data->archived;
    
    $sqlnotes = mysqli_query($conexionBD,"UPDATE notas SET title='$title',content='$content', archived='$archived' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Archiva las notas
if(isset($_GET["archivar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["archivar"];
    $archived=0;
    
    
    $sqlnotes = mysqli_query($conexionBD,"UPDATE notas SET archived='$archived' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Desarchiva las notas
if(isset($_GET["desarchivar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["desarchivar"];
    $archived=1;
    
    
    $sqlnotes = mysqli_query($conexionBD,"UPDATE notas SET archived='$archived' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Consulta todos los registros de la tabla notas archivadas
if(isset($_GET["archivo"])){
    $sqlnotes = mysqli_query($conexionBD,"SELECT * FROM notas WHERE  archived=".$_GET["archivo"]);
    
    if(mysqli_num_rows($sqlnotes) > 0){
        $notas  = mysqli_fetch_all($sqlnotes,MYSQLI_ASSOC);
        echo json_encode($notas);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}


// Consulta todos los registros de la tabla notas sin archivar 
$sqlnotes = mysqli_query($conexionBD,"SELECT * FROM notas WHERE archived=1");
if(mysqli_num_rows($sqlnotes) > 0){
    $notas  = mysqli_fetch_all($sqlnotes,MYSQLI_ASSOC);
    echo json_encode($notas);
}
else{ echo json_encode([["success"=>0]]); }


?>
