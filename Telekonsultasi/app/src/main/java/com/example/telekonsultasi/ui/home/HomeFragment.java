package com.example.telekonsultasi.ui.home;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.constraintlayout.widget.ConstraintLayout;
import androidx.fragment.app.Fragment;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;

import com.example.telekonsultasi.NotificationActivity;
import com.example.telekonsultasi.R;
import com.example.telekonsultasi.ui.periksa.PeriksaFragment;

public class HomeFragment extends Fragment {
    ImageView notif;
    ConstraintLayout pasien, keluhan, obat;
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activty_home_fragment, container, false);
        //        return super.onCreateView(inflater, container, savedInstanceState);
        notif = v.findViewById(R.id.notifnyahome);
        notif.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent a = new Intent(getActivity(), NotificationActivity.class);
                startActivity(a);
            }
        });
        keluhan = v.findViewById(R.id.constraintLayoutkeluhan);
        keluhan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent c = new Intent(getActivity(), NotificationActivity.class);
                startActivity(c);
            }
        });
        obat = v.findViewById(R.id.constraintLayoutobat);
        obat.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent d = new Intent(getActivity(), NotificationActivity.class);
                startActivity(d);
            }
        });
        return v;
    }
}