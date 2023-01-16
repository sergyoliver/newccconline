<?php /// FONCTION INSERER DANS LA BASE DE DONNEES
$titre ="Alerte Incommodo | Bienvenue";
//$titre_site="2CM | Bienvenue sur le site officiel &#8211; Communication publicité";

/// fonction format des date et heure jj-mm-yyyy et h:mn:s
function insert_tab($nomtab,$tab)
{
$t = 0;
$info = "";
	require 'connectpg.php';

//var_dump($tab);
$i = count($tab);
$req = "INSERT INTO " . $nomtab . "(";
$st="";
	foreach ($tab as $key => $valeur)
	{

		//echo $valeur;
	$i--;
	if($i >0)
	{
		$req.= $key." ," ;

	}else
	{
		$req.= $key." )";
	}

}
$req.= "VALUES(" ;

$t1 = count($tab);
foreach ($tab as $key1 => $val)
{

	$t1--;
	if($t1 >0)
	{
		$req.= $key1." ," ;
		$st.= "'".$key1."'=>".$val.", ";

	}else
	{
		$req.= $key1." )";
		$st.= "'".$key1."'=>".$val.")";

		//$tableo[$test]= $val;
	}

}
return  $bdd->prepare($req);
//echo $req;

	//$tableo = array($st);
	//var_dump($tableo);

}


function supp_img($id, $rep,$champ,$idch,$tab)
{
    require 'connectpg.php';

    $rs1 = $bdd->prepare("select * FROM ".$tab." WHERE ".$idch."='".$id."'");
	$rs1->execute();
	$ret = $rs1->fetch();

	$img1 = $ret[$champ];
	$rep2= $rep.'/'.$img1;
	/// unlink($rep2);
	return $rep2;

}

/// fonction format des date et heure jj-mm-yyyy et h:mn:s
function format_date($date) {
//
	$tab = explode(" ", $date);
//var_dump ($tab);
	$i = count($tab);
	if ($i == 1) {
		$tab = explode("-", $date);
		$y = $tab[0];
		$m = $tab[1];
		$j = $tab[2];
		$datef = $j . "-" . $m . "-" . $y;
		return $datef;
	} else {

		$tab2 = explode("-", $tab[0]);
//var_dump ($tab2);
		$y = $tab2[0];
		$m = $tab2[1];
		$j = $tab2[2];
		$datef = $j . "-" . $m . "-" . $y;
		$heure = $tab[1];
		return $datef . " " . $heure;
	}
}


function format_date2($date) {
//
	$tab = explode(" ", $date);
//var_dump ($tab);
	$i = count($tab);
	if ($i == 1) {
		$tab = explode("-", $date);
		$y = $tab[0];
		$m = $tab[1];
		$j = $tab[2];
		$datef = $j . "-" . $m . "-" . $y;
		return $datef;
	} else {

		$tab2 = explode("-", $tab[0]);
//var_dump ($tab2);
		$y = $tab2[0];
		$m = $tab2[1];
		$j = $tab2[2];
		$datef = $j . "-" . $m . "-" . $y;
		$heure = $tab[1];
		return $datef ;
	}

}
function format_date3($date) {
//
	$tab = explode(" ", $date);
//var_dump ($tab);
	$i = count($tab);
	if ($i == 1) {
		$tab = explode("-", $date);
		$y = $tab[0];
		$m = $tab[1];
		$j = $tab[2];
		$datef = $m . "/" . $j . "/" . $y;
		return $datef;
	} else {

		$tab2 = explode("-", $tab[0]);
//var_dump ($tab2);
		$y = $tab2[0];
		$m = $tab2[1];
		$j = $tab2[2];
		$datef = $m . "/" . $j . "/" . $y;
		$heure = $tab[1];
		return $datef ;
	}

}

function format_date4($date) {
//
    $tab2 = explode(" ", $date);
//var_dump ($tab);
    $i = count($tab2);
    if ($i == 1) {
        $tab = explode("-", $date);
        $y = $tab[0];
        $m = $tab[1];
        $j = $tab[2];
        $datef = $j. "/" . $m . "/" . $y;
        return $datef;
    } else {

        $tab = explode("-", $tab2[0]);
//var_dump ($tab2);
        $y = $tab[0];
        $m = $tab[1];
        $j = $tab[2];
        $heure = $tab2[1];
        $datef = $j . "/" . $m . "/" . $y." à ".$heure;

        return $datef ;
    }

}

