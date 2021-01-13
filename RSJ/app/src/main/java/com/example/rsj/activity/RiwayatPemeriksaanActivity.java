package com.example.rsj.activity;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.RecyclerView;

import android.os.Bundle;

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

import org.json.JSONException;

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
        StringRequest stringRequest = new StringRequest(Request.Method.GET, ServerApi.URL_TAMPILCHAT, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {

                } catch (JSONException e) {

                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

            }
        });
    }
}