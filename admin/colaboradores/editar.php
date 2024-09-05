<?php

include("../bd.php");


if($_POST){
    $txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
    $titulo = (isset($_POST['titulo']))?$_POST['titulo']:"";
    $descripcion = (isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $linkfacebook= (isset($_POST['linkfacebook']))?$_POST['linkfacebook']:"";
    $linkinstagram= (isset($_POST['linkinstagram']))?$_POST['linkinstagram']:"";
    $linklinkedin= (isset($_POST['linklinkedin']))?$_POST['linklinkedin']:"";


$sentencia=$conexion->prepare(" UPDATE `tbl_colaboradores`
 SET titulo= :titulo, 
 descripcion= :descripcion, 
 linkfacebook= :linkfacebook,
 linkinstagram= :linkinstagram,
 linklinkedin= :linklinkedin
WHERE ID= :id");

$sentencia->bindParam(":titulo", $titulo);
$sentencia->bindParam(":descripcion", $descripcion);
$sentencia->bindParam(":linkfacebook", $linkfacebook);
$sentencia->bindParam(":linkinstagram", $linkinstagram);
$sentencia->bindParam(":linklinkedin", $linklinkedin);
$sentencia->bindParam(":id", $txtID);


$sentencia->execute();

//Proceso de actuaizacion de foto

$foto = (isset($_FILES['foto']["name"]))?$_FILES['foto']["name"]:"";
$tmp_foto= $_FILES["foto"]["tmp_name"];

if($foto!=""){

    $fecha_foto = new DateTime();
    $nombre_foto=$fecha_foto->getTimestamp()."_".$foto;
    move_uploaded_file($tmp_foto,"../../images/colaboradores/".$nombre_foto);

    $sentencia= $conexion->prepare("SELECT * FROM `tbl_colaboradores`  WHERE ID=:id");
    $sentencia->bindParam(':id',$txtID);
    $sentencia->execute();

    $registro_foto=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_foto['foto'])){
        if(file_exists("../../images/colaboradores/".$registro_foto['foto'])){
          unlink("../../images/colaboradores/".$registro_foto['foto']);
        }

    }


    $sentencia=$conexion->prepare(" UPDATE `tbl_colaboradores`
 SET 
 foto= :foto 
WHERE ID= :id");

$sentencia->bindParam(":foto", $nombre_foto);
$sentencia->bindParam(":id", $txtID);


$sentencia->execute();


}



}

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";

    
$sentencia= $conexion->prepare("SELECT * FROM `tbl_colaboradores` WHERE ID=:id");
$sentencia->bindParam(":id", $txtID);
$sentencia->execute();
$registro=$sentencia->fetch(PDO::FETCH_LAZY);


$titulo=$registro['titulo'];
$descripcion=$registro['descripcion'];
$foto=$registro['foto'];

$linkfacebook=$registro['linkfacebook'];
$linkinstagram=$registro['linkinstagram'];
$linklinkedin=$registro['linklinkedin'];




}

include("../templates/header.php"); 
?>


<div class="card">
    <div class="card-header">Colaboradores</div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
    <label for="titulo" class="form-label">ID:</label>
    <input type="text" class="form-control" value="<?php  echo $txtID; ?>" name="txtID"
        id="txtID" />
   
</div>

<div class="mb-3">
    
    <label for="foto" class="form-label">Foto</label>
    <img width="50" src="../../images/colaboradores/<?php  echo $foto; ?>"/>
    <input type="file" class="form-control" name="foto" id="foto" placeholder=""/>
    
    <div class="mb-3">
        <label for="" class="form-label">Titulo</label>
        <input type="text"class="form-control" name="titulo" id="titulo" value="<?php  echo $titulo; ?>" aria-describedby="helpId" placeholder=""
        />
    </div>
    
   <div class="mb-3">
    <label for="descripcion" class="form-label">Descripcion</label>
    <input type="text" class="form-control" name= "descripcion" value="<?php  echo $descripcion; ?>" id="descripcion" aria-describedby="helpId" placeholder=""
    />
   </div>
   
     <div class="mb-3">
        <label for="linkfacebook" class="form-label">facebook:</label>
        <input
        value="<?php  echo $linkfacebook; ?>"
            type="text"
            class="form-control"
            name="linkfacebook"
            id="linkfacebook"
            aria-describedby="helpId"
            placeholder=""
        />
     </div>

     <div class="mb-3">
        <label for="linkinstagram" class="form-label">Instagram:</label>
        <input
        value="<?php  echo $linkinstagram; ?>"
            type="text"
            class="form-control"
            name="linkinstagram"
            id="linkinstagram"
            aria-describedby="helpId"
            placeholder=""
        />
     </div>
     

     <div class="mb-3">
        <label for="linklinkedin" class="form-label">Linkedin:</label>
        <input
        value="<?php  echo $linklinkedin; ?>"
            type="text"
            class="form-control"
            name="linklinkedin"
            id="linklinkedin"
            aria-describedby="helpId"
            placeholder=""
        />
     </div>

     <button type="submit" class="btn btn-success">Modificar Colaborador</button>

<a name="" id="" class="btn btn-primary"  href="index.php" role="button">Cancelar</a>
     
    </form>

    </div>
    
    <div class="card-footer text-muted">
       
     </div>
    </div>
   



<?php include("../templates/footer.php");  ?>