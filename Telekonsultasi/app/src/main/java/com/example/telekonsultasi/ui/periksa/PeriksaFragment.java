package com.example.telekonsultasi.ui.periksa;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.telekonsultasi.KeluhanActivity;
import com.example.telekonsultasi.NotificationActivity;
import com.example.telekonsultasi.PeriksaLagiActivity;
import com.example.telekonsultasi.R;
import com.example.telekonsultasi.UploadPeriksaActivity;
import com.example.telekonsultasi.adapter.AdapterPemeriksaan;
import com.example.telekonsultasi.adapter.AdapterPeriksa;
import com.example.telekonsultasi.configfile.ServerApi;
import com.example.telekonsultasi.configfile.authdata;
import com.example.telekonsultasi.model.ModalPemeriksaan;
import com.example.telekonsultasi.model.ModalPeriksa;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class PeriksaFragment extends Fragment {
    RecyclerView recyclerViewPemeriksaan;
    List<ModalPemeriksaan> item;
    AdapterPemeriksaan adapterPemeriksaan;

    RequestQueue queue;

    Button periksa;
    authdata authdataa;

    String kode;

    ImageView notif;


    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activity_periksa_fragment, container, false);
        //        return super.onCreateView(inflater, container, savedInstanceState);
        authdataa = new authdata(getContext());
        queue = Volley.newRequestQueue(getContext());

        recyclerViewPemeriksaan = v.findViewById(R.id.recylerpemeriksaan);

        kode = authdataa.getKodeUser();

        loadPasien();

        periksa = v.findViewById(R.id.btnperiksalagi);
        periksa.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(getActivity(), KeluhanActivity.class);
//                i.putExtra("kd_regist", authdataa.getKodeUser());
                startActivity(i);
            }
        });

        notif = v.findViewById(R.id.notifnyaperiksa);
        notif.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent a = new Intent(getActivity(), NotificationActivity.class);
                startActivity(a);
            }
        });

        return v;
    }

    private void loadPasien() {
        StringRequest stringRequest = new StringRequest(Request.Method.GET, ServerApi.URL_GETPASIEN + kode, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    JSONArray data = jsonObject.getJSONArray("data");

                    item = new ArrayList<>();
                    for (int i = 0; i < data.length(); i++)
                    {
                        ModalPemeriksaan modalPemeriksaan = new ModalPemeriksaan();
                        JSONObject datanya = data.getJSONObject(i);
                        modalPemeriksaan.setNama_pasien(datanya.getString("nama_pasien"));
                        modalPemeriksaan.setNo_rm(datanya.getString("no_rm"));
                        modalPemeriksaan.setTgl_kunjungan(datanya.getString("tgl_kunjungan"));

                        item.add(modalPemeriksaan);
                    }
                    adapterPemeriksaan = new AdapterPemeriksaan(getActivity(), item);
                    RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getActivity());
                    recyclerViewPemeriksaan.setLayoutManager(layoutManager);
                    recyclerViewPemeriksaan.setAdapter(adapterPemeriksaan);

                    adapterPemeriksaan.setListener(new AdapterPeriksa.OnHistoryClickListener() {
                        @Override
                        public void onClick(int position) {
                            ModalPemeriksaan modalPemeriksaan = item.get(position);
                            Toast.makeText(getActivity(), modalPemeriksaan.getNo_rm(), Toast.LENGTH_LONG).show();
//                if (modalPeriksa.getStatus() == "1") {
                            Intent detail = new Intent(getActivity(), PeriksaLagiActivity.class);
                            detail.putExtra("no_rm", modalPemeriksaan.getNo_rm());
                            startActivity(detail);
//                }
                        }
                    });

                } catch (JSONException e) {
                    Toast.makeText(getActivity(), e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

            }
        });
        queue.add(stringRequest);
    }
}