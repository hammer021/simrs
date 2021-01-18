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

public class DetailPasienTerdaftarActivity extends AppCompatActivity {
    TextView edtkdpasien, edtnamapasien, edttgllahir, edttempatlahir, edtumur, edtketerbatasan, edtjeniskelamin, edtwarga,
    edtstatuskawin, edtpendidikan, edtagama, edtpekerjaan, edtnik, edtalamat, edtnotelp, edtayah, edtibu;
    ImageView imageView;

    String no_rm_intent, mFotoPeriksa;

    ProgressDialog progressDialog;
    RequestQueue requestQueue;
    authdata authdataa;

    boolean doubleBackToExit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_pasien_terdaftar);
        progressDialog = new ProgressDialog(this);
        requestQueue = Volley.newRequestQueue(this);
        authdataa = new authdata(this);

        Intent intent = getIntent();
        no_rm_intent = intent.getStringExtra("no_rm");

        edtkdpasien = findViewById(R.id.text_kode_detailpasien);
        edtnamapasien = findViewById(R.id.text_nama_detailpasien);
        edttgllahir = findViewById(R.id.text_tgllahir_detailpasien);
        edttempatlahir = findViewById(R.id.text_tempatlahir_detailpasien);
        edtumur = findViewById(R.id.text_umur_detailpasien);
        edtketerbatasan = findViewById(R.id.text_keterbatasan_detailpasien);
        edtjeniskelamin = findViewById(R.id.text_jeniskelamin_detailpasien);
        edtwarga = findViewById(R.id.text_warganegara_detailpasien);
        edtstatuskawin = findViewById(R.id.text_statusperkawinan_detailpasien);
        edtpendidikan = findViewById(R.id.text_pendidikan_detailpasien);
        edtagama = findViewById(R.id.text_agama_detailpasien);
        edtpekerjaan = findViewById(R.id.text_pekerjaan_detailpasien);
        edtnik = findViewById(R.id.text_nonik_detailpasien);
        edtalamat = findViewById(R.id.text_alamat_detailpasien);
        edtnotelp = findViewById(R.id.text_notelp_detailpasien);
        edtayah = findViewById(R.id.text_ayah_detailpasien);
        edtibu = findViewById(R.id.text_ibu_detailpasien);
        imageView = findViewById(R.id.foto_detailpasien);

        loadDetailPasien();
    }

    @Override
    public void onBackPressed() {
        if (doubleBackToExit) {
            Intent abc = new Intent(DetailPasienTerdaftarActivity.this, MainActivity.class);
            startActivity(abc);
        }

        this.doubleBackToExit = true;
        Snackbar.make(findViewById(R.id.detailpasienterdaftaractivity), "Tekan kembali sekali lagi untuk kembali", Snackbar.LENGTH_LONG).show();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                doubleBackToExit=false;
            }
        }, 2000);
    }

    private void loadDetailPasien() {
        progressDialog.setMessage("Sedang Memperbarui Data...");
        progressDialog.setCancelable(false);
        progressDialog.show();

        StringRequest stringRequest = new StringRequest(Request.Method.POST, ServerApi.URL_BUKTI, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject hasil = new JSONObject(response);
                    boolean status = hasil.getBoolean("status");
                    if (status) {
                        JSONArray data = hasil.getJSONArray("data");
                        JSONObject utama = data.getJSONObject(0);

                        String kd_pasien = utama.getString("kd_pasien");
                        String nama_pasien = utama.getString("nama_pasien");
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

                        edtkdpasien.setText(kd_pasien);
                        edtnamapasien.setText(nama_pasien);
                        edttgllahir.setText(tgl_lahir);
                        edttempatlahir.setText(tempat_lahir);
                        edtumur.setText(umur);
                        edtketerbatasan.setText(keterbatasan);
                        edtjeniskelamin.setText(jenis_kelamin);
                        edtwarga.setText(warga_negara);
                        edtstatuskawin.setText(status_perkawinan);
                        edtpendidikan.setText(pendidikan);
                        edtagama.setText(agama);
                        edtpekerjaan.setText(pekerjaan);
                        edtnik.setText(no_nik);
                        edtalamat.setText(alamat_pasien);
                        edtnotelp.setText(no_tlp);
                        edtayah.setText(nama_ayah);
                        edtibu.setText(nama_ibu);

                        mFotoPeriksa = ServerApi.URL_FOTOPASIEN + foto;
                        Picasso.get().load(mFotoPeriksa).into(imageView);
                    } else {
                        Toast.makeText(DetailPasienTerdaftarActivity.this, "Data yang anda masukkan salah!", Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(DetailPasienTerdaftarActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
                progressDialog.dismiss();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                Toast.makeText(DetailPasienTerdaftarActivity.this, error.toString(), Toast.LENGTH_LONG).show();
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