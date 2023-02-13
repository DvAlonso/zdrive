<?php

namespace App\Http\Livewire\Drive;

use App\Models\Folder;
use Livewire\Component;

class Index extends Component
{
    public $currentFolder;

    protected $listeners = ['refreshDrive' => '$refresh'];

    public function render()
    {
        $folders = $this->getFolders();

        return view('livewire.drive.index', [
            'folders' => $folders
        ]);
    }

    public function getFolders()
    {
        if ($this->currentFolder) {
            return Folder::where('parent_folder_id', $this->currentFolder->id)->get();
        }
        return Folder::where('parent_folder_id', null)->get();
    }
}
