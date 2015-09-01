<?php
/******************************************************************************************************
                     Procédure de la connexion à la base de données
******************************************************************************************************/	
function connect($lang = "default")
{
  global $lang_param;
  
  //---> Chercher la base de données principal
  if ($lang == "default") 
  {
	reset($lang_param); 
	$lang  = each($lang_param);
	$lang  = $lang["key"];
  } //Fsi
  
  //---> Se connecter
  $r = @mysql_pconnect($lang_param[$lang]["host"], $lang_param[$lang]["user"], $lang_param[$lang]["password"]);
  if ($r==0) {
	echo "Erreur : PB de connexion au serveur mysql de la langue : $lang<br>";
  } //Fsi

  $r = @mysql_select_db($lang_param[$lang]["db"]);
  if ($r==0) {
	echo "Erreur : PB de connexion à la base de données de la langue : $lang<br>";
  } //Fsi
} //Fin connect
/****************************************************************************
                     Le temps en micro seconde
****************************************************************************/
function getMicroTime()
{
  list($usec, $sec) = explode(" ",microtime());
  return ((float)$usec + (float)$sec);
} //Fin getMicroTime
/****************************************************************************
     	Convertit les caractères spéciaux en entités HTML (sauf le &)
****************************************************************************/
function translate_special_chars($str, $default=ENT_QUOTES)
{
  $chars = array("'", '"', "<", ">");
  for ($i = 0; $i < count($chars); $i++)
  {
    $c   = htmlentities($chars[$i],$default);
	$str = str_replace($chars[$i], $c, $str);  
  } //FFor
  return $str;
} //Fin translate_special_chars
/****************************************************************************
  Formate une chaine de caractère pour l'afficher dans une zone de saisie
****************************************************************************/
function decode_text($str, $default="")
{
	if (empty($str)==FALSE)
	{  
	  $default = translate_special_chars(stripslashes($str),ENT_QUOTES);
	} //Fsi
	return $default;
} //Fin decode_text
/****************************************************************************
                 Formate une chaine de caractère pour l'afficher
****************************************************************************/
function affichage($str, $default="", $uppercase = TRUE)
{
	if (empty($str)==FALSE)
	{
	  if ($uppercase == TRUE)
	    $str = ucfirst($str);
	  $default = nl2br(translate_special_chars(stripslashes($str),ENT_QUOTES));
	} //Fsi
	return $default;  
} //Fin affichage
/****************************************************************************
                 Formate une chaine de caractère pour mettre dans la BD
****************************************************************************/
function lecture($str)
{
	/*
	if (empty($str)==FALSE)
	  $str = addslashes(trim($str));
	else
	  $str = "";*/
	return $str;
} //Fin lecture
/****************************************************************************
                  Obtenier l'ID d'une rurbrique du site
****************************************************************************/
function getRubriqueId($rubrique)
{
  $rubrique = strtolower($rubrique);
  $sql = "SELECT rubrique_id
          FROM rubrique_site
		  WHERE rubrique_nom = '$rubrique'";
  $res = executer($sql,__FILE__,__LINE__); 
  $row = mysql_fetch_array($res);
  if ($row==null)
    die("Rubrique introuvable : $rubrique");
  return $row['rubrique_id'];  
} //Fin getRubriqueId



function getprivileges($rubrique, $user_id)
{
   $rubrique_id = ($rubrique == 'index') ? getRubriqueId('accueil') : getRubriqueId($rubrique);
  $sql = "SELECT *
          FROM   privilege
          WHERE  rubrique_id = '$rubrique_id' AND user_id = '$user_id'";
   $res = executer($sql, __FILE__, __LINE__);
  $row = mysql_fetch_array($res);

  return $row['privilege_select'];  
} //Fin getRubriqueId


