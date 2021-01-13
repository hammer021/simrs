package com.example.rsj.adapter;

import android.content.Context;
import android.media.Image;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.rsj.R;
import com.example.rsj.model.ModelDokter;
import com.example.rsj.model.ModelPasienTerdaftar;
import com.squareup.picasso.Picasso;

import java.util.List;

public class AdapterDokter extends RecyclerView.Adapter<AdapterDokter.MyViewHolder> {

    private Context mContext;
    private List<ModelDokter> mData;

    public AdapterDokter(Context mContext, List<ModelDokter> mData) {
        this.mContext = mContext;
        this.mData = mData;
    }

    @NonNull
    @Override
    public AdapterDokter.MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        View view;
        LayoutInflater mInflater = LayoutInflater.from(mContext);
        view = mInflater.inflate(R.layout.list_dokter, parent, false);
        return new MyViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull final AdapterDokter.MyViewHolder holder, int position) {
        ModelDokter me = mData.get(position);
        holder.tv_nama_dokter.setText(me.getNama_dokter());
        Picasso.get().load(me.getFoto_dokter()).into(holder.img_dokter);
    }

    @Override
    public int getItemCount() {
        return mData.size();
    }

    public static class  MyViewHolder extends RecyclerView.ViewHolder {
        TextView tv_nama_dokter, tv_nopraktek, tv_poli;
        ImageView img_dokter;
        public MyViewHolder(View itemView){
            super(itemView);
            tv_nama_dokter = itemView.findViewById(R.id.nama_dokter);
            tv_nopraktek = itemView.findViewById(R.id.no_praktek_dokter);
            tv_poli = itemView.findViewById(R.id.poli_dokter);
            img_dokter = itemView.findViewById(R.id.foto_dokter);
        }
    }
}