/// fonction format des date et heure jj-mm-yyyy et h:mn:s
function formatinv_date($date) {
//
	$tab = explode(" ", $date);
//var_dump ($tab);
	$i = count($tab);
	if ($i == 1) {
		$tab = explode("-", $date);
		$j = $tab[0];
		$m = $tab[1];
		$y = $tab[2];
		$datef = $y. "-" . $m . "-" . $j ;
		return $datef;
	}
}


function date_lettre($date2)
{
	$tab2 = explode("-", $date2);

	switch($tab2[1]) {
		case '01': $mois = 'Janvier'; break;
		case '02': $mois = 'Février'; break;
		case '03': $mois = 'Mars'; break;
		case '04': $mois = 'Avril'; break;
		case '05': $mois = 'Mai'; break;
		case '06': $mois = 'Juin'; break;
		case '07': $mois = 'Juillet'; break;
		case '08': $mois = 'Aout'; break;
		case '09': $mois = 'Septembre'; break;
		case '10': $mois = 'Octobre'; break;
		case '11': $mois = 'Novembre'; break;
		case '12': $mois = 'Decembre'; break;
		default: $mois =''; break;
	}
	if($tab2[2]==01){ $j="1er";}else{ $j=$tab2[2];}
	//$jour_nb = date('d');
//$annee = date('Y');
	return $j.'&nbsp;'.$mois.'&nbsp;'.$tab2[0];

}
function date_lettreab($date2)
{
	$tab2 = explode(" ", $date2);
$dt = explode("-", $tab2[0]);
	switch($dt[1]) {
        case '01': $mois = 'Jan.'; break;
        case '02': $mois = 'Fév.'; break;
        case '03': $mois = 'Mars'; break;
        case '04': $mois = 'Avril'; break;
        case '05': $mois = 'Mai'; break;
        case '06': $mois = 'Juin'; break;
        case '07': $mois = 'Juil.'; break;
        case '08': $mois = 'Aout'; break;
        case '09': $mois = 'Sept.'; break;
        case '10': $mois = 'Oct.'; break;
        case '11': $mois = 'Nov.'; break;
        case '12': $mois = 'Dec.'; break;
		default: $mois =''; break;
	}
	if($dt[2]==01){ $j="1er";}else{ $j=$dt[2];}
	//$jour_nb = date('d');
//$annee = date('Y');
	return $j.' '.$mois.' '.$dt[0];

}

function moisdt($m)
{

    switch($m) {
        case '1': $mois = 'de Janvier'; break;
        case '2': $mois = 'de Février'; break;
        case '3': $mois = 'de Mars'; break;
        case '4': $mois = 'd\' Avril'; break;
        case '5': $mois = 'de Mai'; break;
        case '6': $mois = 'de Juin'; break;
        case '7': $mois = 'de Juillet'; break;
        case '8': $mois = 'd\' Aout'; break;
        case '9': $mois = 'de Septembre'; break;
        case '10': $mois = 'de Octobre'; break;
        case '11': $mois = 'de Novembre'; break;
        case '12': $mois = 'de Decembre'; break;
        default: $mois =''; break;
    }

    //$jour_nb = date('d');
//$annee = date('Y');
    return $mois;

}
function moisdt2($m)
{

    switch($m) {
        case '1': $mois = 'Janvier'; break;
        case '2': $mois = 'Février'; break;
        case '3': $mois = 'Mars'; break;
        case '4': $mois = 'Avril'; break;
        case '5': $mois = 'Mai'; break;
        case '6': $mois = 'Juin'; break;
        case '7': $mois = 'Juillet'; break;
        case '8': $mois = 'Aout'; break;
        case '9': $mois = 'Septembre'; break;
        case '10': $mois = 'Octobre'; break;
        case '11': $mois = 'Novembre'; break;
        case '12': $mois = 'Decembre'; break;
        default: $mois =''; break;
    }

    //$jour_nb = date('d');
//$annee = date('Y');
    return $mois;

}
// date inverse pr BD sous forme yyyy/mm/dd
function formatinv_date2($date) {
//

    $tab = explode("/", $date);
    $j = $tab[0];
    $m = $tab[1];
    $y = $tab[2];
    $datef = $y. "-" . $m . "-" . $j ;
    return $datef;

}



