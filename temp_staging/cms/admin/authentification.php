<?php 
  setcookie('sid','Y');
  include '../include/connexion.php';
  include '../include/fonctions.php';
  connect();
  include '../include/parametres.php';
  
  $status = '';
  if (isset($_POST['pw']) && 
      isset($_POST['user'])) {
    $pw = lecture($_POST['pw']);
    $pw = md5($pw);
    $user = lecture($_POST['user']);
    $sql = "SELECT admin_user_id, admin_user_actif 
            FROM   admin_user
            WHERE  admin_user_nom = '$user' AND admin_user_password = '$pw'
           ";
    $res = executer($sql, __FILE__, __LINE__);
    $row = mysql_fetch_array($res); /* Retourne un tableau qui correspond à la ligne récupérée ou FALSE s'il n'y a plus de lignes */
    if ($row == FALSE) { /* Login et/ou mot de passe incorrect */
      $status = 'incorrect';  
    } else {
      $user_actif = decode_text($row['admin_user_actif']);
      if ($user_actif == 'N') { /* Utilisateur inactif */
        unset($_COOKIE['sid']);
        $status = 'inactif';
      } else {
        $user_id = decode_text($row['admin_user_id']);
        $now = time();
        $sql = "INSERT INTO session_admin
                SET         user_id      = '$user_id',
                            dat_ouv_ses  = '$now',
                            dat_ferm_ses = '$now'
               ";
        executer_id($sql, __FILE__, __LINE__, $session_id);
        $session_id = md5($session_id);
?>
<script language='JavaScript' type="text/javascript">
<!--
  document.location.href='index.php?session=<?php echo $session_id?>';
-->
</script>
<?php
        exit();
      }
    }
  }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
                      "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Zone Admin</title>
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../include/scripts.js"></script>
<script type="text/javascript" language="JavaScript">
<!--
  function verif()
  {
	if (document.form1.user.value=="")
	{
	  alert ("user name is mandatory ");
	  document.form1.user.focus();
	  return;
	} //Fsi
	if (document.form1.pw.value=="")
	{
	  alert ("the password is required ");
      document.form1.pw.focus();
	  return;
	} //Fsi	
	document.form1.submit();
  } //Fin verif
-->
</script>
</head>
<body bgcolor="#8A979D">
<table width="668" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
  <td colspan="2">
    <span style="color:#FFFFFF;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:24px;font-weight:bold">
	  Administration area 
	</span>
	<br>
	<span style="color:#FFFFFF;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:14px;">
	  <?php echo $param_titre_site?>
    </span>
	<br>
  </td>
</tr>
<tr>
  <td colspan="2" height="15"></td>
</tr>
<tr>
  <td colspan="2" height="15">
    <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="10"><img src="./images/tab2.gif" width="10" height="33"></td>
      <td width="100%" height="31" colspan="2" align="right" valign="middle" style="background-image:url(./images/bar.gif)">&nbsp;&nbsp;
		</td>
      <td width="10"><img src="./images/tab1.gif" width="10" height="33"></td>
    </tr>
    </table>
  </td>
</tr>
<tr>
  <td colspan="2" height="15"></td>
</tr>
<tr>
  <td colspan="2" height="15">
    <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="8%"><img src="./images/profil_b.gif" width="40" height="45"></td>
      <td width="92%" align="left" class="wtext">&nbsp;</td>
    </tr>
    </table>
  </td>
</tr>
<tr valign="top">
  <!--******************************************************************************************
	                                 Début du texe introductif
  *******************************************************************************************-->
  <td width="360">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="8" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="left" class="wtext">
