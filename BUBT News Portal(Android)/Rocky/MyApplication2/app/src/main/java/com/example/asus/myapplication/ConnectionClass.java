package com.example.asus.myapplication;

import android.annotation.SuppressLint;
import android.os.StrictMode;
import android.util.Log;

import com.mysql.jdbc.Connection;

import java.sql.DriverManager;
import java.sql.SQLException;

import static android.content.ContentValues.TAG;

/**
 * Created by Asus on 7/17/2018.
 */

public class ConnectionClass {
    String classs = "com.mysql.jdbc.Driver";
    String url = "jdbc:mysql://192.168.85.1/bubt";
    String un = "rocky";
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

            conn = (Connection) DriverManager.getConnection(url, un, password);
            if (conn == null) {
                Log.d(TAG, "DATABASE NOT CONNECTED\n");
            } else {
                Log.d(TAG, "DATABASE CONNECTED\n");
            }


            //conn = DriverManager.getConnection(ConnURL);
        } catch (SQLException se) {
            Log.e("ERRO", se.getMessage());
        } catch (ClassNotFoundException e) {
            Log.d(TAG, "Cannot find MySQL JDBC Driver!");
            Log.e("ERRO", e.getMessage());

        } catch (Exception e) {
            Log.e("ERRO", e.getMessage());
        }
        return conn;
    }
}
