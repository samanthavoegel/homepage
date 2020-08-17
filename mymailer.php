<!doctype html>
<html>
<head>
<?php
error_reporting(1);
#################################################
# read me #######################################
# Form-Tag im Kontaktformular:
# <form action="107mymailer.php" method="post">
#
# Zur Sicherheit: 
# Name vom <input type="submit" name="???"> in Variable $SubmitName übernehmen!
#
# Eingabefeld für E-Mail-Adresse sollte den name=eMail haben 
# <input type="text" name="eMail" maxlength="40"> 
# (wird dann als Absender verwendet!) 

#################################################
##################################################
# Eigene Dinge einstellen #########################
####################################################
$SendenAn  ="samantha_voegel@hotmail.com";	# Ziel-Mail-Adresse samantha_voegel@hotmail.com
$SubmitName="send";				# name="????" im submit-button des Kontaktformulares
$Betreff   ="Kontaktformular-samy.bp.net";# Betreff der verschickten Mail
$TopLine   ="Mailer-Service";	# Text für die Topline der Mail
####################################################
###################################################
##################################################
?>
<meta charset="utf-8">
<title>Mailscript s-zigan.de</title>
<style>
	<!--
	body, html, table{ font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; background:#eee;}
	p 		{ margin:0px; padding:0px;}
	h1		{ margin:3px; font-size:16px;}  
	hr 		{ width:600px;}
	.error 	{color:#CC3300;}
	.center { text-align:center; margin-top:50px;}
	-->
</style>
</head>
<body>
<?php
	# Auswertung für unerwünschte Zeichen vorbereiten ------------------
	$no='/{\";:=}'; 
	$all="";
	foreach($_POST as $key => $wert){
		$all .= $wert;
	}
	function enti($i){
		$i=str_replace("'"," ",$i);
        $i=trim($i);
		return htmlentities($i, ENT_QUOTES, "UTF-8");
	}

# mögliche Fehler abfangen ----------------------------------------------------
if(!isset($_POST[$SubmitName])) $txt[]="Script wurde nicht vom Kontaktformular aufgerufen!";
if (strcspn($all,$no)!=strlen($all)) $txt[]="unerlaubtes Zeichen: <b>". substr($all,strcspn($all,$no),1) . "</b>";

if ($txt == ""){
	# HTML-Mail zusammenstellen ---------------------------------------------
	$Ausg="
	<style> 
		* {background:#eee; color:#333; font:12pt Verdana;}
		td {padding:0 10px;vertical-align:top;}
		.head {background:#333;color:#f60;text-align:center;height:50px;}
	</style>
	<table>
		<tr><th class='head' colspan='2'>&#9776; $TopLine &#9776;</th></tr>";
	foreach($_POST as $key => $wert){
		if ($key != "sendadr"){
			$Ausg .= "<tr><td>$key: </td><td> ";
			if($wert == "") $Ausg .=  "-";
			else $Ausg .=  enti($wert);
			$Ausg .= "</td></tr>";
		}
	}
	$Ausg .= "<tr><th class='head' colspan='2'>&#9827; </th></tr></table>";	 
	
	# Header für HTML-Mail zusammenstellen ------------------------------------
	if (isset($_POST['eMail']) && $_POST['eMail'])
		 $from = $_POST['eMail'];
	else $from = "siehe(at)eMail.feld";
					
	$mail_header = "From:$from\r\n";
	$mail_header .= "Reply-To:$from\r\n";
	#$mail_header .= "X-Mailer: PHP/" . phpversion(); 
	
	
	$mail_header .= "MIME-Version: 1.0\r\n";
	$mail_header .= "Content-type: text/html; charset=UTF-8 \r\n";	
	 
	# Mail senden -------------------------------------------------------------
	# -------------------------------------------------------------------------
	mail($SendenAn, $Betreff, "$Ausg", $mail_header);
	# -------------------------------------------------------------------------

	
	# Bestätigungs-Bildschirm -------------------------------------------------
	echo  "	<div class='center'>
			<hr>
			<h1>Das Formular wurde gesendet</h1>
			<br><br>
			Herzlichen Dank f&uuml;r Ihr Interesse.<hr></div>
			<script>
			<!--
				window.setTimeout(\"history.go(-2)\",6000);
				//window.setTimeout(\"window.location = 'http://url/'\",6000);
				;
			// -->
			</script>";
}

# Soweit aufgetreten -> Fehlerausgabe ----------------------------------------
if (count($txt)>0){
	echo "<div class='center'><hr>";
	for ($x=0;$x<count($txt);$x++) echo "<p class='error'>$txt[$x]</p>";
	echo "	<hr>Sie werden automatisch zur&uuml;ckgeschalten.</div>
			<script>
			<!--
				window.setTimeout(\"history.go(-1)\",6000);
			// -->
			</script>";
}
?>
</body>
</html>