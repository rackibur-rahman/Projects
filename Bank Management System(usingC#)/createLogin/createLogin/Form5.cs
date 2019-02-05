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
    public partial class Form5 : Form
    {
        public Form5()
        {
            InitializeComponent();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            Form1 f1 = new Form1();
            f1.Show();
            Visible = false;
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Form2 f2 = new Form2();
            f2.Show();
            Visible = false;
        }

        private void button1_Click(object sender, EventArgs e)
        {
            /*Form6 f6 = new Form6();
            f6.Show();
            Visible = false;*/
            SqlConnection con = new SqlConnection(@"Data Source=.\SQLEXPRESS;AttachDbFilename=C:\Users\Rackibur Rahman\Documents\Visual Studio 2008\Projects\createLogin\DB\loginDB.mdf;Integrated Security=True;Connect Timeout=30;User Instance=True");

            con.Open();
            SqlCommand cmd = con.CreateCommand();
            cmd.CommandType = CommandType.Text;
            cmd.CommandText = "select acc_no,name,contact_no,occupation,email,openning_amount as total_amount,date as openning_date,annual_income from create_acc where acc_no = '"+textBox1.Text+"'";
            cmd.ExecuteNonQuery();
            DataTable dt = new DataTable();
            SqlDataAdapter da = new SqlDataAdapter(cmd);
            da.Fill(dt);
            dataGridView1.DataSource = dt;
            con.Close();
            textBox1.Text = "";



            /*string query = "select * from create_acc where acc_no = '" + textBox1.Text + "' ";
            //SqlDataAdapter sda = new SqlDataAdapter("select count(*) from tbl_login where username = '"+textBox1.Text+"' and pass = '"+textBox2.Text+"'",con);
            SqlDataAdapter sda = new SqlDataAdapter(query, con);
            DataTable dt = new DataTable();
            sda.Fill(dt);

            if (dt.Rows.Count == 1)
            {
                SqlCommand cmd = con.CreateCommand();
                cmd.CommandType = CommandType.Text;
                cmd.CommandText = "select acc_no,name,contact_no,occupation,email,openning_amount as total_amount,date as openning_date,annual_income from create_acc where acc_no = '" + textBox1.Text + "'";
                cmd.ExecuteNonQuery();
                con.Close();
                //disp_data();
                MessageBox.Show(" Amount on Account Successfully !!!!");
                textBox1.Text = "";
                //textBox2.Clear();
            }

            else
            {
                MessageBox.Show("** This Account No. is not in Bank Database **");
                textBox1.Clear();
                //textBox2.Clear();
            }*/






        }

        public void disp_data()
        {
            SqlConnection con = new SqlConnection(@"Data Source=.\SQLEXPRESS;AttachDbFilename=C:\Users\Rackibur Rahman\Documents\Visual Studio 2008\Projects\createLogin\DB\loginDB.mdf;Integrated Security=True;Connect Timeout=30;User Instance=True");

            con.Open();
            SqlCommand cmd = con.CreateCommand();
            cmd.CommandType = CommandType.Text;
            cmd.CommandText = "select * from create_acc";
            cmd.ExecuteNonQuery();
            DataTable dt = new DataTable();
            SqlDataAdapter da = new SqlDataAdapter(cmd);
            da.Fill(dt);
            dataGridView1.DataSource = dt;
            con.Close();
            
        }

        private void Form5_Load(object sender, EventArgs e)
        {
            disp_data();
        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }

    }
}
