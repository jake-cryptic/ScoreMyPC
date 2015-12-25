using System;
using System.Text;
using System.Management;
using System.Diagnostics;
//using System.Management.Instrumentation;
using System.Collections.Generic;
using System.Net;
using System.Collections.Specialized;
using System.Threading;

namespace UnderScored.SysInfo {
    class Program {
        static void Main(string[] args) {
            string programVer = "0.6";
            string server, result = "";
            
            //server = "http://192.168.0.13/SysInfo/";
            server = "http://projects.absolutedouble.co.uk/scoremypc/";
            
            Console.Title = "UnderScored - System Scorer v" + programVer;
            Console.WriteLine("Now loading information..\n");

            string dataRAM = InfoClasses.InfoRAM();
            string dataCPU = InfoClasses.InfoCPU();
            string dataGPU = InfoClasses.InfoGPU();
            string dataBSE = InfoClasses.InfoBSE();
            string dataNIC = InfoClasses.InfoNIC();
            string dataHDD = InfoClasses.InfoHDD();
            string dataINF = InfoClasses.InfoINF();
            string dataUSR = InfoClasses.InfoUSR();

            // Get total size of data being sent
            string allData = dataRAM + dataCPU + dataGPU + dataBSE + dataNIC + dataHDD + dataINF + dataUSR;
            int totalBytesSent = (allData.Length * sizeof(Char))/1000;

            // Send data to PHP script
            using (var client = new WebClient()) {
                Console.WriteLine("\nSending data, {0}KB total", totalBytesSent.ToString());

                string serverURL = server + "app.php";

                var data = new NameValueCollection();
                data["RAM"] = dataRAM;
                data["CPU"] = dataCPU;
                data["GPU"] = dataGPU;
                data["BSE"] = dataBSE;
                data["NIC"] = dataNIC;
                data["HDD"] = dataHDD;
                data["USR"] = dataUSR;
                data["INF"] = dataINF;
                
                try {
                    var response = client.UploadValues(serverURL, "POST", data);
                    result = Encoding.UTF8.GetString(response);
                } catch (WebException e) {
                    System.Windows.Forms.MessageBox.Show(e.Message, "ScoreMyPC");
                    Environment.Exit(0);
                }
            }
            
            bool dataAccepted = General.HandleServerResponse(result);

            if (dataAccepted == true) {
                Console.WriteLine("\nFinished - A webpage should now load with your results");
                Process.Start(server + "?a=accepted_" + result);
            } else {
                Environment.Exit(0);
            }
            
            Thread.Sleep(5000);
        }
    }
}