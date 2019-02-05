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
    public partial class Form2 : Form
    {
        public Form2()
        {
            InitializeComponent();
        }

        private void label2_Click(object sender, EventArgs e)
        {

        }

        private void label9_Click(object sender, EventArgs e)
        {

        }

        private void comboBox1_SelectedIndexChanged(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            Form3 f3 = new Form3();
            f3.Show();
        }

        private void button1_Click_1(object sender, EventArgs e)
        {
            Form3 f3 = new Form3();
            f3.Show();
            Visible = false;
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Form5 f5 = new Form5();
            f5.Show();
            Visible = false;
        }

        private void button6_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            Form4 f4 = new Form4();
            f4.Show();
            Visible = false;
        }

        private void button4_Click(object sender, EventArgs e)
        {
            Form6 f6 = new Form6();
            f6.Show();
            Visible = false;
        }

        private void button5_Click(object sender, EventArgs e)
        {
            Form7 f7 = new Form7();
            f7.Show();
            Visible = false;
        }
    }
}
