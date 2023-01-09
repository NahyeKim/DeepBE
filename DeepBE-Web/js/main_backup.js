$(document).ready(
	function()
	{
		$("#input").submit(function(){
			$.blockUI({message:null});
		});

	$("#toggle_Enter").click(function() {
		if ($(".options_Enter").css("display") == "none")
		{
			$("#toggle_Enter").html("<i class='icon-minus'></i>&nbsp;<a href='javascript:void(0)'>Enter FASTA text</a>");
			$(".options_Enter").css({"display":"Block"});
			$("#toggle_Upload").html("<i class='icon-plus'></i>&nbsp;<a href='javascript:void(0)'>Upload a FASTA file</a>");
			$(".options_Upload").css({"display":"none"});
		}
		else
		{
			$("#toggle_Enter").html("<i class='icon-plus'></i>&nbsp;<a href='javascript:void(0)'>Enter FASTA text</a>");
			$(".options_Enter").css({"display":"none"});
			$("#toggle_Upload").html("<i class='icon-minus'></i>&nbsp;<a href='javascript:void(0)'>Upload a FASTA file</a>");
			$(".options_Upload").css({"display":"Block"});
		}
	});

	$("#toggle_Upload").click(function() {
		if ($(".options_Upload").css("display") == "none")
		{
			$("#toggle_Enter").html("<i class='icon-plus'></i>&nbsp;<a href='javascript:void(0)'>Enter FASTA text</a>");
			$(".options_Enter").css({"display":"none"});
			$("#toggle_Upload").html("<i class='icon-minus'></i>&nbsp;<a href='javascript:void(0)'>Upload a FASTA file</a>");
			$(".options_Upload").css({"display":"Block"});
		}
		else
		{
			$("#toggle_Enter").html("<i class='icon-minus'></i>&nbsp;<a href='javascript:void(0)'>Enter FASTA text</a>");
			$(".options_Enter").css({"display":"Block"});
			$("#toggle_Upload").html("<i class='icon-plus'></i>&nbsp;<a href='javascript:void(0)'>Upload a FASTA file</a>");
			$(".options_Upload").css({"display":"none"});
		}
	});


	$("#toggle_Ex").click(function() {
		if ($(".options_Ex").css("display") == "none")
		{
			$("#toggle_Ex").html("<a href='javascript:void(0)'>[View an example input]</a>");
			$(".options_Ex").css({"display":"Block"});
		}
		else
		{
			$("#toggle_Ex").html("<a href='javascript:void(0)'>[View an example input]</a>");
			$(".options_Ex").css({"display":"none"});
		}
	});

});

function Mode_Change(value){
	if (value == "0")
	{
		$(".options_Model_All").css({"display":"none"});
		$(".options_Enter_All").css({"display":"none"});
		$(".options_Upload_All").css({"display":"none"});
		$(".options_Editor").css({"display":"Block"});
		$(".options_PAM").css({"display":"Block"});
		$(".options_Target").css({"display":"Block"});
		$(".options_Guide").css({"display":"Block"});
	}
	else
	{
		$(".options_Model_All").css({"display":"Block"});
		$(".options_Enter_All").css({"display":"Block"});
		$(".options_Upload_All").css({"display":"Block"});
		$(".options_Editor").css({"display":"none"});
		$(".options_PAM").css({"display":"none"});
		$(".options_Target").css({"display":"none"});
		$(".options_Guide").css({"display":"none"});
	}
};

function status(json_str)
{
	var data = jQuery.parseJSON(json_str);
	var session_id = data.session_id;
	var task = Number(data.task);

	switch(task)
	{
		case 3:
			$("#status_0").html("&nbsp;");
			$("#task_0").show();
			$("#status_1").html("<small>&nbsp;Done.</small>");
			$("#result_description_0").show();
			$("#result").load("/DeepBE-Web/job/result0/" + session_id);
			$("#download").show();
			clearInterval(interval);
			break

		case 4:
			$("#status_0").html("&nbsp;");
			$("#task_1").show();
			$("#status_2").html("<small>&nbsp;Done.</small>");
			$("#result_comment").show();
			$("#result_description_1").show();
			$("#result").load("/DeepBE-Web/job/result1/" + session_id);
			$("#download").show();
			clearInterval(interval);
			break

		case 5:
			$("#status_0").html("&nbsp;");
			$("#task_1").show();
			$("#status_2").html("<small>&nbsp;Done.</small>");
			$("#return").show();
			$("#sample_result").load("/DeepBE-Web/job/sample_result/" + session_id);
			$("#download").show();
			clearInterval(interval);
			break

		case 6:
			$("#status_0").html("&nbsp;");
			$("#task_1").show();
			$("#status_2").html("<small>&nbsp;Done.</small>");
			$("#result_description_2").show();
			$("#result").load("/DeepBE-Web/job/result2/" + session_id);
			$("#download").show();
			clearInterval(interval);
			break

		case 7:
			$("#status_0").html("&nbsp;");
			$("#task_0").show();
			$("#status_1").html("<small>&nbsp;Done.</small>");
			$("#return").show();
			$("#description").load("/DeepBE-Web/job/description_0/" + session_id);
			clearInterval(interval);
			break

		case 8:
			$("#status_0").html("&nbsp;");
			$("#task_1").show();
			$("#status_2").html("<small>&nbsp;Done.</small>");
			$("#return").show();
			$("#description").load("/DeepBE-Web/job/description_1/" + session_id);
			clearInterval(interval);
			break

		case 9:
			$("#status_0").html("&nbsp;");
			$("#task_1").show();
			$("#status_2").html("<small>&nbsp;Done.</small>");
			$("#return").show();
			$("#description").load("/DeepBE-Web/job/description_2/" + session_id);
			clearInterval(interval);
			break

		case 0:
			$("#status_0").html("&nbsp;<img src='/images/ajax-loader.gif'><small>&nbsp;Running Algorithm...</small>");
			$("#exec").load("/DeepBE-Web/job/exec/" + session_id);

		default:
			$("#status_0").html("&nbsp;<img src='/images/ajax-loader.gif'><small>&nbsp;Running Algorithm...</small>");
			$("#exec").html("&nbsp;");
	}
}
