package com.example.telekonsultasi;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.text.InputType;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.telekonsultasi.configfile.ServerApi;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.Calendar;
import java.util.HashMap;
import java.util.Map;

public class RegisterActivity extends AppCompatActivity {
    EditText mFullname, mEmail, mNomor, mAlamat, mTmpLahir, mTglLahir, mPassword;
    Button mRegisbtn, btnmati;
    TextView tLogin;
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

        mFullname = findViewById(R.id.edtname);
        mEmail = findViewById(R.id.edtemail);
        mNomor = findViewById(R.id.edtnohp);
        mAlamat = findViewById(R.id.edtalamat);
        mTmpLahir = findViewById(R.id.edttempatlahir);
        mTglLahir = findViewById(R.id.edttgllahir);
        mPassword = findViewById(R.id.edtpassword);
        checkBox = findViewById(R.id.checkterms);
        mRegisbtn = findViewById(R.id.btnregister);
        btnmati = findViewById(R.id.btnregistermati);

        mTglLahir.setInputType(InputType.TYPE_NULL);
        mTglLahir.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                DatePickerDialog datePickerDialog = new DatePickerDialog(RegisterActivity.this,
                        new DatePickerDialog.OnDateSetListener() {
                            @Override
                            public void onDateSet(DatePicker view, int year,
                                                  int monthOfYear, int dayOfMonth) {

                                mTglLahir.setText(year + "-" + (monthOfYear + 1) + "-" + dayOfMonth);

                            }
                        }, mYear, mMonth, mDay);
                datePickerDialog.show();
            }
        });

        tLogin = findViewById(R.id.txtlogin);
        tLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent z = new Intent(RegisterActivity.this, LoginActivity.class);
                startActivity(z);
            }
        });

        mRegisbtn.setVisibility(View.GONE);

        btnmati.setVisibility(View.VISIBLE);
        btnmati.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(RegisterActivity.this, "Silahkan setujui syarat dan ketentuan", Toast.LENGTH_SHORT).show();
            }
        });

        checkBox.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (checkBox.isChecked()) {
                    mRegisbtn.setVisibility(View.VISIBLE);
                    btnmati.setVisibility(View.GONE);
                } else {
                    mRegisbtn.setVisibility(View.GONE);
                    btnmati.setVisibility(View.VISIBLE);
                }
            }
        });

        mRegisbtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (checkBox.isChecked()) {
                    mRegisbtn.setVisibility(View.VISIBLE);
                    UserRegistration();
                    btnmati.setVisibility(View.GONE);

                } else {
                    mRegisbtn.setVisibility(View.GONE);
                    btnmati.setVisibility(View.VISIBLE);
                }
            }
        });
    }

    public void UserRegistration(){
        final String name = this.mFullname.getText().toString().trim();
        final String email = this.mEmail.getText().toString().trim();
        final String password = this.mPassword.getText().toString().trim();
        final String alamat = this.mAlamat.getText().toString().trim();
        final String no_hp = this.mNomor.getText().toString().trim();
        final String tgl_lahir = this.mTglLahir.getText().toString().trim();
        final String tempat_lahir = this.mTmpLahir.getText().toString().trim();

        if (name.matches("")){
            Toast.makeText(this, "Masukkan Nama Lengkap Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (email.matches("")){
            Toast.makeText(this, "Masukkan Email Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (password.matches("")){
            Toast.makeText(this, "Masukkan Password Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (alamat.matches("")){
            Toast.makeText(this, "Masukkan Alamat Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (no_hp.matches("")){
            Toast.makeText(this, "Masukkan No Telpon Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (tgl_lahir.matches("")){
            Toast.makeText(this, "Masukkan No Telpon Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (tempat_lahir.matches("")){
            Toast.makeText(this, "Masukkan No Telpon Anda", Toast.LENGTH_SHORT).show();
            return;
        }

        progressDialog.setMessage("Loading");
        progressDialog.show();
        progressBar.setVisibility(View.GONE);
        tLogin.setVisibility(View.GONE);

        StringRequest stringRequest = new StringRequest(Request.Method.POST, ServerApi.URL_REGIS,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        progressDialog.dismiss();
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
                                tLogin.setVisibility(View.VISIBLE);
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
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        progressDialog.dismiss();
                        Toast.makeText(RegisterActivity.this, error.toString(), Toast.LENGTH_SHORT).show();
//                        Toast.makeText(RegisterActivity.this, "Silahkan masukkan data dengan benar dan sesuai Format yang sudah di tentukan!", Toast.LENGTH_SHORT).show();
                        progressBar.setVisibility(View.GONE);
                        tLogin.setVisibility(View.VISIBLE);
                    }
                })
        {
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();
                params.put("name", name);
                params.put("email", email);
                params.put("password", password);
                params.put("alamat", alamat);
                params.put("no_hp", no_hp);
                params.put("tgl_lahir", tgl_lahir);
                params.put("tempat_lahir", tempat_lahir);
                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
}