package com.example.telekonsultasi;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import com.example.telekonsultasi.configfile.authdata;

public class Opening extends AppCompatActivity {

    Button regis;
    TextView login;
    authdata authdataa;
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
            }
        });

        login = findViewById(R.id.txtlogin);
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent b = new Intent(Opening.this, LoginActivity.class);
                startActivity(b);
            }
        });

        authdataa = new authdata(this);
        if (authdataa.isLogin() == true){
            Intent main = new Intent(Opening.this, NavFragment.class);
            startActivity(main);
            finish();
        }
    }
}