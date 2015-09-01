<?php
  $rubrique = 'index';

  include '../include/connexion.php';
  include '../include/fonctions.php';
  include './include/pagination.php';
  include './include/session_test.php';
  include './include/privilege_test.php';
  include '../include/parametres.php';
  include './switch.php';
  
  
  

  
  
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
                      "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Admin</title>
<link href="include/style_admin.css" rel="stylesheet" type="text/css" media="all">
<script language="javascript" type="text/javascript" src="../include/scripts.js"></script>

<script language="javascript" type="text/javascript">
<!--
  function open_menu(id, b)
  {
    if (document.getElementById==null)
	{
	  alert("Votre navigateur n'est pas compatible avec les nouvelles normes ...");
	  return;
	} //Fsi
	
    var node  = document.getElementById(id);
	var image = document.getElementById(id+'_icon');
	if (node == null || image==null)
	  return;
	  
	if (b == true)
	{
	  node.style.visibility = "visible";
	  node.style.display    = "block";
	  image.setAttribute("src","./images/up.gif");
	  image.setAttribute("alt","Fermer");
	} else
	{
	  node.style.visibility = "hidden";
	  node.style.display    = "none";	
	  image.setAttribute("src","./images/down.gif");
	  image.setAttribute("alt","Ouvrir");	  
	} //Fsi
  } //Fin open_menu
  
  function toggle_menu(id)
  {
 
    if (document.getElementById==null)
	{
	  alert("Votre navigateur n'est pas compatible avec les nouvelles normes ...");
	  return;
	} //Fsi
	
    var node  = document.getElementById(id);
	
	if (node == null)
	  return;

	if (node.style.visibility == "hidden")
	  open_menu(id, true);
	else
	  open_menu(id, false);
  } //Fin toggle_menu
  
  
  var preloaded_images = new Array();
  
  function preload_image(src) {
	var image = new Image();
	image.src = src;
	preloaded_images[preloaded_images.length] = image;
  }  //Fin preload_image
  
  function selectLanguage()
  {
    var node = document.getElementById("select_lang");
	if (node == null)
	{
	  alert("Veuillez installer un navigateur plus récent");
	  return;
	} //Fsi
	
	var new_lang      = node.value;
	if (new_lang      == "<?php echo $lang?>")
	{
	   alert("Vous avez sélectionner la même langue en cours");
	   return
	} //Fsi

	document.location = "./?session=<?php echo $session?>&lang="+new_lang;
    return;
  } //Fin selectLanguage
  
  preload_image("images/down.gif");
  preload_image("images/up.gif");  
-->
</script>