/****************************************************************************
                   Charger un fichier à patir du client 
****************************************************************************/
function upload_file($index, $dest)
{
  //---> test le type de fichier
  switch ($_FILES[$index]["type"]) {
  case "image/gif"    : break;
  case "image/png"    : break;
  case "image/jpg"    : break;
  case "image/pjpeg " : break;
  default             : //echo "Ce type d'application ne peut être téléchargé";
                        break;
  } //Fin switch
  //move_uploaded_file($_FILES[$index]['tmp_name'], $dest);
  copy($_FILES[$index]['tmp_name'], $dest);
  return filesize($dest);
} //Fin upload_file
/****************************************************************************
                       Exécuter une requête SQL 
****************************************************************************/
function executer($sql, $file, $line)
{
  $id = 0;
  return executer_id($sql, $file, $line, $id);
} //Fin executer
/****************************************************************************
          Exécuter une requête SQL avec retour d'un id si insertion 
****************************************************************************/
function executer_id($sql, $file, $line, &$id)
{
  $res = @mysql_query($sql);   //---> Exécuter la requête
  if ($res==FALSE) {
    echo "Erreur SQL dans $file ($line) : $sql<br>";
    die(mysql_error());
  } //Fsi
  //---> Il faut rafraichir mysql_insert_id avant d'exécuter la prochaine requête
  $id  = @mysql_insert_id();  
  //---> Si modification d'une table changer date de dernière modification du site
  if (mysql_affected_rows()>0)
  { //---> Modification, insertion ou suppression
    $sql = "UPDATE parametres
	        set    parametres_derniere_modification = " . time();
    @mysql_query($sql);   //---> Exécuter la requête			
  } //Fsi
  return $res;
} //Fin executer
/****************************************************************************
retourne une portion de la chaîne de caractères '$chaine' de longueur $length
****************************************************************************/
function portion($chaine, $length)
{
	if(strlen($chaine) > $length)
	{
		$chaine 	= substr($chaine, 0, $length);
		$t_chaine 	= @explode(" ", $chaine);
		$chaine 	= '';
		
		for($i=0; $i<count($t_chaine)-1;$i++)			$chaine .= $t_chaine[$i]." ";
		
		$chaine .= "...";
	}
	return trim($chaine);
} //Fin portion
/****************************************************************************
                 Afficher message d'erreur pour l'utilisateur
****************************************************************************/
function report_msg ($msg)
{
?>
  <br>
  <br>
  <br>
  <div align="center">
    <span style="font-size:10px;font-family:Verdana, Arial, Helvetica, sans-serif"><strong><?php echo htmlentities($msg)?></strong></span>
  </div>
  <br>
  <br>
<?php 
} //Fin report_msg
/***********************************************************************************************************
                                            Texte du peid de page Pied de page
***********************************************************************************************************/
function pied_page()
{
  global $parametres_site;
  $str = $parametres_site['param_pied_page'];
  $str = (str_replace("{@version}", " {$parametres_site['param_version']} "     , $str));
  $str = (str_replace("{@year}"   , date("Y")                                  , $str));
  $str = (str_replace("{@email}"  , " {$parametres_site['param_admin_email']} " , $str));
  $str = explode("\n",$str);
  for ($i=0;$i<count($str);$i++)
  {echo $str[$i]; echo '<br>';}
} //Fin pied_page
/****************************************************************************
                             Eliminer_doublons
****************************************************************************/
function array_eliminer_doublons($tab){
  $t = array();
  
  foreach ($tab as $v)
    if (in_array($v, $t,TRUE)==FALSE)
	  $t[] = $v;

  return $t;  
} //Fin array_eliminer_doublons
/****************************************************************************
                     Concaténer deux tableaux d'entiers
****************************************************************************/
function array_numeric_concat($tab1, $tab2)
{
  //---> Cas particuliers
  if (count($tab1)==0 && count($tab2)==0)
    return array();
  if (count($tab1)==0)
    return $tab2;
  if (count($tab2)==0)
    return $tab1;
	
  //---> Concaténation
  $tab = array();
  foreach ($tab1 as $v)
   $tab[] = $v;
  foreach ($tab2 as $v)
   $tab[] = $v;   
  
  //---> Eliminer les doublons
  $tab = array_eliminer_doublons($tab);
  
  return $tab;
} //Fin array_numeric_concat
/****************************************************************************
				           Fermer la session Admin
****************************************************************************/
function session_close()
{
  $session = $_GET['session'];
  $now = time();
  $sql = "UPDATE session_admin
          SET    dat_ferm_ses ='$now',
		         fermsession = 'Y'
          WHERE  md5(session_id) = '$session'
         ";
  executer($sql, __FILE__, __LINE__);
}
/****************************************************************************
                           Session Admin valide ? 
   Retourne l'ID de l'administrateur si la session est valide
              0  sinon   
****************************************************************************/
function session_valid($parametres_ouverture_session, $error_page="authentification.php")
{
  $user_id = 0;
  
  if (!isset($_GET['session']) ||
      !isset($_COOKIE['sid'])) {
?>
<script type="text/javascript" language="JavaScript">
  document.location.href = 'authentification.php';
</script>
<?php
    exit();
  }
  $session = $_GET['session'];
  $sql = "SELECT *
          FROM   session_admin
          WHERE  md5(session_id) = '$session'
         ";
  $res = executer($sql, __FILE__, __LINE__);
  $row = mysql_fetch_array($res);
  if ($row == FALSE) {
?>
<script type="text/javascript" language="JavaScript">
  document.location.href = 'authentification.php';
</script>
<?php
    exit();
  } else {	 	
    $fermsession = decode_text($row['fermsession']);
    if ($fermsession == 'Y') {
?>
<script type="text/javascript" language="JavaScript">
  document.location.href = 'authentification.php';
</script>
<?php
      exit();
    }
    $dat_ferm_ses = decode_text($row['dat_ferm_ses']);
    $now = time();
    if (($now - $dat_ferm_ses) > $parametres_ouverture_session) {
      $sql = "UPDATE session_admin
              SET    dat_ferm_ses    = '$now',
                     fermsession     = 'Y'
              WHERE  md5(session_id) = '$session'
             ";
      executer($sql, __FILE__, __LINE__);
?>
<script type="text/javascript" language="JavaScript">
  alert('la session ne peut pas rester ouverte plus de <?php echo ($parametres_ouverture_session / 60)?> mn');  
  document.location.href = 'authentification.php';
</script>
<?php 
      exit();
    } else {
      $sql = "UPDATE session_admin
              SET    dat_ferm_ses    = '$now'
              WHERE  md5(session_id) = '$session'
             ";
      executer($sql, __FILE__, __LINE__);
    }
    $user_id = decode_text($row['user_id']);
  }
  
  return $user_id;
}
/****************************************************************************
          Retourne le jour de la semaine d'une date (en Français)
****************************************************************************/
function jour_semaine($date)
{
  switch(date('w', $date)) {
    case '0' : return 'Dimanche';
    case '1' : return 'Lundi';
    case '2' : return 'Mardi';
    case '3' : return 'Mercredi';
    case '4' : return 'Jeudi';
    case '5' : return 'Vendredi';
    case '6' : return 'Samedi';
  }
}
/****************************************************************************
          Retourne le mois de l'année d'une date (en Français)
****************************************************************************/
function mois_annee($date)
{
  switch(date('M', $date)) {
	case 'Jan' : return 'janvier';
	case 'Feb' : return 'février';
	case 'Mar' : return 'mars';
	case 'Apr' : return 'avril';
	case 'May' : return 'mai';
	case 'Jun' : return 'juin';
	case 'Jul' : return 'juillet';
	case 'Aug' : return 'aout';
	case 'Sep' : return 'septembre';
	case 'Oct' : return 'octobre';
	case 'Nov' : return 'novembre';	
	case 'Dec' : return 'décembre';	
	default    : return 'Erreur';
  }
}
/****************************************************************************
                   Formate la Taille de Fichiers en O, KO et MO
****************************************************************************/
function file_size($taille)
{
  $str = "$taille octets";
  if ($taille / (1024 * 1024 * 1024) >= 1)
    return sprintf("%01.2f GO", $taille / (1024*1024*1024) );
  if ($taille / (1024 * 1024) >= 1)
    return sprintf("%01.2f MO", $taille / (1024*1024) );
  if ($taille / (1024) >= 1)
    return sprintf("%01.2f KO", (float) $taille / (1024) );		
  return $str;
} //Fsi
/****************************************************************************
          Affiche un text formaté avec du gras désigné par un & texte & 
****************************************************************************/
function affichage_gras($text, $style)
{
  //$tab   = explode("&",$text);
  //---> Il faut subdiviser la chaine $text selon le "&" tout en évitant la suite "&#";
  $tab   = array();
  $tab2  = explode("&#",$text);
  for ($i=0; $i<count($tab2); $i++)
  {
    $tab3 = explode("&", $tab2[$i]);
	for ($j=0; $j<count($tab3); $j++)
	{
	  if ($j==0 && $i>0)
        $tab[count($tab)-1] .= "&#".$tab3[$j];
	  elseif ($tab3[$j]!="" || count($tab)==0)
	    $tab[] = $tab3[$j];
	} //FFor
  } //FFor

  $html  = "<div class='$style'>";
  
  for ($i=0; $i<count($tab); $i++)
  {
	if ($i % 2 == 1)
	  $html .= "<b>" . affichage($tab[$i], "", FALSE) . "</b>";
	else
	  $html .= affichage($tab[$i], "", TRUE);
  } //FFor
  $html .= "</div>";
  return $html;
} //Fin affichage_gras
/****************************************************************************
     Affiche un text formaté avec du gras désigné par un & texte & 
     et des couleurs par ~ texte ~
****************************************************************************/
function affichage_couleur($text, $style1, $style2)
{
  $text  = affichage_gras($text, $style1);

  $tab   = explode("~",$text);
  $html  = "";
  
  for ($i=0; $i<count($tab); $i++)
  {
	if ($i % 2 == 1)
	  $html .= "<span class='$style2'>" . $tab[$i] . "</span>";
	else
	  $html .= $tab[$i];
  } //FFor
  return $html;
} //Fin affichage_couleur
/****************************************************************************
          Affiche un text formaté avec des puces désigné par un @ au 
		  début de la ligne
****************************************************************************/
function affichage_puce($text, $image, $style1, $style2, $space, $vspace, $balise_start = "", $balise_end = "")
{
  $tab   = explode("\n",$text);
  $i     = -1; 
  $group = false; 
  $html  = "<table border='0' align='left' width='100%' cellpading='2' cellspacing='0' class='$style1'>";

  //---> Construction des lignes du tableau
  while (++$i<count($tab))
  {
    $str    = $tab[$i] = trim($tab[$i]);
	$len    = strlen($str);
	
    if ($len == 0)
	{
	  $html .= "<tr height='$vspace'><td></td></tr>";
	  continue;
    } //Fsi

    $html  .= "<tr><td>";
	if ($str[0] == '@')
	{	
	  //---> Début Insertion d'un tableau
	  $str   = substr($str, 1, strlen($str)-1);
	  $str   = affichage_couleur($str,$style1, $style2);
	  $html .= "<table border='0' align='left' width='100%' cellpading='2' cellspacing='0' class='$style1'>
				<tr class='$style1' valign='top'>
				    <td width='$space' align='right'> <img src='$image' align='baseline'>&nbsp;</td>
					<td>
					  <div align='justify'>
					    $balise_start
						$str    
						$balise_end
					  </div>
					</td>
				  </tr>
				  </table>";
		//---> Fin Insertion d'un tableau
	} else
	{
	  $html .= affichage_couleur($str, $style1, $style2);  
	} //Fsi

    $html .= "</td></tr>";
  } //FTQ

  $html .= "</table>";
  return $html;
} //Fsi affichage_puce

