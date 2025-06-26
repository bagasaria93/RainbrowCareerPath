<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $action == 'add' ? 'Tambah' : 'Edit' ?> Status</h1>
    <a href="<?= base_url('status') ?>" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form <?= $action == 'add' ? 'Tambah' : 'Edit' ?> Status</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('status/save') ?>" method="POST">
            <?php if($action == 'edit'): ?>
            <input type="hidden" name="id" value="<?= $status->id ?>">
            <?php endif; ?>
            
            <div class="form-group">
                <label for="nama_status">Nama Status</label>
                <input type="text" class="form-control" name="nama_status" id="nama_status" 
                       value="<?= $action == 'edit' ? $status->nama_status : '' ?>" required>
            </div>
            
            <div class="form-group">
                <label for="warna">Warna Badge</label>
                <select class="form-control" name="warna" id="warna" required>
                    <option value="primary" <?= ($action == 'edit' && $status->warna == 'primary') ? 'selected' : '' ?>>Primary (Biru)</option>
                    <option value="secondary" <?= ($action == 'edit' && $status->warna == 'secondary') ? 'selected' : '' ?>>Secondary (Abu)</option>
                    <option value="success" <?= ($action == 'edit' && $status->warna == 'success') ? 'selected' : '' ?>>Success (Hijau)</option>
                    <option value="danger" <?= ($action == 'edit' && $status->warna == 'danger') ? 'selected' : '' ?>>Danger (Merah)</option>
                    <option value="warning" <?= ($action == 'edit' && $status->warna == 'warning') ? 'selected' : '' ?>>Warning (Kuning)</option>
                    <option value="info" <?= ($action == 'edit' && $status->warna == 'info') ? 'selected' : '' ?>>Info (Cyan)</option>
                </select>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?= base_url('status') ?>" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>