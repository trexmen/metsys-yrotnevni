//mendeksripsikan variabel yang akan digunakan
var nota;
var tgl_pemesanan;
var id_barang;
var nama_barang;
var harga_jual;
var jumlah;
var stok;

function alertShow(body)
{
    $("#myModal").modal('show');
    $.post('',
        function(html){
            $(".modal-title").html("Pesan");   
            $(".modal-body").html(body);                                 
        }   
    );
}


$(document).ready(function(){
       
});

$(function(){
    //meload file pk dengan operator ambil barang dimana nantinya
    //isinya akan masuk di combo box
    $("#id_barang").load("modul/transaksi-penjualan/ambil-simpan-data.php","op=ambilbarang");
    
    //meload isi tabel
    $("#barang").load("modul/transaksi-penjualan/ambil-simpan-data.php","op=barang");
    
    //mengkosongkan input text dengan masing2 id berikut
    $("#nama_barang").val("");
    $("#harga_jual").val("");
    $("#jumlah").val("");
    $("#stok").val("");
                
    //jika ada perubahan di id_barang
    $("#id_barang").change(function(){
        id_barang=$("#id_barang").val();
        
        //tampilkan status loading dan animasinya
        //$("#status").html("loading. . .");
        //$("#loading").show();
        
        //lakukan pengiriman data
        $.ajax({
            url:"modul/transaksi-penjualan/ambil-simpan-data.php",
            data:"op=ambildatabarang&id_barang="+id_barang,
            cache:false,
            success:function(msg){
                data=msg.split("|");
                
                //masukan isi data ke masing - masing field
                $("#nama_barang").val(data[0]);
                $("#harga_jual").val(data[1]);
                $("#stok").val(data[2]);
                $("#jumlah").focus();
                //hilangkan status animasi dan loading
                $("#status").html("");
                $("#loading").hide();
            }
        });
    });

    $("#jumlah").keypress(function (e) {

         if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            alertShow("Maaf, hanya inputkan angka..");            
            return false;
            $("#jumlah").focus();
        }

    });
    
    //jika tombol tambah di klik
    $("#tambah").click(function(){
        id_barang=$("#id_barang").val();
        stok=parseInt($("#stok").val());
        // alert(stok);
        jumlah=parseInt($("#jumlah").val());
        //alert(jumlah);
        if(id_barang=="--Pilih Barang--"){
            alertShow("Maaf, Barang belum dipilih..");
            exit();
        }
        else if(jumlah > stok){
            alertShow("Maaf, Stok tidak terpenuhi..");
            $("#jumlah").val(stok);
            $("#jumlah").focus();
            exit();
        } 
        else if(isNaN(jumlah)){
            alertShow("Maaf, Jumlah beli tidak boleh kosong..");
            $("#jumlah").focus();
            exit();
        }
        else{        
            nama_barang=$("#nama_barang").val();
            harga_jual=$("#harga_jual").val();
            
                                    
            //$("#status").html("sedang diproses. . .");
            //$("#loading").show();
            
            $.ajax({
                url:"modul/transaksi-penjualan/doProcess.php",
                data:"aksi=tambah&id_barang="+id_barang+"&nama_barang="+nama_barang+"&harga_jual="+harga_jual+"&jumlah="+jumlah,
                cache:false,
                success:function(msg){
                    if(msg=="sukses"){
                        //$("#status").html("Berhasil disimpan. . .");
                    }else{
                        //$("#status").html("");//ERROR...
                    }
                    $("#loading").hide();
                    $("#nama_barang").val("");
                    $("#harga_jual").val("");
                    $("#jumlah").val("");
                    $("#stok").val("");
                    $("#id_barang").load("modul/transaksi-penjualan/ambil-simpan-data.php","op=ambilbarang");
                    $("#barang").load("modul/transaksi-penjualan/ambil-simpan-data.php","op=barang");
                    alertEdit();
                }
            });
        }
    });
    
    
    //jika tombol proses diklik
    $("#proses").click(function(){
        nota=$("#id_penjualan").val();
        tgl_pemesanan=$("#tgl_pemesanan").val();
        id_pelanggan=$("#id_pelanggan").val();
        id_karyawan=$("#id_karyawan").val();
        minggu=$("#minggu").val();
        total=$("#total").val();
        
        if(id_pelanggan=='')
        {
            alertShow("Maaf, Pelanggan belum dipilih..");
            $("#id_pelanggan").focus();
            exit();
        }
        $.ajax({
            url:"modul/transaksi-penjualan/ambil-simpan-data.php",
            data:"op=simpan&nota="+nota+"&tgl_pemesanan="+tgl_pemesanan+"&id_pelanggan="+id_pelanggan+"&id_karyawan="+id_karyawan+"&minggu="+minggu+"&total="+total,
            cache:false,
            success:function(msg){
                if(msg != "sukses"){
                    //nagmbil data dari <span id='status'>
                    //$("#status").html('Transaksi Penjualan berhasil');
                    //alertShow("Transaksi Berhasil..");
                    window.location='media.php?module=print-data&id='+nota;
                    exit();
                }
                else{
                    //$("#status").html('Transaksi Gagal');
                    alertShow("Transaksi Gagal..");
                    exit();
                }
                $("#id_barang").load("modul/transaksi-penjualan/ambil-simpan-data.php","op=ambilbarang");
                $("#barang").load("modul/transaksi-penjualan/ambil-simpan-data.php","op=barang");
                $("#loading").hide();
                $("#nama_barang").val("");
                $("#harga_jual").val("");
                $("#jumlah").val("");
                $("#stok").val("");
            }
        })
    });  
});

