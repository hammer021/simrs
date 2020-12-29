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
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.telekonsultasi.NotificationActivity;
import com.example.telekonsultasi.R;
import com.example.telekonsultasi.UploadResepActivity;
import com.example.telekonsultasi.configfile.ServerApi;
import com.example.telekonsultasi.configfile.authdata;
import com.example.telekonsultasi.ui.periksa.PeriksaFragment;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.jar.JarException;

public class HomeFragment extends Fragment {
    ImageView notif;
    ConstraintLayout keluhan, obat, lapkeluhan, lapobat;
    TextView txtpasien, txtkeluhan, txtobat;
    authdata authdataa;
    String mKdRegist;
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activty_home_fragment, container, false);
        authdataa = new authdata(getContext());
        mKdRegist = authdataa.getKodeUser();
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
//        lapkeluhan = v.findViewById(R.id.constrainglaporankeluhan);
//        lapobat = v.findViewById(R.id.constrainglaporanresep);

        txtpasien = v.findViewById(R.id.jmlpasien);
        txtkeluhan = v.findViewById(R.id.jmlkeluhan);
        txtobat = v.findViewById(R.id.jmlobat);

        hitungjumlah();

        return v;
    }

    public void hitungjumlah() {
        StringRequest jumlah = new StringRequest(Request.Method.GET, ServerApi.URL_DASHBOARD + mKdRegist, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject a = new JSONObject(response);
                    boolean status = a.getBoolean("status");
                    if (status) {
                        JSONArray data = a.getJSONArray("data");
                        JSONObject terakhir = data.getJSONObject(0);

                        String jumlah_pasien = terakhir.getString("jumlah_pasien");
                        String jumlah_periksa_1 = terakhir.getString("jumlah_periksa_1");
                        String jumlah_obat_1 = terakhir.getString("jumlah_obat_1");

                        txtpasien.setText(jumlah_pasien);
                        txtkeluhan.setText(jumlah_periksa_1);
                        txtobat.setText(jumlah_obat_1);
                    } else {
                        Toast.makeText(getActivity(), "Tidak ada data", Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(getActivity(), e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getActivity(), error.toString(), Toast.LENGTH_LONG).show();
            }
        });
        RequestQueue req = Volley.newRequestQueue(getContext());
        req.add(jumlah);
    }
}