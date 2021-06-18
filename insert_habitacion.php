<?php
    include 'config/conection.php';

    $get_piso = $_POST['hab_piso'];
    $get_nro = $_POST['hab_nro'];
    $get_precio = $_POST['hab_precio'];

    $cant_enter=false;

      $duplicado_1 = mysqli_query($conexion,"SELECT nro_habitacion FROM habitaciones WHERE nro_piso =1");
      $array_1=[];
      while($result=$duplicado_1->fetch_assoc()){
         $array_1[]=$result['nro_habitacion'];
      }
      foreach($array_1 as $ar){
         if($get_piso==1 AND $ar==$get_nro){
            $cant_enter=true;
         }   
      }

      $duplicado_2 = mysqli_query($conexion,"SELECT nro_habitacion FROM habitaciones WHERE nro_piso =2");
      $array_2=[];
      while($result=$duplicado_2->fetch_assoc()){
         $array_2[]=$result['nro_habitacion'];
      }
      foreach($array_2 as $ar2){
         if($get_piso==2 AND $ar2==$get_nro){
            $cant_enter=true;
         }   
      }

      $duplicado_3 = mysqli_query($conexion,"SELECT nro_habitacion FROM habitaciones WHERE nro_piso =3");
      $array_3=[];
      while($result=$duplicado_3->fetch_assoc()){
         $array_3[]=$result['nro_habitacion'];
      }
      foreach($array_3 as $ar3){
         if($get_piso==3 AND $ar3==$get_nro){
            $cant_enter=true;
         }   
      }




     


      if($cant_enter){
         echo '<script>alert("La habitacion ya existe");
         window.location.href="listadehabitaciones.php"
         </script>';
         
      }
      else{
         $sql = "INSERT INTO habitaciones (nro_habitacion, precio, nro_piso) VALUES ($get_nro, $get_precio, $get_piso)";

         $resultado = mysqli_query($conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");

            if ($resultado) {
                  header( 'Location: http://localhost/myflasts_isil/listadehabitaciones.php' ) ;
            }
         mysql_close($conexion);


      }

    
