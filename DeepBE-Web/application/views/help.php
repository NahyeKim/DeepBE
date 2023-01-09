<?php include('header.php'); ?>
<script>document.title = "DeepBE"</script>

<h4>Help</h4>
To start <b>DeepBE</b>, please do the following:
<br><br>

<h4>Input methods</h4>
You can either directly <b>enter</b> FASTA text or <b>upload</b> a zip-compressed FASTA file. <b>*(sequence length >= 30)</b>
<br>
<ol>
	<p><div id="toggle_3"><i class="icon-plus"></i>&nbsp;<a href="javascript:void(0)">
		<b>Enter</b> FASTA text.</a></div></p>
	<div id="options_3" class="options_3" style="display: none">
		You can <b>enter</b> Cas9 target sequences in FASTA format.
		<img src="/DeepBE-Web/images/Tutorial/11.svg" width="100%"><br><br>
	</div>

	<p><div id="toggle_4"><i class="icon-plus"></i>&nbsp;<a href="javascript:void(0)">
		<b>Upload</b> a FASTA file.</a></div></p>
	<div id="options_4" class="options_4" style="display: none">
		You can <b>upload</b> a zip-compressed FASTA file containing Cas9 target sequences.
		<img src="/DeepBE-Web/images/Tutorial/8.svg" width="100%"><br><br>
	</div>
</ol>
<br>

<h4>Example input data</h4>
You can <b>copy and paste</b> FASTA text or <b>download</b> a zip-compressed FASTA file.
<br>
<ol>
	<p><div id="toggle_5"><i class="icon-plus"></i>&nbsp;<a href="javascript:void(0)">
		<b>View</b> or <b>download</b> an example input.</a></div></p>
	<div id="options_5" class="options_5" style="display: none">
		<img src="/DeepBE-Web/images/Tutorial/9.svg" width="100%"><br><br>
	</div>
</ol>
<br>

<h4>Result of DeepBE</h4>
<b>DeepBE</b> provides the results in a <b>sortable table</b>.
<br>
<ol>
	<p><div id="toggle_6"><i class="icon-plus"></i>&nbsp;<a href="javascript:void(0)">
		Example result</a></div></p>
	<div id="options_6" class="options_6" style="display: none">
		click a <b>column header</b> to sort the results of the table.<br>
		Click <b>[Download Results]</b> to save the results as a compressed file.<br><br>
		<img src="/DeepBE-Web/images/Tutorial/12.svg" width="100%">
	</div>
</ol>

