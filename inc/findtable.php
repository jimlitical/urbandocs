<?php
$strSymbol = @$_REQUEST["search"]; 
if(! empty($strSymbol)) 
{
	$objDBUtil = new DbUtil; 
	$db = $objDBUtil->Open(); 
	$querysymbol = $objDBUtil->DBFind($strSymbol);
	$query = <<<HERETOouterjoin
	SELECT symName, symSymbol FROM symbols
	WHERE symName LIKE '{$querysymbol}' or symSymbol LIKE '{$querysymbol}'
	ORDER BY symName ASC
	LIMIT 500
HERETOouterjoin;
	
	$result = $db->query($query);
	
	if($result)
	{
		$rowNum = $result->num_rows;
		
		if($rowNum == 0)
		{
			print "<h2 class='request'>\"{$strSymbol}\" did not return any values. </h2>";
			print "<a href='{$wherefrom}?search='><h2 id='backbtn'>Back</h2></a>";
		}
		else
		{
			print "<h2 class='request'>Click 'quote' or 'history' from the companies below. </h2>";
			print "<a href='{$wherefrom}?search={$strSymbol}'><h2 id='backbtn'>Back</h2></a>";
		}
		
		print "<table id='lookkeytable'> <tr>";
		print "<td class='lookone'><b>Company</b></td>";
		print "<td class='looktwo'><b>Symbol</b></td>";
		print "<td align='right'><b>{$rowNum} entries</b></td></tr></table>";
		print "<div id='overflow'>";
		print "<table id='findtable'>";
		while($row = @$result->fetch_assoc())
		{
			extract($row);
			
			print "<tr class='greenbottom'>";
			print "<td class='lookone'>{$symName}</td>";
			print "<td class='looktwo'>{$symSymbol}</td>";
			print "<td class='lookthree'><a href='Quote.php?search={$symSymbol}'>Quote</a></td>";
			print "<td class='lookthree'><a href='history.php?search={$symSymbol}'>History</a></td></tr>";
		}
		print "</table></div>";
	}
	
	@$result->free();
	$objDBUtil->Close(); // Close connection 
}
else
{	
	print "<h2 class='request'>Please enter a symbol in the search</h2>";
	print "<a href='{$wherefrom}?search={$strSymbol}'><h2 id='backbtn'>Back</h2></a>";
	print "<table id='lookkeytable'> <tr>";
	print "<td class='lookone'><b>Company</b></td>";
	print "<td class='looktwo'><b>Symbol</b></td>";
	print "<td align='right'><b>0 entries</b></td></tr></table>";
}
?>