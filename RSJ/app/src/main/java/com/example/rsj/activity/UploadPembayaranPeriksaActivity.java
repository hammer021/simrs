package com.example.rsj.activity;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import android.Manifest;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.media.Image;
import android.net.Uri;
import android.os.Bundle;
import android.os.Handler;
import android.provider.MediaStore;
import android.util.Base64;
import android.view.View;
import android.widget.Button;
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

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.FileNotFoundException;
import java.io.InputStream;
import java.util.HashMap;
import java.util.Map;

public class UploadPembayaranPeriksaActivity extends AppCompatActivity {
    TextView txtnomer, txtnama, txttanggal, txtkeluhan, txtharga;
    ImageView patfbukti;
    Button uploadbukti, simpanbukti;
    String no_rm_intent;

    ProgressDialog progressDialog;
    RequestQueue requestQueue;
    authdata authdataa;

    private final int IMG_REQUEST = 1;
    boolean statusImage = false;
    boolean doubleBackToExit;

    private int CAMERA_REQUEST = 1888;
    private int GALLERY_REQUEST = 1999;
    final CharSequence[] dialogItems = {"Kamera", "Galeri", "Batal"};
    private static final int REQUEST_CAMERA = 100;
    private static final int REQUEST_GALLERY = 200;

    Bitmap bitmapBuktiBayar;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_upload_pembayaran_periksa);
        progressDialog = new ProgressDialog(this);
        requestQueue = Volley.newRequestQueue(this);
        authdataa = new authdata(this);

        Intent intent = getIntent();
        no_rm_intent = intent.getStringExtra("no_rm");

        txtnomer = findViewById(R.id.text_norm_uploadperiksa);
        txtnama = findViewById(R.id.text_nama_uploadperiksa);
        txttanggal = findViewById(R.id.text_tglkunjungan_uploadperiksa);
        txtkeluhan = findViewById(R.id.text_keluhan_uploadperiksa);
        txtharga = findViewById(R.id.text_harga_uploadperiksa);
        patfbukti = findViewById(R.id.text_pathfoto_uploadperiksa);
        uploadbukti = findViewById(R.id.btn_upload_uploadperiksa);
        simpanbukti = findViewById(R.id.btn_simpan_uploadperiksa);

        if (statusImage) {
            simpanbukti.setVisibility(View.GONE);
        } else {
            simpanbukti.setVisibility(View.VISIBLE);
        }

        loadPembayaranPeriksa();

        uploadbukti.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                selectImage();
            }
        });

        simpanbukti.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                updatePembayaranPeriksa();
            }
        });
    }

    private void selectImage() {
        AlertDialog.Builder dialog = new AlertDialog.Builder(UploadPembayaranPeriksaActivity.this);
        dialog.setTitle("Upload bukti Pembayaran");
        dialog.setItems(dialogItems, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                // select by camera
                if (dialogItems[which].equals("Kamera")) {
                    if (ContextCompat.checkSelfPermission(UploadPembayaranPeriksaActivity.this, Manifest.permission.CAMERA) != PackageManager.PERMISSION_GRANTED) {
                        ActivityCompat.requestPermissions(UploadPembayaranPeriksaActivity.this,
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

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if (requestCode == CAMERA_REQUEST && resultCode == RESULT_OK && data != null) {
            Uri path = data.getData();

            Bitmap photo = (Bitmap) data.getExtras().get("data");
            bitmapBuktiBayar = ImageResizer.reduceBitmapSize(photo, 240000);

            patfbukti.setImageBitmap(bitmapBuktiBayar);
            Toast.makeText(this, "Berhasil mengambil foto", Toast.LENGTH_SHORT).show();
        } else if (requestCode == GALLERY_REQUEST && resultCode == RESULT_OK && data != null) {
            Uri path = data.getData();

            try {
                InputStream inputStream = getContentResolver().openInputStream(path);
                Bitmap photo = BitmapFactory.decodeStream(inputStream);
                bitmapBuktiBayar = ImageResizer.reduceBitmapSize(photo, 240000);

                patfbukti.setImageBitmap(bitmapBuktiBayar);
                Toast.makeText(this, "Berhasil mengambil foto", Toast.LENGTH_SHORT).show();
            } catch (FileNotFoundException e) {
                Toast.makeText(this, e.toString(), Toast.LENGTH_LONG).show();
            }
        } else {
            Toast.makeText(this, "Harap Pilih foto", Toast.LENGTH_SHORT).show();
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
    public void onBackPressed() {
        if (doubleBackToExit) {
            Intent abc = new Intent(UploadPembayaranPeriksaActivity.this, PembayaranPeriksaActivity.class);
            startActivity(abc);
        }

        this.doubleBackToExit = true;
        Snackbar.make(findViewById(R.id.uploadpembayaranperiksa), "Tekan kembali sekali lagi untuk batalkan pemeriksaan", Snackbar.LENGTH_LONG).show();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                doubleBackToExit=false;
            }
        }, 2000);
    }

    private void loadPembayaranPeriksa() {
        progressDialog.setMessage("Sedang Memperbarui Data...");
        progressDialog.setCancelable(false);
        progressDialog.show();

        StringRequest load = new StringRequest(Request.Method.POST, ServerApi.URL_BUKTI, new Response.Listener<String>() {
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
                        String keluhan = utama.getString("keluhan");
                        String harga = utama.getString("harga");

                        txtnomer.setText(no_rm);
                        txtnama.setText(nama_pasien);
                        txttanggal.setText(tgl_kunjungan);
                        txtkeluhan.setText(keluhan);
                        txtharga.setText(harga);
                    } else {
                        Toast.makeText(UploadPembayaranPeriksaActivity.this, "Gagal upload bukti pembayaran", Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(UploadPembayaranPeriksaActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
                progressDialog.dismiss();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                Toast.makeText(UploadPembayaranPeriksaActivity.this, error.toString(), Toast.LENGTH_LONG).show();
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
        requestQueue.add(load);
    }

    private void updatePembayaranPeriksa() {
        StringRequest update = new StringRequest(Request.Method.PUT, ServerApi.URL_BUKTI, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                progressDialog.dismiss();
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String message = jsonObject.getString("message");
                    Toast.makeText(UploadPembayaranPeriksaActivity.this, message, Toast.LENGTH_LONG).show();
                } catch (JSONException e) {
                    progressDialog.dismiss();
                    Toast.makeText(UploadPembayaranPeriksaActivity.this, e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                Toast.makeText(UploadPembayaranPeriksaActivity.this, "Gagal upload bukti pembayaran", Toast.LENGTH_LONG).show();
            }
        })
        {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
//                params.put("no_rm", no_rm_intent);
                params.put("no_rm", no_rm_intent.toString().split(" : ")[1]);
                params.put("buktikeluhan", imageToString(bitmapBuktiBayar));
                return params;
            }
        };
        requestQueue.add(update);
    }
}