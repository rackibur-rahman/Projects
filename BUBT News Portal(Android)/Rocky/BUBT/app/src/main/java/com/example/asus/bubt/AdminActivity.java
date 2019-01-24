package com.example.asus.bubt;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.mysql.jdbc.Connection;
import com.mysql.jdbc.PreparedStatement;

import java.sql.SQLException;

public class AdminActivity extends AppCompatActivity {
    ConnectionClass x;
    Connection con = null;
    Button nSubmit, logout;
    EditText news;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_admin);
        x = new ConnectionClass();

        news = findViewById(R.id.edtNews);
        nSubmit = findViewById(R.id.btnNews);
        nSubmit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String bnews = news.getText().toString();

                con = x.CONN();

                PreparedStatement statement = null;
                try {
                    statement = (PreparedStatement) con.prepareStatement("INSERT INTO bubtnews(news)" + " VALUES('"+bnews+"')");
                    //statement.setString(1, user_name);
                    //statement.setString(2, user_pass);
                    statement.executeUpdate();
                    Toast.makeText(AdminActivity.this, "News Submitted",Toast.LENGTH_SHORT).show();
                    //Intent intent2 = new Intent(AdminActivity.this, MainActivity.class);
                    //startActivity(intent2);
                    news.setText("");
                } catch (SQLException e) {
                    e.printStackTrace();
                }
            }
        });

        logout = findViewById(R.id.btnLogout);
        logout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent2 = new Intent(AdminActivity.this, MainActivity.class);
                startActivity(intent2);
            }
        });


    }
}
