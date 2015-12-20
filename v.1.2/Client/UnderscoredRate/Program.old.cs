using System;
using System.Text;
using System.Management;
using System.Diagnostics;
//using System.Management.Instrumentation;
using System.Collections.Generic;
using System.Net;
using System.Collections.Specialized;
using System.Threading;

namespace UnderScored.Projects {
    class SysInfo {
        static void Main(string[] args) {
            string programVer = "0.4";

            Console.Title = "UnderScored - System Scorer v" + programVer;
            Console.WriteLine("Now loading information..\n");

            List<string> InfoRAM = new List<string>(); // RAM
            List<string> InfoCPU = new List<string>(); // CPU
            List<string> InfoGPU = new List<string>(); // GPU
            List<string> InfoBSE = new List<string>(); // Mother Board
            List<string> InfoNIC = new List<string>(); // Network card
            List<string> InfoHDD = new List<string>(); // Storage
            List<string> InfoINF = new List<string>(); // OS info

            // Hardware Information
            ManagementObjectSearcher searcherRAM = new ManagementObjectSearcher("Select * from Win32_PhysicalMemory");
            foreach (ManagementObject data in searcherRAM.Get()) {
                try { 
                    InfoRAM.Add("START_ARRAY");
                    InfoRAM.Add(data.GetPropertyValue("Manufacturer").ToString());
                    InfoRAM.Add(data.GetPropertyValue("Capacity").ToString());
                } catch (ManagementException e) {
                    string errorMsg = "Error when getting RAM information:\n" + e.Message;
                    System.Windows.Forms.MessageBox.Show(errorMsg, "ScoreMyPC");
                    Environment.Exit(0);
                }
                Console.WriteLine("Loaded: RAM");
            }
            ManagementObjectSearcher searcherCPU = new ManagementObjectSearcher("Select * from Win32_Processor");
            foreach (ManagementObject data in searcherCPU.Get()) {
                InfoCPU.Add("START_ARRAY");
                try {
                    InfoCPU.Add(data.GetPropertyValue("CurrentClockSpeed").ToString());
                    InfoCPU.Add(data.GetPropertyValue("CurrentVoltage").ToString());
                    InfoCPU.Add(data.GetPropertyValue("Manufacturer").ToString());
                    InfoCPU.Add(data.GetPropertyValue("MaxClockSpeed").ToString());
                    InfoCPU.Add(data.GetPropertyValue("Name").ToString());
                    InfoCPU.Add(data.GetPropertyValue("NumberOfCores").ToString());
                    InfoCPU.Add(data.GetPropertyValue("NumberOfLogicalProcessors").ToString());
                    InfoCPU.Add(data.GetPropertyValue("SystemName").ToString());
                } catch (ManagementException e) {
                    string errorMsg = "Error when getting CPU information:\n" + e.Message;
                    System.Windows.Forms.MessageBox.Show(errorMsg, "ScoreMyPC");
                    Environment.Exit(0);
                }
                Console.WriteLine("Loaded: CPU");
            }
            ManagementObjectSearcher searcherGPU = new ManagementObjectSearcher("Select * from Win32_VideoController");
            foreach (ManagementObject data in searcherGPU.Get()) {
                InfoGPU.Add("START_ARRAY");
                try {
                    InfoGPU.Add(data.GetPropertyValue("AdapterCompatibility").ToString());
                    InfoGPU.Add(data.GetPropertyValue("AdapterRAM").ToString());
                    InfoGPU.Add(data.GetPropertyValue("Caption").ToString());
                    InfoGPU.Add(data.GetPropertyValue("Name").ToString());
                } catch (ManagementException e) {
                    string errorMsg = "Error when getting GPU information:\n" + e.Message;
                    System.Windows.Forms.MessageBox.Show(errorMsg, "ScoreMyPC");
                    Environment.Exit(0);
                }
                Console.WriteLine("Loaded: GPU");
            }
            ManagementObjectSearcher searcherBSE = new ManagementObjectSearcher("Select * from Win32_BaseBoard");
            foreach (ManagementObject data in searcherBSE.Get()) {
                InfoBSE.Add("START_ARRAY");
                try {
                    InfoBSE.Add("START_ARRAY");
                    Console.WriteLine("Loaded: MB");
                } catch (ManagementException e) {
                    string errorMsg = "Error when getting MB information:\n" + e.Message;
                    System.Windows.Forms.MessageBox.Show(errorMsg, "ScoreMyPC");
                    Environment.Exit(0);
                }
                Console.WriteLine("Loaded: MB");
            }
            ManagementObjectSearcher searcherNIC = new ManagementObjectSearcher("Select * from Win32_NetworkAdapter");
            foreach (ManagementObject data in searcherNIC.Get()) {
                InfoNIC.Add("START_ARRAY");
                try {
                    InfoNIC.Add("START_ARRAY");
                    Console.WriteLine("Loaded: NIC");
                } catch (ManagementException e) {
                    string errorMsg = "Error when getting NIC information:\n" + e.Message;
                    System.Windows.Forms.MessageBox.Show(errorMsg, "ScoreMyPC");
                    Environment.Exit(0);
                }
                Console.WriteLine("Loaded: NIC");
            }
            ManagementObjectSearcher searcherHDD = new ManagementObjectSearcher("Select * from Win32_LogicalDisk");
            foreach (ManagementObject data in searcherHDD.Get()) {
                InfoHDD.Add("START_ARRAY");
                try {
                    InfoHDD.Add("START_ARRAY");
                    InfoHDD.Add(data.GetPropertyValue("Compressed").ToString());
                    InfoHDD.Add(data.GetPropertyValue("Description").ToString());
                    InfoHDD.Add(data.GetPropertyValue("DeviceID").ToString());
                    InfoHDD.Add(data.GetPropertyValue("FileSystem").ToString());
                    InfoHDD.Add(data.GetPropertyValue("FreeSpace").ToString());
                    InfoHDD.Add(data.GetPropertyValue("Size").ToString());
                    InfoHDD.Add(data.GetPropertyValue("VolumeName").ToString());
                    InfoHDD.Add(data.GetPropertyValue("VolumeSerialNumber").ToString());
                    Console.WriteLine("Loaded: HDD");
                } catch (ManagementException e) {
                    string errorMsg = "Error when getting HDD information:\n" + e.Message;
                    System.Windows.Forms.MessageBox.Show(errorMsg, "ScoreMyPC");
                    Environment.Exit(0);
                }
                Console.WriteLine("Loaded: HDD");
            }

            // Software Information
            ManagementObjectSearcher searcherINF = new ManagementObjectSearcher("Select * from Win32_OperatingSystem");
            foreach (ManagementObject data in searcherINF.Get()) {
                InfoINF.Add("START_ARRAY");
                try {
                    InfoINF.Add(data.GetPropertyValue("Caption").ToString());
                    InfoINF.Add(data.GetPropertyValue("CountryCode").ToString());
                    InfoINF.Add(data.GetPropertyValue("OSArchitecture").ToString());
                    InfoINF.Add(data.GetPropertyValue("Name").ToString());
                    InfoINF.Add(data.GetPropertyValue("NumberOfUsers").ToString());
                } catch (ManagementException e) {
                    string errorMsg = "Error when getting OS information:\n" + e.Message;
                    System.Windows.Forms.MessageBox.Show(errorMsg, "ScoreMyPC");
                    Environment.Exit(0);
                }
                Console.WriteLine("Loaded: INF");
            }

            Console.WriteLine("\nPreparing Data..");
            // Convert Lists to strings
            string StrRAM, StrCPU, StrGPU, StrBSE, StrNIC, StrHDD, StrINF;
            StrRAM = ArrayToString(InfoRAM);
            StrCPU = ArrayToString(InfoCPU);
            StrGPU = ArrayToString(InfoGPU);
            StrBSE = ArrayToString(InfoGPU);
            StrNIC = ArrayToString(InfoGPU);
            StrHDD = ArrayToString(InfoGPU);
            StrINF = ArrayToString(InfoINF);

            // Base64 Encode strings
            string SafeStrRAM, SafeStrCPU, SafeStrGPU, SafeStrBSE, SafeStrNIC, SafeStrHDD, SafeStrINF;
            SafeStrRAM = Base64Encode(StrRAM);
            SafeStrCPU = Base64Encode(StrCPU);
            SafeStrGPU = Base64Encode(StrGPU);
            SafeStrBSE = Base64Encode(StrBSE);
            SafeStrNIC = Base64Encode(StrNIC);
            SafeStrHDD = Base64Encode(StrHDD);
            SafeStrINF = Base64Encode(StrINF);

            // Now send data to server
            Console.WriteLine("\nSending data...");
            string server = "http://192.168.0.13/SysInfo/";
            string result = "";

            // Send data to PHP script
            using (var client = new WebClient()) {
                var data = new NameValueCollection();
                data["SMPC"] = programVer;
                data["RAM"] = SafeStrRAM;
                data["CPU"] = SafeStrCPU;
                data["GPU"] = SafeStrGPU;
                //data["BSE"] = SafeStrBSE;
                //data["NIC"] = SafeStrNIC;
                //data["HDD"] = SafeStrHDD;
                data["INF"] = SafeStrINF;

                string serverURL = server + "app.php";

                try {
                    var response = client.UploadValues(serverURL, "POST", data);
                    result = Encoding.UTF8.GetString(response);
                } catch (WebException e) {
                    System.Windows.Forms.MessageBox.Show(e.Message, "ScoreMyPC");
                    Environment.Exit(0);
                }

            }

            // Use server response to determine program output
            bool dataAccepted;

            if (result == "_4") {
                Console.WriteLine("Error: Your version of ScoreMyPC is out of date!"); // Future proofing...
                dataAccepted = false;
            } else if (result == "_3") {
                Console.WriteLine("Error: Couldn't store your result on the server");
                dataAccepted = false;
            } else if (result == "_2") {
                Console.WriteLine("Error: Some data wasn't sent to the server");
                dataAccepted = false;
            } else if (result == "_1") {
                Console.WriteLine("Error: No data was sent to the server");
                dataAccepted = false;
            } else if (result == "_0") {
                Console.WriteLine("Error: Data was saved but ID couldn't be retrived");
                dataAccepted = false;
            } else {
                Console.WriteLine("Server accepted the data");
                dataAccepted = true;
            }

            if (dataAccepted == true) {
                Console.WriteLine("\nFinished - A webpage should now load with your results");
                Process.Start(server + "?a=accepted_" + result);
            } else {
                Process.Start(server + "?a=error" + result);
                System.Windows.Forms.MessageBox.Show("Error");
            }

            Thread.Sleep(5000);
        }

        private static string ArrayToString(List<string> arr) {
            string newStr = string.Join("@@!~@", arr.ToArray());
            return newStr;
        }

        private static string Base64Encode(string plainText) {
            var plainTextBytes = Encoding.UTF8.GetBytes(plainText);
            return Convert.ToBase64String(plainTextBytes);
        }
    }
}