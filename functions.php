<?php 

$db = new PDO(DATABASE_TYPE.':host='.DATABASE_HOST.';dbname='.DATABASE_NAME, DATABASE_USER, DATABASE_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

function login($data)
{	
	global $db;
	
	$sql = "SELECT gebruiker.*, persoon.* FROM gebruiker
	inner join persoon
	on gebruiker.persoon_id=persoon.id
	WHERE email=:email";
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':email', $data["username"], PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetch();


	if (!empty($result) && password_verify($_POST["password"], $result["password"])) {
		$_SESSION['login'] = $result['id'];
		$_SESSION['ownImg'] = $result['avatar'];
		$_SESSION['naam'] = $result['voornaam']." ".$result['achternaam'];
		if (password_needs_Rehash($result["password"], PASSWORD_DEFAULT)) {
			$hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
			$sql = "UPDATE gebruiker
			SET password=:password
			WHERE id=:id";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':password', $hash, PDO::PARAM_STR);
			$stmt->bindParam(':id', $result['id'], PDO::PARAM_INT);
			$stmt->execute();
		}
		
	}
	elseif (!empty($result)) {
		$_SESSION["alert"] = 'u heeft een verkeerd wachtwoord ingevoerd';
	}
	else {
		$_SESSION["alert"] = 'de gebruiker die u heeft ingevoerd is niet gevonden';
	}
	header('location:'. URL);
};
function registreren($data)
{	


	global $tpl;
	foreach ($data as $key => $value) {
		$data[$key] = htmlentities($value);
	}
	$geboortedatum = mktime(0, 0, 0, $data['MM'], $data['DD'], $data['JJJJ']);
	$adres = $data["adres"]." ".$data['huisnummer'].$data['toevoeging'];

	$_SESSION["alert"] = NULL;
	$_SESSION["alert"] .= (strlen($data["voornaam"]) < 2) ? "<p>je voornaam is maar 1 letter? ben je nu serieus?</p>" : NULL ;
	$_SESSION["alert"] .= (strlen($data["achternaam"]) < 2) ? "<p>je achternaam is maar 1 letter? ben je nu serieus?</p>" : NULL ;
	$_SESSION["alert"] .= (empty($geboortedatum) || $geboortedatum > time()) ? "<p>klopt je geboortedatum?</p>" : NULL ;
 	//$_SESSION["alert"] .= () ? "<p>je bent te jong: je moet minimaal 12 jaar oud zijn!</p>" : NULL ;
	$_SESSION["alert"] .= (!preg_match('/^.+\ \d+.*$/', $adres)) ? "<p>klopt je adres wel?</p>" : NULL ;
	$_SESSION["alert"] .= (!preg_match('/^\d{4}[a-zA-Z]{2}$/', $data["postcode"])) ? "<p>klopt je postcode wel?</p>" : NULL ;
	$_SESSION["alert"] .= (strlen($data["woonplaats"]) < 2) ? "<p>je woonplaats klopt niet echt!</p>" : NULL ;
	$_SESSION["alert"] .= (!preg_match('/^.+@.+\..+$/', $data["email"])) ? "<p>vul wel even een goed email adres in<p>" : NULL ;
	$_SESSION["alert"] .= (!preg_match('/^(?=.*\d+)(?=.*[a-z]+)(?=.*[A-Z]+).{6,}$/', $data["password"])) ? "<p>je wachtwoord voldoet niet aan de eisen:</p><ul><li>minimaal 1 cijfer of letter</li><li>minimaal 1 hoofdletter</li><li>minimaal 1 kleine letter</li><li>minimaal 6 karakters lang</li></ul>" : NULL ;
	$_SESSION["alert"] .= ($data["password"] != $data["wachtwoordHerhaal"]) ? "<p>wachtwoord komt niet overeen</p>" : NULL ;

	$password = password_hash($data["password"], PASSWORD_DEFAULT);

	if (empty($_SESSION["alert"])) {


		global $db;
		$sql = "INSERT INTO persoon (voornaam, achternaam, geboortedatum, adres, postcode, woonplaats) VALUES (:voornaam, :achternaam, :geboortedatum, :adres, :postcode, :woonplaats)";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':voornaam', $data["voornaam"], PDO::PARAM_STR);
		$stmt->bindParam(':achternaam', $data["achternaam"], PDO::PARAM_STR);
		$stmt->bindParam(':geboortedatum', $geboortedatum, PDO::PARAM_INT);
		$stmt->bindParam(':adres', $adres, PDO::PARAM_STR);
		$stmt->bindParam(':postcode', $data["postcode"], PDO::PARAM_STR);
		$stmt->bindParam(':woonplaats', $data["woonplaats"], PDO::PARAM_STR);
		$stmt->execute();
		$id = $db->lastInsertId();
		$sql = "INSERT INTO gebruiker (email, password, status, groep_id, persoon_id) VALUES (:email, :password, 1, 1, :id)";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':email', $data["email"], PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$_SESSION['alert'] = "je kan nu inloggen met als gebruikersnaam: ". $data[email] . " en u opgegeven wachtwoord";
		header('location:' . URL);
	} else {
		$tpl->prepare();
		$tpl->newBlock('alert');
		$tpl->assign("alert", $_SESSION['alert']);
		$_SESSION['alert'] = NULL;
		$tpl->newBlock('login');
		$tpl->newBlock('gridIndex') ;

		$tpl->assign($data);


		$tpl->printToscreen();
		return;
	};
};

