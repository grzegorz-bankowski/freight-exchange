<?php

namespace App\Actions\Vehicle;

use App\Classes\Database;

class PreviewVehicle
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function __invoke(int $id): array
    {
        $stmt = $this->db->connection->prepare("SELECT vehicles.id, vehicles.user_id, vehicles.places, DATE_FORMAT(vehicles.dates, '%d-%m-%Y') AS formatted_dates, DATE_FORMAT(vehicles.dates, '%H:%i') AS formatted_times, vehicles.streets, vehicles.citys, vehicles.codes, vehicles.countrys, DATE_FORMAT(vehicles.dated, '%d-%m-%Y') AS formatted_dated, DATE_FORMAT(vehicles.dated, '%H:%i') AS formatted_timed, vehicles.placed, vehicles.cityd, vehicles.coded, vehicles.streetd, vehicles.countryd, vehicles.trailer, vehicles.weight, vehicles.type_of_good, vehicles.number_of_package, vehicles.type_of_package, vehicles.distance, vehicles.payrate, vehicles.currency, vehicles.rate_per_km, vehicles.description, users.phone, users.email, users.website FROM vehicles INNER JOIN users ON vehicles.user_id = users.id WHERE vehicles.id = :id");
        $status = $stmt->execute([':id' => $id]);
        $vehicle = $stmt->fetch();
        $origin = $vehicle['codes'] . " " . $vehicle['citys'] . ", " . $vehicle['countrys'];

        if ($status) {
            $status = true;
        } else {
            $status = false;
        }

        return [
            'vehicle' => $vehicle,
            'status' => $status,
            'origin' => $origin
        ];
    }
}