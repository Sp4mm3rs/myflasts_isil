<?php
    include 'config/conection.php';

           
            
            
       $get_nombre = $_POST['inq_nombre'];
       $get_apellido = $_POST['inq_apellido'];
       $get_dni = $_POST['inq_dni'];
       $get_celular = $_POST['inq_celular'];
       $get_email = $_POST['inq_email'];
       $get_observacion = $_POST['inq_observacion'];
       $get_cantidad=$_POST['inq_cantidad'];
       
      
       $get_inicio = date('Y-m-d',strtotime($_POST['fechaInicio']));
       $get_fin = date('Y-m-d',strtotime($_POST['fechaFin']));

       $get_internet = isset($_POST['serInternet']) ? 1 : 0;
       $get_cable = isset($_POST['serCable']) ? 1 : 0;

       $get_inq = $_GET['inq'];
       $get_hab = $_GET['hab'];


       $query="SELECT foto FROM inquilinos WHERE id_inq=$get_inq";
       $result=mysqli_query($conexion,$query);
       $row = mysqli_fetch_assoc($result); 
       
       $folder="";          
       $filename=$_FILES["afoto"]["name"];
       if(!empty($filename)){
           $tempname=$_FILES["afoto"]["tmp_name"];   
           $folder="img/".$filename;
           move_uploaded_file($tempname,$folder);
       }
       else{
           $folder= $row['foto'];
       }


        $update_inq = array("UPDATE inquilinos 
                    SET nombre = '$get_nombre', apellido = '$get_apellido', dni = '$get_dni', celular = '$get_celular', 
                    correo = '$get_email', observaciones = '$get_observacion',cant_inquilino='$get_cantidad',foto='$folder' WHERE id_inq = $get_inq",
                    "UPDATE fecha_inicio = '$get_inicio', fecha_fin = '$get_fin',
                    serv_internet = '$get_internet', serv_cable = '$get_cable' WHERE id_hab = $get_hab");

            if ($conexion->multi_query(implode(';', $update_inq))) {
                    $i = 0;
                    do {
                        $i++;
                    } while ($conexion->next_result());
                }

                header("Refresh:1; url=listadeinquilino.php");
