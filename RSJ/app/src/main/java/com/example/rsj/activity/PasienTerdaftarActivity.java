package com.example.rsj.activity;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.rsj.R;
import com.example.rsj.adapter.AdapterPasienTerdaftar;
import com.example.rsj.configfile.ServerApi;
import com.example.rsj.configfile.authdata;
import com.example.rsj.model.ModelPasienTerdaftar;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class PasienTerdaftarActivity extends AppCompatActivity {
    RecyclerView recyclerView;
    List<ModelPasienTerdaftar> item;
    AdapterPasienTerdaftar adapterPasienTerdaftar;

    RequestQueue requestQueue;
    authdata authdataa;

    String mKdRegist;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pasien_terdaftar);
        authdataa = new authdata(this);
        requestQueue = Volley.newRequestQueue(this);

        recyclerView = findViewById(R.id.recyclerPasienterdaftar);
        mKdRegist = authdataa.getKodeUser();

        loadPasien();
    }

    public void loadPasien(){
        StringRequest stringRequest = new StringRequest(Request.Method.GET, ServerApi.URL_GETPASIEN + mKdRegist, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    JSONArray data = jsonObject.getJSONArray("data");
                    item = new ArrayList<>();
                    for (int i = 0; i < data.length(); i++)
                    {
                        ModelPasienTerdaftar modelPasienTerdaftar = new ModelPasienTerdaftar();
                        JSONObject datanya = data.getJSONObject(i);
                        modelPasienTerdaftar.setNama_pasien(datanya.getString("nama_pasien"));
                        modelPasienTerdaftar.setNo_rm(datanya.getString("no_rm"));
                        modelPasienTerdaftar.setTgl_lahir(datanya.getString("tgl_lahir"));
                        modelPasienTerdaftar.setFoto(datanya.getString("foto"));

                        item.add(modelPasienTerdaftar);
                    }
                    adapterPasienTerdaftar = new AdapterPasienTerdaftar(PasienTerdaftarActivity.this, item);
                    RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(PasienTerdaftarActivity.this);
                    recyclerView.setLayoutManager(layoutManager);
                    recyclerView.setAdapter(adapterPasienTerdaftar);

                    adapterPasienTerdaftar.setListener(new AdapterPasienTerdaftar.OnHistoryClickListener() {
                        @Override
                        public void onClick(int position) {
                            ModelPasienTerdaftar modelPasienTerdaftar = item.get(position);
                            Toast.makeText(PasienTerdaftarActivity.this, modelPasienTerdaftar.getNo_rm(), Toast.LENGTH_LONG).show();

                            Intent detail = new Intent(PasienTerdaftarActivity.this, DetailPasienTerdaftarActivity.class);
                            detail.putExtra("no_rm", modelPasienTerdaftar.getNo_rm());
                            startActivity(detail);
                        }
                    });
                } catch (JSONException e) {
                    Toast.makeText(PasienTerdaftarActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(PasienTerdaftarActivity.this, "Tidak ada data", Toast.LENGTH_LONG).show();
            }
        });
        requestQueue.add(stringRequest);
    }
}