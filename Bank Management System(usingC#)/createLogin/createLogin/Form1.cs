using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Data.SqlClient;

namespace createLogin
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
            //textBox2.PasswordChar = '*';
        }

        private void button1_Click(object sender, EventArgs e)
        {
            /*SqlConnection cn = new SqlConnection(@"Data Source=ROCKY\SQLEXPRESS;Initial Catalog=login2;Integrated Security=True");
            cn.Open();
            SqlCommand cmd = new SqlCommand("select * from user1 where username = '" + textBox1.Text + "' and password = '" + textBox2.Text + "'", cn);
            SqlDataReader dr;
            dr = cmd.ExecuteReader();
            int count = 0;
            while (dr.Read())
            {
                count += 1;
            }
            if (count ==0)
            {
                MessageBox.Show("Accept");
                Form2 f2 = new Form2();
                f2.Show();
            }
            else if (count >= 1)
            {
                MessageBox.Show("Duplicate username and password");
            }
            else
            {
                MessageBox.Show("username or password not correct");
            }

            textBox1.Clear();
            textBox2.Clear();*/


            

        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }

        private void textBox1_TextChanged(object sender, EventArgs e)
        {
            
        }

        private void textBox2_TextChanged(object sender, EventArgs e)
        {
            
            textBox2.PasswordChar = '*';
        }

        private void button2_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void pictureBox2_Click(object sender, EventArgs e)
        {

        }

        private void button3_Click(object sender, EventArgs e)
        {
            //SqlConnection con = new SqlConnection(@"Data Source=ROCKY\SQLEXPRESS;Initial Catalog=loginDB;Integrated Security=True");
            
            SqlConnection con = new SqlConnection(@"Data Source=.\SQLEXPRESS;AttachDbFilename=C:\Users\Rackibur Rahman\Documents\Visual Studio 2008\Projects\createLogin\DB\loginDB.mdf;Integrated Security=True;Connect Timeout=30;User Instance=True");
            string query = "select * from tbl_login where username = '" + textBox1.Text + "' and pass = '" + textBox2.Text + "'";
            //SqlDataAdapter sda = new SqlDataAdapter("select count(*) from tbl_login where username = '"+textBox1.Text+"' and pass = '"+textBox2.Text+"'",con);
            SqlDataAdapter sda = new SqlDataAdapter(query, con);
            DataTable dt = new DataTable();
            sda.Fill(dt);

            if (dt.Rows.Count == 1)
            {
                Form2 f2 = new Form2();
                this.Hide();
                f2.Show();
                //Visible = false; 
            }

            else
            {
                MessageBox.Show("enter a valid username and password");
            }

            textBox1.Clear();
            textBox2.Clear();

        }

        private void button2_Click_1(object sender, EventArgs e)
        {
            this.Close();
        }

        private void checkBox1_CheckedChanged(object sender, EventArgs e)
        {
            if (checkBox1.Checked)
            {
                textBox2.UseSystemPasswordChar = true;
            }

            else
            {
                textBox2.UseSystemPasswordChar = false;

            }
        }

        private void label2_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}
