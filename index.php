<?php 
session_start();

require './config.php';
require './functions.php';
include("./template/class.TemplatePower.inc.php");
$tpl = new TemplatePower("./template/template.tpl");


$submit = (isset($_POST['submit'])) ? $_POST['submit'] : NULL ;

if (isset($_GET['p1'])) {
	$parameters = explode('/', $_GET['p1'], 3);
} else{
	$parameters = NULL;
}

switch ($submit) {
	case 'Login':
	login($_POST);

	return;
	break;

	case 'registreren':
	registreren($_POST);

	return;
	break;
	
	case 'post':
	post($_POST);
	return;
	break;

	case 'reactie plaatsen':
	echo "show reactie";
	break;
	default:

	switch ($parameters[0]) {
		case 'verwijderen':
		
		switch ($parameters[1]) {
			case 'post':
			deletePost($parameters[2]);
			break;
			
			default:
			//header('location: localhost/muur/');
			break;
		}
		return;
		break;

		default:
		if (isset($_SESSION['login'])) {
			wall();
		}
		else {
			showLogin();
		};
		
		
		break;
	};
};
?>