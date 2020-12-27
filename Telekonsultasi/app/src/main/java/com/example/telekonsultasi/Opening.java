package com.example.telekonsultasi;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import com.example.telekonsultasi.configfile.authdata;
import com.google.android.material.snackbar.Snackbar;

public class Opening extends AppCompatActivity {

    Button regis;
    TextView login;
    authdata authdataa;
    boolean doubleBackToExit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_opening);

        regis = findViewById(R.id.btnregis);
        regis.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent a = new Intent(Opening.this, RegisterActivity.class);
                startActivity(a);
                finish();
            }
        });

        login = findViewById(R.id.txtlogin);
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent b = new Intent(Opening.this, LoginActivity.class);
                startActivity(b);
                finish();
            }
        });

        authdataa = new authdata(this);
        if (authdataa.isLogin() == true){
            Intent main = new Intent(Opening.this, NavFragment.class);
            startActivity(main);
            finish();
        }
    }

    @Override
    public void onBackPressed() {
        if (doubleBackToExit) {
            super.onBackPressed();
            return;
        }

        this.doubleBackToExit = true;
        Snackbar.make(findViewById(R.id.opening), "Tekan kembali sekali lagi untuk keluar", Snackbar.LENGTH_LONG).show();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                doubleBackToExit=false;
            }
        }, 2000);
    }
}