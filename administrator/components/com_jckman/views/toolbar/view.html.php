<?php
/**
* @version		$Id: view.html.php 9764 2007-12-30 07:48:11Z ircmaxell $
* @package		Joomla
* @subpackage	Config
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


jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Plugins component
 *
 * @static
 * @package		Joomla
 * @subpackage	Plugins
 * @since 1.0
 */
 
class ToolbarsViewToolbar extends JView
{
	function display( $tpl = null )
	{
		
		$mainframe =JFactory::getApplication();	
		$canDo		= JCKHelper::getActions();
		
		
		$cid 	= JRequest::getVar( 'cid', array(0), '', 'array' );
		JArrayHelper::toInteger($cid, array(0));

		if( !count( $cid ) && !$canDo->get('core.create') )
		{
			$mainframe->redirect( JRoute::_( 'index.php?option=com_jckman&view=cpanel', false ), JText::_( 'COM_JCKMAN_PLUGIN_PERM_NO_CREATE' ), 'error' );
			return false;
		}
		elseif(!$canDo->get('core.edit'))
		{
			$mainframe->redirect( JRoute::_( 'index.php?option=com_jckman&view=cpanel', false ), JText::_( 'COM_JCKMAN_PLUGIN_PERM_NO_EDIT' ), 'error' );
			return false;
		}//end if
		
		
		JToolBarHelper::title( JText::_( 'Layout Manager' ) .': <small><small>[' .JText::_('Edit'). ']</small></small>', 'layout.png' );
		JToolBarHelper::save();
		JToolBarHelper::apply();
		JToolBarHelper::cancel( 'cancelEdit', 'Close' );
 		
		

		$lists 	= array();
		$user 	= JFactory::getUser();		
		$row 	= JCKHelper::getTable('toolbar');

		// load the row from the db table
		$row->load( $cid[0] );

		// fail if checked out not by 'me'

		if ($row->isCheckedOut( $user->get('id') ))
		{
			$msg = JText::sprintf( 'DESCBEINGEDITTED', JText::_( 'The toolbar' ), $row->title );
			$this->setRedirect( 'index.php?option='. $option .'&controller=Toolbars', $msg, 'error' );
			return false;
		}
		
		if ($cid[0])
		{
			$row->checkout( $user->get('id') );
			//now lets get default toolbars
			$editor = JPluginHelper::getPlugin('editors','jckeditor');
			$params =  new JRegistry($editor->params);
			$this->default = $params->get('toolbar','full'); 
			$this->defaultFT = $params->get('toolbar_ft','full');
			
			if(strtolower($row->name) == strtolower($this->default) || strtolower($row->name) == strtolower($this->defaultFT))
				$row->default = true;
			else
				$row->default = false;
		} 
		else {
			$row->params  = '';
			$row->default = false;
		}
			
		$db = JFactory::getDBO();
			
		//set the default total number of plugin records
		$total = 0;
		$totalRows = 0;
		
		if ( $cid[0] ) {
		
			
			$total = 1;
				
			$query = 'SELECT p.id,p.name,p.title,p.icon,tp.row'
			. ' FROM #__jckplugins p'
			. ' JOIN #__jcktoolbarplugins tp ON tp.pluginid = p.id'
			. ' LEFT JOIN #__jckplugins parent on parent.id = p.parentid'
			. ' WHERE tp.state = 1'
			. ' AND tp.toolbarid = '.(int) $row->id
			. ' AND p.published = 1' 
			. ' AND(p.parentid IS NULL OR parent.published = 1)'
			. ' ORDER BY tp.toolbarid ASC,tp.row ASC,tp.ordering ASC';
			$db->setQuery( $query );
			$toolbarplugins = $db->loadObjectList();
			
				
			// get the total number of core plugin records
			$query = 'SELECT COUNT(*)'
			. ' FROM #__jcktoolbarplugins tp'
			. ' JOIN #__jckplugins p ON tp.pluginid = p.id'
			. ' WHERE tp.toolbarid ='.(int) $row->id
			. ' AND p.iscore = 1';
			$db->setQuery( $query );
			$totalRows = $db->loadResult();
			
		
				
			if(!$totalRows) //lets get plugins from class file
			{
				require_once(CKEDITOR_LIBRARY.DS . 'toolbar.php');
				$CKfolder =  CKEDITOR_LIBRARY.DS . 'toolbar'; 
				$filename = $CKfolder.DS.$row->name.'.php';	
				require($filename);
				$classname = 'JCK'. ucfirst($row->name);
				$toolbar = new $classname();
				
				$query = 'SELECT p.id, p.title'
				. ' FROM #__jckplugins p'
				. ' LEFT JOIN #__jckplugins parent on parent.id = p.parentid'
				. ' AND parent.published = 1'
				. ' WHERE p.title != ""'
				. ' AND p.published = 1'
				. ' AND p.iscore = 1';
		
				$db->setQuery( $query );
				$allplugins = $db->loadObjectList();
				
				
				$values = array();
				//fix toolbar values or they will get wiped out
				$l = 1;
				$n = 1;
				$j = 1;
				
				foreach (get_object_vars( $toolbar ) as $k => $v)
				{
					
					if($v) 
					{
						$n = ($n > $v ? $n :  $v);
					}
					if($l < $n)
					{
						$l = $n;
						$j = 1;
					}	

					for($m = 0; $m< count($allplugins); $m++)
					{
						
						if($k == $allplugins[$m]->title)
						{
							$values[] = '('.(int)$row->id.','.(int)$allplugins[$m]->id.','.$n.','.$j.',1)';
							break;
						}	
						
						if(strpos($k,'brk_') !== false)
						{
							$id = preg_match('/[0-9]+$/',$k);
							$id = $id * -1;
							$values[] = '('.(int)$row->id.','.$id.','.$n.','.$j.',1)';
							$n++;
							break;
						}	
					}
					$j++;
				}
				
							
				if(!empty($values))
				{
					$query = 'INSERT INTO #__jcktoolbarplugins(toolbarid,pluginid,row,ordering,state) VALUES ' . implode(',',$values);
					$db->setQuery( $query );
					if(!$db->query()) 
					{
						JError::raiseWarning( 500, $db->getErrorMsg() );
					}
				}
			}
			
						
			$query = 'SELECT p.id,p.name,p.title,p.icon,p.row'
			. ' FROM #__jckplugins p'
			. ' LEFT JOIN #__jcktoolbarplugins tp ON tp.pluginid = p.id'
			. ' AND tp.toolbarid = '.(int) $row->id
			. ' LEFT JOIN #__jckplugins parent on parent.id = p.parentid'
			. ' WHERE tp.pluginid is null'
			. ' AND p.published = 1' 
			. ' AND p.title != ""'
			. ' AND(p.parentid IS NULL OR parent.published = 1)'
			.'  ORDER by p.row ASC, p.id ASC';
			$db->setQuery( $query );
			$plugins = $db->loadObjectList();

				
			$query = 'SELECT tp.pluginid AS id,p.name,p.title,p.icon,tp.row'
			. ' FROM #__jcktoolbarplugins tp'
			. ' LEFT JOIN #__jckplugins p ON tp.pluginid = p.id'
			. ' AND p.published = 1'
			. ' LEFT JOIN #__jckplugins parent on parent.id = p.parentid'
			. ' AND parent.published = 1'
			. ' WHERE tp.state = 1'
			. ' AND tp.toolbarid = '.(int) $row->id
			. ' AND(p.parentid IS NULL OR parent.published = 1)'
		
			. ' ORDER BY tp.toolbarid ASC,tp.row ASC,tp.ordering ASC';
			$db->setQuery( $query );
			$toolbarplugins = $db->loadObjectList();
				
	
			$toolbarplugins = $this->_getSortRowToolbars($toolbarplugins);

			$this->assignRef('toolbarplugins',	$toolbarplugins);
			$this->assignRef('plugins',	$plugins );
			
		}	
		
		$params = new JRegistry($row->params);
		
		$components = $params->get('components',array());
		
		$db->setQuery("SELECT element as value, REPLACE(element,'com_','')  as text FROM #__extensions WHERE type = 'component' ORDER BY element ASC");
		$allcomponents =  $db->loadObjectList();		
		$lists['components'] = JHTML::_('select.genericlist',  $allcomponents, 'components[]', 'style="width:150px;" size="10" multiple><option value="-1">None</option', 'value', 'text', $components);	
		
		$this->assignRef('lists',	$lists);	
		$this->assignRef('toolbar',		$row);
		$this->assignRef('total',		$total);
		
		
		parent::display($tpl);
	}
		
	function _getSortRowToolbars($toolbars)
	{
		$out = array();
		$count = 0;
		$outToolbars = array();
		$results = array();
		
	

		for($i = 0; $i < count($toolbars);$i++)
		{
		 	 			 
			 if($toolbars[$i]->id >= 0 )
			  {  
				$out[] = $toolbars[$i];
			  }
			  
			  if($toolbars[$i]->id < 0)
			  {
				$outToolbars[] = $out;
				$out = array();
			
			  }
		}		
	
		
		if(!empty($out))
		  $outToolbars[] = $out;	
		
		
		$results =  $outToolbars;
		
	
		
		

		//lets add spacer to each row
	
		
		$spacer =  new stdclass;
		$spacer->title = 'spacer';
		$spacer->name = 'spacer';
		$spacer->id = 0;
		
			
		for($n= 0; $n < count($results);$n++)
		{
			$result = $results[$n];
			$out = array();
			$rowNumber = $results[$n][0]->row;
			foreach($result as $icon)
			{
				
				if($icon->row > $rowNumber)
					$out[] =  $spacer;
				$out[] = $icon;	
				$rowNumber = $icon->row;  
			}
			$results[$n] = $out;
		}
		
		return $results;
		
	}
	
}