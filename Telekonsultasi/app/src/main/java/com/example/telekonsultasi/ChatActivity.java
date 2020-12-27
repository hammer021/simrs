package com.example.telekonsultasi;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.telekonsultasi.configfile.ServerApi;
import com.example.telekonsultasi.configfile.authdata;
import com.google.android.material.snackbar.Snackbar;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class ChatActivity extends AppCompatActivity {
    boolean doubleBackToExit;
    TextView namadokter, namapoli, haripoli, waktupoli;
    Button linkbutton;

    ProgressDialog progressDialog;
    RequestQueue requestQueue;
    ProgressBar progressBar;
    authdata authdataa;

    String mFotoDokter, mKdRegist, LinkVideoCofference;
    String no_rm_intent;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_chat);

//        authdataa = new authdata(this);
//        progressDialog = new ProgressDialog(this);
//        requestQueue = Volley.newRequestQueue(this);
//        progressBar = new ProgressBar(this);
//        mKdRegist = authdataa.getKodeUser();
//
//        initWidgetId();
//
//        Intent intent = getIntent();
//        no_rm_intent = intent.getStringExtra("no_rm");


    }

//    public void initWidgetId(){
//        namadokter = findViewById(R.id.namadokterchat);
//        namapoli = findViewById(R.id.namapolichat);
//        haripoli = findViewById(R.id.txthari);
//        waktupoli = findViewById(R.id.txtwaktu);
//        linkbutton = findViewById(R.id.btnlink);
//    }
//
//    @Override
//    public void onBackPressed() {
//        if (doubleBackToExit) {
//            Intent abc = new Intent(ChatActivity.this, NotificationActivity.class);
//            startActivity(abc);
//            finish();
//        }
//
//        this.doubleBackToExit = true;
//        Snackbar.make(findViewById(R.id.chatactivity), "Tekan kembali sekali lagi untuk kembali", Snackbar.LENGTH_LONG).show();
//
//        new Handler().postDelayed(new Runnable() {
//            @Override
//            public void run() {
//                doubleBackToExit=false;
//            }
//        }, 2000);
//    }
//
//    private void loadData(){
//        StringRequest load = new StringRequest(Request.Method.POST, ServerApi.URL_PERIKSA, new Response.Listener<String>() {
//            @Override
//            public void onResponse(String response) {
//                try {
//                    JSONObject luar = new JSONObject(response);
//                    JSONArray dalem = luar.getJSONArray("data_chat");
//                    for (int i = 0; i < dalem.length(); i++) {
//                        JSONObject item = dalem.getJSONObject(i);
//
//                        String nama_dokter = item.getString("nama_dokter");
//                        String klinik = item.getString("klinik");
//                        String waktu = item.getString("waktu");
//                        String hari = item.getString("hari");
//                        String message = item.getString("message");
//
//                        namadokter.setText(nama_dokter);
//                        namapoli.setText(klinik);
//                        waktupoli.setText(waktu);
//                        haripoli.setText(hari);
//                        LinkVideoCofference = message;
//                    }
//                } catch (JSONException e) {
//                    Toast.makeText(ChatActivity.this, e.toString(), Toast.LENGTH_LONG).show();
//                }
//            }
//        }, new Response.ErrorListener() {
//            @Override
//            public void onErrorResponse(VolleyError error) {
//                Toast.makeText(ChatActivity.this, error.toString(), Toast.LENGTH_LONG).show();
//            }
//        }) {
//            @Override
//            protected Map<String, String> getParams() throws AuthFailureError {
//                Map<String, String> params = new HashMap<>();
//                params.put("no_rm", no_rm_intent.toString().split(" : ")[1]);
//                return params;
//            }
//        };
//        requestQueue.add(load);
//    }
}