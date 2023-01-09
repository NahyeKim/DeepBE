<?php
	if(!file_exists("data/$session_id/exec.txt"))
	{
		exec("python bin/Check_Model.py data/$session_id", $MODEL);
        if ($MODEL[0] == "0")
        {
            exec("printf 1 > data/$session_id/exec.txt");
            exec("python3 bin/DeepCas9variants.py data/$session_id");

            //Show results
            exec("printf 3 > data/$session_id/task.txt");
            exec("zip -j data/$session_id/Results.zip data/$session_id/DeepCas9variants_Results.txt");
        }
        else if ($MODEL[0] != "4")
        {
            exec("printf 1 > data/$session_id/exec.txt");
            exec("python3 bin/DeepBE.py data/$session_id");

            //Show results
            exec("printf 4 > data/$session_id/task.txt");
            exec("zip -j data/$session_id/Results.zip data/$session_id/*_Results.txt");
        }
        else
        {
            exec("printf 1 > data/$session_id/exec.txt");
            exec("python3 bin/DeepBE_Single.py data/$session_id");

            //Show results
            exec("printf 6 > data/$session_id/task.txt");
            exec("zip -j data/$session_id/Results.zip data/$session_id/DeepBE_Single_Result.txt");
        }
	}
	exec("date +\"%T.%3N\" > data/$session_id/END.txt");
?>
