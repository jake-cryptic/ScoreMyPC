using System;
using System.Text;
using System.Management;
using System.Diagnostics;
using System.Collections.Generic;
using System.Net;
using System.Collections.Specialized;
using System.Threading;

namespace UnderScored.SysInfo {
    class InfoClasses {
        public static string InfoRAM() {
            Console.WriteLine("---------------- RAM ----------------\n - Loading");
            List<string> Item = new List<string>();
            ManagementObjectSearcher Searcher = new ManagementObjectSearcher("Select * from Win32_PhysicalMemory");
            foreach (ManagementObject data in Searcher.Get()) {
                try {
                    Item.Add("START_ARRAY");
                    Item.Add(data.GetPropertyValue("Manufacturer").ToString());
                    Item.Add(data.GetPropertyValue("Capacity").ToString());
                } catch (ManagementException e) {
                    string errorMsg = "Error when getting RAM information:\n" + e.Message;
                    System.Windows.Forms.MessageBox.Show(errorMsg, "ScoreMyPC");
                    Environment.Exit(0);
                }
            }
            string ItemString = UnderScored.SysInfo.General.ArrayToString(Item);
            string ItemSafe = UnderScored.SysInfo.General.Base64Encode(ItemString);
            Console.WriteLine(" - Loaded\n");
            return ItemSafe;
        }

        public static string InfoCPU() {
            Console.WriteLine("---------------- CPU ----------------\n - Loading");
            List<string> Item = new List<string>();
            ManagementObjectSearcher Searcher = new ManagementObjectSearcher("Select * from Win32_Processor");
            foreach (ManagementObject data in Searcher.Get()) {
                Item.Add("START_ARRAY");
                try {
                    Item.Add(data.GetPropertyValue("CurrentClockSpeed").ToString());
                    Item.Add(data.GetPropertyValue("CurrentVoltage").ToString());
                    Item.Add(data.GetPropertyValue("Manufacturer").ToString());
                    Item.Add(data.GetPropertyValue("MaxClockSpeed").ToString());
                    Item.Add(data.GetPropertyValue("Name").ToString());
                    Item.Add(data.GetPropertyValue("NumberOfCores").ToString());
                    Item.Add(data.GetPropertyValue("NumberOfLogicalProcessors").ToString());
                    Item.Add(data.GetPropertyValue("SystemName").ToString());
                } catch (ManagementException e) {
                    string errorMsg = "Error when getting CPU information:\n" + e.Message;
                    System.Windows.Forms.MessageBox.Show(errorMsg, "ScoreMyPC");
                    Environment.Exit(0);
                }
            }
            string ItemString = UnderScored.SysInfo.General.ArrayToString(Item);
            string ItemSafe = UnderScored.SysInfo.General.Base64Encode(ItemString);
            Console.WriteLine(" - Loaded\n");
            return ItemSafe;
        }

        public static string InfoGPU() {
            Console.WriteLine("---------------- GPU ----------------\n - Loading");
            List<string> Item = new List<string>();
            ManagementObjectSearcher Searcher = new ManagementObjectSearcher("Select * from Win32_VideoController");
            foreach (ManagementObject data in Searcher.Get()) {
                Item.Add("START_ARRAY");
                try {
                    Item.Add(data.GetPropertyValue("AdapterCompatibility").ToString());
                    Item.Add(data.GetPropertyValue("AdapterRAM").ToString());
                    Item.Add(data.GetPropertyValue("Caption").ToString());
                    Item.Add(data.GetPropertyValue("Name").ToString());
                } catch (ManagementException e) {
                    string errorMsg = "Error when getting GPU information:\n" + e.Message;
                    System.Windows.Forms.MessageBox.Show(errorMsg, "ScoreMyPC");
                    Environment.Exit(0);
                }
            }
            string ItemString = UnderScored.SysInfo.General.ArrayToString(Item);
            string ItemSafe = UnderScored.SysInfo.General.Base64Encode(ItemString);
            Console.WriteLine(" - Loaded\n");
            return ItemSafe;
        }

        public static string InfoBSE() {
            Console.WriteLine("---------------- BSE ----------------\n - Loading");
            List<string> Item = new List<string>();
            ManagementObjectSearcher Searcher = new ManagementObjectSearcher("Select * from Win32_BaseBoard");
            foreach (ManagementObject data in Searcher.Get()) {
                Item.Add("START_ARRAY");
                try {
                    // Stuff
                } catch (ManagementException e) {
                    string errorMsg = "Error when getting MB information:\n" + e.Message;
                    System.Windows.Forms.MessageBox.Show(errorMsg, "ScoreMyPC");
                    Environment.Exit(0);
                }
            }
            string ItemString = UnderScored.SysInfo.General.ArrayToString(Item);
            string ItemSafe = UnderScored.SysInfo.General.Base64Encode(ItemString);
            Console.WriteLine(" - Loaded\n");
            return ItemSafe;
        }

