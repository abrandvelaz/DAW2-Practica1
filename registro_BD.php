<?php
class DB{
    private static $connection=null;
    public static function get(){
        if(self::$connection === null){
            $host = 'localhost';
            $dbname = 'daw2';
            $username = 'root';
            $password = 'root';
            self::$connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            self::$connection->exec('PRAGMA foreign_keys = ON;');
            self::$connection->exec('PRAGMA encoding="UTF-8";');
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }
    
    public static function execute_sql($sql,$parms=null){
        try {
            $db = self::get();
            $ints= $db->prepare ( $sql );
            if ($ints->execute($parms)) {
                return $ints;
            }
        }
        catch (PDOException $e) {
            echo '<h3>Error en al DB: ' . $e->getMessage() . '</h3>';
        }
        return false;
    }


    //USER
    public static function user_exists($usuario,$pass, &$res){
        $db = self::get();
        $inst=$db->prepare('SELECT * FROM usuario WHERE usuarionombre=? and usuariopassword=?');
        $inst->execute(array($usuario,md5($pass)));
        $inst->setFetchMode(PDO::FETCH_NAMED);
        $res=$inst->fetchAll();
        return count($res) == 1;
    }
    
    //Función para obtener los datos de un usuario por su id
    public static function getUser($idUser, &$res){
        $db = self::get();
        $inst=$db->prepare("SELECT * FROM usuario WHERE id=".$idUser."");
        $inst->execute();
        $inst->setFetchMode(PDO::FETCH_LAZY);
        $res=$inst->fetch();
        return $res;
    }
    
    //Función para obtener los usuarios y sus correspondientes datos
    public static function getUsers(&$res){
        $db = self::get();
        $inst=$db->prepare("SELECT * FROM usuario");
        $inst->execute();
        $inst->setFetchMode(PDO::FETCH_NAMED);
        $res=$inst->fetchAll();
        return $res;
    }

    //Añadir usuario
    public static function addUser($cuenta, $clave, $nombre, $email, &$res){
        $db = self::get();
        $inst=$db->prepare("INSERT INTO usuario(usuarioid, usuariopassword, usuarionombre, usuarioemail) VALUES (?,?,?,?)");
        if($inst){
            $res=$inst->execute(array($cuenta, md5($clave), $nombre, $email));
        }
        return $res;
    }
} 
?>