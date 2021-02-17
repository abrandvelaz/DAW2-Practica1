<?php
include_once 'registro_BD,php';
class User{
    public static function session_start(){
        if(session_status () === PHP_SESSION_NONE){
            session_start();
        }
    }
    public static function getLoggedUser(){ //Devuelve un array con los datos del cuenta o false
        self::session_start();
        if(!isset($_SESSION['user'])) return false;
        return $_SESSION['user'];
    }
    
    public static function login($usuario,$pass){ //Devuelve verdadero o falso según
        self::session_start();
        if(DB::user_exists($usuario, $pass, $res)){
            $_SESSION['user']=$res[0]; //Almacena datos del usuario en la sesión
            return true;
        }
        return false;
    }
    public static function logout(){
        self::session_start();
        unset($_SESSION['user']);
    }
    
    public function getUser($idUsuario){
        if(DB::getUser($idUsuario,$res)){
            return $res;
        } else {
            return null;
        }
    }
    
    public static function addUser($dni,$cuenta,$clave,$nombre,$email){
        if(DB::addUser($dni,$nombre,$clave,$email,$res)){
            return $res;
        } else {
            return null;
        }
    }
}
?>