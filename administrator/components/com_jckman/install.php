<?php

defined('_JEXEC') or die('Restricted access');


class com_jckmanInstallerScript
{

	function install($parent) {
		
		$mainframe = JFactory::getApplication();
		$db = JFactory::getDBO();
		
		$query = "SELECT count(1) FROM #__modules"
		." WHERE module = 'mod_jckquickicon'";
		$db->setQuery( $query );
		$count = $db->loadResult();
		if($count)  $this->uninstall($parent);
		
		
		jimport('joomla.filesystem.folder');
			
		$src 	= 'components' .DS. 'com_jckman' .DS. 'modules' .DS. 'mod_jckquickicon';
		$dest 	= 'modules' .DS. 'mod_jckquickicon';
		
		if( !JFolder::copy( $src, $dest, JPATH_ADMINISTRATOR, true ) ){
			$mainframe->enqueueMessage( JText::_('Unable to install control panel icon module!') );
		}
	
		$row = JTable::getInstance('module');
		$row->title = 'JCK Manager v4.8.7';
		$row->content = 	
		'<div style="padding: 5px;">
			<img alt="" src="components/com_jckman/icons/jck-manager-logo.png" style="margin: 3px 2px 0pt 0pt;" />
		</div>
		<div style="padding:5px;"> 
		Installed version: 4.8.7<br/> 
		Author: <a href="http://www.joomlackeditor.com">www.joomlackeditor.com</a><br/>
		Copyright &copy; WebxSolution Ltd, All rights reserved.<br/>
		License: GPLv2.0<br/>
		For licensing information please visit the following web sites:<br/>
		<a href="http://joomlackeditor.com/terms-of-use">http://joomlackeditor.com/terms-of-use</a>
		</div>
		<div style="padding: 5px;">
		The JCK Manager is a way of effortlessly extending the JCK Editor without the need of programming knowledge! And because the Editor is built upon a state-of-the-art plug-and-play architecture you can expand it and shape it in any direction!
			<br />
			<br />
		</div>';
		$row->ordering = $row->getNextOrder( "position='jck_cpanel'" );
		$row->position = 'jck_cpanel';
		$row->published = 1;
		$row->showtitle = 1;
		$row->access = 1;
		$row->client_id = 1;
		$row->module = 'mod_custom';
		$row->params = '{"prepare_content":0}';
		if (!$row->store()) {
			$mainframe->enqueueMessage( JText::_('Unable to insert JCK PlugMan custom Module data!') );
		}	
		
		
		$row->id = 0;
		$row->title = 'JCK Plugin Manager';
		$row->content = 	
		'<div style="padding: 5px;">
			<img alt="" src="components/com_jckman/icons/icon-48-plugin.png" style="float: left; margin: 3px 2px 0pt 0pt;" />
			
			The Plugin Manager controls what buttons are displayed in the editor&rsquo;s interface. It allows plugins to be published, unpublished, and assigned to specific tool-bars with the ability to setup user permissions.
			<br/> 
			<br/> 
			In addition to these features the Plugin Manager will allow you to drill down and edit each and every plug-in that makes up the JCK Editor. The plugin allows for 3 globel parameters for the dialog popup screens: Height, Title and Width and you will find further customisable parameters just like any standard Joomla extension!
			<br />
		</div>';
		$row->ordering = $row->getNextOrder( "position='jck_cpanel'" );
		if (!$row->store()) {
			$mainframe->enqueueMessage( JText::_('Unable to insert JCK PlugMan custom Module data!') );
		}

		$row->id = 0;
		$row->title = 'JCK Plugin Installer';
		$row->content = 	
		'<div style="padding: 5px;">
			<img alt="" src="components/com_jckman/icons/icon-48-installer.png" style="float: left; margin: 3px 2px 0pt 0pt;" />
			
			A JCK plugin consists of an extension that interacts with the editor. These plugins or extensions are used to enable the user to quickly and simply customise or expand the functionality of the editor. This could be done to meet your needs to portfolio images in a stylish light-box gallery or to expand the editor with media or image editing extensions. The possibilities are endless!  What\'s so great about it is that it works similar to Joomla\'s stock installer, so it\'s very easy to install, and you don\'t have to be a developer to get started!
		<br />
		</div>
		<div style="padding: 5px;">
			Please click here to visit the official Plug-in Store: <a href="http://www.joomlackeditor.com/downloads/jck-plugins-store">http://www.joomlackeditor.com/downloads/jck-plugins-store</a>
		<br />
		</div>';
		$row->ordering = $row->getNextOrder( "position='jck_cpanel'" );
		if (!$row->store()) {
			$mainframe->enqueueMessage( JText::_('Unable to insert JCK PlugMan custom Module data!') );
		}

		$row->id = 0;
		$row->title = 'System Check';
		$row->content = 	
		'<div style="padding: 5px;">
			<img alt="" src="components/com_jckman/icons/icon-48-systemcheck.png" style="float: left; margin: 3px 2px 0pt 0pt;" />
			
			The JCK Manager has an intelligent API that will attempt to fix problems and reconfigure your website if you upgrade your template. It does this by automatically performing a health checks on your system and notifies you of these problems and will help you address them. 
		<br />
		</div>
		<div style="padding: 5px;">
			This also reinitiates the helpful installation wizard which will walk you step by step through the process of setting up the basic functionally of the editor.
		<br />
		</div>';
		$row->ordering = $row->getNextOrder( "position='jck_cpanel'" );
		if (!$row->store()) {
			$mainframe->enqueueMessage( JText::_('Unable to insert JCK PlugMan custom Module data!') );
		}

		$row->id = 0;
		$row->title = 'Layout Manager';
		$row->content = 	
		'<div style="padding: 5px;">
			<img alt="" src="components/com_jckman/icons/icon-48-layout.png" style="float: left; margin: 3px 2px 0pt 0pt;" />
			
			The Layout manager allows control over the editors toolbars, with it you can create your own bespoke toolbars, position plugins, create new toolbars, add and remove! It\'s surprisingly easy do thanks to its simple drag-and-drop interface which will allow you to craft your own bespoke layouts.
		<br />
		</div>
		<div style="padding: 5px;">
			It also allows for different toolbars to be assigned to different components and areas of your website.  This is especially useful if you want to use the \'blog\' toolbar for your blogging component while having a more advanced \'editorial\' toolbar for the rest of your site.
			<br />
		</div>';
		$row->ordering = $row->getNextOrder( "position='jck_cpanel'" );
		if (!$row->store()) {
			$mainframe->enqueueMessage( JText::_('Unable to insert JCK PlugMan custom Module data!') );
		}	

		$row->id = 0;
		$row->title = 'Backup';
		$row->content = 	
		'<div style="padding: 5px;">
			<img alt="" src="components/com_jckman/icons/icon-48-export.png" style="float: left; margin: 3px 2px 0pt 0pt;" /> 
			
			The backup wizard gives you the ability to create backup copies of your editor&rsquo;s configuration and files.  This includes backing up your JCK plugins and settings, your JCK Manager configuration (including toolbars and user permissions) and lastly your editor&rsquo;s configuration. It does this by creating a clone and exporting it as a tar.gz file ready for you to reinstate via the JCK Managers backup restore feature!
		<br />
		</div>
		<div style="padding: 5px;">
		This feature is very useful, and can be used to export restore points prior to upgrading or used to export your custom configuration to another Joomla compatible system!
		<br />
		</div>';
		$row->ordering = $row->getNextOrder( "position='jck_cpanel'" );
		if (!$row->store()) {
			$mainframe->enqueueMessage( JText::_('Unable to insert JCK PlugMan custom Module data!') );
		}

		$row->id = 0;
		$row->title = 'Restore';
		$row->content = 	
		'<div style="padding: 5px;">
			<img alt="" src="components/com_jckman/icons/icon-48-import.png" style="float: left; margin: 3px 2px 0pt 0pt;" /> 
			To restore a backup is very easy! All you need to do is click in the &lsquo;Restore&rsquo;s icon, navigate to the tar.gz backup file and click in the &lsquo;Upload File &amp; install&rsquo;s button. Or if you want to migrate your configuration from one server to another, all you need to do is install the JCK Editor &amp; Manager first, and repeat the above &ndash; job done!
		</div>';
		$row->ordering = $row->getNextOrder( "position='jck_cpanel'" );
		if (!$row->store()) {
			$mainframe->enqueueMessage( JText::_('Unable to insert JCK PlugMan custom Module data!') );
		}

		$row->id = 0;
		$row->title = 'Sync';
		$row->content = 	
		'<div style="padding: 5px;">
			<img alt="" src="components/com_jckman/icons/icon-48-sync.png" style="float: left; margin: 3px 2px 0pt 0pt;" />
			The JCK Manager keeps a hard copy of your editor&rsquo;s settings and plugins. At any given moment you can use the &lsquo;Sync&rsquo; button to synchronize this data back to the JCK Editor. This is especially useful as it will allow you to uninstall and reinstall the editor during upgrade, before synchronizing your editor&rsquo;s settings back!
		</div>';
		$row->ordering = $row->getNextOrder( "position='jck_cpanel'" );
		if (!$row->store()) {
			$mainframe->enqueueMessage( JText::_('Unable to insert JCK PlugMan custom Module data!') );
		}
		
		$row = JTable::getInstance('module');
		$row->title = 'JCK PLugMan Control Panel Icons';
		$row->ordering = $row->getNextOrder( "position='jck_icon'" );
		$row->position = 'jck_icon';
		$row->published = 1;
		$row->showtitle = 0;
		$row->access = 1;
		$row->client_id = 1;
		$row->module = 'mod_jckquickicon';
		$row->params = '';
	
		if (!$row->store()) {
			$mainframe->enqueueMessage( JText::_('Unable to insert Control Panel icon Module data!') );
		}
			

		
		jimport('joomla.filesystem.file');
			
		$src 	= JPATH_ADMINISTRATOR.DS.'components' .DS. 'com_jckman' .DS. 'editor' .DS. 'pluginoverrides.php';
		$dest 	= JPATH_PLUGINS.DS.'editors'.DS.'jckeditor'.DS.'jckeditor'.DS.'includes'.DS.'ckeditor'.DS.'plugins'.DS.'editor'.DS. 'pluginoverrides.php';
		
		
		if( !JFile::copy( $src, $dest) ){
			$mainframe->enqueueMessage( JText::_('Unable to move pluginoverrides JCK plugin!') );
		}
		
		$src 	= JPATH_ADMINISTRATOR.DS.'components' .DS. 'com_jckman' .DS. 'editor' .DS. 'acl.php';
		$dest 	= JPATH_PLUGINS.DS.'editors'.DS.'jckeditor'.DS.'jckeditor'.DS.'includes'.DS.'ckeditor'.DS.'plugins'.DS.'editor'.DS. 'acl.php';
		
		
		if( !JFile::copy( $src, $dest) ){
			$mainframe->enqueueMessage( JText::_('Unable to move ACL JCK plugin!') );
		}
			
		$src 	= JPATH_ADMINISTRATOR.DS.'components' .DS. 'com_jckman' .DS. 'editor' .DS. 'components.php';
		$dest 	= JPATH_PLUGINS.DS.'editors'.DS.'jckeditor'.DS.'jckeditor'.DS.'includes'.DS.'ckeditor'.DS.'plugins'.DS.'toolbar'.DS. 'components.php';

		if( !JFile::copy( $src, $dest) ){
			$mainframe->enqueueMessage( JText::_('Unable to move components JCK  toolbar plugin!') );
		}	
					
		$src 	= JPATH_ADMINISTRATOR.DS .'components' .DS. 'com_jckman' .DS. 'editor'.DS.'plugins.php';
		$dest 	= JPATH_PLUGINS.DS.'editors'.DS.'jckeditor'.DS.'jckeditor'.DS.'includes'.DS.'ckeditor'.DS.'plugins.php';
		
		
		if( !JFile::copy( $src, $dest) ){
			$mainframe->enqueueMessage( JText::_('Unable to move base plugins file to JCK library!') );
		}
		
		$src  = JPATH_ADMINISTRATOR.DS .'components' .DS. 'com_jckman' .DS. 'editor'.DS.'toolbar'.DS.'mobile.php';
		$dest = JPATH_PLUGINS.DS.'editors'.DS.'jckeditor'.DS.'jckeditor'.DS.'includes'.DS.'ckeditor'.DS.'toolbar'.DS.'mobile.php';
		
		if(!JFile::exists($dest))
		{
			if( !JFile::copy( $src, $dest) )
			{
				$mainframe->enqueueMessage( JText::_('Unable to move mobile toolbar file to JCK library!') );
			}
		}
		
			//$src 	= JPATH_ADMINISTRATOR.DS .'components' .DS. 'com_jckman' .DS. 'editor'.DS.'includes.php';
		//$dest 	= JPATH_PLUGINS.DS.'editors'.DS.'jckeditor'.DS.'includes.php';
		
		/*
		if( !JFile::copy( $src, $dest) ){
			$mainframe->enqueueMessage( JText::_('Unable to move updated includes file to JCK plugin!') );
		}
		*/	
	
			
		unset( $row );
		
		//Check System requirements for the editor 
		
		define('JCK_BASE',JPATH_CONFIGURATION .DS.'plugins'.DS.'editors'.DS.'jckeditor');
			
		if(!JFolder::exists(JCK_BASE))
		{
			$mainframe->enqueueMessage( JText::_('System has detected JCK Editor has not been installed!') );
			return;
		}
		
		$perms  = fileperms(JPATH_CONFIGURATION.DS.'index.php');
		$perms = (decoct($perms & 0777));
			
		$default_fperms = '0644';
		$default_dperms = '0755'; 
			
		if($perms == 777 || $perms == 666)
		{
			$default_fperms = '0666';
			$default_dperms = '0777'; 
		}
		
		$fperms = JCK_BASE.DS.'config.js';
		
		if(!stristr(PHP_OS,'WIN') && JPath::canChmod(JCK_BASE)  && $perms != decoct(fileperms($fperms) & 0777))
		{
			
		  $path = JCK_BASE.DS.'plugins';
		 
		  if(!JPath::setPermissions($path,$default_fperms,$default_dperms))
		  {
			$mainframe->enqueueMessage( JText::_( 'System detected incorrect file permissons for the JCK Editor. Unable to autocorrect so please mannually change.') );
		  }
		}
		
		//for upgrade
		$query = 'SELECT p.name FROM `#__jckplugins` p WHERE p.iscore = 0';
		$db->setQuery( $query );
		$results = $db->loadObjectList();
	
		if(!empty($results))
		{
			for($i = 0; $i < count($results);$i++)
			{
				if(JFolder::exists(JPATH_PLUGINS.DS.'editors'.DS.'jckeditor'.DS.'plugins'.DS.$results[$i]->name) && 
					!JFolder::exists(JPATH_ADMINISTRATOR.DS .'components' .DS. 'com_jckman'.DS.'editor'.DS.'plugins'.DS.$results[$i]->name)
				)
				{
					
					$src 	= JPATH_PLUGINS.DS.'editors'.DS.'jckeditor'.DS.'plugins'.DS.$results[$i]->name;
					$dest 	= JPATH_ADMINISTRATOR.DS .'components'.DS.'com_jckman'.DS.'editor'.DS.'plugins'.DS.$results[$i]->name;
					
					
					if( !JFolder::copy( $src, $dest) )
					{
						$mainframe->enqueueMessage( JText::_('Unable to move base plugin .'.$results[$i]->name.' to JCK backup folder!') );
					}
				}
			}//end for loop
		}
			
		
		
	}
	
	
	
