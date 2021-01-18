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
import com.example.rsj.adapter.AdapterRiwayatPemeriksaan;
import com.example.rsj.configfile.ServerApi;
import com.example.rsj.configfile.authdata;
import com.example.rsj.model.ModelRiwayatPemeriksaan;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class RiwayatPemeriksaanActivity extends AppCompatActivity {
    RecyclerView recyclerView;
    List<ModelRiwayatPemeriksaan> item;
    AdapterRiwayatPemeriksaan adapterRiwayatPemeriksaan;

    authdata authdataa;
    RequestQueue requestQueue;

    String mKdRegist;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_riwayat_pemeriksaan);
        authdataa = new authdata(this);
        requestQueue = Volley.newRequestQueue(this);

        mKdRegist = authdataa.getKodeUser();
        recyclerView = findViewById(R.id.recyclerRiwayatPemeriksaan);
    }

    public void loadRiwayat(){
        StringRequest stringRequest = new StringRequest(Request.Method.GET, ServerApi.URL_TAMPILRIWAYAT + mKdRegist, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String status = jsonObject.getString("status");
                    String message = jsonObject.getString("message");
                    JSONArray data = jsonObject.getJSONArray("data");

                    if (status.equals("true")) {
                        item = new ArrayList<>();
                        for (int i = 0; i < data.length(); i++)
                        {
                            ModelRiwayatPemeriksaan modelRiwayatPemeriksaan = new ModelRiwayatPemeriksaan();
                            JSONObject datanya = data.getJSONObject(i);
                            modelRiwayatPemeriksaan.setNama_pasien(datanya.getString("nama_pasien"));
                            modelRiwayatPemeriksaan.setNo_rm(datanya.getString("no_rm"));
                            modelRiwayatPemeriksaan.setTgl_kunjungan(datanya.getString("tgl_kunjungan"));
                            item.add(modelRiwayatPemeriksaan);
                        }
                        setupListView();
                    } else {
                        Toast.makeText(RiwayatPemeriksaanActivity.this, message, Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(RiwayatPemeriksaanActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(RiwayatPemeriksaanActivity.this, error.toString(), Toast.LENGTH_LONG).show();
            }
        });
        requestQueue.add(stringRequest);
    }

    private void setupListView() {
        adapterRiwayatPemeriksaan = new AdapterRiwayatPemeriksaan(this, item);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(this);
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setAdapter(adapterRiwayatPemeriksaan);

        adapterRiwayatPemeriksaan.setListener(new AdapterRiwayatPemeriksaan.OnHistoryClickListener() {
            @Override
            public void onClick(int position) {
                ModelRiwayatPemeriksaan modelRiwayatPemeriksaan = item.get(position);
                Intent detail = new Intent(RiwayatPemeriksaanActivity.this, DetailRiwayatPemeriksaanActivity.class);
                detail.putExtra("no_rm", modelRiwayatPemeriksaan.getNo_rm());
                startActivity(detail);
                finish();
            }
        });
    }
}