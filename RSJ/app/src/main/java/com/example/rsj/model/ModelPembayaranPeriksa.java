package com.example.rsj.model;

import com.example.rsj.configfile.ServerApi;

public class ModelPembayaranPeriksa {
    private String no_rm;
    private String nama_pasien;
    private String tgl_kunjungan;
    private String harga;
    private String status;
    private String foto;

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
        this.harga = harga;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public String getFoto(){
//        return "http://192.168.43.254/simrs/Web/assets/images/user/";
        return ServerApi.URL_FOTOPASIEN + foto;
    }

    public void setFoto(String foto) {
        this.foto = foto;
    }
}
