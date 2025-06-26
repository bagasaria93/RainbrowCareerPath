<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Pelamar</h1>
    <a href="<?= base_url('pelamar/add') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pelamar
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
                    <select name="status" class="form-control">
                        <option value="">Semua Status</option>
                        <?php foreach($status_list as $status): ?>
                        <option value="<?= $status->id ?>" <?= $this->input->get('status') == $status->id ? 'selected' : '' ?>><?= $status->nama_status ?></option>
                        <?php endforeach; ?>
                    </select>
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

<!-- Simple CSS untuk table header yang menarik -->
<style>
.modern-table-header {
    background: linear-gradient(90deg, #4e73df 0%, #224abe 100%);
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
}

.modern-table-header th {
    border: none;
    padding: 15px 12px;
    text-align: center;
    vertical-align: middle;
    position: relative;
}

.modern-table tbody tr:hover {
    background-color: #f8f9fc;
}

.table-container {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.whatsapp-link {
    color: #25D366;
    text-decoration: none;
    font-weight: 500;
}

.whatsapp-link:hover {
    color: #128C7E;
    text-decoration: none;
}

.whatsapp-link i {
    margin-right: 5px;
}
</style>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-table mr-2"></i>Tabel Data Pelamar
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="table-container">
                <table class="table table-bordered table-hover mb-0" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>No HP</th>
                            <th>Email</th>
                            <th>Departemen</th>
                            <th>Level</th>
                            <th>Sumber</th>
                            <th>Status</th>
                            <th>Tanggal Apply</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($pelamar as $row): ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $row->nama_lengkap ?></td>
                            <td>
                                <?php 
                                // Bersihkan nomor HP dari karakter non-digit
                                $clean_phone = preg_replace('/[^0-9]/', '', $row->no_hp);
                                
                                // Ubah format jika dimulai dengan 0 menjadi 62
                                if (substr($clean_phone, 0, 1) == '0') {
                                    $clean_phone = '62' . substr($clean_phone, 1);
                                }
                                
                                $whatsapp_url = "https://wa.me/{$clean_phone}?text=Halo%20{$row->nama_lengkap},%20saya%20dari%20Salon%20Rainbow%20terkait%20lamaran%20pekerjaan%20Anda.";
                                ?>
                                
                                <a href="<?= $whatsapp_url ?>" target="_blank" class="whatsapp-link">
                                    <i class="fab fa-whatsapp"></i><?= $row->no_hp ?>
                                </a>
                            </td>
                            <td><?= $row->email ?></td>
                            <td><?= $row->nama_departemen ?></td>
                            <td><?= $row->nama_level ?></td>
                            <td><?= $row->nama_sumber ?></td>
                            <td>
                                <span class="badge badge-<?= $row->warna ?>"><?= $row->nama_status ?></span>
                                <select class="form-control form-control-sm mt-1" onchange="changeStatus(<?= $row->id ?>, this.value)" style="font-size: 11px;">
                                    <option value="">-- Ubah Status --</option>
                                    <?php foreach($status_list as $status): ?>
                                    <option value="<?= $status->id ?>"><?= $status->nama_status ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><?= tanggal_indo($row->tanggal_apply) ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('pelamar/detail/'.$row->id) ?>" class="btn btn-info btn-sm" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('pelamar/edit/'.$row->id) ?>" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('pelamar/delete/'.$row->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data pelamar?')" title="Hapus">
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
</div>