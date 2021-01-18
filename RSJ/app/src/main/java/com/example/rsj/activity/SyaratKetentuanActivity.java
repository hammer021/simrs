package com.example.rsj.activity;

import androidx.appcompat.app.AppCompatActivity;

import android.graphics.text.LineBreaker;
import android.os.Bundle;
import android.widget.TextView;

import com.example.rsj.R;

public class SyaratKetentuanActivity extends AppCompatActivity {
    TextView text1;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_syarat_ketentuan);
        text1 = findViewById(R.id.txt1);
    }
}