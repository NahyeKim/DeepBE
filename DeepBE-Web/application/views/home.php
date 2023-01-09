<?php include('header.php'); ?>
<div class="tab-content">
	<div class="tab-pane active" style="line-height:100%;">
		<form class="form-inline" method="post" enctype="multipart/form-data" action="<?=base_url("job/upload")?>">

 			<img src="images/Model_Overview.svg" width="800px"/>
			<br><br><br><br>

            The computational models shown here (i.e., DeepBE and DeepCas9variants) were generated based on the measured activities of these base editors and Cas9 variants when HEK293T cells were transduced with a lentiviral vector that expresses a base editor or Cas9 variant at a multiplicity of infection of 0.15, so that almost every transduced cell had only one copy of the Cas9 or base editor variant-encoding sequence. Western blotting showed that the levels of most, <font color="red">but not all</font>, Cas9 and base editor variant proteins were comparable. For more information, <a href="<?=base_url("page/description")?>"><font color="red">click here</font></a>.
            <br><br><br>

            <fieldset>
                <legend><div>
                <div style="float: left; width: 50%;">
                        <div id="toggle_CA"><i class="icon-minus"></i>&nbsp;<a href="javascript:void(0)">Select mode</a></div>
                </div></legend><br>
                <div style="float: left; width: 40%;"><div><label><input type="radio" name="MODE" value="0" onclick='Mode_Change(this.value)'>&nbsp;&nbsp;Single base editor and sgRNA mode</label></div></div>
                <div style="float: left; width: 40%;"><div><label><input type="radio" name="MODE" value="1" checked onclick='Mode_Change(this.value)'>&nbsp;&nbsp;Comparison mode</label></div></div>
            </fieldset>

            <div class="options_Editor" style="display: none; float: left; width: 100%;"><fieldset>
                <legend><div>
                <div style="float: left; width: 50%;">
                        <div id="toggle_Editor"><i class="icon-minus"></i>&nbsp;<a href="javascript:void(0)">Select the deamination domain</a></div>
                </div></legend><br>
                <div style="float: left; width: 25%;"><div><label><input type="radio" name="EDITOR" value="0" checked>&nbsp;&nbsp;ABE8e(V106W)</label></div></div>
                <div style="float: left; width: 25%;"><div><label><input type="radio" name="EDITOR" value="1">&nbsp;&nbsp;ABE8.17m+V106W</label></div></div>
                <div style="float: left; width: 25%;"><div><label><input type="radio" name="EDITOR" value="2">&nbsp;&nbsp;YE1-BE4max</label></div></div>
                <div style="float: left; width: 25%;"><div><label><input type="radio" name="EDITOR" value="3">&nbsp;&nbsp;SsAPOBEC3B</label></div></div>
                <div style="float: left; width: 25%;"><div><label><input type="radio" name="EDITOR" value="4">&nbsp;&nbsp;CGBE1</label></div></div>
                <div style="float: left; width: 25%;"><div><label><input type="radio" name="EDITOR" value="5">&nbsp;&nbsp;miniCGBE1</label></div></div>
                <div style="float: left; width: 25%;"><div><label><input type="radio" name="EDITOR" value="6">&nbsp;&nbsp;APOBEC-nCas9-Ung</label></div></div>
            <br><br>
            </fieldset></div>

            <div class="options_PAM" style="display: none; float: left; width: 100%;"><fieldset>
                <legend><div>
                <div style="float: left; width: 50%;">
                        <div id="toggle_PAM"><i class="icon-minus"></i>&nbsp;<a href="javascript:void(0)">Select the Cas9 nickase domain</a></div>
                </div></legend><br>
                <div style="float: left; width: 25%;"><div><label><input type="radio" id="PAM" name="PAM" value="0" onclick="Guide_Change()" checked>&nbsp;&nbsp;SpCas9</label></div></div>
                <div style="float: left; width: 25%;"><div><label><input type="radio" id="PAM" name="PAM" value="1" onclick="Guide_Change()">&nbsp;&nbsp;VRQR variant</label></div></div>
                <div style="float: left; width: 25%;"><div><label><input type="radio" id="PAM" name="PAM" value="2" onclick="Guide_Change()">&nbsp;&nbsp;SpCas9-NG</label></div></div>
                <div style="float: left; width: 25%;"><div><label><input type="radio" id="PAM" name="PAM" value="3" onclick="Guide_Change()">&nbsp;&nbsp;SpCas9-NRRH</label></div></div>
                <div style="float: left; width: 25%;"><div><label><input type="radio" id="PAM" name="PAM" value="4" onclick="Guide_Change()">&nbsp;&nbsp;SpCas9-NRTH</label></div></div>
                <div style="float: left; width: 25%;"><div><label><input type="radio" id="PAM" name="PAM" value="5" onclick="Guide_Change()">&nbsp;&nbsp;SpCas9-NRCH</label></div></div>
                <div style="float: left; width: 25%;"><div><label><input type="radio" id="PAM" name="PAM" value="6" onclick="Guide_Change()">&nbsp;&nbsp;SpG</label></div></div>
                <div style="float: left; width: 25%;"><div><label><input type="radio" id="PAM" name="PAM" value="7" onclick="Guide_Change()">&nbsp;&nbsp;SpRY</label></div></div>
                <div style="float: left; width: 25%;"><div><label><input type="radio" id="PAM" name="PAM" value="8" onclick="Guide_Change()">&nbsp;&nbsp;Sc++</label></div></div>
            <br><br>
            </fieldset></div>

            <div class="options_Target" style="display: none; float: left; width: 100%;"><fieldset>
                <legend><div id="toggle_Target"><i class="icon-minus"></i>&nbsp;<a href="javascript:void(0)">Enter target sequence</a></div></legend>
                <textarea type="text" id="Target" name="ENTER_TARGET" placeholder="GGATGACTACGCCTCTGCCTTAGTAGGTCA" style="width: 600px; height: 20px" onchange="Guide_Change()"></textarea>
            &nbsp;&nbsp;&nbsp;<button type="button" onclick="Guide_Change()">ENTER</button>
            <br><br><br>
            </fieldset></div>

            <div class="options_Guide" style="display: none; float: left; width: 100%;"><fieldset>
                <legend><div id="toggle_Guide"><i class="icon-minus"></i>&nbsp;<a href="javascript:void(0)">Select guide sequence</a></div></legend>
                <select class="form-control" id="Guide" name="Guide">
                <option value="" disabled selected>Select..</option>
                </select>
            <br><br><br><br>
            </fieldset></div>

            <div class="options_Model_All" style="display: Block; float: left; width: 100%;"><fieldset>
                <legend><div>
                <div style="float: left; width: 50%;">
                        <div id="toggle_CA"><i class="icon-minus"></i>&nbsp;<a href="javascript:void(0)">Select model</a></div>
                </div></legend><br>
                <div style="float: left; width: 20%;"><div><label><input type="radio" name="MODEL" value="0" checked>&nbsp;&nbsp;DeepCas9variants</label></div></div>
                <div style="float: left; width: 20%;"><div><label><input type="radio" name="MODEL" value="1">&nbsp;&nbsp;DeepBE-ABE</label></div></div>
                <div style="float: left; width: 20%;"><div><label><input type="radio" name="MODEL" value="2">&nbsp;&nbsp;DeepBE-CBE</label></div></div>
                <div style="float: left; width: 20%;"><div><label><input type="radio" name="MODEL" value="3">&nbsp;&nbsp;DeepBE-CGBE</label></div></div>
                <br>
            </fieldset></div>

			<div class="options_Enter_All" style="display: Block; float: left; width: 100%;"><fieldset>
				<legend><div id="toggle_Enter"><i class="icon-minus"></i>&nbsp;<a href="javascript:void(0)">Enter FASTA text</a></div></legend>
				<div class="options_Enter" style="display: Block">
					Enter target sequences in FASTA format <b>*(sequence length >= 30).</b><br><br><br>
					<textarea type="text" name="ENTER_FASTA" placeholder=">input example&#10;GGATGACTACGCCTCTGCCTTAGTAGGTCA&#10;" style="width: 600px; height: 150px"></textarea>
				<br><br><br></div>
			</fieldset></div>

			<div class="options_Upload_All" style="display: Block; float: left; width: 100%;"><fieldset>
				<legend> <div id="toggle_Upload"><i class="icon-plus"></i>&nbsp;<a href="javascript:void(0)">Upload a FASTA file</a></div></legend>
				<div class="options_Upload" style="display: none">
					Upload a <strong>.zip</strong> file which contains single <strong>.fasta</strong> or <strong>.fa</strong> file.<br><br>
					<input type="file" accept=".zip" class="file" name="input_file">
				<br><br><br><br></div>
			</fieldset></div>

			<div id="toggle_Ex1">
			<br><br><br><br>
			    <a href="javascript:void(0)">[View an example input 1]</a></div>
				<div class="options_Ex1" style="display: none"><br>
					>LINC00478 (Chr21:17,959,604-17,960,044)<br>
					CAGACAGCATTAGAGTTGGCTTGAGAATTGCCGTACTTTGCTTCCCTTTGTATGTATTTC
            </div>
            <br>

			<div id="toggle_Ex2">
			    <a href="javascript:void(0)">[View an example input 2]</a></div>
				<div class="options_Ex2" style="display: none"><br>
					>LINC00478 (Chr21:17,959,604-17,960,104)<br>
                    CAGACAGCATTAGAGTTGGCTTGAGAATTGCCGTACTTTGCTTCCCTTTGTATGTATTTC<br>
                    TTGTATGCTGCCGAGTCACTGATGGCTAGCTCTGTCTGGCAAGTAATTCAAAAATGCTGT<br>
                    TTATGTAGAAAGGAAAGGTAGGGACTTTACCACACTCTGTCATTAAAGGGAGCAATTGAA<br>
                    GAACAAAGGAACTGAGTAAATACCTATATATTGCCTTTTGTGTTGCGAAACACTGTAGCA<br>
                    CAAACACATTTGTGTTCAGCCAAATGTTTTACTTCCTTTTGTAATAACGCATATAGTAGG<br>
                    TTGTCTCCACATATGTACAAGAATCCATATTTTATTTAAACGTATATAGTCAATTGTTCA<br>
                    TATTTATAGGCTGCAAACATTTCTCAATCTCAAAGACTTTTACATATCCACTCCCACACA<br>
                    GCTATTTGTTATTATTTTAAAAGTTCTTAAATTAAAAAAAAAAATAAAATATACTAATAT<br>
                    CTCTGTTGGTTGATTTTATTA<br>
            </div>

			<br><a href="<?=base_url("src/Example_DATA.zip")?>">[Download an example input]</a><br>
			<div class="form-actions">
				<input type="submit" class="btn btn-primary btn-small" value="SUBMIT">
				<input type="reset" class="btn btn-default btn-small" value="RESET">
			</div>
		</form>
	</div>
