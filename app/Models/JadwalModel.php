<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jadwal';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public static function view(){
        $view = (new JadwalModel())
        ->select("jadwal.*, kelas.kelas, kelas.tingkat, mapel.mapel, pegawai.nama_depan, pegawai.nama_belakang as pegawai")
                ->join('kelas', 'jadwal.kelas_id=kelas.id', 'left')
                ->join('mapel', 'jadwal.mapel_id=mapel.id', 'left')
                ->join('pegawai', 'pegawai.id=jadwal.pegawai_id', 'left')
     
                ->builder();

        $r = db_connect()->newQuery()->fromSubquery($view, 'tbl');
        $r->table = 'tbl';
        return $r;
    }
}
