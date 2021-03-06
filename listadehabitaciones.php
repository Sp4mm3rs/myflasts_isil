<?php
    include 'config/conection.php';

//     $consulta = "SELECT * FROM inquilinos inq
//                         INNER JOIN habitaciones hab ON hab.id_inquilino = inq.id_inq
// ";
  $consultahb = "SELECT * FROM habitaciones hab ORDER BY nro_piso ASC";
  $resultadohb = mysqli_query( $conexion, $consultahb ) or die ( "Algo ha ido mal en la consulta a la base de datos");
  
  $con_inquilino = "SELECT * FROM inquilinos";
  $res_inquilino = mysqli_query( $conexion, $con_inquilino ) or die ( "Algo ha ido mal en la consulta a la base de datos");

  include 'sesion.php';
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
                                <button type="button" id="adhab" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Agregar Habitaci??n</button> 
                                                                         
                            </div>
                           
                                                   
                            <div class="card-body maincontent">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tablehab" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Habitaci??n</th>
                                                <th class="text-center">Piso</th>
                                                <th class="text-center">Inquilino</th>
                                                <th class="text-center">Cable</th>
                                                <th class="text-center">Internet</th>
                                                <th class="text-center">Fecha inicio</th>
                                                <th class="text-center">Fecha termino contrato</th>
                                                <th class="text-center">Precio</th>
                                                <th class="text-center">Estado</th>
                                                <th></th>
                                                <th class="text-center">Detalle Mantenimiento</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                              foreach ($resultadohb as $habitacion) {
                                            ?>
                                            <tr class="item-habitacion">
                                                <td>Nro. <?php echo $habitacion['nro_habitacion'] ?></td>
                                                <td>Nro. <?php echo $habitacion['nro_piso'] ?></td>
                                                <td><?php
                                                        foreach ($res_inquilino as $inquilino) {
                                                          if ($inquilino['id_inq'] == $habitacion['id_inquilino']){
                                                           echo $inquilino['nombre'] . " " . $inquilino['apellido'];
                                                          }
                                                        }
                                                 ?></td>
                                                <td><?php if (isset($habitacion['serv_cable']) && $habitacion['serv_cable'] == "1") echo "S/. 30.00"; ?></td>
                                                <td><?php if (isset($habitacion['serv_internet']) && $habitacion['serv_internet'] == "1") echo "S/. 30.00"; ?></td>
                                                <td><?php echo $habitacion['fecha_inicio'] ?></td>
                                                <td><?php echo $habitacion['fecha_fin'] ?></td>
                                                <td><?php $adicional=0;
                                           
                                               if (isset($habitacion['serv_internet']) && $habitacion['serv_internet'] == "1") $adicional+=30;
                                               if (isset($habitacion['serv_cable']) && $habitacion['serv_cable'] == "1") $adicional+=30;    

                                                $precio_final = $habitacion['precio'] + $adicional; 
                                                          
                                                 echo "S/. " . number_format($precio_final, 2, '.', ' ');         
                                                          
                                                ?></td>
                                                <td >
                                                <p id="hab_estado_tabla">
                                                <?php
                                                       
                                                         if (isset($habitacion['id_inquilino'])){
                                                            echo "Ocupado";
                                                          }
                                                         
                                                        else{
                                                            if (isset($habitacion['estado']) && $habitacion['estado']=="1"){
                                                                echo "En mantenimiento";
                                                              }
                                                              else{                                                               
                                                                      echo "Disponible";                                                                 
                                                              }
                                                              
                                                        }
                                                        
                                                 ?>
                                                </p>
                                                </td>
                                                <td id="" class="text-center">
                                                    <button type="button" id="<?php echo $habitacion['id_hab'] ?>" class="btn btn-outline-info btn-edit-habitacion" data-toggle="modal" data-target="#exampleModal1">Editar</button> 
                                                </td>

                                                <td>
                                                    <?php
                                                    if(isset($habitacion['estado'])&& $habitacion['estado']=="1"){
                                                        echo "Raz??n: ".$habitacion['det_mant']. "Fecha t??rmino: " .$habitacion['fec_mant'];
                                                    }

                                                    ?>
                                                </td>
                                                
                                            </tr>
                                            <?php 
                                            } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        

                        <!-- Button trigger modal -->
                        

                        <!-- Modal -->
                        <!-- Agregar Habitaco??n Modal -->                        
                        <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nueva habitaci??n</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <form class="habitacion" action="insert_habitacion.php" method="POST">
                                       <div class="form-group row">
                                           <div class="form-group col-md-12">
                                             <label for="hab_nro">Habitaci??n</label>
                                             <select id="hab_nro" name="hab_nro" class="form-control">
                                                
                                                <option selected>Seleccionar</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>

                                             </select>
                                          </div>

                                          <div class="form-group col-md-12">
                                             <label for="hab_piso">Piso</label>
                                             <select id="hab_piso" name="hab_piso" class="form-control">
                                             
                                                <option selected>Seleccionar</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                        
                                             </select>
                                          </div>
                                          
                                          <div class="form-group col-md-12">
                                             <label for="hab_precio">Precio habitaci??n</label>
                                             <input type="number" class="form-control" id="hab_precio" name="hab_precio" placeholder="Ingresar monto" required>
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

                        <!-- Editar Habitaco??n Modal -->                       
                        <div class="modal fade " id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar habitaci??n</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                 
                                    <form class="habitacion" action="actualizar-habitacion.php" method="POST">
                                       <div class="form-group row">
                                          <div class="form-group col-md-12">                           
                                             <label for="hab_precio">Precio habitaci??n actual</label>
                                             <input type="number" class="form-control" id="precio_habitacion" name="hab_precio" value="" disabled>
                                             <input type="number" class="form-control" id="hab_id_precio" name="hab_id_precio" value="" hidden>
                                          </div>

                                          <div class="form-group col-md-12">
                                             <label for="hab_nuevo_precio">Nuevo precio</label>

                                             <input type="number" class="form-control" id="hab_nuevo_precio" name="hab_nuevo_precio" placeholder="Ingresar nuevo monto" required>
                                          </div>

                                          <div class="form-group col-md-12">
                                             <label for="hab_estado">Estado</label>
                                             <!-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hab_estado" id="hab_estado" value="1">                                             
                                                <label class="form-check-label" for="defaultCheck1">Mantenimiento</label>
                                             </div>    -->
                                             
                                             <select name="hab_estado" id="hab_estado"class="form-control">
                                                <!-- <option selected>Elegir</option> -->
                                                <option selected>Cambiar</option>   
                                                <option  >Mantenimiento</option>
                                             </select>
                                             <br>
                                             <h6 id="t_m">Raz??n del matenimiento</h6>
                                             <textarea class="form-control" name="mant_det" id="mant_det" cols="30" rows="3"></textarea>
                                             <label id="l_mant" for="fec_mant">Fecha t??rmino del mantenimiento</label>
                                             <input class="form-control" id="fec_mant" name="fec_mant"  type="date">
                                          </div>

                                       </div>


                                       <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-info">Editar</button>
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
        <?php 
            include 'logout.php';
        ?>

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

    <script type="text/javascript">
        $( document ).ready(function() {

          $('#tablehab .item-habitacion').each(function(){
          });
           $(document).on('click', '.btn-edit-habitacion', function(){  
               var id_habitacion = $(this).attr("id"); 
               $.ajax({  
                    url:"precio_hab.php",  
                    method:"POST",  
                    data:{id_habitacion:id_habitacion},  
                    dataType:"json",  
                    success:function(data){  
                        $('#precio_habitacion').val(data.precio);  
                        $('#hab_id_precio').val(data.id_hab);  
                        $('#hab_nuevo_precio').val(data.precio);  
                    }  
               });  
             });

        });

    </script>

    <script type="text/javascript">
    $("#t_m").hide();
    $("#l_mant").hide();
    $("#fec_mant").hide();
    $("#mant_det").hide();
    $("#hab_estado").change(function(){
        var value=$("#hab_estado").val();
        if(value=="Mantenimiento"){
            $("#l_mant").show();
            $("#fec_mant").prop('required', true);
            $("#fec_mant").show();
            $("#t_m").show();
            $("#mant_det").prop('required', true);
            $("#mant_det").show();
           
        }else{
            $("#l_mant").hide();
            $("#fec_mant").hide();
            $("#t_m").hide();
            $("#mant_det").hide();
        }
    });
    </script>
    
    
    <script type="text/javascript">
  
        // let p = document.querySelector("#hab_estado_tabla");
        // let button = document.querySelector(".btn-edit-habitacion");
        // button.disabled = true;
        // p.addEventListener("change", stateHandle);
        // function stateHandle() {
        // if (document.querySelector("#hab_estado_tabla").value !== "Ocupado") {
        //     button.disabled = false; 
        // } else {
        //     button.disabled = true;
        // }
        // }
        

    </script>


</body>

</html>