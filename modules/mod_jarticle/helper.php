<?php
/*------------------------------------------------------------------------
# J Article
# ------------------------------------------------------------------------
# author                Md. Shaon Bahadur
# copyright             Copyright (C) 2011 j-download.com. All Rights Reserved.
# @license -            http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites:             http://www.j-download.com
# Technical Support:    http://www.j-download.com/request-for-quotation.html
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;

class modArticleHelper
{
	static function getArticleOptions($id)
	{
		$db	=& JFactory::getDBO();

		$query = 'SELECT a.id, a.title, a.introtext, a.fulltext' .
			' FROM #__content AS a' .
			' WHERE a.catid = ' . (int) $id .
			' ORDER BY a.id';
		$db->setQuery($query);

		if (!($options = $db->loadObjectList())) {
			echo "MD ".$db->stderr();
			return;
		}

		return $options;
	}
}
?>