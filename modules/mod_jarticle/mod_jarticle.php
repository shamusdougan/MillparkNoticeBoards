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
require_once dirname(__FILE__).'/helper.php';

    $catid   = $params->get( 'catid', 0 );

    $layout = JModuleHelper::getLayoutPath('mod_jarticle');
    $options = modArticleHelper::getArticleOptions($catid);

	require($layout);

?>