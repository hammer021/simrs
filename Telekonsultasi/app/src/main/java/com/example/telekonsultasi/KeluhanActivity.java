package com.example.telekonsultasi;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.Bundle;
import android.os.Handler;
import android.util.Base64;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
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
import com.example.telekonsultasi.configfile.ServerApi;
import com.example.telekonsultasi.configfile.authdata;
import com.google.android.material.snackbar.Snackbar;
import com.google.android.material.textfield.TextInputLayout;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.FileNotFoundException;
import java.io.InputStream;
import java.util.HashMap;
import java.util.Map;

public class KeluhanActivity extends AppCompatActivity {

//    String[] JK = new String[]{"Laki-Laki", "Perempuan"};
//    ArrayAdapter<String> adapter;
//    AutoCompleteTextView jenisKelaminDropdown;
//
//    String[] SK = new String[]{"Kawin", "Belum Kawin"};
//    ArrayAdapter<String> adapter2;
//    AutoCompleteTextView statusKawinDropdown;

    private final int IMG_REQUEST = 1;
    boolean statusImage = false, doubleBackToExit;

    ProgressDialog progressDialog;
    authdata authdataa;
    RequestQueue requestQueue;
    ProgressBar progressBar;

    String kodenya;

    ImageView imageView7;
    EditText txtnama, txttempatlahir, txttanggal, txtjeniskelamin, txtstatuskawin, txtketerbatasan,
            txtwarga, txtpendidikan, txtagama, txtpekerjaan,
            txtnik, txtalamat, txtnotelpon, txtayah, txtibu, txthubpasien, txtkeluhan;
    TextView  txtpathfoto, txtkoderegist;
    Button uploadfoto, simpanperiksa;
    Bitmap bitmapFoto;

    private String nama;
    private String kdregistnya = "NAMA";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_keluhan);

        initWidgetId();
//        Intent intent = getIntent();
//        kodenya = intent.getStringExtra("no_rm");

    progressDialog = new ProgressDialog(this);
    authdataa = new authdata(this);
    requestQueue = Volley.newRequestQueue(this);
    progressBar = new ProgressBar(KeluhanActivity.this);

        txtkoderegist.setText(authdataa.getKodeUser());
    uploadfoto.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View view) {
            selectImage();
        }
    });

        txtjeniskelamin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog.Builder builder = new AlertDialog.Builder(KeluhanActivity.this);
                builder.setTitle("Pilih Jenis Kelamin");

                // buat array list
                final String[] options = {"Laki-Laki", "Perempuan"};

                //Pass array list di Alert dialog
                builder.setItems(options, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        txtjeniskelamin.setText(options[which]);
                    }
                });
                // buat dan tampilkan alert dialog
                AlertDialog dialog = builder.create();
                dialog.show();
            }
        });

        simpanperiksa.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View view) {
            periksa();
        }
    });