After entering the code and password that identifies you as the site administrator, you will have access to all topics that are likely to be updated, modified, validated or managed.
		<br>
		<br></td>
	</tr>
    <tr>
      <td width="14%" height="8">&nbsp;</td>
      <td width="86%" height="8"></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    </table>
  </td>
  <!--******************************************************************************************
	                                 Fin du texe introductif
  *******************************************************************************************-->
  <td width="295">
    <br>
	<table width="98%" border="0" align="right" cellpadding="0" cellspacing="0">
	<tr>
	  <td width="7" height="7"><img src="./images/cgh.gif" width="7" height="7"></td>
	  <td bgcolor="#FFFFFF" width="99%"></td>
	  <td width="7"><img src="./images/cdh.gif" width="7" height="7"></td>
	  <td width="1"></td>
	</tr>
	<tr>
	  <td bgcolor="#FFFFFF" width="7"></td>
	  <td bgcolor="#FFFFFF">
		<table align="center" width="100%" cellpadding="0" cellspacing="0">
		<tr>
		  <td align="center" valign="top">
		    <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td colspan="2" height="10"></td>
            </tr>
            <tr valign="top" align="left">
              <td width="15" height="25"></td>
              <td><span class="titre">administrators</span> </td>
            </tr>
            <tr>
              <td colspan="2" height="2" bgcolor="#FF0000"></td>
            </tr>
            <tr valign="top" align="left">
              <td height="15"></td>
              <td class="text" style="font-size:10px">
			    <img src="./images/flnoir.gif">
				<b>Enter your account and password</b>
			  </td>
            </tr>
            <tr valign="top">
              <td height="5"></td>
              <td></td>
            </tr>
<?php
  switch ($status) {
    case 'inactif' : 
?>
            <tr valign="top">
              <td height="5"></td>
              <td class="obligatoire" style="font-size:10px">
			    <b>Your account is disabled.</b>
			  </td>
<?php 
    break;
    case 'incorrect' : 
?>
            <tr valign="top">
              <td height="5"></td>
              <td class="obligatoire" style="font-size:10px">
			    <b>User or Password incorrect.</b>
			  </td>
            </tr>
<?php 				  
  } 
?>
            <tr valign="top">
              <td width="15" height="25"></td>
              <td align="center" class="text">
              <!--******************************************************************************
				                              Début du formulaire
		      *******************************************************************************-->			  
			  <form action="" method="post" name="form1">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="12%" height="8"></td>
                </tr>
                <tr>
                  <td>
				    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                      <td width="30%" align="right" height="15">
						<label for="user" class="text" style="font-size:10px">
					      <b>User :&nbsp;</b>						</label>					  </td>
                      <td width="55%">
                          <input name="user" id="user" type="text" class="zone"  value="" style="width:137">
                        </label>                      </td>
                    </tr>
					<tr>
					  <td colspan="2" height="2"></td>
					</tr>					
                    <tr valign="top">
                      <td align="right" >
						<label for="pw" class="text" style="font-size:10px">
					      <b>Password :&nbsp;</b>						</label>					  </td>
                      <td>
					    <input name="pw" id="pw" type="password" class="zone" style="width:137"><input type="hidden" value="fr" name="lang" >					  </td>
                    </tr>
					<tr>
					  <td colspan="2" height="2"></td>
					</tr>					
                    </table>
				  </td>
                </tr>
                <tr>
                  <td height="8">&nbsp;</td>
                </tr>
                <tr>
                  <td align="right">
				    <div style="cursor:hand" onClick="javascript: verif();">
                      <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                      <tr>
                        <td width="6"><img src="./images/boutton-gauche.gif" border="0"></td>
                        <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">Login</td>
                        <td width="11"><img src="./images/boutton-droite.gif" border="0"></td>
                      </tr>
                      </table>
                    </div>                   
				  </td>
                </tr>
                </table>
              </form>
              <!--******************************************************************************
				                               Fin du formulaire				
			  *******************************************************************************-->			  
			  </td>
            </tr>
            </table>
		  </td>
		</tr>
		</table>
	  </td>
	  <td bgcolor="#FFFFFF" width="7"></td>		
	  <td bgcolor="#7A7B7B" width="1"></td>	  
	</tr>
	<tr>
	  <td height="7" width="7"><img src="./images/cbg.gif" width="7" height="7"></td>
	  <td style="background-image:url(./images/b.gif)"></td>
	  <td width="7"><img src="./images/cbd.gif" width="7" height="7"></td>
	  <td></td>
	</tr>	  
	</table>
  </td>
</tr>
<tr>
  <td colspan="2" height="15">&nbsp;</td>
</tr>
<tr align="center">
  <td colspan="2" class="text" style="color:#FFFFFF"><font color="#BCBCBC" size="1">&nbsp; </font>
    
	    </td>
</tr>
<tr>
  <td colspan="2" height="15">&nbsp;</td>
</tr>
</table>
</body>
</html>