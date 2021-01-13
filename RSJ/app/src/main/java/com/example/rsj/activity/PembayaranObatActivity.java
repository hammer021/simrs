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
import com.example.rsj.adapter.AdapterPembayaranObat;
import com.example.rsj.configfile.ServerApi;
import com.example.rsj.configfile.authdata;
import com.example.rsj.model.ModelPembayaranObat;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class PembayaranObatActivity extends AppCompatActivity {
    RecyclerView recyclerView;
    List<ModelPembayaranObat> item;
    AdapterPembayaranObat adapterPembayaranObat;

    RequestQueue requestQueue;
    authdata authdataa;

    String mKdRegist;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pembayaran_obat);
        authdataa = new authdata(this);
        requestQueue = Volley.newRequestQueue(this);

        mKdRegist = authdataa.getKodeUser();

        recyclerView = findViewById(R.id.recyclerPembayaranObat);

        loadObat();
    }

    private void loadObat(){
        StringRequest stringRequest = new StringRequest(Request.Method.GET, ServerApi.URL_GETRESEP + mKdRegist, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    JSONArray data = jsonObject.getJSONArray("data");

                    item = new ArrayList<>();
                    for (int i = 0; i < data.length(); i++)
                    {
                        ModelPembayaranObat modelPembayaranObat = new ModelPembayaranObat();
                        JSONObject datanya = data.getJSONObject(i);
                        modelPembayaranObat.setNama_pasien(datanya.getString("nama_pasien"));
                        modelPembayaranObat.setNo_rm(datanya.getString("no_rm"));
                        modelPembayaranObat.setTgl_kunjungan(datanya.getString("tgl_kunjungan"));
                        modelPembayaranObat.setHarga(datanya.getString("grand_total"));
                        modelPembayaranObat.setStatus(datanya.getString("status_kons"));
                        modelPembayaranObat.setStatus(datanya.getString("foto"));
                        item.add(modelPembayaranObat);
                    }
                    setupListView();
                } catch (JSONException e) {
                    Toast.makeText(PembayaranObatActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(PembayaranObatActivity.this, error.toString(), Toast.LENGTH_LONG).show();
            }
        });
        requestQueue.add(stringRequest);
    }

    private void setupListView() {
        adapterPembayaranObat = new AdapterPembayaranObat(this, item);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getApplicationContext());
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setAdapter(adapterPembayaranObat);

        adapterPembayaranObat.setListener(new AdapterPembayaranObat.OnHistoryClickListener() {
            @Override
            public void onClick(int position) {
                ModelPembayaranObat modalObat = item.get(position);
                Toast.makeText(PembayaranObatActivity.this, modalObat.getNo_rm(), Toast.LENGTH_LONG).show();
                Intent detail = new Intent(PembayaranObatActivity.this, UploadPembayaranObatActivity.class);
                detail.putExtra("no_rm", modalObat.getNo_rm());
                startActivity(detail);
                finish();
            }
        });
    }
}