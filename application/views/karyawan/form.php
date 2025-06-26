<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $action == 'add' ? 'Tambah' : 'Edit' ?> Karyawan</h1>
    <a href="<?= base_url('karyawan') ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form <?= $action == 'add' ? 'Tambah' : 'Edit' ?> Karyawan</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('karyawan/save') ?>" method="POST">
            <?php if($action == 'edit'): ?>
            <input type="hidden" name="id" value="<?= $karyawan->id ?>">
            <?php endif; ?>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" 
                               value="<?= $action == 'edit' ? $karyawan->nama_lengkap : '' ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp" 
                               value="<?= $action == 'edit' ? $karyawan->no_hp : '' ?>">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" 
                               value="<?= $action == 'edit' ? $karyawan->email : '' ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_masuk">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" 
                               value="<?= $action == 'edit' ? $karyawan->tanggal_masuk : date('Y-m-d') ?>" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="departemen_id">Departemen</label>
                        <select class="form-control" name="departemen_id" id="departemen_id" required>
                            <option value="">Pilih Departemen</option>
                            <?php foreach($departemen_list as $dept): ?>
                            <option value="<?= $dept->id ?>" <?= ($action == 'edit' && $karyawan->departemen_id == $dept->id) ? 'selected' : '' ?>>
                                <?= $dept->nama_departemen ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="level_jabatan_id">Level Jabatan</label>
                        <select class="form-control" name="level_jabatan_id" id="level_jabatan_id" required>
                            <option value="">Pilih Level Jabatan</option>
                            <?php foreach($level_jabatan_list as $level): ?>
                            <option value="<?= $level->id ?>" <?= ($action == 'edit' && $karyawan->level_jabatan_id == $level->id) ? 'selected' : '' ?>>
                                <?= $level->nama_level ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="gaji">Gaji</label>
                        <input type="number" class="form-control" name="gaji" id="gaji" 
                               value="<?= $action == 'edit' ? $karyawan->gaji : '' ?>" placeholder="Nominal gaji">
                    </div>
                </div> -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status_penempatan">Status Penempatan</label>
                        <select class="form-control" name="status_penempatan" id="status_penempatan">
                            <option value="">- Pilih Status -</option>
                            <option value="HEAD OFFICE" <?= ($action == 'edit' && $karyawan->status_penempatan == 'HEAD OFFICE') ? 'selected' : '' ?>>HEAD OFFICE</option>
                            <option value="STORE BM" <?= ($action == 'edit' && $karyawan->status_penempatan == 'STORE BM') ? 'selected' : '' ?>>STORE BM</option>
                            <option value="STORE SULAM" <?= ($action == 'edit' && $karyawan->status_penempatan == 'STORE SULAM') ? 'selected' : '' ?>>STORE SULAM</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status_karyawan">Status Karyawan</label>
                        <select class="form-control" name="status_karyawan" id="status_karyawan" required>
                            <option value="AKTIF" <?= ($action == 'edit' && $karyawan->status_karyawan == 'AKTIF') ? 'selected' : (($action == 'add') ? 'selected' : '') ?>>AKTIF</option>
                            <option value="RESIGN" <?= ($action == 'edit' && $karyawan->status_karyawan == 'RESIGN') ? 'selected' : '' ?>>RESIGN</option>
                            <option value="TERMINATED" <?= ($action == 'edit' && $karyawan->status_karyawan == 'TERMINATED') ? 'selected' : '' ?>>TERMINATED</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?= base_url('karyawan') ?>" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>