//        txtstatuskawin.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                AlertDialog.Builder builder = new AlertDialog.Builder(KeluhanActivity.this);
//                builder.setTitle("Pilih Status Perkawinan");
//
//                // buat array list
//                final String[] options2 = {"Belum Kawin", "Kawin"};
//
//                //Pass array list di Alert dialog
//                builder.setItems(options2, new DialogInterface.OnClickListener() {
//                    @Override
//                    public void onClick(DialogInterface dialog, int which) {
//                        txtjeniskelamin.setText(options2[which]);
//                    }
//                });
//                // buat dan tampilkan alert dialog
//                AlertDialog dialog = builder.create();
//                dialog.show();
//            }
//        });

        imageView7.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                onBackPressed();
            }
        });
}

    private void selectImage() {
        Intent intent = new Intent();
        intent.setType("image/*");
        intent.setAction(intent.ACTION_GET_CONTENT);
        startActivityForResult(intent, IMG_REQUEST);
    }

    private void initWidgetId() {
        txtkoderegist = findViewById(R.id.kdregistgawean);
        txtnama = findViewById(R.id.edtnamapasien);
        txttempatlahir = findViewById(R.id.edttempatlahirpsn);
        txttanggal = findViewById(R.id.edttgllahirpsn);
//        txtumur = findViewById(R.id.edtumur);
        txtketerbatasan = findViewById(R.id.edtketerbatasan);
        txtjeniskelamin = findViewById(R.id.edtjeniskelamin);
        txtwarga = findViewById(R.id.edtwarganegara);
        txtstatuskawin = findViewById(R.id.edtstatusperkawinan);
        txtpendidikan = findViewById(R.id.edtpendidikan);
        txtagama = findViewById(R.id.edtagama);
        txtpekerjaan = findViewById(R.id.edtpekerjaan);
        txtnik = findViewById(R.id.edtnonik);
        imageView7 = findViewById(R.id.imageView7);
        txtalamat = findViewById(R.id.edtalamatpasien);
        txtnotelpon = findViewById(R.id.edtnotelp);
        txtayah = findViewById(R.id.edtnamaayah);
        txtibu = findViewById(R.id.edtnamaibu);
        txthubpasien = findViewById(R.id.edthubunganpasien);
        txtkeluhan = findViewById(R.id.edtkeluhan);
        txtpathfoto = findViewById(R.id.pathfotopasien);
        uploadfoto = findViewById(R.id.btnfotopasien);
        simpanperiksa = findViewById(R.id.btnsimpanpemeriksaan);
    }


    private String imageToString(Bitmap bitmap) {
        ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.JPEG, 70, byteArrayOutputStream);
        byte[] imageBytes = byteArrayOutputStream.toByteArray();

        String encodedImage = Base64.encodeToString(imageBytes, Base64.DEFAULT);
        return encodedImage;
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == IMG_REQUEST && resultCode == RESULT_OK && data != null) {
//            mengambil alamat file gambar
            Uri path = data.getData();

            try {
                InputStream inputStream = getContentResolver().openInputStream(path);
                String pathGambar = path.getPath();
                bitmapFoto = BitmapFactory.decodeStream(inputStream);

                txtpathfoto.setText(pathGambar);

                statusImage = true;

//                mengaktifkan button bayar
//                btnBayar.setEnabled(true);
//                btnBayar.setBackgroundResource(R.drawable.button_login);
            } catch (FileNotFoundException e) {
                Toast.makeText(this, e.toString(), Toast.LENGTH_LONG).show();
            }
        }
    }

    @Override
    public void onBackPressed() {
        if (doubleBackToExit) {
            Intent abc = new Intent(KeluhanActivity.this, NavFragment.class);
            startActivity(abc);
        }

        this.doubleBackToExit = true;
        Snackbar.make(findViewById(R.id.activitykeluhan), "Tekan kembali sekali lagi untuk batalkan pemeriksaan", Snackbar.LENGTH_LONG).show();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                doubleBackToExit=false;
            }
        }, 2000);
    }

    private void periksa() {
        final String kd_regist = this.txtkoderegist.getText().toString().trim();
        final String nama_pasien = this.txtnama.getText().toString().trim();
        final String tempat_lahir = this.txttempatlahir.getText().toString().trim();
        final String tgl_lahir = this.txttanggal.getText().toString().trim();
        final String keterbatasan = this.txtketerbatasan.getText().toString().trim();
        final String jenis_kelamin = this.txtjeniskelamin.getText().toString().trim();
        final String warga_negara = this.txtwarga.getText().toString().trim();
        final String status_perkawinan = this.txtstatuskawin.getText().toString().trim();
        final String pendidikan = this.txtpendidikan.getText().toString().trim();
        final String agama = this.txtagama.getText().toString().trim();
        final String pekerjaan = this.txtpekerjaan.getText().toString().trim();
        final String no_nik = this.txtnik.getText().toString().trim();
        final String alamat_pasien = this.txtalamat.getText().toString().trim();
        final String no_tlp = this.txtnotelpon.getText().toString().trim();
        final String nama_ayah = this.txtayah.getText().toString().trim();
        final String nama_ibu = this.txtibu.getText().toString().trim();
        final String foto = this.txtpathfoto.getText().toString().trim();
        final String hub_pasien = this.txthubpasien.getText().toString().trim();
        final String keluhan = this.txtkeluhan.getText().toString().trim();

        if (nama_pasien.matches("")){
            Toast.makeText(this, "Masukkan Nama Lengkap Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (tempat_lahir.matches("")){
            Toast.makeText(this, "Masukkan tempat lahir Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (tgl_lahir.matches("")){
            Toast.makeText(this, "Masukkan tanggal lahir Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (jenis_kelamin.matches("")){
            Toast.makeText(this, "Masukkan jenis kelamin Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (warga_negara.matches("")){
            Toast.makeText(this, "Masukkan warga negara Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (status_perkawinan.matches("")){
            Toast.makeText(this, "Masukkan status perkawinan Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (pendidikan.matches("")){
            Toast.makeText(this, "Masukkan pendidikan Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (agama.matches("")){
            Toast.makeText(this, "Masukkan agama Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (pekerjaan.matches("")){
            Toast.makeText(this, "Masukkan pekerjaan Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (no_nik.matches("")){
            Toast.makeText(this, "Masukkan no nik Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (alamat_pasien.matches("")){
            Toast.makeText(this, "Masukkan alamat pasien Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (no_tlp.matches("")){
            Toast.makeText(this, "Masukkan No Telpon Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (nama_ayah.matches("")){
            Toast.makeText(this, "Masukkan nama ayah Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (nama_ibu.matches("")){
            Toast.makeText(this, "Masukkan nama ibu Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (keterbatasan.matches("")){
            Toast.makeText(this, "Masukkan keterbatasan Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (keluhan.matches("")){
            Toast.makeText(this, "Masukkan keluhan Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        progressBar.setVisibility(View.GONE);

        StringRequest periksanya = new StringRequest(Request.Method.POST, ServerApi.URL_PERIKSA, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    Log.e("json" , "ff" + jsonObject);
                    String status = jsonObject.getString("status");
                    String error = jsonObject.getString("error");
                    String message = jsonObject.getString("message");

                    if (status.equals("200") && error.equals("false")){
                        Toast.makeText(KeluhanActivity.this, message, Toast.LENGTH_SHORT).show();
                        new Handler().postDelayed(new Runnable() {
                            @Override
                            public void run() {
                                Intent pindah = new Intent(KeluhanActivity.this, NavFragment.class);
                                startActivity(pindah);
                                finish();
                            }
                        }, 1500);
                    } else {
                        Toast.makeText(KeluhanActivity.this, message, Toast.LENGTH_SHORT).show();
                        progressBar.setVisibility(View.GONE);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                    progressBar.setVisibility(View.GONE);
                    Intent periksa = new Intent(KeluhanActivity.this, NavFragment.class);
                    startActivity(periksa);
                    finish();
                    Toast.makeText(KeluhanActivity.this, "Berhasil ! Silahkan lanjutkan pembayaran anda.", Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(KeluhanActivity.this, "Silahkan masukkan data dengan benar dan sesuai Format yang sudah di tentukan!", Toast.LENGTH_SHORT).show();
                progressBar.setVisibility(View.GONE);
            }
        })
        {
            protected Map<String, String> getParams(){
                Map<String, String> params = new HashMap<>();

                    if (foto.matches("")) {
                    params.put("kd_regist", kd_regist);
                    params.put("nama_pasien", nama_pasien);
                    params.put("tempat_lahir", tempat_lahir);
                    params.put("tgl_lahir", tgl_lahir);
                    params.put("keterbatasan", keterbatasan);
                    params.put("jenis_kelamin", jenis_kelamin);
                    params.put("warga_negara", warga_negara);
                    params.put("status_perkawinan", status_perkawinan);
                    params.put("pendidikan", pendidikan);
                    params.put("agama", agama);
                    params.put("pekerjaan", pekerjaan);
                    params.put("no_nik", no_nik);
                    params.put("alamat_pasien", alamat_pasien);
                    params.put("no_tlp", no_tlp);
                    params.put("nama_ayah", nama_ayah);
                    params.put("nama_ibu", nama_ibu);
                    params.put("hub_pasien", hub_pasien);
                    params.put("keluhan", keluhan);

                    Log.e("params" , "params" + params);
                    return params;
                } else {
                    params.put("kd_regist", kd_regist);
                    params.put("nama_pasien", nama_pasien);
                    params.put("tempat_lahir", tempat_lahir);
                    params.put("tgl_lahir", tgl_lahir);
                    params.put("keterbatasan", keterbatasan);
                    params.put("jenis_kelamin", jenis_kelamin);
                    params.put("warga_negara", warga_negara);
                    params.put("status_perkawinan", status_perkawinan);
                    params.put("pendidikan", pendidikan);
                    params.put("agama", agama);
                    params.put("pekerjaan", pekerjaan);
                    params.put("no_nik", no_nik);
                    params.put("alamat_pasien", alamat_pasien);
                    params.put("no_tlp", no_tlp);
                    params.put("nama_ayah", nama_ayah);
                    params.put("nama_ibu", nama_ibu);
                    params.put("foto", imageToString(bitmapFoto));
                    params.put("hub_pasien", hub_pasien);
                    params.put("keluhan", keluhan);
                    return params;
                }
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(periksanya);
    }
}