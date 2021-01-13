package com.example.rsj.activity;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.os.Handler;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.ClientError;
import com.android.volley.NetworkError;
import com.android.volley.NoConnectionError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.TimeoutError;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.rsj.MainActivity;
import com.example.rsj.R;
import com.example.rsj.configfile.ServerApi;
import com.example.rsj.configfile.authdata;
import com.google.android.material.snackbar.Snackbar;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import de.hdodenhof.circleimageview.CircleImageView;

public class ViedoConferenceActivity extends AppCompatActivity {
    boolean doubleBackToExit;
    TextView namadokter, namapoli, haripoli, waktupoli, nopraktek;
    Button linkbutton;
    CircleImageView foto;

    ProgressDialog progressDialog;
    RequestQueue requestQueue;
    ProgressBar progressBar;
    authdata authdataa;

    String mFotoDokter, mKdRegist, LinkVideoCofference, idchat;
    String no_rm_intent;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_viedo_conference);
        authdataa = new authdata(this);
        progressDialog = new ProgressDialog(this);
        requestQueue = Volley.newRequestQueue(this);
        progressBar = new ProgressBar(this);
        mKdRegist = authdataa.getKodeUser();

        nopraktek = findViewById(R.id.nopraktekdokter_inbox);
        namadokter = findViewById(R.id.namadokterchat_inbox);
        namapoli = findViewById(R.id.namapolichat_inbox);
        haripoli = findViewById(R.id.txthari_inbox);
        waktupoli = findViewById(R.id.txtwaktu_inbox);
        linkbutton = findViewById(R.id.btnlink_inbox);
        foto = findViewById(R.id.fotodokter_inbox);

        Intent intent = getIntent();
        no_rm_intent = intent.getStringExtra("nor_rm");

        loadData();
    }

    @Override
    public void onBackPressed() {
        if (doubleBackToExit) {
            Intent abc = new Intent(ViedoConferenceActivity.this, MainActivity.class);
            startActivity(abc);
            finish();
        }

        this.doubleBackToExit = true;
        Snackbar.make(findViewById(R.id.videoconferenceactivity), "Tekan kembali sekali lagi untuk kembali", Snackbar.LENGTH_LONG).show();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                doubleBackToExit=false;
            }
        }, 2000);
    }

    private void updateStatusChat(){
        StringRequest stringRequest = new StringRequest(Request.Method.PUT, ServerApi.URL_TAMPILCHAT, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String status = jsonObject.getString("status");
                    String pesan = jsonObject.getString("pesan");

                    if (status.equals("true")){
                        Intent a = new Intent(ViedoConferenceActivity.this, MainActivity.class);
                        startActivity(a);

                        Intent link = new Intent();
                        link.setAction(Intent.ACTION_VIEW);
                        link.addCategory(Intent.CATEGORY_BROWSABLE);
                        link.setData(Uri.parse(LinkVideoCofference));
                        startActivity(link);

                        finish();
                        Toast.makeText(ViedoConferenceActivity.this, pesan, Toast.LENGTH_LONG).show();
                    } else {
                        Toast.makeText(ViedoConferenceActivity.this, pesan, Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(ViedoConferenceActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                String message = "Terjadi error. Coba beberapa saat lagi.";
                if (error instanceof NetworkError){
                    message = "Tidak dapat terhubung ke internet. Harap periksa koneksi anda.";
                } else if (error instanceof AuthFailureError) {
                    message = "Gagal login. Harap periksa email dan password anda.";
                } else if (error instanceof ClientError) {
                    message = "Gagal login. Harap periksa email dan password anda.";
                } else if (error instanceof NoConnectionError) {
                    message = "Tidak ada koneksi internet. Harap periksa koneksi anda.";
                } else if (error instanceof TimeoutError) {
                    message = "Connection Time Out. Harap periksa koneksi anda.";
                }
                Toast.makeText(ViedoConferenceActivity.this, error.toString(), Toast.LENGTH_LONG).show();
            }
        })
        {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("no_rm", no_rm_intent.toString().split(" : ")[1]);
                params.put("chat_id", idchat);
                return params;
            }
        };
        requestQueue.add(stringRequest);
    }

    private void loadData(){
        StringRequest a = new StringRequest(Request.Method.POST, ServerApi.URL_TAMPILCHAT, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject luar = new JSONObject(response);
                    Boolean status = luar.getBoolean("status");
//                    String pesan = luar.getString("pesan");
                    if (status) {
                        JSONArray dalem = luar.getJSONArray("data_chat");
                        for (int i = 0; i < dalem.length(); i++) {
                            JSONObject item = dalem.getJSONObject(i);
                            String name = item.getString("name");
                            String klinik = item.getString("klinik");
                            String no_praktek = item.getString("no_praktek");
                            String hari = item.getString("hari");
                            final String startwaktu = item.getString("startwaktu");
                            String endwaktu = item.getString("endwaktu");
                            String chat_id = item.getString("chat_id");
                            String message = item.getString("message");
                            Log.e("field", "field"+item);

                            namadokter.setText(name);
                            nopraktek.setText(no_praktek);
                            namapoli.setText(klinik);
                            haripoli.setText(hari);
                            waktupoli.setText(startwaktu + " - " + endwaktu);
                            idchat = chat_id;
                            LinkVideoCofference = message;
                            if (LinkVideoCofference.equals("")){
                                linkbutton.setEnabled(false);
                            } else {
                                linkbutton.setOnClickListener(new View.OnClickListener() {
                                    @Override
                                    public void onClick(View view) {
                                        linkbutton.setEnabled(true);
                                        updateStatusChat();
                                    }
                                });
                            }
                        }
                    } else {
                        Toast.makeText(ViedoConferenceActivity.this, "Waktu Praktek Dokter masih Kosong !", Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(ViedoConferenceActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(ViedoConferenceActivity.this, error.toString(), Toast.LENGTH_LONG).show();
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
        requestQueue.add(a);
    }
}