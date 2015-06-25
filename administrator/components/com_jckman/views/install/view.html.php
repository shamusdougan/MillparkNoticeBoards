<?php
/**
 * @version		$Id: view.php 9764 2007-12-30 07:48:11Z ircmaxell $
 * @package		Joomla
 * @subpackage	Menus
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Extension Manager Install View
 *
 * @package		Joomla
 * @subpackage	Installer
 * @since		1.5
 */

include_once(dirname(__FILE__).DS.'..'.DS.'default'.DS.'view.php');

class InstallerViewInstall extends InstallerViewDefault
{
	function display($tpl=null)
	{
		
		$canDo = JCKHelper::getActions();
		$app	= JFactory::getApplication();
		
		if(!$canDo->get('jckman.install'))
		{
			$app->redirect( JRoute::_( 'index.php?option=com_jckman&view=cpanel', false ), JText::_( 'COM_JCKMAN_PLUGIN_PERM_NO_INSTALL' ), 'error' );
			return false;
		}//end if
		
		/*
		 * Set toolbar items for the page
		 */
		$bar = JToolBar::getInstance('toolbar');
		// Add a Link button for Control Panel
		$bar->appendButton( 'Link', 'cpanel', 'Control Panel', 'index.php?option=com_jckman&controller=cpanel');
		JToolBarHelper::help( $app->input->get( 'view' ), false,'http://www.joomlackeditor.com/installation-guide?start=16&secondtabshow=1#installer_help');	
		$paths = new stdClass();
		$paths->first = '';
		
		
		$lookup = array( JHTML::_('select.option',  0, JText::_( 'All' ) ) );
		$selections = $this->get('ToolbarList');
		$lists['selections']	= JHTML::_('select.genericlist',   $selections, 'selections[]', 'class="inputbox" size="15" multiple="multiple" style=width:182px;', 'value', 'text', $lookup, 'selections' );

		$state = $this->get('state');

		$this->assignRef('paths', $paths);
		$this->assignRef('state', $state);
		$this->assignRef('lists',	$lists);

		parent::display($tpl);
	}

}