<?php

namespace App\Http\Livewire;

use App\Enumerations\AssociatesEnum;
use App\Models\Character;
use App\Models\CharacterAssociate;
use App\Repositories\CharacterRepository;
use App\Schemas\PlanetSchema;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CharacterSheet extends Component
{
    public int $characterId = 0;
    public string $newAssocName = '';
    public string $newAssocType = '';
    public string $newAssocWho = '';
    public string $newAssocHow = '';
    public array $homeSystem;
    public Character $character;
    public array $associateTypes = [];
    public Collection $associates;
    protected CharacterRepository $characterRepository;
    public array $characterAttributes;

    protected $listeners = [
        'addAssociate'
    ];

    public function getDetails()
    {
        $this->character = Character::find($this->characterId);
        $this->homeSystem = PlanetSchema::getSystem(
            $this->character->home_lat,
            $this->character->home_long
        );
        $this->characterRepository = new CharacterRepository($this->character);
        $this->associateTypes = AssociatesEnum::associateTypes();
        $this->associates = $this->characterRepository->getAssociates();
        $this->characterAttributes = $this->characterRepository->getCharacterAttributes();
    }

    public function render()
    {
        $this->getDetails();

        return view('livewire.character-sheet');
    }

    public function addAssociate(): void
    {
        $this->validate(
            [
                'newAssocName' => 'required|min:1|max:200',
                'newAssocType' => 'required|min:1|max:50',
            ]
        );

        $assoc = new CharacterAssociate([
            'character_id' => $this->characterId,
            'name' => $this->newAssocName,
            'type' => $this->newAssocType,
            'who' => $this->newAssocWho,
            'how' => $this->newAssocHow,
        ]);
        $assoc->save();

        $this->newAssocName = '';
        $this->newAssocType = '';
        $this->newAssocWho = '';
        $this->newAssocHow = '';

        $this->dispatchBrowserEvent('close-assoc-modal');
        $this->getDetails();
    }
}
