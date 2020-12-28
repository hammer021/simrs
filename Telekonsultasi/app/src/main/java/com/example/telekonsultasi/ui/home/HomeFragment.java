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
import com.example.telekonsultasi.configfile.ServerApi;
import com.example.telekonsultasi.ui.periksa.PeriksaFragment;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.jar.JarException;

public class HomeFragment extends Fragment {
    ImageView notif;
    TextView pasiendas, keluhandas, obatdas;
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

        obatdas = v.findViewById(R.id.jmlobat);
        keluhandas = v.findViewById(R.id.jmlkeluhan);
        pasiendas = v.findViewById(R.id.jmlpasien);
        hitung_dashboard();
        return v;

    }
    public void hitung_dashboard() {
        final StringRequest jumlah = new StringRequest(Request.Method.GET, ServerApi.URL_DASHBOARD, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject a = new JSONObject(response);
                    boolean status = a.getBoolean("status");
                    if (status) {
                        JSONArray data = a.getJSONArray("data");
                        JSONObject param = data.getJSONObject(0);

                        String r = param.getString("jumlah_pasien");
                        String d = param.getString("jumlah_periksa_1");
                        String k = param.getString("jumlah_obat_1");

                        pasiendas.setText(r);
                        keluhandas.setText(d);
                        obatdas.setText(k);
                    } else {
                        Toast.makeText(getActivity(), "Tidak Ada Data", Toast.LENGTH_LONG).show();
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