</div>

<script>
function Guide_Change(value){
    var GuideSelect = document.getElementById("Guide");
    $('#Guide option:not(:first)').remove();
    GuideSelect.selectedIndex = 0;

    var radios = document.getElementsByName("PAM");
    var Cas9 = Array.from(radios).find(radio => radio.checked).value;

//     if(Cas9 == "0") {
//         var PAM = ["AAGA" ,"AAGC" ,"AAGG" ,"AAGT" ,"ACGG" ,"AGAA" ,"AGAC" ,"AGAG" ,"AGAT" ,"AGGA" ,"AGGC" ,"AGGG" ,"AGGT" ,"ATGG" ,"CAGA" ,"CAGC" ,"CAGG" ,"CAGT" ,"CCGG" ,"CGAA" ,"CGAC" ,"CGAG" ,"CGAT" ,"CGGA" ,"CGGC" ,"CGGG" ,"CGGT" ,"CTGC" ,"CTGG" ,"GAGA" ,"GAGC" ,"GAGG" ,"GAGT" ,"GCGG" ,"GGAA" ,"GGAC" ,"GGAG" ,"GGAT" ,"GGGA" ,"GGGC" ,"GGGG" ,"GGGT" ,"GTGA" ,"GTGC" ,"GTGG" ,"GTGT" ,"TAGA" ,"TAGC" ,"TAGG" ,"TAGT" ,"TCGG" ,"TGAA" ,"TGAC" ,"TGAG" ,"TGAT" ,"TGGA" ,"TGGC" ,"TGGG" ,"TGGT" ,"TTGG"];
//     } else if(Cas9 == "1") {
//         var PAM = ["AAAG" ,"AACG" ,"AAGA" ,"AAGG" ,"ACAG" ,"ACGA" ,"AGAA" ,"AGAC" ,"AGAG" ,"AGAT" ,"AGCA" ,"AGCC" ,"AGCG" ,"AGCT" ,"AGGA" ,"AGGC" ,"AGGG" ,"AGGT" ,"AGTG" ,"AGTT" ,"ATAG" ,"ATGA" ,"CAAG" ,"CACG" ,"CAGG" ,"CCAG" ,"CGAA" ,"CGAC" ,"CGAG" ,"CGAT" ,"CGCA" ,"CGCG" ,"CGCT" ,"CGGA" ,"CGGC" ,"CGGG" ,"CGGT" ,"CGTG" ,"CGTT" ,"CTAG" ,"GAAG" ,"GACG" ,"GAGA" ,"GAGC" ,"GAGG" ,"GAGT" ,"GATG" ,"GCAG" ,"GGAA" ,"GGAC" ,"GGAG" ,"GGAT" ,"GGCA" ,"GGCG" ,"GGCT" ,"GGGA" ,"GGGC" ,"GGGG" ,"GGGT" ,"GGTG" ,"GGTT" ,"GTAG" ,"TAAG" ,"TAGA" ,"TAGG" ,"TGAA" ,"TGAC" ,"TGAG" ,"TGAT" ,"TGCA" ,"TGCC" ,"TGCG" ,"TGCT" ,"TGGA" ,"TGGC" ,"TGGG" ,"TGGT" ,"TGTG" ,"TGTT"];
//     } else if(Cas9 == "2") {
//         var PAM = ["AAAG" ,"AACG" ,"AAGA" ,"AAGC" ,"AAGG" ,"AAGT" ,"AATG" ,"ACTG" ,"AGAA" ,"AGAC" ,"AGAG" ,"AGAT" ,"AGCA" ,"AGCC" ,"AGCG" ,"AGCT" ,"AGGA" ,"AGGC" ,"AGGG" ,"AGGT" ,"AGTA" ,"AGTC" ,"AGTG" ,"AGTT" ,"ATAG" ,"ATGA" ,"ATGG" ,"ATGT" ,"ATTG" ,"CAAA" ,"CAAG" ,"CAAT" ,"CACA" ,"CACG" ,"CACT" ,"CAGA" ,"CAGC" ,"CAGG" ,"CAGT" ,"CATA" ,"CATC" ,"CATG" ,"CATT" ,"CGAA" ,"CGAC" ,"CGAG" ,"CGAT" ,"CGCA" ,"CGCC" ,"CGCG" ,"CGCT" ,"CGGA" ,"CGGC" ,"CGGG" ,"CGGT" ,"CGTA" ,"CGTC" ,"CGTG" ,"CGTT" ,"CTAG" ,"CTGG" ,"CTGT" ,"CTTG" ,"GAAA" ,"GAAC" ,"GAAG" ,"GAAT" ,"GACA" ,"GACG" ,"GACT" ,"GAGA" ,"GAGC" ,"GAGG" ,"GAGT" ,"GATA" ,"GATC" ,"GATG" ,"GATT" ,"GCAG" ,"GCTG" ,"GGAA" ,"GGAC" ,"GGAG" ,"GGAT" ,"GGCA" ,"GGCC" ,"GGCG" ,"GGCT" ,"GGGA" ,"GGGC" ,"GGGG" ,"GGGT" ,"GGTA" ,"GGTC" ,"GGTG" ,"GGTT" ,"GTAG" ,"GTCG" ,"GTGA" ,"GTGC" ,"GTGG" ,"GTGT" ,"GTTG" ,"TAAG" ,"TACG" ,"TAGA" ,"TAGC" ,"TAGG" ,"TAGT" ,"TATG" ,"TGAA" ,"TGAC" ,"TGAG" ,"TGAT" ,"TGCA" ,"TGCC" ,"TGCG" ,"TGCT" ,"TGGA" ,"TGGC" ,"TGGG" ,"TGGT" ,"TGTA" ,"TGTC" ,"TGTG" ,"TGTT" ,"TTGG"];
//     } else if(Cas9 == "3") {
//         var PAM = ["AAAA" ,"AAAC" ,"AAAG" ,"AAAT" ,"AACA" ,"AACC" ,"AACT" ,"AAGA" ,"AAGC" ,"AAGG" ,"AAGT" ,"AATA" ,"AATC" ,"AATG" ,"AATT" ,"ACAC" ,"ACGC" ,"ACGT" ,"ACTC" ,"AGAA" ,"AGAC" ,"AGAG" ,"AGAT" ,"AGCA" ,"AGCC" ,"AGCG" ,"AGCT" ,"AGGA" ,"AGGC" ,"AGGG" ,"AGGT" ,"AGTA" ,"AGTC" ,"AGTG" ,"AGTT" ,"ATAC" ,"ATAT" ,"ATGA" ,"ATGC" ,"ATGT" ,"ATTC" ,"CAAA" ,"CAAC" ,"CAAG" ,"CAAT" ,"CACA" ,"CACC" ,"CACG" ,"CACT" ,"CAGA" ,"CAGC" ,"CAGG" ,"CAGT" ,"CATA" ,"CATC" ,"CATG" ,"CATT" ,"CCTC" ,"CGAA" ,"CGAC" ,"CGAG" ,"CGAT" ,"CGCA" ,"CGCC" ,"CGCG" ,"CGCT" ,"CGGA" ,"CGGC" ,"CGGG" ,"CGGT" ,"CGTA" ,"CGTC" ,"CGTG" ,"CGTT" ,"CTAA" ,"CTAC" ,"CTAT" ,"CTCC" ,"CTGA" ,"CTGC" ,"CTGT" ,"CTTC" ,"GAAA" ,"GAAC" ,"GAAG" ,"GAAT" ,"GACA" ,"GACC" ,"GACG" ,"GACT" ,"GAGA" ,"GAGC" ,"GAGG" ,"GAGT" ,"GATA" ,"GATC" ,"GATG" ,"GATT" ,"GCAC" ,"GCAT" ,"GCGC" ,"GCGT" ,"GCTC" ,"GGAA" ,"GGAC" ,"GGAG" ,"GGAT" ,"GGCA" ,"GGCC" ,"GGCG" ,"GGCT" ,"GGGA" ,"GGGC" ,"GGGG" ,"GGGT" ,"GGTA" ,"GGTC" ,"GGTG" ,"GGTT" ,"GTAA" ,"GTAC" ,"GTAG" ,"GTAT" ,"GTCC" ,"GTGA" ,"GTGC" ,"GTGG" ,"GTGT" ,"GTTA" ,"GTTC" ,"TAAA" ,"TAAC" ,"TAAG" ,"TAAT" ,"TACC" ,"TAGA" ,"TAGC" ,"TAGG" ,"TAGT" ,"TATA" ,"TATC" ,"TATG" ,"TATT" ,"TGAA" ,"TGAC" ,"TGAG" ,"TGAT" ,"TGCA" ,"TGCC" ,"TGCT" ,"TGGA" ,"TGGC" ,"TGGG" ,"TGGT" ,"TGTA" ,"TGTC" ,"TGTG" ,"TGTT" ,"TTGC"];
//     } else if(Cas9 == "4") {
//         var PAM = ["AAAC" ,"AAAT" ,"AACA" ,"AACC" ,"AAGA" ,"AAGC" ,"AAGG" ,"AAGT" ,"AATA" ,"AATC" ,"AATG" ,"AATT" ,"ACAT" ,"ACGT" ,"AGAA" ,"AGAC" ,"AGAG" ,"AGAT" ,"AGCA" ,"AGCC" ,"AGCG" ,"AGCT" ,"AGGA" ,"AGGC" ,"AGGG" ,"AGGT" ,"AGTA" ,"AGTC" ,"AGTG" ,"AGTT" ,"ATAT" ,"ATGA" ,"ATGC" ,"ATGT" ,"CAAA" ,"CAAC" ,"CAAG" ,"CAAT" ,"CACA" ,"CACC" ,"CACT" ,"CAGA" ,"CAGC" ,"CAGG" ,"CAGT" ,"CATA" ,"CATC" ,"CATG" ,"CATT" ,"CCGT" ,"CCTC" ,"CGAA" ,"CGAC" ,"CGAG" ,"CGAT" ,"CGCA" ,"CGCC" ,"CGCG" ,"CGCT" ,"CGGA" ,"CGGC" ,"CGGG" ,"CGGT" ,"CGTA" ,"CGTC" ,"CGTG" ,"CGTT" ,"CTAC" ,"CTAT" ,"CTGT" ,"CTTC" ,"GAAA" ,"GAAC" ,"GAAG" ,"GAAT" ,"GACA" ,"GACC" ,"GACT" ,"GAGA" ,"GAGC" ,"GAGG" ,"GAGT" ,"GATA" ,"GATC" ,"GATG" ,"GATT" ,"GCGC" ,"GCGT" ,"GCTC" ,"GGAA" ,"GGAC" ,"GGAG" ,"GGAT" ,"GGCA" ,"GGCC" ,"GGCG" ,"GGCT" ,"GGGA" ,"GGGC" ,"GGGG" ,"GGGT" ,"GGTA" ,"GGTC" ,"GGTG" ,"GGTT" ,"GTAC" ,"GTAT" ,"GTCC" ,"GTGA" ,"GTGC" ,"GTGT" ,"GTTA" ,"GTTC" ,"GTTT" ,"TAAC" ,"TAAT" ,"TAGA" ,"TAGC" ,"TAGT" ,"TATA" ,"TATC" ,"TATG" ,"TATT" ,"TCGT" ,"TGAA" ,"TGAC" ,"TGAG" ,"TGAT" ,"TGCA" ,"TGCC" ,"TGCG" ,"TGCT" ,"TGGA" ,"TGGC" ,"TGGG" ,"TGGT" ,"TGTA" ,"TGTC" ,"TGTG" ,"TGTT" ,"TTGT"];
//     } else if(Cas9 == "5") {
//         var PAM = ["AAAC" ,"AAAT" ,"AACA" ,"AACC" ,"AACT" ,"AAGA" ,"AAGC" ,"AAGG" ,"AAGT" ,"AATA" ,"AATC" ,"AATT" ,"ACAC" ,"ACCC" ,"ACCT" ,"ACGA" ,"ACGC" ,"ACGG" ,"ACGT" ,"AGAA" ,"AGAC" ,"AGAG" ,"AGAT" ,"AGCA" ,"AGCC" ,"AGCG" ,"AGCT" ,"AGGA" ,"AGGC" ,"AGGG" ,"AGGT" ,"AGTA" ,"AGTC" ,"AGTG" ,"AGTT" ,"ATAC" ,"ATGA" ,"ATGC" ,"ATGG" ,"ATGT" ,"CAAA" ,"CAAC" ,"CAAG" ,"CAAT" ,"CACA" ,"CACC" ,"CACG" ,"CACT" ,"CAGA" ,"CAGC" ,"CAGG" ,"CAGT" ,"CATA" ,"CATC" ,"CATG" ,"CATT" ,"CCAC" ,"CCCT" ,"CCGA" ,"CCGC" ,"CCGG" ,"CCGT" ,"CGAA" ,"CGAC" ,"CGAG" ,"CGAT" ,"CGCA" ,"CGCC" ,"CGCG" ,"CGCT" ,"CGGA" ,"CGGC" ,"CGGG" ,"CGGT" ,"CGTA" ,"CGTC" ,"CGTG" ,"CGTT" ,"CTAC" ,"CTCC" ,"CTCT" ,"CTGA" ,"CTGC" ,"CTGG" ,"CTGT" ,"GAAA" ,"GAAC" ,"GAAG" ,"GAAT" ,"GACA" ,"GACC" ,"GACG" ,"GACT" ,"GAGA" ,"GAGC" ,"GAGG" ,"GAGT" ,"GATA" ,"GATC" ,"GATG" ,"GATT" ,"GCAC" ,"GCCC" ,"GCCT" ,"GCGA" ,"GCGC" ,"GCGG" ,"GCGT" ,"GCTC" ,"GCTT" ,"GGAA" ,"GGAC" ,"GGAG" ,"GGAT" ,"GGCA" ,"GGCC" ,"GGCG" ,"GGCT" ,"GGGA" ,"GGGC" ,"GGGG" ,"GGGT" ,"GGTA" ,"GGTC" ,"GGTG" ,"GGTT" ,"GTAC" ,"GTCC" ,"GTCT" ,"GTGA" ,"GTGC" ,"GTGG" ,"GTGT" ,"TAAC" ,"TAAT" ,"TACA" ,"TACC" ,"TACT" ,"TAGA" ,"TAGC" ,"TAGG" ,"TAGT" ,"TATC" ,"TATT" ,"TCAC" ,"TCGA" ,"TCGC" ,"TCGG" ,"TCGT" ,"TGAA" ,"TGAC" ,"TGAG" ,"TGAT" ,"TGCA" ,"TGCC" ,"TGCG" ,"TGCT" ,"TGGA" ,"TGGC" ,"TGGG" ,"TGGT" ,"TGTA" ,"TGTC" ,"TGTG" ,"TGTT" ,"TTGA" ,"TTGC" ,"TTGG" ,"TTGT"];
//     } else if(Cas9 == "6") {
//         var PAM = ["AAAG" ,"AACA" ,"AACC" ,"AACG" ,"AACT" ,"AAGA" ,"AAGC" ,"AAGG" ,"AAGT" ,"AATG" ,"ACGG" ,"AGAA" ,"AGAC" ,"AGAG" ,"AGAT" ,"AGCA" ,"AGCC" ,"AGCG" ,"AGCT" ,"AGGA" ,"AGGC" ,"AGGG" ,"AGGT" ,"AGTA" ,"AGTC" ,"AGTG" ,"AGTT" ,"ATGA" ,"ATGG" ,"ATGT" ,"CAAG" ,"CACA" ,"CACC" ,"CACG" ,"CACT" ,"CAGA" ,"CAGG" ,"CAGT" ,"CATG" ,"CGAA" ,"CGAC" ,"CGAG" ,"CGAT" ,"CGCA" ,"CGCC" ,"CGCG" ,"CGCT" ,"CGGA" ,"CGGC" ,"CGGG" ,"CGGT" ,"CGTA" ,"CGTC" ,"CGTG" ,"CGTT" ,"CTGG" ,"GAAA" ,"GAAC" ,"GAAG" ,"GAAT" ,"GACA" ,"GACC" ,"GACG" ,"GACT" ,"GAGA" ,"GAGC" ,"GAGG" ,"GAGT" ,"GATG" ,"GCAG" ,"GCGG" ,"GGAA" ,"GGAC" ,"GGAG" ,"GGAT" ,"GGCA" ,"GGCC" ,"GGCG" ,"GGCT" ,"GGGA" ,"GGGC" ,"GGGG" ,"GGGT" ,"GGTA" ,"GGTC" ,"GGTG" ,"GGTT" ,"GTAG" ,"GTGG" ,"TAAG" ,"TACA" ,"TACC" ,"TACG" ,"TACT" ,"TAGA" ,"TAGG" ,"TAGT" ,"TATG" ,"TGAA" ,"TGAC" ,"TGAG" ,"TGAT" ,"TGCA" ,"TGCC" ,"TGCG" ,"TGCT" ,"TGGA" ,"TGGC" ,"TGGG" ,"TGGT" ,"TGTA" ,"TGTC" ,"TGTG" ,"TGTT"];
//     } else if(Cas9 == "7") {
//         var PAM = ["AAAA" ,"AAAG" ,"AAAT" ,"AACA" ,"AACC" ,"AACG" ,"AACT" ,"AAGA" ,"AAGC" ,"AAGG" ,"AAGT" ,"AATG" ,"ACAG" ,"ACCG" ,"ACGA" ,"ACGG" ,"ACGT" ,"ACTG" ,"AGAA" ,"AGAC" ,"AGAG" ,"AGAT" ,"AGCA" ,"AGCC" ,"AGCG" ,"AGCT" ,"AGGA" ,"AGGC" ,"AGGG" ,"AGGT" ,"AGTA" ,"AGTC" ,"AGTG" ,"AGTT" ,"ATAG" ,"ATCG" ,"ATGA" ,"ATGG" ,"ATGT" ,"ATTG" ,"CAAA" ,"CAAC" ,"CAAG" ,"CAAT" ,"CACA" ,"CACC" ,"CACG" ,"CACT" ,"CAGA" ,"CAGC" ,"CAGG" ,"CAGT" ,"CATA" ,"CATG" ,"CCAG" ,"CCCG" ,"CCGG" ,"CCTG" ,"CGAA" ,"CGAG" ,"CGCA" ,"CGCG" ,"CGCT" ,"CGGA" ,"CGGG" ,"CGGT" ,"CGTG" ,"CTAG" ,"CTCG" ,"CTGA" ,"CTGG" ,"CTGT" ,"CTTG" ,"GAAA" ,"GAAC" ,"GAAG" ,"GAAT" ,"GACA" ,"GACC" ,"GACG" ,"GACT" ,"GAGA" ,"GAGC" ,"GAGG" ,"GAGT" ,"GATA" ,"GATC" ,"GATG" ,"GATT" ,"GCAA" ,"GCAG" ,"GCCG" ,"GCCT" ,"GCGA" ,"GCGG" ,"GCGT" ,"GCTG" ,"GGAA" ,"GGAC" ,"GGAG" ,"GGAT" ,"GGCA" ,"GGCC" ,"GGCG" ,"GGCT" ,"GGGA" ,"GGGC" ,"GGGG" ,"GGGT" ,"GGTA" ,"GGTC" ,"GGTG" ,"GGTT" ,"GTAG" ,"GTCG" ,"GTCT" ,"GTGA" ,"GTGC" ,"GTGG" ,"GTGT" ,"GTTG" ,"TAAA" ,"TAAC" ,"TAAG" ,"TACA" ,"TACC" ,"TACG" ,"TACT" ,"TAGA" ,"TAGC" ,"TAGG" ,"TAGT" ,"TATG" ,"TCAG" ,"TCCG" ,"TCGG" ,"TCTG" ,"TGAA" ,"TGAG" ,"TGAT" ,"TGCA" ,"TGCC" ,"TGCG" ,"TGCT" ,"TGGA" ,"TGGC" ,"TGGG" ,"TGGT" ,"TGTA" ,"TGTG" ,"TTAG" ,"TTGG"];
//     } else {
//         var PAM = ["AAGA" ,"AAGC" ,"AAGG" ,"AAGT" ,"ACGC" ,"ACGG" ,"ACGT" ,"AGGC" ,"AGGG" ,"AGGT" ,"ATGT" ,"CAGA" ,"CAGC" ,"CAGG" ,"CAGT" ,"CCGT" ,"CGGC" ,"CGGG" ,"CGGT" ,"CTGT" ,"GAGA" ,"GAGC" ,"GAGG" ,"GAGT" ,"GCGC" ,"GCGG" ,"GCGT" ,"GGGC" ,"GGGG" ,"GGGT" ,"GTGC" ,"GTGG" ,"GTGT" ,"TAGC" ,"TAGG" ,"TAGT" ,"TCGT" ,"TGGG" ,"TGGT"];
//     }
    var PAM = ["AAAA", "AAAC", "AAAG", "AAAT", "AACA", "AACC", "AACG", "AACT", "AAGA", "AAGC", "AAGG", "AAGT", "AATA", "AATC", "AATG", "AATT", "ACAC", "ACAG", "ACAT", "ACCC", "ACCG", "ACCT", "ACGA", "ACGC", "ACGG", "ACGT", "ACTC", "ACTG", "AGAA", "AGAC", "AGAG", "AGAT", "AGCA", "AGCC", "AGCG", "AGCT", "AGGA", "AGGC", "AGGG", "AGGT", "AGTA", "AGTC", "AGTG", "AGTT", "ATAC", "ATAG", "ATAT", "ATCG", "ATGA", "ATGC", "ATGG", "ATGT", "ATTC", "ATTG", "CAAA", "CAAC", "CAAG", "CAAT", "CACA", "CACC", "CACG", "CACT", "CAGA", "CAGC", "CAGG", "CAGT", "CATA", "CATC", "CATG", "CATT", "CCAC", "CCAG", "CCCG", "CCCT", "CCGA", "CCGC", "CCGG", "CCGT", "CCTC", "CCTG", "CGAA", "CGAC", "CGAG", "CGAT", "CGCA", "CGCC", "CGCG", "CGCT", "CGGA", "CGGC", "CGGG", "CGGT", "CGTA", "CGTC", "CGTG", "CGTT", "CTAA", "CTAC", "CTAG", "CTAT", "CTCC", "CTCG", "CTCT", "CTGA", "CTGC", "CTGG", "CTGT", "CTTC", "CTTG", "GAAA", "GAAC", "GAAG", "GAAT", "GACA", "GACC", "GACG", "GACT", "GAGA", "GAGC", "GAGG", "GAGT", "GATA", "GATC", "GATG", "GATT", "GCAA", "GCAC", "GCAG", "GCAT", "GCCC", "GCCG", "GCCT", "GCGA", "GCGC", "GCGG", "GCGT", "GCTC", "GCTG", "GCTT", "GGAA", "GGAC", "GGAG", "GGAT", "GGCA", "GGCC", "GGCG", "GGCT", "GGGA", "GGGC", "GGGG", "GGGT", "GGTA", "GGTC", "GGTG", "GGTT", "GTAA", "GTAC", "GTAG", "GTAT", "GTCC", "GTCG", "GTCT", "GTGA", "GTGC", "GTGG", "GTGT", "GTTA", "GTTC", "GTTG", "GTTT", "TAAA", "TAAC", "TAAG", "TAAT", "TACA", "TACC", "TACG", "TACT", "TAGA", "TAGC", "TAGG", "TAGT", "TATA", "TATC", "TATG", "TATT", "TCAC", "TCAG", "TCCG", "TCGA", "TCGC", "TCGG", "TCGT", "TCTG", "TGAA", "TGAC", "TGAG", "TGAT", "TGCA", "TGCC", "TGCG", "TGCT", "TGGA", "TGGC", "TGGG", "TGGT", "TGTA", "TGTC", "TGTG", "TGTT", "TTAG", "TTGA", "TTGC", "TTGG", "TTGT"]

    var Target = document.getElementById("Target");
    var value = Target.value.toUpperCase().replace(/(\r\n|\n|\r)/gm,"");

    var skip = 0;
    for (var i=0; i<value.length; i++) {
        var base = value.substr(i, 1);
        if (base != "A" && base != "C" && base != "G" && base != "T"){
            skip = 1;
        }
    }

    if (skip == 0){
        var NUM = 0;
        for (var i=0; i<value.length - 30 + 1; i++) {
           var string = value.substr(i, 30);
           var pam = value.substr(i+24, 4);
           if (PAM.indexOf(pam) > -1){
                var myOption = document.createElement("option");
                myOption.text = string;
                myOption.value = string;
                GuideSelect.add(myOption);
                NUM += 1;
           }
        }

        if (NUM < 1 && value.length > 0){
            alert("Target sequence does not contain any valid guides for the selected PAM variant type.");
        }
    }
    else{
        alert("Target sequence must not contain any non-ACGT characters.");
    }

};
</script>

<?php include('footer.php'); ?>
