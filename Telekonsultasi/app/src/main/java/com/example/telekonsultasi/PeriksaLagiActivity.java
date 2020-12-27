package com.example.telekonsultasi;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.Bundle;
import android.os.Handler;
import android.util.Base64;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
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
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.FileNotFoundException;
import java.io.InputStream;
import java.util.HashMap;
import java.util.Map;

import de.hdodenhof.circleimageview.CircleImageView;

public class PeriksaLagiActivity extends AppCompatActivity {
    CircleImageView fotoperiksa;
    TextView name, tempat, tgl, umurs, keterbatasans, jenis, warga, statuss, pendidikans, agamas,
    pekerjaans, nonik, alamat, notlp, ayah, ibu, hubpasien, txtnomer, txtglperiksa, txtfotonyatulisan;
    Button btnsimpanperiksa;
    EditText edtkeluhan;
    String mFotoPeriksa, mKdRegist, mKdPasien;
    String no_rm_intent;

    ProgressDialog progressDialog;
    RequestQueue requestQueue;
    ProgressBar progressBar;
    authdata authdataa;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_periksa_lagi);

        progressDialog = new ProgressDialog(this);
        requestQueue = Volley.newRequestQueue(this);
        progressBar = new ProgressBar(PeriksaLagiActivity.this);
        authdataa = new authdata(this);

        initWidgetId();

        Intent intent = getIntent();
        no_rm_intent = intent.getStringExtra("no_rm");
        loadDeatil();
