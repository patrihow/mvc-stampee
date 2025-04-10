<?php
namespace App\Models;

use App\Models\CRUD;

class Auction extends CRUD
{
    protected $table      = 'auction';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'name',
        'started_at',
        'finish_at',
        'starting_price',
        'lord_favorite',
        'stamp_id',
        'state_id',
    ];

    public function filter($filters)
    {
        $params = [];
        $sql = "SELECT 
            auction.id, auction.name,
            auction.started_at,
            auction.finish_at,
            auction.starting_price,
            auction.lord_favorite,
            auction.state_id,
            auction.stamp_id,
            stamp.name AS nameStamp,
            stamp.description,
            stamp.year,
            stamp.tirage,
            stamp.width,
            stamp.height,
            stamp.is_certified,
            stamp.color_id,
            stamp.user_id,
            stamp.country_id,
            stamp.theme_id,
            stamp.stamp_condition_id
            FROM auction 
            INNER JOIN stamp ON auction.stamp_id = stamp.id 
            WHERE true"; 
    
        
        if (!empty($filters["state_id"])) {
            $sql .= " AND auction.state_id = :state_id";
            $params["state_id"] = $filters["state_id"];
        }
    
        if (!empty($filters["lord_favorite"])) {
            $sql .= " AND auction.lord_favorite = :lord_favorite";
            $params["lord_favorite"] = $filters["lord_favorite"];
        }
        
        if (!empty($filters["minimum_price"])) {
            $sql .= " AND auction.starting_price >= :minimum_price";
            $params["minimum_price"] = $filters["minimum_price"];
        }
    
        if (!empty($filters["maximum_price"])) {
            $sql .= " AND auction.starting_price <= :maximum_price";
            $params["maximum_price"] = $filters["maximum_price"];
        }
    
        if (!empty($filters["minimum_date"])) {
            $sql .= " AND auction.started_at >= :minimum_date";
            $params["minimum_date"] = $filters["minimum_date"];
        }
    
        if (!empty($filters["maximum_date"])) {
            $sql .= " AND auction.finish_at <= :maximum_date";
            $params["maximum_date"] = $filters["maximum_date"];
        }
    
        $stmt = parent::prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
