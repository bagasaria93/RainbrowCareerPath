$(document).ready(function() {
    
    // Real-time datetime update
    function updateTime() {
        const now = new Date();
        const options = {
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit',
            timeZone: 'Asia/Jakarta'
        };
        
        const formattedDate = now.toLocaleDateString('id-ID', options);
        $('#datetime').html('<i class="fas fa-calendar-alt mr-2"></i>' + formattedDate);
    }
    
    // Update time every second
    setInterval(updateTime, 1000);
    updateTime();
    
    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 1000);
        }
    });
    
    // Auto-hide alerts after 5 seconds
    $('.alert').delay(5000).fadeOut('slow');
    
    // Tooltip initialization
    $('[data-toggle="tooltip"]').tooltip();
    
    // Popover initialization
    $('[data-toggle="popover"]').popover();
    
    // Confirm delete actions
    $('.btn-danger').on('click', function(e) {
        if ($(this).data('confirm') !== false) {
            if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                e.preventDefault();
                return false;
            }
        }
    });
    
    // Form validation enhancement
    $('form').on('submit', function() {
        var form = $(this);
        var submitBtn = form.find('button[type="submit"]');
        
        submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...')
                 .prop('disabled', true);
        
        setTimeout(function() {
            submitBtn.html('<i class="fas fa-save"></i> Simpan')
                     .prop('disabled', false);
        }, 2000);
    });
    
    // Number formatting for currency inputs
    $('input[name="gaji"]').on('input', function() {
        var value = $(this).val().replace(/[^\d]/g, '');
        var formatted = new Intl.NumberFormat('id-ID').format(value);
        $(this).next('.formatted-display').remove();
        if (value) {
            $(this).after('<small class="formatted-display text-muted">Rp ' + formatted + '</small>');
        }
    });
    
    // Auto-calculate training end date
    $('#tanggal_mulai, #durasi_hari').on('change', function() {
        var startDate = $('#tanggal_mulai').val();
        var duration = parseInt($('#durasi_hari').val()) || 0;
        
        if (startDate && duration > 0) {
            var start = new Date(startDate);
            var end = new Date(start);
            end.setDate(start.getDate() + duration);
            
            var endDateStr = end.toISOString().split('T')[0];
            $('#tanggal_selesai').val(endDateStr);
        }
    });
    
    // Auto-set training duration based on type
    $('#jenis_training').on('change', function() {
        var jenis = $(this).val();
        var durasi = 14; // default
        
        if (jenis === 'HO') {
            durasi = 2;
        } else if (jenis === 'BM' || jenis === 'SULAM') {
            durasi = 14;
        }
        
        $('#durasi_hari').val(durasi);
        $('#durasi_hari').trigger('change');
    });
    
    // Enhanced table search
    $('#tableSearch').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    
    // Sidebar toggle enhancement
    $('#sidebarToggle, #sidebarToggleTop').on('click', function() {
        $('body').toggleClass('sidebar-toggled');
        $('.sidebar').toggleClass('toggled');
        
        if ($('.sidebar').hasClass('toggled')) {
            $('.sidebar .collapse').collapse('hide');
        }
    });
    
    // Auto-resize window handling
    $(window).resize(function() {
        if ($(window).width() < 768) {
            $('.sidebar').addClass('toggled');
        }
    });
    
    // Loading animation for AJAX calls
    $(document).ajaxStart(function() {
        $('body').addClass('loading');
    }).ajaxStop(function() {
        $('body').removeClass('loading');
    });
    
    // Enhanced dropdown interactions
    $('.dropdown-toggle').on('click', function() {
        $(this).parent().find('.dropdown-menu').toggleClass('show');
    });
    
    // Click outside to close dropdowns
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.dropdown').length) {
            $('.dropdown-menu').removeClass('show');
        }
    });
    
    // Status change confirmation
    $('.status-change').on('click', function(e) {
        e.preventDefault();
        var status = $(this).data('status');
        var id = $(this).data('id');
        
        if (confirm('Ubah status menjadi ' + status + '?')) {
            changeStatus(id, $(this).data('status-id'));
        }
    });
    
    // Print functionality enhancement
    $('.print-btn').on('click', function() {
        window.print();
    });
    
    // Export functionality (if needed)
    $('.export-btn').on('click', function() {
        var table = $('table');
        var csv = [];
        
        table.find('tr').each(function() {
            var row = [];
            $(this).find('th, td').each(function() {
                row.push($(this).text());
            });
            csv.push(row.join(','));
        });
        
        var csvContent = csv.join('\n');
        var link = document.createElement('a');
        link.href = 'data:text/csv;charset=utf-8,' + encodeURI(csvContent);
        link.download = 'export_' + new Date().getTime() + '.csv';
        link.click();
    });
    
    // Form field auto-fill enhancements
    $('select[name="pelamar_id"]').on('change', function() {
        var pelamarId = $(this).val();
        if (pelamarId) {
            // Auto-fill related fields if available
            // This would typically involve AJAX call to get pelamar details
        }
    });
    
    // Notification system
    function showNotification(message, type = 'success') {
        var alertClass = 'alert-' + type;
        var alert = $('<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                     message +
                     '<button type="button" class="close" data-dismiss="alert">' +
                     '<span>&times;</span></button></div>');
        
        $('.container-fluid').prepend(alert);
        
        setTimeout(function() {
            alert.fadeOut();
        }, 5000);
    }
    
    // Initialize counters for dashboard
    $('.counter').each(function() {
        var $this = $(this);
        var countTo = $this.attr('data-count');
        
        $({ countNum: $this.text() }).animate({
            countNum: countTo
        }, {
            duration: 2000,
            easing: 'linear',
            step: function() {
                $this.text(Math.floor(this.countNum));
            },
            complete: function() {
                $this.text(this.countNum);
            }
        });
    });
});

