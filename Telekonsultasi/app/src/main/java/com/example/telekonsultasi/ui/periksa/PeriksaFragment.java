package com.example.telekonsultasi.ui.periksa;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.example.telekonsultasi.KeluhanActivity;
import com.example.telekonsultasi.R;
import com.example.telekonsultasi.configfile.authdata;

public class PeriksaFragment extends Fragment {
    Button periksa;
    authdata authdataa;
    TextView kode;

    private String kdregistnya = "NAMA";
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activity_periksa_fragment, container, false);
        //        return super.onCreateView(inflater, container, savedInstanceState);
        authdataa = new authdata(getContext());

        kode = v.findViewById(R.id.kdregisttt);
        kode.setText(authdataa.getKodeUser());

        periksa = v.findViewById(R.id.btnperiksalagi);
        periksa.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                try{
                    String nama = kode.getText().toString();
                    if (nama != null && nama != ""){
                        Intent i = new Intent(getActivity(), KeluhanActivity.class);
                        i.putExtra(kdregistnya, nama);
                        startActivity(i);

                    } else {
                        Toast.makeText(getActivity(), "YOU NEED TO FILL YOUR ID",Toast.LENGTH_SHORT);
                    }

                } catch (Exception e){
                    e.printStackTrace();
                    Toast.makeText(getActivity(), "ERROR, TRY AGAIN !",Toast.LENGTH_SHORT);
                }
            }
        });


        return v;
    }
}