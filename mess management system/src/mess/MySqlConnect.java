/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mess;
import java.awt.*;
import java.sql.*;
import javax.swing.*;
/**
 *
 * @author ASUS
 */
public class MySqlConnect {
    Connection conn=null;
    public static Connection ConnectDB(){
        try
        {
            Class.forName("com.mysql.jdbc.Driver");
            Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/mess_management_system","root","");
            //JOptionPane.showMessageDialog(null,"Connected to database");
            return conn;
        }
        catch(Exception e){
            JOptionPane.showMessageDialog(null,e.getMessage());
            return null;
        }
                
                    
                 
    }
}
