<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan_model extends CI_Model
{

    public $table = 'karyawan';
    public $id = 'karyawan_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->join('pekerjaan', 'pekerjaan.pekerjaan_id = karyawan.pekerjaan_id', 'left');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('karyawan_id', $q);
	$this->db->or_like('nik', $q);
	$this->db->or_like('nama_karyawan', $q);
	$this->db->or_like('pekerjaan_id', $q);
	$this->db->or_like('jabatan', $q);
	$this->db->or_like('jenis_kelamin', $q);
	$this->db->or_like('no_telpon', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }


    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function insert_pemenang($data)
    {
        $this->db->insert('pemenang', $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function karyawan_belum_menang() {
        $query = "SELECT karyawan.karyawan_id as 'karyawan_id', karyawan.nama_karyawan as 'nama_karyawan' FROM `karyawan` LEFT JOIN `pemenang` ON pemenang.karyawan_id = karyawan.karyawan_id WHERE pemenang.karyawan_id IS NULL;";

        return $this->db->query($query)->result();
    }

    function list_pemenang() {
        $query = "SELECT karyawan.karyawan_id as 'karyawan_id', karyawan.nama_karyawan as 'nama_karyawan' FROM `pemenang` JOIN `karyawan` ON karyawan.karyawan_id = pemenang.karyawan_id ORDER BY pemenang.timestamp DESC;";
        return $this->db->query($query)->result();
    }

    function delete_pemenang($id) {
        $this->db->where('karyawan_id', $id);
        $this->db->delete('pemenang');
    }

    function delete_all() {
        $this->db->empty_table('pemenang');
    }

}