package com.example.rsj.activity;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.rsj.MainActivity;
import com.example.rsj.R;
import com.example.rsj.configfile.ServerApi;
import com.example.rsj.configfile.authdata;
import com.google.android.material.snackbar.Snackbar;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class DetailRiwayatPemeriksaanActivity extends AppCompatActivity {
    TextView edtnorm, edtnama, edttgl, edtkeluhan, edtresep, edthargaresep;
    ImageView imageView;

    String no_rm_intent, mFoto;

    ProgressDialog progressDialog;
    RequestQueue requestQueue;
    authdata authdataa;

    boolean doubleBackToExit;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_riwayat_pemeriksaan);
        progressDialog = new ProgressDialog(this);
        requestQueue = Volley.newRequestQueue(this);
        authdataa = new authdata(this);

        Intent intent = getIntent();
        no_rm_intent = intent.getStringExtra("no_rm");

        edtnorm = findViewById(R.id.text_kode_detailriwayat);
        edtnama = findViewById(R.id.text_nama_detailriwayat);
        edttgl = findViewById(R.id.text_tglkunjungan_detailriwayat);
        edtkeluhan = findViewById(R.id.text_keluhan_detailriwayat);
        edtresep = findViewById(R.id.text_resep_detailriwayat);
        edthargaresep = findViewById(R.id.text_hargaresep_detailriwayat);
        imageView = findViewById(R.id.foto_detailriwayat);

        loadRiwayatPemeriksaan();
    }

    @Override
    public void onBackPressed() {
        if (doubleBackToExit) {
            Intent abc = new Intent(DetailRiwayatPemeriksaanActivity.this, MainActivity.class);
            startActivity(abc);
        }

        this.doubleBackToExit = true;
        Snackbar.make(findViewById(R.id.detailriwayatpemeriksaanactivity), "Tekan kembali sekali lagi untuk kembali", Snackbar.LENGTH_LONG).show();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                doubleBackToExit=false;
            }
        }, 2000);
    }

    private void loadRiwayatPemeriksaan() {
        progressDialog.setMessage("Sedang Memperbarui Data...");
        progressDialog.setCancelable(false);
        progressDialog.show();

        StringRequest stringRequest = new StringRequest(Request.Method.POST, ServerApi.URL_TAMPILRIWAYAT, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String message = jsonObject.getString("message");
                    boolean status = jsonObject.getBoolean("status");
                    if (status) {
                        JSONArray data = jsonObject.getJSONArray("data");
                        JSONObject datanya = data.getJSONObject(0);

                        String no_rm = datanya.getString("no_rm");
                        String nama_pasien = datanya.getString("nama_pasien");
                        String tgl_kunjungan = datanya.getString("tgl_kunjungan");
                        String keluhan = datanya.getString("keluhan");
                        String resep = datanya.getString("resep");
                        String harga_resep = datanya.getString("harga_resep");
                        String buktikonsul = datanya.getString("buktikonsul");

                        edtnorm.setText(no_rm);
                        edtnama.setText(nama_pasien);
                        edttgl.setText(tgl_kunjungan);
                        edtkeluhan.setText(keluhan);
                        edtresep.setText(resep);
                        edthargaresep.setText(harga_resep);

                        mFoto = ServerApi.URL_FOTORIWAYAT + buktikonsul;
                        Picasso.get().load(mFoto).into(imageView);
                    } else {
                        Toast.makeText(DetailRiwayatPemeriksaanActivity.this, message, Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(DetailRiwayatPemeriksaanActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
                progressDialog.dismiss();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                Toast.makeText(DetailRiwayatPemeriksaanActivity.this, error.toString(), Toast.LENGTH_LONG).show();
            }
        })
        {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("no_rm", no_rm_intent.toString().split(" : ")[1]);
                return params;
            }
        };
        requestQueue.add(stringRequest);
    }

}