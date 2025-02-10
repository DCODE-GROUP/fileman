<?php

namespace DcodeGroup\Fileman\Http\Resources\List;

use Illuminate\Http\Resources\Json\JsonResource;

class Folder extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'url' => route('fileman.folder.index', $this->resource->id),
            'count' => $this->resource->files_count,
            'childrenCount' => count($this->resource->loadMissing('children')->children),
            'id' => $this->resource->id,
            'actions' => [
                'create' => [
                    'url' => route('api.fileman.folder.store', [
                        'parent' => $this->resource->id,
                    ]),
                    'label' => __('fileman.buttons.add_folder'),
                    'icon' => 'plus',
                    'action' => 'createFolder',
                ],
                'update' => [
                    'url' => route('api.fileman.folder.update', $this->resource->id),
                    'label' => __('fileman.buttons.rename_folder'),
                    'icon' => 'pencil',
                    'action' => 'renameFolder',
                ],
                'delete' => [
                    'url' => route('api.fileman.folder.destroy', $this->resource->id),
                    'label' => __('fileman.buttons.delete'),
                    'icon' => 'trash',
                    'action' => 'deleteFolder',
                ],
            ],
        ];
    }
}
