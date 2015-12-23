<?php
include("autorizare.php");
include("admin_top.php");
if (isset($_POST['modifica'])) 
{
	$sql = "SELECT * from comentarii WHERE id_comentariu = ".$_POST['id_comentariu'];
	$resursa = mysql_query($sql);
	$row = mysql_fetch_array($resursa);
	?>
	<h1>Modifica</h1>
	<b>Modifica acest comentariu</b>
	<form action="prelucrare_moderare_comentarii.php" method="POST">
		<input type="text" name="nume_utilizator" value="<?=$row['nume_utilizator']?>">
		<input type="test" name="adresa_email" value="<?=$row['adresa_email']?>">
		Comentariu: <br><textarea name="comentariu" cols="45" rows="8">
			<?=$row['comentariu']?>
		</textarea><br><br>
		<input type="hidden" name="id_comentariu" value="<?=$_POST['id_comentariu']?>">
		<input type="submit" name="modifica" value="Modifica">
	</form>
	<?php
}

if (isset($_POST['sterge'])) 
{
	?>
	<h1>Sterge</h1>
	Esti sigura ca vrei sa stergi acest comentariu?
	<form action="prelucrare_moderare_comentarii.php" method="POST">
		<input type="hidden" name="id_comentariu" value="<?=$_POST['id_comentariu']?>">
		<input type="submit" name="sterge" value="Sterge">
	</form>
	<?php
}

if (isset($_POST['seteaza_moderate'])) 
{
	?>
	<h1>Seteaza comentariile ca fiind moderate</h1>
	Esti sigura ca vrei sa setezi comentariile din pagina anterioara ca fiind moderate? Le-ai verificat pe toate?
	<form action="prelucrare_moderare_comentarii.php" method="POST">
		<input type="hidden" name="ultimul_id" value="<?=$_POST['ultimul_id']?>">
		<input type="submit" name="seteaza_moderate" value="Da!">
	</form>
	<?php
}
?>
</body>
</html>