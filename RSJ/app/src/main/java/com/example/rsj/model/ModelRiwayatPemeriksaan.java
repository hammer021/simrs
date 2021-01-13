package com.example.rsj.model;

public class ModelRiwayatPemeriksaan {
    private String no_rm;
    private String nama_pasien;
    private String tgl_kunjungan;

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
}
