package com.example.rsj.model;

import com.example.rsj.configfile.ServerApi;

public class ModelPasienTerdaftar {
    private String no_rm;
    private String nama_pasien;
    private String tgl_lahir;
    private String foto;

    public String getNo_rm() {
        return no_rm;
    }

    public void setNo_rm(String no_rm) {
        this.no_rm = "Nomor Periksa : " + no_rm;
    }

    public String getNama_pasien() {
        return nama_pasien;
    }

    public void setNama_pasien(String nama_pasien) {
        this.nama_pasien = nama_pasien;
    }

    public String getTgl_lahir() {
        return tgl_lahir;
    }

    public void setTgl_lahir(String tgl_lahir) {
        this.tgl_lahir = "Tanggal Lahir : " + tgl_lahir;
    }

    public String getFoto(){
//        return "http://192.168.43.254/simrs/Web/assets/images/user/";
        return ServerApi.URL_FOTOPASIEN + foto;
    }

    public void setFoto(String foto) {
        this.foto = foto;
    }
}
