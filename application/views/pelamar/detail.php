<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Pelamar</h1>
    <a href="<?= base_url('pelamar') ?>" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-xl-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Pelamar</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr><td><strong>Nama Lengkap</strong></td><td><?= $pelamar->nama_lengkap ?></td></tr>
                            <tr><td><strong>No HP</strong></td><td><?= $pelamar->no_hp ?></td></tr>
                            <tr><td><strong>Email</strong></td><td><?= $pelamar->email ?></td></tr>
                            <tr><td><strong>Tanggal Lahir</strong></td><td><?= tanggal_indo($pelamar->tanggal_lahir) ?></td></tr>
                            <tr><td><strong>Alamat</strong></td><td><?= $pelamar->alamat ?></td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr><td><strong>Departemen</strong></td><td><?= $pelamar->nama_departemen ?></td></tr>
                            <tr><td><strong>Level Jabatan</strong></td><td><?= $pelamar->nama_level ?></td></tr>
                            <tr><td><strong>Sumber</strong></td><td><?= $pelamar->nama_sumber ?></td></tr>
                            <tr><td><strong>Status Saat Ini</strong></td><td><span class="badge badge-<?= isset($pelamar->warna) ? $pelamar->warna : 'secondary' ?>"><?= $pelamar->nama_status ?></span></td></tr>
                            <tr><td><strong>Tanggal Apply</strong></td><td><?= tanggal_indo($pelamar->tanggal_apply) ?></td></tr>
                        </table>
                    </div>
                </div>
                
                <?php if($pelamar->catatan): ?>
                <div class="row mt-3">
                    <div class="col-12">
                        <h6><strong>Catatan:</strong></h6>
                        <p class="text-muted"><?= nl2br($pelamar->catatan) ?></p>
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="row mt-3">
                    <div class="col-12">
                        <a href="<?= base_url('pelamar/edit/'.$pelamar->id) ?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if(!empty($training_data)): ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Training</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>Jenis Training</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($training_data as $training): ?>
                            <tr>
                                <td><span class="badge badge-info"><?= $training->jenis_training ?></span></td>
                                <td><?= tanggal_indo($training->tanggal_mulai) ?></td>
                                <td><?= tanggal_indo($training->tanggal_selesai) ?></td>
                                <td>
                                    <?php 
                                    $badge_class = 'secondary';
                                    if($training->status == 'ONGOING') $badge_class = 'warning';
                                    elseif($training->status == 'COMPLETED') $badge_class = 'success';
                                    elseif($training->status == 'FAILED') $badge_class = 'danger';
                                    ?>
                                    <span class="badge badge-<?= $badge_class ?>"><?= $training->status ?></span>
                                </td>
                                <td><?= $training->nilai ?: '-' ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="col-xl-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Timeline Status</h6>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <?php foreach($timeline as $item): ?>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">
                                <?php if($item->type == 'pelamar'): ?>
                                    <i class="fas fa-user-plus text-primary"></i> Pendaftaran
                                <?php elseif($item->type == 'training'): ?>
                                    <i class="fas fa-graduation-cap text-warning"></i> Training <?= $item->jenis_training ?>
                                <?php elseif($item->type == 'karyawan'): ?>
                                    <i class="fas fa-briefcase text-success"></i> Menjadi Karyawan
                                <?php endif; ?>
                            </h6>
                            <p class="text-muted mb-1">
                                <?php if($item->type == 'pelamar'): ?>
                                    Mendaftar sebagai <?= $pelamar->nama_departemen ?>
                                <?php elseif($item->type == 'training'): ?>
                                    Training <?= $item->jenis_training ?> - Status: <?= $item->status ?>
                                    <?php if($item->nama_trainer): ?>
                                    <br><small>Trainer: <?= $item->nama_trainer ?></small>
                                    <?php endif; ?>
                                <?php elseif($item->type == 'karyawan'): ?>
                                    Dipindah ke karyawan aktif
                                <?php endif; ?>
                            </p>
                            <small class="text-muted">
                                <i class="fas fa-clock"></i> <?= tanggal_indo(date('Y-m-d', strtotime($item->tanggal))) ?>
                            </small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e3e6f0;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 0;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0 0 3px #e3e6f0;
}

.timeline-content {
    background: #f8f9fc;
    padding: 15px;
    border-radius: 8px;
    border-left: 3px solid var(--pink);
}
</style>