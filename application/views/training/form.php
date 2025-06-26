<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $action == 'add' ? 'Tambah' : 'Edit' ?> Training</h1>
    <a href="<?= base_url('training') ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form <?= $action == 'add' ? 'Tambah' : 'Edit' ?> Training</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('training/save') ?>" method="POST">
            <?php if($action == 'edit'): ?>
            <input type="hidden" name="id" value="<?= $training->id ?>">
            <?php endif; ?>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pelamar_id">Pelamar</label>
                        <?php if($action == 'edit'): ?>
                        <input type="hidden" name="pelamar_id" value="<?= $training->pelamar_id ?>">
                        <input type="text" class="form-control" value="<?= $nama_pelamar ?>" readonly>
                        <?php else: ?>
                        <select class="form-control" name="pelamar_id" id="pelamar_id" required>
                            <option value="">Pilih Pelamar</option>
                            <?php foreach($pelamar_list as $pelamar): ?>
                            <option value="<?= $pelamar->id ?>"><?= $pelamar->nama_lengkap ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jenis_training">Jenis Training</label>
                        <select class="form-control" name="jenis_training" id="jenis_training" required>
                            <option value="">Pilih Jenis Training</option>
                            <option value="BM" <?= ($action == 'edit' && $training->jenis_training == 'BM') ? 'selected' : '' ?>>BM</option>
                            <option value="SULAM" <?= ($action == 'edit' && $training->jenis_training == 'SULAM') ? 'selected' : '' ?>>SULAM</option>
                            <option value="HO" <?= ($action == 'edit' && $training->jenis_training == 'HO') ? 'selected' : '' ?>>HO</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="trainer_id">Trainer</label>
                        <select class="form-control" name="trainer_id" id="trainer_id">
                            <option value="">Pilih Trainer</option>
                            <?php foreach($trainer_list as $trainer): ?>
                            <option value="<?= $trainer->id ?>" <?= ($action == 'edit' && $training->trainer_id == $trainer->id) ? 'selected' : '' ?>>
                                <?= $trainer->nama_trainer ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="durasi_hari">Durasi (Hari)</label>
                        <input type="number" class="form-control" name="durasi_hari" id="durasi_hari" 
                               value="<?= $action == 'edit' ? $training->durasi_hari : '14' ?>" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" 
                               value="<?= $action == 'edit' ? $training->tanggal_mulai : date('Y-m-d') ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai" 
                               value="<?= $action == 'edit' ? $training->tanggal_selesai : '' ?>">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="ONGOING" <?= ($action == 'edit' && $training->status == 'ONGOING') ? 'selected' : (($action == 'add') ? 'selected' : '') ?>>ONGOING</option>
                            <option value="COMPLETED" <?= ($action == 'edit' && $training->status == 'COMPLETED') ? 'selected' : '' ?>>COMPLETED</option>
                            <option value="FAILED" <?= ($action == 'edit' && $training->status == 'FAILED') ? 'selected' : '' ?>>FAILED</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nilai">Nilai</label>
                        <input type="number" step="0.01" min="0" max="100" class="form-control" name="nilai" id="nilai" 
                               value="<?= $action == 'edit' ? $training->nilai : '' ?>" placeholder="0-100">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="catatan">Catatan</label>
                <textarea class="form-control" name="catatan" id="catatan" rows="3"><?= $action == 'edit' ? $training->catatan : '' ?></textarea>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?= base_url('training') ?>" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('tanggal_mulai').addEventListener('change', function() {
    var startDate = new Date(this.value);
    var durasi = parseInt(document.getElementById('durasi_hari').value) || 14;
    var endDate = new Date(startDate);
    endDate.setDate(startDate.getDate() + durasi);
    
    var month = ('0' + (endDate.getMonth() + 1)).slice(-2);
    var day = ('0' + endDate.getDate()).slice(-2);
    var year = endDate.getFullYear();
    
    document.getElementById('tanggal_selesai').value = year + '-' + month + '-' + day;
});

document.getElementById('durasi_hari').addEventListener('change', function() {
    var startDateValue = document.getElementById('tanggal_mulai').value;
    if(startDateValue) {
        var startDate = new Date(startDateValue);
        var durasi = parseInt(this.value) || 14;
        var endDate = new Date(startDate);
        endDate.setDate(startDate.getDate() + durasi);
        
        var month = ('0' + (endDate.getMonth() + 1)).slice(-2);
        var day = ('0' + endDate.getDate()).slice(-2);
        var year = endDate.getFullYear();
        
        document.getElementById('tanggal_selesai').value = year + '-' + month + '-' + day;
    }
});
</script>