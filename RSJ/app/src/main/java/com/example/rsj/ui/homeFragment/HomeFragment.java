package com.example.rsj.ui.homeFragment;

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
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.rsj.R;
import com.example.rsj.activity.DokterActivity;
import com.example.rsj.activity.PasienTerdaftarActivity;
import com.example.rsj.activity.PembayaranObatActivity;
import com.example.rsj.activity.PembayaranPeriksaActivity;
import com.example.rsj.activity.PeriksaActivity;
import com.example.rsj.activity.RiwayatPemeriksaanActivity;
import com.example.rsj.configfile.ServerApi;
import com.example.rsj.configfile.authdata;
import com.synnapps.carouselview.CarouselView;
import com.synnapps.carouselview.ImageListener;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class HomeFragment extends Fragment {
    CardView cardViewDokter, cardRiwayatperiksa, cardPeriksa;
    CarouselView carouselView;
    int[] sampleImgae = {
            R.drawable.tentangrsj,
            R.drawable.tentangrsj,
            R.drawable.tentangrsj
    };

    LinearLayout linear1, linear2, linear3;
    TextView totalpasien, totalpembayaranperiksa, totalpembayaranobat;
    authdata authdataa;
    String mKdRegist;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activity_home_fragment, container, false);
        authdataa = new authdata(getActivity());
        mKdRegist = authdataa.getKodeUser();

        linear1 = v.findViewById(R.id.linearPasien);
        linear2 = v.findViewById(R.id.linearPeriksa);
        linear3 = v.findViewById(R.id.linearObat);
        cardPeriksa = v.findViewById(R.id.cardPemeriksaan);
        cardViewDokter = v.findViewById(R.id.cardDokter);
        cardRiwayatperiksa = v.findViewById(R.id.cardRiwayatPeriksa);
        totalpasien = v.findViewById(R.id.tv_pasien);
        totalpembayaranperiksa = v.findViewById(R.id.tv_pemperiksa);
        totalpembayaranobat = v.findViewById(R.id.tv_pemobat);

        linear1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent a = new Intent(getActivity(), PasienTerdaftarActivity.class);
                startActivity(a);
            }
        });
        linear2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent b= new Intent(getActivity(), PembayaranPeriksaActivity.class);
                startActivity(b);
            }
        });
        linear3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent c = new Intent(getActivity(), PembayaranObatActivity.class);
                startActivity(c);
            }
        });
        cardViewDokter.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent d = new Intent(getActivity(), DokterActivity.class);
                startActivity(d);
            }
        });
        cardPeriksa.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent e = new Intent(getActivity(), PeriksaActivity.class);
                startActivity(e);
            }
        });
        cardRiwayatperiksa.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent e = new Intent(getActivity(), RiwayatPemeriksaanActivity.class);
                startActivity(e);
            }
        });

        carouselView = v.findViewById(R.id.Banner);
        carouselView.setPageCount(sampleImgae.length);
        ImageListener imageListener = new ImageListener() {
            @Override
            public void setImageForPosition(int position, ImageView imageView) {
                imageView.setImageResource(sampleImgae[position]);
            }
        };
        carouselView.setImageListener(imageListener);

        hitungjumlah();
        return v;
    }

    public void hitungjumlah(){
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

                        totalpasien.setText(jumlah_pasien);
                        totalpembayaranperiksa.setText(jumlah_periksa_1);
                        totalpembayaranobat.setText(jumlah_obat_1);
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
        RequestQueue requestQueue = Volley.newRequestQueue(getContext());
        requestQueue.add(jumlah);
    }
}