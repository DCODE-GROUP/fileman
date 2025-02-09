<?php
namespace DcodeGroup\Fileman\Http\Resources\List;
use Illuminate\Http\Resources\Json\JsonResource;

class Folder extends JsonResource{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'url' => route('fileman.folder.index', $this->id),
            'count' => $this->files_count,
            'childrenCount' => count($this->loadMissing('children')->children),
            'id' => $this->id,
            'actions' => [
                'create'=>[
                    'url'=>route('api.fileman.folder.store', [
                        'parent' => $this->id
                    ]),
                    'label'=>__('fileman.buttons.add_folder'),
                    'icon'=>'plus',
                    'action'=>'createFolder'
                ],
                'update'=>[
                    'url'=>route('api.fileman.folder.update', $this->id),
                    'label'=>__('fileman.buttons.rename_folder'),
                    'icon'=>'pencil',
                    'action'=>'renameFolder'
                ],
                'delete'=>[
                    'url'=>route('api.fileman.folder.destroy', $this->id),
                    'label'=>__('fileman.buttons.delete'),
                    'icon'=>'trash',
                    'action'=>'deleteFolder'
                ]
            ]
        ];
    }
}