/// retourne le mois
function date_mois($date4)
{
	$tab2 = explode("-", $date4);

	switch($tab2[1]) {
		case '01': $mois = 'Janvier'; break;
		case '02': $mois = 'Février'; break;
		case '03': $mois = 'Mars'; break;
		case '04': $mois = 'Avril'; break;
		case '05': $mois = 'Mai'; break;
		case '06': $mois = 'Juin'; break;
		case '07': $mois = 'Juillet'; break;
		case '08': $mois = 'Aout'; break;
		case '09': $mois = 'Septembre'; break;
		case '10': $mois = 'Octobre'; break;
		case '11': $mois = 'Novembre'; break;
		case '12': $mois = 'Decembre'; break;
		default: $mois =''; break;
	}
	//$jour_nb = date('d');
//$annee = date('Y');
	return $mois;

}
/// retourne le mois
function mois($mo)
{


	switch($mo) {
		case '01': $mois = 'Janvier'; break;
		case '02': $mois = 'Février'; break;
		case '03': $mois = 'Mars'; break;
		case '04': $mois = 'Avril'; break;
		case '05': $mois = 'Mai'; break;
		case '06': $mois = 'Juin'; break;
		case '07': $mois = 'Juillet'; break;
		case '08': $mois = 'Aout'; break;
		case '09': $mois = 'Septembre'; break;
		case '10': $mois = 'Octobre'; break;
		case '11': $mois = 'Novembre'; break;
		case '12': $mois = 'Decembre'; break;
		default: $mois =''; break;
	}
	//$jour_nb = date('d');
//$annee = date('Y');
	return $mois;

}

/// retourne le mois
function date_mois_abrege($date5)
{
	$tab2 = explode("-", $date5);

	switch($tab2[1]) {
		case '01': $mois = 'Jan'; break;
		case '02': $mois = 'Fév'; break;
		case '03': $mois = 'Mars'; break;
		case '04': $mois = 'Avril'; break;
		case '05': $mois = 'Mai'; break;
		case '06': $mois = 'Juin'; break;
		case '07': $mois = 'Juil'; break;
		case '08': $mois = 'Aout'; break;
		case '09': $mois = 'Sept'; break;
		case '10': $mois = 'Oct'; break;
		case '11': $mois = 'Nov'; break;
		case '12': $mois = 'Dec'; break;
		default: $mois =''; break;
	}

	//$jour_nb = date('d');
//$annee = date('Y');
	return $mois;

}

/// retourne l annee

function date_annee($date3)
{
	$tab2 = explode("-", $date3);


	//$jour_nb = date('d');
	$annee =$tab2[0];
	return $annee;

}


// date inverse pr BD sous forme yyyy/mm/dd
function formatinv_date3($date) {
//
	$tab = explode(" ", $date);
//var_dump ($tab);
	$i = count($tab);
	if ($i == 1) {
		$tab = explode("-", $date);
		$j = $tab[0];
		$m = $tab[1];
		$y = $tab[2];
		$datef = $y. "-" . $m . "-" . $j ;
		return $datef;
	}
}
function dateh() {
	$day = date ('w');
	$month = date('m');
	$nd = date ('d');
	$annee = date ('Y');
	$heure = date ('H \h i \m\i\n');
	$JoursSemaine = array("Dimanche ","Lundi ","Mardi ","Mercredi ","Jeudi ","Vendredi ","Samedi ");
	$jour = $JoursSemaine[$day];
	$Moi = array(
		"01" => " Janvier ",
		"02" => " Février ",
		"03" => " Mars ",
		"04" => " Avril ",
		"05" => " Mai ",
		"06" => " Juin ",
		"07" => " Juillet ",
		"08" => " Août ",
		"09" => " Septembre ",
		"10" => " Octobre ",
		"11" => " Novembre ",
		"12" => " Décembre ");
	$moi = $Moi[$month];
	echo $jour .$nd .$moi .$annee;

}




