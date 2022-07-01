<?php

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class Gym extends DataTransferObject
{
    public string $id;

    #[MapFrom('id_name')]
    public string $idName;

    public string $name;

    public ?string $city;
}
