
<!--HTML-->

<!DOCTYPE html>
<html lang="es">
<head>
<title>CLIENTES</title>


<?php include '../partials/headA.php';?>

<?php include '../partials/menuA.php';?>


<main>

  <!--info--> 

  </--formulario--/>

<center>

    <?php 
        include("../../logica/conexion.php");
        $con=conectar();

        $sql="SELECT *  FROM clientes";
        $query=mysqli_query($con,$sql);

        $row=mysqli_fetch_array($query);
    ?>

    <div id="wrapper" class="clientes">

        <h1>
        CLIENTES
        </h1>

        <center>
            <div class="col-md-1">
                </div>
                    <div class="col-md-10">

                        <form class="form-group col-md-12" method="POST" name="form-work" action="clientes.php">
                            <fieldset>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <h3 class="control-label" for="text">Celular</h3>
                                        <input type="text" name="prenda" id="prenda" class="form-control" placeholder="Ingrese nuevo producto." required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <h3 class="control-label" for="text">Nombre</h3>
                                        <input type="text" name="prenda" id="prenda" class="form-control" placeholder="Ingrese nuevo producto." required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <h3 class="control-label" for="text">Correo</h3>
                                        <input type="text" name="prenda" id="prenda" class="form-control" placeholder="Ingrese nuevo producto.">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <h3 class="control-label" for="text">Dirección</h3>
                                        <input type="text" name="prenda" id="prenda" class="form-control" placeholder="Ingrese nuevo producto.">
                                    </div>
                                </div>
                                <button  type="submit" class="btn btn-primary btn-lg btn-block info">Guardar</button>
                            </fieldset>
                        </form>
                    </div>

                    <div class="container mt-12">
                        <div class="row"> 
                            
                            <div class="col-md-12">
                            <table class="table" >
                                <thead class="table-success table-striped" >
                                    <tr>
                                        <th>id</th>
                                        <th>Celular</th>
                                        <th>Nombre_cliente</th>
                                        <th>Correo</th>
                                        <th>Dirección</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                        <?php
                                            while($row=mysqli_fetch_array($query)){
                                        ?>
                                            <tr>
                                                <th><?php  echo $row['id']?></th>
                                                <th><?php  echo $row['celular']?></th>
                                                <th><?php  echo $row['nombre_cliente']?></th>
                                                <th><?php  echo $row['correo']?></th>
                                                <th><?php  echo $row['direccion']?></th>

                                                <!--<th><a href="actualizar.php?id=<?php echo $row['N_factura'] ?>" class="btn btn-info">Editar</a></th>
                                                <th><a href="delete.php?id=<?php echo $row['N_factura'] ?>" class="btn btn-danger">Eliminar</a></th>-->                                        
                                            </tr>
                                        <?php 
                                            }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            <div class="col-md-1">
            </div>
        </center>  
    </div>

</center>

</main>



<?php include '../partials/footerA.php';?>