<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Training</h1>
    <a href="<?= base_url('training') ?>" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-xl-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Training</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr><td><strong>Nama Pelamar</strong></td><td><?= $training->nama_pelamar ?></td></tr>
                            <tr><td><strong>Jenis Training</strong></td><td><span class="badge badge-info"><?= $training->jenis_training ?></span></td></tr>
                            <tr><td><strong>Trainer</strong></td><td><?= $training->nama_trainer ?: '-' ?></td></tr>
                            <tr><td><strong>Tanggal Mulai</strong></td><td><?= tanggal_indo($training->tanggal_mulai) ?></td></tr>
                            <tr><td><strong>Tanggal Selesai</strong></td><td><?= tanggal_indo($training->tanggal_selesai) ?></td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr><td><strong>Durasi</strong></td><td><?= $training->durasi_hari ?> hari</td></tr>
                            <tr><td><strong>Status Training</strong></td><td>
                                <?php 
                                $badge_class = 'secondary';
                                if($training->status == 'ONGOING') $badge_class = 'warning';
                                elseif($training->status == 'COMPLETED') $badge_class = 'success';
                                elseif($training->status == 'FAILED') $badge_class = 'danger';
                                ?>
                                <span class="badge badge-<?= $badge_class ?>"><?= $training->status ?></span>
                            </td></tr>
                            <tr><td><strong>Dibuat</strong></td><td><?= tanggal_indo(date('Y-m-d', strtotime($training->created_at))) ?></td></tr>
                        </table>
                    </div>
                </div>
                
                <?php if($training->catatan): ?>
                <div class="row mt-3">
                    <div class="col-12">
                        <h6><strong>Catatan:</strong></h6>
                        <p class="text-muted"><?= nl2br($training->catatan) ?></p>
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="row mt-3">
                    <div class="col-12">
                        <a href="<?= base_url('training/edit/'.$training->id) ?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Training
                        </a>
                        <?php if($training->status == 'ONGOING' || $training->status == 'COMPLETED'): ?>
                        <a href="<?= base_url('training/transfer/'.$training->id) ?>" class="btn btn-success" onclick="return confirm('Pindah ke karyawan?')">
                            <i class="fas fa-arrow-right"></i> Transfer ke Karyawan
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kontak Emergency</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr><td><strong>Nama Emergency</strong></td><td><?= $training->emergency_name ?: '-' ?></td></tr>
                            <tr><td><strong>No HP Emergency</strong></td><td><?= $training->emergency_phone ?: '-' ?></td></tr>
                            <tr><td><strong>Hubungan</strong></td><td><?= $training->emergency_relation ?: '-' ?></td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Pelamar</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td><strong>No HP</strong></td><td><?= $pelamar->no_hp ?></td></tr>
                    <tr><td><strong>Email</strong></td><td><?= $pelamar->email ?></td></tr>
                    <tr><td><strong>Departemen</strong></td><td><?= $pelamar->nama_departemen ?></td></tr>
                    <tr><td><strong>Level</strong></td><td><?= $pelamar->nama_level ?></td></tr>
                    <tr><td><strong>Tanggal Apply</strong></td><td><?= tanggal_indo($pelamar->tanggal_apply) ?></td></tr>
                </table>
                
                <div class="mt-3">
                    <a href="<?= base_url('pelamar/detail/'.$pelamar->id) ?>" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> Lihat Detail Pelamar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>