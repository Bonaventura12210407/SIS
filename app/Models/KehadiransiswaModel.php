<?php

namespace App\Models;

use CodeIgniter\Model;

class KehadiransiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kehadiran_siswa';
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

    static function view(){
        $view = (new KehadiransiswaModel())
        ->select('kehadiran_siswa.*, kehadiran_guru.waktu_masuk ,
        kehadiran_guru.waktu_keluar , siswa.nis, siswa.nama_depan as siswa')
                ->join('kehadiran_guru', 'kehadiran_guru.id=kehadiran_guru_id')
                ->join('siswa', 'siswa.id=siswa_id')
                ->builder();

                $r = db_connect()->newQuery()->fromSubquery($view, 'tbl');
                $r->table = 'tbl';
                return $r;
    }
}
