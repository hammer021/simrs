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
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.ClientError;
import com.android.volley.Network;
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

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.FileNotFoundException;
import java.io.InputStream;
import java.util.HashMap;
import java.util.Map;

public class EditProfilActivity extends AppCompatActivity {
    ProgressDialog progressDialog;
    authdata authdataa;
    RequestQueue queue;

    private final int IMG_REQUEST = 1;
    boolean statusImage = false, doubleBackToExit;

    String mKdRegist;
    String mNama;
    String mTelepon;
    String mEmail;
    String mAlamat;
    String mTmpLahir;
    String mTglLahir;

    EditText txtnama, txtnohp, txtalamat, txttgllahir, txttempatlahir, txtemail;
    TextView txtfoto;
    Button uploadfoto, simpanedit;
    Bitmap bitmapProfil;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_profil);

        progressDialog = new ProgressDialog(this);
        authdataa = new authdata(this);
        queue = Volley.newRequestQueue(this);

        mKdRegist = authdataa.getKodeUser();

        initWidgetId();
        simpanedit.setEnabled(false);
        loadProfil();

        uploadfoto.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                selectImage();
            }
        });

        simpanedit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (validateTextInput(txtnama, "Nama harus diisi!") &
                        validateTextInput(txtemail, "Email harus diisi!") &
                        validateTextInput(txtalamat, "Alamat harus diisi!") &
                        validateTextInput(txtnohp, "No Telepon harus diisi!") &
                        validateTextInput(txttgllahir, "Tanggal Lahir harus diisi!") &
                        validateTextInput(txttempatlahir, "Tempat Lahir harus diisi!")) {

                    updateProfil();

                    Intent main = new Intent(EditProfilActivity.this, NavFragment.class);
                    startActivity(main);
                    finish();

                    Toast.makeText(getApplicationContext(), "Berhasil mengubah profil",Toast.LENGTH_LONG).show();

                } else {
                    Snackbar.make(findViewById(R.id.editprofilactivity), "Data diri belum terpenuhi", Snackbar.LENGTH_SHORT).show();
                }
            }
        });

    }

    //    fungsi untuk memilih gambar dari galery
    private void selectImage() {
        Intent intent = new Intent();
        intent.setType("image/*");
        intent.setAction(intent.ACTION_GET_CONTENT);
        startActivityForResult(intent, IMG_REQUEST);
    }

    private void initWidgetId() {
        txtnama = findViewById(R.id.editnama);
        txtemail = findViewById(R.id.editemail);
        txtnohp = findViewById(R.id.editnohp);
        txtalamat = findViewById(R.id.editalamat);
        txttempatlahir = findViewById(R.id.edittempatlahir);
        txttgllahir = findViewById(R.id.edittgllahir);
        txtfoto = findViewById(R.id.editfoto);
        uploadfoto = findViewById(R.id.btnupload);
        simpanedit = findViewById(R.id.btnsimpanedit);
    }

    private boolean validateTextInput(EditText editText, String errorMessage) {
        String input = editText.getText().toString().trim();

        if (input.isEmpty()) {
            editText.setError(errorMessage);
            return false;
        } else {
            editText.setError(null);
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

    private void loadProfil(){
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
                    if (status.equals("false")){
                        String message = jsonObject.getString("message");
                        Snackbar.make(findViewById(R.id.editprofilactivity), message, Snackbar.LENGTH_LONG).show();
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

                        simpanedit.setEnabled(true);
                    }
                } catch (Exception e) {
                    Snackbar.make(findViewById(R.id.editprofilactivity), e.toString(), Snackbar.LENGTH_LONG).show();
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
                Snackbar.make(findViewById(R.id.editprofilactivity), message, Snackbar.LENGTH_LONG).show();
            }
        });
        queue.add(stringRequest);
    }

    private void updateProfil() {
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

                    Snackbar.make(findViewById(R.id.editprofilactivity), message, Snackbar.LENGTH_LONG).show();
                } catch (Exception e) {
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
                Snackbar.make(findViewById(R.id.editprofilactivity), message, Snackbar.LENGTH_LONG).show();
            }
        }) {
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                String fotonya = txtfoto.getText().toString().trim();

                if (fotonya.matches("")) {
                    params.put("kd_regist", mKdRegist);
                    params.put("name", txtnama.getText().toString().trim());
//                  params.put("image", imageToString(bitmapProfil));
                    params.put("alamat", txtalamat.getText().toString().trim());
                    params.put("no_hp", txtnohp.getText().toString().trim());

                    return params;
                } else {
                    params.put("kd_regist", mKdRegist);
                    params.put("name", txtnama.getText().toString().trim());
                    params.put("image", imageToString(bitmapProfil));
                    params.put("alamat", txtalamat.getText().toString().trim());
                    params.put("no_hp", txtnohp.getText().toString().trim());

                    return params;
                }
            }
        };
        queue.add(updateRequest);
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
                bitmapProfil = BitmapFactory.decodeStream(inputStream);

                txtfoto.setText(pathGambar);

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
            Intent abc = new Intent(EditProfilActivity.this, NavFragment.class);
            startActivity(abc);
        }

        this.doubleBackToExit = true;
        Snackbar.make(findViewById(R.id.editprofilactivity), "Tekan kembali sekali lagi untuk batalkan edit profil", Snackbar.LENGTH_LONG).show();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                doubleBackToExit=false;
            }
        }, 2000);
    }
}