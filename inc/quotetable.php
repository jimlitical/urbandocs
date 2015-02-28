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
			print "<table id='quotetable'><tr class='greenbottom'><td>Last</td><td>".number_format($row['qLastSalePrice'],2)."</td>";
			print "<td>Prev Close</td><td align='right'>".number_format($row['qPreviousClosePrice'],2)."</td></tr>";
			print "<tr class='greenbottom'><td>Change</td><td>";
				if($row['qNetChangePrice'] > 0)
				{
					print "+".number_format($row['qNetChangePrice'],2)."</td>";
				}
				else
				{
					print number_format($row['qNetChangePrice'],2)."</td>";
				}
			print "<td>Bid</td><td align='right'>".number_format($row['qBidPrice'],2)."</td></tr>";
			print "<tr class='greenbottom'><td>%Change</td><td>";
				if($row['qNetChangePct'] >= 0)
				{
					print "+".number_format($row['qNetChangePct'],2)." %</td>";
				}
				else
				{
					print $row['qNetChangePct']." %</td>";
				}
			
			print "<td>Ask</td><td align='right'>".number_format($row['qAskPrice'],2)."</td></tr>";
			print "<tr class='greenbottom'><td>High</td><td>".number_format($row['qTodaysHigh'],2)."</td>";
			print "<td>52 Week High</td><td align='right'>".number_format($row['q52WeekHigh'],2)."</td></tr>";
			print "<tr class='greenbottom'><td>Low</td><td>".number_format($row['qTodaysLow'],2)."</td>";
			print "<td>52 Week Low</td><td align='right'>".number_format($row['q52WeekLow'],2)."</td></tr>";
			print "<tr><td class='greenbottom'>Daily Volume</td><td class='greenbottom'>".number_format($row['qShareVolumeQty'])."</td></tr></table>";
				
			
			print "<table id='fundamentalkeytable'><tr><td><b>Fundamentals</b></td></tr></table>";
			print "<table id='fundamentaltable'>";
			print "<tr class='greenbottom'><td>PE Ratio</td><td>".number_format($row['qCurrentPERatio'],2)."</td>";
			print "<td align='center'>Market Cap.</td><td align='right'>".number_format($row['symMarketCap'],1)." Mil</td></tr>";
			print "<tr class='greenbottom'><td>Earnings/share</td><td>".number_format($row['qEarningsPerShare'],3)."</td>";
			print "<td align='center'># Shrs Out.</td> <td align='right'>".number_format($row['qTotalOutstandingSharesQty'])."</td></tr>";
			print "<tr class='greenbottom'><td>Div/Share</td><td>".number_format($row['qCashDividendAmount'],2)."</td>";
			print "<td align='center'>Div. Yield</td><td align='right'>".number_format($row['qCurrentYieldPct'],2)."%</td></tr></table>";
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