<?php
include("autorizare.php");
include("admin_top.php");
print "<h1>Comenzi</h1>";
if (isset($_POST['comanda_onorata'])) 
{
		$sql = "UPDATE tranzactii SET comanda_onorata=1 WHERE id_tranzactie='{$_POST['id_tranzactie']}'";
		// echo $sql;
		// die;
		mysql_query($sql) or die(mysql_error());
		print "Comanda a fost onorata!"; 
}

if (isset($_POST['anuleaza_comanda'])) 
{
		$sqlTranzactii = "DELETE FROM tranzactii WHERE id_tranzactie='".$_POST['id_tranzactie'];
		mysql_query($sqlTranzactii) or die(mysql_error());
		print "Comanda a fost anulata!"; 
		$sqlCarti = "DELETE FROM vanzari WHERE id_tranzactie='".$_POST['id_tranzactie'];
		mysql_query($sqlCarti);
		print "Comanda a fost anulata!"; 
}
?>
</body>
</html>