</head>
<body bgcolor="#8A979D">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3">
      <span style="color:#FFFFFF;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:24px;font-weight:bold">
        Administration area
      </span>
      <br />
      <span style="color:#FFFFFF;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:14px;">
        <?php echo $param_titre_site?>
      </span>
      <br/>
    </td>
  </tr>
  <tr>
    <td colspan="3" align="right" style="color:#FFFFFF;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;">
      Welcome <?php echo $admin_user_nom?>
    </td>
  </tr>
  <tr>
    <td colspan="3" height="5"></td>
  </tr>
  <tr>
    <td colspan="3" height="15">
      <table width="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="10"><img alt="" src="./images/tab2.gif" width="10" height="33" /></td>
          <td width="100%" height="31" colspan="2" align="right" valign="middle" style="background-image:url(./images/bar.gif)">
            <table width="100%"  border="0" cellpadding="0" cellspacing="0">
              <tr valign="middle">

		  <td align="right" valign="middle" >

			<img alt="" src="./images/sep-ho.gif" align="top" width="2" height="17"> 
			&nbsp; 
			<a  href="./?session=<?php echo $session?>&lang=<?php echo $lang?>" class="menuvertical">
			  Home
			</a>
			&nbsp;
			<img alt="" src="./images/sep-ho.gif" align="top" width="2" height="17">
			&nbsp;
			<a href="./?session_close=Y&session=<?php echo $session?>&lang=<?php echo $lang?>" class="menuvertical">
			 Log out
			</a>
			&nbsp;&nbsp;	  
		  </td>
		</tr>
            </table>
          </td>
          <td width="10"><img alt="" src="./images/tab1.gif" width="10" height="33"></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="3" height="15">&nbsp;
      
    </td>
  </tr>
  <tr valign="top">
    <td width="190">
    <!--******************************************************************************************
	                                 Début du menu verticale
    *******************************************************************************************-->
      <table width="189" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2" height="7" width="189"><img alt="" src="./images/haut.gif" width="189" height="7"></td>
        </tr>
        <tr>
          <td height="5" width="189" bgcolor="#C6CFD0"></td>
          <td bgcolor="#7A7B7B" width="1"></td>
        </tr>	       

        <tr class="2">
          <td height="2" style="background-image:url(./images/sep.gif)"></td>
          <td bgcolor="#7A7B7B" width="1"></td>
        </tr>


    
    <?php
    $requester = getprivileges('requester', $user_id );
    $document   = getprivileges('document', $user_id );

	if($requester=='Y'){
	?>

        <tr>
          <td  bgcolor="#EAEEEE" height="25" valign="middle" onmouseover="this.style.background='#DDEEFF'" onmouseout="this.style.background='#EAEEEE'">
            &nbsp;&nbsp;
            <a href="./?<?php echo $action?>=requester&session=<?php echo $session?>&lang=<?php echo $lang?>" class="menutext">
              REQUESTS            </a>          </td>	  
          <td bgcolor="#7A7B7B"></td>
        </tr>

        <tr class="2">
          <td height="2" style="background-image:url(./images/sep.gif)"></td>
          <td bgcolor="#7A7B7B" width="1"></td>
        </tr>

        <tr>
          <td  bgcolor="#EAEEEE" height="25" valign="middle" onmouseover="this.style.background='#DDEEFF'" onmouseout="this.style.background='#EAEEEE'">
            &nbsp;&nbsp;
            <a href="./?<?php echo $action?>=site&session=<?php echo $session?>&lang=<?php echo $lang?>" class="menutext">
              SITES</a>          </td>	  
          <td bgcolor="#7A7B7B"></td>
        </tr>

       
        <tr class="2">
          <td height="2" style="background-image:url(./images/sep.gif)"></td>
          <td bgcolor="#7A7B7B" width="1"></td>
        </tr>
	<?PHP
    }
    if($document=='Y'){
 
    ?>
        
        <tr>
          <td  bgcolor="#EAEEEE" height="25" valign="middle" onmouseover="this.style.background='#DDEEFF'" onmouseout="this.style.background='#EAEEEE'">
            &nbsp;&nbsp;
            <a href="./?<?php echo $action?>=service&session=<?php echo $session?>&lang=<?php echo $lang?>" class="menutext">
              SERVICES            </a>          </td>	  
          <td bgcolor="#7A7B7B"></td>
        </tr>

       
        <tr class="2">
          <td height="2" style="background-image:url(./images/sep.gif)"></td>
          <td bgcolor="#7A7B7B" width="1"></td>
        </tr>
        
        
        <tr>
          <td  bgcolor="#EAEEEE" height="25" valign="middle" onmouseover="this.style.background='#DDEEFF'" onmouseout="this.style.background='#EAEEEE'">
            &nbsp;&nbsp;
            <a href="./?<?php echo $action?>=faq_categorie&session=<?php echo $session?>&lang=<?php echo $lang?>" class="menutext">
              FAQ            </a>          </td>	  
          <td bgcolor="#7A7B7B"></td>
        </tr>


        <tr class="2">
          <td height="2" style="background-image:url(./images/sep.gif)"></td>
          <td bgcolor="#7A7B7B" width="1"></td>
        </tr>
        <tr>
          <td bgcolor="#EAEEEE" height="25" valign="middle" onmouseover="this.style.background='#DDEEFF'" onmouseout="this.style.background='#EAEEEE'">
            &nbsp;&nbsp;
            <a href="./?<?php echo $action?>=document&session=<?php echo $session?>&lang=<?php echo $lang?>" class="menutext">
              DOCUMENTS            </a>          </td>
          <td bgcolor="#7A7B7B"></td>
        </tr>	
 
        <tr class="2">
          <td height="2" style="background-image:url(./images/sep.gif)"></td>
          <td bgcolor="#7A7B7B" width="1"></td>
        </tr>        
        
        <tr>
          <td bgcolor="#EAEEEE" height="25" valign="middle" onmouseover="this.style.background='#DDEEFF'" onmouseout="this.style.background='#EAEEEE'">
            &nbsp;&nbsp;
            <a href="./?<?php echo $action?>=lien&session=<?php echo $session?>&lang=<?php echo $lang?>" class="menutext">
              LINKS            </a>          </td>
          <td bgcolor="#7A7B7B"></td>
        </tr>
        <tr class="2">
          <td height="2" style="background-image:url(./images/sep.gif)"></td>
          <td bgcolor="#7A7B7B" width="1"></td>
        </tr>
        
        <tr>
          <td bgcolor="#EAEEEE" height="25" valign="middle" onmouseover="this.style.background='#DDEEFF'" onmouseout="this.style.background='#EAEEEE'">
            &nbsp;&nbsp;
            <a href="./?<?php echo $action?>=text&session=<?php echo $session?>&lang=<?php echo $lang?>" class="menutext">
              Text            </a>          </td>
          <td bgcolor="#7A7B7B"></td>
        </tr>
        <tr class="2">
          <td height="2" style="background-image:url(./images/sep.gif)"></td>
          <td bgcolor="#7A7B7B" width="1"></td>
        </tr>        
<?php 

	}
  if ($admin_user_pouvoir == 'admin') {
?>
        
       <tr>
          <td width="189" bgcolor="#EAEEEE" height="25" valign="middle" onmouseover="this.style.background='#DDEEFF'" onmouseout="this.style.background='#EAEEEE'"> 
            &nbsp;&nbsp;
            <a href="./?<?php  echo $action?>=admin_user&session=<?php echo $session?>&lang=<?php echo $lang?>" class="menutext">
              administrators            </a>          </td>
          <td bgcolor="#7A7B7B"></td>
        </tr>
        <tr class="2">
          <td height="2" style="background-image:url(./images/sep.gif)"></td>
          <td bgcolor="#7A7B7B" width="1"></td>
        </tr> 
        <tr>
          <td width="189" bgcolor="#EAEEEE" height="25" valign="middle" onmouseover="this.style.background='#DDEEFF'" onmouseout="this.style.background='#EAEEEE'"> 
            &nbsp;&nbsp;
            <a href="javascript:popup('changer_pw.php?session=<?php echo $session?>',475,250)" class="menutext">
              Change your password           </a>          </td>
          <td bgcolor="#7A7B7B"></td>
        </tr>
        <tr class="2">
          <td height="2" style="background-image:url(./images/sep.gif)"></td>
          <td bgcolor="#7A7B7B" width="1"></td>
        </tr>
<?php
  }
