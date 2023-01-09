<br><br>

<?php
	$FILE = file_get_contents('data/' . $session_id . '/EDITOR.txt');
	$Rows = explode("\n", $FILE);
	$EDITOR = (int)explode("\t", trim($Rows[0]))[0];

    $Results = file_get_contents('data/' . $session_id . '/DeepBE_Single_Result.txt');
	$Rows = explode("\n", $Results);

	$HEADER = 0;
	$VALID = 0;
	foreach($Rows as $Row => $data){
        $row_data = explode("\t", $data);
		if($HEADER == 3){
            echo "<table id=\"single\"><tbody>";

            echo "<tr>";
            echo "<td></td><td></td><td></td><td></td><td></td>";
            echo "<td></td><td></td><td></td><td></td><td>1</td>";
            echo "<td></td><td></td><td></td><td>5</td><td></td>";
            echo "<td></td><td></td><td></td><td>10</td><td></td>";
            echo "<td></td><td></td><td></td><td>15</td><td></td>";
            echo "<td></td><td></td><td></td><td>20</td><td></td>";
            echo "<td></td><td></td><td></td><td></td><td></td>";
            echo "<td></td><td></td><td></td><td></td><td></td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td></td><td></td><td></td><td></td><td></td>";
            echo "<td></td><td></td><td></td><td></td><td>|</td>";
            echo "<td></td><td></td><td></td><td>|</td><td></td>";
            echo "<td></td><td></td><td></td><td>|</td><td></td>";
            echo "<td></td><td></td><td></td><td>|</td><td></td>";
            echo "<td></td><td></td><td></td><td>|</td><td></td>";
            echo "<td></td><td></td><td></td><td></td><td></td>";
            echo "<td></td><td></td><td></td><td></td><td></td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td></td><td></td><td></td><td></td><td></td>";
            echo "<td></td><td></td><td></td><td></td>";
            for($i = 0; $i < 20; $i++){
                $base = substr($row_data[4], $i, 1);
                echo "<td>$base</td>";
			}
			echo "<td></td>";
			echo "<td></td><td></td><td></td><td></td><td></td>";
			echo "<td></td><td></td><td></td><td></td><td></td>";
			echo "</tr>";

            echo "<tr>";
            echo "<td></td><td></td><td></td><td></td><td></td>";
            for($i = 0; $i < 30; $i++){
                $base = substr($row_data[2], $i, 1);
                if (($EDITOR == 0 | $EDITOR == 1) & $base == "A" & ($i + 1 > 6 & $i < 6 + 8)){
                    echo "<td style=\"background-color:#FFF59D\">$base</td>";
                }
                else if (($EDITOR == 2) & $base == "C" & ($i + 1 > 7 & $i < 7 + 5)){
                    echo "<td style=\"background-color:#EF9A9A\">$base</td>";
                }
                else if (($EDITOR == 3) & $base == "C" & ($i + 1 > 6 & $i < 6 + 7)){
                    echo "<td style=\"background-color:#EF9A9A\">$base</td>";
                }
                else if (($EDITOR == 4 | $EDITOR == 5 | $EDITOR == 6) & $base == "C" & ($i + 1 > 7 & $i < 7 + 5)){
                    echo "<td style=\"background-color:#EF9A9A\">$base</td>";
                }
                else{
                    echo "<td>$base</td>";
                }
			}
			echo "<td></td><td></td><td></td><td></td><td style=\"white-space:nowrap\">Base edited outcomes (%)</td>";
			echo "</tr>";
        }

		else if($HEADER > 3 & count($row_data) > 5){
		    $VALID = 1;

            echo "<tr>";
            echo "<td></td><td></td><td></td><td></td><td></td>";
            for($i = 0; $i < 30; $i++){
                $base = substr($row_data[5], $i, 1);
                if ($base == "a"){
                    echo "<td style=\"background-color:#FFF59D; color:black\">$base</td>";
                }
                else if ($base == "c"){
                    echo "<td style=\"background-color:#EF9A9A; color:black\">$base</td>";
                }
                else if ($base == "g"){
                    echo "<td style=\"background-color:#90CAF9; color:black\">$base</td>";
                }
                else if ($base == "t"){
                    echo "<td style=\"background-color:#A5D6A7; color:black\">$base</td>";
                }
                else{
                    echo "<td>$base</td>";
                }
			}
			echo "<td></td><td></td><td></td><td></td><td style=\"text-align:right; color:black\">$row_data[7]</td>";
			echo "</tr>";
		}
		$HEADER = $HEADER + 1;
	}

	if ($VALID == 1){
	    echo "</tbody></table>";
	}
	else{
	    echo "</tbody></table><br><br>";
	    echo "No valid base edit outcome sequences are available.";
	}
?>


<br><br>