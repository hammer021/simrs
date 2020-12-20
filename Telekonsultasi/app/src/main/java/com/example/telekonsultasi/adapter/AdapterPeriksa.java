package com.example.telekonsultasi.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.telekonsultasi.R;
import com.example.telekonsultasi.model.ModalPeriksa;

import java.util.List;

public class AdapterPeriksa extends RecyclerView.Adapter<AdapterPeriksa.MyViewHolder> {
    private List<ModalPeriksa> item;
    private Context context;

    public class MyViewHolder extends RecyclerView.ViewHolder{
        TextView no_rm, nama_pasien, tgl_kunjungan, harga, status;
        public MyViewHolder(View itemView){
            super(itemView);
            no_rm = itemView.findViewById(R.id.no_rmperiksa);
            nama_pasien = itemView.findViewById(R.id.namapasienperiksa);
            tgl_kunjungan = itemView.findViewById(R.id.tanggalperiksa);
            harga = itemView.findViewById(R.id.biayaperiksa);
            status = itemView.findViewById(R.id.statusperiksa);
        }
    }

    public AdapterPeriksa(Context context, List<ModalPeriksa> item){
        this.context = context;
        this.item = item;
    }

    @NonNull
    @Override
    public AdapterPeriksa.MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_pembayaran_periksa, parent, false);
        MyViewHolder myViewHolder = new AdapterPeriksa.MyViewHolder(layout);
        return myViewHolder;
    }

    public void onBindViewHolder(@NonNull final MyViewHolder holder, int position) {
        ModalPeriksa me = item.get(position);
        holder.no_rm.setText(me.getNo_rm());
        holder.nama_pasien.setText(me.getNama_pasien());
        holder.tgl_kunjungan.setText(me.getTgl_kunjungan());
        holder.harga.setText(me.getHarga());
        holder.status.setText(me.getStatus());
    }

    public int getItemCount() {
        return item.size();
    }
}
