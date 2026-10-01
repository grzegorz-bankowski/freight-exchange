<?php

namespace App\Actions\Vehicle;

use App\Classes\Database;

class FindVehicle
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id, array $arguments)
    {        
        $stmt = $this->db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed, cityd, coded, countryd, trailer, weight, distance, payrate, currency, rate_per_km, description FROM vehicles WHERE reserved = :no AND countrys LIKE :origin AND citys LIKE :start_city AND countryd LIKE :destination AND cityd LIKE :end_city AND trailer LIKE :trailer AND NOT user_id = :user AND weight BETWEEN :weight_min AND :weight_max LIMIT :limit OFFSET :offset");
        $stmt->execute(['no', "%$arguments[0]", "%$arguments[1]", "%$arguments[2]", "%$arguments[3]", $id, $arguments[4], $arguments[5], $arguments[6], $arguments[7], $arguments[8]]);
        if ($stmt->rowCount() > 0) {
            $vehicles = $stmt->fetchAll();
        } else {
            $vehicles = 0;
        }

        $stmt2 = $this->db->connection->prepare("SELECT COUNT(id) FROM vehicles WHERE reserved = :no AND countrys LIKE :origin AND citys LIKE :start_city AND countryd LIKE :destination AND cityd LIKE :end_city AND trailer LIKE :trailer AND NOT user_id = :user AND weight BETWEEN :weight_min AND :weight_max");
        $stmt2->execute(['no', "%$arguments[0]", "%$arguments[1]", "%$arguments[2]", "%$arguments[3]", $id, $arguments[4], $arguments[5], $arguments[6]]);
        if ($stmt2->rowCount() > 0) {
            $total = $stmt2->fetchColumn();
        } else {
            $total = 0;
        }

        return [
            'vehicles' => $vehicles,
            'total' => $total
        ];
    }
}