function post($data)
{
	foreach ($data as $key => $value) {
		$data[$key] = htmlentities($value);
	}

	global $db;

	$date = time();

	$sql = "INSERT INTO post (content, datum, gebruiker_id) VALUES (:content, :datum, :gebruiker_id)";
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':content', $data["content"], PDO::PARAM_STR);
	$stmt->bindParam(':datum', $date, PDO::PARAM_INT);
	$stmt->bindParam(':gebruiker_id', $_SESSION['login'], PDO::PARAM_INT);
	$stmt->execute();
	header('location:' . URL);
};

function wall()
{
	global $tpl;
	global $db;

	$sql = "SELECT post.*, gebruiker.id as gebruiker, persoon.voornaam, persoon.achternaam, persoon.avatar 
	FROM post 
	INNER JOIN gebruiker 
	ON post.gebruiker_id=gebruiker.id 
	INNER JOIN persoon 
	ON gebruiker.persoon_id=persoon.id
	ORDER BY post.datum DESC";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$tpl->prepare();
	showAlerts();
	$tpl->newBlock('topMenu');
	$tpl->newBlock('topMenuLabel');
	$tpl->newBlock('topMenuItem');
	$tpl->newBlock('topMenuLabel');
	$tpl->newBlock('topMenuItem');
	$tpl->newBlock('topMenuItem'); 
	$tpl->newBlock('gridWall');
	$tpl->assign("img", $_SESSION['ownImg']);
	$tpl->assign("naam", $_SESSION['naam']);

	foreach ($row as $row) {
		

		$content = ($row['status'] == 0) ? 'dit bericht is verwijderd' : $row['content'];
		$naam = $row['voornaam'].' '.$row['achternaam'];

		$nu = time();
		if ($nu - $row['datum'] < 60) {
			$sec = $nu- $row['datum'];
			$datum = $sec . "s";
		}
		elseif ($nu - $row['datum'] < 60*60) {
			$minuten = floor(($nu - $row['datum']) / 60);
			$datum = $minuten."m";
		}
		elseif ($nu - $row['datum'] < 60*60*24) {
			$uur = floor(($nu - $row['datum']) / (60*60));
			$datum = $uur."u";
		}
		elseif ($nu - $row['datum'] < 60*60*24*7) {
			$day = date('w',$row['datum']);
			$dag = dag($day);

			



			$datum = $dag;
		}

		$tpl->newBlock('item');
		
		$tpl->assign("img", $row['avatar']);
		$tpl->assign("naam", $naam);
		$tpl->assign("datum",  $datum);
		$tpl->assign("content", $content);
		if ($row['gebruiker'] == $_SESSION['login']){
			$tpl->newBlock('postdelete');
			$tpl->assign("id", $row['id']);
		}
	};

	$tpl->printToscreen();
	return;
};

function deletePost($id)
{
	global $db;
	$sql = "UPDATE post SET status=0 WHERE id=:id";
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	header('location:' . URL);
};

function showAlerts()
{
	global $tpl;
	if (!empty($_SESSION['alert'])) {
		$tpl->newBlock('alert');
		$tpl->assign("alert", $_SESSION['alert']);
		$_SESSION['alert'] = NULL;
	};
};

function showLogin()
{
	global $tpl;
	$tpl->prepare();
	$tpl->newBlock('login');
	$tpl->newBlock('gridIndex') ;
	$tpl->printToscreen();
}

function dag($day)
{
	switch ($day) {
		case '0':$dag = 'zo'; break;
		case '1':$dag = 'ma'; break;
		case '2':$dag = 'di'; break;
		case '3':$dag = 'wo'; break;
		case '4':$dag = 'do'; break;
		case '5':$dag = 'vr'; break;
		case '6':$dag = 'za'; break;
	}
	return $dag;
};


?>

