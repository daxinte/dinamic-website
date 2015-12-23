<?php
include("autorizare.php");
include("admin_top.php");
if (isset($_POST['modifica_domeniu'])) 
{
	$sql = "SELECT nume_domeniu FROM domenii WHERE id_domeniu ='".$_POST['id_domeniu']."'";
	$resursa = mysql_query($sql);
	if (mysql_num_rows($resursa) > 0) {
	$nume_domeniu = mysql_result($resursa, 0, "nume_domeniu");


}
?>
<h1>Modifica nume domeniu</h1>
<form action="prelucrare_modificare_stergere.php" method="POST">
	<input type="text" name="id_domeniu" value="<?=$_POST['id_domeniu']?>">
	<input type="text" name="nume_domeniu" value="<?php echo $nume_domeniu?>">
	<input type="submit" name="modifica_domeniu" value="Modifica">
</form>
<?php
}


if (isset($_POST['sterge_domeniu'])) 
	
{
	$sql = "SELECT titlu, nume_autor FROM carti, autori, domenii WHERE carti.id_domeniu=domenii.id_domeniu AND carti.id_autor=autori.id_autor AND domenii.id_domeniu=".$_POST['id_domeniu'];
	$resursa = mysql_query($sql) or die(mysql_error());
	
	$nrCarti = mysql_num_rows($resursa);
	if ($nrCarti>0)
	 {
		print "<p>Sunt $nrCarti";	 
		while ($row = mysql_fetch_array($resursa)) {
			print "<br><b>".$row['titlu']."</b> de ".$row['nume_autor']."<br>";
		
	}
	print "<p>Nu puteti sterge acest domeniu</p>";
	}
	else
	{

	?>
	<h1>Sterge nume domeniu</h1>
	Esti sigur ca vrei sa stergi acest domeniu?
	<form action="prelucrare_modificare_stergere.php" method="POST">
	<input type="hidden" name="id_domeniu" value="<?=$_POST['id_domeniu']?>">
	<input type="submit" name="sterge_domeniu" value="Sterge!">
	</form>
	<?php
}
}

if (isset($_POST['modifica_autor'])) 
{
	$sql = "SELECT nume_autor FROM autori WHERE id_autor=".$_POST['id_autor'];
	$resursa = mysql_query($sql);
	$nume_autor = mysql_result($resursa, 0);
	?>	
	<h1>Modifica nume autor</h1>
	<form action="prelucrare_modificare_stergere.php" method="POST">
		<input type="text" name="nume_autor" value="<?php echo $nume_autor?>">
		<input type="hidden" name="id_autor" value="<?=$_POST['id_autor']?>">
		<input type="submit" name="modifica_autor" value="Modifica!">
	</form>
	<?php
}
if (isset($_POST['sterge_autor'])) 
{
	$sql = "SELECT titlu FROM carti, autori WHERE carti.id_autor=autori.id_autor AND carti.id_autor=".$_POST['id_autor'];
	$resursa = mysql_query($sql);
	$nrCarti = mysql_num_rows($resursa);
	if ($nrCarti>0)
	 {
		print "<p>Sunt $nrCarti carti de acest autor in baza de date</p>";
		while ($row = mysql_fetch_array($resursa)) {
			print $row['titlu']."<br>";
		}
		print "<p>Nu puteti sterge acest autor</p>";
	}

	else
	{

	?>
	<h1>Sterge autor</h1>
	Esti sigur ca vrei sa stergi acest autor?
	<form action="prelucrare_modificare_stergere.php" method="POST">
	<input type="hidden" name="id_autor" value="<?=$_POST['id_autor']?>">
	<input type="submit" name="sterge_autor" value="Sterge!">
	</form>

	<?php
}
}

if (isset($_POST['modifica_carte'])) 
{
	print "<h1>Modificare carte</h1>";

	$sqlCarte = "SELECT * FROM carti WHERE titlu='".$_POST['titlu']."' AND id_autor=".$_POST['id_autor'];
	$resursaCarte = mysql_query($sqlCarte);
	if (mysql_num_rows($resursaCarte)==0)
	 {
		print "Aceasta carte nu exista in baza de date";
	}
	else
	{

		$rowCarte = mysql_fetch_array($resursaCarte);
		?>
	
	<form action="prelucrare_modificare_stergere.php" method="POST">
	<table>
		<tr>
			<td>Domeniu:</td>
			<td>
				<select name="id_domeniu">
				<?php
				$sql = "SELECT * FROM domenii ORDER BY nume_domeniu ASC";
				$resursa = mysql_query($sql);
	while($row=mysql_fetch_array($resursa))
	 {
		if ($row['id_domeniu'] == $rowCarte['id_domeniu']) 
		{
			print '<option SELECTED value="'.$row['id_domeniu'].'">'.$row['nume_domeniu'].'</option>';
		}
		else
		{

			print '<option value="'.$row['id_domeniu'].'">'.$row['nume_domeniu'].'</option>';
		}
	}
	?>
					
				</select>
			</td>
		</tr>
		<tr>
			<td>Autor:</td>
			<td>
				<select name="id_autor">
				<?php
				$sql = "SELECT * FROM autori ORDER BY nume_autor ASC";
				$resursa = mysql_query($sql);
	while($row=mysql_fetch_array($resursa))
	 {
		if ($row['id_autor'] == $rowCarte['id_autor']) 
		{
			print '<option SELECTED value="'.$row['id_autor'].'">'.$row['nume_autor'].'</option>';
		}
		else
		{

			print '<option value="'.$row['id_autor'].'">'.$row['nume_autor'].'</option>';
		}
	}
	?>
					
				</select>
			</td>
		</tr>
		<tr>
			<td>Titlu:</td>
			<td>
				<input type="text" name="titlu" value="<?=$rowCarte['titlu']?>">
			</td>
		</tr>
		<tr>
			<td valign="top">Descriere:</td>
			<td>
				<textarea name="descriere" rows="8"><?=$rowCarte['descriere']?></textarea>
			</td>
		</tr>
		<tr>
			<td valign="top">Pret:</td>
			<td>
				<input type="text" name="pret" value="<?=$rowCarte['pret']?>">
				</td>
		</tr>
	</table>
	<input type="hidden" name="id_carte" value="<?=$rowCarte['id_carte']?>">
	<input type="submit" name="modifica_carte" value="Modifica">
	</form>
	<?php
	}
	}

	if (isset($_POST['sterge_carte'])) 
{
	print "<h1>Sterge carte</h1>";
	$sqlCarte = "SELECT * FROM carti WHERE titlu='".$_POST['titlu']."' AND id_autor=".$_POST['id_autor'];
	$resursaCarte = mysql_query($sqlCarte);
	if (mysql_num_rows($resursaCarte)==0)
	 {
		print "<p>Aceasta carte nu exista in baza de date</p>";
	}

	else
	{
		$id_carte = mysql_result($resursaCarte, 0, "id_carte");

	?>
	Esti sigur ca vrei sa stergi aceasta carte?
	<form action="prelucrare_modificare_stergere.php" method="POST">
	<input type="hidden" name="id_carte" value="<?=$id_carte?>">
	<input type="submit" name="sterge_carte" value="Sterge!">
	</form>

	<?php
}
}
?>
</body>
</html>