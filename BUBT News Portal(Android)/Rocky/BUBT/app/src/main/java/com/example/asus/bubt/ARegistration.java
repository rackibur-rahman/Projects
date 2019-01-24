package com.example.asus.bubt;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.mysql.jdbc.PreparedStatement;

import java.sql.Connection;
import java.sql.SQLException;

public class ARegistration extends AppCompatActivity {

    ConnectionClass x;
    Connection con = null;
    EditText name, username, password;
    Button submit;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_aregistration);

        x = new ConnectionClass();

        name = findViewById(R.id.edtName);
        username = findViewById(R.id.edtUsername);
        password = findViewById(R.id.edtPassword);

        submit = findViewById(R.id.btnSubmit);
        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String names = name.getText().toString();
                String user_name = username.getText().toString();
                String user_pass = password.getText().toString();

                con = x.CONN();

                PreparedStatement statement = null;
                try {
                    statement = (PreparedStatement) con.prepareStatement("INSERT INTO registration(name,username, password)" + " VALUES('"+names+"','"+user_name+"','"+user_pass+"')");
                    //statement.setString(1, user_name);
                    //statement.setString(2, user_pass);
                    statement.executeUpdate();
                    Toast.makeText(ARegistration.this, "REGISTRATION SUCCESSFULLY",Toast.LENGTH_SHORT).show();
                    Intent intent2 = new Intent(ARegistration.this, MainActivity.class);
                    startActivity(intent2);
                } catch (SQLException e) {
                    e.printStackTrace();
                }
            }
        });
    }
}
