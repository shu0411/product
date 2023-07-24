using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace PhotoRename
{
    public partial class frm_Main : Form
    {
        public frm_Main()
        {
            InitializeComponent();
        }

        private void cmdRef_Click(object sender, EventArgs e)
        {
            using (FolderBrowserDialog dialog = new FolderBrowserDialog())
            {
                if(txtFilePath.Text != String.Empty)
                {
                    dialog.SelectedPath = txtFilePath.Text;
                }
                else
                {
                    dialog.SelectedPath = @"F:\元\";
                }

                if (dialog.ShowDialog() == DialogResult.OK)
                {
                    txtFilePath.Text = dialog.SelectedPath;
                }
            }
        }

        private void cmdRename_Click(object sender, EventArgs e)
        {
            //処理結果ラベルを初期化
            lbl_result.ForeColor = Color.Black;

            //ファイルパスが入力されているかチェック
            if (txtFilePath.Text != string.Empty) { 
                string[] strFiles;
                int index;
                int count;
                string afterName;
            
                Directory.SetCurrentDirectory(txtFilePath.Text);

                // ファイルパス名全取得
                strFiles = Directory.GetFiles(txtFilePath.Text,"*.JPG",SearchOption.TopDirectoryOnly);
                Array.Sort(strFiles);

                if (strFiles.Length != 0)
                {
                    //連番に入力値を指定
                    index = Convert.ToInt32(txtFirst.Text);

                    //ファイルを1件ずつ
                    foreach (string strFile in strFiles)
                    {

                        //変更後ファイル名作成
                        afterName = txtHead.Text + String.Format("{0:0000}", index) + ".JPG";

                        Console.WriteLine(afterName);

                        //ファイル名変更
                        File.Move(strFile, afterName);

                        //連番加算
                        index++;
                    }

                    //件数を計算
                    count = index - Convert.ToInt32(txtFirst.Text);

                    //処理結果をセット
                    lbl_result.Text = "" + count.ToString() + "件処理しました。" ;
                }
                else
                {   //JPEGファイルがなかった場合
                    lbl_result.Text = "対象ファイルがありません。";
                    lbl_result.ForeColor = Color.Red;
                    txtFilePath.Focus();
                }
            }
            else
            {   //ファイルパステキストボックスが空の場合
                MessageBox.Show("ファイルパスを入力してください。", this.Text, MessageBoxButtons.OK, MessageBoxIcon.Information);
                txtFilePath.Focus();
            }
        }

        private void txtFirst_Leave(object sender, EventArgs e)
        {
            try
            {
                Convert.ToInt32(txtFirst.Text);
            }
            catch (Exception ex)
            {
                txtFirst.Focus();
                MessageBox.Show("数値を入力してください。", this.Text, MessageBoxButtons.OK, MessageBoxIcon.Information);
            }
        }
    }    
}