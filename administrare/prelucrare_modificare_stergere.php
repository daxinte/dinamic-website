<?php
include("autorizare.php");
include("admin_top.php");
if (isset($_POST['modifica_domeniu'])) 
{
	if ($_POST['nume_domeniu'] == "")
	 {
		print "Nu ati introdus numele domeniului";
	}
	else 
	{	
		$sql = "UPDATE domenii SET nume_domeniu='".$_POST['nume_domeniu']."' WHERE id_domeniu =".$_POST['id_domeniu'];
		mysql_query($sql)or die(mysql_error());                                                                                                                                                                                            
		print "Numele domeniului a fost modificat!"; 
	}
}

if (isset($_POST['sterge_domeniu'])) 
{
		$sql = "DELETE FROM domenii WHERE id_domeniu=".$_POST['id_domeniu'];
		mysql_query($sql)or die(mysql_error());  
		print "Domeniul a fost sters!"; 
}

if (isset($_POST['modifica_autor'])) 
{
		if ($_POST['nume_autor'] == "")
	 {
		print "Nu ati introdus numele autorului";
	}
	else
	{
		$sql = "UPDATE autori SET nume_autor='".$_POST['nume_autor']."' WHERE id_autor =".$_POST['id_autor'];
		mysql_query($sql);
		print "Numele autorului a fost modificat!"; 
	} 
}
if (isset($_POST['sterge_autor'])) 
{
		$sql = "DELETE FROM autori WHERE id_autor=".$_POST['id_autor'];
		mysql_query($sql);
		print "Ajutorul a fost sters!"; 
}

if (isset($_POST['modifica_carte'])) 
{
		if ($_POST['titlu'] == "")
	 {
		print "Nu ati introdus titlul!";
	}
	else if ($_POST['descriere'] == "")
	 {
		print "Nu ati introdus descrierea!";
	}
	else if ($_POST['pret'] == "")
	 {
		print "Nu ati introdus pretul!";
	}
	else if (!is_numeric($_POST['pret']))
	 {
		print "Pretul trebuie sa fie numeric";
	}
	else
	{
		$sql = "UPDATE carti SET id_domeniu=".$_POST['id_domeniu'].", id_autor=".$_POST['id_autor'].", titlu='".$_POST['titlu']."', descriere='".$_POST['descriere']."', pret=".$_POST['pret']. " WHERE id_carte =".$_POST['id_carte'];
		mysql_query($sql) or die(mysql_error());
		print "Informatiile au fost modificat!"; 
	} 
}

if (isset($_POST['sterge_carte'])) 
{
	$sqlCarte = "DELETE FROM carti WHERE id_carte=".$_POST['id_carte'];
		mysql_query($sqlCarte);
		print "Cartea a fost stearsa din baza de date!"; 
}
?>

</body>
</html>