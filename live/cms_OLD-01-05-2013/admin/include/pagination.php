<?php 
   /****************************************************************************************
                                  Classe : CAdminPagination
	Module de pagination pour partie administration
    Modifié le : 11/12/2004
	
	Pour utilser cette classe veuillez vérifier l'existnce des paramètres suivants :
	  --> $_GET ['session']
	  --> Appel intial à la fonction writeJavaScript pour générer la 
	      fonction javascript pagin_gotoPage()
	  --> S'il y a plus d'une table, il faut spécifier "default_sort"		  
   ****************************************************************************************/
   class CAdminPagination {
     var $table    ;  //---> Nom de la table à paginer
	 var $cond     ;  //---> Condition statique sur la table
	 var $page     ;  //---> Nombre d'éléments par page
	 var $total    ;  //---> Nombre d'élements dans la table
	 var $pagecount;  //---> Nombre de pages
     var $courent  ;  //---> Page courente
	 var $sort     ;  //---> Critères de sélection
	 var $sens     ;  //---> sens de la recherche
     
	 function CAdminPagination($table, $cond="", $page=8, $default_sort="", $default_sens="") {
	   $this->table   = $table;
	   $this->page    = $page;
	   $this->cond    = $cond;
       $this->courent = isset($_POST['courent']) ? $_POST['courent'] : 0;
       $this->sort 	  = isset($_POST['sort'])    ? $_POST['sort']    : ( ($default_sort!="")? $default_sort : $table.'_id' );
	    $this->sens    = ($default_sens!="")? $default_sens : 'ASC'        ;	
	   $default_sens;
       $sql           = "SELECT * FROM $table " . 
	                     ($this->cond !="" ? "WHERE $this->cond " : "") . "
						 ORDER BY $this->sort $this->sens";
       $res           = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête
	   $this->total   = @mysql_num_rows($res);
       $pagecount     = ($this->total - $this->total % $page) / $page + (0 != ($this->total % $page) ? 1 : 0);	   
	 } //Fin constructeur
	 
	 function writeJavaScript() {
	 ?>
	   <script language="javascript" type="text/javascript">
		 function pagin_gotoPage(courent, sort, sens)
		 {
		   switch(courent)
		   {
		   case  1      : document.pagination.courent.value++;
		                  break;
		   case -1      : document.pagination.courent.value--;
		                  break;
		   default      : if (courent<0)
		                  {
						    document.pagination.sort.value = sort;
							document.pagination.sens.value = sens;
		                  } else
		                    document.pagination.courent.value = courent;
		   } //Fin switch
		   document.pagination.submit();
		 } //Fin pagin_gotoPage
		 
		 function pagin_supprimer()
         {
	       choix = false;
	       for(i=0; i < document.pagination_tab.length; i++)
	       {
		     if(document.pagination_tab[i].checked == 1)
			   choix = true;
	       } //FFor
	       if(choix)
	       {
		     if(confirm("Etes vous sur de vouloir supprimer cet(ces) élément(s)"))
			   document.pagination_tab.submit();
	       }
	       else
		     alert("Vous devez cocher sur un (ou plusieurs) élément(s) à supprimer");
         } //Fin pagin_supprimer
		 
		 function pagin_inverse_selection() {
		   for(i=0; i < document.pagination_tab.length; i++)
		     document.pagination_tab[i].checked = !(document.pagination_tab[i].checked);
  	     } //Fin pagin_inverse_selection
	   </script>
	 <?php
	 } //Fin 
	 
	 // Avant d'appeler cette une fois seulement
	 function makeButtons($action) {
       //---> Extraire les élements
	   $sql  = "SELECT * FROM $this->table " .
	   	       ($this->cond !="" ? "WHERE $this->cond " : "") . "
	           ORDER BY $this->sort $this->sens";
	   
       $sql .= " LIMIT ".($this->courent * $this->page).", $this->page";
       $res  = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête	
	   
	   $nb_pages = ceil($this->total/$this->page);
       $this->writeForm();
	 ?>
		<table border="0" width="100%" align="center" cellpadding="0" cellspacing="0">
		<tr>
		  <td colspan="3" height="10" align="center" class="text">
		    <strong>Total : <?php echo $this->total?></strong>
		  </td>
		</tr>
	<?php
	   if ($this->total!=0)
	   {
	?>
		<tr>
		  <td width="17" height="16">
    <?php
	   if ($this->courent > 0)
		{
	?>
		    <a href='javascript:pagin_gotoPage(-1);'>
			  <img src="./images/reverse.gif" align="bottom" border="0">
			</a>
    <?php			
		} //Fsi
	?>					
		  </td>
		  <td width="100%" align="center" class="text">
		    Page : <?php echo $this->courent + 1?> / <?php echo $nb_pages?>
		  </td>
		  <td width="17">
	<?php
	   if ($this->courent < $nb_pages-1)
		{
	?>
		    <a href='javascript: pagin_gotoPage(+1);'>
			  <img src="./images/play.gif" align="absmiddle" border="0">
			</a>		    
    <?php			
		} //Fsi
	?>		
		  </td>				  				  
		</tr>
    <?php
	   } else 
	   {
	?>
		<tr>
		  <td width="17" height="16">
		  </td>				  				  
		</tr>	  
	<?php
	   } //Fsi
	?>
		</table>	 
	 <?php
	   return $res;		   
	 } //Fin makeButtons

	 function writeForm($form = TRUE)
	 {
	   if ($form)
	   {
	 ?>
	   <form name='pagination' id="pagination" method='post' action=''>
	 <?php
	   } //Fsi
	 ?>
         <input type='Hidden' name='courent' value = '<?php echo $this->courent ?>'>
         <input type='Hidden' name='sort'    value = '<?php echo $this->sort ?>'>
         <input type='Hidden' name='sens'    value = '<?php echo $this->sens ?>'>
	 <?php
	   if ($form)
	   {
     ?>
	   </form>
	 <?php
	   } //Fsi
	 } //Fin writeForm

	 function getTotal()
	 {
	   return $this->total;
	 } //Fin getTotal
	 
	 //--> supprimer de la base de donnees
	 function deleteElements($table, $tab)
	 {
	   $sql = "DELETE FROM $table 
	           WHERE ".$table."_id IN (".implode(", ", $tab).") ";
       $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête
	 } //Fin deleteElements
	 
	 // Constrcution d'un liens
     function makelink($newsort, $newpage)
     {
        if ($newsort == $this->sort && $newpage == $this->courent)
		  $d = ('ASC' == $this->sens) ? 'DESC' : 'ASC';
		else
		  $d = 'ASC';
	    $newsort = ('' == $newsort) ? $sort : $newsort;
        if     (0 > $newpage)				    $p = 0;
        elseif ($newpage > $this->pagecount-1)	$p = $this->pagecount-1;
        else								    $p = $newpage;
        return "javascript: pagin_gotoPage(-2, '$newsort', '$d')";
     } //Fin makelink
	 
	 function writeArrow($sort)
	 {
	   if ($sort == $this->sort)
	   {
	     if ($this->sens == "DESC")
		 {
		?>
		  <img alt="décroissant" src="images/downb.gif" border="0" align="absmiddle">
		<?php
		 } else
		 {
		?>
		  <img alt="croissant" src="images/upb.gif" border="0" align="absmiddle">
		<?php		 
		 } //Fsi
	   } //Fsi
	 } //Fi, getArrow
	 
   } //Fin CAdminPagination
?>