<?php

namespace App\Repositories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Collection;

class CharacterRepository
{
    public function __construct(public Character $character)
    {
    }

    public function getCharacterAttributes(): array
    {
        $attributeDetails = [];
        $attributes = $this->character->characterAttributes()->get();
        foreach ($attributes as $attribute) {
            $details = $attribute->details()->first();
            $attributeDetails[$details->id] = [
                'name' => $details->name,
                'level' => $attribute->level,
                'dice' => $this->getAttributeDice($attribute->level)
            ];
        }

        return $attributeDetails;
    }

    private function getAttributeDice(int $level): string
    {
        return match (true) {
            $level >= 9 => 'd8',
            $level >= 6 => 'd6',
            default => 'd4'
        };
    }

    public function getAssociates(): Collection
    {
        return $this->character->associates()->get();
    }
}
