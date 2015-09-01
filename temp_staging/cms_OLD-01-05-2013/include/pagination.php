<?php 
   /****************************************************************************************
                                  Classe : CPagination
	Module de pagination pour partie client
    Modifié le : 21/12/2004
	
	Pour utiliser cette classe veuillez vérifier l'existnce des paramètres suivants :
	  --> Appel intial à la fonction writeJavaScript pour générer la 
	      fonction javascript pagin_gotoPage()
       --> S'il y a plus d'une table, il faut spécifier "default_sort"		  
   ****************************************************************************************/
   class CPagination {
     var $table    ;  //---> Nom de la table à paginer
	 var $cond     ;  //---> Condition statique sur la table
	 var $page     ;  //---> Nombre d'éléments par page
	 var $total    ;  //---> Nombre d'élements dans la table
	 var $pagecount;  //---> Nombre de pages
     var $courent  ;  //---> Page courente
	 var $sort     ;  //---> Critères de sélection
	 var $sens     ;  //---> sens de la recherche
     
	 function CPagination($table, $cond="", $page=10, $default_sort="", $default_sens="") {
	   $default_sort    = ($default_sort=="") ? $table.'_id' : $default_sort;
	   $default_sens    = ($default_sens=="") ? 'ASC'        : $default_sens;
	   $this->table     = $table;
	   $this->page      = $page;
	   $this->cond      = $cond;
       $this->courent   = isset($_POST['courent']) ? $_POST['courent'] : 0;
       $this->sort 	    = isset($_POST['sort'])    ? $_POST['sort']    : $default_sort;	
	   $this->sens      = isset($_POST['sens'])    ? $_POST['sens']    : $default_sens;	
       $sql             = "SELECT * FROM $table " . 
	                       ($this->cond !="" ? "WHERE $this->cond " : "") . "
						   ORDER BY $this->sort $this->sens";
       $res             = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête
	   $this->total     = @mysql_num_rows($res);
       $this->pagecount = ($this->total - $this->total % $page) / $page + (0 != ($this->total % $page) ? 1 : 0);	   
	 } //Fin constructeur
	 
	 // Veuillez appeler cette méthode une seule fois seulement
	 function writeJavaScript() {
	 ?>
	   <script language="javascript" type="text/javascript">
		 function pagin_gotoPage(courent)
		 {
		   if (courent>=0 && courent< <?php echo $this->pagecount?>)
		   {
		     document.pagination.courent.value = courent; 
		   } //Fsi
		   document.pagination.submit();
		 } //Fin pagin_gotoPage
	   </script>
	 <?php
	 } //Fin 

	 function writeJavaScript2() {
	 ?>
	   <script language="javascript" type="text/javascript">
		 function pagin_gotoURL(url, courent, sortColumn, sens)
		 {
		   document.pagination.action        = url;
		   document.pagination.courent.value = courent;
		   document.pagination.sort.value    = sortColumn;
		   document.pagination.sens.value    = sens;
		   document.pagination.submit();
		 } //Fin pagin_gotoURL 
	   </script>
	 <?php
	 } //Fin 	 
	 
	 function writeForm($courent, $sort, $sens, $url="") {
	 ?>
      <form name='pagination' method='post' action='<?php echo $url?>'>
        <input type='Hidden' name='courent' value = '<?php echo $courent?>' />
        <input type='Hidden' name='sort' value = '<?php echo $sort?>' />
        <input type='Hidden' name='sens' value = '<?php echo $sens?>' />
      </form>
	 <?php
	 } //Fin writeForm
	 	 
	 function selectRows($action)
	 {
       //---> Extraire les élements
	   $sql  = "SELECT * FROM $this->table " .
	   	       ($this->cond !="" ? "WHERE $this->cond " : "") . "
	           ORDER BY $this->sort $this->sens";
	   
       $sql .= " LIMIT ".($this->courent * $this->page).", $this->page";
       $res  = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête
	   return $res;
	 } //Fin select_Rows

	 // Veuiller appeler cette méthode une fois seulement
	 function makeButtons($action, $style_lien="", $style_courent="", $sep="  ", $img="", $url="") {
       if ($this->pagecount<=1)
         return;

	   //---> Affichage du formulaire
       $this->writeForm($this->courent, $this->sort, $this->sens, $url);
	   
	   if ($this->pagecount > 1)
       {
?>
<table width="205" border="0" cellpadding="0" cellspacing="0">
  <tr>
<?php
		     if ($img!="")
			 {
?>
    <td width="3%" align="left"><img alt="" src="<?php echo $img?>" width="13" height="11"></td>
<?php
		     } //Fsi
?>
    <td>
      <div class="pagination">
        <ul>
        <?php
		if($this->courent != 0){
		?>
        <li class="nextpage"><a <?php echo 'href=\'javascript: pagin_gotoPage('.($this->courent-1).')\''; ?>>Pr&eacute;c&eacute;dent</a></li>
        <?php
		}else{
		?>
        <li class="disablepage">Pr&eacute;c&eacute;dent</li>
        <?php
		}
		?>
<?php
	     for ($i = 0; $i < $this->pagecount; $i++)
		 {
		   if ($i != 0)
		     echo " $sep \n";
	         if ($i == $this->courent)
		     {
		       echo '          <li class='.$style_courent.'>'.($i+1).'</li>';
		     }
		     else
		     {
		       echo '          <li><a href=\'javascript: pagin_gotoPage('.$i.')\'>'.($i+1).'</a></li>';
		     }
	     }
?>	   
         <?php
		 
		 if(($this->courent+1) <= ($this->pagecount-1)){
		 ?>
         <li class="nextpage"><a <?php echo 'href=\'javascript: pagin_gotoPage('.($this->courent+1).')\''; ?>>Suivant</a></li>
         <?php
		 }else{
		 ?>
         <li class="disablepage">Suivant</li>
         <?php
		 }
		 ?>
        </ul>
      </div>
    </td>
  </tr>
</table>	     
     <?php
       } //Fsi
	   
	 } //Fin makeButtons
	 
	 function getTotal()
	 {
	   return $this->total;
	 } //Fin getTotal

	 /**
	  *  Le champ index désigne le critère de comparaison entre les différents enregistrements
	  *  par défaut il est vide ===> La clé primaire $this->table."_id"
	  *  Si vous faites une jointure sur la table, veuillez spécifier le champ $index
	  */
	 function getPageOfRecord($row, $index="")
	 {
	   $index = ($index=="")? $this->table."_id" : $index;
	   
	   //---> Etape 1 : Calculer le nombre d'enregistrements à partir de la première page
	   //--->        ( qui ne sont pas de rang égal à celui ci )
	   $op  = ($this->sens == "DESC")? ">" : "<";
	   $sql = "SELECT count(*)
	           FROM   $this->table         
			   WHERE  $this->sort $op '". $row[$this->sort] ."' ".
	   	              ($this->cond !="" ? "AND $this->cond " : "") . "
	           ORDER BY $this->sort $this->sens";
	   $res = executer($sql, __FILE__, __LINE__);
	   $nb  = mysql_result($res, 0, 0);
	   mysql_free_result($res);

	   //---> Etape 2 : Calculer le nombre d'enregistrements à partir de la première page
	   //--->        ( qui sont de même rang )
	   $sql = "SELECT *
	           FROM   $this->table         
			   WHERE  $this->sort = '". $row[$this->sort] ."' ".
	   	              ($this->cond !="" ? "AND $this->cond " : "") . "
	           ORDER BY $this->sort $this->sens";
	   $res = mysql_query($sql);
	   while ($row2 = mysql_fetch_array($res))
	   {
		 if ($row2[$index] == $row[$index] )
		   break;
		 $nb++;  
	   } //FTQ
	   mysql_free_result($res);
	   
	   $nb  = floor ( $nb / $this->page );
	   return $nb;
	 } //Fin getPageOfRecord
	 
   } //Fin CPagination
?>