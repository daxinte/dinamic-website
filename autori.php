<?php
session_start();
include("conectare.php");
include("page_top.php");
include("meniu.php");

$id_autor = 0;
$id_autor = $_GET['id_autor'];
$sqlNumeAutor = "SELECT nume_autor FROM autori WHERE id_autor=".$id_autor;
$resursaNumeAutor = mysql_query($sqlNumeAutor) or die(mysql_error()); 
$numeAutor = mysql_result($resursaNumeAutor, 0,'nume_autor');
?>
<td valign="top">
<h1>Autor <?=$numeAutor?></h1>
<b>Carti scrise de autor</b>
<u><i><?=$numeAutor?></i></u>:</b>
<table cellpadding="5">
<?php
$sql = "SELECT id_carte, titlu, descriere, pret,nume_autor FROM carti, autori, domenii WHERE carti.id_autor=autori.id_autor AND carti.id_domeniu=domenii.id_domeniu AND autori.id_autor=".$id_autor;
$resursa = mysql_query($sql);

while ($row = mysql_fetch_array($resursa)) 
{
		
	print '<tr><td align="center">';
			
	$adresaImagine = "coperte".$row[$id_autor].".jpg";
	if(file_exists($adresaImagine))
	{
	print '<img src="'.$adresaImagine.'"
	width="75" height="100"><br>';
	}
	else
	{
	print '<div style="width:75px; height:100px; border: 1px black solid; background-color:#cccccc">
	Fara imagine</div>';
	}
	
			print '</td><td><b><a href="carte.php?id_carte='.
	$row['id_carte'].'">'.$row['titlu'].'</a></b><br> de
	<i>'.$row['nume_autor'].'</i>
	<br>Pret: '.$row['pret'].' lei
	</td></tr>';


		
}
print'</table></td>';

include("page_bottom.php");
?>