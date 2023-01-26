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
       $f3 = $f2 + 1;
       $f4 = $f3 + 1;

       // Second Block Numbers
       $ff1 = $f1 * 2;
       $ff2 = $ff1 + 1;
       $ff3 = $ff2 + 1;
       $ff4 = $ff3 + 1;

       $ff5 = $f2 * 2;
       $ff6 = $ff5 + 1;
       $ff7 = $ff6 + 1;
       $ff8 = $ff7 + 1;

       $ff9 = $f3 * 2;
       $ff10 = $ff9 + 1;
       $ff11 = $ff10 + 1;
       $ff12 = $ff11 + 1;

       $ff13 = $f4 * 2;
       $ff14 = $ff13 + 1;
       $ff15 = $ff14 + 1;
       $ff16 = $ff15 + 1;


       // Third Block Numbers
       $fff1 = $ff1 * 2;
       $fff2 = $fff1 + 1;
       $fff3 = $fff2 + 1;
       $fff4 = $fff3 + 1;

       $fff5 = $ff2 * 2;
       $fff6 = $fff5 + 1;
       $fff7 = $fff6 + 1;
       $fff8 = $fff7 + 1;

       $fff9 = $ff3 * 2;
       $fff10 = $fff9 + 1;
       $fff11 = $fff10 + 1;
       $fff12 = $fff11 + 1;

       $fff13 = $ff4 * 2;
       $fff14 = $fff13 + 1;
       $fff15 = $fff14 + 1;
       $fff16 = $fff15 + 1;

       $fff17 = $ff5 * 2;
       $fff18 = $fff17 + 1;
       $fff19 = $fff18 + 1;
       $fff20 = $fff19 + 1;

       $fff21 = $ff6 * 2;
       $fff22 = $fff21 + 1;
       $fff23 = $fff22 + 1;
       $fff24 = $fff23 + 1;

       $fff25 = $ff7 * 2;
       $fff26 = $fff25 + 1;
       $fff27 = $fff26 + 1;
       $fff28 = $fff27 + 1;

       $fff29 = $ff8 * 2;
       $fff30 = $fff29 + 1;
       $fff31 = $fff30 + 1;
       $fff32 = $fff31 + 1;

       $fff33 = $ff9 * 2;
       $fff34 = $fff33 + 1;
       $fff35 = $fff34 + 1;
       $fff36 = $fff35 + 1;

       $fff37 = $ff10 * 2;
       $fff38 = $fff37 + 1;
       $fff39 = $fff38 + 1;
       $fff40 = $fff39 + 1;

       $fff41 = $ff11 * 2;
       $fff42 = $fff41 + 1;
       $fff43 = $fff42 + 1;
       $fff44 = $fff43 + 1;

       $fff45 = $ff12 * 2;
       $fff46 = $fff45 + 1;
       $fff47 = $fff46 + 1;
       $fff48 = $fff47 + 1;

       $fff49 = $ff13 * 2;
       $fff50 = $fff49 + 1;
       $fff51 = $fff50 + 1;
       $fff52 = $fff51 + 1;

       $fff53 = $ff14 * 2;
       $fff54 = $fff53 + 1;
       $fff55 = $fff54 + 1;
       $fff56 = $fff55 + 1;

       $fff57 = $ff15 * 2;
       $fff58 = $fff57 + 1;
       $fff59 = $fff58 + 1;
       $fff60 = $fff59 + 1;

       $fff61 = $ff16 * 2;
       $fff62 = $fff61 + 1;
       $fff63 = $fff62 + 1;
       $fff64 = $fff63 + 1;

       // Fourth Block
       $ffff1 = $fff1 * 2;
       $ffff2 = $ffff1 + 1;
       $ffff3 = $ffff2 + 1;
       $ffff4 = $ffff3 + 1;

       $ffff5 = $fff2 * 2;
       $ffff6 = $ffff5 + 1;
       $ffff7 = $ffff6 + 1;
       $ffff8 = $ffff7 + 1;

       $ffff9 = $fff3 * 2;
       $ffff10 = $ffff9 + 1;
       $ffff11 = $ffff10 + 1;
       $ffff12 = $ffff11 + 1;

       $ffff13 = $fff4 * 2;
       $ffff14 = $ffff13 + 1;
       $ffff15 = $ffff14 + 1;
       $ffff16 = $ffff15 + 1;

       $ffff17 = $fff5 * 2;
       $ffff18 = $ffff17 + 1;
       $ffff19 = $ffff18 + 1;
       $ffff20 = $ffff19 + 1;

       $ffff21 = $fff6 * 2;
       $ffff22 = $ffff21 + 1;
       $ffff23 = $ffff22 + 1;
       $ffff24 = $ffff23 + 1;

       $ffff25 = $fff7 * 2;
       $ffff26 = $ffff25 + 1;
       $ffff27 = $ffff26 + 1;
       $ffff28 = $ffff27 + 1;

       $ffff29 = $fff8 * 2;
       $ffff30 = $ffff29 + 1;
       $ffff31 = $ffff30 + 1;
       $ffff32 = $ffff31 + 1;

       $ffff33 = $fff9 * 2;
       $ffff34 = $ffff33 + 1;
       $ffff35 = $ffff34 + 1;
       $ffff36 = $ffff35 + 1;

       $ffff37 = $fff10 * 2;
       $ffff38 = $ffff37 + 1;
       $ffff39 = $ffff38 + 1;
       $ffff40 = $ffff39 + 1;

       $ffff41 = $fff11 * 2;
       $ffff42 = $ffff41 + 1;
       $ffff43 = $ffff42 + 1;
       $ffff44 = $ffff43 + 1;

       $ffff45 = $fff12 * 2;
       $ffff46 = $ffff45 + 1;
       $ffff47 = $ffff46 + 1;
       $ffff48 = $ffff47 + 1;

       $ffff49 = $fff13 * 2;
       $ffff50 = $ffff49 + 1;
       $ffff51 = $ffff50 + 1;
       $ffff52 = $ffff51 + 1;

       $ffff53 = $fff14 * 2;
       $ffff54 = $ffff53 + 1;
       $ffff55 = $ffff54 + 1;
       $ffff56 = $ffff55 + 1;

       $ffff57 = $fff15 * 2;
       $ffff58 = $ffff57 + 1;
       $ffff59 = $ffff58 + 1;
       $ffff60 = $ffff59 + 1;

       $ffff61 = $fff16 * 2;
       $ffff62 = $ffff61 + 1;
       $ffff63 = $ffff62 + 1;
       $ffff64 = $ffff63 + 1;

       $ffff65 = $fff17 * 2;
       $ffff66 = $ffff65 + 1;
       $ffff67 = $ffff66 + 1;
       $ffff68 = $ffff67 + 1;

       $ffff69 = $fff18 * 2;
       $ffff70 = $ffff69 + 1;
       $ffff71 = $ffff70 + 1;
       $ffff72 = $ffff71 + 1;

       $ffff73 = $fff19 * 2;
       $ffff74 = $ffff73 + 1;
       $ffff75 = $ffff74 + 1;
       $ffff76 = $ffff75 + 1;

       $ffff77 = $fff20 * 2;
       $ffff78 = $ffff77 + 1;
       $ffff79 = $ffff78 + 1;
       $ffff80 = $ffff79 + 1;

       $ffff81 = $fff21 * 2;
       $ffff82 = $ffff81 + 1;
       $ffff83 = $ffff82 + 1;
       $ffff84 = $ffff83 + 1;

       $ffff85 = $fff22 * 2;
       $ffff86 = $ffff85 + 1;
       $ffff87 = $ffff86 + 1;
       $ffff88 = $ffff87 + 1;

       $ffff89 = $fff23 * 2;
       $ffff90 = $ffff89 + 1;
       $ffff91 = $ffff90 + 1;
       $ffff92 = $ffff91 + 1;

       $ffff93 = $fff24 * 2;
       $ffff94 = $ffff93 + 1;
       $ffff95 = $ffff94 + 1;
       $ffff96 = $ffff95 + 1;

       $ffff97 = $fff25 * 2;
       $ffff98 = $ffff97 + 1;
       $ffff99 = $ffff98 + 1;
       $ffff100 = $ffff99 + 1;

       $ffff101 = $fff26 * 2;
       $ffff102 = $ffff101 + 1;
       $ffff103 = $ffff102 + 1;
       $ffff104 = $ffff103 + 1;

       $ffff105 = $fff27 * 2;
       $ffff106 = $ffff105 + 1;
       $ffff107 = $ffff106 + 1;
       $ffff108 = $ffff107 + 1;

       $ffff109 = $fff28 * 2;
       $ffff110 = $ffff109 + 1;
       $ffff111 = $ffff110 + 1;
       $ffff112 = $ffff111 + 1;

       $ffff113 = $fff29 * 2;
       $ffff114 = $ffff113 + 1;
       $ffff115 = $ffff114 + 1;
       $ffff116 = $ffff115 + 1;

       $ffff117 = $fff30 * 2;
       $ffff118 = $ffff117 + 1;
       $ffff119 = $ffff118 + 1;
       $ffff120 = $ffff119 + 1;

       $ffff121 = $fff31 * 2;
       $ffff122 = $ffff121 + 1;
       $ffff123 = $ffff122 + 1;
       $ffff124 = $ffff123 + 1;

       $ffff125 = $fff32 * 2;
       $ffff126 = $ffff125 + 1;
       $ffff127 = $ffff126 + 1;
       $ffff128 = $ffff127 + 1;

       $ffff129 = $fff33 * 2;
       $ffff130 = $ffff129 + 1;
       $ffff131 = $ffff130 + 1;
       $ffff132 = $ffff131 + 1;

       $ffff133 = $fff34 * 2;
       $ffff134 = $ffff133 + 1;
       $ffff135 = $ffff134 + 1;
       $ffff136 = $ffff135 + 1;

       $ffff137 = $fff35 * 2;
       $ffff138 = $ffff137 + 1;
       $ffff139 = $ffff138 + 1;
       $ffff140 = $ffff139 + 1;

       $ffff141 = $fff36 * 2;
       $ffff142 = $ffff141 + 1;
       $ffff143 = $ffff142 + 1;
       $ffff144 = $ffff143 + 1;

       $ffff145 = $fff37 * 2;
       $ffff146 = $ffff145 + 1;
       $ffff147 = $ffff146 + 1;
       $ffff148 = $ffff147 + 1;

       $ffff149 = $fff38 * 2;
       $ffff150 = $ffff149 + 1;
       $ffff151 = $ffff150 + 1;
       $ffff152 = $ffff151 + 1;

       $ffff153 = $fff39 * 2;
       $ffff154 = $ffff153 + 1;
       $ffff155 = $ffff154 + 1;
       $ffff156 = $ffff155 + 1;

       $ffff157 = $fff40 * 2;
       $ffff158 = $ffff157 + 1;
       $ffff159 = $ffff158 + 1;
       $ffff160 = $ffff159 + 1;

       $ffff161 = $fff41 * 2;
       $ffff162 = $ffff161 + 1;
       $ffff163 = $ffff162 + 1;
       $ffff164 = $ffff163 + 1;

       $ffff165 = $fff42 * 2;
       $ffff166 = $ffff165 + 1;
       $ffff167 = $ffff166 + 1;
       $ffff168 = $ffff167 + 1;

       $ffff169 = $fff43 * 2;
       $ffff170 = $ffff169 + 1;
       $ffff171 = $ffff170 + 1;
       $ffff172 = $ffff171 + 1;

       $ffff173 = $fff44 * 2;
       $ffff174 = $ffff173 + 1;
       $ffff175 = $ffff174 + 1;
       $ffff176 = $ffff175 + 1;

       $ffff177 = $fff45 * 2;
       $ffff178 = $ffff177 + 1;
       $ffff179 = $ffff178 + 1;
       $ffff180 = $ffff179 + 1;

       $ffff181 = $fff46 * 2;
       $ffff182 = $ffff181 + 1;
       $ffff183 = $ffff182 + 1;
       $ffff184 = $ffff183 + 1;

       $ffff185 = $fff47 * 2;
       $ffff186 = $ffff185 + 1;
       $ffff187 = $ffff186 + 1;
       $ffff188 = $ffff187 + 1;

       $ffff189 = $fff48 * 2;
       $ffff190 = $ffff189 + 1;
       $ffff191 = $ffff190 + 1;
       $ffff192 = $ffff191 + 1;

       $ffff193 = $fff49 * 2;
       $ffff194 = $ffff193 + 1;
       $ffff195 = $ffff194 + 1;
       $ffff196 = $ffff195 + 1;

       $ffff197 = $fff50 * 2;
       $ffff198 = $ffff197 + 1;
       $ffff199 = $ffff198 + 1;
       $ffff200 = $ffff199 + 1;

       $ffff201 = $fff51 * 2;
       $ffff202 = $ffff201 + 1;
       $ffff203 = $ffff202 + 1;
       $ffff204 = $ffff203 + 1;

       $ffff205 = $fff52 * 2;
       $ffff206 = $ffff205 + 1;
       $ffff207 = $ffff206 + 1;
       $ffff208 = $ffff207 + 1;

       $ffff209 = $fff53 * 2;
       $ffff210 = $ffff209 + 1;
       $ffff211 = $ffff210 + 1;
       $ffff212 = $ffff211 + 1;

       $ffff213 = $fff54 * 2;
       $ffff214 = $ffff213 + 1;
       $ffff215 = $ffff214 + 1;
       $ffff216 = $ffff215 + 1;

       $ffff217 = $fff55 * 2;
       $ffff218 = $ffff217 + 1;
       $ffff219 = $ffff218 + 1;
       $ffff220 = $ffff219 + 1;

       $ffff221 = $fff56 * 2;
       $ffff222 = $ffff221 + 1;
       $ffff223 = $ffff222 + 1;
       $ffff224 = $ffff223 + 1;

       $ffff225 = $fff57 * 2;
       $ffff226 = $ffff225 + 1;
       $ffff227 = $ffff226 + 1;
       $ffff228 = $ffff227 + 1;

       $ffff229 = $fff58 * 2;
       $ffff230 = $ffff229 + 1;
       $ffff231 = $ffff230 + 1;
       $ffff232 = $ffff231 + 1;

       $ffff233 = $fff59 * 2;
       $ffff234 = $ffff233 + 1;
       $ffff235 = $ffff234 + 1;
       $ffff236 = $ffff235 + 1;

       $ffff237 = $fff60 * 2;
       $ffff238 = $ffff237 + 1;
       $ffff239 = $ffff238 + 1;
       $ffff240 = $ffff239 + 1;

       $ffff241 = $fff61 * 2;
       $ffff242 = $ffff241 + 1;
       $ffff243 = $ffff242 + 1;
       $ffff244 = $ffff243 + 1;

       $ffff245 = $fff62 * 2;
       $ffff246 = $ffff245 + 1;
       $ffff247 = $ffff246 + 1;
       $ffff248 = $ffff247 + 1;

       $ffff249 = $fff63 * 2;
       $ffff250 = $ffff249 + 1;
       $ffff251 = $ffff250 + 1;
       $ffff252 = $ffff251 + 1;

       $ffff253 = $fff64 * 2;
       $ffff254 = $ffff253 + 1;
       $ffff255 = $ffff254 + 1;
       $ffff256 = $ffff255 + 1;


       // 4 Lugares
       $FirstNumbers = array($f1,$f2,$f3,$f4); 
       // 16 Lugares
       $SecondNumbers = array($ff1,$ff2,$ff3,$ff4,$ff5,$ff6,$ff7,$ff8,$ff9,$ff10,$ff11,$ff12,$ff13,$ff14,$ff15,$ff16); 
       // 64 Lugares
       $ThirdNumbers = array($fff1,$fff2,$fff3,$fff4,$fff5,$fff6,$fff7,$fff8,$fff9,$fff10,$fff11,$fff12,$fff13,$fff14,$fff15,$fff16,$fff17,$fff18,$fff19,$fff20,$fff21,$fff22,$fff23,$fff24,$fff25,$fff26,$fff27,$fff28,$fff29,$fff30,$fff31,$fff32,$fff33,$fff34,$fff35,$fff36,$fff37,$fff38,$fff39,$fff40,$fff41,$fff42,$fff43,$fff44,$fff45,$fff46,$fff47,$fff48,$fff49,$fff50,$fff51,$fff52,$fff53,$fff54,$fff55,$fff56,$fff57,$fff58,$fff59,$fff60,$fff61,$fff62,$fff63,$fff64);
       // 256 Lugares
       $FourthFinalNumbers = array($ffff1,$ffff2,$ffff3,$ffff4,$ffff5,$ffff6,$ffff7,$ffff8,$ffff9,$ffff10,$ffff11,$ffff12,$ffff13,$ffff14,$ffff15,$ffff16,$ffff17,$ffff18,$ffff19,$ffff20,$ffff21,$ffff22,$ffff23,$ffff24,$ffff25,$ffff26,$ffff27,$ffff28,$ffff29,$ffff30,$ffff31,$ffff32,$ffff33,$ffff34,$ffff35,$ffff36,$ffff37,$ffff38,$ffff39,$ffff40,$ffff41,$ffff42,$ffff43,$ffff44,$ffff45,$ffff46,$ffff47,$ffff48,$ffff49,$ffff50,$ffff51,$ffff52,$ffff53,$ffff54,$ffff55,$ffff56,$ffff57,$ffff58,$ffff59,$ffff60,$ffff61,$ffff62,$ffff63,$ffff64,$ffff65,$ffff66,$ffff67,$ffff68,$ffff69,$ffff70,$ffff71,$ffff72,$ffff73,$ffff74,$ffff75,$ffff76,$ffff77,$ffff78,$ffff79,$ffff80,$ffff81,$ffff82,$ffff83,$ffff84,$ffff85,$ffff86,$ffff87,$ffff88,$ffff89,$ffff90,$ffff91,$ffff92,$ffff93,$ffff94,$ffff95,$ffff96,$ffff97,$ffff98,$ffff99,$ffff100,$ffff101,$ffff102,$ffff103,$ffff104,$ffff105,$ffff106,$ffff107,$ffff108,$ffff109,$ffff110,$ffff111,$ffff112,$ffff113,$ffff114,$ffff115,$ffff116,$ffff117,$ffff118,$ffff119,$ffff120,$ffff121,$ffff122,$ffff123,$ffff124,$ffff125,$ffff126,$ffff127,$ffff128,$ffff129,$ffff130,$ffff131,$ffff132,$ffff133,$ffff134,$ffff135,$ffff136,$ffff137,$ffff138,$ffff139,$ffff140,$ffff141,$ffff142,$ffff143,$ffff144,$ffff145,$ffff146,$ffff147,$ffff148,$ffff149,$ffff150,$ffff151,$ffff152,$ffff153,$ffff154,$ffff155,$ffff156,$ffff157,$ffff158,$ffff159,$ffff160,$ffff161,$ffff162,$ffff163,$ffff164,$ffff165,$ffff166,$ffff167,$ffff168,$ffff169,$ffff170,$ffff171,$ffff172,$ffff173,$ffff174,$ffff175,$ffff176,$ffff177,$ffff178,$ffff179,$ffff180,$ffff181,$ffff182,$ffff183,$ffff184,$ffff185,$ffff186,$ffff187,$ffff188,$ffff189,$ffff190,$ffff191,$ffff192,$ffff193,$ffff194,$ffff195,$ffff196,$ffff197,$ffff198,$ffff199,$ffff200,$ffff201,$ffff202,$ffff203,$ffff204,$ffff205,$ffff206,$ffff207,$ffff208,$ffff209,$ffff210,$ffff211,$ffff212,$ffff213,$ffff214,$ffff215,$ffff216,$ffff217,$ffff218,$ffff219,$ffff220,$ffff221,$ffff222,$ffff223,$ffff224,$ffff225,$ffff226,$ffff227,$ffff228,$ffff229,$ffff230,$ffff231,$ffff232,$ffff233,$ffff234,$ffff235,$ffff236,$ffff237,$ffff238,$ffff239,$ffff240,$ffff241,$ffff242,$ffff243,$ffff244,$ffff245,$ffff246,$ffff247,$ffff248,$ffff249,$ffff250,$ffff251,$ffff252,$ffff253,$ffff254,$ffff255,$ffff256);
 

       // Si el usuario aun no tiene sus 4 referidos, checamos las id
       // y luego iniciamos con lo de la sesion para saber con que id se va a registrar
       // y quien es su referido.
       if ($referalnum < 4) 
       {

           if (!$this->CheckIDPosition($FirstNumbers[0]) == 0) {
             $this -> initializeSessionData($FirstNumbers[0],$id);
           }

           if (!$this->CheckIDPosition($FirstNumbers[1]) == 0) {
             $this -> initializeSessionData($FirstNumbers[1],$id);
           }

           if (!$this->CheckIDPosition($FirstNumbers[2]) == 0) {
             $this -> initializeSessionData($FirstNumbers[2],$id);
           }    

           if (!$this->CheckIDPosition($FirstNumbers[3]) == 0) {
             $this -> initializeSessionData($FirstNumbers[3],$id);
           }

       }

       // Segundo Bloque
       if ($referalnum > 4 || $referalnum < 16) 
       {
            for ($i=0; $i < 16; $i++) { 
               if (!$this->CheckIDPosition($SecondNumbers[$i]) == 0) {
                 $this -> initializeSessionData($SecondNumbers[$i],$id);
               }
            }
       }

       // Tercer Nivel
       if ($referalnum > 16 || $referalnum < 64) 
       {
            for ($i=0; $i < 64; $i++) { 
               if (!$this->CheckIDPosition($ThirdNumbers[$i]) == 0) {
                 $this -> initializeSessionData($ThirdNumbers[$i],$id);
               }
            }
       }


       if ($referalnum > 64 || $referalnum < 256) 
       {
            for ($i=0; $i < 256; $i++) { 
               if (!$this->CheckIDPosition($FourthFinalNumbers[$i]) == 0) {
                 $this -> initializeSessionData($FourthFinalNumbers[$i],$id);
               }
            }
       }




    }

    



















}