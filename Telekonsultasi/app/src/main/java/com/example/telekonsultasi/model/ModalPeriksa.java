package com.example.telekonsultasi.model;

public class ModalPeriksa {
    private String no_rm;
    private String nama_pasien;
    private String tgl_kunjungan;
    private String harga;
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
//        }
//        if (this.status == "1") {
//            status = "Belum Bayar";
//        } else if (this.status == "3") {
//            status = "Terverifikasi";
//        }
        this.status = status;
    }
}
