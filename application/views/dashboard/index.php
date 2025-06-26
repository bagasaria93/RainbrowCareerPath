<!-- Header dengan Total Trainers -->
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <div class="d-flex align-items-center">
        <div class="card border-left-secondary shadow-sm py-2 px-3 mr-3">
            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Total Trainers</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_trainers ?></div>
        </div>
        <div class="salon-datetime-widget">
            <div class="salon-time-display">
                <div class="salon-date" id="currentDate"></div>
                <div class="salon-time" id="currentTime"></div>
                <div class="salon-timezone">Indonesia (WIB)</div>
            </div>
        </div>
    </div>
</div> -->

<div class="row">
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pelamar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['total_pelamar'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Interview</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['interview'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Training BM</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['training_bm'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Training Sulam</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['training_sulam'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Store BM</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['store_bm'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-store fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Store Sulam</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['store_sulam'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-building fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Head Office</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['head_office'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-landmark fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Trainer</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['trainer'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="row">
    
    <!-- Trainer-based Pie Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Pelamar Berdasarkan Trainer</h6>
                    
                    <!-- Trainer Filter Dropdown -->
                    <div class="dropdown">
                        <select class="form-control form-control-sm" id="trainerFilter" onchange="filterByTrainer()" style="width: 200px;">
                            <option value="all" <?= $selected_trainer == 'all' ? 'selected' : '' ?>>Semua Trainer</option>
                            <?php foreach($trainers as $trainer): ?>
                            <option value="<?= $trainer->id ?>" <?= $selected_trainer == $trainer->id ? 'selected' : '' ?>>
                                <?= $trainer->nama_trainer ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="trainerChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Statistics Panel -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistik Detail</h6>
            </div>
            <div class="card-body">
                
                <!-- Summary Stats -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="font-weight-bold">Total Pelamar:</span>
                        <span class="h5 mb-0"><?= $trainer_stats['total'] ?></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-success font-weight-bold">Berhasil (Store):</span>
                        <span class="text-success h6 mb-0"><?= $trainer_stats['success'] ?></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-danger font-weight-bold">Gagal:</span>
                        <span class="text-danger h6 mb-0"><?= $trainer_stats['failed_total'] ?></span>
                    </div>
                </div>
                
                <!-- Success/Failure Rates -->
                <div class="mb-4">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold text-success">Tingkat Kelulusan</span>
                            <span class="font-weight-bold text-success"><?= $trainer_stats['success_rate'] ?>%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: <?= $trainer_stats['success_rate'] ?>%"></div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold text-danger">Tingkat Kegagalan</span>
                            <span class="font-weight-bold text-danger"><?= $trainer_stats['failure_rate'] ?>%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-danger" style="width: <?= $trainer_stats['failure_rate'] ?>%"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Detailed Percentages -->
                <div>
                    <h6 class="font-weight-bold mb-3">Persentase Detail:</h6>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-info">Interview:</span>
                        <span class="font-weight-bold"><?= $trainer_stats['percentages']['interview'] ?>%</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-warning">PHK:</span>
                        <span class="font-weight-bold"><?= $trainer_stats['percentages']['phk'] ?>%</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Resign:</span>
                        <span class="font-weight-bold"><?= $trainer_stats['percentages']['resign'] ?>%</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-danger">Failed:</span>
                        <span class="font-weight-bold"><?= $trainer_stats['percentages']['failed'] ?>%</span>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <span class="text-success">Store:</span>
                        <span class="font-weight-bold"><?= $trainer_stats['percentages']['store'] ?>%</span>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
</div>

<script>
// Trainer-based Pie Chart
var ctx = document.getElementById('trainerChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?= $trainer_chart_labels ?>,
        datasets: [{
            data: <?= $trainer_chart_data ?>,
            backgroundColor: [
                '#17a2b8',  // Interview - Info Blue
                '#ffc107',  // PHK - Warning Yellow
                '#6c757d',  // Resign - Secondary Gray
                '#dc3545',  // Failed - Danger Red
                '#28a745'   // Store - Success Green
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        var total = context.dataset.data.reduce((a, b) => a + b, 0);
                        var percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                        return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                    }
                }
            }
        }
    }
});

// Function to filter by trainer
function filterByTrainer() {
    var trainerId = document.getElementById('trainerFilter').value;
    var url = new URL(window.location.href);
    
    if (trainerId === 'all') {
        url.searchParams.delete('trainer_id');
    } else {
        url.searchParams.set('trainer_id', trainerId);
    }
    
    window.location.href = url.toString();
}

// DateTime widget script (if needed)
function updateDateTime() {
    var now = new Date();
    var options = { 
        timeZone: 'Asia/Jakarta',
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        weekday: 'long'
    };
    var timeOptions = {
        timeZone: 'Asia/Jakarta',
        hour: '2-digit', 
        minute: '2-digit', 
        second: '2-digit'
    };
    
    if (document.getElementById('currentDate')) {
        document.getElementById('currentDate').textContent = now.toLocaleDateString('id-ID', options);
    }
    if (document.getElementById('currentTime')) {
        document.getElementById('currentTime').textContent = now.toLocaleTimeString('id-ID', timeOptions);
    }
}

// Update time every second
setInterval(updateDateTime, 1000);
updateDateTime();
</script>