<?php
  $rubrique = 'accueil';
  
  include './include/session_test.php';
  include './include/privilege_test.php';
  include '../include/parametres.php';
  
  /**************************************************************************************************
						 Partie avec accès à la base de données " principal "
  **************************************************************************************************/
  connect(); 
?>											  
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"> 
  <tr valign="top"> 
    <td colspan="2" height="10"></td> 
  </tr> 
  <tr valign="top"> 
    <td width="15" height="25"><img src="images/shim.gif" width="15" height="1"></td> 
    <td> <table width="100%"  border="0" cellspacing="0" cellpadding="0"> 
        <tr> 
          <td width="98%"><span class="titre">Home </span></td> 
          <td width="2%"></td> 
        </tr> 
      </table> 
      </td> 
  </tr>
  <tr> 
    <td colspan="2" height="2" bgcolor="#FF0000"></td> 
  </tr>
<?php
if($select == 'Y')
{
?>
  <tr valign="top"> 
    <td height="25"></td> 
    <td class="text"><img src="./images/flnoir.gif"> Application Overview </td> 
  </tr> 
  <tr valign="top"> 
    <td height="10"></td> 
    <td></td> 
  </tr>
  <tr valign="top">
    <td height="25"></td>
    <td class="text"> The administration function of the site makes it dynamic <br>
        <br>
 After entering the code and password that identifies you as the site administrator, you will have access to all topics that are likely to be updated, modified, validated or managed.
        <p>&nbsp;</p>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </td>
  </tr>
<?php
}
else
{
?>
<tr>
  <td height="15"></td>
    <td align="center" class="texte"></td>
</tr>
<tr>
  <td height="15"></td>
    <td align="center" class="texte"><span id="result_box" lang="en" xml:lang="en">You do not have the necessary rights to perform this operation.</span></td>
</tr>
<?php
}
?>
  <tr> 
    <td height="15"></td> 
    <td></td> 
  </tr> 
</table> 