//// mot de passe aleatoire
function pwd_aleatoire($nb_car, $chaine = 'kassiui_+AHPOopqsdfghjklmwxcvbn0123456789')
{
    $nb_lettres = strlen($chaine) - 1;
    $generation = '';
    for($i=0; $i < $nb_car; $i++)
    {
        $pos = mt_rand(0, $nb_lettres);
        $car = $chaine[$pos];
        $generation .= $car;
    }
    return $generation;
}


//// code contrat  variable de session + code generer par cette function

function passAlea($car) {
$codePass = "";
$code = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
srand((double)microtime()*1000000);
for($i=0; $i<$car; $i++) {
$codePass .= $code[rand()%strlen($code)];
}
return $codePass;
}

// APPEL
// Génère une chaine de longueur 20
 $code=passAlea(3); 
 
 
 /// envoi de mail
 



function mdp($pwd)
{


$secu=0; 

if(preg_match('#[^a-zA-Z0-9\s]+#',$pwd))
	{
	$secu++;
	}
if(strlen($pwd)>5){ 
$secu++; 
	}
return $secu;

}

function datema($d2) {
 
 $tabt = explode(" ", $d2);
  $tabt2 = explode("-", $tabt[0]);
       // $j = $tab[2];
        $m = $tabt2[1];
        $y = $tabt2[0];
  
    $tmois = array(
                "01" => " Jan ",
                "02" => " Fev ",
                "03" => " Mar ",
                "04" => " Avr ",
                "05" => " Mai ",
                "06" => " Juin ",
                "07" => " Juil ",
                "08" => " Aout ",
                "09" => " Sept ",
                "10" => " Oct ",
                "11" => " Nov ",
                "12" => " Dec ");
    $moi = $tmois[$m];
return $moi;

	}

function datemois($md) {


       // $j = $tab[2];
        $m = $md;


    $tmois = array(
                "1" => " Jan ",
                "2" => " Fev ",
                "3" => " Mar ",
                "4" => " Avr ",
                "5" => " Mai ",
                "6" => " Juin ",
                "7" => " Juil ",
                "8" => " Aout ",
                "9" => " Sept ",
                "10" => " Oct ",
                "11" => " Nov ",
                "12" => " Dec ");
    $moi = $tmois[$m];
return $moi;

	}

function datej2($d) {
 
$tab = explode(" ", $d);
  $tab2 = explode("-", $tab[0]);
       
        //$m = $tab2[1];
        //$y = $tab2[0];
        $j = $tab2[2];
        if($j==1) $jour = "1er";
		if($j==2) $jour = "02";
		if($j==3) $jour = "03";
		if($j==4) $jour = "04";
		if($j==5) $jour = "05";
		if($j==6) $jour = "06";
		if($j==7) $jour = "07";
		if($j==8) $jour = "08";
		if($j==9) $jour = "09";
          $jour= $j;
        return $jour;

	}




function date_lettreen($date22)
{
    $tab2 = explode("-", $date22);

    switch($tab2[1]) {
        case '01': $mois = 'Jan'; break;
        case '02': $mois = 'Fev'; break;
        case '03': $mois = 'Mar'; break;
        case '04': $mois = 'Apr'; break;
        case '05': $mois = 'May'; break;
        case '06': $mois = 'Jun'; break;
        case '07': $mois = 'Jul'; break;
        case '08': $mois = 'Aug'; break;
        case '09': $mois = 'Sept'; break;
        case '10': $mois = 'Oct'; break;
        case '11': $mois = 'Nov'; break;
        case '12': $mois = 'Dec'; break;
        default: $mois =''; break;
    }
    if($tab2[2]==01){ $j="1st";}elseif($tab2[2]==02){ $j="2nd";}elseif($tab2[2]==03){ $j="3rd";}else{ $j=$tab2[2];}
    //$jour_nb = date('d');
//$annee = date('Y');
    return $mois.'&nbsp;'.$j.',&nbsp;'.$tab2[0];

}


