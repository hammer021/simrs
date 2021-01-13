package com.example.rsj;

import android.content.Intent;
import android.os.Bundle;
import android.view.WindowManager;

import androidx.appcompat.app.ActionBar;

import com.daimajia.androidanimations.library.Techniques;
import com.example.rsj.activity.LoginActivity;
import com.viksaa.sssplash.lib.activity.AwesomeSplash;
import com.viksaa.sssplash.lib.cnst.Flags;
import com.viksaa.sssplash.lib.model.ConfigSplash;

public class SplashScreen extends AwesomeSplash {
    @Override
    public void initSplash(ConfigSplash configSplash) {
        ActionBar actionBar = getSupportActionBar();
        actionBar.hide();
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);

        //menambahkan background
        configSplash.setBackgroundColor(R.color.bg_splash);
        configSplash.setAnimCircularRevealDuration(3000);
        configSplash.setRevealFlagX(Flags.REVEAL_LEFT);
        configSplash.setRevealFlagX(Flags.REVEAL_BOTTOM);

        //menambahkan logo
        configSplash.setLogoSplash(R.drawable.logo);
        configSplash.setAnimLogoSplashDuration(1500);
        configSplash.setAnimTitleTechnique(Techniques.FadeIn);

        //menambahkan tittle
        configSplash.setTitleSplash("RSJ LAWANG");
        configSplash.setTitleTextColor(R.color.splash_title);
        configSplash.setTitleTextSize(15f);
        configSplash.setAnimTitleDuration(3000);
        configSplash.setAnimTitleTechnique(Techniques.FadeIn);
    }

    @Override
    public void animationsFinished() {
        startActivity(new Intent(SplashScreen.this, LoginActivity.class));
        finish();
    }
}