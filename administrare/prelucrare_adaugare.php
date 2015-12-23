<?php
include("autorizare.php");
include("admin_top.php");
if (isset($_POST['adauga_domeniu'])) 
{
	if ($_POST['domeniu_nou'] == "") 
	{
		print 'Trebuie sa complectezi numele de domeniu!<br>
		<a href="adaugare.php">Inapoi</a>';
		exit;
		}
	$sql = "SELECT * FROM domenii WHERE nume_domeniu = '".$_POST['domeniu_nou']."'";

	$resursa = mysql_query($sql) or die(mysql_error());
	if (mysql_num_rows($resursa) !=0)
	 {
	  print 'Domeniul <b>'.$_POST['domeniu_nou'].'</b> exista deja in baza de date!<br><a href="adaugare.php">Inapoi</a>';
	  exit;
	}
	$sql = "INSERT INTO domenii(nume_domeniu) VALUES ('".$_POST['domeniu_nou']."')";

	$resursa = mysql_query($sql) or die(mysql_error());
	print 'Domeniul <b>'.$_POST['domeniu_nou'].'</b> a fost adaugat in baza de date!<br>
<a href="adaugare.php">Inapoi</a>';
		exit;
}

if (isset($_POST['adauga_autor'])) 
{
	if ($_POST['autor_nou'] == "") 
	{
		print 'Trebuie sa complectezi numele autorului<br>
		<a href="adaugare.php">Inapoi</a>';
		exit;
		}
	$sql = "SELECT * FROM autori WHERE nume_autor = '".$_POST['autor_nou']."'";
	$resursa = mysql_query($sql);
	if (mysql_num_rows($resursa) !=0)
	 {
	  print 'Autorul <b>'.$_POST['autor_nou'].'</b> exista deja in baza de date!<br><a href="adaugare.php">Inapoi</a>';
	  exit;
	}
	$sql = "INSERT INTO autori(nume_autor) VALUES ('".$_POST['autor_nou']."')";
	$resursa = mysql_query($sql);
	print 'Autorul <b>'.$_POST['autor_nou'].'</b> a fost adaugat in baza de date!<br>
<a href="adaugare.php">Inapoi</a>';
		exit;
}

if (isset($_POST['adauga_carte'])) 
{
	if ($_POST['titlu'] == "" || $_POST['descriere'] == "" || $_POST['pret'] == "" ) 
	{
		print 'Titlul, descrierea sau pretul sunt goale!<br>
		<a href="adaugare.php">Inapoi</a>';
		exit;
		}
	if(!is_numeric($_POST['pret']))
	{

		print 'Campul pret poate fi de tip numeric(fara LEI)<br>
		<a href="adaugare.php">Inapoi</a>';
		exit;
	}

	$sql = "SELECT * FROM carti WHERE id_autor = '".$_POST['id_autor']."'AND titlu ='".$_POST['titlu']."'";

	$resursa = mysql_query($sql);
	if (mysql_num_rows($resursa) !=0)
	 {
	  print 'Aceasta carte exista deja in baza de date!<br><a href="adaugare.php">Inapoi</a>';
	  exit;
	}

	$sql = "INSERT INTO carti(id_domeniu, id_autor, titlu, descriere, pret, data) VALUES ('".$_POST['id_domeniu']."', '".$_POST['id_autor']."', '".$_POST['titlu']."','".$_POST['descriere']."','".$_POST['pret']."', '".date("Y-m-d H:i:s")."')";
	$resursa = mysql_query($sql);
	print 'Cartea a fost adaugat in baza de date!<br>
<a href="adaugare.php">Inapoi</a>';
		exit;
}
?>


</body>
</html>