// TRANSAKSI PURCHASING

var pcs_nota;
var pcs_tgl_pengajuan;
var pcs_id_barang;
var pcs_nama_barang;
var pcs_harga_beli;
var pcs_jumlah;
var pcs_stok;


$(function(){
    //meload file pk dengan operator ambil barang dimana nantinya
    //isinya akan masuk di combo box
    $("#pcs_id_barang").load("modul/request-pembelian/ambil-simpan-data.php","op=ambilbarang");
    
    //meload isi tabel
    $("#pcs_barang").load("modul/request-pembelian/ambil-simpan-data.php","op=barang");
    
    //mengkosongkan input text dengan masing2 id berikut
    $("#pcs_nama_barang").val("");
    $("#pcs_harga_beli").val("");
    $("#pcs_jumlah").val("");
    $("#pcs_stok").val("");
                
    //jika ada perubahan di id_barang
    $("#pcs_id_barang").change(function(){
        pcs_id_barang=$("#pcs_id_barang").val();
        
        //tampilkan status loading dan animasinya
        //$("#status").html("loading. . .");
        //$("#loading").show();
        
        //lakukan pengiriman data
        $.ajax({
            url:"modul/request-pembelian/ambil-simpan-data.php",
            data:"op=ambildatabarang&id_barang="+pcs_id_barang,
            cache:false,
            success:function(msg){
                data=msg.split("|");
                
                //masukan isi data ke masing - masing field
                $("#pcs_nama_barang").val(data[0]);
                $("#pcs_harga_beli").val(data[1]);
                $("#pcs_stok").val(data[2]);
                $("#pcs_jumlah").focus();
                //hilangkan status animasi dan loading
                $("#pcs_status").html("");
                $("#pcs_loading").hide();
            }
        });
    });

    $("#pcs_jumlah").keypress(function (e) {

         if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            alertShow("Maaf, hanya inputkan angka..");            
            return false;
            $("#pcs_jumlah").focus();
        }

    });
    
    //jika tombol tambah di klik
    $("#pcs_tambah").click(function(){
        pcs_id_barang=$("#pcs_id_barang").val();
        pcs_stok=parseInt($("#pcs_stok").val());
        // alert(stok);
        pcs_jumlah=parseInt($("#pcs_jumlah").val());
        //alert(jumlah);
        if(pcs_id_barang=="--Pilih Barang--"){
            alertShow("Maaf, Barang belum dipilih..");
            exit();
        }
        else if(pcs_jumlah > pcs_stok){
            alertShow("Maaf, Stok tidak terpenuhi..");
            $("#pcs_jumlah").val(stok);
            $("#pcs_jumlah").focus();
            exit();
        } 
        else if(isNaN(pcs_jumlah)){
            alertShow("Maaf, Jumlah beli tidak boleh kosong..");
            $("#pcs_jumlah").focus();
            exit();
        }
        else{        
            pcs_nama_barang=$("#pcs_nama_barang").val();
            pcs_harga_beli=$("#pcs_harga_beli").val();
            
                                    
            //$("#status").html("sedang diproses. . .");
            //$("#loading").show();
            
            $.ajax({
                url:"modul/request-pembelian/doProcess.php",
                data:"aksi=tambah&id_barang="+pcs_id_barang+"&nama_barang="+pcs_nama_barang+"&harga_beli="+pcs_harga_beli+"&jumlah="+pcs_jumlah,
                cache:false,
                success:function(msg){
                    if(msg=="sukses"){
                        //$("#status").html("Berhasil disimpan. . .");
                    }else{
                        //$("#status").html("");//ERROR...
                    }
                    $("#pcs_loading").hide();
                    $("#pcs_nama_barang").val("");
                    $("#pcs_harga_beli").val("");
                    $("#pcs_jumlah").val("");
                    $("#pcs_stok").val("");
                    $("#pcs_id_barang").load("modul/request-pembelian/ambil-simpan-data.php","op=ambilbarang");
                    $("#pcs_barang").load("modul/request-pembelian/ambil-simpan-data.php","op=barang");
                    alertEdit();
                }
            });
        }
    });
    
    
    //jika tombol proses diklik
    $("#pcs_proses").click(function(){
        pcs_nota=$("#pcs_id_pembelian").val();
        pcs_tgl_pengajuan=$("#pcs_tgl_pengajuan").val();
        pcs_id_supplier=$("#pcs_id_supplier").val();
        pcs_id_karyawan=$("#pcs_id_karyawan").val();
        pcs_minggu=$("#pcs_minggu").val();
        pcs_total=$("#pcs_total").val();
        
        if(pcs_id_supplier=='')
        {
            alertShow("Maaf, Supplier belum dipilih..");
            $("#pcs_id_supplier").focus();
            exit();
        }
        $.ajax({
            url:"modul/request-pembelian/ambil-simpan-data.php",
            data:"op=simpan&nota="+pcs_nota+"&tgl_pemesanan="+pcs_tgl_pengajuan+"&id_supplier="+pcs_id_supplier+"&id_karyawan="+pcs_id_karyawan+"&minggu="+pcs_minggu+"&total="+pcs_total,
            cache:false,
            success:function(msg){
                if(msg != "sukses"){
                    //nagmbil data dari <span id='status'>
                    //$("#status").html('Transaksi Penjualan berhasil');
                    //alertShow("Transaksi Berhasil..");
                    window.location='media.php?module=print-data&id='+pcs_nota;
                    exit();
                }
                else{
                    //$("#status").html('Transaksi Gagal');
                    alertShow("Transaksi Gagal..");
                    exit();
                }
                $("#pcs_id_barang").load("modul/request-pembelian/ambil-simpan-data.php","op=ambilbarang");
                $("#pcs_barang").load("modul/request-pembelian/ambil-simpan-data.php","op=barang");
                $("#pcs_loading").hide();
                $("#pcs_nama_barang").val("");
                $("#pcs_harga_beli").val("");
                $("#pcs_jumlah").val("");
                $("#pcs_stok").val("");
            }
        })
    });  
});