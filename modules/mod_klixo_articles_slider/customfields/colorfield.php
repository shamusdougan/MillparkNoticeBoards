<?php
/* ------------------------------------------------------------------------
  # mod_klixo_articles_slider  - Version 1.0.0
  # ------------------------------------------------------------------------
  # Copyright (C) 2012 Klixo. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
  # Author: JF Thier Klixo
  # Website: http://www.Klixo.nu
  ------------------------------------------------------------------------- */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.html.html');
jimport('joomla.form.formfield'); //import the necessary class definition for formfield

class JFormFieldcolorfield extends JFormField {

    protected $type = 'colorfield';

    protected function getInput() {
        $document = &JFactory::getDocument();
        $document->addScriptDeclaration("
              window.addEvent('domready', function() {
                  $(\"$this->id\").retrieve('colorPicker').addEvent('change', function(col) {
                  $('$this->id').value =col;
                 });
            });"
        );

        return '<div> <input id="' . $this->id . '" name= "' . $this->name . '" type="text" size="13" class="colorField" style="" value="' . $this->value . '" /></div>';
    }

}

?>