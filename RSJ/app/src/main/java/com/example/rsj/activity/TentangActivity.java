package com.example.rsj.activity;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;

import com.example.rsj.R;

public class TentangActivity extends AppCompatActivity {
    ImageView imageView, imageView2, imageView3;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tentang);
        imageView = findViewById(R.id.imageFacebook);
        imageView2 = findViewById(R.id.imageTwitter);
        imageView3 = findViewById(R.id.imageInstagram);

        imageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent link = new Intent();
                link.setAction(Intent.ACTION_VIEW);
                link.addCategory(Intent.CATEGORY_BROWSABLE);
                link.setData(Uri.parse("https://www.facebook.com/RSJ-Dr-Radjiman-Wediodiningrat-Lawang-419340534925514"));
                startActivity(link);
            }
        });

        imageView2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent link = new Intent();
                link.setAction(Intent.ACTION_VIEW);
                link.addCategory(Intent.CATEGORY_BROWSABLE);
                link.setData(Uri.parse("https://twitter.com/RSJ_Lawang"));
                startActivity(link);
            }
        });

        imageView3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent link = new Intent();
                link.setAction(Intent.ACTION_VIEW);
                link.addCategory(Intent.CATEGORY_BROWSABLE);
                link.setData(Uri.parse("https://www.instagram.com/rsjlawang/"));
                startActivity(link);
            }
        });
    }
}