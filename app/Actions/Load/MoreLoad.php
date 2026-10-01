<?php

namespace App\Actions\Load;

use App\Classes\Database;

class MoreLoad
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id)
    {
        $stmt = $this->db->connection->prepare("SELECT loads.id, loads.user_id, loads.places, loads.citys, loads.codes, loads.countrys, loads.streets, loads.dates, loads.times, loads.placed, loads.countryd, loads.cityd, loads.coded, loads.streetd,  loads.dated, loads.timed, loads.trailer, loads.weight, loads.type_of_good, loads.number_of_package, loads.type_of_package, loads.distance, loads.payrate, loads.rate_per_km, loads.description, users.phone, users.email, users.website FROM loads INNER JOIN users ON loads.user_id = users.id WHERE loads.id = :id");
        $stmt->execute(array(":id" => $id));
        $load = $stmt->fetch();
        return $load;
    }
}