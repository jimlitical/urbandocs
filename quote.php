<?php require "inc/header.php"?>
<?php
	$objDBUtil = new DbUtil; 
	$strSymbol = @$_REQUEST["search"]; 
	if(!empty($strSymbol)) 
	{ // process the form 

		// Establish dbserver connection and default database 
		$db = $objDBUtil->Open(); 
		
		$querysymbol = $objDBUtil->DBQuotes($strSymbol); 
		$query = <<<HERETOouterjoin
		select symSymbol, symName, symMarketCap, symExchange,
		qQuoteDateTime, qLastSalePrice, qNetChangePrice, qNetChangePct, qTodaysLow, qTodaysHigh, qBidPrice, qAskPrice,
		q52WeekHigh, q52WeekLow, qShareVolumeQty, qPreviousClosePrice, qCurrentPERatio, qEarningsPerShare, qCashDividendAmount,
		qTotalOutstandingSharesQty, qCurrentYieldPct
		from symbols left outer join quotes on symSymbol=qSymbol
		where symSymbol={$querysymbol}
		order by qQuoteDateTime desc
		limit 1
HERETOouterjoin;

		$result = $db->query($query); 

		if($result)
		{
			$row = @$result->fetch_assoc();
			if($result->num_rows >= 1){
				extract($row);
				if(!empty($qQuoteDateTime))
				{
					$date = new DateTime($qQuoteDateTime);
					$showDate = $date->format('m-d-Y');
				}
				else
				{
					$showDate = "";
				}
			}
		}
		
		if(empty($row))
		{
			@$result->free(); 
			$objDBUtil->Close(); // Close connection
			
			$newpage = "find.php?search={$_GET['search']}";
			redirect($newpage);
		}
		else
		{
			print "<table id='symboltable'><tr><td>Symbol : ".$row['symSymbol'];
			print "<td align='right'>{$showDate}</td>";
			print "<td align='right'>".$row['symExchange']."</td></tr></table>";
			print "<table id='keytable'><tr><td><b>".$row['symName']."	</b></td></tr></table>";
			if($row['qLastSalePrice'] != NULL)
				print "<table id='quotetable'><tr class='greenbottom'><td style='width: 145px;'>Last</td><td>".number_format($row['qLastSalePrice'],2)."</td>";
			else
				print "<table id='quotetable'><tr class='greenbottom'><td style='width: 145px;'>Last</td><td>n/a</td>";
			if($row['qPreviousClosePrice'] != NULL)
				print "<td style='width: 145px;'>Prev Close</td><td align='right'>".number_format($row['qPreviousClosePrice'],2)."</td></tr>";
			else
				print "<td style='width: 145px;'>Prev Close</td><td align='right'>n/a</td></tr>";
			
			print "<tr class='greenbottom'><td style='width: 145px;'>Change</td><td>";
			if($row['qNetChangePrice'] != NULL)
				if($row['qNetChangePrice'] > 0)
				{
					print "+".number_format($row['qNetChangePrice'],2)."</td>";
				}
				else
				{
					print number_format($row['qNetChangePrice'],2)."</td>";
				}
			else
				print "n/a</td>";
			if($row['qBidPrice'] != NULL)
				print "<td style='width: 145px;'>Bid</td><td align='right'>".number_format($row['qBidPrice'],2)."</td></tr>";
			else
				print "<td style='width: 145px;'>Bid</td><td align='right'>n/a</td></tr>";
			
			print "<tr class='greenbottom'><td style='width: 145px;'>%Change</td><td>";
			if($row['qNetChangePct'] != NULL)
				if($row['qNetChangePct'] >= 0)
				{
					print "+".number_format($row['qNetChangePct'],2)." %</td>";
				}
				else
				{
					print $row['qNetChangePct']." %</td>";
				}
			else
				print "n/a</td>";
			
			if($row['qAskPrice'] != NULL)
				print "<td style='width: 145px;'>Ask</td><td align='right'>".number_format($row['qAskPrice'],2)."</td></tr>";
			else
				print "<td style='width: 145px;'>Ask</td><td align='right'>n/a</td></tr>";
			if($row['qTodaysHigh'] != NULL)
				print "<tr class='greenbottom'><td style='width: 145px;'>High</td><td>".number_format($row['qTodaysHigh'],2)."</td>";
			else
				print "<tr class='greenbottom'><td style='width: 145px;'>High</td><td>n/a</td>";
			if($row['q52WeekHigh'] != NULL)
				print "<td style='width: 145px;'>52 Week High</td><td align='right'>".number_format($row['q52WeekHigh'],2)."</td></tr>";
			else
				print "<td style='width: 145px;'>52 Week High</td><td align='right'>n/a</td></tr>";
			if($row['qTodaysLow'] != NULL)
				print "<tr class='greenbottom'><td style='width: 145px;'>Low</td><td>".number_format($row['qTodaysLow'],2)."</td>";
			else
				print "<tr class='greenbottom'><td style='width: 145px;'>Low</td><td>n/a</td>";
			
			if($row['q52WeekLow'] != NULL)
				print "<td style='width: 145px;'>52 Week Low</td><td align='right'>".number_format($row['q52WeekLow'],2)."</td></tr>";
			else
				print "<td style='width: 145px;'>52 Week Low</td><td align='right'>n/a</td></tr>";
			if($row['qShareVolumeQty'])
				print "<tr><td class='greenbottom' style='width: 145px;'>Daily Volume</td><td class='greenbottom'>".number_format($row['qShareVolumeQty'])."</td></tr></table>";
			else
				print "<tr><td class='greenbottom' style='width: 145px;'>Daily Volume</td><td class='greenbottom'>n/a</td></tr></table>";
			
			print "<table id='fundamentalkeytable'><tr><td><b>Fundamentals</b></td></tr></table>";
			print "<table id='fundamentaltable'>";
			if($row['qCurrentPERatio'] != NULL)
				print "<tr class='greenbottom'><td class='fundFirst'>PE Ratio</td><td class='fundSecond'>".number_format($row['qCurrentPERatio'],2)."</td>";
			else
				print "<tr class='greenbottom'><td class='fundFirst'>PE Ratio</td><td class='fundSecond'>n/a</td>";
			if($row['symMarketCap'] != NULL)
				print "<td class='fundThird'>Market Cap.</td><td class='fundFourth'>".number_format($row['symMarketCap'],1)." Mil</td></tr>";
			else
				print "<td class='fundThird'>Market Cap.</td><td class='fundFourth'>n/a</td></tr>";
			if($row['qEarningsPerShare'] != NULL)
				print "<tr class='greenbottom'><td class='fundFirst'>Earnings/share</td><td class='fundSecond'>".number_format($row['qEarningsPerShare'],3)."</td>";
			else
				print "<tr class='greenbottom'><td class='fundFirst'>Earnings/share</td><td class='fundSecond'>n/a</td>";
			if($row['qTotalOutstandingSharesQty'] != NULL)
				print "<td class='fundThird'># Shrs Out.</td> <td class='fundFourth'>".number_format($row['qTotalOutstandingSharesQty'])."</td></tr>";
			else
				print "<td class='fundThird'># Shrs Out.</td> <td class='fundFourth'>n/a</td></tr>";
			if($row['qCashDividendAmount'] != NULL)
				print "<tr class='greenbottom'><td class='fundFirst'>Div/Share</td><td class='fundSecond'>".number_format($row['qCashDividendAmount'],2)."</td>";
			else
				print "<tr class='greenbottom'><td class='fundFirst'>Div/Share</td><td class='fundSecond'>n/a</td>";
			if($row['qCurrentYieldPct'] != NULL)
				print "<td class='fundThird'>Div. Yield</td><td class='fundFourth'>".number_format($row['qCurrentYieldPct'],2)."%</td></tr></table>";
			else
				print "<td class='fundThird'>Div. Yield</td><td class='fundFourth'>n/a</td></tr></table>";
				
		}
	}
	else
	{		
		print "<table id='symboltable'><tr><td>Please enter a symbol in search to find a quote";
		print "<td align='center'></td>";
		print "<td align='right'></td>";
		print "<td align='right'></td></tr></table>";
		print "<td align='right'></td></tr></table>";

		print "<table id='keytable'><tr><td><b>Symbol</b></td></tr></table>";
		print "<table id='quotetable'><tr class='greenbottom'><td>Last</td><td></td>";
		print "<td>Prev Close</td><td align='right'></td></tr>";
		print "<tr class='greenbottom'><td>Change</td><td></td>";
		print "<td>Bid</td><td align='right'></td></tr>";
		print "<tr class='greenbottom'><td>%Change</td><td></td>";
		print "<td>Ask</td><td align='right'></td>";
		print "<tr class='greenbottom'><td>High</td><td></td>";
		print "<td>52 Week High</td><td align='right'></td></tr>";
		print "<tr class='greenbottom'><td>Low</td><td></td>";
		print "<td>52 Week Low</td><td align='right'></td></tr>";
		print "<tr class='greenbottom'><td>Daily Volume</td><td></td></tr></table>";

		print "<table id='fundamentalkeytable'><tr><td><b>Fundamentals</b></td></tr></table>";
		print "<table id='fundamentaltable'><tr class='greenbottom'>";
		print "<td>PE Ratio</td><td></td>";
		print "<td align='center'>Market Cap.</td><td align='right'></td></tr>";
		print "<tr class='greenbottom'><td>Earnings/share</td><td></td>";
		print "<td align='center'># Shrs Out.</td><td align='right'></td></tr>";
		print "<tr class='greenbottom'><td>Div/Share</td><td></td>";
		print "<td align='center'>Div. Yield</td><td align='right'></td></tr></table>";
		
		if(!empty($_GET['search']))
		{
			@$result->free(); 
			$objDBUtil->Close(); // Close connection 
			$newpage = "find.php?search='{$_GET['search']}'";
			redirect($newpage);
		}
	}

	@$result->free(); 
	$objDBUtil->Close(); // Close connection 
?>

</body>
</html>

<?php
ob_end_flush();
?>