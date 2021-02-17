<?php
    include_once 'registro_BD.php';
    
    $res = new stdClass();
    $res->inserted = true; //Formato objeto con propiedad deleted (por defecto a false)
    $res->message = ''; //Mensaje en caso de error

    try
    {
        $datoscrudos = file_get_contents("php://input"); //Leemos los datos
        $datos = json_decode($datoscrudos);
        if (isset($datos))
        {
            DB::user_exists($datos->usuario, $datos->password, $resultado);
            if ($resultado){
                $res->message = 'Usuario existe.';
            } else {
                $res->inserted = false;
                $res->message = 'Usuario no existe.';
            }
        }
    }
    catch(Exception $e)
    {
        //En caso de error se envia la información de error al navegador
        $res->inserted = false;
        $res->message = 'Se ha producido una excepción en el servidor: '.$e->getMessage(); 
    }
    header('Content-type: application/json');
    echo json_encode($res);
?>