<?php
// This script and data application were generated by AppGini 5.42
// Download AppGini for free from http://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	header("Content-type: text/javascript; charset=iso-8859-1");

	$mfk=$_GET['mfk'];
	$id=makeSafe($_GET['id']);
	$rnd1=intval($_GET['rnd1']); if(!$rnd1) $rnd1='';

	if(!$mfk){
		die('// no js code available!');
	}

	switch($mfk){

		case 'ProductID':
			if(!$id){
				?>
				$('Category<?php echo $rnd1; ?>').innerHTML='&nbsp;';
				<?php
				break;
			}
			$res = sql("SELECT `products`.`ProductID` as 'ProductID', `products`.`ProductName` as 'ProductName', IF(    CHAR_LENGTH(`suppliers1`.`CompanyName`), CONCAT_WS('',   `suppliers1`.`CompanyName`), '') as 'SupplierID', IF(    CHAR_LENGTH(`categories1`.`CategoryName`), CONCAT_WS('',   `categories1`.`CategoryName`), '') as 'CategoryID', `products`.`QuantityPerUnit` as 'QuantityPerUnit', CONCAT('$', FORMAT(`products`.`UnitPrice`, 2)) as 'UnitPrice', `products`.`UnitsInStock` as 'UnitsInStock', `products`.`UnitsOnOrder` as 'UnitsOnOrder', `products`.`ReorderLevel` as 'ReorderLevel', concat('<img src=\"', if(`products`.`Discontinued`, 'checked.gif', 'checkednot.gif'), '\" border=\"0\" />') as 'Discontinued' FROM `products` LEFT JOIN `suppliers` as suppliers1 ON `suppliers1`.`SupplierID`=`products`.`SupplierID` LEFT JOIN `categories` as categories1 ON `categories1`.`CategoryID`=`products`.`CategoryID`  WHERE `products`.`ProductID`='$id' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#Category<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['CategoryID'].' / '.$row['SupplierID']))); ?>&nbsp;');
			<?php
			break;


	}

?>