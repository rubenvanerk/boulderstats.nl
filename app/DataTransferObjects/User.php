<?php

namespace App\DataTransferObjects;

use Illuminate\Support\Collection;
use Livewire\Wireable;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class User extends DataTransferObject implements Wireable
{
    public string $id;

    public string $uid;

    #[MapFrom('full_name')]
    public string $fullName;

    public ?string $gender;

    public ?string $avatar;

    public ?UserStats $stats = null;

    public ?Collection $ascends = null;

    public function toLivewire()
    {
        return $this->toArray();
    }

    public static function fromLivewire($value)
    {
        return UserFactory::make($value);
    }
}
