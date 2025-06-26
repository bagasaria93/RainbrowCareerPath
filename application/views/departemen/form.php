<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $action == 'add' ? 'Tambah' : 'Edit' ?> Departemen</h1>
    <a href="<?= base_url('departemen') ?>" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form <?= $action == 'add' ? 'Tambah' : 'Edit' ?> Departemen</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('departemen/save') ?>" method="POST">
            <?php if($action == 'edit'): ?>
            <input type="hidden" name="id" value="<?= $departemen->id ?>">
            <?php endif; ?>
            
            <div class="form-group">
                <label for="nama_departemen">Nama Departemen</label>
                <input type="text" class="form-control" name="nama_departemen" id="nama_departemen" 
                       value="<?= $action == 'edit' ? $departemen->nama_departemen : '' ?>" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?= base_url('departemen') ?>" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>