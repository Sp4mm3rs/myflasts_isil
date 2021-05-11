<?php
    include 'config/conection.php';

    $consulta = "SELECT * FROM inquilinos inq
                        INNER JOIN habitaciones hab ON hab.id_inquilino = inq.id_inq
";
    $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lista de habitaciones - My Flats</title>

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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Habitaciones</h1>

                    
                    <div class="container-fluid">                     
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 titlesearch" >
                                <h6 class="titlelist m-0 font-weight-bold text-primary">Lista de habitaciones</h6>

                                <form 
                                    class="buscarinputh">
                                    <div class="input-group">
                                        <input type="text" id="buscarh" onkeyup="buscarHab()" class="form-control  border-0 small" placeholder="Buscar"
                                            aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                                                    
                                </form>
                                <button type="button" id="adhab" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Agregar Habitación
                                </button>   
                            </div>
                           
                                                   
                            <div class="card-body maincontent">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tablehab" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Habitación</th>
                                                <th>Piso</th>
                                                <th>Inquilino</th>
                                                <th>Cable</th>
                                                <th>Internet</th>
                                                <th>Fecha termino contrato</th>
                                                <th>Precio</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            <?php 

                                            foreach ($resultado as $registro) {

                                                // echo "<pre>";
                                                // echo print_r($registro);
                                                // echo "</pre>";

                                            ?>
                                            <tr>
                                                <td><?php echo $registro['nro_habitacion'] ?></td>
                                                <td><?php echo $registro['nro_piso'] ?></td>
                                                <td><?php echo $registro['nombre'] ?> <?php echo $registro['apellido'] ?></td>
                                                <td><?php if (isset($registro['serv_cable']) && $registro['serv_cable'] == "1") echo "Tiene"; ?></td>
                                                <td><?php if (isset($registro['serv_internet']) && $registro['serv_internet'] == "1") echo "Tiene"; ?></td>
                                                <td><?php echo $registro['fecha_fin'] ?></td>
                                                <td><?php echo $registro['precio'] ?></td>
                                                <td><?php if (isset($registro['id_inquilino']) && $registro['id_inquilino'] == NULL) echo "Disponible"; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        

                        <!-- Button trigger modal -->
                        

                        <!-- Modal -->
                        <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nueva habitación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <form class="habitacion" action="insert_habitacion.php" method="POST">
                                       <div class="form-group row">
                                          <div class="form-group col-md-12">
                                             <label for="hab_piso">Nro. Piso</label>
                                             <select id="hab_piso" name="hab_piso" class="form-control">
                                                <option selected>Seleccionar</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                             </select>
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="hab_nro">Nro. Habitación</label>
                                             <select id="hab_nro" name="hab_nro" class="form-control">
                                                <option selected>Seleccionar</option>
                                                <option>101</option>
                                                <option>102</option>
                                                <option>103</option>
                                                <option>201</option>
                                                <option>202</option>
                                                <option>203</option>
                                                <option>301</option>
                                                <option>302</option>
                                                <option>303</option>
                                             </select>
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="hab_precio">Precio habitación</label>
                                             <input type="number" class="form-control" id="hab_precio" name="hab_precio" placeholder="Ingresar monto">
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                 </div>
                                    </form>
                                 </div>
                                 
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
        function buscarHab(){
        var input, filter,table,tr,td,i,txt;
        input = document.getElementById("buscarh");
        filter=input.value.toUpperCase();
        table= document.getElementById("tablehab");
        tr=table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if(td){
            txt = td.textContent || td.innerText;
            if (txt.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
            }
    }   }

    </script>

</body>

</html>