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
    public partial class Form3 : Form
    {
        public Form3()
        {
            

            InitializeComponent();
        }

        private void fontDialog1_Apply(object sender, EventArgs e)
        {

        }

        private void button2_Click(object sender, EventArgs e)
        {
            Form2 f2 = new Form2();
            f2.Show();
            Visible = false;
        }

        private void button1_Click(object sender, EventArgs e)
        {
            /*Form4 f4 = new Form4();
            f4.Show();
            Visible = false;*/

            //SqlConnection con = new SqlConnection(@"Data Source=ROCKY\SQLEXPRESS;Initial Catalog=loginDB;Integrated Security=True");
            SqlConnection con = new SqlConnection(@"Data Source=.\SQLEXPRESS;AttachDbFilename=C:\Users\Rackibur Rahman\Documents\Visual Studio 2008\Projects\createLogin\DB\loginDB.mdf;Integrated Security=True;Connect Timeout=30;User Instance=True");
            con.Open();
            SqlCommand cmd = con.CreateCommand();
            cmd.CommandType = CommandType.Text;
            cmd.CommandText = "insert into create_acc values('"+textBox1.Text+"','"+textBox2.Text+"','"+textBox3.Text+"','"+textBox4.Text+"','"+textBox5.Text+"','"+textBox6.Text+"','"+comboBox1.Text+"','"+comboBox2.Text+"','"+textBox9.Text+"','"+textBox10.Text+"','"+dateTimePicker1.Text+"')";
            cmd.ExecuteNonQuery();
            con.Close();




           /* SqlDataAdapter sda = new SqlDataAdapter("insert into create_acc(acc_no,name,address,contact_no,email,age,gender,occupation,annual_income,openning_amount,date) values ('" + textBox1.Text + "','" + textBox2.Text + "','" + textBox3.Text + "','" + textBox4.Text + "','" + textBox5.Text + "','" + textBox6.Text + "','" + comboBox1.Text + "','" + comboBox2.Text + "','" + textBox9.Text + "','" + textBox10.Text + "','" + this.dateTimePicker1.Text + "')", con);
            sda.SelectCommand.ExecuteNonQuery();
            cmd.ExecuteNonQuery();
            con.Close();*/



            MessageBox.Show("New Account Created Successfully !!!");

            textBox1.Clear();
            textBox2.Clear();
            textBox3.Clear();
            textBox4.Clear();
            textBox5.Clear();
            textBox6.Clear();
            textBox9.Clear();
            textBox10.Clear();
            
            
        }

        private void textBox4_TextChanged(object sender, EventArgs e)
        {

        }

        private void label12_Click(object sender, EventArgs e)
        {

        }
    }
}
