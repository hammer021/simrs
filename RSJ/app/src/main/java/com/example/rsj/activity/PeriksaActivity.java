package com.example.rsj.activity;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import android.Manifest;
import android.app.AlertDialog;
import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.Bundle;
import android.os.Handler;
import android.provider.MediaStore;
import android.text.InputType;
import android.util.Base64;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.DatePicker;
import android.widget.ImageView;
import android.widget.ProgressBar;
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
import com.google.android.material.textfield.TextInputEditText;
import com.google.android.material.textfield.TextInputLayout;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.FileNotFoundException;
import java.io.InputStream;
import java.util.Calendar;
import java.util.HashMap;
import java.util.Map;

public class PeriksaActivity extends AppCompatActivity {
    ProgressDialog progressDialog;
    authdata authdataa;
    RequestQueue requestQueue;
    ProgressBar progressBar;

    private final int IMG_REQUEST = 1;
    boolean statusImage = false, doubleBackToExit;
    private int CAMERA_REQUEST = 1888;
    private int GALLERY_REQUEST = 1999;
    final CharSequence[] dialogItems = {"Kamera", "Galeri", "Batal"};
    private static final int REQUEST_CAMERA = 100;
    private static final int REQUEST_GALLERY = 200;

    TextInputLayout edtnama, edttemmpatlahir, edttgllahir, edtjeniskelamin, edtstatuskawin, edtketerbatasan,
                    edtwarga, edtpendidikan, edtagama, edtpekerjaan, edtnik, edtalamat, edtnotelpon, edtayah,
                    edtibu, edthubpasien, edtkeluhan;
    TextInputEditText txttgllahir, txtjeniskelamin, txtstatuskawin, txtketerbatasan, txtpendidikan,
                    txtagama, txthubunganpasien;
    ImageView txtpathfoto;
    Button uploadfoto, simpanperiksa;
    Bitmap bitmapFoto;
    CheckBox checkBox;
    CardView cardView;

    String mKdRegist;

