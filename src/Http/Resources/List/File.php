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
                'previewUrl' => $this->resource->hasPreview()?$this->resource->getPreview():$this->resource->getUrl(),
                'actions' =>[
                    'delete' => [
                        'url' => route('api.fileman.file.destroy', [
                            'parent' => $this->folder_id,
                            'file' => $this->id,
                        ]),
                    ],
                    'update' => [
                        'url' => route('api.fileman.file.update', [
                            'parent' => $this->folder_id,
                            'file' => $this->id,
                        ]),
                    ],
                ]
            ]
        );
    }
}
