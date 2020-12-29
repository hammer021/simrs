package com.example.telekonsultasi.model;

public class ModalObat {
    private String no_rm;
    private String nama_pasien;
    private String tgl_kunjungan;
    private String grand_total;
    private String status;

    public String getNo_rm() {
        return no_rm;
    }

    public void setNo_rm(String no_rm) {
        this.no_rm = "Nomor Rekam Medis : " + no_rm;
    }

    public String getNama_pasien() {
        return nama_pasien;
    }

    public void setNama_pasien(String nama_pasien) {
        this.nama_pasien = nama_pasien;
    }

    public String getTgl_kunjungan() {
        return tgl_kunjungan;
    }

    public void setTgl_kunjungan(String tgl_kunjungan) {
        this.tgl_kunjungan = "Tanggal Kunjungan : " + tgl_kunjungan;
    }

    public String getGrand_total() {
        return grand_total;
    }

    public void setGrand_total(String grand_total) {
        this.grand_total = "Harga pendaftaran : " + grand_total;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }


}
