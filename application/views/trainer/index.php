<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Trainer</h1>
    <a href="<?= base_url('trainer/add') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Trainer
    </a>
</div>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">Filter Data</div>
    <div class="card-body">
        <form method="GET">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama trainer..." value="<?= $this->input->get('search') ?>">
                </div>
                <div class="col-md-3">
                    <select name="departemen" class="form-control">
                        <option value="">Semua Departemen</option>
                        <?php foreach($departemen_list as $dept): ?>
                        <option value="<?= $dept->id ?>" <?= $this->input->get('departemen') == $dept->id ? 'selected' : '' ?>><?= $dept->nama_departemen ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="<?= current_url() ?>" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Trainer</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Trainer</th>
                        <th>Departemen</th>
                        <th>No HP</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($trainer as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->nama_trainer ?></td>
                        <td><?= $row->nama_departemen ?: '-' ?></td>
                        <td><?= $row->no_hp ?: '-' ?></td>
                        <td><?= $row->email ?: '-' ?></td>
                        <td>
                            <a href="<?= base_url('trainer/edit/'.$row->id) ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('trainer/delete/'.$row->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data trainer?')">
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