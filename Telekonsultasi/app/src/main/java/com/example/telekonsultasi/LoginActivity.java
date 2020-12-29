package com.example.telekonsultasi;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
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
import com.example.telekonsultasi.configfile.ServerApi;
import com.example.telekonsultasi.configfile.authdata;
import com.google.android.material.textfield.TextInputEditText;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class LoginActivity extends AppCompatActivity {
    Button btnlogin;
    TextInputEditText edtEmail, edtPassword;
    TextView textregis;
    ProgressBar PrgsBar;
    ProgressDialog progressDialog;
    authdata authdataa;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        authdataa = new authdata(this);

        progressDialog = new ProgressDialog(this);
        PrgsBar = new ProgressBar(LoginActivity.this);
        PrgsBar.setVisibility(View.GONE);

        edtEmail = findViewById(R.id.edtemaillogin);
        edtPassword = findViewById(R.id.edtpasswordlogin);

        textregis = findViewById(R.id.txtregis);
        textregis.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent gis = new Intent(LoginActivity.this, RegisterActivity.class);
                startActivity(gis);
            }
        });

        btnlogin = findViewById(R.id.btnlogin);
        btnlogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (edtEmail.getText().toString().isEmpty()) {
                    Toast.makeText(LoginActivity.this, "Email Tidak Boleh Kosong", Toast.LENGTH_LONG).show();
                    progressDialog.dismiss();
                } else if (edtPassword.getText().toString().isEmpty()) {
                    Toast.makeText(LoginActivity.this, "Password Tidak Boleh Kosong", Toast.LENGTH_LONG).show();
                    progressDialog.dismiss();
                } else {
                    login();
                }
            }
        });

        if (authdataa.isLogin() == true) {
            Intent main = new Intent(LoginActivity.this, NavFragment.class);
            startActivity(main);
            finish();
        }
    }

    public void login() {
        StringRequest senddata = new StringRequest(Request.Method.POST, ServerApi.URL_LOGIN, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    progressDialog.dismiss();
                    JSONObject res = new JSONObject(response);

                    JSONObject respon = res.getJSONObject("data");
//                    Toast.makeText(LoginActivity.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();
                    JSONObject datalogin = res.getJSONObject("data");
                    Log.e("ser", datalogin.getString("token"));

                    if (datalogin.getString("kd_role").equals("3")) {
                        if (datalogin.getString("is_active").equals("1")) {
                            authdataa.setdatauser(
                                    datalogin.getString("kd_regist"),
                                    datalogin.getString("name"),
                                    datalogin.getString("email"),
                                    datalogin.getString("alamat"),
                                    datalogin.getString("no_hp"),
                                    datalogin.getString("token"),
                                    datalogin.getString("is_active"),
                                    datalogin.getString("image")
                            );

                            Intent intent = new Intent(LoginActivity.this, NavFragment.class);
                            Toast.makeText(LoginActivity.this, "Selamat Datang", Toast.LENGTH_SHORT).show();
                            startActivity(intent);
                            finish();
                        } else {
                            Toast.makeText(LoginActivity.this, "Mohon Aktifkan Email Verifikasi Anda", Toast.LENGTH_SHORT).show();
//                            Toast.makeText(LoginActivity.this, "Aplikasi Hanya Untuk User . Silahkan Login Via Website Simrs Telemedicine" , Toast.LENGTH_SHORT).show();
                        }
                    } else {
//                        Toast.makeText(LoginActivity.this,"Mohon Aktifkan Email Verifikasi Anda", Toast.LENGTH_SHORT).show();
                        Toast.makeText(LoginActivity.this, "Aplikasi Hanya Untuk User . Silahkan Login Via Website Simrs Telemedicine", Toast.LENGTH_SHORT).show();
                    }
                } catch (JSONException e) {
                    progressDialog.dismiss();
                    Log.e("errorgan", e.getMessage());
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                Toast.makeText(LoginActivity.this, "Email dan Password yang anda masukkan salah !", Toast.LENGTH_SHORT).show();
            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("email", edtEmail.getText().toString());
                params.put("password", edtPassword.getText().toString());
//                params.put("password", edtPassword.getText().toString());
                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(LoginActivity.this);
        requestQueue.add(senddata);
    }
}