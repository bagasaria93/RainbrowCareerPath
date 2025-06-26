<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Departemen</h1>
    <a href="<?= base_url('departemen/add') ?>" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Departemen
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Departemen</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Departemen</th>
                        <!-- <th>Tanggal Dibuat</th> -->
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($departemen as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->nama_departemen ?></td>
                        <!-- <td><?= tanggal_indo(date('Y-m-d', strtotime($row->created_at))) ?></td> -->
                        <td>
                            <a href="<?= base_url('departemen/edit/'.$row->id) ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('departemen/delete/'.$row->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus departemen?')">
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