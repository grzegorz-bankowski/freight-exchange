<?php

namespace App\Actions\Load;

use App\Classes\Database;

class PreviewLoad
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id): array
    {
        $stmt = $this->db->connection->prepare("SELECT loads.id, loads.user_id, loads.dates, loads.times, loads.places, loads.streets, loads.citys, loads.codes, loads.countrys, loads.dated, loads.timed, loads.placed, loads.streetd, loads.cityd, loads.coded, loads.countryd, loads.trailer, loads.weight, loads.type_of_good, loads.number_of_package, loads.type_of_package, loads.distance, loads.payrate, loads.currency, loads.rate_per_km, loads.description, users.phone, users.email, users.website FROM loads INNER JOIN users ON loads.user_id = users.id WHERE loads.id = :id");
        $status = $stmt->execute(array("id" => $id));
        $load = $stmt->fetch();
        $origin = $load['streets'] . ", " . $load['codes'] . " " . $load['citys'];
        $destination = $load['streetd'] . ", " . $load['coded'] . " " . $load['cityd'];

        if ($status) {
            $status = true;
        } else {
            $status = false;
        }

        return [
            'load' => $load,
            'status' => $status,
            'origin' => $origin,
            'destination' => $destination
        ];
    }
}