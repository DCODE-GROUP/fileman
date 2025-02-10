<?php

namespace DcodeGroup\Fileman\Http\Resources\List;

use Illuminate\Http\Resources\Json\JsonResource;

class File extends JsonResource
{
    public function toArray($request): array
    {
        return array_merge(
            parent::toArray($request),
            [
                'url' => $this->resource->getUrl(),
                'previewUrl' => $this->resource->hasPreview() ? $this->resource->getPreview() : $this->resource->getUrl(),
                'actions' => [
                    'update' => [
                        'url' => route(config('fileman.api_route_name').'.file.update', [
                            'parent' => $this->resource->folder_id,
                            'file' => $this->resource->id,
                        ]),
                        'label' => __('fileman.buttons.rename_file'),
                        'icon' => 'Pencil',
                        'action' => 'renameFile',
                    ],
                    'delete' => [
                        'url' => route(config('fileman.api_route_name').'.file.destroy', [
                            'parent' => $this->resource->folder_id,
                            'file' => $this->resource->id,
                        ]),
                        'label' => __('fileman.buttons.delete'),
                        'icon' => 'Trash',
                        'action' => 'deleteFile',
                    ],
                ],
            ]
        );
    }
}
