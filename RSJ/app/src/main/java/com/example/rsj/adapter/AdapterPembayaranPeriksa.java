package com.example.rsj.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.rsj.R;
import com.example.rsj.model.ModelPembayaranPeriksa;
import com.squareup.picasso.Picasso;

import java.util.List;

import de.hdodenhof.circleimageview.CircleImageView;

public class AdapterPembayaranPeriksa extends RecyclerView.Adapter<AdapterPembayaranPeriksa.MyViewHolder> {
    private List<ModelPembayaranPeriksa> item;
    private Context context;
    private OnHistoryClickListener listener;

    public class MyViewHolder extends RecyclerView.ViewHolder {
        TextView no_rm, nama_pasien, tgl_kunjungan, harga, status;
        CircleImageView foto;

        public MyViewHolder(View itemView, final OnHistoryClickListener listener) {
            super(itemView);
            no_rm = itemView.findViewById(R.id.kode_pembayaran_periksa);
            nama_pasien = itemView.findViewById(R.id.nama_pembayaran_periksa);
            tgl_kunjungan = itemView.findViewById(R.id.tglperiksa_pembayaran_periksa);
            harga = itemView.findViewById(R.id.grandtotal_pembayaran_periksa);
            status = itemView.findViewById(R.id.status_pembayaran_periksa);
            foto = itemView.findViewById(R.id.foto_pembayaran_periksa);

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

    public AdapterPembayaranPeriksa(Context context, List<ModelPembayaranPeriksa> item) {
        this.context = context;
        this.item = item;
    }

    @NonNull
    @Override
    public AdapterPembayaranPeriksa.MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_pembayaran_periksa, parent, false);
        AdapterPembayaranPeriksa.MyViewHolder myViewHolder = new AdapterPembayaranPeriksa.MyViewHolder(layout, listener);
        return myViewHolder;
    }

    public void onBindViewHolder(@NonNull final MyViewHolder holder, int position) {
        ModelPembayaranPeriksa me = item.get(position);
        holder.no_rm.setText(me.getNo_rm());
        holder.nama_pasien.setText(me.getNama_pasien());
        holder.tgl_kunjungan.setText(me.getTgl_kunjungan());
        holder.harga.setText(me.getHarga());
//        holder.status.setText(me.getStatus());
        if (me.getStatus().equals("1")) {
            holder.status.setText("Belum Bayar");
        } else {
            holder.status.setText("Menunggu Verifikasi");
        }
        Picasso.get().load(me.getFoto()).into(holder.foto);
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
