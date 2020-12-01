package com.example.telekonsultasi.ui.profil;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.telekonsultasi.R;
import com.example.telekonsultasi.configfile.ServerApi;
import com.example.telekonsultasi.configfile.authdata;
import com.squareup.picasso.Picasso;

import de.hdodenhof.circleimageview.CircleImageView;

public class ProfilFragment extends Fragment {
    private String mFotoProfil;

    CircleImageView profile;
    TextView txtnama, txtno, txtemail;

    authdata authdataa;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activity_profil_fragment, container, false);
        //        return super.onCreateView(inflater, container, savedInstanceState);
        authdataa = new authdata(getContext());

        txtnama = v.findViewById(R.id.textnamanya);
        txtemail = v.findViewById(R.id.textemailnya);
        txtno = v.findViewById(R.id.textnomernya);

        mFotoProfil = ServerApi.URL_PASFOTO + authdataa.getFoto_user();

        profile = v.findViewById(R.id.FotoProfil);
        Picasso.get().load(mFotoProfil).into(profile);

        return v;
    }
}