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
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageView;
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
import com.google.android.material.textfield.TextInputEditText;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.FileNotFoundException;
import java.io.InputStream;
import java.util.Calendar;
import java.util.HashMap;
import java.util.Map;

public class EditProfilActivity extends AppCompatActivity {
    ProgressDialog progressDialog;
    authdata authdataa;
    RequestQueue queue;

    private final int IMG_REQUEST = 1;
    boolean statusImage = false, doubleBackToExit;
    private int CAMERA_REQUEST = 1888;
    private int GALLERY_REQUEST = 1999;
    final CharSequence[] dialogItems = {"Kamera", "Galeri", "Batal"};
    private static final int REQUEST_CAMERA = 100;
    private static final int REQUEST_GALLERY = 200;

    String mKdRegist;
    String mNama;
    String mTelepon;
    String mEmail;
    String mAlamat;
    String mTmpLahir;
    String mTglLahir;

    TextInputEditText txtnama, txtemail, txtnohp, txtalamat, txttempatlahir, txttgllahir;
    ImageView txtpathfoto;
    Button uploadfoto, simpanedit;
    Bitmap bitmapProfil;
    CheckBox checkBox;
    CardView cardView;

    final Calendar c = Calendar.getInstance();
    int mYear = c.get(Calendar.YEAR);
    int mMonth = c.get(Calendar.MONTH);
    int mDay = c.get(Calendar.DAY_OF_MONTH);

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_profil);

        progressDialog = new ProgressDialog(this);
        authdataa = new authdata(this);
        queue = Volley.newRequestQueue(this);

        mKdRegist = authdataa.getKodeUser();

        txtnama = findViewById(R.id.nama_editprofil);
        txtemail = findViewById(R.id.email_editprofil);
        txtnohp = findViewById(R.id.notelp_editprofil);
        txtalamat = findViewById(R.id.alamat_editprofil);
        txttempatlahir = findViewById(R.id.tempatlahir_editprofil);
        txttgllahir = findViewById(R.id.tanggallahir_editprofil);
        txtpathfoto = findViewById(R.id.text_pathfoto_editprofil);
        uploadfoto = findViewById(R.id.btn_upload_editprofil);
        simpanedit = findViewById(R.id.btn_simpan_editprofil);
        checkBox = findViewById(R.id.check_image_editprofil);
        cardView = findViewById(R.id.card_image);

        loadProfil();

        txttgllahir.setInputType(InputType.TYPE_NULL);
        txttgllahir.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                DatePickerDialog datePickerDialog = new DatePickerDialog(EditProfilActivity.this,
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

        uploadfoto.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                selectImage();
            }
        });

        simpanedit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                final String name = txtnama.getText().toString().trim();
                final String email = txtemail.getText().toString().trim();
                final String alamat = txtalamat.getText().toString().trim();
                final String no_hp = txtnohp.getText().toString().trim();
                final String tgl_lahir = txttgllahir.getText().toString().trim();
                final String tempat_lahir = txttempatlahir.getText().toString().trim();

                if (name.matches("")){
                    Toast.makeText(EditProfilActivity.this, "Masukkan Nama Lengkap Anda", Toast.LENGTH_SHORT).show();
                    return;
                }
                if (email.matches("")){
                    Toast.makeText(EditProfilActivity.this, "Masukkan Email Anda", Toast.LENGTH_SHORT).show();
                    return;
                }
                if (alamat.matches("")){
                    Toast.makeText(EditProfilActivity.this, "Masukkan Alamat Anda", Toast.LENGTH_SHORT).show();
                    return;
                }
                if (no_hp.matches("")){
                    Toast.makeText(EditProfilActivity.this, "Masukkan No Telpon Anda", Toast.LENGTH_SHORT).show();
                    return;
                }
                if (tgl_lahir.matches("")){
                    Toast.makeText(EditProfilActivity.this, "Masukkan Tanggal Lahir Anda", Toast.LENGTH_SHORT).show();
                    return;
                }
                if (tempat_lahir.matches("")){
                    Toast.makeText(EditProfilActivity.this, "Masukkan Tempat Lahir Anda", Toast.LENGTH_SHORT).show();
                    return;
                }

                updateProfil();
                Toast.makeText(EditProfilActivity.this, "Berhasil mengubah profil",Toast.LENGTH_LONG).show();
            }
        });
    }

    private void selectImage() {
        AlertDialog.Builder dialog = new AlertDialog.Builder(EditProfilActivity.this);
        dialog.setTitle("Masukkan Foto");
        dialog.setItems(dialogItems, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                // select by camera
                if (dialogItems[which].equals("Kamera")) {
                    if (ContextCompat.checkSelfPermission(EditProfilActivity.this, Manifest.permission.CAMERA) != PackageManager.PERMISSION_GRANTED) {
                        ActivityCompat.requestPermissions(EditProfilActivity.this,
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
            bitmapProfil = ImageResizer.reduceBitmapSize(photo, 240000);

            txtpathfoto.setImageBitmap(bitmapProfil);
            Toast.makeText(this, "Berhasil mengambil foto", Toast.LENGTH_SHORT).show();
        } else if (requestCode == GALLERY_REQUEST && resultCode == RESULT_OK && data != null) {
            Uri path = data.getData();

            try {
                InputStream inputStream = getContentResolver().openInputStream(path);
                Bitmap photo = BitmapFactory.decodeStream(inputStream);
                bitmapProfil = ImageResizer.reduceBitmapSize(photo, 240000);

                txtpathfoto.setImageBitmap(bitmapProfil);
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
            Intent abc = new Intent(EditProfilActivity.this, MainActivity.class);
            startActivity(abc);
        }

        this.doubleBackToExit = true;
        Snackbar.make(findViewById(R.id.editproiflactivity), "Tekan kembali sekali lagi untuk batalkan pemeriksaan", Snackbar.LENGTH_LONG).show();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                doubleBackToExit=false;
            }
        }, 2000);
    }

    private void loadProfil() {
        progressDialog.setMessage("Sedang Memperbarui Data...");
        progressDialog.setCancelable(false);
        progressDialog.show();

        String url = ServerApi.URL_USER + mKdRegist;

        StringRequest stringRequest = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                progressDialog.dismiss();
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String status = jsonObject.getString("status");
                    if (status.equals("false")) {
                        String message = jsonObject.getString("message");
                        Snackbar.make(findViewById(R.id.editproiflactivity), message, Snackbar.LENGTH_LONG).show();
                    } else {
                        JSONArray data = jsonObject.getJSONArray("data");
                        JSONObject dataUser = data.getJSONObject(0);

                        mNama = dataUser.getString("name");
                        mEmail = dataUser.getString("email");
                        mAlamat = dataUser.getString("alamat");
                        mTelepon = dataUser.getString("no_hp");
                        mTglLahir = dataUser.getString("tgl_lahir");
                        mTmpLahir = dataUser.getString("tempat_lahir");

                        txtnama.setText(mNama);
                        txtemail.setText(mEmail);
                        txtalamat.setText(mAlamat);
                        txtnohp.setText(mTelepon);
                        txttgllahir.setText(mTglLahir);
                        txttempatlahir.setText(mTmpLahir);
                    }
                } catch (JSONException e) {
                    Snackbar.make(findViewById(R.id.editproiflactivity), e.toString(), Snackbar.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
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
                Snackbar.make(findViewById(R.id.editproiflactivity), message, Snackbar.LENGTH_LONG).show();
            }
        });
        queue.add(stringRequest);
    }

    private void updateProfil(){
        progressDialog.setMessage("Sedang Memperbarui Data...");
        progressDialog.setCancelable(false);
        progressDialog.show();

        String url = ServerApi.URL_PUT_USER;

        StringRequest updateRequest = new StringRequest(Request.Method.PUT, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                progressDialog.dismiss();
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String message = jsonObject.getString("message");
                    JSONObject update = jsonObject.getJSONObject("update");

                    authdataa.setNamaUser(update.getString("name"));
                    authdataa.setFotoUser(update.getString("image"));

                    Snackbar.make(findViewById(R.id.editproiflactivity), message, Snackbar.LENGTH_LONG).show();

                    Intent main = new Intent(EditProfilActivity.this, MainActivity.class);
                    startActivity(main);
                    finish();
                } catch (JSONException e) {
                    progressDialog.dismiss();
                    Toast.makeText(getApplicationContext(), e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
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
                Snackbar.make(findViewById(R.id.editproiflactivity), message, Snackbar.LENGTH_LONG).show();
            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();

                if (checkBox.isChecked()) {
                    params.put("kd_regist", mKdRegist);
                    params.put("name", txtnama.getText().toString().trim());
                    params.put("image", imageToString(bitmapProfil));
                    params.put("alamat", txtalamat.getText().toString().trim());
                    params.put("no_hp", txtnohp.getText().toString().trim());
                    params.put("tgl_lahir", txttgllahir.getText().toString().trim());
                    params.put("tempat_lahir", txttempatlahir.getText().toString().trim());

                    return params;
                } else {
                    params.put("kd_regist", mKdRegist);
                    params.put("name", txtnama.getText().toString().trim());
//                    params.put("image", imageToString(bitmapProfil));
                    params.put("alamat", txtalamat.getText().toString().trim());
                    params.put("no_hp", txtnohp.getText().toString().trim());
                    params.put("tgl_lahir", txttgllahir.getText().toString().trim());
                    params.put("tempat_lahir", txttempatlahir.getText().toString().trim());

                    return params;
                }
            }
        };
        queue.add(updateRequest);
    }
}