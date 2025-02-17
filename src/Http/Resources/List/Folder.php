<?php

namespace DcodeGroup\Fileman\Http\Resources\List;

use Illuminate\Http\Resources\Json\JsonResource;

class Folder extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'url' => route(config('fileman.route_name').'.folder.index', $this->resource->id),
            'count' => $this->resource->files_count,
            'childrenCount' => count($this->resource->loadMissing('children')->children),
            'id' => $this->resource->id,
            'actions' => [
                'create' => [
                    'url' => route(config('fileman.api_route_name').'.folder.store', [
                        'parent' => $this->resource->id,
                    ]),
                    'label' => __('fileman.buttons.add_folder'),
                    'icon' => 'plus',
                    'action' => 'createFolder',
                ],
                'update' => [
                    'url' => route(config('fileman.api_route_name').'.folder.update', $this->resource->id),
                    'label' => __('fileman.buttons.rename_folder'),
                    'icon' => 'pencil',
                    'action' => 'renameFolder',
                ],
                'delete' => [
                    'url' => route(config('fileman.api_route_name').'.folder.destroy', $this->resource->id),
                    'label' => __('fileman.buttons.delete'),
                    'icon' => 'trash',
                    'action' => 'deleteFolder',
                ],
            ],
        ];
    }
}