/// retourne le mois
function date_mois2($date4)
{
    $tab2 = explode("-", $date4);

    switch($tab2[1]) {
        case '01': $mois = 'Janvier'; break;
        case '02': $mois = 'Février'; break;
        case '03': $mois = 'Mars'; break;
        case '04': $mois = 'Avril'; break;
        case '05': $mois = 'Mai'; break;
        case '06': $mois = 'Juin'; break;
        case '07': $mois = 'Juillet'; break;
        case '08': $mois = 'Aout'; break;
        case '09': $mois = 'Septembre'; break;
        case '10': $mois = 'Octobre'; break;
        case '11': $mois = 'Novembre'; break;
        case '12': $mois = 'Decembre'; break;
        default: $mois =''; break;
    }
    //$jour_nb = date('d');
//$annee = date('Y');
    return $mois;

}
/// retourne le mois
function mois2($mo)
{


    switch($mo) {
        case '01': $mois = 'Janvier'; break;
        case '02': $mois = 'Février'; break;
        case '03': $mois = 'Mars'; break;
        case '04': $mois = 'Avril'; break;
        case '05': $mois = 'Mai'; break;
        case '06': $mois = 'Juin'; break;
        case '07': $mois = 'Juillet'; break;
        case '08': $mois = 'Aout'; break;
        case '09': $mois = 'Septembre'; break;
        case '10': $mois = 'Octobre'; break;
        case '11': $mois = 'Novembre'; break;
        case '12': $mois = 'Decembre'; break;
        default: $mois =''; break;
    }
    //$jour_nb = date('d');
//$annee = date('Y');
    return $mois;

}

//////  renvoi le temps ecoulé


function tempsecoule($date){
	if(!ctype_digit($date))
		$date = strtotime($date);
	if(date('Ymd', $date) == date('Ymd')){
		$diff = time()- $date;
		if($diff < 60) /* moins de 60 secondes */
			return 'Il y a '.$diff.' sec';
		else if($diff < 3600) /* moins d'une heure */
			return 'Il y a '.round($diff/60, 0).' min';
		else if($diff < 10800) /* moins de 3 heures */
			return 'Il y a '.round($diff/3600, 0).' heures';
		else /*  plus de 3 heures ont affiche ajourd'hui à HH:MM:SS */
			return 'Aujourd\'hui à '.date('H:i:s', $date);
	}
	else if(date('Ymd', $date) == date('Ymd', strtotime('- 1 DAY')))
		return 'Hier à '.date('H:i:s', $date);
	else if(date('Ymd', $date) == date('Ymd', strtotime('- 2 DAY')))
		return 'Il y a 2 jours à '.date('H:i:s', $date);
	else
		return 'Le '.date('d/m/Y à H:i:s', $date);
}

function tempsecoule2($date){
    //$tab = explode(".", $date);
	if(!ctype_digit($date))
		$date = strtotime($date);
	if(date('Ymd', $date) == date('Ymd')){
		$diff = time()-$date;
		if($diff < 60) /* moins de 60 secondes */
			return 'Il y a '.$diff.' sec';
		else if($diff < 3600) /* moins d'une heure */
			return 'Il y a '.round($diff/60, 0).' min';
		else if($diff < 10800) /* moins de 3 heures */
			return 'Il y a '.round($diff/3600, 0).' heures';
		else /*  plus de 3 heures ont affiche ajourd'hui à HH:MM:SS */
			return 'Aujourd\'hui à '.date('H:i:s', $date);
	}
	else if(date('Ymd', $date) == date('Ymd', strtotime('- 1 DAY')))
		return 'Hier à '.date('H:i:s', $date);
	else if(date('Ymd', $date) == date('Ymd', strtotime('- 2 DAY')))
		return 'Il y a 2 jours à '.date('H:i:s', $date);
	else
		return 'le '.date('d/m/Y', $date);
}

