package com.example.rackiburrahman.bubt;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 * Created by SHAM-IM on 07-Apr-18.
 */

public class DBConnection {
    //String classs = "com.mysql.jdbc.Driver";
    static final String url = "jdbc:mysql://192.168.74.1/bubt";
    String user = "root";
    String password = "";

    public Connection CONN() {
        Connection conn = null;
        //String ConnURL = null;

        try{

            //Class.forName(classs);
            Class.forName("com.mysql.jdbc.Driver");
            conn = DriverManager.getConnection(url, user, password);
            //conn = DriverManager.getConnection(ConnURL);
        }catch (ClassNotFoundException ex){
            ex.printStackTrace();
        }catch (SQLException ex){
            ex.printStackTrace();
        }

        return conn;
    }
}

