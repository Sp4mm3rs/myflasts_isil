<?php
    include 'config/conection.php';
    
    $consulta = "SELECT * FROM inquilinos";
    $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");

?>


<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lista de inquilinos - My Flats</title>

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
                    <h1 class="h3 mb-4 text-gray-800">Inquilinos</h1>

                    
                    <div class="container-fluid">                     
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4 ">
                            <div class="card-header py-3 titlesearch ">
                                <h6 class="titlelist m-0 font-weight-bold text-primary">Lista de inquilinos</h6>

                                <form 
                                    class="buscarinput">
                                    <div class="input-group">
                                        <input type="text" id="buscari" onkeyup="myFunction()" class="searchc form-control  border-0 small" placeholder="Buscar"
                                            aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        
                            <div class="card-body maincontent">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>DNI</th>
                                                <th>Inquilino</th>
                                                <th>Habitacion</th>
                                                <th>Celular</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Fin</th>
                                                <th>Contrato</th>
                                                <th>Detalle</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>

                                            <?php 

                                            foreach ($resultado as $registro) {                                                
                                            ?>
                                            <tr class="item" id="<?php echo $registro['dni'] ?>">
                                                <td><?php echo $registro['dni'] ?></td>
                                                <td><?php echo $registro['nombre'] ?> <?php echo $registro['apellido'] ?></td>
                                                <td></td>
                                                <td><?php echo $registro['celular'] ?></td>
                                                <td></td>
                                                <td></td>
                                                <td><a href="contrato/?dni=<?php echo $registro['dni'] ?>">Ver</a></td>
                                                <td><a href="detalle-inquilino.php?dni=<?php echo $registro['dni'] ?>">Ver</a></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
    function myFunction(){
        var input, filter,table,tr,td,i,txt;
        input = document.getElementById("buscari");
        filter=input.value.toUpperCase();
        table= document.getElementById("dataTable");
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