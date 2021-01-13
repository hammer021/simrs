package com.example.rsj.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.rsj.R;
import com.example.rsj.model.ModelInbox;
import com.squareup.picasso.Picasso;

import java.util.List;

import de.hdodenhof.circleimageview.CircleImageView;

public class AdapterInbox extends RecyclerView.Adapter<AdapterInbox.MyViewHolder> {
    private List<ModelInbox> item;
    private Context context;
    private OnHistoryClickListener listener;

    public class MyViewHolder extends RecyclerView.ViewHolder{
        TextView no_rm, nama_pasien, tgl_kunjungan;
        CircleImageView foto;
        public MyViewHolder(View itemView, final OnHistoryClickListener listener) {
            super(itemView);
            no_rm = itemView.findViewById(R.id.kode_pembayaran_inbox);
            nama_pasien = itemView.findViewById(R.id.nama_pembayaran_inbox);
            tgl_kunjungan = itemView.findViewById(R.id.tglperiksa_pembayaran_inbox);
            foto = itemView.findViewById(R.id.foto_pembayaran_inbox);

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

    public AdapterInbox(Context context, List<ModelInbox> item) {
        this.context = context;
        this.item = item;
    }

    @NonNull
    @Override
    public AdapterInbox.MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_inbox, parent, false);
        AdapterInbox.MyViewHolder myViewHolder = new AdapterInbox.MyViewHolder(layout, listener);
        return myViewHolder;
    }

    public void onBindViewHolder(@NonNull final MyViewHolder holder, int position) {
        ModelInbox me = item.get(position);
        holder.no_rm.setText(me.getNo_rm());
        holder.nama_pasien.setText(me.getNama_pasien());
        holder.tgl_kunjungan.setText(me.getTgl_kunjungan());
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
