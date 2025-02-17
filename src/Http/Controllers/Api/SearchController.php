<?php

namespace DcodeGroup\Fileman\Http\Controllers\Api;

use DcodeGroup\Fileman\Models\Folder;
use DcodeGroup\Fileman\Services\SearchService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;

class SearchController extends BaseController
{
    public function __construct(protected SearchService $searchService) {}

    public function __invoke(Folder $parent)
    {
        return new JsonResource(
            $this->searchService->search(request()->input('keyword'), $parent->id)
        );
    }
}