    final Calendar c = Calendar.getInstance();
    int mYear = c.get(Calendar.YEAR);
    int mMonth = c.get(Calendar.MONTH);
    int mDay = c.get(Calendar.DAY_OF_MONTH);
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_periksa);

        authdataa = new authdata(this);
        progressBar = new ProgressBar(this);
        progressDialog = new ProgressDialog(this);
        requestQueue = Volley.newRequestQueue(this);
        mKdRegist = authdataa.getKodeUser();

        edtnama = findViewById(R.id.text_nama_periksa);
        edttemmpatlahir = findViewById(R.id.text_tempatlahir_periksa);
        edttgllahir = findViewById(R.id.text_tanggallahir_periksa);
        txttgllahir = findViewById(R.id.tanggallahir_periksa);
        edtjeniskelamin = findViewById(R.id.text_jeniskelamin_periksa);
        txtjeniskelamin = findViewById(R.id.jeniskelamin_periksa);
        edtstatuskawin = findViewById(R.id.text_statusperkawinan_periksa);
        txtstatuskawin = findViewById(R.id.statusperkawinan_periksa);
        edtketerbatasan = findViewById(R.id.text_keterbatasan_periksa);
        txtketerbatasan = findViewById(R.id.keterbatasan_periksa);
        edtwarga = findViewById(R.id.text_warganegara_periksa);
        edtpendidikan = findViewById(R.id.text_pendidikan_periksa);
        txtpendidikan = findViewById(R.id.pendidikan_periksa);
        edtagama = findViewById(R.id.text_agama_periksa);
        txtagama = findViewById(R.id.agama_periksa);
        edtpekerjaan = findViewById(R.id.text_pekerjaan_periksa);
        edtnik = findViewById(R.id.text_nonik_periksa);
        edtalamat = findViewById(R.id.text_alamat_periksa);
        edtnotelpon = findViewById(R.id.text_notelp_periksa);
        edtayah = findViewById(R.id.text_ayah_periksa);
        edtibu = findViewById(R.id.text_ibu_periksa);
        edthubpasien = findViewById(R.id.text_hubunganpasien_periksa);
        txthubunganpasien = findViewById(R.id.hubunganpasien_periksa);
        edtkeluhan = findViewById(R.id.text_keluhan_periksa);
        txtpathfoto = findViewById(R.id.text_pathfoto_periksa);
        uploadfoto = findViewById(R.id.btn_upload_periksa);
        simpanperiksa = findViewById(R.id.btn_periksa);
        checkBox = findViewById(R.id.check_image_periksa);
        cardView = findViewById(R.id.card_image_periksa);

        checkBox.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (checkBox.isChecked()) {
                    cardView.setVisibility(View.VISIBLE);
                } else {
                    cardView.setVisibility(View.GONE);
                }
            }
        });

        txttgllahir.setInputType(InputType.TYPE_NULL);
        txttgllahir.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                DatePickerDialog datePickerDialog = new DatePickerDialog(PeriksaActivity.this,
                        new DatePickerDialog.OnDateSetListener() {
                            @Override
                            public void onDateSet(DatePicker view, int year,
                                                  int monthOfYear, int dayOfMonth) {

                                txttgllahir.setText(year + "-" + (monthOfYear + 1) + "-" + dayOfMonth);

                            }
                        }, mYear, mMonth, mDay);
                datePickerDialog.show();
            }
        });

        txtjeniskelamin.setInputType(InputType.TYPE_NULL);
        txtjeniskelamin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog.Builder builder = new AlertDialog.Builder(PeriksaActivity.this);
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

        txtstatuskawin.setInputType(InputType.TYPE_NULL);
        txtstatuskawin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog.Builder builder = new AlertDialog.Builder(PeriksaActivity.this);
                builder.setTitle("Pilih Status Perkawinan");

                // buat array list
                final String[] options = {"Sudah Kawin", "Belum Kawin", "Kawin Cerai"};

                //Pass array list di Alert dialog
                builder.setItems(options, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        txtstatuskawin.setText(options[which]);
                    }
                });
                // buat dan tampilkan alert dialog
                AlertDialog dialog = builder.create();
                dialog.show();
            }
        });

        txthubunganpasien.setInputType(InputType.TYPE_NULL);
        txthubunganpasien.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog.Builder builder = new AlertDialog.Builder(PeriksaActivity.this);
                builder.setTitle("Hubungan anda dengan Pasien");

                // buat array list
                final String[] options = {"Orang Tua", "Saudara", "Teman", "Tidak memiliki hubungan"};

                //Pass array list di Alert dialog
                builder.setItems(options, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        txthubunganpasien.setText(options[which]);
                    }
                });
                // buat dan tampilkan alert dialog
                AlertDialog dialog = builder.create();
                dialog.show();
            }
        });

        txtagama.setInputType(InputType.TYPE_NULL);
        txtagama.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog.Builder builder = new AlertDialog.Builder(PeriksaActivity.this);
                builder.setTitle("Pilih Agama anda");

                // buat array list
                final String[] options = {"Islam", "Kristen", "Hindu", "Budha", "Katolik", "Lainnya"};

                //Pass array list di Alert dialog
                builder.setItems(options, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        txtagama.setText(options[which]);
                    }
                });
                // buat dan tampilkan alert dialog
                AlertDialog dialog = builder.create();
                dialog.show();
            }
        });

        txtpendidikan.setInputType(InputType.TYPE_NULL);
        txtpendidikan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog.Builder builder = new AlertDialog.Builder(PeriksaActivity.this);
                builder.setTitle("Pilih pendidikan terakhir pasien");

                // buat array list
                final String[] options = {"TK", "SD", "SMP", "SMA / SMK / MA", "D1", "D2", "D3", "D4 / S1", "S2", "S3", "Tidak Sekolah"};

                //Pass array list di Alert dialog
                builder.setItems(options, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        txtpendidikan.setText(options[which]);
                    }
                });
                // buat dan tampilkan alert dialog
                AlertDialog dialog = builder.create();
                dialog.show();
            }
        });

        txtketerbatasan.setInputType(InputType.TYPE_NULL);
        txtketerbatasan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog.Builder builder = new AlertDialog.Builder(PeriksaActivity.this);
                builder.setTitle("Keterbatasan yang dimiliki Pasien");

                // buat array list
                final String[] options = {"Tuna rungu", "Tuna netra", "Tuna wicara", "Tuna grahita", "dan lain-lain"};

                //Pass array list di Alert dialog
                builder.setItems(options, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        txtketerbatasan.setText(options[which]);
                    }
                });
                // buat dan tampilkan alert dialog
                AlertDialog dialog = builder.create();
                dialog.show();
            }
        });

        uploadfoto.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                selectImage();
            }
        });

        simpanperiksa.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                periksa();
            }
        });
    }

    private void selectImage() {
        AlertDialog.Builder dialog = new AlertDialog.Builder(PeriksaActivity.this);
        dialog.setTitle("Tambahkan Foto");
        dialog.setItems(dialogItems, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                // select by camera
                if (dialogItems[which].equals("Kamera")) {
                    if (ContextCompat.checkSelfPermission(PeriksaActivity.this, Manifest.permission.CAMERA) != PackageManager.PERMISSION_GRANTED) {
                        ActivityCompat.requestPermissions(PeriksaActivity.this,
                                new String[]{
                                        Manifest.permission.CAMERA
                                }, REQUEST_CAMERA);
                    } else {
                        Intent cameraIntent = new Intent(android.provider.MediaStore.ACTION_IMAGE_CAPTURE);
                        startActivityForResult(cameraIntent, CAMERA_REQUEST);
                    }
                }

                //select by gallery
                if (dialogItems[which].equals("Galeri")) {
                    Intent galleryIntent = new Intent(Intent.ACTION_PICK, MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
                    galleryIntent.setType("image/*");
                    startActivityForResult(galleryIntent, GALLERY_REQUEST);
                }

                if (dialogItems[which].equals("Batal")) {
                    dialog.dismiss();
                } else {
                    dialog.dismiss();
                }
            }
        });

        dialog.show();
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        if (requestCode == REQUEST_CAMERA) {
            if (grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                Toast.makeText(this, "camera permission granted", Toast.LENGTH_LONG).show();
                Intent cameraIntent = new Intent(android.provider.MediaStore.ACTION_IMAGE_CAPTURE);
                startActivityForResult(cameraIntent, CAMERA_REQUEST);
            } else {
                Toast.makeText(this, "camera permission denied", Toast.LENGTH_LONG).show();
            }
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

        if (requestCode == CAMERA_REQUEST && resultCode == RESULT_OK && data != null) {
            Uri path = data.getData();

            Bitmap photo = (Bitmap) data.getExtras().get("data");
            bitmapFoto = ImageResizer.reduceBitmapSize(photo, 240000);

            txtpathfoto.setImageBitmap(bitmapFoto);
            Toast.makeText(this, "Berhasil mengambil gambar", Toast.LENGTH_SHORT).show();
        } else if (requestCode == GALLERY_REQUEST && resultCode == RESULT_OK && data != null) {
            Uri path = data.getData();

            try {
                InputStream inputStream = getContentResolver().openInputStream(path);
                Bitmap photo = BitmapFactory.decodeStream(inputStream);
                bitmapFoto = ImageResizer.reduceBitmapSize(photo, 240000);

                txtpathfoto.setImageBitmap(bitmapFoto);
                Toast.makeText(this, "Berhasil mengambil gambar", Toast.LENGTH_SHORT).show();
            } catch (FileNotFoundException e) {
                Toast.makeText(this, e.toString(), Toast.LENGTH_LONG).show();
            }
        } else {
            Toast.makeText(this, "Harap Pilih Gambar", Toast.LENGTH_SHORT).show();
        }
    }

    @Override
    public void onBackPressed() {
        if (doubleBackToExit) {
            Intent abc = new Intent(PeriksaActivity.this, MainActivity.class);
            startActivity(abc);
        }

        this.doubleBackToExit = true;
        Snackbar.make(findViewById(R.id.periksaactivity), "Tekan kembali sekali lagi untuk batalkan pemeriksaan", Snackbar.LENGTH_LONG).show();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                doubleBackToExit=false;
            }
        }, 2000);
    }

    private void periksa(){
        final String nama_pasien = this.edtnama.getEditText().getText().toString().trim();
        final String tempat_lahir = this.edttemmpatlahir.getEditText().getText().toString().trim();
        final String tgl_lahir = this.txttgllahir.getText().toString().trim();
        final String keterbatasan = this.txtketerbatasan.getText().toString().trim();
        final String jenis_kelamin = this.txtjeniskelamin.getText().toString().trim();
        final String warga_negara = this.edtwarga.getEditText().getText().toString().trim();
        final String status_perkawinan = this.txtstatuskawin.getText().toString().trim();
        final String pendidikan = this.txtpendidikan.getText().toString().trim();
        final String agama = this.txtagama.getText().toString().trim();
        final String pekerjaan = this.edtpekerjaan.getEditText().getText().toString().trim();
        final String no_nik = this.edtnik.getEditText().getText().toString().trim();
        final String alamat_pasien = this.edtalamat.getEditText().getText().toString().trim();
        final String no_tlp = this.edtnotelpon.getEditText().getText().toString().trim();
        final String nama_ayah = this.edtayah.getEditText().getText().toString().trim();
        final String nama_ibu = this.edtibu.getEditText().getText().toString().trim();
        final String hub_pasien = this.txthubunganpasien.getText().toString().trim();
        final String keluhan = this.edtkeluhan.getEditText().getText().toString().trim();

        if (nama_pasien.matches("")){
            Toast.makeText(this, "Masukkan Nama Lengkap Pasien", Toast.LENGTH_SHORT).show();
            return;
        }
        if (tempat_lahir.matches("")){
            Toast.makeText(this, "Masukkan tempat lahir Pasien", Toast.LENGTH_SHORT).show();
            return;
        }
        if (tgl_lahir.matches("")){
            Toast.makeText(this, "Masukkan tanggal lahir Pasien", Toast.LENGTH_SHORT).show();
            return;
        }
        if (jenis_kelamin.matches("")){
            Toast.makeText(this, "Masukkan jenis kelamin Pasien", Toast.LENGTH_SHORT).show();
            return;
        }
        if (warga_negara.matches("")){
            Toast.makeText(this, "Masukkan warga negara Pasien", Toast.LENGTH_SHORT).show();
            return;
        }
        if (status_perkawinan.matches("")){
            Toast.makeText(this, "Masukkan status perkawinan Pasien", Toast.LENGTH_SHORT).show();
            return;
        }
        if (pendidikan.matches("")){
            Toast.makeText(this, "Masukkan pendidikan terakhir Pasien", Toast.LENGTH_SHORT).show();
            return;
        }
        if (agama.matches("")){
            Toast.makeText(this, "Masukkan agama Pasien", Toast.LENGTH_SHORT).show();
            return;
        }
        if (pekerjaan.matches("")){
            Toast.makeText(this, "Masukkan pekerjaan Pasien", Toast.LENGTH_SHORT).show();
            return;
        }
        if (no_nik.matches("")){
            Toast.makeText(this, "Masukkan no nik Pasien", Toast.LENGTH_SHORT).show();
            return;
        }
        if (alamat_pasien.matches("")){
            Toast.makeText(this, "Masukkan alamat pasien", Toast.LENGTH_SHORT).show();
            return;
        }
        if (no_tlp.matches("")){
            Toast.makeText(this, "Masukkan No Telpon Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (nama_ayah.matches("")){
            Toast.makeText(this, "Masukkan nama ayah Pasien", Toast.LENGTH_SHORT).show();
            return;
        }
        if (nama_ibu.matches("")){
            Toast.makeText(this, "Masukkan nama ibu Pasien", Toast.LENGTH_SHORT).show();
            return;
        }
        if (keterbatasan.matches("")){
            Toast.makeText(this, "Masukkan keterbatasan Pasien", Toast.LENGTH_SHORT).show();
            return;
        }
        if (hub_pasien.matches("")){
            Toast.makeText(this, "Masukkan Hubungan Pasien Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (keluhan.matches("")){
            Toast.makeText(this, "Masukkan keluhan Pasien", Toast.LENGTH_SHORT).show();
            return;
        }
        progressBar.setVisibility(View.GONE);

        StringRequest stringRequest = new StringRequest(Request.Method.POST, ServerApi.URL_PERIKSA, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String status = jsonObject.getString("status");
                    String error = jsonObject.getString("error");
                    String message = jsonObject.getString("message");

                    if (status.equals("200") && error.equals("false")) {
                        Toast.makeText(PeriksaActivity.this, message, Toast.LENGTH_SHORT).show();
                        new Handler().postDelayed(new Runnable() {
                            @Override
                            public void run() {
                                Intent pindah = new Intent(PeriksaActivity.this, MainActivity.class);
                                startActivity(pindah);
                                finish();
                            }
                        }, 1500);
                    } else {
                        Toast.makeText(PeriksaActivity.this, message, Toast.LENGTH_SHORT).show();
                        progressBar.setVisibility(View.GONE);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                    progressBar.setVisibility(View.GONE);
                    Intent periksa = new Intent(PeriksaActivity.this, MainActivity.class);
                    startActivity(periksa);
                    finish();
                    Toast.makeText(PeriksaActivity.this, "Berhasil ! Silahkan lanjutkan pembayaran anda.", Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(PeriksaActivity.this, "Silahkan masukkan data dengan benar dan sesuai Format yang sudah di tentukan!", Toast.LENGTH_SHORT).show();
                progressBar.setVisibility(View.GONE);
            }
        })
        {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();

                if (checkBox.isChecked()) {
                    params.put("kd_regist", mKdRegist);
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
                } else {
                    params.put("kd_regist", mKdRegist);
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
//                    params.put("foto", imageToString(bitmapFoto));
                    params.put("hub_pasien", hub_pasien);
                    params.put("keluhan", keluhan);
                    return params;
                }
            }
        };
        requestQueue.add(stringRequest);
    }
}