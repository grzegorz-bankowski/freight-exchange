<?php

namespace App\Actions\Load;

use App\Classes\Database;

class ReservedLoads
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    
    public function __invoke(int $user)
    {
        $stmt = $this->db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed,  cityd, coded, countryd, trailer, weight, distance, currency, payrate, rate_per_km, description FROM loads WHERE reserved_by = :user");
        $stmt->execute(array(":user" => $user));
        if($stmt->rowCount() > 0){
            $loads = $stmt->fetchAll();
        } else {
            $loads = 0;
        }
        return $loads;
    }
}