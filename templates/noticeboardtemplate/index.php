<?php

$doc = JFactory::getDocument();

$doc->addStyleSheet($this->baseurl . '/media/jui/css/bootstrap.min.css');
$doc->addStyleSheet($this->baseurl . '/media/jui/css/bootstrap-responsive.css');
$doc->addStyleSheet('templates/' . $this->template . '/css/style.css');
$doc->addScript('/templates/' . $this->template . '/js/main.js', 'text/javascript');

?>


<!DOCTYPE html>
<html>
<head>
	<jdoc:include type="head" />
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="refresh" content="30">

</head>
<body>

<jdoc:include type="modules" name="board_select" style="xhtml" />

<jdoc:include type="component" />
 


</body>
</html>
 


 
