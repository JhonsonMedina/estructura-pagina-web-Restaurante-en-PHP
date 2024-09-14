<?php

include("admin/bd.php");

$sentencia = $conexion->prepare("SELECT * FROM tbl_banners ORDER BY id DESC limit 1");
$sentencia->execute();
$lista_banners = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT * FROM tbl_colaboradores ORDER BY id DESC  limit 3");
$sentencia->execute();
$lista_colaboradores = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT * FROM tbl_testimonios ORDER BY id DESC limit 2 ");
$sentencia->execute();
$lista_testimonios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT * FROM tbl_menu ORDER BY id DESC limit 4 ");
$sentencia->execute();
$lista_menu = $sentencia->fetchAll(PDO::FETCH_ASSOC);


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

        <link rel="stylesheet" href="style.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    </head>

    <body>

   
<nav class="navbar navbar-expand-lg bg-info-subtle ">
  <div class="container-fluid">
    <a class="navbar-brand nav-link" href="#"><i class="fas fa-utensils me-2"></i><strong>Restaurante </a></strong>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
       
        <a class="nav-link" href="#inicio"><strong>Inicio</a></strong>
        <a class="nav-link" href="#menu"><strong>Menu</a></strong>
        <a class="nav-link" href="#Chefs"><strong>Chefs</a></strong>
        <a class="nav-link" href="#Testimonios"><strong>Testimonio</a></strong>
        <a class="nav-link" href="#Contactos"><strong>Contactos</a></strong>
        <a class="nav-link" href="#Horarios"><strong>Horarios</a></strong>
      
      </div>
    </div>
  </div>
</nav>

<!--sub menu -->

<div id="inicio"  class="container-expand-lg"> 
 <div class="imagen text-center "> 

<?php foreach($lista_banners as $banners){ ?>


<h1 class="letras"> <?php echo $banners['titulo']; ?></h1>
<p class="letras-1"><?php echo $banners['descripcion']; ?></p>
<a href="<?php echo $banners['link']; ?>" class="btn btn-primary">Ver Menu</a>
      
<?php   }    ?>




 </div>  
</div>




<section class="Sub-menu bg-dark">

<div class="text-white text-center">
 <h1>Bienvenidos al Restaurant</h1>
 <p>Descubre una experiencia Unica</p>
</div>

</section>

<section id="Chefs" class="contain mt-4 ">
<h2 class="text-center">Nuestros  Chefs</h2>
</section>


 <!-- Chef que trabjan en el restaurante -->

<section>
<div class="container text-center   ">


<div class="row align-items-cente  ">

<?php foreach($lista_colaboradores as $colaborador){ ?>
    <div class="col-4 ">

   
 <img class="img3" src="images/colaboradores/<?php echo $colaborador['foto'];  ?> "/> 
  
  <h5><?php echo $colaborador['titulo']; ?></h5>
  <p><?php echo $colaborador['descripcion']; ?></p>
  <div>
    <a href="<?php echo $colaborador['linkfacebook']; ?>"><i class="fab fa-facebook"></i></a>
    <a href="<?php echo $colaborador['linkinstagram']; ?>"><i class="fab fa-instagram"></i></a>
    <a href="<?php echo $colaborador['linklinkedin']; ?>"><i class="fab fa-linkedin"></i></a>
  </div>
  
  
      </div>

      <?php   }    ?>
  </div>
</div>

</section>

<!--Testimonio-->

<section  id="Testimonios" class="bg-ligth py-5">

<div class="container">

<h2 class="text-center mb-4">Testimonio</h2>
<div class="row">

<?php  foreach($lista_testimonios as $testimonio) {  ?>
 
  <div class="col-md-6 d-flex">
    <div class="card mb-4 w-100">
        <div class="card-body">
          <p class="card-text"><?php echo $testimonio["opinion"]; ?></p>
        </div>
        <div class="card-footer text-muted"> 
       <?php echo $testimonio["nombre"]; ?>
        </div>
    </div>
  </div>
  
    
  <?php  } ?>

  </div>

  </div>

</section>






<!-- platos Recomendados-->
<section id="menu"   class="container mt-4">

<h2 class="text-center">Menu(nuestra recomendacion)</h2>
<br/>

<div class="row row-cols-1 row-cols-md-4 g-4">

<?php foreach($lista_menu as $menu)  { ?>
<div class="col d-flex">
  <div class="card">
    <img src="images/menu/<?php echo $menu['foto']; ?>" alt="tortillas" class="card-img-top">
     <div class="card-body">
      <h5 class="card-title"> <?php echo $menu['nombre']; ?></h5>
      <p class="card-text"><?php echo $menu['ingredientes']; ?></p>
      <p class="card-text"><?php echo $menu['precio']; ?></p>
    </div>
 </div>
</div>


<?php } ?>
</div>

</section>



<!-- Seccion de contacto-->
<section id="Contactos" class="container mt-4">


<h2>Contacto</h2>
<p>Estamos aqui para servirle</p>

<form action="?" method="post">

<div class="mb-3">
<label for="name">Nombre</label></br>
<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe tu nombre"...Required><br/>
</div>

<div class="mb-3">
<label for="email">Correo Electronico</label><br/>
<input type="email" class="form-control" name="correo" id="correo" placeholder="Escribe tu correo electronico"...Required><br/>
</div>

<div class="mb-3">
<label for="messaje">Mensaje</label><br/>
<textarea id="messaje" class="form-control" name="mensaje" rows="6" cols="50"></textarea><br/>
</div>

<input class="btn btn-primary" type="submit" value="Enviar Mensaje">

</form>

</section>
<br/>


<div id="Horarios" class="text-center bg-light p-4">
<h3 class="mb-4"> Horario de atencion</h3>

<div>
  <p> <strong>Lunes a Viernes</strong></p>
  <p> <strong>11:00 a.m. - 10:00 p.m.</strong></p>
</div>

<div>
  <p> <strong>Sabado</strong></p>
  <p> <strong>12:00 a.m. - 08:00 p.m.</strong></p>
</div>

<div>
  <p> <strong>Domingo</strong></p>
  <p> <strong>12:00 a.m. - 08:00 p.m.</strong></p>
</div>


</div>





<footer> 
  <p class="bg-dark text-light text-center py-3"> @2024 Restaurant la sombra, todos los derechos reservados </p>
</footer>


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
