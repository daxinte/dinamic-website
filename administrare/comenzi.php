<?php
include("autorizare.php");
include("admin_top.php");
?>
<h1>Comenzi</h1>
<b>Comenzi inca neonorate</b>
<?php

$sqlTranzactii = "SELECT id_tranzactie, DATE_FORMAT(data,'%d.%m.%Y') as data_tranzactie, nume_cumparator, adresa_cumparator from tranzactii WHERE comanda_onorata = 0";
	$resursaTranzactii = mysql_query($sqlTranzactii);
	while ($rowTranzactie = mysql_fetch_array($resursaTranzactii))

	 {
	 	$totalGeneral = 0;
		?>
		<form action="prelucrare_comenzi.php" method="POST">
		Data comenzii:
		<b><?=$rowTranzactie['data_tranzactie']?></b>
		<div style="width:500px; border:1px solid #FFFFFF; background-color:#F9F1E7; padding:5px;">	
		<b><?=$rowTranzactie['nume_cumparator']?></b><br>
		<b><?=$rowTranzactie['adresa_cumparator']?></b><br>

		<table border="1" cellpadding="4" cellspacing="0">
		<tr>
			<td align="center"><b>Carte</b></td>
			<td align="center"><b>Nr.buc</b></td>
			<td align="center"><b>Pret</b></td>
			<td align="center"><b>Total</b></td>

		</tr>	
		<?php
			$sqlCarti = "SELECT carti.titlu, autori.nume_autor, carti.pret, vanzari.nr_buc from vanzari, carti, autori WHERE carti.id_carte=vanzari.id_carte and carti.id_autor=autori.id_autor and id_tranzactie=".$rowTranzactie['id_tranzactie'];
			$resursaCarti = mysql_query($sqlCarti) or die(mysql_error());
				while ($rowCarte = mysql_fetch_array($resursaCarti)) {
					print '<tr><td>'
					.$rowCarte['titlu'].' de '.$rowCarte['nume_autor'].'</td>
					<td align="right">
					'.$rowCarte['nr_buc'].'</td>
					<td align="right">
					'.$rowCarte['pret'].'</td>';
					$total = $rowCarte['pret'] * $rowCarte['nr_buc'];
					print '<td align="right">
					'.$total.'</td></tr>';
					$totalGeneral+=$total;
				}
				?>
				<tr>
					<td colspan="3" align="right">Total comanda:</td>
					<td><?php echo $totalGeneral?> lei</td>
				</tr>
		</table>
		<input type="hidden" name="id_tranzactie" value="<?php echo $rowTranzactie['id_tranzactie']?>">
		<input type="submit" name="comanda_onorata" value="Comanda onorata">
		<input type="submit" name="anuleaza_comanda" value="Anuleaza comanda">
		</div>
		</form>		
		<?php
	}
	?>


</body>
</html>