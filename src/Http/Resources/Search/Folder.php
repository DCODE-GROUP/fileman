<?php

namespace DcodeGroup\Fileman\Http\Resources\Search;

use DcodeGroup\Fileman\Enum\FileType;
use Illuminate\Http\Resources\Json\JsonResource;

class Folder extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->resource->name,
            'path' => $this->resource->getFolderPath(),
            'url' => route('fileman.folder.index', $this->resource->id),
            'filesCount' => $this->resource->files_count,
            'type' => FileType::FOLDER->value,
            'id' => $this->resource->id,
        ];
    }
}