        public static string InfoNIC() {
            Console.WriteLine("---------------- NIC ----------------\n - Loading");
            List<string> Item = new List<string>();
            ManagementObjectSearcher Searcher = new ManagementObjectSearcher("Select * from Win32_NetworkAdapter");
            foreach (ManagementObject data in Searcher.Get()) {
                Item.Add("START_ARRAY");
                try {
                    // Stuff
                } catch (ManagementException e) {
                    string errorMsg = "Error when getting NIC information:\n" + e.Message;
                    System.Windows.Forms.MessageBox.Show(errorMsg, "ScoreMyPC");
                    Environment.Exit(0);
                }
            }
            string ItemString = UnderScored.SysInfo.General.ArrayToString(Item);
            string ItemSafe = UnderScored.SysInfo.General.Base64Encode(ItemString);
            Console.WriteLine(" - Loaded\n");
            return ItemSafe;
        }

        public static string InfoHDD() {
            Console.WriteLine("---------------- HDD ----------------\n - Loading");
            List<string> Item = new List<string>();
			try {
				ManagementObjectSearcher Searcher = new ManagementObjectSearcher("Select * from Win32_LogicalDisk");
				foreach (ManagementObject data in Searcher.Get()) {
                    Item.Add("START_ARRAY");
                    try {
						// != null is used to prevent crashes when detecting disk drives which are empty
                        if (data.GetPropertyValue("Compressed") != null) {
                            Item.Add(data.GetPropertyValue("Compressed").ToString());
                        } else {
                            Item.Add("Unknown");
                        }
						Item.Add(data.GetPropertyValue("Description").ToString());
						Item.Add(data.GetPropertyValue("DeviceID").ToString());
                        if (data.GetPropertyValue("FileSystem") != null) {
                            Item.Add(data.GetPropertyValue("FileSystem").ToString());
                        } else {
                            Item.Add("Unknown");
                        }
                        if (data.GetPropertyValue("FreeSpace") != null) {
                            Item.Add(data.GetPropertyValue("FreeSpace").ToString());
                        } else {
                            Item.Add("0");
                        }
                        if (data.GetPropertyValue("Size") != null) {
                            Item.Add(data.GetPropertyValue("Size").ToString());
                        } else {
                            Item.Add("0");
                        }
                        if (data.GetPropertyValue("VolumeName") != null) {
                            Item.Add(data.GetPropertyValue("VolumeName").ToString());
                        } else {
                            Item.Add("Unknown");
                        }
                        Item.Add(data.GetPropertyValue("Caption").ToString());
					} catch (ManagementException e) {
						string errorMsg = "Error when getting HDD information:\n" + e.Message;
						System.Windows.Forms.MessageBox.Show(errorMsg, "ScoreMyPC");
						Environment.Exit(0);
					}
				}
			} catch (ManagementException e) {
                    string errorMsg = "Error when getting HDD information:\n" + e.Message;
                    System.Windows.Forms.MessageBox.Show(errorMsg, "ScoreMyPC");
                    Environment.Exit(0);
            }
            
            string ItemString = UnderScored.SysInfo.General.ArrayToString(Item);
            string ItemSafe = UnderScored.SysInfo.General.Base64Encode(ItemString);
            Console.WriteLine(" - Loaded\n");
            return ItemSafe;
        }

        public static string InfoINF() {
            Console.WriteLine("---------------- INF ----------------\n - Loading");
            List<string> Item = new List<string>();
            ManagementObjectSearcher Searcher = new ManagementObjectSearcher("Select * from Win32_OperatingSystem");
            foreach (ManagementObject data in Searcher.Get()) {
                Item.Add("START_ARRAY");
                try {
                    Item.Add(data.GetPropertyValue("Caption").ToString());
                    Item.Add(data.GetPropertyValue("CountryCode").ToString());
                    Item.Add(data.GetPropertyValue("InstallDate").ToString());
                    Item.Add(data.GetPropertyValue("OSArchitecture").ToString());
                    Item.Add(data.GetPropertyValue("NumberOfUsers").ToString());
                } catch (ManagementException e) {
                    string errorMsg = "Error when getting OS information:\n" + e.Message;
                    System.Windows.Forms.MessageBox.Show(errorMsg, "ScoreMyPC");
                    Environment.Exit(0);
                }
            }
            string ItemString = UnderScored.SysInfo.General.ArrayToString(Item);
            string ItemSafe = UnderScored.SysInfo.General.Base64Encode(ItemString);
            Console.WriteLine(" - Loaded\n");
            return ItemSafe;
        }
    }
}
