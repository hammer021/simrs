package com.example.telekonsultasi;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.Bundle;
import android.util.Base64;
import android.util.Log;
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

public class UploadPeriksaActivity extends AppCompatActivity {

    TextView txtnomer, txtnama, txttanggal, txtkeluhan, txtharga, patfbukti;
    Button uploadbukti, simpanbukti;
    String no_rm_intent;

    ProgressDialog progressDialog;
    RequestQueue requestQueue;
    authdata authdataa;

    private final int IMG_REQUEST = 1;
    boolean statusImage = false;

    Bitmap bitmapBuktiBayar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_upload_periksa);

        progressDialog = new ProgressDialog(this);
        requestQueue = Volley.newRequestQueue(this);
        authdataa = new authdata(this);

        Intent intent = getIntent();
        no_rm_intent = intent.getStringExtra("no_rm");
        loadDeatil();
        Toast.makeText(this, no_rm_intent, Toast.LENGTH_LONG).show();

        txtnomer = findViewById(R.id.normuploadperiksa);
        txtnama = findViewById(R.id.namauploadperiksa);
        txttanggal = findViewById(R.id.tanggaluploadperiksa);
        txtkeluhan = findViewById(R.id.keluhanuploadperiksa);
        txtharga = findViewById(R.id.hargauploadperiksa);
        patfbukti = findViewById(R.id.pathfotouploadperiksa);

        uploadbukti = findViewById(R.id.btnuploadperiksa);
        uploadbukti.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                selectImage();
            }
        });

        simpanbukti = findViewById(R.id.btnsimpanuploadperiksa);
        simpanbukti.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                updateBuktiBayar();

                Intent main = new Intent(UploadPeriksaActivity.this, NavFragment.class);
                startActivity(main);
                finish();
            }
        });
    }

    private void loadDeatil() {
        Log.e("no_rm", no_rm_intent);
        progressDialog.show();

        StringRequest bayarget = new StringRequest(Request.Method.POST, ServerApi.URL_BUKTI, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject hasil = new JSONObject(response);
                    boolean status = hasil.getBoolean("status");
                    if (status) {
                        JSONArray data = hasil.getJSONArray("data");
                        JSONObject utama = data.getJSONObject(0);

                        String no_rm = utama.getString("no_rm");
                        String nama_pasien = utama.getString("nama_pasien");
                        String tgl_kunjungan = utama.getString("tgl_kunjungan");
                        String harga = utama.getString("harga");

                        Log.e("utamas", "utamas" + utama);

                        txtnomer.setText(no_rm);
                        txtnama.setText(nama_pasien);
                        txttanggal.setText(tgl_kunjungan);
                        txtharga.setText(harga);
                    } else {
                        Toast.makeText(UploadPeriksaActivity.this, "Gagal upload bukti pembayaran", Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(UploadPeriksaActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
                progressDialog.dismiss();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                Toast.makeText(UploadPeriksaActivity.this, error.toString(), Toast.LENGTH_LONG).show();
            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("no_rm", no_rm_intent);
                return params;
            }
        };
        requestQueue.add(bayarget);
    }

    private void updateBuktiBayar() {
        StringRequest bayarbosque = new StringRequest(Request.Method.PUT, ServerApi.URL_UPLOAD_BUKTI, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                progressDialog.dismiss();
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String message = jsonObject.getString("message");
                    Snackbar.make(findViewById(R.id.uploadperiksaactivity), message, Snackbar.LENGTH_LONG).show();
                } catch (JSONException e) {
                    Toast.makeText(getApplicationContext(), e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                Toast.makeText(getApplicationContext(), error.toString(), Toast.LENGTH_LONG).show();
            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("no_rm", no_rm_intent);
//                params.put("no_rm", no_rm_intent.toString().split(" : ")[1]);
                params.put("buktikeluhan", imageToString(bitmapBuktiBayar));
                return params;
            }
        };
        requestQueue.add(bayarbosque);
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
                patfbukti.setText(pathGambar);

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
}