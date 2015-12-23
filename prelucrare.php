<?php

if ($_POST['nume'] == "") {
	print 'Trebuie complectat numele!
	<a href="cos.php">Inapoi</a>';
	exit;
}

if ($_POST['adresa'] == "") {
	print 'Trebuie complectat adresa!
	<a href="cos.php">Inapoi</a>';
	exit;
}

$nrCarti = 0;
session_start();

if (isset($_SESSION["nr_buc"])) {
	$nrCarti = array_sum($_SESSION['nr_buc']);
}

$emailDestinatar =0; 
$subiect =0; 
$mesaj =0; 
$totalGeneral=0;

if (!$nrCarti) 
{
	print 'tre sa cumparati cel putin o carte!<a href="cos.php">Inapoi</a>';
	exit;
}

include("conectare.php");
$sqlTranzactie = "insert into tranzactii(nume_cumparator, adresa_cumparator) values ('".$_POST['nume']."','".$_POST['adresa']."')";
$resursaTranzactie = mysql_query($sqlTranzactie);
$id_tranzactie = mysql_insert_id();
if(isset($_SESSION["id_carte"])) {
	for ($i=0; $i < count($_SESSION['id_carte']); $i++) { 
		if ($_SESSION['nr_buc'][$i] > 0) {
			$sqlVanzare = "INSERT INTO vanzari values ('".$id_tranzactie."', '".$_SESSION['id_carte'][$i]."', '".$_SESSION['nr_buc'][$i]."')";
			mysql_query($sqlVanzare) or die(mysql_error());
		}
	}
	
	$emailDestinatar = "daxinte@gmail.com";
	$subiect = "O noua comanda!";
	$mesaj = "O noua comanda de la <b>".$_POST['nume']."</b><br>";
	$mesaj .= "Adresa: ".$_POST['adresa']."<br>";
	$mesaj .= "Cartile comandate:<br><br> ";
	$mesaj .= "<table border ='1' cellspacing = '0' cellpadding = '4'>";
	if(isset($_SESSION["id_carte"])) {
		for ($i=0; $i < count($_SESSION['id_carte']); $i++) { 
			if ($_SESSION['nr_buc'][$i] > 0) {
				$mesaj .="<tr><td>".$_SESSION['titlu'][$i]." de "./*.$_SESSION['nume_autor'][$i].*/"</tr></td>".$_SESSION['nr_buc'][$i]." buc </td></tr>";
				$totalGeneral +=($_SESSION['pret'][$i]*$_SESSION['nr_buc'][$i]); 
			}
		}
	}
}

$mesaj .= "</table>";
$mesaj .= "Total:<b>".$totalGeneral."</b>";
$headers = "MIME-Version:1.0\r\nContent-type: text/html;
charset=iso-BB59-2\r\n";

$mailSent = mail($emailDestinatar, $subiect, $mesaj, $headers);
// echo $mailSent;
session_unset();
session_destroy();

header("Location: multumire.php");
?>