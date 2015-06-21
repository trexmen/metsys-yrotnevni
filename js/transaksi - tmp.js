//mendeksripsikan variabel yang akan digunakan
var nota;
var tgl_pemesanan;
var id_barang;
var nama_barang;
var harga_jual;
var jumlah;
var stok;
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
        $("#status").html("loading. . .");
        $("#loading").show();
        
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
    
    //jika tombol tambah di klik
    $("#tambah").click(function(){
        id_barang=$("#id_barang").val();
        stok=parseInt($("#stok").val());
        // alert(stok);
        jumlah=parseInt($("#jumlah").val());
        //alert(jumlah);
        if(id_barang=="--Pilih Barang--"){
            alert("Barang belum dipilih");
            exit();
        }
        else if(jumlah > stok){
            alert("Stok tidak terpenuhi");
            $("#jumlah").focus();
            exit();
        } 
        else if(isNaN(jumlah)){
            alert("Jumlah beli tidak boleh 0");
            $("#jumlah").focus();
            exit();
        }
        else{        
            nama_barang=$("#nama_barang").val();
            harga_jual=$("#harga_jual").val();
            
                                    
            $("#status").html("sedang diproses. . .");
            $("#loading").show();
            
            $.ajax({
                url:"modul/transaksi-penjualan/ambil-simpan-data.php",
                data:"op=tambah&id_barang="+id_barang+"&nama_barang="+nama_barang+"&harga_jual="+harga_jual+"&jumlah="+jumlah,
                cache:false,
                success:function(msg){
                    if(msg=="sukses"){
                        $("#status").html("Berhasil disimpan. . .");
                    }else{
                        $("#status").html("");//ERROR...
                    }
                    $("#loading").hide();
                    $("#nama_barang").val("");
                    $("#harga_jual").val("");
                    $("#jumlah").val("");
                    $("#stok").val("");
                    $("#id_barang").load("modul/transaksi-penjualan/ambil-simpan-data.php","op=ambilbarang_tmp");
                    $("#barang").load("modul/transaksi-penjualan/ambil-simpan-data.php","op=barang");
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
        
        if(id_pelanggan=='')
        {
            alert('Pelanggan Belum Dipilih');
            exit();
        }
        $.ajax({
            url:"modul/transaksi-penjualan/ambil-simpan-data.php",
            data:"op=simpan&nota="+nota+"&tgl_pemesanan="+tgl_pemesanan+"&id_pelanggan="+id_pelanggan+"&id_karyawan="+id_karyawan+"&minggu="+minggu,
            cache:false,
            success:function(msg){
                if(msg != "sukses"){
                    //nagmbil data dari <span id='status'>
                    $("#status").html('Transaksi Penjualan berhasil');
                    alert('Transaksi Berhasil : '+msg);
                    window.location='media.php?module=print-data&id='+nota;
                    exit();
                }
                else{
                    $("#status").html('Transaksi Gagal');
                    alert('Transaksi Gagal');
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

    $("#jum").on("keyup",function(){
        //meload isi tabel
        //$("#barang").load("modul/transaksi-penjualan/ambil-simpan-data.php","op=barang");
        alert('tes');
        var id_barang = "P0001";//$("#id_barang").val('P0001');
        var jumlah = $("#jum").val();
        $.ajax({
            url:"modul/transaksi-penjualan/ambil-simpan-data.php",
            data:"op=update&id_barang="+id_barang+"&jumlah="+jumlah,
            cache:false,
            success:function(msg){
                if(msg!="sukses"){
                    //nagmbil data dari <span id='status'>
                    $("#status").html('Transaksi Penjualan Tmp berhasil');
                    alert('Transaksi Berhasil'+msg+' '+id_barang+' '+jumlah);
                    //window.location='media.php?module=transaksi-penjualan';
                    exit();
                }else{
                    $("#status").html('Transaksi Gagal');
                    alert('update Gagal');
                    exit();
                }
                // $("#id_barang").load("modul/transaksi-penjualan/ambil-simpan-data.php","op=ambilbarang");
                // $("#barang").load("modul/transaksi-penjualan/ambil-simpan-data.php","op=barang");
            }
        })
    });
});