?>
        <tr>
          <td width="189" bgcolor="#F5F7F7" height="100"></td>
          <td bgcolor="#7A7B7B"></td>
        </tr>
        <tr>
          <td colspan="2"><img alt="" src="./images/bas.gif" height="7" width="189" /></td>
        </tr>				
      </table>	
    <!--******************************************************************************************
	                                 Fin du menu verticale
    *******************************************************************************************-->	
    </td>
    <td><img alt="" src="images/shim.gif" width="20" height="20" /></td>
    <td width="90%">
    <!--******************************************************************************************
	                                   Début du contenu
    *******************************************************************************************-->	  
      <table width="98%" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr>
          <td width="7" height="7"><img alt="" src="./images/cgh.gif" width="7" height="7" /></td>
          <td bgcolor="#FFFFFF" width="99%"></td>
          <td width="7"><img alt="" src="./images/cdh.gif" width="7" height="7" /></td>
          <td width="1"></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF" width="7"></td>
          <td bgcolor="#FFFFFF">
            <table align="center" width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td valign="top">
                  <?php include $include_filename; ?>
                </td>
              </tr>
            </table>
          </td>
          <td bgcolor="#FFFFFF" width="7"></td>		
          <td bgcolor="#7A7B7B" width="1"></td>	  
        </tr>
        <tr>
          <td height="7" width="7"><img alt="" src="./images/cbg.gif" width="7" height="7" /></td>
          <td style="background-image:url(./images/b.gif)"></td>
          <td width="7"><img alt="" src="./images/cbd.gif" width="7" height="7" /></td>
          <td></td>
        </tr>	  
      </table>
    <!--******************************************************************************************
	                                   Fin du contenu
    *******************************************************************************************-->	
    </td>
  </tr>
  <tr>
    <td height="15" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="right" class="text" style="color:#FFFFFF">
      <?php echo pied_page()?>
    </td>
  </tr>
  <tr>
    <td height="15" colspan="3">&nbsp;</td>
  </tr>
</table>
</body>
</html>