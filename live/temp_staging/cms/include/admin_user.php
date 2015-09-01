<?php
/****************************************************************************
                      Modifier les privilèges d'un utilsateurs
****************************************************************************/
function privilege_modifier($user_id, $select, $update, $insert, $delete )
{
  if ($user_id==0)
    return;
	
  //---> Obtenir la liste de toutes les rubriques disponibles
  $rubrique_id = array();
  $sql         = "SELECT rubrique_id
                  FROM rubrique_site";
  $res         = executer($sql,__FILE__,__LINE__);
  while ($row=mysql_fetch_array($res))
    $rubrique_id[] = $row['rubrique_id'];
  //---> Supprimer tous les privilèges courants
  $sql = "DELETE FROM privilege
          WHERE  user_id        = $user_id";
  executer($sql,__FILE__,__LINE__);
  
  //---> ReCréer tous les privilèges avec aucun droit
  for ($i=0; $i<count($rubrique_id); $i++)
  {
    $sql = "INSERT INTO privilege
	        SET    user_id          = $user_id,
			       rubrique_id      = ".$rubrique_id[$i].",
			       privilege_select =   'N'               ,
				   privilege_update =   'N'               ,
				   privilege_insert =   'N'               ,
				   privilege_delete =   'N'               ";
	executer($sql,__FILE__,__LINE__);
  } //FFor
  
  //---> Mettre à jour les privilèges
  if (count($select)>0)
  {
    $str = implode(", ", $select);
	$sql = "UPDATE privilege
            SET    privilege_select = 'Y'
		    WHERE  user_id          = $user_id AND
		           rubrique_id IN ($str)";
	executer($sql,__FILE__,__LINE__);
  } //Fsi
  if (count($update)>0)
  {
    $str = implode(", ", $update);
    $sql = "UPDATE privilege
            SET    privilege_update = 'Y'
		    WHERE  user_id          = $user_id AND
		           rubrique_id IN ($str)";
	executer($sql,__FILE__,__LINE__);
  } //Fsi  
  if (count($insert)>0)
  {
    $str = implode(", ", $insert);
    $sql = "UPDATE privilege
            SET    privilege_insert = 'Y'
		    WHERE  user_id          = $user_id AND
		           rubrique_id IN ($str)";
	executer($sql,__FILE__,__LINE__);
  } //Fsi
  if (count($delete)>0)
  {
    $str = implode(", ", $delete);
    $sql = "UPDATE privilege
            SET    privilege_delete = 'Y'
		    WHERE  user_id          = $user_id AND
		           rubrique_id IN ($str)";
	executer($sql,__FILE__,__LINE__);
  } //Fsi      
} //Fin 
/****************************************************************************
                      Supprime une liste d'utilisateurs
****************************************************************************/
function admin_user_supprimer($tab) {
  if (count($tab)==0) 
    return;
	
  $str = implode(", ", $tab);
  
  //---> Supprimer les privilèges de ces utilisateurs
  $sql = "DELETE FROM privilege
          WHERE user_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
  		  
  //---> Suppresion effective de la base de données
  $sql = "DELETE FROM admin_user
          WHERE admin_user_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
} //Fin admin_user_supprimer
/**************************************************************************************************
                       Modifier la propriété actif d'un ensemble d'utilisateurs
**************************************************************************************************/
function admin_user_actif($tab, $tab_id)
{
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE admin_user
          SET admin_user_actif = 'N'
          WHERE admin_user_id IN ($id)";
  $res = executer($sql,__FILE__,__LINE__); 
  if (count($tab)>0)
  {
    $str = implode(", ", $tab);
    $sql = "UPDATE admin_user
            SET admin_user_actif = 'Y'
            WHERE admin_user_id IN ($str)";
    $res = executer($sql,__FILE__,__LINE__);     
  } //Fsi			
} //Fin admin_user_actif
/**************************************************************************************************
                             Afficher les privilèges d'un utilisateur
  Attention ! appeler cette méthode au plus une fois
**************************************************************************************************/
function afficher_privilege($user_id, $user_form)
{
  if($user_id != NULL) {
    $sql = "Select   *
            FROM     privilege P,rubrique_site R
            WHERE    user_id = $user_id AND R.rubrique_id = P.rubrique_id 
            ORDER BY rubrique_nom
           ";
  } else {
    $sql = "Select   * 
            FROM     rubrique_site 
            ORDER BY rubrique_nom
           ";
  }
  $res = executer($sql,__FILE__,__LINE__);
  $num_rub = @mysql_num_rows($res); 
  $count = 0;
?>
<script language="javascript" type="text/javascript">
<!--
  function privilege_selectionner_tout()
  {
	<?php
		for ($i = 1; $i <= $num_rub ; $i++)
			echo "document.$user_form.select".$i.".checked = !document.$user_form.select".$i.".checked;\r\n";
	?>
  } //Fin privilege_tout_selectionner

  function privilege_inserer_tout()
  {
	<?php
		for ($i = 1; $i <= $num_rub ; $i++)
			echo "document.$user_form.insert".$i.".checked = !document.$user_form.insert".$i.".checked;\r\n";
	?>
  } // privilege_inserer_tout

  function privilege_supprimer_tout()
  {
	<?php
		for ($i = 1; $i <= $num_rub; $i++)
			echo "document.$user_form.delete".$i.".checked = !document.$user_form.delete".$i.".checked;\r\n";
	?>
  } //Fin privilege_supprimer_tout
  
  function privilege_update_tout()
  {
	<?php
		for ($i = 1; $i <= $num_rub; $i++)
			echo "document.$user_form.update".$i.".checked = !document.$user_form.update".$i.".checked;\r\n";
	?>
  } //Fin privilege_update_tout
-->
</script>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-color:#A0B0B6">
<tr>
  <td>
    <table width="100%" align="center" border="0" cellpadding="2" cellspacing="1" class="text">
    <tr align="center" class="tcat"> 
      <td>Rubrique</td>
      <td>Select</td>
	  <td>Insert</td>
	  <td>Delete</td>
	  <td>Update</td>
    </tr>
    <?php
      while ($row = mysql_fetch_array($res))
      {
        $class            = ($count%2==0)? "row1" : "row2";
	    $bgColor          = ($count%2==0)? "#EFEFEF" : "#DEE3E7";
	    $rubrique_nom     = affichage($row['rubrique_nom']);
	    $rubrique_id      = $row['rubrique_id'];
	    $privilege_select = isset($row['privilege_select'])  ?  
	                        ( ($row['privilege_select']=='Y')? "checked" : "" ) : "";
	    $privilege_insert = isset($row['privilege_insert'])  ?
	                        ( ($row['privilege_insert']=='Y')? "checked" : "" ) : "";
	    $privilege_delete = isset($row['privilege_delete'])  ?
	                        ( ($row['privilege_delete']=='Y')? "checked" : "" ) : "";
	    $privilege_update = isset($row['privilege_update'])?
	                        ( ($row['privilege_update']=='Y')? "checked" : "" ) : "";
	    $count++;
    ?>
    <tr bgcolor="<?php echo $bgColor?>" class="text" align="center" 
	                            onMouseOver="javascript: this.bgColor ='#E0EFFC';" 
	                            onMouseOut ="javascript: this.bgColor ='<?php echo $bgColor?>';" > 
      <td><?php echo $rubrique_nom?></td>
	  <td>
	    <input type="checkbox" id="select<?php echo $count?>" name="privilege_select[]" value="<?php echo $rubrique_id?>" <?php echo $privilege_select?> >
	  </td>
	  <td>
	    <input type="checkbox" id="insert<?php echo $count?>" name="privilege_insert[]" value="<?php echo $rubrique_id?>" <?php echo $privilege_insert?> >
	  </td>
	  <td align="center">
	    <input type="checkbox" id="delete<?php echo $count?>" name="privilege_delete[]" value="<?php echo $rubrique_id?>" <?php echo $privilege_delete?> >
	  </td>
	  <td align="center">
	    <input type="checkbox" id="update<?php echo $count?>" name="privilege_update[]" value="<?php echo $rubrique_id?>" <?php echo $privilege_update?> >
      </td>
    </tr>
    <?php 
      } //FTQ
    ?>
    <tr align="center" valign="middle" class="tcat"> 
      <td>Reverse</td>
	  <td>
	    <a href="javascript: privilege_selectionner_tout();" class="supp">
		  <img src="./images/ok.gif" border="0" align="absmiddle">
		</a>
	  </td>
	  <td>
	    <a href="javascript: privilege_inserer_tout();" class="supp">
		  <img src="./images/ok.gif" border="0" align="absmiddle">
		</a>
	  </td>
	  <td>
	    <a href="javascript: privilege_supprimer_tout();" class="supp">
		  <img src="./images/ok.gif" border="0" align="absmiddle">
		</a>
	  </td>
	  <td>
	    <a href="javascript: privilege_update_tout();" class="supp">
		  <img src="./images/ok.gif" border="0" align="absmiddle">
		</a>
	  </td>	  	  	  
    </tr>
	</table>
  </td>
</tr>
</table>
<?php
  } //Fin afficher_privilege
?>