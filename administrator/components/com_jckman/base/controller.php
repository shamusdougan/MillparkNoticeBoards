<?php
/**
 * @version		$Id: controller.php 9820 2008-01-03 00:52:19Z eddieajau $
 * @package		Joomla
 * @subpackage	Config
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.controller' );
jckimport('event.observable.editor');

/**
 * Plugins Component Controller
 *
 * @package		Joomla
 * @subpackage	Plugins
 * @since 1.5
 */ 
class JCKController extends JController
{
	/**
	 * Custom Constructor
	 */
	 
	private   $editor_obervable;
	protected  $event_args;
	 
	public function __construct( $default = array())
	{
		parent::__construct( $default );
		
		$this->_event_args = null;
		
		$eventListenerFile = JPATH_COMPONENT .DS . 'event' . DS . $this->getName() . '.php';
		
		
		jimport('joomla.filesystem.file');
						
		if(JFile::exists($eventListenerFile))
		{
			require_once($eventListenerFile);			
			$this->editor_obervable = new JCKEditorObservable($this->getName());
		
				
        }
		else
		{
			JError::raiseWarning(100,'No Event listener found for '. $this->getName() .' controller'); 
		}  
		
		//load style sheet
		$document = JFactory::getDocument();
		$document->addStyleSheet( JCK_COMPONENT . '/css/header.css', 'text/css' );
		
		
	}
	
	public function execute( $task )
	{
	
		parent::execute( $task );
		
		//if error just return
		if($this->getErrors())
			return;
		//fire event to update editor
		$this->updateEditor($this->getTask(),$this->event_args);
	
	}
	
	private function updateEditor($event,$args = array())
	{
		
		if(isset($this->editor_obervable))
		{
			$this->editor_obervable->update( 'on' . JString::ucfirst($event),$args);
		}
	
	
	}
	
}