function jourecoule($date){
	if(!ctype_digit($date))
		$date = strtotime($date);
	$date1 = strtotime(date("Y-m-d"));


// On récupère la différence de timestamp entre les 2 précédents
	$nbJoursTimestamp = $date1 - $date;
	if($nbJoursTimestamp >0)
	{
		$nbJours = $nbJoursTimestamp/86400;
	}else{
		$nbJours = 0;
	}

// ** Pour convertir le timestamp (exprimé en secondes) en jours **
// On sait que 1 heure = 60 secondes * 60 minutes et que 1 jour = 24 heures donc :
	// 86 400 = 60*60*24

	return $nbJours;
}



// nbre de mois
function dateDiff($date1, $date2){
	$diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative

	return date("m",$diff);
}

// nmbre de jours
function dateDiffjrs($date1, $date2){
	$diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative

	return date("d",$diff);
}

function NbJours($debut, $fin) {//Nombre de jour entre 2 date

    $debut1 = explode(" ", $debut);
    $fin1 = explode(" ", $fin);
    $tDeb = explode("-", $debut1[0]);
    $tFin = explode("-", $fin1[0]);

    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
        mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);


    if(intval($tDeb[1]) >= 7)
    {
        return abs(floor((($diff / 86400)+1)));
    }
    elseif(intval($tDeb[1]) < 7)
    {
        return abs(ceil((($diff / 86400)+1)));
    }
    else
    {
        echo "Problème pour calculer le nombre de jours";
        exit;
    }

}
function trace($chemin,$nom,$action){

	$error = gmdate('d/m/Y H:i:s',time()).", utilisateur:".$nom.", action:".$action;
	$nom="histoavoir_".gmdate('Y_m_d',time());

	$fp = fopen($chemin.$nom.'.txt', 'a+');
	fwrite($fp, $error."\r\n");
	fclose($fp);
}

function tracehistodate($chemin,$nom,$action){

	$error = gmdate('d/m/Y H:i:s',time()).", utilisateur:".$nom.", action:".$action;
	$nom="histodate_".gmdate('Y_m_d',time());

	$fp = fopen($chemin.$nom.'.txt', 'a+');
	fwrite($fp, $error."\r\n");
	fclose($fp);
}
function traceuser($chemin,$nom,$action){

	$error = gmdate('d/m/Y H:i:s',time()).", utilisateur:".$nom.", action:".$action;
	$nom="histouser_".gmdate('Y_m_d',time());

	$fp = fopen($chemin.$nom.'.txt', 'a+');
	fwrite($fp, $error."\r\n");
	fclose($fp);
}

function trace_echec($chemin,$nom,$action){

	$error = gmdate('d/m/Y H:i:s',time()).", utilisateur:".$nom.", action:".$action;
	$nom="connect_fail_".gmdate('Y_m_d',time());

	$fp = fopen($chemin.$nom.'.txt', 'a+');
	fwrite($fp, $error."\r\n");
	fclose($fp);
}

function traceaction($chemin,$nom,$action,$nomf){

	$error = gmdate('d/m/Y H:i:s',time()).", utilisateur:".$nom.", action:".$action;
	$nom=$nomf.gmdate('Y_m_d',time());

	$fp = fopen($chemin.$nom.'.txt', 'a+');
	fwrite($fp, $error."\r\n");
	fclose($fp);
}

/// obtenir l ip
function get_ip() {
	// IP si internet partagé
	if (isset($_SERVER['HTTP_CLIENT_IP'])) {
		return $_SERVER['HTTP_CLIENT_IP'];
	}
	// IP derrière un proxy
	elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	// Sinon : IP normale
	else {
		return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
	}
}

function initial($nom){
    $nom_initiale="";
    $n_mot = explode(" ",$nom);


    foreach($n_mot as $lettre){
        $nom_initiale .= $lettre[0];
    }
    return strtoupper($nom_initiale);
}

function numfact($num,$dat,$nom)
{
    $codefact="";
    $init_nom = initial($nom);
    $an2 = date("my", strtotime($dat));
    if($num <= 9)
    {
        $nbre ="000".$num;
    }

    if($num >=10 && $num < 100)
    {
        $nbre ="00".$num;
    }

    if($num >=100 && $num < 1000)
    {
        $nbre ="0".$num;
    }
    if($num >=1000 )
    {
        $nbre =$num;
    }

    $codefact = $init_nom.$an2.$nbre;
    return $codefact;

}

