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
if ($crapIE6 == true) {
    $slideShow_width = "auto";
}

$contentWrapHeight = ($button_style != "hide") ? $slideShow_height - 21 : $slideShow_height;
$textBoxHeight = ($show_readmore) ? $contentWrapHeight - $ReadMore_font_size - 25 : $contentWrapHeight -20 ;
?>

<style type="text/css">

    div#klixoSlider_<?php echo $module->id; ?> div.navBar
    {
        right:5px;
        width: <?php echo $slideShow_width - 10 ?>px;

    }

    div#klixoSlider_<?php echo $module->id; ?>  div.navBar ul 
    { 
        width: <?php echo ($currentBrowser == IE7) ? count($items) * 14 . 'px' : 'auto' ?>; 
    }


    div#klixoSlider_<?php echo $module->id; ?> div.slide_show_header h3 , div#klixoSlider_<?php echo $module->id; ?> .slide_show_header h3 a{ 
        color:<?php echo $title_color ?>;
        font-size:<?php echo $title_font_size ?>px; 
        height:<?php echo $title_font_size + 5 ?>px; 
    }

    div#klixoSlider_<?php echo $module->id; ?> div.readmore a{ 
        color:<?php echo $read_more_color ?>;
        font-size:<?php echo $ReadMore_font_size ?>px; 
        height:<?php echo $ReadMore_font_size + 5 ?>px; 
    }

    div#klixoSlider_<?php echo $module->id; ?>, div#moduleSlideShow<?php echo $module->id; ?> {
        background-color: <?php echo $slideShow_background ?>; 
        width: <?php echo $slideShow_width ?>px; 
        height: <?php echo $slideShow_height ?>px;

    }

    div#klixoSlider_<?php echo $module->id; ?> div.textContent {
        color:<?php echo $description_color ?>;  
        font-size:<?php echo $content_font_size ?>px; 
        height:<?php echo $textBoxHeight ?>px; 

    }

    div#klixoSlider_<?php echo $module->id; ?> div.contentBoxWrapper {
        height:<?php echo $contentWrapHeight ?>px; 
        width: <?php echo $slideShow_width ?>px; 
        background-color: <?php echo $slideShow_background ?>;       
    }

</style>


<?php if (count($items) > 0): ?>
    <script type="text/javascript">

        if(typeof(jQScript)=='undefined')

        jQScript = jQuery.noConflict();



    jQScript(document).ready(function($) {

        jQScript('#moduleSlideShow<?php echo $module->id; ?>').cycle({

            fx:     '<?php echo $transitionList; ?>',
            
            randomizeEffects:'<?php echo $randomizeEffects; ?>',

            timeout: <?php echo $timer_speed; ?>,

            speed:  <?php echo $slideshow_speed; ?>, 

            next:   '#next<?php echo $module->id; ?>', 

            prev:   '#prev<?php echo $module->id; ?>',

            pause: <?php echo ($pause) ? 1 : 0; ?>,

            divId: <?php echo $module->id; ?>,

            autoPlay: <?php echo $auto_play; ?>,

            startingSlide:0

        });

    });

    </script>

    <div class="article_slider <?php echo $moduleclass_sfx; ?>" id="klixoSlider_<?php echo $module->id; ?>">
        <div id="moduleSlideShow<?php echo $module->id; ?>">
            <?php
            $index = 0;
            foreach ($items as $key => $item) {
                $index++;
                $clickEvent = "javascript: return true";
                ?>
                <div id="slide_<?php echo $index ?>">
                    <div class ="contentBoxWrapper">
                        <div class="content-box">
                            <div id="current_content_<?php echo $module->id; ?>" class="textContent">
                                                            <?php if ($show_title) { ?>  
                                <?php if ($link_title) { ?>
                                    <div id="caption_<?php echo $module->id; ?>"  class="slide_show_header"><h3> <a href="<?php echo  $item->link ?>" target="<?php echo $target; ?>" onclick="<?php echo $clickEvent ?>"><?php echo $item->sub_title ?></a></h3></div>        
                                <?php } else { ?>   
                                    <div id="caption_<?php echo $module->id; ?>"  class="slide_show_header"><h3><?php echo $item->sub_title ?></h3></div>
                                    <?php
                                }
                            }
                            ?>   
                                <?php echo $item->sub_content ?>
                            </div>
                        </div>	
                        <?php if ($show_readmore) : ?>  
                            <div id="read_more_content_<?php echo $module->id; ?>" class="readmore"><a href="<?php echo  $item->link ?>" target="<?php echo $target; ?>" onclick="<?php echo $clickEvent ?>"><?php echo JText::_('MORE_INFO') ?></a></div>
                        <?php endif ?>
                    </div>
                </div>
            <?php } ?> 
        </div>		

     <?php if ($prenext_show) : ?>
            <a id="prev<?php echo $module->id; ?>" class="previous">&nbsp;&nbsp;&nbsp;&nbsp;</a>
            <a id="next<?php echo $module->id; ?>" class="next">&nbsp;&nbsp;&nbsp;&nbsp;</a>
        <?php endif ?>	
        <?php if ($button_style != "hide") : ?>   
            <div class="navBar" id="cover_buttons_<?php echo $module->id; ?>">	
                <div class="center_nav" style="background-color:<?php echo $navBarColor ?>;">			
                    <ul id="image_button_<?php echo $module->id; ?>" <?php echo ($button_style == 'dots') ? 'class="dots"' : 'class="numbers"' ?>>

                        <?php foreach ($items as $key => $item) { ?>

                            <?php if ($button_style == 'number') { ?>

                                <li class="<?php echo ($key == $start) ? "button_img_selected" : "button_img"; ?>" value="<?php echo $key; ?>"><?php echo ($key + 1); ?></li>

                            <?php } else { ?>

                                <li class="<?php echo ($key == $start) ? "button_img_selected" : "button_img"; ?>" value="<?php echo $key; ?>"></li>

                            <?php } ?>

                        <?php } ?> 
                    </ul>
                </div>
            </div>	
        <?php endif ?>	
    </div>

<?php else: ?><div class ="contentError"> <?php echo JText::_('NO_CONTENT') ?></div> 

<?php endif; ?>