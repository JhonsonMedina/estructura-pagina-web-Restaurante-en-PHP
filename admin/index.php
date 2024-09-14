<?php include("templates/header.php");  ?>
<br/>
<div class="row align-items-md-stretch">
    <div class="col-md-12">
        <div
            class="h-100 p-5 border rounded-3"
        >
            <h2>Bienveni@ al Administrador <?php echo $_SESSION['usuario'];  ?> </h2>
            <p>
               Este espacio es para administrador de tu sitio web
            </p>
            <button
                class="btn btn-outline-primary"
                type="button"
            >
                Iniciar Ahora
            </button>
        </div>
    </div>
    
</div>



<?php include("templates/footer.php");  ?>