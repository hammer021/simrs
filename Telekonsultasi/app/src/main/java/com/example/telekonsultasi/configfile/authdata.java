package com.example.telekonsultasi.configfile;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;

import com.example.telekonsultasi.LoginActivity;
import com.example.telekonsultasi.NavFragment;

public class authdata {
    //    private static authdata mInstance;
    SharedPreferences sharedPreferences;
    public Context mCtx;

    public static final String SHARED_PREF_NAME = "telekonsul";
    private static final String sudahlogin = "n";
    public SharedPreferences.Editor editor;

    private static final String kode_user = "kd_regist";
    private static final String nama_user = "name";
    private static final String email_user = "email";
    private static final String alamat_user = "alamat";
    private static final String no_user = "no_hp";
    private static final String akses_data = "akses_data";
    private static final String foto_user = "image";
    private static final String status_user = "is_active";
    private static final String token = "token";
    public static final String LOGIN_STATUS = "LOGIN_STATUS";


    public authdata(Context context) {
        this.mCtx = context;
        sharedPreferences = context.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        editor = sharedPreferences.edit();
    }

    public void setdatauser(String xkode_user, String xnama_user, String xemail_user, String xalamat_user, String xno_user, String xstatus, String tokennya, String xfoto) {
//        sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
//        editor = sharedPreferences.edit();

        editor.putBoolean(LOGIN_STATUS, true);
        editor.putString(kode_user, xkode_user);
        editor.putString(nama_user, xnama_user);
        editor.putString(email_user, xemail_user);
        editor.putString(alamat_user, xalamat_user);
        editor.putString(no_user, xno_user);
        editor.putString(status_user, xstatus);
        editor.putString(sudahlogin, "y");
        editor.putString(token, tokennya);
        editor.putString(foto_user, xfoto);
        editor.apply();
    }


    public boolean isLogin() {
        return sharedPreferences.getBoolean(LOGIN_STATUS, false);
    }

    public void logout() {
        editor.clear();
        editor.commit();

        Intent login = new Intent(mCtx, LoginActivity.class);
        mCtx.startActivity(login);
        ((NavFragment) mCtx).finish();
    }

    public String getToken() {
        return sharedPreferences.getString(token, null);
    }

    public String getAksesData() {
        return sharedPreferences.getString(akses_data, null);
    }

    public String getKodeUser() {
        return sharedPreferences.getString(kode_user, null);
    }

    public String getNamaUser() {
        return sharedPreferences.getString(nama_user, null);
    }

    public String getEmail_user() {
        return sharedPreferences.getString(email_user, null);
    }

    public String getAlamat_user() {
        return sharedPreferences.getString(alamat_user, null);
    }

    public String getNo_user() {
        return sharedPreferences.getString(no_user, null);
    }

    public String getFoto_user() {
        return sharedPreferences.getString(foto_user, null);
    }

    public void setNamaUser(String nama) {
        editor.putString(nama_user, nama);
        editor.apply();
    }

    public void setFotoUser(String foto) {
        editor.putString(foto_user, foto);
        editor.apply();
    }

}
