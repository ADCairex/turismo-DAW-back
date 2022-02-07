<?php

namespace App\Models;

use App\Entities\Reviews;
use CodeIgniter\Model;

class ReviewsModel extends Model
{
    protected $table            = 'reviews';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Reviews::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'description',
        'punctuation',
        'email',
        'restaurant_id',
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

    public function findReviewsByIdRestaurant($idRestaurant=null) {
        return $this->where(['restaurant_id' => $idRestaurant])
                    ->orderBy('created_at','desc')
                    ->findAll();
    }

    public function findReviewByIdReview($idReview=null) {
        return $this->where(['id' => $idReview])
                    ->first();
    }

    public function findReviewsByIdRestaurant_Email($idRestaurant=null, $email=null) {
        $condition = "email ='$email' AND restaurant_id=$idRestaurant";
        return $this->where($condition)
                    ->findAll();
    }

    public function getRestaurantAvg($idRestaurant=null) {
        return $this->where(['restaurant_id' => $idRestaurant])
                    ->selectAvg('punctuation', 'reviewAvg')
                    ->first();
    }

    public function getNumReviews($idRestaurant=null) {
        return $this->where(['restaurant_id' => $idRestaurant])
                    ->findAll();
    }
}
