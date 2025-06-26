</div>
            </div>
            
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Rainbrow Career Path <?= date('Y') ?></span>
                    </div>
                </div>
            </footer>
            
        </div>
    </div>
    
    <!-- Training Date Modal -->
    <div class="modal fade" id="trainingDateModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Tanggal Mulai Training
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="trainingDateForm">
                        <div class="form-group">
                            <label for="trainingDate">Pilih Tanggal Mulai Training:</label>
                            <input type="date" 
                                   class="form-control form-control-lg" 
                                   id="trainingDate" 
                                   min="<?= date('Y-m-d') ?>"
                                   required>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Tanggal tidak boleh kurang dari hari ini
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="trainingType">Jenis Training:</label>
                            <input type="text" class="form-control" id="trainingType" readonly>
                        </div>
                        <div class="form-group">
                            <label for="trainerSelect">Pilih Trainer:</label>
                            <select class="form-control" id="trainerSelect">
                                <option value="">- Pilih Trainer -</option>
                                <?php 
                                $CI =& get_instance();
                                $CI->load->model('Trainer_model');
                                $trainers = $CI->Trainer_model->get_all();
                                foreach($trainers as $trainer): ?>
                                <option value="<?= $trainer->id ?>"><?= $trainer->nama_trainer ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="emergencyName">Nama Kontak Emergency:</label>
                            <input type="text" class="form-control" id="emergencyName" placeholder="Nama lengkap kontak emergency">
                        </div>
                        <div class="form-group">
                            <label for="emergencyPhone">Nomor Telepon Emergency:</label>
                            <input type="text" class="form-control" id="emergencyPhone" placeholder="Nomor telepon kontak emergency">
                        </div>
                        <div class="form-group">
                            <label for="emergencyRelation">Hubungan Kontak Emergency:</label>
                            <select class="form-control" id="emergencyRelation">
                                <option value="">- Pilih Hubungan -</option>
                                <option value="Orang Tua">Orang Tua</option>
                                <option value="Saudara Kandung">Saudara Kandung</option>
                                <option value="Kerabat/Teman">Kerabat/Teman</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="estimatedEnd">Perkiraan Selesai:</label>
                            <input type="text" class="form-control" id="estimatedEnd" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Batal
                    </button>
                    <button type="button" class="btn btn-primary" id="confirmTraining">
                        <i class="fas fa-check mr-1"></i>Konfirmasi
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>
    
    <script>
        var base_url = '<?= base_url() ?>';
        var currentPelamarId = null;
        var currentStatusId = null;
        
        function updateTime() {
            const now = new Date();
            const options = {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric',
                hour: '2-digit', minute: '2-digit', second: '2-digit',
                timeZone: 'Asia/Jakarta'
            };
            document.getElementById('datetime').innerHTML = '<i class="fas fa-calendar-alt mr-2"></i>' + now.toLocaleDateString('id-ID', options);
        }
        setInterval(updateTime, 1000);
        
        function changeStatus(pelamar_id, status_id) {
            currentPelamarId = pelamar_id;
            currentStatusId = status_id;
            
            // Training status yang memerlukan tanggal mulai
            if(['6','7','8'].includes(status_id)) {
                var trainingTypes = {
                    '6': 'BM (14 hari)',
                    '7': 'SULAM (14 hari)', 
                    '8': 'HO (2 hari)'
                };
                
                $('#trainingType').val(trainingTypes[status_id]);
                $('#trainingDate').val('');
                $('#estimatedEnd').val('');
                $('#trainingDateModal').modal('show');
            } else {
                // Status lainnya langsung proses
                $.post(base_url + 'pelamar/update_status', {
                    id: pelamar_id,
                    status_id: status_id
                }, function(response) {
                    if(response.success) {
                        location.reload();
                    } else {
                        alert('Gagal mengubah status');
                    }
                }, 'json').fail(function() {
                    alert('Terjadi kesalahan pada server');
                });
            }
        }
        
        // Handle tanggal training change
        $('#trainingDate').on('change', function() {
            var startDate = new Date($(this).val());
            var days = currentStatusId == '8' ? 2 : 14;
            var endDate = new Date(startDate);
            endDate.setDate(startDate.getDate() + days);
            
            var options = { year: 'numeric', month: 'long', day: 'numeric' };
            $('#estimatedEnd').val(endDate.toLocaleDateString('id-ID', options));
        });
        
        // Confirm training
        $('#confirmTraining').on('click', function() {
            var tanggal = $('#trainingDate').val();
            var trainer = $('#trainerSelect').val();
            var emergencyName = $('#emergencyName').val();
            var emergencyPhone = $('#emergencyPhone').val();
            var emergencyRelation = $('#emergencyRelation').val();
            
            if(!tanggal) {
                alert('Pilih tanggal mulai training');
                return;
            }
            
            $.post(base_url + 'pelamar/update_status', {
                id: currentPelamarId,
                status_id: currentStatusId,
                tanggal_mulai: tanggal,
                trainer_id: trainer,
                emergency_name: emergencyName,
                emergency_phone: emergencyPhone,
                emergency_relation: emergencyRelation
            }, function(response) {
                if(response.success) {
                    $('#trainingDateModal').modal('hide');
                    location.reload();
                } else {
                    alert('Gagal mengubah status');
                }
            }, 'json').fail(function() {
                alert('Terjadi kesalahan pada server');
            });
        });
        
        function updateStatusPenempatan(karyawan_id, status_penempatan) {
            if (!status_penempatan) return;
            
            $.post(base_url + 'karyawan/update_status_penempatan', {
                id: karyawan_id,
                status_penempatan: status_penempatan
            }, function(response) {
                if(response.success) {
                    location.reload();
                } else {
                    alert('Gagal mengubah status penempatan');
                }
            }, 'json').fail(function() {
                alert('Terjadi kesalahan pada server');
            });
        }
    </script>
    
</body>
</html>