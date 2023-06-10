<script>
 $(function(){
 
 function loadData(args) {
 //code
 $("#tampil").load("<?php echo site_url('peminjaman/tampil');?>");
 }
 loadData();
 
 function kosong(args) {
 //code
 $("#kode").val('');
 $("#judul").val('');
 $("#pengarang").val('');
 }
 
 $("#nim").click(function(){
 var nim=$("#nim").val();
 
 $.ajax({
 url:"<?php echo site_url('peminjaman/cariMahasiswa');?>",
 type:"POST",
 data:"nim="+nim,
 cache:false,
 success:function(html){
 $("#nama").val(html);
 }
 })
 })
 
 $("#kode").keypress(function(){
 var keycode = (event.keyCode ? event.keyCode : event.which);
 
 if(keycode == '13'){
 var kode=$("#kode").val();
 
 $.ajax({
 url:"<?php echo site_url('peminjaman/cariBuku');?>",
 type:"POST",
 data:"kode="+kode,
 cache:false,
 success:function(msg){
 data=msg.split("|");
 if (data==0) {
 alert("data tidak ditemukan");
 $("#judul").val('');
 $("#pengarang").val('');
 }else{
 $("#judul").val(data[0]);
 $("#pengarang").val(data[1]);
 $("#tambah").focus();
 }
 }
 })
 }
 })
 $("#tambah").click(function(){
    var kode=$("#kode").val();
    var judul=$("#judul").val();
    var pengarang=$("#pengarang").val();
    
    if (kode=="") {
    //code
    alert("Kode Buku Masih Kosong");
    return false;
    }else if (judul=="") {
    //code
    alert("Data tidak ditemukan");
    return false
    }else{
    $.ajax({
    url:"<?php echo site_url('peminjaman/tambah');?>",
    type:"POST",
    data:"kode="+kode+"&judul="+judul+"&pengarang="+pengarang,
    cache:false,
    success:function(html){
    loadData();
    kosong();
    }
    }) 
    }
    
    })
    
    
    $("#simpan").click(function(){
    var nomer=$("#no").val();
    var pinjam=$("#pinjam").val();
    var kembali=$("#kembali").val();
    var nim=$("#nim").val();
    var jumlah=parseInt($("#jumlahTmp").val(),10);
    
    if (nim=="") {
    alert("Pilih nim Siswa");
    return false;
    }else if (jumlah==0) {
    alert("pilih buku yang akan dipinjam");
    return false;
    }else{
    $.ajax({
    url:"<?php echo site_url('peminjaman/sukses');?>",
    type:"POST",
    data:"nomer="+nomer+"&pinjam="+pinjam+"&kembali="+kembali+"&nim="+nim+"&jumlah="+jumlah,
    cache:false,
    success:function(html){
    alert("Transaksi Peminjaman berhasil");
    location.reload();
    }
    })
    }
    
    })
    $(".hapus").live("click",function(){
        var kode=$(this).attr("kode");
        
        $.ajax({
        url:"<?php echo site_url('peminjaman/hapus');?>",
        type:"POST",
        data:"kode="+kode,
        cache:false,
        success:function(html){
        loadData();
        }
        });
        });
        
        $("#cari").click(function(){
        $("#myModal2").modal("show");
        })
        
        $("#caribuku").keyup(function(){
        var caribuku=$("#caribuku").val();
        
        $.ajax({
        url:"<?php echo site_url('peminjaman/pencarianbuku');?>",
        type:"POST",
        data:"caribuku="+caribuku,
        cache:false,
        success:function(html){
        $("#tampilbuku").html(html);
        }
        })
        })
        
        $(".tambah").live("click",function(){
        var kode=$(this).attr("kode");
        var judul=$(this).attr("judul");
        var pengarang=$(this).attr("pengarang");
        
        $("#kode").val(kode);
        $("#judul").val(judul);
        $("#pengarang").val(pengarang);
        
        $("#myModal2").modal("hide");
        })
        
        })
       </script>
       