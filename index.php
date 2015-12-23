<?php 
session_start();
include("conectare.php");
include("page_top.php");
include("meniu.php");
?>
<td valign="top">
<h1>Prima pagina</h1>
<p>Cele mai noi carti</p>	
<table cellpadding="5">
<tr>
<?php 
$sql = "SELECT id_carte, titlu, nume_autor, pret FROM carti, autori WHERE carti.id_autor=autori.id_autor ORDER BY data DESC LIMIT 0,3";
$resursa = mysql_query($sql) or die(mysql_error());
while ($row = mysql_fetch_array($resursa)) {
	print '<td align ="center">';
	$adresaImagine = "coperte".$row['id_carte'].".jpg";
	if (file_exists($adresaImagine)) {
		print '<img src="'.$adresaImagine.'"width = "75" height = "100"><br>';
	}
		else
			{
				print '<div style = "width:75px; height:100px;border:1px black solid; background-color:#cccccc">Fara imagine</div>';
			}
			    print '<b><a href="carte.php?id_carte='.$row['id_carte'].'">'.$row['titlu'].'</a></b><br> de <i>'.$row['nume_autor'].'</i><br>
				Pret: '.$row['pret'].' lei
				</td>';
 	}
 ?>
</tr>	



</table>
<hr>

<p>Cele mai vandute carti</p>
<table cellpadding="5">
<tr>
<?php 
$sqlVanzari = "SELECT id_carte, sum(nr_buc) AS bucatiVandute FROM vanzari GROUP BY id_carte
ORDER BY bucatiVandute DESC LIMIT 0,3";
$resursaVanzari=mysql_query($sqlVanzari);
while($rowVanzari =
mysql_fetch_array($resursaVanzari))
{
	$sqlCarte = "SELECT titlu, nume_autor, pret FROM carti, autori WHERE
	carti.id_autor=autori.id_autor AND id_carte=".$rowVanzari['id_carte'];
	$resursaCarte=mysql_query($sqlCarte);


	while($rowCarte = mysql_fetch_array($resursaCarte))
	{
		print '<td align="center">';
		$adresaImagine = "coperte/".$rowVanzari['id_carte'].".jpg";
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
		print '<b><a href="carte.php?id_carte='.
		$rowVanzari['id_carte'].'">'.$rowCarte['titlu'].'</a></b><br> de
		<i>'.$rowCarte['nume_autor'].'</i>
		<b>Pret: '.$rowCarte['pret'].' lei
		</td>';
	}
}
?>
</tr>
</table>
</td>
</tr>
</table>
<?php
include("page_bottom.php");
?>