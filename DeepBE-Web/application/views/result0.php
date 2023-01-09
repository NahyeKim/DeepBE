<br><br>
<table id="myTable" class="tablesorter" style="font-family: Courier New">
<?php
	$Results = file_get_contents('data/' . $session_id . '/DeepCas9variants_Results.txt');
	$Rows = explode("\n", $Results);

	$HEADER = 0;
	foreach($Rows as $Row => $data)
	{
        $row_data = explode("\t", $data);
		if($HEADER == 0)
		{
			echo "<thead><tr>";
			for($i = 0; $i < count($row_data); $i++)
			{
				if($row_data[$i] == "")
				{
					continue;
				}
				elseif($i == 0)
				{
					echo "<th align=\"center\" style=\"white-space:nowrap\" colspan=\"6\">$row_data[$i]</th>";
				}
				elseif($i == 6)
				{
					echo "<th align=\"center\" style=\"white-space:nowrap\" colspan=\"9\">$row_data[$i]</th>";
				}
			}
			echo "</tr>";
			$HEADER = $HEADER + 1;
		}
		elseif($HEADER == 1)
		{
		    echo "<tr>";
			for($i = 0; $i < count($row_data); $i++)
			{
				if($row_data[$i] == "")
				{
					continue;
				}
				elseif($i == 0)
				{
					echo "<th align=\"center\" style=\"white-space:nowrap\" colspan=\"6\">$row_data[$i]</th>";
				}
				else
				{
					echo "<th align=\"center\" style=\"white-space:nowrap\">$row_data[$i]</th>";
				}
			}
			echo "</tr>";
			$HEADER = $HEADER + 1;
		}
		elseif($HEADER == 2)
		{
		    echo "<tr>";
			for($i = 0; $i < count($row_data); $i++)
			{
				echo "<th align=\"center\" style=\"white-space:nowrap\">$row_data[$i]</th>";
			}
			echo "</tr></thead><tbody>";
			$HEADER = $HEADER + 1;
		}
		elseif(count($row_data) > 5)
		{
			echo "<tr>";
			for($i = 0; $i < count($row_data); $i++)
			{
				if($i == 2 | $i == 3)
				{
					$Seq1 = substr($row_data[$i], 0, 24);
					$Seq2 = substr($row_data[$i], 24, 4);
					$Seq3 = substr($row_data[$i], 28);
					echo "<td align=\"center\">$Seq1<b>$Seq2</b>$Seq3</td>";
				}
				elseif($i < count($row_data) - 1)
				{
					echo "<td align=\"center\" style=\"white-space:nowrap\">$row_data[$i]</td>";
				}
				else
				{
					echo "<td align=\"center\" style=\"white-space:nowrap\">$row_data[$i]</td></tr>";
				}
			}
		}

	}
?>
</tbody>
</table>

<script>
	$(document).ready(function()
	{
		$("#myTable").tablesorter({
			theme: 'blue',
			headerTemplate:'{content}',
			widgets: ['zebra', 'uitheme', 'filter'],
			widgetOptions:{
				filter_columnFilters : false
			},
			stringTo: "min"
		});
	});
</script>
