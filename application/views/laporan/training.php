<div class="d-sm-flex align-items-center justify-content-between mb-4 no-print">
    <h1 class="h3 mb-0 text-gray-800">Laporan Data Training</h1>
    <button onclick="window.print()" class="btn btn-primary shadow-sm">
        <i class="fas fa-print fa-sm text-white-50"></i> Print Laporan
    </button>
</div>

<div class="card mb-4 no-print filter-section">
    <div class="card-header bg-primary text-white">Filter Laporan</div>
    <div class="card-body">
        <form method="GET">
            <div class="row">
                <div class="col-md-2">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama pelamar..." value="<?= $this->input->get('search') ?>">
                </div>
                <div class="col-md-2">
                    <select name="jenis" class="form-control">
                        <option value="">Semua Jenis</option>
                        <option value="BM" <?= $this->input->get('jenis') == 'BM' ? 'selected' : '' ?>>BM</option>
                        <option value="SULAM" <?= $this->input->get('jenis') == 'SULAM' ? 'selected' : '' ?>>SULAM</option>
                        <option value="HO" <?= $this->input->get('jenis') == 'HO' ? 'selected' : '' ?>>HO</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="trainer" class="form-control">
                        <option value="">Semua Trainer</option>
                        <?php foreach($trainer_list as $trainer): ?>
                        <option value="<?= $trainer->id ?>" <?= $this->input->get('trainer') == $trainer->id ? 'selected' : '' ?>><?= $trainer->nama_trainer ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="ONGOING" <?= $this->input->get('status') == 'ONGOING' ? 'selected' : '' ?>>ONGOING</option>
                        <option value="COMPLETED" <?= $this->input->get('status') == 'COMPLETED' ? 'selected' : '' ?>>COMPLETED</option>
                        <option value="FAILED" <?= $this->input->get('status') == 'FAILED' ? 'selected' : '' ?>>FAILED</option>
                    </select>
                </div>

            </div>
            <div class="row mt-2">
                <div class="col-md-2">
                    <input type="date" name="tanggal_dari" class="form-control" value="<?= $this->input->get('tanggal_dari') ?>" placeholder="Tanggal Dari">
                </div>
                <div class="col-md-2">
                    <input type="date" name="tanggal_sampai" class="form-control" value="<?= $this->input->get('tanggal_sampai') ?>" placeholder="Tanggal Sampai">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                <div class="col-md-2">
                    <a href="<?= current_url() ?>" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 text-center">
        <h4 class="m-0 font-weight-bold">LAPORAN TRAINING</h4>
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
                        <th style="width: 25%;">Nama Pelamar</th>
                        <th style="width: 10%;">Jenis</th>
                        <th style="width: 20%;">Trainer</th>
                        <th style="width: 12%;">Tgl Mulai</th>
                        <th style="width: 12%;">Tgl Selesai</th>
                        <th style="width: 8%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($training as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->nama_pelamar ?></td>
                        <td><?= $row->jenis_training ?></td>
                        <td><?= $row->nama_trainer ?: '-' ?></td>
                        <td><?= tanggal_indo($row->tanggal_mulai) ?></td>
                        <td><?= tanggal_indo($row->tanggal_selesai) ?></td>
                        <td><?= $row->status ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7" class="text-center">Total Data: <?= count($training) ?> Training</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>