function subtitle($str, $nbr)
{
  $sstr = explode(" ", $str);
  if (count($sstr) > $nbr) {
    for($i=0; $i < $nbr; $i++) {
      echo $sstr[$i]." ";
    }
    echo "..";
  } else {
    echo $str;
  }
}

/****************************************************************************
          Tronquer une chaine de caractères
****************************************************************************/
//$str est la chaîne de caractères et $nb le nombre de caractères maximum à afficher.
function tronque($str, $nb = 150) 
{
	// Si le nombre de caractères présents dans la chaine est supérieur au nombre 
	// maximum, alors on découpe la chaine au nombre de caractères 
	if (strlen($str) > $nb) 
	{
		$str = substr($str, 0, $nb);
		$position_espace = strrpos($str, " "); //on récupère l'emplacement du dernier espace dans la chaine, pour ne pas découper un mot.
		$texte = substr($str, 0, $position_espace);  //on redécoupe à la fin du dernier mot
		$str = $texte."..."; //puis on rajoute des ...
	}
	return $str; //on retourne la variable modifiée
}

/****************************************************************************
          Tronquer une chaine de caractères
****************************************************************************/
//$str est la chaîne de caractères et $nb le nombre de caractères maximum à afficher.
function couper1($str, $nb = 150) 
{
	// Si le nombre de caractères présents dans la chaine est supérieur au nombre 
	// maximum, alors on découpe la chaine au nombre de caractères 
	if (strlen($str) > $nb) 
	{
		$str = substr($str, 0, $nb);
		$position_espace = strrpos($str, " "); //on récupère l'emplacement du dernier espace dans la chaine, pour ne pas découper un mot.
		$texte = substr($str, 0, $position_espace);  //on redécoupe à la fin du dernier mot
	}
	return $texte; //on retourne la variable modifiée
}

