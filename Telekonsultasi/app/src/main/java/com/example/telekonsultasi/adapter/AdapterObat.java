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
    private AdapterPeriksa.OnHistoryClickListener listener;

    public class MyViewHolder extends RecyclerView.ViewHolder{
        TextView no_rm, nama_pasien, tgl_kunjungan, harga, status;
        public MyViewHolder(View itemView,final AdapterPeriksa.OnHistoryClickListener listener){
            super(itemView);
            no_rm = itemView.findViewById(R.id.kdkonsul);
            nama_pasien = itemView.findViewById(R.id.namapasienobat);
            tgl_kunjungan = itemView.findViewById(R.id.tanggalobat);
            harga = itemView.findViewById(R.id.biayaobat);
            status = itemView.findViewById(R.id.statusobat);

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

    public AdapterObat(Context context, List<ModalObat> item){
        this.context = context;
        this.item = item;
    }

    @NonNull
    @Override
    public AdapterObat.MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_pembayaran_obat, parent, false);
        MyViewHolder myViewHolder = new AdapterObat.MyViewHolder(layout, listener);
        return myViewHolder;
    }

    public void onBindViewHolder(@NonNull final MyViewHolder holder, int position) {
        ModalObat me = item.get(position);
        holder.no_rm.setText(me.getNo_rm());
        holder.nama_pasien.setText(me.getNama_pasien());
        holder.tgl_kunjungan.setText(me.getTgl_kunjungan());
        holder.harga.setText(me.getHarga());
        if (me.getStatus().equals("1")) {
            holder.status.setText("Belum Bayar");
        }
    }

    public int getItemCount() {
        return item.size();
    }

    public interface OnHistoryClickListener {
        public void onClick(int position);
    }

    public void setListener(AdapterPeriksa.OnHistoryClickListener listener) {
        this.listener = listener;
    }
}
