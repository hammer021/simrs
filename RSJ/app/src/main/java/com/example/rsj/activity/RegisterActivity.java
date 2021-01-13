package com.example.rsj.activity;

import androidx.appcompat.app.AppCompatActivity;

import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.text.InputType;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.DatePicker;
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
import com.example.rsj.R;
import com.example.rsj.configfile.ServerApi;
import com.google.android.material.textfield.TextInputEditText;
import com.google.android.material.textfield.TextInputLayout;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.Calendar;
import java.util.HashMap;
import java.util.Map;

public class RegisterActivity extends AppCompatActivity {
    TextInputLayout edtNama, edtEmail, edtNotelepon, edtAlamat, edtTempatlahir, edtPassword, txtTgllahir;
    TextInputEditText edtTgllahir;
    Button btnDaftar, btnDaftarOff;
    TextView edtLogin, edtTerms;
    ProgressDialog progressDialog;
    RequestQueue requestQueue;
    ProgressBar progressBar;
    CheckBox checkBox;

    final Calendar c = Calendar.getInstance();
    int mYear = c.get(Calendar.YEAR);
    int mMonth = c.get(Calendar.MONTH);
    int mDay = c.get(Calendar.DAY_OF_MONTH);
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        requestQueue = Volley.newRequestQueue(RegisterActivity.this);
        progressDialog = new ProgressDialog(this);
        progressBar = new ProgressBar(RegisterActivity.this);

        edtNama = findViewById(R.id.text_nama_daftar);
        edtEmail = findViewById(R.id.text_email_daftar);
        edtNotelepon = findViewById(R.id.text_telepon_daftar);
        edtAlamat = findViewById(R.id.text_alamat_daftar);
        edtTempatlahir = findViewById(R.id.text_tempatlahir_daftar);
        edtTgllahir = findViewById(R.id.tanggallahir_daftar);
        txtTgllahir = findViewById(R.id.text_tanggallahir_daftar);
        edtPassword = findViewById(R.id.text_password_daftar);
        btnDaftar = findViewById(R.id.btn_daftar);
        btnDaftarOff = findViewById(R.id.btn_daftar_off);
        edtLogin = findViewById(R.id.text_login_daftar);
        checkBox = findViewById(R.id.checkterms_daftar);
        edtTerms = findViewById(R.id.txtterms_daftar);

        edtTerms.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent syarat = new Intent(RegisterActivity.this, SyaratKetentuanActivity.class);
                startActivity(syarat);
            }
        });

        edtLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent goLogin = new Intent(RegisterActivity.this, LoginActivity.class);
                startActivity(goLogin);
            }
        });

        edtTgllahir.setInputType(InputType.TYPE_NULL);
        edtTgllahir.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                DatePickerDialog datePickerDialog = new DatePickerDialog(RegisterActivity.this,
                        new DatePickerDialog.OnDateSetListener() {
                            @Override
                            public void onDateSet(DatePicker view, int year,
                                                  int monthOfYear, int dayOfMonth) {

                                edtTgllahir.setText(year + "-" + (monthOfYear + 1) + "-" + dayOfMonth);

                            }
                        }, mYear, mMonth, mDay);
                datePickerDialog.show();
            }
        });

        btnDaftar.setVisibility(View.GONE);

        btnDaftarOff.setVisibility(View.VISIBLE);
        btnDaftarOff.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(RegisterActivity.this, "Silahkan setujui syarat dan ketentuan", Toast.LENGTH_SHORT).show();
            }
        });

        checkBox.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (checkBox.isChecked()) {
                    btnDaftar.setVisibility(View.VISIBLE);
                    btnDaftarOff.setVisibility(View.GONE);
                } else {
                    btnDaftar.setVisibility(View.GONE);
                    btnDaftarOff.setVisibility(View.VISIBLE);
                }
            }
        });

        btnDaftar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (checkBox.isChecked()) {
                    btnDaftar.setVisibility(View.VISIBLE);
                    UserRegistration();
                    btnDaftarOff.setVisibility(View.GONE);

                } else {
                    btnDaftar.setVisibility(View.GONE);
                    btnDaftarOff.setVisibility(View.VISIBLE);
                }
            }
        });
    }

    public void UserRegistration() {
        final String name = this.edtNama.getEditText().getText().toString().trim();
        final String email = this.edtEmail.getEditText().getText().toString().trim();
        final String alamat = this.edtAlamat.getEditText().getText().toString().trim();
        final String tgl_lahir = this.txtTgllahir.getEditText().getText().toString().trim();
        final String tempat_lahir = this.edtTempatlahir.getEditText().getText().toString().trim();
        final String no_telp = this.edtNotelepon.getEditText().getText().toString().trim();
        final String password = this.edtPassword.getEditText().getText().toString().trim();

        if (name.matches("")){
            Toast.makeText(this, "Masukkan Nama Lengkap Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (email.matches("")){
            Toast.makeText(this, "Masukkan Email Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (alamat.matches("")){
            Toast.makeText(this, "Masukkan Alamat Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (tgl_lahir.matches("")){
            Toast.makeText(this, "Masukkan Tanggal Lahir Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (tempat_lahir.matches("")){
            Toast.makeText(this, "Masukkan Tempat Lahir Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (no_telp.matches("")){
            Toast.makeText(this, "Masukkan No Telpon Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (password.matches("")){
            Toast.makeText(this, "Masukkan Password Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (password.length() < 6){
            edtPassword.setError("Password minimal tediri dari 6 karakter");
            return;
        } else {
            edtPassword.setError("");
        }

        progressDialog.setMessage("Loading");
        progressDialog.show();
        progressBar.setVisibility(View.GONE);
        edtLogin.setVisibility(View.GONE);

        StringRequest stringRequest = new StringRequest(Request.Method.POST, ServerApi.URL_REGIS, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String status = jsonObject.getString("status");
                    String error = jsonObject.getString("error");
                    String message = jsonObject.getString("message");

                    if (status.equals("200")&&error.equals("false")){
                        Toast.makeText(RegisterActivity.this, message, Toast.LENGTH_SHORT).show();
                        new Handler().postDelayed(new Runnable() {
                            @Override
                            public void run() {
                                Intent intent2 = new Intent(RegisterActivity.this, LoginActivity.class);
                                startActivity(intent2);
                                finish();
                            }
                        }, 1500);
                    } else {
                        Toast.makeText(RegisterActivity.this, message, Toast.LENGTH_SHORT).show();
                        progressBar.setVisibility(View.GONE);
                        edtLogin.setVisibility(View.VISIBLE);
                    }
                } catch (JSONException e) {
                    progressDialog.dismiss();
                    e.printStackTrace();
                    progressBar.setVisibility(View.GONE);
                    Intent intent3 = new Intent(RegisterActivity.this, LoginActivity.class);
                    startActivity(intent3);
                    Toast.makeText(RegisterActivity.this, "Registrasi Berhasil, silahkan Aktivasi email anda!", Toast.LENGTH_SHORT).show();
                    finish();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                Toast.makeText(RegisterActivity.this, error.toString(), Toast.LENGTH_SHORT).show();
//                        Toast.makeText(RegisterActivity.this, "Silahkan masukkan data dengan benar dan sesuai Format yang sudah di tentukan!", Toast.LENGTH_SHORT).show();
                progressBar.setVisibility(View.GONE);
                edtLogin.setVisibility(View.VISIBLE);
            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("name", name);
                params.put("email", email);
                params.put("password", password);
                params.put("alamat", alamat);
                params.put("no_hp", no_telp);
                params.put("tgl_lahir", tgl_lahir);
                params.put("tempat_lahir", tempat_lahir);
                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
}