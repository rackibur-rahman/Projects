package com.example.sham_im.myapplication;

import android.annotation.SuppressLint;
import android.os.StrictMode;
import android.util.Log;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

import static android.content.ContentValues.TAG;

public class ConnectionClass {
    String classs = "com.mysql.jdbc.Driver";

    String url = "jdbc:mysql://192.168.0.113/sham";
    String un = "shams";
    String password = "123";



    @SuppressLint("NewApi")
    public Connection CONN() {
        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder()
                .permitAll().build();
        StrictMode.setThreadPolicy(policy);
        Connection conn = null;
        String ConnURL = null;
        try {

            Class.forName(classs);

            conn = DriverManager.getConnection(url, un, password);
            if (conn == null) {
                Log.d(TAG, "DATABASE NOT CONNECTED\n");
            } else {
                Log.d(TAG, "DATABASE CONNECTED\n");
            }


            //conn = DriverManager.getConnection(ConnURL);
        } catch (SQLException se) {
            Log.e("ERROS", se.getMessage());
            //Log.e("ERROS", "SQLException");
        } catch (ClassNotFoundException e) {
            Log.d(TAG, "Cannot find MySQL JDBC Driver!");
            Log.e("ERROS", e.getMessage());
            //Log.e("ERROS", "ClassNotFoundException");

        } catch (Exception e) {
            Log.e("ERROS", e.getMessage());
            //Log.e("ERROS", "Exception");
        }
        return conn;
    }
}
