package com.example.rsj.activity;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.os.Bundle;
import android.widget.Adapter;

import com.example.rsj.R;
import com.example.rsj.adapter.AdapterDokter;
import com.example.rsj.model.ModelDokter;

import java.util.ArrayList;
import java.util.List;

public class DokterActivity extends AppCompatActivity {

    List<ModelDokter> listDokter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dokter);

        listDokter = new ArrayList<>();
        listDokter.add(new ModelDokter("Docter 1", R.drawable.player1));
        listDokter.add(new ModelDokter("Docter 2", R.drawable.player2));
        listDokter.add(new ModelDokter("Docter 3", R.drawable.player3));
        listDokter.add(new ModelDokter("Docter 4", R.drawable.player4));
        listDokter.add(new ModelDokter("Docter 5", R.drawable.player5));
        listDokter.add(new ModelDokter("Docter 6", R.drawable.player6));

        listDokter.add(new ModelDokter("Docter 1", R.drawable.player1));
        listDokter.add(new ModelDokter("Docter 2", R.drawable.player2));
        listDokter.add(new ModelDokter("Docter 3", R.drawable.player3));
        listDokter.add(new ModelDokter("Docter 4", R.drawable.player4));
        listDokter.add(new ModelDokter("Docter 5", R.drawable.player5));
        listDokter.add(new ModelDokter("Docter 6", R.drawable.player6));

        RecyclerView recyclerView = findViewById(R.id.recyclerDokter);
        AdapterDokter adapterDokter = new AdapterDokter(this, listDokter);
        recyclerView.setLayoutManager(new GridLayoutManager(this, 2));
        recyclerView.setAdapter(adapterDokter);
    }
}