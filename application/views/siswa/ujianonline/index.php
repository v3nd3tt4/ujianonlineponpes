<div id="content">
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Jadwal Ujian</h3>
                </div>
                <div class="panel-body">
                    <?php if (empty($jadwal)): ?>
                        <div class="alert alert-info">Tidak ada jadwal ujian yang sudah dipresensi.</div>
                    <?php else: ?>
                    <div class="responsive-table">
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Tanggal Ujian</th>
                                    <th>Lama Ujian</th>
                                    <th>Jenis Ujian</th>
                                    <th>Waktu Presensi</th>
                                    <th>Status Ujian</th>
                                    <th>Nilai</th>
                                    <th>Benar</th>
                                    <th>Salah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach ($jadwal as $j): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($j->nama_matapelajaran) ?></td>
                                    <td><?= htmlspecialchars($j->nama_kelas) ?></td>
                                    <td><?= htmlspecialchars($j->tanggal_ujian) ?></td>
                                    <td><?= htmlspecialchars($j->lama_ujian) ?> Menit</td>
                                    <td><?= htmlspecialchars($j->jenis_ujian) ?></td>
                                    <td><?= htmlspecialchars($j->waktu_hadir) ?></td>
                                    <td>
                                        <?php
                                            if ($j->status_ujian == 'sedang') {
                                                echo '<span class="label label-warning">Sedang Mengerjakan</span>';
                                            } else if ($j->status_ujian == 'selesai') {
                                                echo '<span class="label label-success">Selesai</span>';
                                            } else {
                                                echo '<span class="label label-default">Belum</span>';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($j->status_ujian == 'selesai'): ?>
                                            <?= is_null($j->nilai_akhir) ? '-' : $j->nilai_akhir ?>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($j->status_ujian == 'selesai' && $j->jawaban): 
                                            // Ambil kunci jawaban dari database
                                            $soal = [];
                                            if (!empty($j->banksoal_id)) {
                                                $CI =& get_instance();
                                                $CI->load->database();
                                                $soal = $CI->db->get_where('tb_soal', ['banksoal_id' => $j->banksoal_id])->result();
                                            }
                                            $jawaban = json_decode($j->jawaban, true);
                                            $benar = 0;
                                            foreach ($soal as $s) {
                                                if (isset($jawaban[$s->id]) && $jawaban[$s->id] == $s->kunci_jawaban) {
                                                    $benar++;
                                                }
                                            }
                                            echo $benar;
                                        else:
                                            echo '-';
                                        endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($j->status_ujian == 'selesai' && $j->jawaban): 
                                            $salah = 0;
                                            if (!empty($soal)) {
                                                $salah = count($soal) - $benar;
                                            }
                                            echo $salah;
                                        else:
                                            echo '-';
                                        endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($j->status_ujian == 'sedang'): ?>
                                            <a href="<?= base_url('user/ujianonline/kerjakan/'.$j->id) ?>" class="btn btn-warning btn-sm">Lanjutkan Ujian</a>
                                        <?php elseif ($j->status_ujian == 'selesai'): ?>
                                            <button class="btn btn-success btn-sm" disabled>Selesai</button>
                                        <?php else: ?>
                                            <a href="<?= base_url('user/ujianonline/mulai/'.$j->id) ?>" class="btn btn-primary btn-sm">Mulai Ujian</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div> 