<?php
/* ------------------------------------------------------------------------
  # mod_klixo_articles_slider  - Version 1.0.0
  # ------------------------------------------------------------------------
  # Copyright (C) 2012 Klixo. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
  # Author: JF Thier Klixo
  # Website: http://www.Klixo.nu
  ------------------------------------------------------------------------- */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldcolorpicker extends JFormField {
	
 protected $type = 'colorpicker'; 

  protected function getLabel() {
      	  $document = &JFactory::getDocument();  
	  $path = JURI::root() ."modules/mod_klixo_articles_slider/assets/colorpicker" ;	 
	  JHTML::script('DynamicColorPicker.js','modules/mod_klixo_articles_slider/assets/colorpicker/');
	  $document->addScriptDeclaration("
              window.addEvent('domready', function() {
       //DynamicColorPicker.auto = function(spec, options)
       DynamicColorPicker.auto(\".colorField\",\"\",\"$path\");
});			
	  ");
   return ;

  }
      
  protected function getTitle()
	{
		return $this->getLabel();
	}
 
 
 
 protected function getInput(){	  
   return  "" ;
  }

}

?>