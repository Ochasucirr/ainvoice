<h2><center>Data Non Agen eFishery</center></h2>
<hr/>
<table border="1" width="100%" style="text-align:center;">
	<tr>
		<th>No</th>
		<th>Nama Agen</th>
		<th>No Telephone</th>
		<th>Alamat Agen</th>
	</tr>
	<?php 
	$no = 1;
	foreach($import_datapenjualantmp as $row)
	{
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $row->namaagen; ?></td>
			<td><?php echo $row->notelepon; ?></td>
			<td><?php echo $row->alamatagen; ?></td>
		</tr>
		<?php
	}
	?>
</table>