<?php include 'header.php'; 
$data			= $pagedata;
$targetLocation	= $data['document-to'];
$details		= $data['document-details'];
?>
	<div class="container-fluid">
		<div class="documents">
			<div class="documents-header">
				<h2 class="documents-title">Surat Jalan Perpindahan Aset</h2>
			</div>
			<div class="documents-body">
				<div class="row">
					<div class="col-10">
						<p class="bold">Tujuan</p>
					</div>
				</div>
				<div class="row document-header small">
					<div class="col-6" style="border-right: 0.5px solid #000;">
						<table class="table table-invoice">
							<thead>
								<tr>
									<th>label</th><th>:</th><th>value</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Nama Lokasi</td><td class="colon">:</td><td><?php echo $targetLocation->name; ?></td>
								</tr>
								<tr>
									<td>P.J</td><td class="colon">:</td><td><?php echo $targetLocation->contact_person; ?></td>
								</tr>
								<tr>
									<td>No. Telepon</td><td class="colon">:</td><td><?php echo $targetLocation->phone; ?></td>
								</tr>
								<tr>
									<td>Alamat</td><td class="colon">:</td><td><?php echo $targetLocation->address; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-4">
						<table class="table table-invoice">
							<thead>
								<tr>
									<th>label</th><th>:</th><th>value</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>No. Dokumen</td><td class="colon">:</td><td><?php echo $data['document-number']; ?></td>
								</tr>
								<tr>
									<td>Tanggal</td><td class="colon">:</td><td><?php echo $data['document-date']; ?></td>
								</tr>
								<tr>
									<td>Pemohon</td><td class="colon">:</td><td><?php echo $data['document-applicant']; ?></td>
								</tr>
								<tr>
									<td>Lokasi Asal</td><td class="colon">:</td><td><?php echo $data['document-from']; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row document-body">
					<div class="col-10">
						<table class="table table-invoice-detailed table-bordered">
							<thead>
								<tr>
									<th>No.</th><th>Kode</th><th>Deskripsi</th><th>Sublokasi</th><th>Qty</th>
								</tr>
							</thead>
							<tbody>
<?php 
$line = 1;
foreach ($details as $detail): ?>
								<tr>
									<td><?php echo $line; ?></td><td><?php echo $detail->code; ?></td><td><?php echo $detail->name; ?></td><td><?php echo $detail->osbl_name; ?></td><td><?php echo $detail->qty; ?></td>
								</tr>
<?php
$line++;
endforeach;
?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row document-footer">
					<div class="col-10">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Pembuat</th><th>Pemeriksa</th><th>Pengirim</th><th>Penerima</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td></td><td></td><td></td><td></td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<th><?php echo $data['document-applicant']; ?></th><th></th><th></th><th></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include 'footer.php'; ?>