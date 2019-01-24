package com.example.rackiburrahman.bubt;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;

import java.sql.Connection;

public class MainActivity extends AppCompatActivity {
    Button admin;
    DBConnection dbConnection;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        dbConnection = new DBConnection();
        ConnectionClass connectionClass = new ConnectionClass();
        connectionClass.CONN();

        admin = findViewById(R.id.btnAdmin);
        admin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Connection conns = dbConnection.CONN();

                if(conns == null){
                    Log.d("CONNECTION", "FAILED");
                }
                else {
                    Log.d("CONNECTION", "SUCCESS");
                }
                //Intent intent = new Intent(MainActivity.this, Registration.class);
                //startActivity(intent);
            }
        });
    }
}
