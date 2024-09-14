<?php

include("../bd.php");

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("DELETE FROM tbl_comentarios where ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}


$sentencia= $conexion->prepare("SELECT * FROM `tbl_comentarios`");
$sentencia->execute();
$lista_comentarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../templates/header.php"); 

if($_POST){
//para impedir que el usuario envia otro tipo de informacio
    $nombre=filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
    $correo = filter_var($_POST["correo"], FILTER_SANITIZE_EMAIL);
    $mensaje=filter_var($_POST["mensaje"],FILTER_SANITIZE_STRING);

    if($nombre &&  $correo && filter_var($correo, FILTER_VALIDATE_EMAIL) && $mensaje){

    $sql=  "INSERT INTO
     tbl_comentarios (nombre, correo, mensaje)
      VALUES (:nombre, :correo,:mensaje)";

    $sentencia=$conexion->prepare($sql);
    $sentencia->bindParam(":nombre", $nombre,  PDO::PARAM_STR);
    $sentencia->bindParam(":correo", $correo, PDO::PARAM_STR);
    $sentencia->bindParam(":mensaje", $mensaje, PDO::PARAM_STR);
    $sentencia->execute();
    


    }



}

?>

<br/>

<div class="card">
    <div class="card-header">
        Bandeja de comentarios
    </div>
    <div class="card-body">


    <div
        class="table-responsive-sm"
    >
        <table
            class="table "
        >
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Mensaje</th>
                    <th scope="col">Accciones</th>
                </tr>
            </thead>
            <tbody>

<?php foreach($lista_comentarios as $comentarios){  ?>

                <tr class="">
                    <td scope="row"><?php echo  $comentarios['id']; ?></td>
                    <td><?php echo  $comentarios['nombre']; ?></td>
                    <td><?php echo  $comentarios['correo']; ?></td>
                    <td><?php echo  $comentarios['mensaje']; ?></td>
                    <td>

        <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo  $comentarios['id']; ?>" role="button">Borrar</a>
                    </td>
                </tr>

        <?php } ?>
                
            </tbody>
        </table>
    </div>
    
      
    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>









<?php include("../templates/footer.php");  ?>