//        Picasso.get().load(mFotoPeriksa).into(fotoperiksa);
//        Toast.makeText(this, no_rm_intent, Toast.LENGTH_LONG).show();
        mKdRegist = authdataa.getKodeUser();
        btnsimpanperiksa.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                periksaLagi();
            }
        });
    }

    private void initWidgetId(){
        txtfotonyatulisan = findViewById(R.id.tulisanfotonya);
        txtnomer = findViewById(R.id.normnya);
        fotoperiksa = findViewById(R.id.foto_periksa_periksa);
        name = findViewById(R.id.nama_pasien);
        txtglperiksa = findViewById(R.id.tanggal_periksa);
        tempat = findViewById(R.id.tempat_lahir_periksa);
        tgl = findViewById(R.id.tanggal_lahir_periksa);
        umurs = findViewById(R.id.umur_periksa);
        keterbatasans = findViewById(R.id.keterbatasan_periksa);
        jenis = findViewById(R.id.jeniskelamin_periksa);
        warga = findViewById(R.id.warga_negara_periksa);
        statuss = findViewById(R.id.status_perkawinan_periksa);
        pendidikans = findViewById(R.id.pendidikan_periksa);
        agamas = findViewById(R.id.agama_periksa);
        pekerjaans = findViewById(R.id.pekerjaan_periksa);
        nonik = findViewById(R.id.no_nik_periksa);
        alamat = findViewById(R.id.alamat_periksa);
        notlp = findViewById(R.id.no_tlp_periksa);
        ayah = findViewById(R.id.ayah_periksa);
        ibu = findViewById(R.id.ibu_periksa);
        hubpasien = findViewById(R.id.hub_pasien_periksa);
        edtkeluhan = findViewById(R.id.keluhan_periksa);
        btnsimpanperiksa = findViewById(R.id.btnperiksalagi_periksa);
    }

    private void loadDeatil() {
        Log.e("no_rm", no_rm_intent);

        StringRequest bayarget = new StringRequest(Request.Method.POST, ServerApi.URL_BUKTI, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject hasil = new JSONObject(response);
                    boolean status = hasil.getBoolean("status");
                    if (status) {
                        JSONArray data = hasil.getJSONArray("data");
                        JSONObject utama = data.getJSONObject(0);

                        String kd_pasien = utama.getString("kd_pasien");
                        String no_rm = utama.getString("no_rm");
                        String nama_pasien = utama.getString("nama_pasien");
                        String tgl_kunjungan = utama.getString("tgl_kunjungan");
                        String tempat_lahir = utama.getString("tempat_lahir");
                        String tgl_lahir = utama.getString("tgl_lahir");
                        String umur = utama.getString("umur");
                        String keterbatasan = utama.getString("keterbatasan");
                        String jenis_kelamin = utama.getString("jenis_kelamin");
                        String warga_negara = utama.getString("warga_negara");
                        String status_perkawinan = utama.getString("status_perkawinan");
                        String pendidikan = utama.getString("pendidikan");
                        String agama = utama.getString("agama");
                        String pekerjaan = utama.getString("pekerjaan");
                        String no_nik = utama.getString("no_nik");
                        String alamat_pasien = utama.getString("alamat_pasien");
                        String no_tlp = utama.getString("no_tlp");
                        String nama_ayah = utama.getString("nama_ayah");
                        String nama_ibu = utama.getString("nama_ibu");
                        String foto = utama.getString("foto");
                        String hub_pasien = utama.getString("hub_pasien");

                        mKdPasien = kd_pasien;
                        txtnomer.setText(no_rm);
                        name.setText(nama_pasien);
                        txtglperiksa.setText("Tanggal Kunjungan : " + tgl_kunjungan);
                        tempat.setText("Tempat Lahir : " +tempat_lahir);
                        tgl.setText("Tanggal Lahir : " + tgl_lahir);
                        umurs.setText("Umur : " + umur);
                        keterbatasans.setText("Keterbatasan : " + keterbatasan);
                        jenis.setText("Jenis Kelamin : " + jenis_kelamin);
                        warga.setText("Warga Negara : " + warga_negara);
                        statuss.setText("Status Perkawinan : " + status_perkawinan);
                        pendidikans.setText("Pendidikan : " + pendidikan);
                        agamas.setText("Agama : " + agama);
                        pekerjaans.setText("Pekerjaan : " + pekerjaan);
                        nonik.setText("No NIK : " + no_nik);
                        alamat.setText("Alamat : " + alamat_pasien);
                        notlp.setText("No Telepon : " + no_tlp);
                        ayah.setText("Nama Ayah : " + nama_ayah);
                        ibu.setText("Nama Ibu : " + nama_ibu);
                        mFotoPeriksa = ServerApi.URL_FOTOPASIEN + foto;
//                        mFotoPeriksa = ServerApi.URL_FOTOPASIEN + txtfotonyatulisan;
//                        Log.e("test", mFotoPeriksa);
                        Picasso.get().load(mFotoPeriksa).into(fotoperiksa);
                        hubpasien.setText("Hubungan Pasien : " + hub_pasien);
                    } else {
                        Toast.makeText(PeriksaLagiActivity.this, "Data yang anda masukkan salah!", Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(PeriksaLagiActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
                progressDialog.dismiss();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                Toast.makeText(PeriksaLagiActivity.this, error.toString(), Toast.LENGTH_LONG).show();
            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("no_rm", no_rm_intent.toString().split(" : ")[1]);
                return params;
            }
        };
        requestQueue.add(bayarget);
    }

    private void periksaLagi(){
        final String keluhan = this.edtkeluhan.getText().toString().trim();

        if (keluhan.matches("")){
            Toast.makeText(this, "Masukkan Keluhan Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        progressBar.setVisibility(View.GONE);

        StringRequest stringRequest = new StringRequest(Request.Method.POST, ServerApi.URL_PERIKSALAGI, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String status = jsonObject.getString("status");
                    String error = jsonObject.getString("error");
                    String message = jsonObject.getString("message");

                    if (status.equals("200") && error.equals("false")){
                        Toast.makeText(PeriksaLagiActivity.this, message, Toast.LENGTH_SHORT).show();
                        new Handler().postDelayed(new Runnable() {
                            @Override
                            public void run() {
                                Intent pindah = new Intent(PeriksaLagiActivity.this, NavFragment.class);
                                startActivity(pindah);
                                finish();
                            }
                        }, 1500);
                    } else {
                        Toast.makeText(PeriksaLagiActivity.this, message, Toast.LENGTH_SHORT).show();
                        progressBar.setVisibility(View.GONE);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                    progressBar.setVisibility(View.GONE);
                    Intent periksa = new Intent(PeriksaLagiActivity.this, NavFragment.class);
                    startActivity(periksa);
                    finish();
                    Toast.makeText(PeriksaLagiActivity.this, "Berhasil ! Silahkan lanjutkan pembayaran anda.", Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(PeriksaLagiActivity.this, "Silahkan masukkan data dengan benar dan sesuai Format yang sudah di tentukan!", Toast.LENGTH_SHORT).show();
                progressBar.setVisibility(View.GONE);
            }
        })
        {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("kd_regist", mKdRegist);
                params.put("kd_pasien", mKdPasien);
                params.put("keluhan", keluhan);
                return params;
            }
        };
        requestQueue.add(stringRequest);
    }
}