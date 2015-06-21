<?php
	function getModule($module){
				switch ($module){
					case "home": 
						return "Dashboard";
						break;
					case "data-jabatan":
						return "Data Jabatan";
						break;
					case "manajemen-user":
						return "Manajemen User";
						break;
					case "update-profil":
						return "Update Profil";
						break;
					case "data-barang":
						return "Data Barang";
						break;
					case "data-penjualan":
						return "Data Penjualan";
						break;
					case "transaksi-penjualan":
						break;
					case "request-pembelian":
						return "Request Pembelian";
						break;							
					case "data-purchasing":
						return "Data Purchasing";
						break;
					case "data-pengiriman":
						return "Data Pengiriman Barang";
						break;
					case "data-supplier":
						return "Data Supplier";
						break;
					case "data-pelanggan":
						return "Data Pelanggan";
						break;
					case "data-kategori":
						return "Data Kategori";
						break;
					case "data-satuan":
						return "Data Satuan";
						break;
					case "data-driver":
						return "Data Driver";
						break;
					case "data-kendaraan":
						return "Data Kendaraan";
						break;
					case "print-data":
						return "Print Data";
						break;
					default :
						return "Page Not Found";
						break;
				}
			} 
?>
