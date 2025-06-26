<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Training</h1>
    <a href="<?= base_url('training/add') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Training
    </a>
</div>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">Filter Data</div>
    <div class="card-body">
        <form method="GET">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama pelamar..." value="<?= $this->input->get('search') ?>">
                </div>
                <div class="col-md-2">
                    <select name="jenis" class="form-control">
                        <option value="">Semua Jenis</option>
                        <option value="BM" <?= $this->input->get('jenis') == 'BM' ? 'selected' : '' ?>>BM</option>
                        <option value="SULAM" <?= $this->input->get('jenis') == 'SULAM' ? 'selected' : '' ?>>SULAM</option>
                        <option value="HO" <?= $this->input->get('jenis') == 'HO' ? 'selected' : '' ?>>HO</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="ONGOING" <?= $this->input->get('status') == 'ONGOING' ? 'selected' : '' ?>>ONGOING</option>
                        <option value="COMPLETED" <?= $this->input->get('status') == 'COMPLETED' ? 'selected' : '' ?>>COMPLETED</option>
                        <option value="FAILED" <?= $this->input->get('status') == 'FAILED' ? 'selected' : '' ?>>FAILED</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="tanggal_dari" class="form-control" value="<?= $this->input->get('tanggal_dari') ?>" placeholder="Tanggal Dari">
                </div>
                <div class="col-md-2">
                    <input type="date" name="tanggal_sampai" class="form-control" value="<?= $this->input->get('tanggal_sampai') ?>" placeholder="Tanggal Sampai">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <a href="<?= current_url() ?>" class="btn btn-secondary btn-sm">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Training</h6>
    </div>
    <div class="card-body">
        <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
        <?php endif; ?>
        <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Training</th>
                        <th>Trainer</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Durasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($training as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->nama_pelamar ?></td>
                        <td>
                            <span class="badge badge-info"><?= $row->jenis_training ?></span>
                        </td>
                        <td><?= $row->nama_trainer ?: '-' ?></td>
                        <td><?= tanggal_indo($row->tanggal_mulai) ?></td>
                        <td><?= tanggal_indo($row->tanggal_selesai) ?></td>
                        <td><?= $row->durasi_hari ?> hari</td>
                        <td>
                            <?php 
                            $badge_class = 'secondary';
                            if($row->status == 'ONGOING') $badge_class = 'warning';
                            elseif($row->status == 'COMPLETED') $badge_class = 'success';
                            elseif($row->status == 'FAILED') $badge_class = 'danger';
                            ?>
                            <span class="badge badge-<?= $badge_class ?>"><?= $row->status ?></span>
                        </td>
                        <td>
                            <a href="<?= base_url('training/detail/'.$row->id) ?>" class="btn btn-info btn-sm" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?= base_url('training/edit/'.$row->id) ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('training/delete/'.$row->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data training?')">
                                <i class="fas fa-trash"></i>
                            </a>
                            <?php if($row->status == 'ONGOING' || $row->status == 'COMPLETED'): ?>
                            <a href="<?= base_url('training/transfer/'.$row->id) ?>" class="btn btn-success btn-sm" onclick="return confirm('Pindah ke karyawan?')">
                                <i class="fas fa-arrow-right"></i> Transfer
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>