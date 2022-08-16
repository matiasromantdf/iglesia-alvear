<?php

//definir variable de conexion PDO
$dsn = 'mysql:host=localhost;dbname=iglesia-alvear';
$usuario = 'root';
$contraseña = '';

//conexion PDO
$conexion = new PDO($dsn, $usuario, $contraseña);


//pequeña apirest para el frontend

if(isset($_GET['accion'])){
    

    $accion = $_GET['accion'];

    switch($accion){
        case 'listar-personas':
            $sql = "SELECT
            personas.fecha_visita,
            personas.ocupacion,
            personas.telefono,
            personas.estado_civil,
            personas.direccion,
            personas.edad,
            personas.apellido,
            personas.nombre,
            personas.motivo_visita,
            personas.observaciones,
            personas.id,
            usuarios.nombre AS lider
            FROM
            personas
            LEFT JOIN usuarios ON personas.lider = usuarios.id
            ";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute();
            $personas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($personas);
            break;
        case 'listar-lideres':
            $sql = "SELECT * FROM usuarios";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute();
            $lideres = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($lideres);
            break;

        
       
    
    }
}
if(isset($_POST['accion'])){
    

    $accion = $_POST['accion'];
    

    switch($accion){
       

        case 'login':
            
            $usuario = $_POST['user'];
            $clave = $_POST['password'];
            $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
            $resultado = $conexion->query($sql);
            $usuario = $resultado->fetchAll(PDO::FETCH_ASSOC);
            if($usuario){

                $dato= ($usuario);
                echo json_encode(array('estado' => 'ok', 'datos' => $dato));
            }else{

                echo json_encode(['estado' => 'error']);
            }
        
        
            break;

        case 'asignar-lider':

        
            $id = $_POST['id'];
            $lider = $_POST['lider'];
            $sql = "UPDATE personas SET lider = '$lider' WHERE id = '$id'";
            $resultado = $conexion->query($sql);
            if($resultado){
                echo json_encode(['estado' => 'ok']);
            }else{
                echo json_encode(['estado' => 'error']);
            }
            break;
        case 'agregar-persona':
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $edad = $_POST['edad'];
            $direccion = $_POST['direccion'];
            $estado_civil = $_POST['estado_civil'];
            $telefono = $_POST['telefono'];
            $ocupacion = $_POST['ocupacion'];
            $motivo_visita = $_POST['motivo_visita'];
            $observaciones = $_POST['observaciones'];
            $fecha_visita = $_POST['fecha_visita'];
            if($_POST['lider'] == 'Sin Asignar' || $_POST['lider'] == ''){
                $lider = null;
            }else{
                $lider = $_POST['lider'];
            }
            $sql = "INSERT INTO personas
            (nombre, apellido, edad, direccion, estado_civil, telefono, ocupacion, motivo_visita, observaciones, fecha_visita, lider)
             VALUES('$nombre', '$apellido', '$edad', '$direccion', '$estado_civil', '$telefono', '$ocupacion', '$motivo_visita', '$observaciones', '$fecha_visita', '$lider')";
            $resultado = $conexion->query($sql);
            if($resultado){
                echo json_encode(['estado' => 'ok']);
            }else{
                echo json_encode(['estado' => 'error']);
            }
            break;    
    
        }
}


?>