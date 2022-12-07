<?php

namespace App\Models;

use App\Database\Migrations\KehadiranGuru;
use CodeIgniter\Model;

class KehadiranguruModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kehadiran_guru';
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
        $view = (new KehadiranguruModel())
        ->select('kehadiran_guru.*, pegawai.nama_depan, 
                 pegawai.nama_belakang, jadwal.hari,')
                ->join('pegawai', 'pegawai.id=pegawai_id')
                ->join('jadwal', 'jadwal.id=jadwal_id')
            
                          ->builder();

        $r = db_connect()->newQuery()->fromSubquery($view, 'tbl');
        $r->table = 'tbl';
        return $r;
    }
}
