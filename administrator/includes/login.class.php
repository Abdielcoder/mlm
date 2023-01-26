<?php

require_once 'conexion.class.php';

session_start();


/* Establecemos que las paginas no pueden ser cacheadas */
header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


class Login
{

    private static $instancia;
    private $dbh;
 
    private function __construct()
    {

        $this->dbh = Conexion::singleton_conexion();

    }
 
    public static function singleton_login()
    {

        if (!isset(self::$instancia)) {

            $miclase = __CLASS__;
            self::$instancia = new $miclase;

        }

        return self::$instancia;

    }

    public function AccessPut($ipadress,$userid){
	        $dateaccessip = date('Y-m-d H:i:s');
	        $ipaccess = 'INSERT INTO access (usuario,ipadress,dateaccess) VALUES ( :usuario, :ipadress, :dateaccess)';
	        $ipquery = $this->dbh->prepare($ipaccess);
			$ipquery->bindParam(':usuario', $userid, PDO::PARAM_INT);
			$ipquery->bindParam(':ipadress', $ipadress, PDO::PARAM_STR);
			$ipquery->bindParam(':dateaccess', $dateaccessip, PDO::PARAM_STR);
			$ipquery->execute();
			return TRUE;
    }
	
	public function login_users($email,$password)
	{
		
		try {

			$crypt = sha1(PASSTK.$password);
			
			$sql = "SELECT * FROM usuarios WHERE email = ? AND password = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindParam(1, $email, PDO::PARAM_STR);
			$query->bindParam(2, $crypt, PDO::PARAM_STR);
			$query->execute();

			//si existe el usuario
			if($query->rowCount() == 1)
			{

				 $fila  = $query->fetch();


				 if ($fila['online'] == 1) 
				 {
				 	$this->noAccess();
				 }

				 $this->AccessPut($_SESSION['ipaccess'],$fila['id']);
				 $_SESSION['ipaccess'] = null;


                 $_SESSION['UserKey'] =  sha1($email.time()); 
                 $_SESSION['activess'] = SESSTK;
				 $_SESSION['usuario'] = $fila['id'];
				 $_SESSION['rango'] = $fila['rank'];
				 $_SESSION['myparent'] = $fila['padre'];

				 $secure = 'UPDATE usuarios SET online = 1, skey = ? WHERE id = ?';
				 $squery = $this->dbh->prepare($secure);
			     $squery->bindParam(1, $_SESSION['UserKey'], PDO::PARAM_STR);
			     $squery->bindParam(2, $_SESSION['usuario'], PDO::PARAM_INT);
			     $squery->execute();
			     $this->dbh = null;
				 
				 return TRUE;
	
			}else
			return FALSE;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}		
		
	}

	// Funcion para evitar que alguien entre desde otro sitio con la misma cuenta.
	public function noAccess(){
		header('Location: logout');
	} 

    // Evita que el objeto se pueda clonar
    public function __clone()
    {

        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);

    }

}