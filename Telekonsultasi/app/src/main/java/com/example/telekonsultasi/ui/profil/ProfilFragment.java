package com.example.telekonsultasi.ui.profil;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.telekonsultasi.EditPasswordActivity;
import com.example.telekonsultasi.EditProfilActivity;
import com.example.telekonsultasi.R;
import com.example.telekonsultasi.configfile.ServerApi;
import com.example.telekonsultasi.configfile.authdata;
import com.squareup.picasso.Picasso;

import de.hdodenhof.circleimageview.CircleImageView;

public class ProfilFragment extends Fragment {
    private String mFotoProfil;

    CircleImageView profile;
    TextView txtnama, txtidregis, txtedit, txtlogout, txtgantipw;

    authdata authdataa;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activity_profil_fragment, container, false);
        //        return super.onCreateView(inflater, container, savedInstanceState);
        authdataa = new authdata(getContext());

        txtidregis = v.findViewById(R.id.textidregist);
        txtidregis.setText(authdataa.getKodeUser());

        txtnama = v.findViewById(R.id.textnamanya);
        txtnama.setText(authdataa.getNamaUser());

        txtedit = v.findViewById(R.id.texteditprofil);
        txtedit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent edit = new Intent(getActivity(), EditProfilActivity.class);
                startActivity(edit);
            }
        });

        txtgantipw = v.findViewById(R.id.textgantipass);
        txtgantipw.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent pw = new Intent(getActivity(), EditPasswordActivity.class);
                startActivity(pw);
            }
        });

        txtlogout = v.findViewById(R.id.textlogout);
        txtlogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                authdataa.logout();
            }
        });

        mFotoProfil = ServerApi.URL_PASFOTO + authdataa.getFoto_user();

        profile = v.findViewById(R.id.FotoProfil);
        Picasso.get().load(mFotoProfil).into(profile);

        return v;
    }
}