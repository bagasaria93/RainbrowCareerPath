<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Sumber</h1>
    <a href="<?= base_url('sumber/add') ?>" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Sumber
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Sumber</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Sumber</th>
                        <!-- <th>Tanggal Dibuat</th> -->
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($sumber as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->nama_sumber ?></td>
                        <!-- <td><?= tanggal_indo(date('Y-m-d', strtotime($row->created_at))) ?></td> -->
                        <td>
                            <a href="<?= base_url('sumber/edit/'.$row->id) ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('sumber/delete/'.$row->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus sumber?')">
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