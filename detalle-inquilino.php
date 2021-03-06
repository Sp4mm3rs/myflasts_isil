<?php
    include 'config/conection.php';
    $dni = $_GET['dni'];
    
    $consulta = "SELECT * FROM inquilinos inq
                INNER JOIN habitaciones hab ON hab.id_inquilino = inq.id_inq
                WHERE dni = $dni
";
    $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");

    include 'sesion.php';
?>


<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Detalle de inquilinos - My Flats</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style type="text/css">
            
            label.error {
                font-size: 16px;
                color: #ff0000;
                width: 100%;
            }
            input.error {
                width: 100%;
                height: auto;
                font-size: initial;
                background: #f1a3a3;
            }
            .card-body.form-inqulino img {
                width: 100%;
                height: 275px;
                object-fit: cover;
                border-radius: 10px;
                box-shadow: 1px 4px 4px 0px #000;
            }
    </style>

</head>
<?php 
    foreach ($resultado as $inquilino) {

        
?>
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Detalle inquilino</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-32 titlesearch">
                            <h6 class="m-0 font-weight-bold text-primary">Acciones</h6>
                        </div>
                        <div class="card-body">
                           <div class="row">
                                <div class="col-md-3 d-flex justify-content-around">
                                     <td><a class="btn btn-outline-info" href="contrato/?dni=<?php echo $inquilino['dni'] ?>">Ver contrato</a></td>                              
                                </div>
                                <div class="col-md-3 d-flex justify-content-around">
                                    <button class="btn btn-outline-warning btn-editar">Editar inquilino</button>                        
                                </div>  
                                <div class="col-md-3 d-flex justify-content-around">
                                    <button class="btn btn-outline-success btn-actualizar" disabled>Actualizar</button>
                                </div>
                                <div class="col-md-3 d-flex justify-content-around">
                                    <td><a class="btn btn-outline-danger" href="" data-toggle="modal" data-target="#modal_obs_inquilino" >Finalizar contrato</a></td>      
                                </div>
                            </div>
                       </div>
                    </div>   
               
                    <form class="form-actualizar" method="POST" enctype="multipart/form-data" action="actualizar-inquilino.php?inq=<?php echo $inquilino['id_inq'] ?>&hab=<?php echo $inquilino['id_hab'] ?>">
                        
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 titlesearch" >
                                <h6 class="m-0 font-weight-bold text-primary">Detalle inquilino</h6>
                            </div>
                            <div class="card-body form-inqulino">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inq_nombre">Nombres</label>
                                                <input type="text" class="form-control " id="inq_nombre" name="inq_nombre" value="<?php echo $inquilino['nombre'] ?>" readonly disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inq_apellido">Apellidos</label>
                                                <input type="text" class="form-control " id="inq_apellido" name="inq_apellido" value="<?php echo $inquilino['apellido'] ?>" readonly disabled>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inq_dni">DNI</label>
                                                <input type="text" class="form-control " id="inq_dni" name="inq_dni" value="<?php echo $inquilino['dni'] ?>" readonly disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inq_celular">Celular</label>
                                                <input type="text" class="form-control" id="inq_celular" name="inq_celular" value="<?php echo $inquilino['celular'] ?>" pattern="[9][0-9]{8}" title="Se requiere 9 digitos y el primero que sea 9" disabled required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inq_email">Email</label>
                                                <input type="email" class="form-control" id="inq_email" name="inq_email" value="<?php echo $inquilino['correo'] ?>"  required disabled>
                                                
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inq_cantidad">Cantidad inquilinos</label>
                                                <input type="text" class="form-control" id="inq_cantidad" name="inq_cantidad" value="<?php echo $inquilino['cant_inquilino'] ?>" disabled>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="exampleFormControlTextarea1">Observaciones</label>
                                                    <textarea disabled class="form-control" id="exampleFormControlTextarea1" name="inq_observacion" rows="3"><?php echo $inquilino['observaciones'] ?></textarea>
                                            </div>
                                        </div>
                                            
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <img src="<?php echo $inquilino['foto']?>"  class="img-fluid" alt="Responsive image" id="foto_inq" name="foto_inq">
                                            <label id="elegirfoto" for="actfoto">Seleccionar foto</label>
                                            <input type="file" name="afoto" value="" class="custom-file-input inputfoto" id="actfoto" onchange="ActFoto()" disabled > 
                                        </div>
                                    </div>

                                </div>  
                            </div>
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 titlesearch">
                                <h6 class="m-0 font-weight-bold text-primary">Habitaci??n</h6>
                            </div>
                            <div class="card-body form-habitacion">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Habitaci??n</th>
                                                <th>Piso</th>
                                                <th>Precio</th>
                                            </tr>
                                        </thead>
                                                
                                        <tbody>
                                            <tr>
                                                <td> <input type="text" class="form-control" id="inq_habitacion" name="inq_habitacion" value="Habitaci??n <?php echo $inquilino['nro_habitacion'] ?>" disabled> </td>
                                                <td><input type="text" class="form-control" id="inq_habitacion" name="inq_habitacion" value="Piso <?php echo $inquilino['nro_piso'] ?>" disabled></td>
                                                <td><input type="text" class="form-control" id="inq_habitacion" name="inq_habitacion" value="S/ <?php echo $inquilino['precio'] ?>" disabled></td>
                                            </tr>                                                                                                  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 titlesearch">
                                <h6 class="m-0 font-weight-bold text-primary">Fecha y Servicios</h6>
                            </div>
                            <div class="card-body form-fec-serv">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Fecha ingreso</th>
                                                <th>Fecha fin</th>
                                                <th>Internet</th>
                                                <th>Cable</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <td><input class="form-control " type="date" id="fechaInicio" name="fechaInicio" value="<?php echo $inquilino['fecha_inicio'] ?>" id="date-input-ingreso" readonly disabled></td>
                                                <td><input class="form-control" type="date" name="fechaFin" value="<?php echo $inquilino['fecha_fin'] ?>" id="date-input-ingreso" disabled></td>
                                                <td><input type="checkbox" name="serInternet" <?php if (isset($inquilino['serv_internet']) && $inquilino['serv_internet'] == "1") echo "checked"; ?> value="<?php echo $inquilino['serv_internet'] ?>" disabled></td>
                                                <td><input type="checkbox" name="serCable" <?php if (isset($inquilino['serv_cable']) && $inquilino['serv_cable'] == "1") echo "checked"; ?> value="<?php echo $inquilino['serv_cable'] ?>"disabled></td>
                                            </tr>                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <?php 
                            }
                        ?>
                    </form>    


                    <!-- Modal eliminar inquilino -->
                    <div class="modal fade " id="modal_obs_inquilino" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                      
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Eliminar inquilino</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                                                              
                              <div class="modal-body">
                                 <form class="serviciopagado" action="delete-inquilino.php" method="POST">

                                 <input type="number" name="id_inquilino" value="<?php echo $inquilino['id_inq'] ?>" hidden> 
                                 <input type="number" name="id_habitacion" value="<?php echo $inquilino['id_hab'] ?>" hidden> 
                                    <div class="form-group row">
                                                              
                                       <div class="form-group col-md-12">
                                            <label for="obs_inq">Observacion de inquilino</label>
                                            <select id="obs_inq" name="obs_inq" class="form-control" required>
                                                <option selected>Seleccionar</option >
                                                <option value="Excelente">Excelente</option>
                                                <option value="Bueno">Bueno</option>
                                                <option value="Regular">Regular</option>
                                                <option value="Malo">Malo</option>
                                            </select>
                                        </div> 
                           
                                    </div>                                      
                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Eliminar</button>
                                        </div>
                                 </form>
                              </div>
                              
                              
                           </div>
                        </div>
                     </div>
                    
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
                        <span aria-hidden="true">??</span>
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
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <script type="text/javascript">
        
        $(document).ready(function(){
            $(".btn-editar").click(function() {
                $('form input').prop("disabled", false);
                $('form textarea').prop("disabled", false);            
                $('.form-habitacion input').prop("disabled", true);           
                $('.btn-actualizar').prop("disabled", false);
                $('.inputfoto').prop("disabled", false); 
            });

            $(".btn-actualizar").click(function() {

                if ($(".form-actualizar").validate()) {
                    $(".form-actualizar").submit();
                }

            });

        });
        $(document).ready(function(){
            $(".btn-actualizar").click(function() {
                $('form input').prop("disabled", true);
                $('form textarea').prop("disabled", true);
                $('.btn-actualizar').prop("disabled", true);
                $('.inputfoto').prop("disabled", true);
            });
        });

        function ActFoto(){
        var image=document.getElementById('foto_inq');
        image.src= URL.createObjectURL(event.target.files[0]);
    }

   

    </script>

</body>

</html>