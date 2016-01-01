using System;
using System.Text;
using System.Management;
using System.Diagnostics;
using System.Collections.Generic;
using System.Net;
using System.Collections.Specialized;
using System.Threading;

namespace UnderScored.SysInfo {
    class General {
        public static string ArrayToString(List<string> arr) {
            string newStr = string.Join("@@!~@", arr.ToArray());
            return newStr;
        }

        public static string Base64Encode(string plainText) {
            var plainTextBytes = Encoding.UTF8.GetBytes(plainText);
            return Convert.ToBase64String(plainTextBytes);
        }

        public static bool HandleServerResponse(string result) {
            bool dataAccepted;

            if (result == "_4") {
                System.Windows.Forms.MessageBox.Show("Error: Your version of ScoreMyPC is out of date!", "ScoreMyPC"); // Future proofing...
                dataAccepted = false;
            } else if (result == "_3") {
                System.Windows.Forms.MessageBox.Show("Error: Couldn't store your result on the server", "ScoreMyPC");
                dataAccepted = false;
            } else if (result == "_2") {
                System.Windows.Forms.MessageBox.Show("Error: Some data wasn't sent to the server", "ScoreMyPC");
                dataAccepted = false;
            } else if (result == "_1") {
                System.Windows.Forms.MessageBox.Show("Error: No data was sent to the server", "ScoreMyPC");
                dataAccepted = false;
            } else if (result == "_0") {
                System.Windows.Forms.MessageBox.Show("Error: Data was saved but ID couldn't be retrived", "ScoreMyPC");
                dataAccepted = false;
            } else {
                Console.WriteLine("Server accepted the data");
                dataAccepted = true;
            }
            return dataAccepted;
        }
    }
}
