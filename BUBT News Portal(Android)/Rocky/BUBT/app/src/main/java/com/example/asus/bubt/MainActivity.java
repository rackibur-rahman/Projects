package com.example.asus.bubt;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import com.mysql.jdbc.Connection;
import com.mysql.jdbc.PreparedStatement;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

public class MainActivity extends AppCompatActivity {
    ConnectionClass x;
    Connection con = null;
    Button admin, login;
    EditText lUsername, lPassword;


    NewsAdapter newsAdapter;
    String retrievedUserName;
    String retrievedPassword;

    ListView listView;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        x = new ConnectionClass();
        //x.CONN();

        listView = (ListView)findViewById(R.id.listMember);
        lUsername = findViewById(R.id.edtLUsername);
        lPassword = findViewById(R.id.edtLPassword);

        login = findViewById(R.id.btnAdminLogin);
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String user_name = lUsername.getText().toString();
                String user_pass = lPassword.getText().toString();

                con = x.CONN();

                PreparedStatement statement = null;
                try {
                    statement = (PreparedStatement) con.prepareStatement("SELECT * FROM registration");
                    ResultSet result = statement.executeQuery();
                    while(result.next()){
                        retrievedUserName = result.getString("username");
                        retrievedPassword = result.getString("password");

                        Log.d("USERNAME", retrievedUserName);
                        Log.d("USERNAME", retrievedPassword);
                    }
                    if(retrievedUserName.equals(user_name)&&retrievedPassword.equals(user_pass)){
                        Toast.makeText(MainActivity.this, "LOGIN SUCCESSFULLY",Toast.LENGTH_SHORT).show();
                        Intent intent2 = new Intent(MainActivity.this, AdminActivity.class);
                        startActivity(intent2);
                        lUsername.setText("");
                        lPassword.setText("");

                    }

                    else{
                        Toast.makeText(MainActivity.this, "FAILED",Toast.LENGTH_SHORT).show();
                    }
                } catch (SQLException e) {
                    e.printStackTrace();
                }
            }
        });

        admin = findViewById(R.id.btnAdmin);
        admin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(MainActivity.this, ARegistration.class);
                startActivity(intent);
            }
        });
        showNews();
    }

    public List<News> getAllMember() {
        List<News> memberList = new ArrayList<>();
        PreparedStatement statement = null;
        ResultSet resultSet;
        con = x.CONN();
        try{
            statement = (PreparedStatement) con.prepareStatement("SELECT * FROM bubtnews");
            ResultSet result = statement.executeQuery();
            News news;
            while(result.next()){
                String news1 = result.getString("news");
                news = new News(result.getString("news"));
                Log.d("DATA:", news1);
                memberList.add(news);
            }


        }catch (Exception ex){

        }
        return memberList;
    }

    public void showNews(){
        ArrayList<News> members = new ArrayList<>(getAllMember());
        newsAdapter = new NewsAdapter(members,this);
        listView.setAdapter(newsAdapter);
    }
}
