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

// Include the syndicate functions only once
require_once (dirname(__FILE__) . DS . 'helper.php');

jimport("joomla.filter.filterinput");

$moduleclass_sfx =              $params->get("moduleclass_sfx", '');
$target =                       $params->get("target", '');
$jquery =                       $params->get("jquery", 0);
$pause =                        $params->get("pause", 'true');
$transition =                   $params->get("transition", 'fade');
$randomizeEffects =             $params->get("randomizeEffects", 1);
$auto_play =                    $params->get("auto_play", '1');
$slideshow_speed =              $params->get("slideshow_speed", 800) * 1000;
$timer_speed =                  $params->get("timer_speed", 4000) * 1000;
$navBarColor =                  $params->get("navBarColor", '#ccc');
$title_color =                  $params->get("title_color", '#FFFFFF');
$title_font_size =              $params->get("title_font_size", '16');
$prenext_show =                 $params->get("prenext_show", 1);
$show_title =                 	$params->get("show_title", 'true');
$show_readmore =                $params->get('show_readmore', "0");
$ReadMore_font_size =           $params->get('ReadMore_font_size', "14");
$description_color =            $params->get('description_color', "#FFFFFF");
$content_font_size =            $params->get('content_font_size', "14");
$link_title =                	$params->get('link_title', 1);
$button_style =                 $params->get('button_style', 'number');
$desc_box_width =               $params->get('slideShow_width');
$slideShow_width =              $params->get('slideShow_width', '600');
$slideShow_height =             $params->get('slideShow_height', '300');
$slideShow_background =         $params->get('slideShow_background', '#000000');
$read_more_color =              $params->get('read_more_color', '#000000');
$readmore_Btn =                 JText::_('MORE_INFO');

 $transitionList="";
foreach ($transition as $key) {
  $transitionList=="" ?  $transitionList.=  $key :  $transitionList.= ','. $key;
}

$widthIe = 0;


jimport('joomla.environment.browser');
 $browser = &JBrowser::getInstance();
 $browserName =$browser->getBrowser();
 $browserVersion =$browser->getMajor();


if ($browserName == 'msie' && $browserVersion == 6) {
    $widthIe = 3;
}
if (!defined('KLIXO_ARTICLES_SLIDER')) {
    define('KLIXO_ARTICLES_SLIDER', 1);

    if ($jquery) {
        JHTML::script('jquery-1.8.3.min.js', JURI::base() . '/modules/' . $module->module . '/assets/'); 
    }
    

    /* Add css */
    JHTML::stylesheet('style.css', JURI::base() . '/modules/' . $module->module . '/assets/');
    $crapIE6 = false;
    if ($browserName== 'msie' && $browserVersion == 6) {
        JHTML::stylesheet('ie6.css', JURI::base() . '/modules/' . $module->module . '/assets/');
        $crapIE6 = true;
        /*if ($jquery) {
        JHTML::script('jquery.pngFix.js', JURI::base() . '/modules/' . $module->module . '/assets/');
    }*/
        
    } else if ($browserName == 'msie' && $browserVersion == 7) {
        JHTML::stylesheet('ie7.css', JURI::base() . '/modules/' . $module->module . '/assets/');
        $currentBrowser = IE7;
    }

  JHTML::script('jquery.cycle.all.js', JURI::base() . '/modules/' . $module->module . '/assets/');
}

$GLOBALS["module"] = $module;

$items = modKlixoArticlesSliderHelper::getContentList($params);

$themePath = JModuleHelper::getLayoutPath('mod_klixo_articles_slider');


if (file_exists($themePath)) {
    require($themePath);
}
?>