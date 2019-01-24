package com.example.rackiburrahman.bubt;

import android.annotation.SuppressLint;
import android.os.StrictMode;
import android.util.Log;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;


/**
 * Created by SHAM-IM on 14-Apr-18.
 */

public class ConnectionClass {

    @SuppressLint("NewApi")
    public Connection CONN() {
        Connection conn = null;
        try {

            Class.forName("com.mysql.jdbc.Driver");
            conn = DriverManager.getConnection("jdbc:mysql://localhost/bubt", "root", "");
            Log.d("DATABASE", "CONNECTION SUCCESS");
        }catch (ClassNotFoundException ex){
            ex.printStackTrace();
        }catch (SQLException ex1) {
            ex1.printStackTrace();
        }
        return conn;
    }
}
