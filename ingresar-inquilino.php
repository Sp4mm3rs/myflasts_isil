<?php
    include 'config/conection.php';


    $sql_habitaciones = "SELECT * FROM habitaciones WHERE id_inquilino IS NULL";
    $res_habitaciones = mysqli_query( $conexion, $sql_habitaciones ) or die ( "Algo ha ido mal en la consulta a la base de datos");

    // Fecha de hoy
    $month = date('m');
    $day = date('d');
    $year = date('Y');

    $hoy = $year . '-' . $month . '-' . $day;




     
?>


<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ingresar inquilino - My Flats</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php 
            include 'nav-izquierda.php';
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php 
                    include 'header.php';
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <h1 class="h3 mb-4 text-gray-800">Ingresar inquilino</h1>
                    <form action="insert_inquilino.php" method="POST" enctype="multipart/form-data">       
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 titlesearch">
                            <h6 class="m-0 font-weight-bold text-primary">Datos inquilino</h6>
                        </div>
                        <div class="card-body">
                           <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="form-group col-md-6" style="position: relative;padding-right: 120px;">
                                            <label for="inq_dni">DNI</label>
                                            <input type="text" class="form-control" id="inq_dni" name="inq_dni" placeholder="Ingresa DNI"required>
                                            <button class="btn btn-primary" style="position: absolute;right: 12px;bottom: 0;height: 38px;padding: 0 21px;" onclick="reniec()">Validar</button>
                                        </div>
                                       <div class="form-group col-md-6">
                                            <label for="inq_nombre">Nombres</label>
                                            <input type="text" class="form-control" id="inq_nombre" name="inq_nombre" placeholder="Ingresa nombres" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inq_apellido">Apellidos</label>
                                            <input type="text" class="form-control" id="inq_apellido" name="inq_apellido" placeholder="Ingresa apellidos"required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inq_celular">Celular</label>
                                            <input type="text" class="form-control" id="inq_celular" name="inq_celular" placeholder="Ingresa celular" pattern="[9][0-9]{8}" title="Se requiere 9 digitos y el primero que sea 9"required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inq_email">Email</label>
                                            <input type="email" class="form-control" id="inq_email" name="inq_email" placeholder="Ingresa email"required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inq_cant">Cantidad inquilinos</label>
                                            <select id="inq_cant" name="inq_cant" class="form-control" required>
                                                <option selected>Seleccionar</option >
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>  
                                        <div class="form-group col-md-12">
                                            <label for="inq_observacion">Observaciones</label>
                                            <textarea class="form-control" id="inq_observacion" name="inq_observacion" rows="3"required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <img id="foto_inq" src="img/default.jpg" width="244px" height="244px" class="img-fluid" alt="Responsive image">
                                    </div>
                                    <div class="custom-file">
                                         <label id="elegirfoto" for="foto">Seleccionar foto</label>
                                         <input type="file" name="fotoacargar" value="" class="custom-file-input" id="foto" onchange="CargarFoto()" required>                                                                                                        
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>     
                    <!-- Page Heading -->
                    <h3 class="h3 mb-4 text-gray-800"></h3>
                            

                                <!-- DataTales Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 titlesearch">
                                        <h6 class="m-0 font-weight-bold text-primary">Habitaciones</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Habitación</th>
                                                        <th>Piso</th>
                                                        <th>Precio</th>
                                                        <th>Seleccionar</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <?php 
                                                        foreach ($res_habitaciones as $habitacion) {
                                                    ?>
                                                    <tr>
                                                        <td>Habitación <?php echo $habitacion['nro_habitacion'] ?></td>
                                                        <td>Piso <?php echo $habitacion['nro_piso'] ?></td>
                                                        <td>S/ <?php echo $habitacion['precio'] ?></td>
                                                        <td><input type="radio" name="habitacion[]" value="<?php echo $habitacion['id_hab'] ?>" required></td>
                                                    </tr>
                                                    <?php } ?>                                                                                                  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 titlesearch">
                                    <h6 class="m-0 font-weight-bold text-primary">Fecha</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                         <div class="form-group col-md-6">
                                            <label for="inputEmail4">Fecha ingreso</label>
                                            <input class="form-control" type="date" name="fechaInicio" value="<?php echo $hoy; ?>" id="date-input-ingreso">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Fecha fin</label>
                                            <input class="form-control" type="date" name="fechaFin" value="<?php echo $hoy; ?>" id="date-input-fin">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 titlesearch">
                                    <h6 class="m-0 font-weight-bold text-primary">Servicios</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-check">
                                      <input class="form-check-input" name="serInternet" type="checkbox" value="1" id="ser_internet">
                                      <label class="form-check-label" for="ser_internet">Internet (S/30.00 adicional)</label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" name="serCable" type="checkbox" value="1" id="ser_cable">
                                      <label class="form-check-label" for="ser_cable">Cable (S/30.00 adicional)</label>
                                    </div>
                               </div>
                            </div>       
                           
                            <div class="mb-4">   
                                <button type="submit" name="rInquilino" class="btn btn-primary">Agregar</button>
                                <a class="btn btn-secondary" href="listadeinquilino.php">Cancelar</a>
                            </div>
                            
                    </form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; My Flats 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
    function CargarFoto(){
        var image = document.getElementById('foto_inq');
        image.src = URL.createObjectURL(event.target.files[0]);
    }

   
    </script>
    <script>
        function reniec(){

            var val_dni = $('#inq_dni').val();
            var success = $.ajax({
              url: "validar_dni.php",
              method: "POST",
              data: { dni : val_dni },
              dataType: "json"
            });
             
            success.done(function( data ) {
               $.each(data, function(i, reniec){
                    $('#inq_nombre').val(reniec.name);
                    $('#inq_apellido').val(reniec.fathers_lastname + " " + reniec.mothers_lastname);
                });                    
            });
            
            success.fail(function( jqXHR, status ) {
              alert( "success failed: " + status );
            });

        }

        
    </script>

 

</body>

</html>