<?php
session_start();
include("conectare.php");
include("page_top.php");
include("meniu.php");
?>

<td valign="top"></td>
<h1>Casa</h1>
Acestea sunt cartile comandate de dvs.:
<table border="1" cellspacing="0" cellpadding="4">
<tr bgcolor="#F9F1E7">
	<td><b>Nr.buc</b></td>
	<td><b>Carte</b></td>
	<td><b>Pret</b></td>
	<td><b>Total</b></td>
</tr>
<?php
$totalGeneral = 0;//initializare
if(isset($_SESSION["id_carte"])) {
	for ($i=0; $i < count($_SESSION['id_carte']) ; $i++) { 
		if ($_SESSION['nr_buc'][$i]!= 0) {
			print '<tr><td>'.$_SESSION['nr_buc'][$i].'</td>
			<td><b>'.$_SESSION['titlu'][$i].'</td>
			<td align="right">'.$_SESSION['pret'][$i].' lei </td>
			<td align="right">'.$_SESSION['pret'][$i] * $_SESSION['nr_buc'][$i].' lei </td></tr>';
			$totalGeneral += ($_SESSION['pret'][$i] * $_SESSION['nr_buc'][$i]); 
	 	}
	}
}
	
print '<tr>
<td align="right" colspan="3">
<b>Total de plata</b></td>
<td align="right">
<b>'.$totalGeneral.'</b>lei</td>
</tr>';
?>
</table>
<h1>Detalii</h1>
<form action="prelucrare.php" method="POST">
<table>
	<tr>
		<td><b>Numele:</b></td>
		<td><input type="text" name="nume"></td>
	</tr>
	<tr>
		<td valign="top"><b>Adresa:</b></td>
		<td><textarea name="adresa" rows="6"></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="Trimite!"></td>
	</tr>
</table>
</form>
</td>
<?
include("page_bottom.php");
?>