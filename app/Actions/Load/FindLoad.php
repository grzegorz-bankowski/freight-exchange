<?php

namespace App\Actions\Load;

use App\Classes\Database;

class FindLoad
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id, array $arguments)
    {
        $stmt = $this->db->connection->prepare("SELECT id, user_id, dates, times, citys, codes, countrys, dated, timed, streetd, cityd, coded, countryd, trailer, weight, distance, payrate, currency, rate_per_km, description FROM loads WHERE reserved = :no AND countrys LIKE :origin AND citys LIKE :start_city AND countryd LIKE :destination AND cityd LIKE :end_city AND trailer LIKE :trailer AND NOT user_id = :user AND weight BETWEEN :weight_min AND :weight_max LIMIT :limit OFFSET :offset");
        $stmt->execute(['no', "%$arguments[0]", "%$arguments[1]", "%$arguments[2]", "%$arguments[3]", "%$arguments[4]%", $id, $arguments[5], $arguments[6], $arguments[7], $arguments[8]]);
        if ($stmt->rowCount() > 0) {
            $loads = $stmt->fetchAll();
        } else {
            $loads = 0;
        }

        $stmt2 = $this->db->connection->prepare("SELECT COUNT(id) FROM loads WHERE reserved = :no AND countrys LIKE :origin AND citys LIKE :start_city AND countryd LIKE :destination AND cityd LIKE :end_city AND trailer LIKE :trailer AND NOT user_id = :user AND weight BETWEEN :weight_min AND :weight_max");
        $stmt2->execute(['no', "%$arguments[0]", "%$arguments[1]", "%$arguments[2]", "%$arguments[3]", "%$arguments[4]%", $id, $arguments[5], $arguments[6]]);
        if ($stmt2->rowCount() > 0) {
            $total = $stmt2->fetchColumn();
        } else {
            $total = 0;
        }
        return [
            'loads' => $loads,
            'total' => $total
        ];
    }
}