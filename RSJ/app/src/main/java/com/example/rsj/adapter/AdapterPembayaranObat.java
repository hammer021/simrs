package com.example.rsj.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.rsj.R;
import com.example.rsj.model.ModelPembayaranObat;

import java.util.List;

public class AdapterPembayaranObat extends RecyclerView.Adapter<AdapterPembayaranObat.MyViewHolder> {
    private List<ModelPembayaranObat> item;
    private Context context;
    private OnHistoryClickListener listener;

    public class MyViewHolder extends RecyclerView.ViewHolder {
        TextView no_rm, nama_pasien, tgl_kunjungan, harga, status, foto;

        public MyViewHolder(View itemView, final OnHistoryClickListener listener) {
            super(itemView);
            no_rm = itemView.findViewById(R.id.kode_pembayaran_obat);
            nama_pasien = itemView.findViewById(R.id.nama_pembayaran_obat);
            tgl_kunjungan = itemView.findViewById(R.id.tglperiksa_pembayaran_obat);
            harga = itemView.findViewById(R.id.grandtotal_pembayaran_obat);
            status = itemView.findViewById(R.id.status_pembayaran_obat);
            foto = itemView.findViewById(R.id.foto_pembayaran_obat);

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

    public AdapterPembayaranObat(Context context, List<ModelPembayaranObat> item) {
        this.context = context;
        this.item = item;
    }

    @NonNull
    @Override
    public AdapterPembayaranObat.MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_pembayaran_obat, parent, false);
        AdapterPembayaranObat.MyViewHolder myViewHolder = new AdapterPembayaranObat.MyViewHolder(layout, listener);
        return myViewHolder;
    }

    public void onBindViewHolder(@NonNull final MyViewHolder holder, int position) {
        ModelPembayaranObat me = item.get(position);
        holder.no_rm.setText(me.getNo_rm());
        holder.nama_pasien.setText(me.getNama_pasien());
        holder.tgl_kunjungan.setText(me.getTgl_kunjungan());
        holder.harga.setText(me.getHarga());
        if (me.getStatus().equals("1")) {
            holder.status.setText("Belum Bayar");
        } else {
            holder.status.setText("Menunggu Verifikasi");
        }
        holder.foto.setText(me.getFoto());
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
