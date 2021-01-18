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

public class DetailDokterActivity extends AppCompatActivity {
    ImageView fotodokter;
    TextView edtnama, edtnopraktek, edtpoli, edtsenin, detselasa, edtrabu, edtkamis, edtjumat, edtsabtu, edtminggu;

    String no_praktek_intent, mFotoPeriksa;

    ProgressDialog progressDialog;
    RequestQueue requestQueue;
    authdata authdataa;

    boolean doubleBackToExit;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_dokter);
        progressDialog = new ProgressDialog(this);
        requestQueue = Volley.newRequestQueue(this);
        authdataa = new authdata(this);

        Intent intent = getIntent();
        no_praktek_intent = intent.getStringExtra("no_praktek");

        fotodokter = findViewById(R.id.foto_detaildokter);
        edtnama = findViewById(R.id.text_nama_detaildokter);
        edtnopraktek = findViewById(R.id.text_nopraktek_detaildokter);
        edtpoli = findViewById(R.id.text_poli_detaildokter);
        edtsenin = findViewById(R.id.text_senin_detaildokter);
        detselasa = findViewById(R.id.text_selasa_detaildokter);
        edtrabu = findViewById(R.id.text_rabu_detaildokter);
        edtkamis = findViewById(R.id.text_kamis_detaildokter);
        edtjumat = findViewById(R.id.text_jumat_detaildokter);
        edtsabtu = findViewById(R.id.text_sabtu_detaildokter);
        edtminggu = findViewById(R.id.text_minggu_detaildokter);

        detailDokter();
    }

    @Override
    public void onBackPressed() {
        if (doubleBackToExit) {
            Intent abc = new Intent(DetailDokterActivity.this, DokterActivity.class);
            startActivity(abc);
        }

        this.doubleBackToExit = true;
        Snackbar.make(findViewById(R.id.detaildokteractivity), "Tekan kembali sekali lagi untuk kembali", Snackbar.LENGTH_LONG).show();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                doubleBackToExit=false;
            }
        }, 2000);
    }

    private void detailDokter() {
        progressDialog.setMessage("Sedang Memperbarui Data...");
        progressDialog.setCancelable(false);
        progressDialog.show();

        StringRequest stringRequest = new StringRequest(Request.Method.POST, ServerApi.URL_GETPASIEN, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject hasil = new JSONObject(response);
                    boolean status = hasil.getBoolean("status");
                    if (status) {
                        JSONArray data = hasil.getJSONArray("data");
                        JSONObject utama = data.getJSONObject(0);

                        String image = utama.getString("image");
                        String name = utama.getString("name");
                        String no_praktek = utama.getString("no_praktek");
                        String klinik = utama.getString("klinik");
                        String senin = utama.getString("senin");
                        String selasa = utama.getString("selasa");
                        String rabu = utama.getString("rabu");
                        String kamis = utama.getString("kamis");
                        String jumat = utama.getString("jumat");
                        String sabtu = utama.getString("sabtu");
                        String minggu = utama.getString("minggu");
                        String startwaktu = utama.getString("startwaktu");

                        edtnama.setText(name);
                        edtnopraktek.setText(no_praktek);
                        edtpoli.setText(klinik);

                        if (senin.equals("1"))
                        {
                            edtsenin.setText(startwaktu);
                        } else {
                            edtsenin.setText("Libur");
                        }

                        if (selasa.equals("1"))
                        {
                            detselasa.setText(startwaktu);
                        } else {
                            detselasa.setText("Libur");
                        }

                        if (rabu.equals("1"))
                        {
                            edtrabu.setText(startwaktu);
                        } else {
                            edtrabu.setText("Libur");
                        }

                        if (kamis.equals("1"))
                        {
                            edtkamis.setText(startwaktu);
                        } else {
                            edtkamis.setText("Libur");
                        }

                        if (jumat.equals("1"))
                        {
                            edtjumat.setText(startwaktu);
                        } else {
                            edtjumat.setText("Libur");
                        }

                        if (sabtu.equals("1"))
                        {
                            edtsabtu.setText(startwaktu);
                        } else {
                            edtsabtu.setText("Libur");
                        }

                        if (minggu.equals("1"))
                        {
                            edtminggu.setText(startwaktu);
                        } else {
                            edtminggu.setText("Libur");
                        }

                        mFotoPeriksa = ServerApi.URL_FOTODOKTER + image;
                        Picasso.get().load(mFotoPeriksa).into(fotodokter);
                    } else {
                        Toast.makeText(DetailDokterActivity.this, "Data tidak ada!", Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(DetailDokterActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
                progressDialog.dismiss();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                Toast.makeText(DetailDokterActivity.this, error.toString(), Toast.LENGTH_LONG).show();
            }
        })
        {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("no_praktek", no_praktek_intent);
                return params;
            }
        };
        requestQueue.add(stringRequest);
    }
}