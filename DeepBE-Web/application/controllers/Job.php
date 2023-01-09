<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Job extends CI_Controller
{
	function  __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}

	function init($command)
	{
		if(!$this->input->is_cli_request())
		{
			redirect('/');
			return;
		}
	}

	function create()
	{
        $index_page = base_url();
		$session_id = session_id();
		$target_dir = "data/$session_id/";

		if(file_exists($target_dir))
		{
			session_regenerate_id();
			$session_id = session_id();
			$target_dir = "data/$session_id/";
			mkdir($target_dir);
		}
		else
		{
			mkdir($target_dir);
		}
	}

	function upload()
	{
        $index_page = base_url();
		$session_id = session_id();
		$target_dir = "data/$session_id/";

		if(file_exists($target_dir))
		{
			session_regenerate_id();
			$session_id = session_id();
			$target_dir = "data/$session_id/";
			mkdir($target_dir);
		}
		else
		{
			mkdir($target_dir);
		}

		$tmp_file = $_FILES['input_file']['tmp_name'];
        if(is_uploaded_file($tmp_file))
        {
            $allowed_type = array('zip');
            $input_info = pathinfo($_FILES['input_file']['name']);
            $target_file = $target_dir.basename($_FILES['input_file']['name']);
            $MODE = 1;

			if(in_array($input_info['extension'], $allowed_type))
			{
				move_uploaded_file($tmp_file, $target_file);
				$file_list = array();
				$zip = zip_open($target_file);
				if(is_resource($zip))
				{
					while(TRUE)
					{
						$entry = zip_read($zip);
						if($entry == FALSE) break;
						$file_name = zip_entry_name($entry);
						if(preg_match("/\.fasta$/i", $file_name)) $file_list[] = $file_name;
						elseif(preg_match("/\.fa$/i", $file_name)) $file_list[] = $file_name;
					}
					if(empty($file_list))
					{
                        array_map('unlink', glob("$target_dir/*.*"));
                        rmdir($target_dir);
						echo "<script type='text/javascript'>alert('The .zip file does not contain .fasta or .fa file.'); window.location.replace('$index_page')</script>";
					}
					elseif(count($file_list) > 1)
					{
                        array_map('unlink', glob("$target_dir/*.*"));
                        rmdir($target_dir);
						echo "<script type='text/javascript'>alert('The .zip file should contain single .fasta or .fa file.'); window.location.replace('$index_page')</script>";
					}
					else
					{
						chdir($target_dir);
						exec("find -name '*.zip' | sed 's/\.\///'", $input_list); 
						$input_file = $input_list[0];
						exec("unzip $input_file");
		
						exec("find -regex '.*\.\(fasta\|fa\)' | sed 's/\.\///'", $file_list);
						$file_name = $file_list[0];
                        exec("mv $file_name input_original.fasta");
                        chdir("../../");
					}
				}
				else
				{
                    array_map('unlink', glob("$target_dir/*.*"));
                    rmdir($target_dir);
					echo "<script type='text/javascript'>alert('Invalid file type.'); window.location.replace('$index_page')</script>";
				}
			}
			else
			{
                array_map('unlink', glob("$target_dir/*.*"));
                rmdir($target_dir);
				echo "<script type='text/javascript'>alert('Invalid file type.'); window.location.replace('$index_page')</script>";
			}
		}
		else
		{
            $FASTA = $this->input->post('ENTER_FASTA');
            $TARGET = $this->input->post('ENTER_TARGET');
            $GUIDE = $this->input->post('Guide');
            if($FASTA != '')
			{
			    $MODE = 1;
			    exec("date +\"%T.%3N\" > $target_dir/START.txt");
				exec("printf '$FASTA' > $target_dir/input_original.fasta");
			}
			else if($GUIDE != '')
			{
			    $MODE = 0;
			    exec("date +\"%T.%3N\" > $target_dir/START.txt");
				exec("printf '$GUIDE' > $target_dir/input_original.txt");
			}
			else
            {
                array_map('unlink', glob("$target_dir/*.*"));
                rmdir($target_dir);
                if ($TARGET != "")
                {
                    echo "<script type='text/javascript'>alert('Enter a target sequence and select a guide sequence.'); window.location.replace('$index_page');</script>";
                }
                else
                {
                    echo "<script type='text/javascript'>alert('Enter FASTA text or upload a FASTA file.'); window.location.replace('$index_page');</script>";
                }
                return;
            }  
        }

        if ($MODE == 0)
        {
            exec("printf '4\n' > $target_dir/MODEL.txt");

            $EDITOR = $this->input->post('EDITOR');
            exec("printf '$EDITOR\n' > $target_dir/EDITOR.txt");

            $PAM = $this->input->post('PAM');
            exec("printf '$PAM\n' > $target_dir/PAM.txt");

            exec("python bin/Check_Single.py $target_dir");
            exec("printf 0 > $target_dir/task.txt");
            $this->load->view('status', array('session_id' => $session_id));
            $argv = array('session_id' => $session_id);
        }
        else
        {
            $MODEL = $this->input->post('MODEL');
            exec("printf '$MODEL\n' > $target_dir/MODEL.txt");

            exec("python bin/Check_FASTA.py $target_dir", $isFASTA);
            if ($isFASTA[0] == "1")
            {
                exec("printf 0 > $target_dir/task.txt");
                $this->load->view('status', array('session_id' => $session_id));
                $argv = array('session_id' => $session_id);
            }
            else
            {
                echo "<script type='text/javascript'>alert('$isFASTA[0]'); window.location.replace('$index_page')</script>";
                array_map('unlink', glob("$target_dir/*.*"));
                rmdir($target_dir);
                return;
            }
        }
	}

	function run($argv)
	{
		$session_id = $argv['session_id'];
	}

	function user($session_id)
	{		
		exec("python3 bin/Check_status.py data/$session_id", $task);
		$data = array('session_id' => $session_id, 'task' => $task);
		echo json_encode($data);
	}

	function result0($session_id)
	{
		$this->load->view('result0', array('session_id' => $session_id));
	}

	function result1($session_id)
	{
		$this->load->view('result1', array('session_id' => $session_id));
	}

	function result2($session_id)
	{
		$this->load->view('result2', array('session_id' => $session_id));
	}

	function change_status($argv)
	{
			$tokens = explode("-", $argv);
			$index = $tokens[0];
			$sample = $tokens[1];
			$session_id = $tokens[2];
			exec("printf 5 > data/$session_id/task.txt");
			exec("printf $index > data/$session_id/index.txt");
			exec("printf $sample > data/$session_id/sample.txt");
			$this->load->view('status', array('session_id' => $session_id));
	}

    function change_status_description($argv)
    {
            $tokens = explode("-", $argv);
            $status = $tokens[0];
            $session_id = $tokens[1];
            $this->load->view('status', array('session_id' => $session_id));
            exec("printf $status > data/$session_id/task.txt");
    }

    function description_0($session_id)
    {
            $this->load->view('description', array('session_id' => $session_id));
            exec("printf 3 > data/$session_id/task.txt");
    }

    function description_1($session_id)
    {
            $this->load->view('description', array('session_id' => $session_id));
            exec("printf 4 > data/$session_id/task.txt");
    }

    function description_2($session_id)
    {
            $this->load->view('description', array('session_id' => $session_id));
            exec("printf 6 > data/$session_id/task.txt");
    }

	function sample_result($session_id)
	{
			$this->load->view('sample_result', array('session_id' => $session_id));
			exec("printf 4 > data/$session_id/task.txt");
	}

	function exec($session_id)
	{
		$this->load->view('exec', array('session_id' => $session_id));
	}
}
