<?php
include 'config/conection.php';



if (isset($_POST['btnmsg'])) {  

$nombre = $_POST['msg_name'];
$mensaje = $_POST['txa_msg'];
$id= $_POST['id_p'];

$correo="";

$headers = "From: myflats@example.com";
$query = mysqli_query($conexion,"SELECT correo FROM inquilinos WHERE id_inq = '$id'");
      
      while($result=$query->fetch_assoc()){
         $correo=$result['correo'];
      }
      


 /*if(mail($correo,'Alquiler vencido',$mensaje,$headers)){
       echo "Test Succes";
 }else{
       echo "Test fail";
 }*/
 echo $nombre;
 echo $correo;
 echo $mensaje;
}