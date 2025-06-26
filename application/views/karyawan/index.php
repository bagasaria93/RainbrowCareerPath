<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Karyawan</h1>
    <a href="<?= base_url('karyawan/add') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Karyawan
    </a>
</div>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">Filter Data</div>
    <div class="card-body">
        <form method="GET">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama, HP, email..." value="<?= $this->input->get('search') ?>">
                </div>
                <div class="col-md-2">
                    <select name="departemen" class="form-control">
                        <option value="">Semua Departemen</option>
                        <?php foreach($departemen_list as $dept): ?>
                        <option value="<?= $dept->id ?>" <?= $this->input->get('departemen') == $dept->id ? 'selected' : '' ?>><?= $dept->nama_departemen ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status_karyawan" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="AKTIF" <?= $this->input->get('status_karyawan') == 'AKTIF' ? 'selected' : '' ?>>AKTIF</option>
                        <option value="RESIGN" <?= $this->input->get('status_karyawan') == 'RESIGN' ? 'selected' : '' ?>>RESIGN</option>
                        <option value="TERMINATED" <?= $this->input->get('status_karyawan') == 'TERMINATED' ? 'selected' : '' ?>>TERMINATED</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status_penempatan" class="form-control">
                        <option value="">Semua Penempatan</option>
                        <option value="HEAD OFFICE" <?= $this->input->get('status_penempatan') == 'HEAD OFFICE' ? 'selected' : '' ?>>HEAD OFFICE</option>
                        <option value="STORE BM" <?= $this->input->get('status_penempatan') == 'STORE BM' ? 'selected' : '' ?>>STORE BM</option>
                        <option value="STORE SULAM" <?= $this->input->get('status_penempatan') == 'STORE SULAM' ? 'selected' : '' ?>>STORE SULAM</option>
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
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Karyawan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>No HP</th>
                        <th>Email</th>
                        <th>Departemen</th>
                        <th>Level</th>
                        <th>Tanggal Masuk</th>
                        <th>Status Penempatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($karyawan as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->nama_lengkap ?></td>
                        <td><?= $row->no_hp ?></td>
                        <td><?= $row->email ?></td>
                        <td><?= $row->nama_departemen ?></td>
                        <td><?= $row->nama_level ?></td>
                        <td><?= tanggal_indo($row->tanggal_masuk) ?></td>
                        <td>
                            <select class="form-control form-control-sm" onchange="updateStatusPenempatan(<?= $row->id ?>, this.value)" style="font-size: 11px;">
                                <option value="">- Pilih -</option>
                                <option value="HEAD OFFICE" <?= $row->status_penempatan == 'HEAD OFFICE' ? 'selected' : '' ?>>HEAD OFFICE</option>
                                <option value="STORE BM" <?= $row->status_penempatan == 'STORE BM' ? 'selected' : '' ?>>STORE BM</option>
                                <option value="STORE SULAM" <?= $row->status_penempatan == 'STORE SULAM' ? 'selected' : '' ?>>STORE SULAM</option>
                            </select>
                        </td>
                        <td>
                            <?php 
                            $badge_class = 'secondary';
                            if($row->status_karyawan == 'AKTIF') $badge_class = 'success';
                            elseif($row->status_karyawan == 'RESIGN') $badge_class = 'warning';
                            elseif($row->status_karyawan == 'TERMINATED') $badge_class = 'danger';
                            ?>
                            <span class="badge badge-<?= $badge_class ?>"><?= $row->status_karyawan ?></span>
                        </td>
                        <td>
                            <a href="<?= base_url('karyawan/detail/'.$row->id) ?>" class="btn btn-info btn-sm" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?= base_url('karyawan/edit/'.$row->id) ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('karyawan/delete/'.$row->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data karyawan?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>