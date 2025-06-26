<div class="d-sm-flex align-items-center justify-content-between mb-4 no-print">
    <h1 class="h3 mb-0 text-gray-800">Laporan Data Pelamar</h1>
    <button onclick="window.print()" class="btn btn-primary shadow-sm">
        <i class="fas fa-print fa-sm text-white-50"></i> Print Laporan
    </button>
</div>

<div class="card mb-4 no-print filter-section">
    <div class="card-header bg-primary text-white">Filter Laporan</div>
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

<div class="card shadow mb-4">
    <div class="card-header py-3 text-center">
        <h4 class="m-0 font-weight-bold">LAPORAN PELAMAR</h4>
        <p class="mb-0">Periode: <?= $this->input->get('tanggal_dari') ? tanggal_indo($this->input->get('tanggal_dari')) : 'Semua' ?> 
        s/d <?= $this->input->get('tanggal_sampai') ? tanggal_indo($this->input->get('tanggal_sampai')) : 'Semua' ?></p>
        <small class="text-muted">Dibuat pada: <?= date('d F Y, H:i:s') ?> WIB</small>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" style="font-size: 16px;">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Nama Lengkap</th>
                        <th style="width: 15%;">No HP</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 15%;">Departemen</th>
                        <th style="width: 10%;">Tanggal Apply</th>
                        <th style="width: 10%;">Tanggal Interview</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($pelamar as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->nama_lengkap ?></td>
                        <td><?= $row->no_hp ?></td>
                        <td><?= $row->email ?></td>
                        <td><?= $row->nama_departemen ?></td>
                        <td><?= tanggal_indo($row->tanggal_apply) ?></td>
                        <td><?= $row->tanggal_interview ? tanggal_indo($row->tanggal_interview) : '-' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7" class="text-center">Total Data: <?= count($pelamar) ?> Pelamar</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>