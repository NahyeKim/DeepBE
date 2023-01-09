<?php include("header.php");?>

<p>Your request was successfully submitted.</p>
<small><strong>URL: </strong><?php echo "http://".$_SERVER['HTTP_HOST'].base_url("page/user/$session_id");?><br />
<strong>* Note: Bookmark this page for later access</strong></small>
<?php $HTML = "http://".$_SERVER['HTTP_HOST'].base_url("/page/user/$session_id"); exec("printf '$HTML' > data/'$session_id'/DeepBE_Results.html");?>
<br/><br/>

<div id="exec" style="position: relative; left: -177px;"></div>

<div id="status_0" class="status_0" style="display:Block">
	<span id="status_0"></span>
</div>

<div id="task_0" style="display:none">
	<small><strong>DeepCas9variants prediction:</strong></small><span id="status_1"></span><br/>
</div>

<div id="task_1" style="display:none">
	<small><strong>DeepBE prediction:</strong></small><span id="status_2"></span><br/>
</div>

<div id="result_comment" style="display:none">
	<p style="color: red">Click <strong>each prediction score</strong> to view its base edit outcome sequences and their corresponding scores.</p>
</div>

<div id="result" style="position: relative; left: -177px;"></div>

<div id="return" style="display:none; position: relative; left: -177px;">
        <?php
                echo "<a href=\"/DeepBE-Web/page/user/$session_id\">[Return to the results]</a>";?>
</div>

<div id="sample_result" style="position: relative; left: -177px;"></div>

<div id="download" style="display:none; position: relative; left: -177px;">
	<a href="<?=base_url("data/$session_id/Results.zip");?>"><big>[Download Results]</big></a>
</div>
<br/>

<script>
	var url = "/DeepBE-Web/job/user/<?=$session_id?>";
	var interval = null;

	$(document).ready(
		function()
		{
			$.unblockUI();
			interval = setInterval(function(){$.post(url, status);}, 1000);
	});
</script>

<?php include("footer.php");?>
