<?php

Class Arbol
{

    /*#######################################################################################################################

       Con esta función creo la estructura que necesito con todo y sus posiciones, la estrctura que manejo es una piramide
       simple, de 3 niveles, con sus derechos e izquierdos, entonces lo que necesito son 15 bloques, uso un FOR para crearlos
       solamente por medio de IF's especifico en que lugar van y el resultado final seria asi.

                                        /                1             \
                                     --------------------------------------
                                    /      2             |           3     \
                                 ----------------------------------------------
                                /   4      |      5      |     6     |     7   \
                              ----------------------------------------------------
                             /  8     9   |   10    11   |  12    13  |  14    15 \
                            ---------------------------------------------------------

        No es un arbol binario pero maneja el orden piramidal que necesito y lo hace matematicamente correcto y es muy simple
        3 niveles con sus respectivos numeros, esta función solo puede hacer la estructura de un numero de 14 digitos maximo
        estamos hablando de 99,999,999,999,999 por que el siguiente dato de este numero seria 1.0E+14, asi que en teoria podre 
        meter a mi base de datos Noventa y nueve billones, novecientos noventa y nueve mil novecientos noventa y nueve millones,
        novecientos noventa y nueve mil novecientos noventa y nueve registros, estamos hablando de 13,437,248,051.5989 veces las
        personas que viven en el planeta (segun el registro del 2016) y digo que es posible por que el valor maximo de BIGINT
        en la base de datos mysql es: 9,223,372,036,854,775,807 ( ͡° ͜ʖ ͡°).

    #######################################################################################################################*/

    public function createDesktop($number){

         $izquierdo = 1;
         $derecho = 2;

          
         // Primer bloque
         echo '
         <div id="firstblock" class="col-md-12 text-center">
               '.$this->checkPosition($number).'
         </div>
         ';

         // Segundo Bloque

          /* Lugares */
          $first = $number * 2;
          $second = $first + 1;

          echo '
            <div id="secondblock" class="col-md-12">
              <table class="table text-center">
                 <tr>
                   <td data-side="12">'.$this->checkPosition($first).'</td>
                   <td data-side="13">'.$this->checkPosition($second).'</td>
                 </tr>
              </table>
            </div>
          ';

         // Tercer Bloque
         $ffirst = $first * 2;
         $ssecond = $ffirst + 1;
         $tthird = $ssecond + 1;
         $ffourth = $tthird + 1;


         echo'
            <div id="thirdblock" class="col-md-12">
              <table class="table text-center">
                 <tr>
                   <td data-side="21">'.$this->checkPosition($ffirst).'</td>
                   <td data-side="22">'.$this->checkPosition($ssecond).'</td>
                   <td data-side="23">'.$this->checkPosition($tthird).'</td>
                   <td data-side="24">'.$this->checkPosition($ffourth).'</td>
                 </tr>
              </table>
            </div>
         ';

         // Cuarto Bloque
         $fffirst = $ffirst * 2;
         $sssecond = $fffirst + 1;
         $ttthird = $sssecond + 1;
         $fffourth = $ttthird + 1;
         $fifth = $fffourth + 1;
         $sixth = $fifth + 1;
         $seventh = $sixth + 1;
         $eighth = $seventh + 1;


         echo'
            <div id="fourthblock" class="col-md-12">

              <table class="table text-center">
                 <tr>
                   <td data-side="31">'.$this->checkPosition($fffirst).'</td>
                   <td data-side="32">'.$this->checkPosition($sssecond).'</td>
                   <td data-side="33">'.$this->checkPosition($ttthird).'</td>
                   <td data-side="34">'.$this->checkPosition($fffourth).'</td>
                   <td data-side="35">'.$this->checkPosition($fifth).'</td>
                   <td data-side="36">'.$this->checkPosition($sixth).'</td>
                   <td data-side="37">'.$this->checkPosition($seventh).'</td>
                   <td data-side="38">'.$this->checkPosition($eighth).'</td>
                 </tr>
              </table>

            </div>
         ';

    }

    public function checkImage($id){

    	// conexion de base de datos
    	$conexion = Conexion::singleton_conexion();

        $SQL = 'SELECT * FROM images WHERE user = :user';
        $sentence = $conexion -> prepare($SQL);
        $sentence -> bindParam(':user', $id, PDO::PARAM_INT);
        $sentence -> execute();
        $results = $sentence -> fetchAll();
        if (empty($results)){
        	     return '<img src="images/user-icon.png" >';
        }else{
        	foreach ($results as $key){
        		 return '<img src="'.$key['location'].'" width="70" >';
        	}
        }

    }

    public function checkPosition($position){

    	// conexion de base de datos
    	$conexion = Conexion::singleton_conexion();

        $SQL = 'SELECT * FROM usuarios WHERE id = :id';
        $sentence = $conexion -> prepare($SQL);
        $sentence -> bindParam(':id', $position, PDO::PARAM_INT);
        $sentence -> execute();
        $results = $sentence -> fetchAll();
        if (empty($results)){
        	     return '<a class="tree-user-active"><img src="images/user-icon.png" ><p>Vacio</p></a>';
        }else{
        	foreach ($results as $key){
        		 if ($position == $_SESSION['usuario']) {
        		 	return '<a class="tree-user-active">'.$this->checkImage($position).'<p>'.$key['nombre'].' '.$key['apellido'].'<p></a>';
        		 }else if ($key['activo'] == 1){
               return '<a class="tree-user-active">'.$this->checkImage($position).'<p>'.$key['nombre'].' '.$key['apellido'].' <i class="fa fa-circle noactiveuser" aria-hidden="true"></i></p></a>';
             }else{
        		 	return '<a class="tree-user-active">'.$this->checkImage($position).'<p>'.$key['nombre'].' '.$key['apellido'].'</p></a>';
        		 }
        	}
        }

    }


}
