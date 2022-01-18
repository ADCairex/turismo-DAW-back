<?php

namespace App\Models;

use App\Entities\Restaurants;
use CodeIgniter\Model;

class RestaurantsModel extends Model
{
    protected $table            = 'restaurants';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Restaurants::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'description',
        'address',
        'latitutde',
        'longitude',
        'reviewAverage',
        'numReviews'
    ];

    // Dates
    protected $useTimestamps = true;
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

    public function findRestaurants($id=null) {
        if(is_null($id)) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])
                    ->first();
    }

    public function getAVG($id=null) {
        $this->select('reviewAverage');
    }

    public function calculateNumReviews($id=null) {

    }
}
