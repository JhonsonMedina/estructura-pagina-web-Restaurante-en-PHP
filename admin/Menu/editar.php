<?php  

include("../bd.php");


if($_POST){
    $txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
    $nombre = (isset($_POST['nombre']))?$_POST['nombre']:"";
    $ingredientes= (isset($_POST['ingredientes']))?$_POST['ingredientes']:"";
    $precio= (isset($_POST['precio']))?$_POST['precio']:"";


$sentencia=$conexion->prepare(" UPDATE `tbl_menu`
 SET nombre= :nombre, 
 ingredientes= :ingredientes, 
 precio= :precio
WHERE ID= :id");

$sentencia->bindParam(":nombre", $nombre);
$sentencia->bindParam(":ingredientes", $ingredientes);
$sentencia->bindParam(":precio", $precio);
$sentencia->bindParam(":id", $txtID);


$sentencia->execute();

//Proceso de actuaizacion de foto

$foto = (isset($_FILES['foto']["name"]))?$_FILES['foto']["name"]:"";
$tmp_foto= $_FILES["foto"]["tmp_name"];

if($foto!=""){

    $fecha_foto = new DateTime();
    $nombre_foto=$fecha_foto->getTimestamp()."_".$foto;
    move_uploaded_file($tmp_foto,"../../images/menu/".$nombre_foto);

    $sentencia= $conexion->prepare("SELECT * FROM `tbl_menu`  WHERE ID=:id");
    $sentencia->bindParam(':id',$txtID);
    $sentencia->execute();

    $registro_foto=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_foto['foto'])){
        if(file_exists("../../images/menu/".$registro_foto['foto'])){
          unlink("../../images/menu/".$registro_foto['foto']);
        }

    }


    $sentencia=$conexion->prepare(" UPDATE `tbl_menu`
 SET 
 foto= :foto 
WHERE ID= :id");

$sentencia->bindParam(":foto", $nombre_foto);
$sentencia->bindParam(":id", $txtID);


$sentencia->execute();
header("Location:index.php");

}



}

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";

    
$sentencia= $conexion->prepare("SELECT * FROM `tbl_menu` WHERE ID=:id");
$sentencia->bindParam(":id", $txtID);
$sentencia->execute();
$registro=$sentencia->fetch(PDO::FETCH_LAZY);


$nombre=$registro['nombre'];
$ingredientes=$registro['ingredientes'];
$foto=$registro['foto'];

$precio=$registro['precio'];





}

include("../templates/header.php"); 
?>


<br/>

<div class="card">
    <div class="card-header">
        Menu de comidad
    </div>
    <div class="card-body">

    <form action="" method="post"  enctype="multipart/form-data">

    <div class="mb-3">
    <label for="titulo" class="form-label">ID:</label>
    <input type="text" class="form-control" value="<?php  echo $txtID; ?>" name="txtID"
        id="txtID" />
   
</div>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input
            type="text"
            class="form-control"
            name="nombre"
            id="nombre"
            aria-describedby="helpId"
            value="<?php  echo $nombre; ?>"
            placeholder="Nombre"
        />
     
    </div>

    <div class="mb-3">
        <label for="ingredientes" class="form-label">Ingredientes</label>
        <input
            type="text"
            class="form-control"
            name="ingredientes"
            id="ingredientes"
            aria-describedby="helpId"
            placeholder="Ingredientes"
            value="<?php  echo $ingredientes; ?>"
        />
        
    </div>

  <div class="mb-3">
    <label for="foto" class="form-label">Foto</label>
    <img width="50" src="../../images/menu/<?php  echo $foto; ?>"/>
    <input
        type="file"
        class="form-control"
        name="foto"
        id="foto"
        placeholder=""
        aria-describedby="fileHelpId"
    />
   
  </div>

  <div class="mb-3">
    <label for="precio" class="form-label">Precio</label>
    <input
        type="text"
        class="form-control"
        name="precio"
        id="precio"
        aria-describedby="helpId"
        placeholder="Precio"
         value="<?php  echo $precio; ?>"
    />
    
  </div>
  
  
  <button type="submit" class="btn btn-success">Actualizar</button>

<a name="" id="" class="btn btn-primary"  href="index.php" role="button">Cancelar</a>
    
    


    </form>
       
    </div>
    <div class="card-footer text-muted">

    </div>
</div>





<?php include("../templates/footer.php");  ?>
