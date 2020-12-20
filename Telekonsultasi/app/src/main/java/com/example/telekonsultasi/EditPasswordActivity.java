package com.example.telekonsultasi;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
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
import com.google.android.material.textfield.TextInputEditText;
import com.google.android.material.textfield.TextInputLayout;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class EditPasswordActivity extends AppCompatActivity {
    TextInputLayout pswlama, pswbaru, pswbaru2;
    Button btnsimpanpsw;
    TextInputEditText edtpasswordlama;

    boolean doubleBackToExit;

    ProgressDialog progressDialog;
    RequestQueue requestQueue;
    ProgressBar progressBar;
    authdata authdataa;

    String mKdRegist;
    String mPasswordlama;
    String mPasswordbaru;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_password);

        requestQueue = Volley.newRequestQueue(EditPasswordActivity.this);
        progressDialog = new ProgressDialog(EditPasswordActivity.this);
        progressBar = new ProgressBar(EditPasswordActivity.this);
        authdataa = new authdata(EditPasswordActivity.this);

        pswlama = findViewById(R.id.passwordlamaLayout);
        pswbaru = findViewById(R.id.passwordbaruLayout);
        pswbaru2 = findViewById(R.id.passwordbaru2Layout);
        edtpasswordlama = findViewById(R.id.edtpasswordlama);

        mKdRegist = authdataa.getKodeUser();

        btnsimpanpsw = findViewById(R.id.btnsimpanpassword);
        btnsimpanpsw.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(validatePasswordLama() & validatePasswordBaru() & validateConfirmPassword() & validateEqualPassword()){
                    mPasswordlama = pswlama.getEditText().getText().toString().trim();
                    mPasswordbaru = pswbaru2.getEditText().getText().toString().trim();
                    updatePassword();
                }
            }
        });
    }

    private boolean validatePasswordLama() {
        String password_lama = pswlama.getEditText().getText().toString().trim();

        if (password_lama.isEmpty()) {
            pswlama.setError("Password lama tidak boleh kosong!");
            return false;
        } else {
            pswlama.setError(null);
            mPasswordlama = password_lama;
            return true;
        }
    }

    private boolean validatePasswordBaru() {
        String password_baru = pswbaru.getEditText().getText().toString().trim();

        if (password_baru.isEmpty()) {
            pswbaru.setError("Password baru tidak boleh kosong!");
            return false;
        } else {
            pswbaru.setError(null);
            return true;
        }
    }

    private boolean validateConfirmPassword() {
        String password_baru_again = pswbaru2.getEditText().getText().toString().trim();

        if (password_baru_again.isEmpty()) {
            pswbaru2.setError("Password baru tidak boleh kosong!");
            return false;
        } else {
            pswbaru2.setError(null);
            mPasswordbaru = password_baru_again;
            return true;
        }
    }

    private boolean validateEqualPassword() {
        String password_baru = pswbaru.getEditText().getText().toString().trim();
        String password_baru_again = pswbaru2.getEditText().getText().toString().trim();

        if (!password_baru.equals(password_baru_again)) {
            pswbaru2.setError("Konfirmasi password tidak sama!");
            return false;
        } else {
            pswbaru2.setError(null);
            mPasswordbaru = password_baru_again;
            return true;
        }
    }


    private void updatePassword(){
        progressDialog.setMessage("Sedang Memperbarui Data...");
        progressDialog.setCancelable(false);
        progressDialog.show();

        String url = ServerApi.URL_PUT_PASSWORD;
        StringRequest stringRequestt = new StringRequest(Request.Method.PUT, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                progressDialog.dismiss();
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String message = jsonObject.getString("message");

                    Snackbar.make(findViewById(R.id.editpasswordactivity), message, Snackbar.LENGTH_LONG).show();
                } catch (JSONException e) {
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
                Snackbar.make(findViewById(R.id.editpasswordactivity), message, Snackbar.LENGTH_LONG).show();
            }
        }) {
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("kd_regist", mKdRegist);
                params.put("password", mPasswordbaru);

                return params;
            }
        };
        requestQueue.add(stringRequestt);
    }

    @Override
    public void onBackPressed() {
        if (doubleBackToExit) {
            Intent abc = new Intent(EditPasswordActivity.this, NavFragment.class);
            startActivity(abc);
        }

        this.doubleBackToExit = true;
        Snackbar.make(findViewById(R.id.editpasswordactivity), "Tekan kembali sekali lagi untuk batalkan edit password", Snackbar.LENGTH_LONG).show();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                doubleBackToExit=false;
            }
        }, 2000);
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

//    private void loadPassword(){
//        progressDialog.setMessage("Sedang Memperbarui Data...");
//        progressDialog.setCancelable(false);
//        progressDialog.show();
//
//        String url = ServerApi.URL_USER + mKdRegist;
//        StringRequest stringRequest = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
//            @Override
//            public void onResponse(String response) {
//                progressDialog.dismiss();
//                try {
//                    JSONObject jsonObject = new JSONObject(response);
//                    String status = jsonObject.getString("status");
//                    if (status.equals("false")) {
//                        String message = jsonObject.getString("message");
//                        Snackbar.make(findViewById(R.id.editpasswordactivity), message, Snackbar.LENGTH_LONG).show();
//                    } else {
//                        JSONArray data = jsonObject.getJSONArray("data");
//                        JSONObject dataUser = data.getJSONObject(0);
//
//                        mEdtPasswordLama = dataUser.getString("password");
//
//                        edtpasswordlama.setText(mEdtPasswordLama);
//                    }
//                } catch (JSONException e) {
//                    Snackbar.make(findViewById(R.id.editpasswordactivity), e.toString(), Snackbar.LENGTH_LONG).show();
//                }
//            }
//        }, new Response.ErrorListener() {
//            @Override
//            public void onErrorResponse(VolleyError error) {
//                progressDialog.dismiss();
//                String message = "Terjadi error. Coba beberapa saat lagi.";
//                if (error instanceof NetworkError){
//                    message = "Tidak dapat terhubung ke internet. Harap periksa koneksi anda.";
//                } else if (error instanceof AuthFailureError) {
//                    message = "Gagal login. Harap periksa email dan password anda.";
//                } else if (error instanceof ClientError) {
//                    message = "Gagal login. Harap periksa email dan password anda.";
//                } else if (error instanceof NoConnectionError) {
//                    message = "Tidak ada koneksi internet. Harap periksa koneksi anda.";
//                } else if (error instanceof TimeoutError) {
//                    message = "Connection Time Out. Harap periksa koneksi anda.";
//                }
//                Snackbar.make(findViewById(R.id.editpasswordactivity), message, Snackbar.LENGTH_LONG).show();
//            }
//        });
//        requestQueue.add(stringRequest);
//    }

}