// Global functions
function changeStatus(pelamar_id, status_id) {
    // Training status yang memerlukan tanggal mulai
    if (['6', '7', '8'].includes(status_id)) {
        var tanggal = prompt('Tanggal mulai training (YYYY-MM-DD):');
        if (!tanggal) return;
        
        // Validasi format tanggal
        var dateRegex = /^\d{4}-\d{2}-\d{2}$/;
        if (!dateRegex.test(tanggal)) {
            alert('Format tanggal harus YYYY-MM-DD');
            return;
        }
        
        $.post(base_url + 'pelamar/update_status', {
            id: pelamar_id,
            status_id: status_id,
            tanggal_mulai: tanggal
        }, function(response) {
            if (response.success) {
                location.reload();
            } else {
                alert('Gagal mengubah status');
            }
        }, 'json').fail(function() {
            alert('Terjadi kesalahan pada server');
        });
    } else {
        $.post(base_url + 'pelamar/update_status', {
            id: pelamar_id,
            status_id: status_id
        }, function(response) {
            if (response.success) {
                location.reload();
            } else {
                alert('Gagal mengubah status');
            }
        }, 'json').fail(function() {
            alert('Terjadi kesalahan pada server');
        });
    }
}

function confirmTransfer(training_id) {
    if (confirm('Apakah Anda yakin ingin memindahkan training ini ke karyawan?')) {
        window.location.href = base_url + 'training/transfer/' + training_id;
    }
}

function printReport() {
    window.print();
}

function exportTable(filename = 'export') {
    var table = document.querySelector('table');
    var csv = [];
    
    for (var i = 0; i < table.rows.length; i++) {
        var row = [];
        for (var j = 0; j < table.rows[i].cells.length - 1; j++) { // Exclude action column
            row.push(table.rows[i].cells[j].innerText);
        }
        csv.push(row.join(','));
    }
    
    var csvContent = csv.join('\n');
    var link = document.createElement('a');
    link.href = 'data:text/csv;charset=utf-8,' + encodeURI(csvContent);
    link.download = filename + '_' + new Date().toISOString().split('T')[0] + '.csv';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}