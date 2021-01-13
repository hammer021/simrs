package com.example.rsj.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.rsj.R;
import com.example.rsj.model.ModelPasienTerdaftar;
import com.example.rsj.model.ModelPembayaranPeriksa;
import com.squareup.picasso.Picasso;

import java.util.List;

import de.hdodenhof.circleimageview.CircleImageView;

public class AdapterPasienTerdaftar extends RecyclerView.Adapter<AdapterPasienTerdaftar.MyViewHolder> {
    private List<ModelPasienTerdaftar> item;
    private Context context;
    private OnHistoryClickListener listener;

    public class MyViewHolder extends RecyclerView.ViewHolder {
        TextView no_rm, nama_pasien, tgl_lahir;
        CircleImageView foto;

        public MyViewHolder(View itemView, final OnHistoryClickListener listener) {
            super(itemView);
            no_rm = itemView.findViewById(R.id.kode_pasien_terdaftar);
            nama_pasien = itemView.findViewById(R.id.nama_pasien_terdaftar);
            tgl_lahir = itemView.findViewById(R.id.tgllahir_pasien_terdaftar);
            foto = itemView.findViewById(R.id.foto_pasien_terdaftar);

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

    public AdapterPasienTerdaftar(Context context, List<ModelPasienTerdaftar> item) {
        this.context = context;
        this.item = item;
    }

    @NonNull
    @Override
    public AdapterPasienTerdaftar.MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_pasien_terdaftar, parent, false);
        AdapterPasienTerdaftar.MyViewHolder myViewHolder = new AdapterPasienTerdaftar.MyViewHolder(layout, listener);
        return myViewHolder;
    }

    public void onBindViewHolder(@NonNull final MyViewHolder holder, int position) {
        ModelPasienTerdaftar me = item.get(position);
        holder.no_rm.setText(me.getNo_rm());
        holder.nama_pasien.setText(me.getNama_pasien());
        holder.tgl_lahir.setText(me.getTgl_lahir());
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