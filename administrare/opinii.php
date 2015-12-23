<?php
include("autorizare.php");
include("admin_top.php");
?>

<h1>Modificare sau stergere comentarii utilizatori</h1>
<b>Comentariile utilizatorilor de la ultima moderare</b>

<?php
$sql="SELECT 
		* 
	   FROM 
	   	comentarii, 
	   	admin, 
	   	carti, 
	   	autori 
	   WHERE id_comentariu > admin.ultimul_comentariu_moderat 
	         AND carti.id_carte=comentarii.id_carte 
	         AND carti.id_autor=autori.id_autor 
	   ORDER BY id_comentariu ASC";
$resursa = mysql_query($sql);
while ($row = mysql_fetch_array($resursa))
 {
	?>
	<form action="formulare_moderare_opinii.php" method="POST">
	<div style="width:500px; border:1px solid #FFFFFF; background-color:#F9F1E7; padding:5px;">
	<b><?=$row['titlu']?></b> de <?=$row['nume_autor']?>
	<hr size="1">
	<a href="mailto:<?=$row['adresa_email']?>"><?=$row['nume_utilizator']?></a><br>
		<?=$row['comentariu']?>
	</div>
	<input type="hidden" name="id_comentariu" value="<?=$row['id_comentariu']?>">	
	<input type="submit" name="modifica" value="Modifica">	
	<input type="submit" name="sterge" value="Sterge">	
	</form>
	<?php
	$ultimul_id = $row['id_comentariu'];

	$nrComentarii = mysql_num_rows($resursa);
	if ($nrComentarii>0)

	 {
		?>
		<form action="formulare_moderare_opinii.php" method="POST">
		<input type="hidden" name="ultimul_id" value="<?php echo $ultimul_id?>">
		<input type="submit" name="seteaza_moderate" value="Seteaza aceste comentarii ca fiind moderate">
		</form>
		<?php
	}
	else
	{
		print "<p>Nu exista comentarii noi.</p>";
	}

}
?>

</body>
</html>