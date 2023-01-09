<br><br>
<table id="myTable" class="tablesorter" style="font-family: Courier New">

<?php
	$FILE = file_get_contents('data/' . $session_id . '/MODEL.txt');
	$Rows = explode("\n", $FILE);
	$MODEL = (int)explode("\t", trim($Rows[0]))[0];

	$FILE = file_get_contents('data/' . $session_id . '/index.txt');
	$Rows = explode("\n", $FILE);
	$Index = (int)explode("\t", trim($Rows[0]))[0];

	$FILE = file_get_contents('data/' . $session_id . '/sample.txt');
	$Rows = explode("\n", $FILE);
	$Sample = explode("\t", trim($Rows[0]))[0];

    $BASE_MODEL_NAMES = array("SpCas9-NG", "SpCas9", "VRQR variant", "SpCas9-NG", "SpCas9-NRRH", "SpCas9-NRTH", "SpCas9-NRCH", "SpG", "SpRY", "Sc++");
    if($MODEL == 1)
    {
        $EDITOR_NAMES = array("ABE8e(V106W)", "ABE8.17m+V106W");
        $NUM = 2;
    }
    elseif($MODEL == 2)
    {
        $EDITOR_NAMES = array("YE1-BE4max", "SsAPOBEC3B");
        $NUM = 2;
    }
    else
    {
        $EDITOR_NAMES = array("CGBE1", "miniCGBE1", "APOBEC-nCas9-Ung");
        $NUM = 3;
    }
    $BASE_MODEL = $BASE_MODEL_NAMES[($Index - ($Index % $NUM)) / $NUM];
    $EDITOR_NAME = $EDITOR_NAMES[$Index % $NUM];

    if($Index < $NUM)
    {
        $Results = file_get_contents('data/' . $session_id . '/DeepNG-BE_' . $BASE_MODEL . '_' . $EDITOR_NAME . '_Results.txt');
    }
    else
    {
        $Results = file_get_contents('data/' . $session_id . '/DeepBE_' . $BASE_MODEL . '_' . $EDITOR_NAME . '_Results.txt');
    }
	$Rows = explode("\n", $Results);

	$HEADER = 0;
	$COUNT = 0;
	foreach($Rows as $Row => $data)
	{
        $row_data = explode("\t", $data);
		if($HEADER == 0 or $HEADER == 1)
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
					echo "<th align=\"center\" style=\"white-space:nowrap\" colspan=\"7\">$row_data[$i]</th>";
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
		elseif(count($row_data) > 5 && $row_data[3] == $Sample)
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
