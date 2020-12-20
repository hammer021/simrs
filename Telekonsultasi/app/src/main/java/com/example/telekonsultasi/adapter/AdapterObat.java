package com.example.telekonsultasi.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.telekonsultasi.R;
import com.example.telekonsultasi.model.ModalObat;
import com.example.telekonsultasi.model.ModalPeriksa;

import java.util.List;

public class AdapterObat extends RecyclerView.Adapter<AdapterObat.MyViewHolder> {
    private List<ModalObat> item;
    private Context context;

    public class MyViewHolder extends RecyclerView.ViewHolder{
        TextView nama_pasien, tgl_kunjungan, harga, status;
        public MyViewHolder(View itemView){
            super(itemView);
            nama_pasien = itemView.findViewById(R.id.namapasienobat);
            tgl_kunjungan = itemView.findViewById(R.id.tanggalobat);
            harga = itemView.findViewById(R.id.biayaobat);
            status = itemView.findViewById(R.id.statusobat);
        }
    }

    public AdapterObat(Context context, List<ModalObat> item){
        this.context = context;
        this.item = item;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_pembayaran_obat, parent, false);
        MyViewHolder myViewHolder = new AdapterObat.MyViewHolder(layout);
        return myViewHolder;
    }

    public void onBindViewHolder(@NonNull final MyViewHolder holder, int position) {
        ModalObat me = item.get(position);
        holder.nama_pasien.setText(me.getNama_pasien());
        holder.tgl_kunjungan.setText(me.getTgl_kunjungan());
        holder.harga.setText(me.getHarga());
        holder.status.setText(me.getStatus());
    }

    public int getItemCount() {
        return item.size();
    }
}
