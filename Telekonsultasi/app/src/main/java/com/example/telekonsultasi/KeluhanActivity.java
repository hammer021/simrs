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
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.EditText;
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

import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.FileNotFoundException;
import java.io.InputStream;
import java.util.HashMap;
import java.util.Map;

public class KeluhanActivity extends AppCompatActivity {

    String[] JK = new String[]{"Laki-Laki", "Perempuan"};
    ArrayAdapter<String> adapter;
    AutoCompleteTextView jenisKelaminDropdown;

    String[] SK = new String[]{"Kawin", "Belum Kawin"};
    ArrayAdapter<String> adapter2;
    AutoCompleteTextView statusKawinDropdown;

    private final int IMG_REQUEST = 1;
    boolean statusImage = false, doubleBackToExit;

    ProgressDialog progressDialog;
    authdata authdataa;
    RequestQueue queue;

    String mKdRegist;
//    String mNama;
//    String mTempatLahir;
//    String mTglLahir;
//    String mUmur;
//    String mKeterbatasan;
//    String mJenisKelamin;
//    String mWarga;
//    String mStatusKawin;
//    String mPendidikan;
//    String mAgama;
//    String mPekerjaan;
//    String mNik;
//    String mAlamat;
//    String mNoTelepom;
//    String mAyah;
//    String mIbu;
//    String mHubPasien;

    TextInputLayout txttanggal, txtjeniskelamin, txtstatuskawin;
    EditText txtnama, txttempatlahir, txtumur, txtketerbatasan,
            txtwarga, txtpendidikan, txtagama, txtpekerjaan,
            txtnik, txtalamat, txtnotelpon, txtayah, txtibu, txthubpasien, txtkeluhan;
    TextView txtkoderegist, txtpathfoto;
    Button uploadfoto, simpanperiksa;
    Bitmap bitmapFoto;

    private String nama;
    private String kdregistnya = "NAMA";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_keluhan);

        initWidgetId();
        Bundle extras = getIntent().getExtras();
        nama = extras.getString(kdregistnya);
        txtkoderegist.setText(nama);
