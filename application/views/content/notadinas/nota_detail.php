<?php 
	include_once("header.php");
	 $appconfig = $app_config->row();
?>
<script type="text/javascript">
	
function copy_ref(){
	var idnota = "<?php echo $nota[0]->nota_id ?>";
 	   $.ajax({
                	type:"GET",
                	cache:false,
                	url:"<?php echo site_url('notadinas/nav/copy_ref') ?>/"+idnota,
                	success:function (data2){
                	}
                });
}

    function show_folder(){
    	$("#dialog-form-pilih-folder").dialog("open");
    }
</script>
<div class="enable-bootstrap" id="nota_detail">
<div class="btn-group btn-group-justified btngrup<?php echo $nota[0]->nota_id ?>">
	<a class="btn btn-default" role="button" onclick='javascript:print_window("<?php echo site_url('notadinas/nav/print_nota/'.$nota[0]->nota_id) ?>")' >Print</a>
     <a class="btn btn-default" role="button"  onclick="show_folder()">Copy to Folder</a>
     <a class="btn btn-default" role="button" id="btn_show" onclick="show_disposisi()">Disposisi</a>
     <a class="btn btn-default" role="button" id="btn_close" style="display:none" onclick="close_disposisi()">Disposisi</a>
     <a class="btn btn-default" role="button"  onclick="show_agenda()">Agenda</a>
 <a class="btn btn-default" role="button"  onclick="copy_ref()">Copy Ref</a>

     	
</div>
<?php 
	include_once("disposisi.php")
?>
<form role="form" enctype="multipart/form-data" method="post">
	<input type="hidden" name="nota_id" class="<?php echo $nota[0]->nota_id ?>" value="<?php echo $nota[0]->nota_id ?>" >
	<div class="form-group">
<table width="100%" align="center" style="border-bottom: solid black" >
	<input type="text" id="idnota" value ="<?php echo $nota[0]->nota_id ?>" readonly="readonly" style="visibility:hidden">
		<tr>
			<td width="150px"><img class="logo-nota" height="100px" src='<?php echo base_url('css').'/'.$app_config->row()->logo_url; ?>'></td>
			<td colspan="3" align="center">
				<H3 style='text-transform: uppercase;margin-top: 0px !important'>PEMERINTAH DAERAH KABUPATEN KEPULAUAN SULA</H2>
				<h2 style='text-transform: uppercase;margin-top: 0px !important'><?php echo $dari_emp->org_name ?></h1>
				<span><?php echo $dari_emp->org_address ?></span>
			</td>
		</tr>
</table>
<table>
	<tr>
		<td></td>
		<td align="right"><?php echo $options[0]->kota.", ". date("j F  Y", strtotime($nota[0]->nota_date)) ?></td>
	</tr>
	<tr>
		<td >

<table>
		<tr>
			<td>Nomor</td>
			<td style='width:5px'>:</td>
			<td><?php echo $nota[0]->nota_number ?></td>
		</tr >
		<tr>
			<td>Lampiran</td>
			<td>:</td>
			<td>
				<?php
					foreach ($lampiran as $l) {
						echo "<a href='".$this->config->item("upload")."/".$l->lampiran_link."'>".$l->lampiran_name."</a><br>";
						
					}
				?>
			</td>
		</tr>
		
		<tr>
			<td style="width:100px">Perihal</td>
			<td>:</td>
			<td colspan="2"><?php echo $nota[0]->nota_perihal ?></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
				
		</td>
	</tr>
</table>
</td>
		<td width="240px">
			<table >
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr>
			<td></td>
			<td style="width:150px">Kepada</td>
			<td></td>
		</tr>
		
		<?php 

		foreach ($kepada as $n => $k) {
			?>
				<tr>
					<td align="right" style="text-align: center"><?php if($n==0)  echo "Yth."; ?> </td>
					<td><?php echo $k->job_name ?></td>
				</tr>
			<?php
		}
		 ?>
		 <?php 
		foreach ($kepada_external as $k) {
			?>
				<tr>
					<td align="right" style="text-align: center">Yth. </td>
					<td><?php echo $k->name ?></td>
				</tr>
			<?php
		}
		 ?>
		<!-- <tr>
			<td colspan="4">
				<?php
					$i=1;
					foreach ($kepada as $k) {
						echo $i . ". Yth. ".$k->job_name ."<br>";
						$i++;
					}
				 ?>
			</td>
		</tr> -->
		<?php if(count($kepada_external) ==0){
			?>
		<tr>
			<td></td>
			<td>Di-</td>
		</tr>
		<tr>
			<td></td>
			<td align="center">Tempat</td>
		</tr>
			<?php
		} ?>
		</tr>
			</table>			
		</td>
	</tr>
</table>
<br>
<br>
<br>
<br>
<table>
			<tr>
			<td style="padding-left: 105px">Dengan Hormat<br><br></td>
			</tr>
			<tr>
				<td  style="padding-left: 105px" >
					<div class='nota_isi' align="justify" style="width:100%;height:auto ;word-wrap: break-word">

					<?php echo $nota[0]->nota_isi ?>
					</div>
				</td>
			</tr>
			<tr>
				<td width="70%"></td>
				<td width="30%">
					<table align="center">
						<tr >
							<td align="center" class="nama" id="nama-dari"><b style="text-decoration: underline;"><?php echo $options[0]->jabatan_pengirim  ?></b>
								<br><br><br><br><br>
							</td>

						</tr>
						<tr >
							<td align="center" class="nik" id="nik-dari">
								<b style="text-decoration: underline;"><?php echo $dari_emp->emp_firstname ?></b><br>
								<b style="">Nip. <?php echo $options[0]->nik_pengirim ?></b>
								<br><br><br>
							</td>
						</tr>
								</table>
							</td>
						</tr>
						
						
					</table>
					</td>
				</tr>
		</table>


<table>
	
<table>
	<tr>
			<td  colspan="4">Tembusan ini disampaikan kepada:<br>
	<?php
					$i=1;
					foreach ($tembusan as $k) {
						echo $i.". Sdr. ".$k->job_name."<br>";
						$i++;
					}
				 ?>
				</td>
			</tr>
</table>

<?php 
	include_once("ref_det.php");
?>
</form>
</div>

</div>
<?php
	include_once("dialog_form.php");
	include_once("dialog_agenda.php");
	include_once("dialog_agenda.php");

?>
<script type="text/javascript">

</script>

<div id="dialog-form-pilih-folder" title="Data Folder" style="z-index:99999">
    <div id="tabs">
        <div id="tabs-1" style="font-size: smaller;">
            <h4> Nota Dinas</h4>
           <table style="font-size: smaller; width: 500px; margin-top: 20px; margin-left:30px; text-align: left;" >
                <tr style="background-color: black; color:white; text-align: center;">
                    <th>Nama Folder</th>
                    <th>Set</th>
                </tr>
                <?php
                if(count($folder)<1){
                	echo "anda belum membuat Folder";
                }
                else{
                foreach ($folder as $f) {
                    if($f->folder_name<>"inbox" and $f->folder_name<>"sent" and $f->folder_name<>"draft" and $f->folder_name<>"progress" and $f->folder_name<>"archive"){ 
                        ?>
                    <tr id="pilihan-<?php echo $f->folder_id; ?>">
                        <td id="fold-<?php echo $f->folder_id; ?>" style="padding-left:20px;"><?php echo $f->folder_name ?></td>
                        <td ><button onclick='pilih_folder("<?php echo $f->folder_id; ?>")'>pilih</button></td>                        
                    </tr>
                    <?php
                    }
                }
            }
                ?>
            </table>
        </div>
    </div>
</div>
