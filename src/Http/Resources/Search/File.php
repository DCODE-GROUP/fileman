<?php

namespace DcodeGroup\Fileman\Http\Resources\Search;

use DcodeGroup\Fileman\Enum\FileType;
use Illuminate\Http\Resources\Json\JsonResource;

class File extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'path' => $this->source,
            'url' => route('fileman.folder.index', $this->folder->id).'#file_'.$this->id,
            'preview' => $this->hasPreview() ? $this->getPreview() : $this->getUrl(),
            'source' => $this->source,
            'type' => FileType::FILE->value,
            'id' => $this->id,
        ];

    }
}
