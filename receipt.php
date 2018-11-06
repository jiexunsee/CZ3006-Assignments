<!DOCTYPE html>
<html>

<head>
	<title>Receipt from Friendly Fruit Stall</title>
</head>

<body>
	<?php
		$name = $_POST["name"];
		$apple = $_POST["apples"];
		$orange = $_POST["oranges"];
		$banana = $_POST["bananas"];
		$payment = $_POST["payment"];
		if ($apple == "") $apple = 0;
		if ($orange == "") $orange = 0;
		if ($banana == "") $banana = 0;
	
		$total = ($apple * 0.69 + $orange * 0.59 + $banana * 0.39);

		// read file to get current total orders
		$filename = 'order.txt';
		$file = @fopen($filename, 'r');
		$fileContents = @file($filename);

		$prevApples = 0;
		$prevOranges = 0;
		$prevBananas = 0;
		if ($fileContents !== FALSE){ // if the file already exists and we managed to read it
			// find previous counts using regular expressions
			preg_match("/Total number of apples: (\d+)/", $fileContents[0], $prevApples);
			preg_match("/Total number of oranges: (\d+)/", $fileContents[1], $prevOranges);
			preg_match("/Total number of bananas: (\d+)/", $fileContents[2], $prevBananas);
			
			//first array value
			$prevApples = intval($prevApples[1]);
			$prevOranges = intval($prevOranges[1]);
			$prevBananas = intval($prevBananas[1]);

			fclose($file);
		}

		//computing new fruit counts
		$newApples = $prevApples + $apple;
		$newOranges = $prevOranges + $orange;
		$newBananas = $prevBananas + $banana;
		
		
		// write new fruit counts to file
		$file = fopen($filename, 'w');
		fwrite($file, "Total number of apples: $newApples \r\n");
		fwrite($file, "Total number of oranges: $newOranges \r\n");
		fwrite($file, "Total number of bananas: $newBananas \r\n");
		
		//closing the file
		fclose($file);
	?>
		<!--Table for receipt-->
		<table border="border" width="300">
			<caption>
				<b>
				<p style="font-size:20px">Friendly Fruit Stall</p>
				<p>Receipt for: <?php print $name; ?></p>
				<p>Paid using <?php print $payment; ?></p>
				</b>
			</caption>
			<br>
			<tr>
				<th width="140">Fruit</th>
				<th width="80">Quantity</th>
				<th width="80">Cost</th>
			</tr>
			<tr>
				<th>Apples</th>
				<td align="center">
					<?php print ("$apple"); ?>
				</td>
				<td align="center">
					<?php print ("$".number_format($apple * 0.69, 2)); ?>
				</td>
			</tr>
			<tr>
				<th>Oranges</th>
				<td align="center">
					<?php print ("$orange"); ?>
				</td>
				<td align="center">
					<?php print ("$".number_format($orange * 0.59, 2)); ?>
				</td>
			</tr>
			<tr>
				<th>Bananas</th>
				<td align="center">
					<?php print ("$banana"); ?>
				</td>
				<td align="center">
					<?php print ("$".number_format($banana * 0.39, 2)); ?>
				</td>
			</tr>
			<tr>
				<th colspan=2>Total</th>
				<td align="center">
					<?php print ("$".number_format($total, 2)); ?>
				</td>
			</tr>
		</table>

</body>

</html>