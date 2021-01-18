package com.example.rsj.activity;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.rsj.R;
import com.example.rsj.adapter.AdapterPembayaranPeriksa;
import com.example.rsj.configfile.ServerApi;
import com.example.rsj.configfile.authdata;
import com.example.rsj.model.ModelPembayaranPeriksa;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class PembayaranPeriksaActivity extends AppCompatActivity {
    RecyclerView recyclerView;
    List<ModelPembayaranPeriksa> item;
    AdapterPembayaranPeriksa adapterPembayaranPeriksa;

    RequestQueue requestQueue;
    authdata authdataa;

    String mKdRegist;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pembayaran_periksa);
        authdataa = new authdata(this);
        requestQueue = Volley.newRequestQueue(this);

        mKdRegist = authdataa.getKodeUser();

        recyclerView = findViewById(R.id.recyclerPembayaranPeriksa);

        loadPeriksa();
    }

    private void loadPeriksa(){
        StringRequest stringRequest = new StringRequest(Request.Method.GET, ServerApi.URL_GETPERIKSA + mKdRegist, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    JSONArray data = jsonObject.getJSONArray("data");

                    item = new ArrayList<>();
                    for (int i = 0; i < data.length(); i++)
                    {
                        ModelPembayaranPeriksa modelPembayaranPeriksa = new ModelPembayaranPeriksa();
                        JSONObject datanya = data.getJSONObject(i);
                        modelPembayaranPeriksa.setNama_pasien(datanya.getString("nama_pasien"));
                        modelPembayaranPeriksa.setNo_rm(datanya.getString("no_rm"));
                        modelPembayaranPeriksa.setTgl_kunjungan(datanya.getString("tgl_kunjungan"));
                        modelPembayaranPeriksa.setHarga(datanya.getString("harga"));
                        modelPembayaranPeriksa.setStatus(datanya.getString("status"));
                        modelPembayaranPeriksa.setFoto(datanya.getString("foto"));
                        item.add(modelPembayaranPeriksa);
                    }
                    setupListView();
                } catch (JSONException e) {
                    Toast.makeText(PembayaranPeriksaActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(PembayaranPeriksaActivity.this, "Tidak ada data", Toast.LENGTH_LONG).show();
            }
        });
        requestQueue.add(stringRequest);
    }

    private void setupListView() {
        adapterPembayaranPeriksa = new AdapterPembayaranPeriksa(this, item);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getApplicationContext());
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setAdapter(adapterPembayaranPeriksa);

        adapterPembayaranPeriksa.setListener(new AdapterPembayaranPeriksa.OnHistoryClickListener() {
            @Override
            public void onClick(int position) {
                ModelPembayaranPeriksa modelPembayaranPeriksa = item.get(position);
//                Toast.makeText(PembayaranPeriksaActivity.this, modelPembayaranPeriksa.getNo_rm(), Toast.LENGTH_LONG).show();
                if (modelPembayaranPeriksa.getStatus().equals("1")) {
                    Intent detail = new Intent(PembayaranPeriksaActivity.this, UploadPembayaranPeriksaActivity.class);
                    detail.putExtra("no_rm", modelPembayaranPeriksa.getNo_rm());
                    startActivity(detail);
                    finish();
                } else if (modelPembayaranPeriksa.getStatus().equals("2")) {
                    Toast.makeText(PembayaranPeriksaActivity.this, "Pembayaran sedang dalam tahap verifikasi admin, mohon ditunggu", Toast.LENGTH_LONG).show();
                }
            }
        });
    }
}