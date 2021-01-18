package com.example.rsj.activity;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Adapter;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.rsj.R;
import com.example.rsj.adapter.AdapterDokter;
import com.example.rsj.configfile.ServerApi;
import com.example.rsj.configfile.authdata;
import com.example.rsj.model.ModelDokter;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class DokterActivity extends AppCompatActivity {

    RecyclerView recyclerView;
    List<ModelDokter> item;
    AdapterDokter adapterDokter;

    RequestQueue requestQueue;
    authdata authdataa;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dokter);
        authdataa = new authdata(this);
        requestQueue = Volley.newRequestQueue(this);

        recyclerView = findViewById(R.id.recyclerDokter);

        loadDokter();
    }

    public void loadDokter() {
        StringRequest stringRequest = new StringRequest(Request.Method.GET, ServerApi.URL_GETDOKTER, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    JSONArray data = jsonObject.getJSONArray("data");
                    item = new ArrayList<>();
                    for (int i = 0; i < data.length(); i++)
                    {
                        ModelDokter modelDokter = new ModelDokter();
                        JSONObject datanya = data.getJSONObject(i);
                        modelDokter.setFoto_dokter(datanya.getString("image"));
                        modelDokter.setNama_dokter(datanya.getString("name"));
                        modelDokter.setNo_praktek(datanya.getString("no_praktek"));
                        modelDokter.setKlinik(datanya.getString("klinik"));
                        item.add(modelDokter);
                    }
                    adapterDokter = new AdapterDokter(DokterActivity.this, item);
//                    RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(DokterActivity.this);
//                    recyclerView.setLayoutManager(layoutManager);
//                    recyclerView.setAdapter(adapterDokter);
                    item = new ArrayList<>();
                    RecyclerView recyclerView = findViewById(R.id.recyclerDokter);
                    AdapterDokter adapterDokter = new AdapterDokter(DokterActivity.this, item);
                    recyclerView.setLayoutManager(new GridLayoutManager(DokterActivity.this, 2));
                    recyclerView.setAdapter(adapterDokter);

                    adapterDokter.setListener(new AdapterDokter.OnHistoryClickListener() {
                        @Override
                        public void onClick(int position) {
                            ModelDokter modelDokter = item.get(position);
                            Toast.makeText(DokterActivity.this, modelDokter.getNo_praktek(), Toast.LENGTH_LONG).show();

                            Intent detail = new Intent(DokterActivity.this, DetailDokterActivity.class);
                            detail.putExtra("no_praktek", modelDokter.getNo_praktek());
                            startActivity(detail);
                        }
                    });
                } catch (JSONException e) {
                    Toast.makeText(DokterActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(DokterActivity.this, error.toString(), Toast.LENGTH_LONG).show();
            }
        });
        requestQueue.add(stringRequest);
    }
}



//        listDokter = new ArrayList<>();
//        listDokter.add(new ModelDokter("Docter 1", R.drawable.player1));
//        listDokter.add(new ModelDokter("Docter 2", R.drawable.player2));
//        listDokter.add(new ModelDokter("Docter 3", R.drawable.player3));
//        listDokter.add(new ModelDokter("Docter 4", R.drawable.player4));
//        listDokter.add(new ModelDokter("Docter 5", R.drawable.player5));
//        listDokter.add(new ModelDokter("Docter 6", R.drawable.player6));
//
//        listDokter.add(new ModelDokter("Docter 1", R.drawable.player1));
//        listDokter.add(new ModelDokter("Docter 2", R.drawable.player2));
//        listDokter.add(new ModelDokter("Docter 3", R.drawable.player3));
//        listDokter.add(new ModelDokter("Docter 4", R.drawable.player4));
//        listDokter.add(new ModelDokter("Docter 5", R.drawable.player5));
//        listDokter.add(new ModelDokter("Docter 6", R.drawable.player6));
//
