  var delete_row_color = "#F4B9BF";
  
  /***************************************************************************************************
          V�rifie la va&lidit� d'un email 
  ***************************************************************************************************/
  function isValidEmail(adresse)
  {
    var email   = true;
    var place   = adresse.indexOf("@",1);
	var point   = adresse.indexOf(".");

    if ((place > -1)&&(adresse.length >2)&&(point > place+2)&&(adresse.length > point+1))
	  return true;
	else
	  return false;
  } //Fin isValidEmail
  
  function isValidInt(str, default_value)
  {
	str += "";
	if (str == "") { alert("salem"); return default_value; }
    var expr = new RegExp('^[0-9]+$','g');
    if (str.search(expr))       return  default_value;
    var i    = parseInt(str);
	if(isNaN(i))                return default_value;
	return i;
  } //Fin isValidInt
  
  function isValidFloat(str, default_value)
  {
    str += "";
    if (str == "")              return default_value;
	var expr = new RegExp('^[0-9]+(\.[0-9]+)?$','g');
    if (str.search(expr) == -1) return default_value;
	var i    = parseFloat(str);
	if(isNaN(i))                return default_value;
	return i;
  } //Fin isValidFloat
  
  /***************************************************************************************************
           Affiche une fen�tre popup sur l'�cran � la position x, y et avec un scroll ou non 
  ***************************************************************************************************/
  function popup_scroll(file, win_w, win_h, scroll1,  xOffset, yOffset)
  {
    if ( true)
	  window.open(file,'', 'status=no,scrollbars=yes,toolbar=no,width='+win_w+',height='+win_h+',screenX='+xOffset+',screenY='+yOffset+',top='+yOffset+',left='+xOffset+'');
	else
      window.open(file,'', 'status=no,scrollbars=no,toolbar=no,width='+win_w+',height='+win_h+',screenX='+xOffset+',screenY='+yOffset+',top='+yOffset+',left='+xOffset+'');
  } //Fin popup_scroll
  
  /***************************************************************************************************
                           Affiche une fen�tre popup centr�e sur l'�cran
  ***************************************************************************************************/
  function popup(file,win_w,win_h)
  {
    //--> R�solution de l'�cran
    if (document.all)
	  var xMax = screen.width, yMax = screen.height;
    else
	  if (document.layers)
	    var xMax = window.outerWidth, yMax = window.outerHeight;
	  else
	    var xMax = 640, yMax=480;

    //---> Position par rapport � l'�cran
    var xOffset = (xMax - win_w)/2, yOffset = (yMax - win_h)/2;
  
    //---> Ouverture de la fen�tre
	popup_scroll(file, win_w, win_h, false,  xOffset, yOffset);
  } //Fin popup
  
  /****************************************************************************************************
                      Rafraichier la fen�tre parent pour un popup
  ****************************************************************************************************/
  function rafraichir_parent()
  {
    if (self.opener != null)
    {
      //---> Si c'est une pagination il faut garder la page en cours
	  if (self.opener.document.pagination != null)
	    self.opener.document.pagination.submit();
	  else
	    if (self.opener.document.location.reload != null)
		  self.opener.document.location.reload();
		else
	      self.opener.document.location.href = self.opener.document.location.href;
    } //Fsi
  } //Fin rafra�chir_parent
  
  /****************************************************************************************************
                          Fermer la fen�tre popup et rafraichit le parent
  ****************************************************************************************************/
  function fermer_popup() {
    self.close();
	rafraichir_parent();
  } //Fin fermer_popup
  
  /****************************************************************************************************
                                 D�finir le pointeur de souris
  ****************************************************************************************************/
  function changerCurseur (id, cursor)
  {
    //---> V�rifier la validit� du param�tre cursor
	switch (cursor)
	{
	case "auto"      :
    case "crosshair" :
	case "default"   :
	case "hand"      :
	case "move"      :
	case "e-resize"  :
	case "ne-resize" :
	case "nw-resize" :
	case "n-resize"  :
	case "se-resize" :
	case "sw-resize" :
	case "s-resize"  :
	case "w-resize"  :
	case "text"      :
	case "wait"      :
	case "help"      : break ; //---> OK 
	default          : return;
	} //Fin switch
	
	if (document.getElementById)
	{
      var obj = document.getElementById(id);
	  if (obj !=null)
	  {
	    obj.style.cursor = cursor;
	  } //Fsi
	} //Fsi
  } //Fin changerCurseur
  
  /****************************************************************************************************
                                 V�rifie le nom du fichier � t�l�charger dans le site
  ****************************************************************************************************/
  function verif_upload_filename(input)
  {
    var filename = input.value;
	if (filename == "")
	  return;
	var tab = filename.split("/");

    if (tab==null || tab.length == 0)
	{
	  alert(1);
	  return;
	} 
	filename = tab[tab.length-1];

    var tab = filename.split("\\");
    if (tab==null || tab.length == 0)
	{
	  alert(2);
	  return;
	} 
    filename = tab[tab.length-1];
    
	var expr = new RegExp('[^a-zA-Z0-9._]');
    var r    = filename.search(expr);
	if (r != -1)
	{
	  alert('Attention ! ' + filename +' comporte des caract�res non alphanum�riques\nVous devriez le renommez ou en choisir un autre.');
	} //Fsi
  } //Fin verif_upload_filename
  
  /****************************************************************************************************
                                  D�finir l'�v�nement onFocus d'un champ de texte
  ****************************************************************************************************/
  function doFocus(input)
  {
   
	if (input.value == input.defaultValue)
      input.value = '';
  } //Fin doFocus
  
  /****************************************************************************************************
                                  D�finir l'�v�nement onBlur d'un champ de texte
  ****************************************************************************************************/
  function doBlur(input)
  {
    if (input.value == '')
      input.value = input.defaultValue;
  } //Fin doBlur
  
  /****************************************************************************************************
       Change la couleur d'arri�re plan d'une ligne si la case cocher supression n'est pas coch�e
  ****************************************************************************************************/
  function hightlight_row(node)
  {
    var color = "#DDEEFF";
	
	if (document.getElementById==null)
	  return;  //---> Ne supporte pas DOM

    if (node==null) 
	  return;  //---> Param�tre invalide
	
	var id       = node.id;
	var checkbox = document.getElementById('supprimer' + id);
	
	if (checkbox == null)
	{ //---> La case � cocher n'exsite pas
	  node.style.background = color;
	  return;
	} //Fsi
	
    if (checkbox.tagName.toLowerCase() != "input")
	{ //---> Ce n'est pas une case � cocher
	  node.style.background = color;
	  return;
	} //Fsi
	
	if (checkbox.checked == false)
	{ //---> La case n'est pas coch�e
	  node.style.background = color;
	  return;	  
	} //Fsi
	  
	node.style.background = delete_row_color;
  } //Fin hightlight_row
  
  /****************************************************************************************************
                                  Change la couleur d'arri�re plan d'une ligne
  ****************************************************************************************************/
  function restore_row(node, color)
  {
    if (document.getElementById==null)
	  return;  //---> Ne supporte pas DOM

    if (node==null) 
	  return;  //---> Param�tre invalide
	
	var id       = node.id;
	var checkbox = document.getElementById('supprimer' + id);
	
	if (checkbox == null)
	{ //---> La case � cocher n'exsite pas
	  node.style.background = color;
	  return;
	} //Fsi
	
    if (checkbox.tagName.toLowerCase() != "input")
	{ //---> Ce n'est pas une case � cocher
	  node.style.background = color;
	  return;
	} //Fsi
	
	if (checkbox.checked == false)
	{ //---> La case n'est pas coch�e
	  node.style.background = color;
	  return;	  
	} //Fsi
	  
	node.style.background = delete_row_color;    
  } //Fin restore_row
  
  function search_array(tab, v)
  {
	for (var i=0; i<tab.length; i++)
	{
	  if (v == tab[i])
	    return true;
	} //Ffor

    return false;
  } //Fin search_array