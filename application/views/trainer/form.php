<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $action == 'add' ? 'Tambah' : 'Edit' ?> Trainer</h1>
    <a href="<?= base_url('trainer') ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form <?= $action == 'add' ? 'Tambah' : 'Edit' ?> Trainer</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('trainer/save') ?>" method="POST">
            <?php if($action == 'edit'): ?>
            <input type="hidden" name="id" value="<?= $trainer->id ?>">
            <?php endif; ?>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_trainer">Nama Trainer</label>
                        <input type="text" class="form-control" name="nama_trainer" id="nama_trainer" 
                               value="<?= $action == 'edit' ? $trainer->nama_trainer : '' ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="departemen_id">Departemen</label>
                        <select class="form-control" name="departemen_id" id="departemen_id">
                            <option value="">Pilih Departemen</option>
                            <?php foreach($departemen_list as $dept): ?>
                            <option value="<?= $dept->id ?>" <?= ($action == 'edit' && $trainer->departemen_id == $dept->id) ? 'selected' : '' ?>>
                                <?= $dept->nama_departemen ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp" 
                               value="<?= $action == 'edit' ? $trainer->no_hp : '' ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" 
                               value="<?= $action == 'edit' ? $trainer->email : '' ?>">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?= base_url('trainer') ?>" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>