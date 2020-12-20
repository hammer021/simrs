package com.example.telekonsultasi.model;

public class ModalObat {
    private String nama_pasien;
    private String tgl_kunjungan;
    private String harga;
    private String status;

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

    public String getHarga() {
        return harga;
    }

    public void setHarga(String harga) {
        this.harga = "Harga pendaftaran : " + harga;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }


}
