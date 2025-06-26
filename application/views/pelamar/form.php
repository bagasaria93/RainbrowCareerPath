<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $action == 'add' ? 'Tambah' : 'Edit' ?> Pelamar</h1>
    <a href="<?= base_url('pelamar') ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form <?= $action == 'add' ? 'Tambah' : 'Edit' ?> Pelamar</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('pelamar/save') ?>" method="POST">
            <?php if($action == 'edit'): ?>
            <input type="hidden" name="id" value="<?= $pelamar->id ?>">
            <?php endif; ?>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" 
                               value="<?= $action == 'edit' ? $pelamar->nama_lengkap : '' ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp" 
                               value="<?= $action == 'edit' ? $pelamar->no_hp : '' ?>">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" 
                               value="<?= $action == 'edit' ? $pelamar->email : '' ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" 
                               value="<?= $action == 'edit' ? $pelamar->tanggal_lahir : '' ?>">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat" rows="3"><?= $action == 'edit' ? $pelamar->alamat : '' ?></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="departemen_id">Departemen</label>
                        <select class="form-control" name="departemen_id" id="departemen_id" required>
                            <option value="">Pilih Departemen</option>
                            <?php foreach($departemen_list as $dept): ?>
                            <option value="<?= $dept->id ?>" <?= ($action == 'edit' && $pelamar->departemen_id == $dept->id) ? 'selected' : '' ?>>
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
                            <option value="<?= $level->id ?>" <?= ($action == 'edit' && $pelamar->level_jabatan_id == $level->id) ? 'selected' : '' ?>>
                                <?= $level->nama_level ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sumber_id">Sumber</label>
                        <select class="form-control" name="sumber_id" id="sumber_id" required>
                            <option value="">Pilih Sumber</option>
                            <?php foreach($sumber_list as $sumber): ?>
                            <option value="<?= $sumber->id ?>" <?= ($action == 'edit' && $pelamar->sumber_id == $sumber->id) ? 'selected' : '' ?>>
                                <?= $sumber->nama_sumber ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status_id">Status</label>
                        <select class="form-control" name="status_id" id="status_id" required>
                            <?php foreach($status_list as $status): ?>
                            <option value="<?= $status->id ?>" <?= ($action == 'edit' && $pelamar->status_id == $status->id) ? 'selected' : (($action == 'add' && $status->id == 5) ? 'selected' : '') ?>>
                                <?= $status->nama_status ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_apply">Tanggal Apply</label>
                        <input type="date" class="form-control" name="tanggal_apply" id="tanggal_apply" 
                               value="<?= $action == 'edit' ? $pelamar->tanggal_apply : date('Y-m-d') ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_interview">Tanggal Interview</label>
                        <input type="date" class="form-control" name="tanggal_interview" id="tanggal_interview" 
                               value="<?= $action == 'edit' ? $pelamar->tanggal_interview : '' ?>">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="catatan">Catatan</label>
                <textarea class="form-control" name="catatan" id="catatan" rows="3"><?= $action == 'edit' ? $pelamar->catatan : '' ?></textarea>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?= base_url('pelamar') ?>" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>