function numfact2($num1,$dat,$nom)
{
    $codefact="";
    // $init_nom = initial($nom);
    $an2 = date("my", strtotime($dat));
    if($num1 <= 9)
    {
        $nbre1 ="000".$num1;
    }

    if($num1 >=10 && $num1 < 100)
    {
        $nbre1 ="00".$num1;
    }

    if($num1 >=100 && $num1 < 1000)
    {
        $nbre1 ="0".$num1;
    }
    if($num1 >=1000 )
    {
        $nbre1 =$num1;
    }

    $codefact1 = $nom.$an2.$nbre1;
    return $codefact1;

}

/// numerotation des maisons
function numfact3($num,$init)
{

    if($num <= 9)
    {
        $nbre ="000".$num;
    }

    if($num >=10 && $num < 100)
    {
        $nbre ="00".$num;
    }

    if($num >=100 && $num < 1000)
    {
        $nbre ="0".$num;
    }
    if($num >=1000 )
    {
        $nbre =$num;
    }

    $numhbt = $nbre.'.'.$init;
    return $numhbt;

}/// numerotation des maisons
function numass($num,$init)
{

    if($num <= 9)
    {
        $nbre ="000".$num;
    }

    if($num >=10 && $num < 100)
    {
        $nbre ="00".$num;
    }

    if($num >=100 && $num < 1000)
    {
        $nbre ="0".$num;
    }
    if($num >=1000 )
    {
        $nbre =$num;
    }

    $numhbt = $init.$nbre;
    return $numhbt;

}

function numauto($num,$ch)
{
    if ($ch ==3){


        if($num <= 9)
        {
            $nbre1 ="000".$num;
        }

        if($num >=10 && $num < 100)
        {
            $nbre1 ="00".$num;
        }

        if($num >=100 && $num < 1000)
        {
            $nbre1 ="0".$num;
        }
        if($num >=1000 )
        {
            $nbre1 =$num;
        }

    }
    if ($ch==2){
        if($num <= 9)
        {
            $nbre1 ="00".$num;
        }

        if($num >=10 && $num < 100)
        {
            $nbre1 ="0".$num;
        }

        if($num >=100)
        {
            $nbre1 =$num;
        }


    }
    if ($ch==1){
        if($num <= 9)
        {
            $nbre1 ="0".$num;
        }

        if($num >=10 )
        {
            $nbre1 =$num;
        }




    }


    return $nbre1;

}
function numautomatique($num)
{



        if($num <= 9)
        {
            $nbre1 ="000".$num;
        }

        if($num >=10 && $num < 100)
        {
            $nbre1 ="00".$num;
        }

        if($num >=100 && $num < 1000)
        {
            $nbre1 ="0".$num;
        }
        if($num >=1000 )
        {
            $nbre1 =$num;
        }



    return $nbre1;

}

function ajoutitret($str){
    $str2 = str_replace ( ' ', '-', $str);
    return $str2;
}

function generer_codepar($type,$dep){


    include 'connectpg.php';
    // on recherche la delegation
    $rsdp = $bdd->prepare('select * from tb_departement where code_departement = :d ');
    $rsdp->execute(array('d' =>$dep ));
    $rowdp = $rsdp->fetch();
    $codedel = $rowdp['delegation_code'];
    if ($type='CAFE'){
        $init = 'C';
    }else{
        $init = 'K';
    }
    $codedelr = $init.$rowdp['delegation_code'];
//echo "select * from tb_parcelle where type_plantation= '$type' and code_parcelle LIKE '$codedelr%'";

    $rs1234 = $bdd->prepare("select * from tb_parcelle where type_plantation= :type and code_parcelle LIKE '$codedelr%'", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $rs1234->execute(array('type' => $type ));
    $nb1234 = $rs1234->rowCount();
    $nb1234 =$nb1234+1 ;
    $numeroauto = numautomatique($nb1234);



    $code_parcelle  =$init.$codedel.$numeroauto;
    $tab[0]=$code_parcelle;
    $tab[1]=$codedel;
    return $tab;


}
?>