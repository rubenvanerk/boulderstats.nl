<?php

namespace App\DataTransferObjects;

use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class User extends DataTransferObject
{
    public string $id;

    public string $uid;

    #[MapFrom('full_name')]
    public string $fullName;

    public ?string $gender;

    public ?string $avatar;

    public ?UserStats $stats = null;

    public ?Collection $ascends = null;
}
