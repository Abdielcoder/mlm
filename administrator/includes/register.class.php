<?php

require_once 'functions.php';

Class Register{


    // Función para sacar el link del referido
    public function getIDUserReferal($permalink){

        $conexion = Conexion::singleton_conexion();

        $SQL = 'SELECT * FROM usuarios WHERE referal = :referal LIMIT 1';
        $stn = $conexion -> prepare($SQL);
        $stn -> bindParam(':referal', $permalink , PDO::PARAM_STR);
        $stn -> execute();
        $rst = $stn -> fetch();

        if (empty($rst['id'])) {
        	// En caso de que no exista un ID relacionado con el link de referido
        	// Hacemos una redirección al logout y que elimine asolutamente todo.
        	header('Location: '.base_url_return().'logout');
        }else{

        	return $rst['id'].'|'.$rst['referalnum'];
        }


        $conexion = null;

    }


    public function CheckIDPosition($number){

        $conexion = Conexion::singleton_conexion();

        $SQL = 'SELECT * FROM usuarios WHERE id = :id LIMIT 1';
        $stn = $conexion -> prepare($SQL);
        $stn -> bindParam(':id', $number , PDO::PARAM_INT);
        $stn -> execute();
        $rst = $stn -> fetchAll();
        if (empty($rst))
        {
          return 1;
        }
        else
        {
          return 0;
        }


        $conexion = null;

    }

    public function initializeSessionData($number,$idreferal)
    {
        session_start();

        $_SESSION['newid'] = $number;
        $_SESSION['referaluser'] = $idreferal;
        $_SESSION['rango'] = 1;

        header('Location: '.base_url_return().'registro');

        exit();
    }



    // Funcion para saber que id debe de usar el usuario
    public function generateNumbers($id,$referalnum){


       // El ID del usaurio es su numero primario
       $primary = $id;

       // First Block Numbers
       $f1 = $primary * 2;
       $f2 = $f1 + 1;

       // Segundo Bloque
       $ff1 = $f1 * 2;
       $ff2 = $ff1 + 1;
       $ff3 = $ff2 + 1;
       $ff4 = $ff3 + 1; 

       // Tercer Bloque
       $fff1 = $ff1 * 2;
       $fff2 = $fff1 + 1;
       $fff3 = $fff2 + 1;
       $fff4 = $fff3 + 1;
       $fff5 = $fff4 + 1;
       $fff6 = $fff4 + 1;
       $fff7 = $fff6 + 1;
       $fff8 = $fff7 + 1;


       // 2 Lugares
       $FirstNumbers = array($f1,$f2); 
       // 4 Lugares
       $SecondNumbers = array($ff1,$ff2,$ff3,$ff4); 
       // 8 Lugares
       $ThirdNumbers = array($fff1,$fff2,$fff3,$fff4,$fff5,$fff6,$fff7,$fff8);

 
       // Si el usuario aun no tiene sus 4 referidos, checamos las id
       // y luego iniciamos con lo de la sesion para saber con que id se va a registrar
       // y quien es su referido.
       if ($referalnum < 2) 
       {

           if (!$this->CheckIDPosition($FirstNumbers[0]) == 0) {
             $this -> initializeSessionData($FirstNumbers[0],$id);
           }

           if (!$this->CheckIDPosition($FirstNumbers[1]) == 0) {
             $this -> initializeSessionData($FirstNumbers[1],$id);
           }

       }

       // Segundo Bloque
       if ($referalnum > 2 || $referalnum < 4) 
       {
            for ($i=0; $i < 4; $i++) { 
               if (!$this->CheckIDPosition($SecondNumbers[$i]) == 0) {
                 $this -> initializeSessionData($SecondNumbers[$i],$id);
               }
            }
       }

       // Tercer Nivel
       if ($referalnum > 4 || $referalnum < 8) 
       {
            for ($i=0; $i < 8; $i++) { 
               if (!$this->CheckIDPosition($ThirdNumbers[$i]) == 0) {
                 $this -> initializeSessionData($ThirdNumbers[$i],$id);
               }
            }
       }

    }

    



















}