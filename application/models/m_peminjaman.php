<?php
class m_peminjaman extends CI_Model{
 private $table="peminjaman";
 
    function nootomatis(){
        $today=date('Ymd');
        $query=mysql_query("select max(id_peminjaman) as last from peminjaman where id_peminjaman like '$today%'");
        $data=mysql_fetch_array($query);
        $lastNoFaktur=$data['last'];
        $lastNoUrut=substr($lastNoFaktur,8,3);
        $nextNoUrut=$lastNoUrut+1;
        $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);

        return $nextNoTransaksi;
    }
    function getMhs() {
        return $this->db->get("mahasiswa");
     }
 
 function cariMahasiswa($nim){
 $this->db->where("nim",$nim);
 return $this->db->get("mahasiswa");
 }
 
 function cariBuku($kode){
 $this->db->where("kd_buku",$kode);
 return $this->db->get("buku");
 }
 
 function simpanTmp($info){
 $this->db->insert("tmp",$info);
 }
 
 function tampilTmp(){
 return $this->db->get("tmp");
 }
 
 function cekTmp($kode){
 $this->db->where("kd_buku",$kode);
 return $this->db->get("tmp");
 }
 
 function jumlahTmp(){
 return $this->db->count_all("tmp");
 }
 
 function hapusTmp($kode){
 $this->db->where("kd_buku",$kode);
 $this->db->delete("tmp");
 }
 
 function simpan($info){
 $this->db->insert("peminjaman",$info);
 }
 
 function pencarianbuku($cari){
 $this->db->like("judul",$cari);
 return $this->db->get("buku");
 }
 
}
