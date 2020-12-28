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
import android.view.View;
import android.widget.Button;
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

import java.io.ByteArrayOutputStream;
import java.io.FileNotFoundException;
import java.io.InputStream;
import java.util.HashMap;
import java.util.Map;

public class UploadResepActivity extends AppCompatActivity {
    TextView txtnomer, txtnama, txttanggal, txtresep, txthargaresep, txtongkir, txtgrand, pathbukti;
    Button uploadbukti, simpanbukti;
    String no_rm_intent;

    ProgressDialog progressDialog;
    RequestQueue requestQueue;
    authdata authdataa;

    private final int IMG_REQUEST = 1;
    boolean statusImage = false;
    boolean doubleBackToExit;

    Bitmap bitmapBuktiBayar;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_upload_resep);

        progressDialog = new ProgressDialog(this);
        requestQueue = Volley.newRequestQueue(this);
        authdataa = new authdata(this);

        Intent intent = getIntent();
        no_rm_intent = intent.getStringExtra("no_rm");
        loadDetail();

        txtnomer = findViewById(R.id.normuploadresep);
        txtnama = findViewById(R.id.namauploadresep);
        txttanggal = findViewById(R.id.tanggaluploadresep);
        txtresep = findViewById(R.id.resepresep);
        txthargaresep = findViewById(R.id.hargauploadresep);
        txtongkir = findViewById(R.id.hargakirimresep);
        txtgrand = findViewById(R.id.grandtotal);
        pathbukti = findViewById(R.id.pathfotouploadresep);

        uploadbukti = findViewById(R.id.btnuploadresep);
        uploadbukti.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                selectImage();
            }
        });

        simpanbukti = findViewById(R.id.btnsimpanuploadresep);
        simpanbukti.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                updateBuktiBayar();

                Intent main = new Intent(UploadResepActivity.this, NavFragment.class);
                startActivity(main);
                finish();
            }
        });
    }

    public void loadDetail(){
        progressDialog.show();

        StringRequest load = new StringRequest(Request.Method.POST, ServerApi.URL_RESEP, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    boolean status = jsonObject.getBoolean("status");
                    if (status) {
                        JSONArray data = jsonObject.getJSONArray("data");
                        JSONObject utama = data.getJSONObject(0);

                        String no_rm = utama.getString("no_rm");
                        String nama_pasien = utama.getString("nama_pasien");
                        String tgl_kunjungan = utama.getString("tgl_kunjungan");
                        String resep = utama.getString("resep");
                        String harga_resep = utama.getString("harga_resep");
                        String harga_kirim = utama.getString("harga_kirim");
                        String grand_total = utama.getString("grand_total");

                        txtnomer.setText(no_rm);
                        txtnama.setText("Nama Pasien : " + nama_pasien);
                        txttanggal.setText("Tanggal Kunjungan : " + tgl_kunjungan);
                        txtresep.setText("Resep Obat : " + resep);
                        txthargaresep.setText("Harga Resep : Rp. " + harga_resep);
                        txtongkir.setText("Harga Kirim : Rp. " + harga_kirim);
                        txtgrand.setText("Rp. " + grand_total);
                    } else {
                        Toast.makeText(UploadResepActivity.this, "Gagal upload bukti pembayaran", Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(UploadResepActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
                progressDialog.dismiss();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("no_rm", no_rm_intent.toString().split(" : ")[1]);
                return params;
            }
        };
        requestQueue.add(load);
    }

    private void updateBuktiBayar(){
        StringRequest bayar = new StringRequest(Request.Method.PUT, ServerApi.URL_RESEP, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String message = jsonObject.getString("message");
                    Toast.makeText(getApplicationContext(), message, Toast.LENGTH_LONG).show();
                } catch (JSONException e) {
                    Toast.makeText(getApplicationContext(), e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                Toast.makeText(getApplicationContext(), "Gagal upload bukti pembayaran", Toast.LENGTH_LONG).show();
            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
//                params.put("no_rm", no_rm_intent);
                params.put("no_rm", no_rm_intent.toString().split(" : ")[1]);
                params.put("buktikonsul", imageToString(bitmapBuktiBayar));
                return params;
            }
        };
        requestQueue.add(bayar);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == IMG_REQUEST && resultCode == RESULT_OK && data != null) {
//            mengambil alamat file gambar
            Uri path = data.getData();
//            Uri path2 = data.getData();

            try {
                InputStream inputStream = getContentResolver().openInputStream(path);
                String pathGambar = path.getPath();

                bitmapBuktiBayar = BitmapFactory.decodeStream(inputStream);
                pathbukti.setText(pathGambar);

                statusImage = true;

            } catch (FileNotFoundException e) {
                Toast.makeText(this, e.toString(), Toast.LENGTH_LONG).show();
            }
        }
    }

    private void selectImage() {
        Intent intent = new Intent();
        intent.setType("image/*");
        intent.setAction(intent.ACTION_GET_CONTENT);
        startActivityForResult(intent, IMG_REQUEST);
    }

    private String imageToString(Bitmap bitmap) {
        ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.JPEG, 70, byteArrayOutputStream);
        byte[] imageBytes = byteArrayOutputStream.toByteArray();

        String encodedImage = Base64.encodeToString(imageBytes, Base64.DEFAULT);
        return encodedImage;
    }

    @Override
    public void onBackPressed() {
        if (doubleBackToExit) {
            Intent abc = new Intent(UploadResepActivity.this, NotificationActivity.class);
            startActivity(abc);
            finish();
        }

        this.doubleBackToExit = true;
        Snackbar.make(findViewById(R.id.uploadresepactivity), "Tekan kembali sekali lagi untuk batalkan upload bukti pembayaran", Snackbar.LENGTH_LONG).show();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                doubleBackToExit=false;
            }
        }, 2000);
    }
}