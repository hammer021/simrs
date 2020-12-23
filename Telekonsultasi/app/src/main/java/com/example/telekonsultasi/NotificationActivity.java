package com.example.telekonsultasi;

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
import com.example.telekonsultasi.adapter.AdapterObat;
import com.example.telekonsultasi.adapter.AdapterPeriksa;
import com.example.telekonsultasi.configfile.ServerApi;
import com.example.telekonsultasi.configfile.authdata;
import com.example.telekonsultasi.model.ModalObat;
import com.example.telekonsultasi.model.ModalPeriksa;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class NotificationActivity extends AppCompatActivity {
    RecyclerView recyclerViewPeriksa, recyclerViewObat;
    List<ModalPeriksa> item;
    List<ModalObat> item2;
    AdapterPeriksa adapterPeriksa;
    AdapterObat adapterObat;
    RequestQueue queue;
    authdata authdataa;

    String mKdRegist;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_notification);
        recyclerViewPeriksa = findViewById(R.id.recylernotifperiksa);
        recyclerViewObat = findViewById(R.id.recylernotifobat);
        authdataa = new authdata(this);
        queue = Volley.newRequestQueue(this);

        mKdRegist = authdataa.getKodeUser();

        loadPeriksa();
    }

    private void loadPeriksa() {
        StringRequest stringRequest = new StringRequest(Request.Method.GET, ServerApi.URL_GETPERIKSA + mKdRegist, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    JSONArray data = jsonObject.getJSONArray("data");

                    item = new ArrayList<>();
                    for (int i = 0; i < data.length(); i++)
                    {
                        ModalPeriksa modalPeriksa = new ModalPeriksa();
                        JSONObject datanya = data.getJSONObject(i);
                        modalPeriksa.setNama_pasien(datanya.getString("nama_pasien"));
                        modalPeriksa.setNo_rm("Nomor Rekam Medis : " + datanya.getString("no_rm"));
                        modalPeriksa.setTgl_kunjungan(datanya.getString("tgl_kunjungan"));
                        modalPeriksa.setHarga(datanya.getString("harga"));
                        modalPeriksa.setStatus(datanya.getString("status"));

                        item.add(modalPeriksa);
                    }
                    setupListView();
                } catch (Exception e) {
                    Toast.makeText(NotificationActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(NotificationActivity.this, error.toString(), Toast.LENGTH_LONG).show();
            }
        });
        queue.add(stringRequest);
    }

    private void setupListView() {
        adapterPeriksa = new AdapterPeriksa(this, item);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getApplicationContext());
        recyclerViewPeriksa.setLayoutManager(layoutManager);
        recyclerViewPeriksa.setAdapter(adapterPeriksa);

        adapterPeriksa.setListener(new AdapterPeriksa.OnHistoryClickListener() {
            @Override
            public void onClick(int position) {
                ModalPeriksa modalPeriksa = item.get(position);
                Toast.makeText(NotificationActivity.this, modalPeriksa.getNo_rm(), Toast.LENGTH_LONG).show();
//                if (modalPeriksa.getStatus() == "1") {
                    Intent detail = new Intent(NotificationActivity.this, UploadPeriksaActivity.class);
                    detail.putExtra("no_rm", modalPeriksa.getNo_rm());
                    startActivity(detail);
//                }
            }
        });
    }
}