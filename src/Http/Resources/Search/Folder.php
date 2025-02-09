<?php

namespace DcodeGroup\Fileman\Http\Resources\Search;

use DcodeGroup\Fileman\Enum\FileType;
use Illuminate\Http\Resources\Json\JsonResource;

class Folder extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'path' => $this->getFolderPath(),
            'url' => route('fileman.folder.index', $this->id),
            'filesCount' => $this->files_count,
            'type' => FileType::FOLDER->value,
            'id' => $this->id,
        ];
    }
}
