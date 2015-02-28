
<?php	// Specify no-caching header controls for page
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");   			// Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");	// always modified
header("Cache-Control: no-store, no-cache, must-revalidate");	// HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");   // HTTP/1.0


?>
<html>
<head>
<title> Urban Docs </title>
<link rel="stylesheet" href="css/normalize.php" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="css/style.php">
<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans:800,400' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="http://rootsfw.org/wp-content/uploads/2014/01/Visualpharm-Ios7v2-Plants-Tree.ico">
</head>
<body>

<div id="logo">
	<a href="default.php" id="jLogo">Urban</a>
	<a href="default.php" id="quoteLogo">&nbsp;&nbsp;&nbsp;Docs</a>
</div>
<div id="header">
<table id="searchtable">
<tr>
	<td align="left">
		<form id="floatleft" action="quote.php" method="get" name="nav">
			<input id="search" type="text" value="<?php if(!empty($_GET['search'])){echo $_GET['search'];} ?>" placeholder="Search..." name="search"></input>
			<input type="submit" style="position: absolute; left: -9999px"></input>
			<input id="homebtn" type="submit" value="Search" onclick="nav.action='home.php'"></input>
		</form>
	<td>
</tr>
</table>
</div>