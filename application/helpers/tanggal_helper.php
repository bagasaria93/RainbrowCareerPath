<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('tanggal_indo')) {
    function tanggal_indo($tanggal) {
        if(!$tanggal || $tanggal == '0000-00-00') return '-';
        
        $bulan = array(
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}

if (!function_exists('selisih_hari')) {
    function selisih_hari($tanggal1, $tanggal2) {
        $date1 = new DateTime($tanggal1);
        $date2 = new DateTime($tanggal2);
        $diff = $date1->diff($date2);
        return $diff->days;
    }
}

if (!function_exists('tambah_hari')) {
    function tambah_hari($tanggal, $hari) {
        $date = new DateTime($tanggal);
        $date->add(new DateInterval('P' . $hari . 'D'));
        return $date->format('Y-m-d');
    }
}