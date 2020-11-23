package com.example.telekonsultasi;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

public class RegisterActivity extends AppCompatActivity {
    EditText mFullname, mEmail, mNomor, mPassword;
    Button mRegisbtn;
    TextView tLogin;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        mFullname = findViewById(R.id.edtname);
        mEmail = findViewById(R.id.edtemail);
        mNomor = findViewById(R.id.edtnohp);
        mPassword = findViewById(R.id.edtpassword);
        mRegisbtn = findViewById(R.id.btnregister);
        mRegisbtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

            }
        });
    }
}