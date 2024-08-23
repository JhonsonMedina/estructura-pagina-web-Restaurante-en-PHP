<?php

session_start();

if($_POST){

 if(($_POST['usuario']=="Jhonson") && ( $_POST['contraseña']== "9513") ){
   
    $_SESSION['usuario']="jhonson";

   header("location: index.php");

} else{
    echo "<script> alert('Usuario o contraseña incorrecta');</script>";
}


}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    </head>

    <body>

   <div class="container">
    
<div class="row">

    <div class="col-md-4"></div>

<div class="col-md-4">


</br>
<div class="card text-center">

    <div class="card-header">Inicio</div>
    <div class="card-body">

    <form action="index.php" method="post">

     <label for="" class="form-label"> Usuario:</label>  
      <input class = "form-control" type="text" name="usuario" id="">    
    </br>    

    <label for="" class="form-label">  Constraseña:</label> 
      <input class = "form-control" type="password" name="contraseña" id=""> 
     </br>

    <button class="btn btn-primary " type="submit">Entrar</button>

    </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>



  

</div>
   
    <div class="col-md-4"></div>

  </div>

   
</div>


<script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    
    </body>
</html>
