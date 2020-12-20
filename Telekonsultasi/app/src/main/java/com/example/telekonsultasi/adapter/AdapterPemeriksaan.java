package com.example.telekonsultasi.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.telekonsultasi.R;
import com.example.telekonsultasi.model.ModalPemeriksaan;

import java.util.List;

public class AdapterPemeriksaan extends RecyclerView.Adapter<AdapterPemeriksaan.MyViewHolder> {
    private List<ModalPemeriksaan> item;
    private Context context;

    public class MyViewHolder extends RecyclerView.ViewHolder{
        TextView no_rm, nama_pasien, tgl_kunjungan;
        public MyViewHolder(View itemView){
            super(itemView);
            no_rm = itemView.findViewById(R.id.txtkodepasien);
            nama_pasien = itemView.findViewById(R.id.txtnamapasien);
            tgl_kunjungan = itemView.findViewById(R.id.txttglkunjungan);
        }
    }

    public AdapterPemeriksaan(Context context, List<ModalPemeriksaan> item){
        this.context = context;
        this.item = item;
    }

    @NonNull
    @Override
    public AdapterPemeriksaan.MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_pemeriksaan, parent, false);
        AdapterPemeriksaan.MyViewHolder myViewHolder = new AdapterPemeriksaan.MyViewHolder(layout);
        return myViewHolder;
    }

    public void onBindViewHolder(@NonNull final AdapterPemeriksaan.MyViewHolder holder, int position) {
        ModalPemeriksaan me = item.get(position);
        holder.no_rm.setText(me.getNo_rm());
        holder.nama_pasien.setText(me.getNama_pasien());
        holder.tgl_kunjungan.setText(me.getTgl_kunjungan());
    }

    public int getItemCount() {
        return item.size();
    }
}
