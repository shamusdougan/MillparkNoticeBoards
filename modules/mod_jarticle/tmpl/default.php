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

    defined('_JEXEC') or die('Restricted access');
    $title              =       $params->get( 'module_showtitle', 0 );
    $width              =       $params->get( 'module_width', 0 );
    $module_lettercnt   =       $params->get( 'module_lettercnt', 0 );
?>
	<link rel="stylesheet" href="modules/mod_jarticle/tmpl/css/style.css" type="text/css" media="screen" charset="utf-8" />
	<script type="text/javascript" src="modules/mod_jarticle/tmpl/js/jquery-1.2.6.js"></script>
	<script type="text/javascript" src="modules/mod_jarticle/tmpl/js/startstop-slider.js"></script>

	<div id="page-wrap" style="width: <?php echo $width; ?>px;">
		<div id="slider">
            <div id="mover">
    			<?php for ($i = 0, $n = count($options); $i < $n; $i ++) : ?>
                    <div id="slide-<?php echo $i; ?>" class="slide">
                        <?php
                          if($title){
                        ?>
                        <h1>
                            <?php
                                $url='<a href="index.php?option=com_content&view=article&id='.$options[$i]->id.'&Itemid='.$_REQUEST['Itemid'].'">';
                                echo $url;
                                echo $options[$i]->title;
                                echo '</a>';
                            ?>
                        </h1>
                        <?php } ?>
					    <div id="article_content">
                            <?php
                                if($options[$i]->introtext){
                                    echo $options[$i]->introtext;
                                }
                                else{
                                    echo $options[$i]->fulltext;
                                }
                            ?>
                        </div>
				    </div>
    			<?php endfor; ?>
			</div>
		</div>
	</div>