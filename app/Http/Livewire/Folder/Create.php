<?php

namespace App\Http\Livewire\Folder;

use App\Models\Folder;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $currentFolder;
    public string $folder_name;

    protected $rules = [
        'folder_name' => ['required', 'string']
    ];

    public function render()
    {
        return view('livewire.folder.create');
    }

    public function submit()
    {
        $this->validate();

        Folder::create([
            'name' => $this->folder_name,
            'uuid' => Str::uuid(),
            'parent_folder_id' => $this->currentFolder ? $this->currentFolder->id :  null,
        ]);

        $this->emit('refreshDrive');
    }
}