	function update($parent) 
    {
     	$this->install($parent);
		
		$db = JFactory::getDBO();
	
		if(method_exists($parent, 'extension_root')) {
			$sqlfile = $parent->getPath('extension_root').DS.'sql'.DS.'install.sql';
		} else {
			$sqlfile = $parent->getParent()->getPath('extension_root').DS.'sql'.DS.'install.sql';
		}
		// Don't modify below this line
		$buffer = file_get_contents($sqlfile);
		if ($buffer !== false) {
			jimport('joomla.installer.helper');
			$queries = JInstallerHelper::splitSql($buffer);
			if (count($queries) != 0) {
				foreach ($queries as $query)
				{
					$query = trim($query);
					if ($query != '' && $query{0} != '#') {
						$db->setQuery($query);
						if (!$db->query()) {
							JError::raiseWarning(1, JText::sprintf('JLIB_INSTALLER_ERROR_SQL_ERROR', $db->stderr(true)));
							return false;
						}
					}
				}
			}
		}
		
    }
	
	function uninstall($parent) {
		
		$mainframe = JFactory::getApplication();
		
		$db = JFactory::getDBO();
		jimport('joomla.filesystem.folder');
		
		$path = JPATH_ADMINISTRATOR .DS. 'modules' .DS. 'mod_jckquickicon';
		
		if( !JFolder::delete( $path ) ){
			$mainframe->enqueueMessage( JText::_('Unable to remove control panel icon module!') );
		}
		
		$query = "DELETE FROM #__modules"
		." WHERE module = 'mod_custom'"
		." AND position = 'jck_cpanel'";
		$db->setQuery( $query );
		
		if( !$db->query() ){
			$mainframe->enqueueMessage( JText::_('Unable to remove JCK PlugMan custom Module data!') );
		}
		
		$query = "DELETE FROM #__modules"
		." WHERE module = 'mod_jckquickicon'";
		$db->setQuery( $query );
		
		if( !$db->query() ){
			$mainframe->enqueueMessage( JText::_('Unable to remove Control Panel icon Module data!') );
		}
		
		$file = JPATH_PLUGINS.DS.'editors'.DS.'jckeditor'.DS.'jckeditor'.DS.'includes'.DS.'ckeditor'.DS.'plugins'.DS.'editor'.DS. 'pluginoverrides.php';
		
		if(JFile::exists($file) && !JFile::delete($file)) {
			$mainframe->enqueueMessage( JText::_('Unable to delete pluginoverrides JCK plugin!') );
		
		}
		
				
		$file = JPATH_PLUGINS.DS.'editors'.DS.'jckeditor'.DS.'jckeditor'.DS.'includes'.DS.'ckeditor'.DS.'plugins'.DS.'editor'.DS. 'acl.php';
		
		if(JFile::exists($file) && !JFile::delete($file)) {
			$mainframe->enqueueMessage( JText::_('Unable to delete ACL JCK plugin!') );
		}
		
		$file = JPATH_PLUGINS.DS.'editors'.DS.'jckeditor'.DS.'jckeditor'.DS.'includes'.DS.'ckeditor'.DS.'plugins'.DS.'toolbar'.DS. 'components.php';

		if(JFile::exists($file) && !JFile::delete($file)) {
			$mainframe->enqueueMessage( JText::_('Unable to delete components JCK  toolbar plugin!') );
		}
		
		// For some reason we need to remove the row from the asset table?!
		$sql = $db->getQuery( true );
		$sql->delete( '#__assets' )
			->where( 'name = "com_jckman"' )
			->where( 'title = "com_jckman"' );
		if( !$db->setQuery( $sql )->query() )
		{
			$mainframe->enqueueMessage( JText::_('Unable to remove JCKMan asset record!') );
		}
				
	}

}