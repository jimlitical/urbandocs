<?php // check for form data 

$strSymbol = @$_REQUEST["search"]; 
if(! empty($strSymbol)) 
{
	$objDBUtil = new DbUtil; 
	$db = $objDBUtil->Open(); 
	$querysymbol = $objDBUtil->DBQuotes($strSymbol);
	$query = <<<HERETOouterjoin
	SELECT symSymbol, symName, symExchange from symbols
	WHERE symSymbol={$querysymbol}
HERETOouterjoin;
	$result = $db->query($query);
	if(empty($result))
	{
		@$result->free(); 
		$objDBUtil->Close(); // Close connection
		
		$newpage = "find.php?search={$_GET['search']}";
		redirect($newpage);
	}
	
	$row = @$result->fetch_assoc();

	if(empty($row))
	{
		@$result->free(); 
		$objDBUtil->Close(); // Close connection
		
		$newpage = "find.php?search={$_GET['search']}";
		redirect($newpage);
	}
	
	if($row['symSymbol'] == NULL)
		print "<table id='symboltable'><tr><td>Please try a different symbol";
	else
		print "<table id='symboltable'><tr><td>Symbol : ".$row['symSymbol'];
	print "</td><td align='right'>".$row['symExchange']."</td></tr></table>";
	if($row['symName'] == NULL)
		print "<table id='keytable'><tr><td><b>Symbol unavailiable or invalid.</b></td></tr></table>";
	else
		print "<table id='keytable'><tr><td><b>".$row['symName']."</b></td></tr></table>";
	print "<table id='keytable'><tr>";
	print "<td class='date'>Date</td>";
	print "<td class='last'>Last</td>";
	print "<td class='change'>Change</td>";
	print "<td class='percentchange'>% Chg</td>";
	print "<td class='volume'>Volume</td>";
	print "</tr></table>";

	@$result->free(); 
	
	$querysymbol = $objDBUtil->DBQuotes($strSymbol); 
	$query = <<<HERETOouterjoin
	select symSymbol, symName, qSymbol, 
	qQuoteDateTime, qLastSalePrice, qNetChangePrice, qNetChangePct, qShareVolumeQty
	from symbols left outer join quotes on symSymbol=qSymbol
	where symSymbol={$querysymbol}
	order by qQuoteDateTime desc
HERETOouterjoin;

	$result = @$db->query($query); 
	if($result) 
	{ 
		print "<div id='overflow'>\n"; 
		print "<table id='historytable'>\n"; 

		while($row = @$result->fetch_assoc()) 
		{ 
			extract($row); // create $vars from all fields in the row 
			
			if($qQuoteDateTime == NULL) 
				$showDate = "--.--.----"; 
			else
			{
				$date = new DateTime($qQuoteDateTime);
				$showDate = $date->format('m-d-Y');
			}
			if($qLastSalePrice == NULL) $showLast = "n/a"; 
			else	$showLast = number_format($qLastSalePrice,2);
			if($qNetChangePrice == NULL) $showNetChange = "n/a"; 
			else	$showNetChange = number_format($qNetChangePrice,2);
			if($qNetChangePct == NULL) $showChangePct = "n/a"; 
			else	$showChangePct = number_format($qNetChangePct,2);
			if($qShareVolumeQty == NULL) $showVolume = "n/a"; 
			else	$showVolume = number_format($qShareVolumeQty);
			
			print "<tr class='greenbottom'>\n"; 
			print "<td width='95'>{$showDate}</td>\n";
			
			if(!empty($qLastSalePrice))
				print "<td class='last'>\${$showLast}</td>\n"; 
			else
				print "<td class='last'>{$showLast}</td>\n"; 
			
			if(substr($showNetChange,0,1) == '-')
				print "<td class='change showRed'>{$showNetChange}</td>\n";
			else if($showNetChange > 0)
				print "<td class='change showGreen'>{$showNetChange}</td>\n";
			else
				print "<td class='change'>{$showNetChange}</td>\n";
			
			if($qNetChangePct == NULL)
				print "<td class='percentchange'>{$showChangePct}</td>\n";
			else if(substr($showChangePct,0,1) == '-')
				print "<td class='percentchange showRed'>{$showChangePct}%</td>\n";
			else
				print "<td class='percentchange showGreen'>+{$showChangePct}%</td>\n";
				
			print "<td class='volume'>{$showVolume}</td>\n"; 
			print "</tr>\n";
		} 
		print "</table>\n";
	}
	
	@$result->free(); 
	$objDBUtil->Close(); // Close connection 
} 
else
{
	print "<table id='symboltable'><tr><td>Please use search to find history of a stock";
	print "</td><td align='right'></td></tr></table>";

	print "<table id='keytable'><tr><td><b>Company</b></td></tr></table>";
	print "<table id='keytable'><tr>";
	print "<td class='date'>Date</td>";
	print "<td class='last'>Last</td>";
	print "<td class='change'>Change</td>";
	print "<td class='percentchange'>% Chg</td>";
	print "<td class='volume'>Volume</td>";
	print "</tr></table>";
}
?>