package com.example.rsj.model;

import com.example.rsj.configfile.ServerApi;

public class ModelDokter {
    private String Nama_dokter;
    private String Foto_dokter;
    private String No_praktek;
    private String Klinik;

    public ModelDokter(){

    }

    public ModelDokter(String nama_dokter, String foto_dokter, String no_praktek, String klinik){
        Nama_dokter = nama_dokter;
        Foto_dokter = foto_dokter;
        No_praktek = no_praktek;
        Klinik = klinik;
    }

    public String getNama_dokter(){
        return Nama_dokter;
    }
    public void setNama_dokter(String nama_dokter){
        Nama_dokter = nama_dokter;
    }

    public String getNo_praktek(){
        return No_praktek;
    }
    public void setNo_praktek(String no_praktek){
        No_praktek = no_praktek;
    }

    public String getKlinik(){
        return Klinik;
    }
    public void setKlinik(String klinik){
        Klinik = klinik;
    }

    public String getFoto_dokter(){
        return ServerApi.URL_FOTODOKTER + Foto_dokter;
    }
    public void setFoto_dokter(String foto_dokter){
        Foto_dokter = foto_dokter;
    }

}