//    mKdRegist = authdataa.getKodeUser();

    progressDialog = new ProgressDialog(this);
    authdataa = new authdata(this);
    queue = Volley.newRequestQueue(this);

    adapter = new ArrayAdapter<>(this, R.layout.dropdown_item, JK);
        jenisKelaminDropdown.setAdapter(adapter);
    adapter2 = new ArrayAdapter<>(this, R.layout.dropdown_item, SK);
        statusKawinDropdown.setAdapter(adapter2);

        uploadfoto.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View view) {
            selectImage();
        }
    });

        simpanperiksa.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View view) {
            if (validateTextInput(txtnama, "Nama harus diisi!") &
                    validateTextInput(txttempatlahir, "Tempat Lahir harus diisi!") &
                    validateTextInput(txttanggal, "Tempat Lahir harus diisi!") &
//                    validateTextInput(txtumur, "Tanggal Lahir harus diisi!") &
                    validateTextInput(txtketerbatasan, "Tanggal Lahir harus diisi!") &
                    validateTextInput(txtjeniskelamin, "Tanggal Lahir harus diisi!") &
                    validateTextInput(txtwarga, "Tanggal Lahir harus diisi!") &
                    validateTextInput(txtstatuskawin, "Tanggal Lahir harus diisi!") &
                    validateTextInput(txtpendidikan, "Tanggal Lahir harus diisi!") &
                    validateTextInput(txtagama, "Tanggal Lahir harus diisi!") &
                    validateTextInput(txtpekerjaan, "Tanggal Lahir harus diisi!") &
                    validateTextInput(txtnik, "Tanggal Lahir harus diisi!") &
                    validateTextInput(txtnotelpon, "Tanggal Lahir harus diisi!") &
                    validateTextInput(txtayah, "Tanggal Lahir harus diisi!") &
                    validateTextInput(txtibu, "Tanggal Lahir harus diisi!") &
                    validateTextInput(txthubpasien, "Tanggal Lahir harus diisi!") &
                    validateTextInput(txtkeluhan, "Tanggal Lahir harus diisi!")){

                periksa();

                Intent main = new Intent(KeluhanActivity.this, NavFragment.class);
                startActivity(main);
                finish();

                Toast.makeText(getApplicationContext(), "Berhasil mendaftarkan Pasien.",Toast.LENGTH_LONG).show();

            } else {
                Snackbar.make(findViewById(R.id.activitykeluhan), "Data belum terpenuhi", Snackbar.LENGTH_SHORT).show();
            }
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
        txtkoderegist = findViewById(R.id.kdregist);
        txtnama = findViewById(R.id.edtnamapasien);
        txttempatlahir = findViewById(R.id.edttempatlahirpsn);
        txttanggal = findViewById(R.id.edttgllahirpsn);
//        txtumur = findViewById(R.id.edtumur);
        txtketerbatasan = findViewById(R.id.edtketerbatasan);
        txtjeniskelamin = findViewById(R.id.edtjeniskelamin);
        txtjeniskelamin = findViewById(R.id.edtjeniskelamin);
        jenisKelaminDropdown = findViewById(R.id.text_dropdown_jenis_kelamin);
        txtwarga = findViewById(R.id.edtwarganegara);
        txtstatuskawin = findViewById(R.id.edtstatusperkawinan);
        statusKawinDropdown = findViewById(R.id.text_dropdown_status_perkawinan);
        txtpendidikan = findViewById(R.id.edtpendidikan);
        txtagama = findViewById(R.id.edtagama);
        txtpekerjaan = findViewById(R.id.edtpekerjaan);
        txtnik = findViewById(R.id.edtnonik);
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

    private boolean validateTextInput(EditText editText, String errorMessage) {
        Log.d("pesan", errorMessage);
        String input = editText.getText().toString().trim();

        if (input.isEmpty()) {
            editText.setError(errorMessage);
            return false;
        } else {
            editText.setError(null);
            return true;
        }
    }

    private boolean validateTextInput(TextInputLayout textInputLayout, String errorMessage) {
        String input = textInputLayout.getEditText().getText().toString().trim();

        if (input.isEmpty()) {
            textInputLayout.setError(errorMessage);
            return false;
        } else {
            textInputLayout.setError(null);
            return true;
        }
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

    private void periksa(){
        progressDialog.setMessage("Sedang Memperbarui Data...");
        progressDialog.setCancelable(false);
        progressDialog.show();

        String url = ServerApi.URL_PERIKSA;

        StringRequest stringRequest = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                progressDialog.dismiss();

                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String message = jsonObject.getString("pesan");

                    Snackbar.make(findViewById(R.id.activitykeluhan), message, Snackbar.LENGTH_LONG).show();
                } catch (Exception e) {
                    Toast.makeText(getApplicationContext(), e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                String message = "Terjadi error. Coba beberapa saat lagi.";

                if (error instanceof NetworkError) {
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

                Snackbar.make(findViewById(R.id.activitykeluhan), message, Snackbar.LENGTH_LONG).show();
            }
        })
        {
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();

                String fotonya = txtpathfoto.getText().toString().trim();

                if (fotonya.matches("")) {
                    params.put("kd_regist", txtkoderegist.getText().toString().trim());
                    params.put("nama_pasien", txtnama.getText().toString().trim());
                    params.put("tempat_lahir", txttempatlahir.getText().toString().trim());
                    params.put("tgl_lahir", txttanggal.getEditText().toString().trim());
                    params.put("jenis_kelamin", txtjeniskelamin.getEditText().toString().trim());
                    params.put("warga_negara", txtwarga.getText().toString().trim());
                    params.put("status_perkawinan", txtstatuskawin.getEditText().toString().trim());
                    params.put("pendidikan", txtpendidikan.getText().toString().trim());
                    params.put("agama", txtagama.getText().toString().trim());
                    params.put("pekerjaan", txtpekerjaan.getText().toString().trim());
                    params.put("no_nik", txtnik.getText().toString().trim());
                    params.put("alamat_pasien", txtalamat.getText().toString().trim());
                    params.put("no_tlp", txtnotelpon.getText().toString().trim());
                    params.put("nama_ayah", txtayah.getText().toString().trim());
                    params.put("nama_ibu", txtibu.getText().toString().trim());
                    params.put("keterbatasan", txtketerbatasan.getText().toString().trim());
                    params.put("keluhan", txtkeluhan.getText().toString().trim());

                    return params;
                } else {
                    params.put("kd_regist", txtkoderegist.getText().toString().trim());
                    params.put("nama_pasien", txtnama.getText().toString().trim());
                    params.put("tempat_lahir", txttempatlahir.getText().toString().trim());
                    params.put("tgl_lahir", txttanggal.getEditText().toString().trim());
                    params.put("jenis_kelamin", txtjeniskelamin.getEditText().toString().trim());
                    params.put("warga_negara", txtwarga.getText().toString().trim());
                    params.put("status_perkawinan", txtstatuskawin.getEditText().toString().trim());
                    params.put("pendidikan", txtpendidikan.getText().toString().trim());
                    params.put("agama", txtagama.getText().toString().trim());
                    params.put("pekerjaan", txtpekerjaan.getText().toString().trim());
                    params.put("no_nik", txtnik.getText().toString().trim());
                    params.put("alamat_pasien", txtalamat.getText().toString().trim());
                    params.put("no_tlp", txtnotelpon.getText().toString().trim());
                    params.put("nama_ayah", txtayah.getText().toString().trim());
                    params.put("nama_ibu", txtibu.getText().toString().trim());
                    params.put("keterbatasan", txtketerbatasan.getText().toString().trim());
                    params.put("foto", imageToString(bitmapFoto));
                    params.put("keluhan", txtkeluhan.getText().toString().trim());

                    return params;
                }
            }
        };
        queue.add(stringRequest);
    }
}