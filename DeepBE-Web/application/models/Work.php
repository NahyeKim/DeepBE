<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Work extends CI_Model
{
	private $sys_dir;

	function  __construct()
	{
		parent::__construct();

		$this->load->model('Status');
		$this->sys_dir = getcwd();

	}

	function init($command)
	{
		$worker = new GearmanWorker();
		$worker->addServer();

		switch($command) // if there is change in $command, modify 'controllers/Job.php'
		{
			case 'SUBS':
				$func_name = 'task_subs';
				break;
			case 'HOMO':
				$func_name = 'task_homo';
				break;
			default:
				echo "Invalid command.\n";
				return;
		}

		echo "[START] ".date('Y-m-d H:i:s')."\n";
		echo "\033[1m"."[GearmanWorker::$command] "."\033[0m"."Waiting...\n";
		$worker->addFunction($command, "Work::$func_name");
		while($worker->work());
	}

	function run($command, $session_id)
	{
		$client = new GearmanClient();
		$client->addServer();

		$response = $client->doBackground($command, $session_id);
		return ($response == TRUE) ? TRUE : FALSE;
	}

	static function task_subs($job)
	{
		$CI =& get_instance();
		$sys_dir = $CI->Work->sys_dir;

		$session_id = $job->workload();
		$k_1 = ($CI->Status->select($session_id)) ? $CI->Status->select($session_id)->k_1 : 5;
		chdir("$sys_dir/data/$session_id");

		exec("find -regex '.*\.\(fasta\|fastq\)' | sed 's/\.\///'", $file_list);
		$file_name = $file_list[0];
		$find = array('/\.fasta/', '/\.fastq/');
		$replace = array('', '');
		$stub_name = preg_replace($find, $replace, $file_name);

		$CI->Status->update($session_id, 1, 1);
		exec("$sys_dir/bin/DUDE-Seq-1 -k $k_1 -i $file_name -o ${stub_name}_S${k_1}.fasta");
		$CI->Status->update($session_id, 1, 2);

		$CI->Work->compress($session_id);
		$result = "${stub_name}_S${k_1}.fasta";
		$CI->Work->prinseq($session_id, $result);
	}

	static function task_homo($job)
	{
		$CI =& get_instance();
		$sys_dir = $CI->Work->sys_dir;
		$pi_path = "$sys_dir/bin/Titanium.pi";

		$session_id = $job->workload();
		$k_2 = ($CI->Status->select($session_id)) ? $CI->Status->select($session_id)->k_2 : 2;
		$k_1 = ($CI->Status->select($session_id)) ? $CI->Status->select($session_id)->k_1 : 5;
		chdir("$sys_dir/data/$session_id");
		
		exec("find -regex '.*\.\(dat\)' | sed 's/\.\///'", $file_list);
		$file_name = $file_list[0];
		$find = array('/\.dat/');
		$replace = array('');
		$stub_name = preg_replace($find, $replace, $file_name);

		exec("perl $sys_dir/bin/DAT_INT.pl < ${stub_name}.dat > ${stub_name}.int");
		$CI->Status->update($session_id, 2, 1);
		exec("$sys_dir/bin/DUDE-Seq-2 -k $k_2 -p $pi_path -i ${stub_name}.int -o ${stub_name}_H${k_2}.int");
		$CI->Status->update($session_id, 2, 2);
		exec("$sys_dir/bin/DAT_FASTA.pl < ${stub_name}_H${k_2}.int > ${stub_name}_H${k_2}.fasta");

		$CI->Status->update($session_id, 2, 3);
		exec("$sys_dir/bin/DUDE-Seq-1 -k $k_1 -i ${stub_name}_H${k_2}.fasta -o ${stub_name}_H${k_2}_S${k_1}.fasta");
		$CI->Status->update($session_id, 2, 4);

		$CI->Work->compress($session_id);
		$result = "${stub_name}_H${k_2}_S${k_1}.fasta";
		$CI->Work->prinseq($session_id, $result);
	}

	static function prinseq($session_id, $result)
	{
		$CI =& get_instance();
		$sys_dir = $CI->Work->sys_dir;

		chdir("$sys_dir/data/$session_id");

		mkdir("tmp");
		exec("perl $sys_dir/bin/prinseq-lite.pl -fasta $result -out_good null -out_bad null -graph_data tmp/${result}.gd");
		exec("perl $sys_dir/bin/prinseq-graphs-noPCA.pl -i tmp/${result}.gd -html_all -o tmp/${session_id}");
		$CI->Status->graphs($session_id);
	}

	static function compress($session_id)
	{
		$CI =& get_instance();
		$sys_dir = $CI->Work->sys_dir;

		chdir("$sys_dir/data/$session_id");

		exec("tar -czf ${session_id}.corr.tar.gz *.fasta --exclude='*.zip'");
		$CI->Status->done($session_id);
	}
}
