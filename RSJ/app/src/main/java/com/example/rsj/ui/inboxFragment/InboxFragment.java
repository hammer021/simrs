package com.example.rsj.ui.inboxFragment;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.rsj.R;
import com.example.rsj.activity.DetailPasienTerdaftarActivity;
import com.example.rsj.activity.ViedoConferenceActivity;
import com.example.rsj.adapter.AdapterInbox;
import com.example.rsj.configfile.ServerApi;
import com.example.rsj.configfile.authdata;
import com.example.rsj.model.ModelInbox;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class InboxFragment extends Fragment {
    RecyclerView recyclerView;
    List<ModelInbox> item;
    AdapterInbox adapterInbox;

    RequestQueue requestQueue;
    authdata authdataa;

    String mKdRegist;
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activity_inbox_fragment, container, false);
        authdataa = new authdata(getContext());
        requestQueue = Volley.newRequestQueue(getContext());

        recyclerView = v.findViewById(R.id.recyclerInbox);
        mKdRegist = authdataa.getKodeUser();

        loadInbox();
        return v;
    }

    private void loadInbox(){
        StringRequest stringRequest = new StringRequest(Request.Method.GET, ServerApi.URL_GETINBOX + mKdRegist, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    JSONArray data = jsonObject.getJSONArray("data");

                    item = new ArrayList<>();
                    for (int i = 0; i < data.length(); i++)
                    {
                        ModelInbox modelInbox = new ModelInbox();
                        JSONObject datanya = data.getJSONObject(i);
                        modelInbox.setNama_pasien(datanya.getString("nama_pasien"));
                        modelInbox.setNo_rm(datanya.getString("no_rm"));
                        modelInbox.setTgl_kunjungan(datanya.getString("tgl_kunjungan"));
                        modelInbox.setFoto(datanya.getString("foto"));
                        item.add(modelInbox);
                    }
                    setupListView();
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
        requestQueue.add(stringRequest);
    }

    private void setupListView(){
        adapterInbox = new AdapterInbox(getActivity(), item);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getActivity());
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setAdapter(adapterInbox);

        adapterInbox.setListener(new AdapterInbox.OnHistoryClickListener() {
            @Override
            public void onClick(int position) {
                ModelInbox modelInbox = item.get(position);
                Toast.makeText(getActivity(), modelInbox.getNo_rm(), Toast.LENGTH_LONG).show();
                Intent detail = new Intent(getActivity(), ViedoConferenceActivity.class);
                detail.putExtra("no_rm", modelInbox.getNo_rm());
                startActivity(detail);
            }
        });
    }
}