<script>
$(document).ready(function()
{
	$("#toggle_1").click(function() {
	if ($(".options_1").css("display") == "none"){
		$("#toggle_1").html("<i class=\"icon-minus\"></i>&nbsp;<a href=\"javascript:void(0)\"> 1. <b>Click</b> the chromatin accessibility option to consider chromatin accessibility.</a>");
		$(".options_1").css({"display":"Block"});}
	else{
		$("#toggle_1").html("<i class=\"icon-plus\"></i>&nbsp;<a href=\"javascript:void(0)\"> 1. <b>Click</b> the chromatin accessibility option to consider chromatin accessibility.</a>");
		$(".options_1").css({"display":"none"});}
	});

	$("#toggle_2").click(function() {
	if ($(".options_2").css("display") == "none"){
		$("#toggle_2").html("<i class=\"icon-minus\"></i>&nbsp;<a href=\"javascript:void(0)\"> 2. <b>Select</b> the target cell line to obtain chromatin accessibilty information.</a>");
		$(".options_2").css({"display":"Block"});}
	else{
		$("#toggle_2").html("<i class=\"icon-plus\"></i>&nbsp;<a href=\"javascript:void(0)\"> 2. <b>Select</b> the target cell line to obtain chromatin accessibilty information.</a>");
		$(".options_2").css({"display":"none"});}
	});

	$("#toggle_2_1").click(function() {
	if ($(".options_2_1").css("display") == "none"){
		$("#toggle_2_1").html("<i class=\"icon-minus\"></i>&nbsp;<a href=\"javascript:void(0)\">Browse the cell lines by <b>name</b>.</a>");
		$(".options_2_1").css({"display":"Block"});}
	else{
		$("#toggle_2_1").html("<i class=\"icon-plus\"></i>&nbsp;<a href=\"javascript:void(0)\">Browse the cell lines by <b>name</b>.</a>");
		$(".options_2_1").css({"display":"none"});}
	});

	$("#toggle_2_2").click(function() {
	if ($(".options_2_2").css("display") == "none"){
		$("#toggle_2_2").html("<i class=\"icon-minus\"></i>&nbsp;<a href=\"javascript:void(0)\">Browse the cell lines by <b>tissue organ</b>.</a>");
		$(".options_2_2").css({"display":"Block"});}
	else{
		$("#toggle_2_2").html("<i class=\"icon-plus\"></i>&nbsp;<a href=\"javascript:void(0)\">Browse the cell lines by <b>tissue organ</b>.</a>");
		$(".options_2_2").css({"display":"none"});}
	});

	$("#toggle_2_3").click(function() {
	if ($(".options_2_3").css("display") == "none"){
		$("#toggle_2_3").html("<i class=\"icon-minus\"></i>&nbsp;<a href=\"javascript:void(0)\">Browse the cell lines by <b>cell type</b>.</a>");
		$(".options_2_3").css({"display":"Block"});}
	else{
		$("#toggle_2_3").html("<i class=\"icon-plus\"></i>&nbsp;<a href=\"javascript:void(0)\">Browse the cell lines by <b>cell type</b>.</a>");
		$(".options_2_3").css({"display":"none"});}
	});

	$("#toggle_2_4").click(function() {
	if ($(".options_2_4").css("display") == "none"){
		$("#toggle_2_4").html("<i class=\"icon-minus\"></i>&nbsp;<a href=\"javascript:void(0)\">Search the cell lines with a <b>query</b>.</a>");
		$(".options_2_4").css({"display":"Block"});}
	else{
		$("#toggle_2_4").html("<i class=\"icon-plus\"></i>&nbsp;<a href=\"javascript:void(0)\">Search the cell lines with a <b>query</b>.</a>");
		$(".options_2_4").css({"display":"none"});}
	});

	$("#toggle_3").click(function() {
	if ($(".options_3").css("display") == "none"){
		$("#toggle_3").html("<i class=\"icon-minus\"></i>&nbsp;<a href=\"javascript:void(0)\"> <b>Enter</b> FASTA text.</a>");
		$(".options_3").css({"display":"Block"});}
	else{
		$("#toggle_3").html("<i class=\"icon-plus\"></i>&nbsp;<a href=\"javascript:void(0)\"> <b>Enter</b> FASTA text.</a>");
		$(".options_3").css({"display":"none"});}
	});

	$("#toggle_4").click(function() {
	if ($(".options_4").css("display") == "none"){
		$("#toggle_4").html("<i class=\"icon-minus\"></i>&nbsp;<a href=\"javascript:void(0)\"> <b>Upload</b> a FASTA file.</a>");
		$(".options_4").css({"display":"Block"});}
	else{
		$("#toggle_4").html("<i class=\"icon-plus\"></i>&nbsp;<a href=\"javascript:void(0)\"> <b>Upload</b> a FASTA file.</a>");
		$(".options_4").css({"display":"none"});}
	});

	$("#toggle_5").click(function() {
	if ($(".options_5").css("display") == "none"){
		$("#toggle_5").html("<i class=\"icon-minus\"></i>&nbsp;<a href=\"javascript:void(0)\"> <b>View</b> or <b>download</b> an example input.</a>");
		$(".options_5").css({"display":"Block"});}
	else{
		$("#toggle_5").html("<i class=\"icon-plus\"></i>&nbsp;<a href=\"javascript:void(0)\"> <b>View</b> or <b>download</b> an example input.</a>");
		$(".options_5").css({"display":"none"});}
	});

	$("#toggle_6").click(function() {
	if ($(".options_6").css("display") == "none"){
		$("#toggle_6").html("<i class=\"icon-minus\"></i>&nbsp;<a href=\"javascript:void(0)\"> Result example.</a>");
		$(".options_6").css({"display":"Block"});}
	else{
		$("#toggle_6").html("<i class=\"icon-plus\"></i>&nbsp;<a href=\"javascript:void(0)\"> Result example.</a>");
		$(".options_6").css({"display":"none"});}
	});

});
</script>
<?php include('footer.php'); ?>
