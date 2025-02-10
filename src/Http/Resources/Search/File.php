<?php

namespace DcodeGroup\Fileman\Http\Resources\Search;

use DcodeGroup\Fileman\Enum\FileType;
use Illuminate\Http\Resources\Json\JsonResource;

class File extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->resource->name,
            'path' => $this->resource->source,
            'url' => route('fileman.folder.index', $this->resource->folder->id).'#file_'.$this->resource->id,
            'preview' => $this->resource->hasPreview() ? $this->resource->getPreview() : $this->resource->getUrl(),
            'source' => $this->resource->source,
            'type' => FileType::FILE->value,
            'id' => $this->resource->id,
        ];
    }
}
