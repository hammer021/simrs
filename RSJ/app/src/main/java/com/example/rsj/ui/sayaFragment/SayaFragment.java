package com.example.rsj.ui.sayaFragment;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;
import androidx.fragment.app.Fragment;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.rsj.R;
import com.example.rsj.activity.EditPasswordActivity;
import com.example.rsj.activity.EditProfilActivity;
import com.example.rsj.activity.TentangActivity;
import com.example.rsj.configfile.ServerApi;
import com.example.rsj.configfile.authdata;
import com.squareup.picasso.Picasso;

import org.w3c.dom.Text;

import de.hdodenhof.circleimageview.CircleImageView;

public class SayaFragment extends Fragment {
    CircleImageView circleImageView;
    private String mFotoProfil;
    CardView cardEditProfil, cardTentang, cardEditPassword, cardLogout;
    TextView nama, kd;

    authdata authdataa;
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activity_saya_fragment, container, false);
        authdataa = new authdata(getContext());

        circleImageView = v.findViewById(R.id.fotosaya);
        nama = v.findViewById(R.id.namasaya);
        kd = v.findViewById(R.id.kodesaya);

        nama.setText(authdataa.getNamaUser());
        kd.setText(authdataa.getKodeUser());

        cardEditProfil = v.findViewById(R.id.cardEditProfil);
        cardTentang = v.findViewById(R.id.cardTentang);
        cardEditPassword = v.findViewById(R.id.cardEditPassword);
        cardLogout = v.findViewById(R.id.cardLogout);

        mFotoProfil = ServerApi.URL_PASFOTO + authdataa.getFoto_user();
        Picasso.get().load(mFotoProfil).into(circleImageView);

        cardEditProfil.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent a = new Intent(getActivity(), EditProfilActivity.class);
                startActivity(a);
            }
        });

        cardTentang.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent b = new Intent(getActivity(), TentangActivity.class);
                startActivity(b);
            }
        });

        cardEditPassword.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent C = new Intent(getActivity(), EditPasswordActivity.class);
                startActivity(C);
            }
        });

        cardLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                authdataa.logout();
            }
        });
        return v;
    }
}