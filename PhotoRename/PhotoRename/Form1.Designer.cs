namespace PhotoRename
{
    partial class frm_Main
    {
        /// <summary>
        /// 必要なデザイナー変数です。
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// 使用中のリソースをすべてクリーンアップします。
        /// </summary>
        /// <param name="disposing">マネージド リソースを破棄する場合は true を指定し、その他の場合は false を指定します。</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows フォーム デザイナーで生成されたコード

        /// <summary>
        /// デザイナー サポートに必要なメソッドです。このメソッドの内容を
        /// コード エディターで変更しないでください。
        /// </summary>
        private void InitializeComponent()
        {
            this.label1 = new System.Windows.Forms.Label();
            this.txtFilePath = new System.Windows.Forms.TextBox();
            this.cmdRef = new System.Windows.Forms.Button();
            this.txtHead = new System.Windows.Forms.TextBox();
            this.txtFirst = new System.Windows.Forms.TextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.cmdRename = new System.Windows.Forms.Button();
            this.lbl_result = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(35, 42);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(64, 15);
            this.label1.TabIndex = 0;
            this.label1.Text = "ファイル名";
            // 
            // txtFilePath
            // 
            this.txtFilePath.Location = new System.Drawing.Point(128, 39);
            this.txtFilePath.Margin = new System.Windows.Forms.Padding(3, 2, 3, 2);
            this.txtFilePath.Name = "txtFilePath";
            this.txtFilePath.Size = new System.Drawing.Size(253, 22);
            this.txtFilePath.TabIndex = 1;
            this.txtFilePath.Text = "F:\\元";
            // 
            // cmdRef
            // 
            this.cmdRef.Location = new System.Drawing.Point(387, 37);
            this.cmdRef.Margin = new System.Windows.Forms.Padding(3, 2, 3, 2);
            this.cmdRef.Name = "cmdRef";
            this.cmdRef.Size = new System.Drawing.Size(85, 24);
            this.cmdRef.TabIndex = 2;
            this.cmdRef.Text = "参照";
            this.cmdRef.UseVisualStyleBackColor = true;
            this.cmdRef.Click += new System.EventHandler(this.cmdRef_Click);
            // 
            // txtHead
            // 
            this.txtHead.Location = new System.Drawing.Point(128, 79);
            this.txtHead.Margin = new System.Windows.Forms.Padding(3, 2, 3, 2);
            this.txtHead.Name = "txtHead";
            this.txtHead.Size = new System.Drawing.Size(100, 22);
            this.txtHead.TabIndex = 3;
            this.txtHead.Text = "IMG_";
            // 
            // txtFirst
            // 
            this.txtFirst.Location = new System.Drawing.Point(128, 115);
            this.txtFirst.Margin = new System.Windows.Forms.Padding(3, 2, 3, 2);
            this.txtFirst.Name = "txtFirst";
            this.txtFirst.Size = new System.Drawing.Size(100, 22);
            this.txtFirst.TabIndex = 4;
            this.txtFirst.Text = "0001";
            this.txtFirst.Leave += new System.EventHandler(this.txtFirst_Leave);
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(35, 82);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(52, 15);
            this.label2.TabIndex = 5;
            this.label2.Text = "接頭辞";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(34, 122);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(79, 15);
            this.label3.TabIndex = 6;
            this.label3.Text = "最初の番号";
            // 
            // cmdRename
            // 
            this.cmdRename.Location = new System.Drawing.Point(317, 144);
            this.cmdRename.Margin = new System.Windows.Forms.Padding(3, 2, 3, 2);
            this.cmdRename.Name = "cmdRename";
            this.cmdRename.Size = new System.Drawing.Size(155, 50);
            this.cmdRename.TabIndex = 7;
            this.cmdRename.Text = "実行";
            this.cmdRename.UseVisualStyleBackColor = true;
            this.cmdRename.Click += new System.EventHandler(this.cmdRename_Click);
            // 
            // lbl_result
            // 
            this.lbl_result.AutoSize = true;
            this.lbl_result.BackColor = System.Drawing.SystemColors.Control;
            this.lbl_result.Location = new System.Drawing.Point(125, 162);
            this.lbl_result.Name = "lbl_result";
            this.lbl_result.Size = new System.Drawing.Size(17, 15);
            this.lbl_result.TabIndex = 8;
            this.lbl_result.Text = "　";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(35, 162);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(67, 15);
            this.label4.TabIndex = 9;
            this.label4.Text = "処理結果";
            // 
            // frm_Main
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 15F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(531, 242);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.lbl_result);
            this.Controls.Add(this.cmdRename);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.txtFirst);
            this.Controls.Add(this.txtHead);
            this.Controls.Add(this.cmdRef);
            this.Controls.Add(this.txtFilePath);
            this.Controls.Add(this.label1);
            this.Margin = new System.Windows.Forms.Padding(3, 2, 3, 2);
            this.Name = "frm_Main";
            this.Text = "PhotoRename";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.TextBox txtFilePath;
        private System.Windows.Forms.Button cmdRef;
        private System.Windows.Forms.TextBox txtHead;
        private System.Windows.Forms.TextBox txtFirst;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Button cmdRename;
        private System.Windows.Forms.Label lbl_result;
        private System.Windows.Forms.Label label4;
    }
}

