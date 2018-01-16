<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>EstateZilla Installation</title>

    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.css" rel="stylesheet">


  </head>
  <body>
<div class="container">

  <!-- columns should be the immediate child of a .row -->
  <div class="row">
    <div class="one column"></div>
    <div class="ten columns">
	
<br />
<br />
<br />
<h5>Server requirements</h5>
<?php

extension_check(array( 
	'openssl',
	'pdo', 
	'pdo_mysql',
	'mbstring', 
	'tokenizer'
));
function extension_check($extensions) {
	$fail = '';
	$pass = '';
	
	if(version_compare(PHP_VERSION, '5.4.0', '<')) {
		$fail .= '<li>You need<strong> PHP 5.4.0</strong> (or greater). You have PHP '.PHP_VERSION.'</li>';
	}
	else {
		$pass .='<li>You have<strong> PHP '.PHP_VERSION.'</strong></li>';
	}
	foreach($extensions as $extension) {
		if(!extension_loaded($extension)) {
			$fail .= '<li> You are missing the <strong>'.$extension.'</strong> extension</li>';
		}
		else{	$pass .= '<li>You have the <strong>'.$extension.'</strong> extension</li>';
		}
	}
	
	if($fail) {
		echo '<p><strong>Your server does not meet the following requirements in order to install EstateZilla.</strong>';
		echo '<br>The following requirements failed, please contact your hosting provider in order to receive assistance with meeting the system requirements for EstateZilla:';
		echo '<ul>'.$fail.'</ul></p>';
		echo 'The following requirements were successfully met:';
		echo '<ul>'.$pass.'</ul>';
		die();
	} else {
		echo '<p><strong>Congratulations!</strong> Your server meets the requirements for EstateZilla.</p>';
		echo '<ul>'.$pass.'</ul>';
	}
}
?>

<h5>Unzipping</h5>
<?

$zip = new ZipArchive;
if (TRUE) {
    
	@unlink('install.php');
    echo 'Successfully unzipped.';
	@chmod("full/storage", 0777); 
	@chmod("full/bootstrap/cache", 0777); 	
} else {
    echo 'Unable to unzip. Please make sure you have the correct permissions. Please submit an issue on github.';
	die();
}

?>
	<small>
		<p>* Remember have mod_rewrite enabled and give permissions to folders (storage and bootstrap/cache)</p>
		<p>The admin panel is located <a href="admin" >here</a>.</p>
		<p>The username is "admin" and the password is "changeme". Please change the password when you login.</p>
	</small>

	<a href="./full" class="button button-primary">Click here to go to your website</a>
	
	</div>
	<div class="one column"></div>
  </div>
  </body>
</html>