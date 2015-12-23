<?php
session_start();
include("conectare.php");
include("page_top.php");
include("meniu.php");
$id_carte = $_GET['id_carte'];
$sql = "SELECT titlu, nume_autor, descriere, pret FROM carti, autori WHERE id_carte = ".$id_carte." AND carti.id_autor = autori.id_autor";
$resursa = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_array($resursa);
?>
<td align="top"></td>
<table>
	<tr>
		<td valign="top">
			<?php
			$adresaImagine = "coperte/".'id_carte'.".jpg";
			if (file_exists($adresaImagine))
			 {
		    print '<img src="'.$adresaImagine.'"width = "75" height = "100"><br>';
			 }
 ?>
</td>	
<td valign="top">
	<h1><?=$row['titlu']?></h1>
	<i>de <b><?=$row['nume_autor']?></b></i>
	<p><i><?=$row['descriere']?></i></p>
	<p>Pret: <?=$row['pret']?> lei.</p>
</td>		
	</tr>	
</table>

<form action="cos.php?actiune=adauga" method="POST">
	<input type="hidden" name="id_carte" value="<?php echo $id_carte?>">
	<input type="hidden" name="titlu" value="<?php echo $row['titlu']?>">
	<input type="hidden" name="pret" value="<?php echo $row['pret']?>">
	<input type="submit" value="Cumpara acum!">
</form>

<p><b>Opiniile cititorilor</b></p>
<?php
$sqlComentarii = "SELECT * FROM comentarii WHERE id_carte =".$id_carte;
$resursaComentarii = mysql_query($sqlComentarii);
while ($row = mysql_fetch_array($resursaComentarii)) 
{
	print '<div style="width:400px;border:1px solid #ffffff;background-color:#F9F1E7;padding:5px;"><a href="mailto:'.$row['adresa_email'].'">'.$row['nume_utilizator'].'</a><br>'.$row['comentariu'].'</div>';
}
?>

<br>

<div style="width:400px;border:1px solid #632415;background-color:#F9F1E7;padding:5px;">
	<b>Adauga opinia ta:</b>
	<hr size="1">
	<form action="adauga_comentariu.php" method="POST">
		Nume: <input type="text" name="nume_utilizator">
		Email: <input type="test" name="adresa_email"><br><br>
		Comentariu:<br>
		<textarea name="comentariu" cols="45"></textarea><br><br>
		<input type="hidden" name="id_carte" value="<?=$id_carte?>">
		<center><input type="submit" value="Adauga"></center>
	</form>
</div>
</td>
<?
include("page_bottom.php");
?>