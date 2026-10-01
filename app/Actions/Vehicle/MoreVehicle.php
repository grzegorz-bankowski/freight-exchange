<?php

namespace App\Actions\Vehicle;

use App\Classes\Database;

class MoreVehicle
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id)
    {
        $stmt = $this->db->connection->prepare("SELECT vehicles.id, vehicles.user_id, vehicles.places, vehicles.citys, vehicles.codes, vehicles.countrys, vehicles.streets, vehicles.dates, vehicles.times, vehicles.placed, vehicles.countryd, vehicles.cityd, vehicles.coded, vehicles.streetd,  vehicles.dated, vehicles.timed, vehicles.trailer, vehicles.weight, vehicles.type_of_good, vehicles.number_of_package, vehicles.type_of_package, vehicles.distance, vehicles.payrate, vehicles.rate_per_km, vehicles.description, users.phone, users.email, users.website FROM vehicles INNER JOIN users ON vehicles.user_id = users.id WHERE vehicles.id = :id");
        $stmt->execute(array(":id" => $id));
        $vehicle = $stmt->fetch();
        return $vehicle;
    }
}