<br><br>
<table id="myTable" class="tablesorter" style="font-family: Courier New">
<?php
	$FILE = file_get_contents('data/' . $session_id . '/MODEL.txt');
	$Rows = explode("\n", $FILE);
	$MODEL = (int)explode("\t", trim($Rows[0]))[0];

	$Results = file_get_contents('data/' . $session_id . '/DeepBE_Results.txt');
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
				    if($MODEL == 1 or $MODEL == 2)
				    {
				        echo "<th align=\"center\" style=\"white-space:nowrap\" colspan=\"2\">$row_data[$i]</th>";
				    }
				    else
				    {
				        echo "<th align=\"center\" style=\"white-space:nowrap\" colspan=\"3\">$row_data[$i]</th>";
				    }
				}
				else
				{
			        if($MODEL == 1 or $MODEL == 2)
				    {
				        echo "<th align=\"center\" style=\"white-space:nowrap\" colspan=\"18\">$row_data[$i]</th>";
				    }
				    else
				    {
				        echo "<th align=\"center\" style=\"white-space:nowrap\" colspan=\"27\">$row_data[$i]</th>";
				    }
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
				elseif($MODEL == 1 or $MODEL == 2)
				{
					echo "<th align=\"center\" style=\"white-space:nowrap\" colspan=\"2\">$row_data[$i]</th>";
				}
				else
				{
					echo "<th align=\"center\" style=\"white-space:nowrap\" colspan=\"3\">$row_data[$i]</th>";
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
				elseif($i < 6)
				{
					echo "<td align=\"center\" style=\"white-space:nowrap\">$row_data[$i]</td>";
				}
				else
				{
					$index = $i - 6;
					$SEQ = $row_data[3];
					$argv = "$index-$SEQ-$session_id";
					if($row_data[$i] == "No activity")
					{
					    echo "<td align=\"center\" style=\"white-space:nowrap\">$row_data[$i]</td>";
				    }
				    else
				    {
				        echo "<td align=\"center\" style=\"white-space:nowrap\"><a href=\"/DeepBE-Web/job/change_status/$argv\"><font color=\"red\">$row_data[$i]</font></a></td>";
				    }
				}
			}
			echo "</tr>";
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