//$str est la chaîne de caractères et $nb le nombre de caractères maximum à afficher.
function couper2($str) 
{
	// Si le nombre de caractères présents dans la chaine est supérieur au nombre 
	// maximum, alors on découpe la chaine au nombre de caractères 
	if (strlen($str) > $nb) {
		$str = substr($str, 0, $nb);
		$position_espace = strrpos($str, " "); //on récupère l'emplacement du dernier espace dans la chaine, pour ne pas découper un mot.
		$texte = substr($str, 0, $position_espace);  //on redécoupe à la fin du dernier mot
	}
	return $texte; //on retourne la variable modifiée
}
/****************************************************************************
      Envoi d'un email au format HTML avec une éventuelle pièce jointe.
****************************************************************************/
function email_attachement($to, $from, $objet, $html, $fichier_titre="", $fichier="", $mime="", $reply = FALSE)
{
	$joint   = ($fichier_titre != "") && ($fichier != "") && ($mime!="");
	
	$reply   = ($reply=="")? $from : $reply;
	$date    = defined("DATE_RFC2822")? date(DATE_RFC2822) : date("D, d M Y H:i:s O");
  
	$header  = "From: $from\r\n";
	$header .= "Reply-to: $reply\r\n";
	$header .= "Date: $date\r\n";
  $header .= "MIME-Version: 1.0\r\n"; 
	
	if (! $joint)
	{
    $header  .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";	
		$header  .= "Content-Transfer-Encoding: 7bit\r\n\r\n"; 
		$message  = $html;
	} 
	else
	{
  	$limite  = "----=_parties_".md5(uniqid(rand()));
  	$header .= "Content-Type: multipart/mixed; boundary=\"$limite\"\r\n";
		$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n"; 		

		$message  = "This part of the E-mail should never be seen. If you are reading this \n";
		$message .= "consider upgrading your e-mail client to a MIME-compatible client.\r\n\r\n";
		
		$message .= "--$limite\r\n"; 
	
		$message .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n";
		// Pour éviter les problèmes avec du texte HTML
		//$message .= "Content-Transfer-Encoding: quoted-printable\r\n";
		$message .= "Content-Transfer-Encoding: 7bit\r\n"; 	
		$message .= "Content-Disposition: inline \r\n\r\n";
		$message .= "$html\r\n\r\n";	
		
		//--> Ouvrir le fichier de la pièce jointe
		$fp       = fopen($fichier, "r");
		if ($fp==FALSE)
		  die("Impossible d'ouvrir le fichier : $fichier ");
		$fichier_contenu = fread($fp, filesize($fichier)); 
	  fclose($fp);
		
	  $message .= "--$limite\r\n";
		$message .= "Content-Type: $mime; name=\"$fichier_titre\"\r\n";
		$message .= "Content-Transfer-Encoding: base64\r\n"; 
		//---> You can use Content-Disposition: attachment or Content-Disposition: inline
	  $message .= "Content-Disposition: attachment; filename=\"$fichier_titre\"\r\n\r\n";
		$message .= chunk_split(base64_encode($fichier_contenu)); 		  
	
	  $message .= "\r\n\r\n\r\n--$limite--\r\n";
	} //Fsi
	return mail($to, $objet, $message, $header);
} //Fin email_attachement


?>