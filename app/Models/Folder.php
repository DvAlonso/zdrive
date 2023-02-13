<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class Folder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'uuid',
        'parent_folder_id'
    ];

    public function parentFolder()
    {
        return $this->belongsTo(Folder::class, 'parent_folder_id');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function isRoot()
    {
        return is_null($this->parent_folder_id);
    }

    public function isChild()
    {
        return !is_null($this->parent_folder_id);
    }

    public function getParentUrl()
    {
        if ($this->isRoot()) {
            return route('drive');
        }

        return route('drive.folder', $this->parentFolder);
    }

    public function getBreadCrumbs()
    {
        $array = [
            ['name' => $this->name, 'url' => route('drive.folder', $this)]
        ];
        self::getParentFolders($this, $array);
        array_push($array, [
            'name' => 'My drive',
            'url' => route('drive')
        ]);

        return array_reverse($array);
    }

    public static function getParentFolders(Folder $folder, &$data)
    {
        if ($folder->isChild()) {
            array_push ($data, [
                'name' => $folder->parentFolder->name,
                'url' => route('drive.folder', $folder->parentFolder)
            ]);
            self::getParentFolders($folder->parentFolder, $data);
        }

        return $data;
    }
}
