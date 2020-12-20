package com.example.telekonsultasi.model;

public class ModalLayanan {
    private String qty_det;
    private String subtotal;
    private String nama_barang;
    private String harga;

    public String getQty_det() {
        return qty_det;
    }

    public void setQty_det(String qty_det) {
        this.qty_det = "Quantity : " + qty_det;
    }

    public String getSubtotal() {
        return subtotal;
    }

    public void setSubtotal(String subtotal) {
        this.subtotal = "Subtotal : " + subtotal;
    }

    public String getNama_barang() {
        return nama_barang;
    }

    public void setNama_barang(String nama_barang) {
        this.nama_barang = "Nama Barang : " + nama_barang;
    }

    public String getHarga() {
        return harga;
    }

    public void setHarga(String harga) {
        this.harga = "Harga per barang : " + harga;
    }
}
