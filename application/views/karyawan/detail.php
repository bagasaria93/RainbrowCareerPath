<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Karyawan</h1>
    <a href="<?= base_url('karyawan') ?>" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-xl-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Karyawan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr><td><strong>Nama Lengkap</strong></td><td><?= $karyawan->nama_lengkap ?></td></tr>
                            <tr><td><strong>No HP</strong></td><td><?= $karyawan->no_hp ?></td></tr>
                            <tr><td><strong>Email</strong></td><td><?= $karyawan->email ?></td></tr>
                            <tr><td><strong>Departemen</strong></td><td><?= $karyawan->nama_departemen ?></td></tr>
                            <tr><td><strong>Level Jabatan</strong></td><td><?= $karyawan->nama_level ?></td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr><td><strong>Tanggal Masuk</strong></td><td><?= tanggal_indo($karyawan->tanggal_masuk) ?></td></tr>
                            <tr><td><strong>Status Karyawan</strong></td><td>
                                <?php 
                                $badge_class = 'secondary';
                                if($karyawan->status_karyawan == 'AKTIF') $badge_class = 'success';
                                elseif($karyawan->status_karyawan == 'RESIGN') $badge_class = 'warning';
                                elseif($karyawan->status_karyawan == 'TERMINATED') $badge_class = 'danger';
                                ?>
                                <span class="badge badge-<?= $badge_class ?>"><?= $karyawan->status_karyawan ?></span>
                            </td></tr>
                            <!-- <tr><td><strong>Gaji</strong></td><td><?= $karyawan->gaji ? 'Rp ' . number_format($karyawan->gaji, 0, ',', '.') : '-' ?></td></tr> -->
                            <tr><td><strong>Dibuat</strong></td><td><?= tanggal_indo(date('Y-m-d', strtotime($karyawan->created_at))) ?></td></tr>
                        </table>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-12">
                        <a href="<?= base_url('karyawan/edit/'.$karyawan->id) ?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if($training_data): ?>
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
                                <th>Trainer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge badge-info"><?= $training_data->jenis_training ?></span></td>
                                <td><?= tanggal_indo($training_data->tanggal_mulai) ?></td>
                                <td><?= tanggal_indo($training_data->tanggal_selesai) ?></td>
                                <td>
                                    <span class="badge badge-success"><?= $training_data->status ?></span>
                                </td>
                                <td><?= $training_data->nama_trainer ?: '-' ?></td>
                            </tr>
                        </tbody>
                    </table>
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
                            <tr><td><strong>Nama Emergency</strong></td><td><?= $training_data->emergency_name ?: '-' ?></td></tr>
                            <tr><td><strong>No HP Emergency</strong></td><td><?= $training_data->emergency_phone ?: '-' ?></td></tr>
                            <tr><td><strong>Hubungan</strong></td><td><?= $training_data->emergency_relation ?: '-' ?></td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="col-xl-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Asal Pelamar</h6>
            </div>
            <div class="card-body">
                <?php if($pelamar_data): ?>
                <table class="table table-borderless">
                    <tr><td><strong>Tanggal Apply</strong></td><td><?= tanggal_indo($pelamar_data->tanggal_apply) ?></td></tr>
                    <tr><td><strong>Tanggal Interview</strong></td><td><?= $pelamar_data->tanggal_interview ? tanggal_indo($pelamar_data->tanggal_interview) : '-' ?></td></tr>
                    <tr><td><strong>Sumber</strong></td><td><?= $pelamar_data->nama_sumber ?></td></tr>
                </table>
                
                <div class="mt-3">
                    <a href="<?= base_url('pelamar/detail/'.$pelamar_data->id) ?>" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> Detail Pelamar
                    </a>
                    <?php if($training_data): ?>
                    <a href="<?= base_url('training/detail/'.$training_data->id) ?>" class="btn btn-warning btn-sm">
                        <i class="fas fa-graduation-cap"></i> Detail Training
                    </a>
                    <?php endif; ?>
                </div>
                <?php else: ?>
                <p class="text-muted">Data pelamar tidak ditemukan (mungkin ditambah manual)</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>