/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
/*
CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	 config.uiColor = '#0e385f';
};


 */
CKEDITOR.editorConfig = function( config )
{	config.uiColor = '#CCC';
	CKEDITOR.config.toolbar_Custom =
	[
		['Source', 'Bold', 'Italic', 'Underline', 'Subscript', 'Superscript', 'PasteText', 'NumberedList', 'BulletedList', ['Font'], 'FontSize',  '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'BulletedList', '-', 'Link', 'Unlink', '-',   'TextColor', 'BGColor', '-', 'HorizontalRule']
	];	
	
	config.toolbar = 'Custom';
	config.height="200px";
	config.width="700px";	
	config.forcePasteAsPlainText = true;	
};

CKEDITOR.config.font_names =
     'Georgia/Georgia, "Times New Roman", Times, serif;' +
	 'Arial/Arial, Helvetica, sans-serif;' +
	 'Times/"Times New Roman", Times, serif;' +	 
	 'Verdana/Verdana, Geneva, sans-serif;';


