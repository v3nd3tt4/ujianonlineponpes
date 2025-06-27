<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Hasil Ujian</h4>
					</div>
					<div class="card-body">
						<div class="alert alert-info">
							<i class="fas fa-info-circle"></i>
							Silahkan pilih Mata Pelajaran Dan Kelas yang anda ampu
						</div>
						<form action="<?= base_url('guru/hasil_ujian/cetak_pdf') ?>" method="post" target="_blank">

							<div class="form-group">
								<label for="">Matapelajaran: </label>
								<select name="matapelajaran_id" id="matapelajaran_id" class="form-control">
									<option value="">--Pilih--</option>
									<?php foreach($mapel as $mp){?>
									<option value="<?=$mp->id?>"><?=$mp->kode_matapelajaran?> - <?=$mp->nama_matapelajaran?></option>
									<?php }?>
								</select>
							</div>
							<div class="form-group">
								<label for="">Kelas Ujian:</label>
								<select name="kelas_id" id="kelas_id" class="form-control">
									<option value="">-Pilih--</option>
								</select>
							</div>
							<button type="submit" class="btn btn-primary"> <i class="fas fa-sync"></i> Proses</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
