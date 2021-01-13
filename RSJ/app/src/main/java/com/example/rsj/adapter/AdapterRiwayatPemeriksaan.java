package com.example.rsj.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.rsj.R;
import com.example.rsj.model.ModelRiwayatPemeriksaan;

import java.util.List;

public class AdapterRiwayatPemeriksaan extends RecyclerView.Adapter<AdapterRiwayatPemeriksaan.MyViewHolder> {
    private List<ModelRiwayatPemeriksaan> item;
    private Context context;
    private OnHistoryClickListener listener;

    public class MyViewHolder extends RecyclerView.ViewHolder {
        TextView no_rm, nama_pasien, tgl_kunjungan;

        public MyViewHolder(View itemView, final OnHistoryClickListener listener) {
            super(itemView);
            no_rm = itemView.findViewById(R.id.no_rm_riwayat);
            nama_pasien = itemView.findViewById(R.id.nama_pasien_riwayat);
            tgl_kunjungan = itemView.findViewById(R.id.tglkunjungan_pasien_riwayat);

            itemView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    if (listener != null) {
                        int position = getAdapterPosition();
                        if (position != RecyclerView.NO_POSITION) {
                            listener.onClick(position);
                        }
                    }
                }
            });
        }
    }

    public AdapterRiwayatPemeriksaan(Context context, List<ModelRiwayatPemeriksaan> item) {
        this.context = context;
        this.item = item;
    }

    @NonNull
    @Override
    public AdapterRiwayatPemeriksaan.MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_riwayat_pemeriksaan, parent, false);
        AdapterRiwayatPemeriksaan.MyViewHolder myViewHolder = new AdapterRiwayatPemeriksaan.MyViewHolder(layout, listener);
        return myViewHolder;
    }

    public void onBindViewHolder(@NonNull final AdapterRiwayatPemeriksaan.MyViewHolder holder, int position) {
        ModelRiwayatPemeriksaan me = item.get(position);
        holder.no_rm.setText(me.getNo_rm());
        holder.nama_pasien.setText(me.getNama_pasien());
        holder.tgl_kunjungan.setText(me.getTgl_kunjungan());
    }

    public int getItemCount() {
        return item.size();
    }

    public interface OnHistoryClickListener {
        public void onClick(int position);
    }

    public void setListener(OnHistoryClickListener listener) {
        this.listener = listener;
    }
}
