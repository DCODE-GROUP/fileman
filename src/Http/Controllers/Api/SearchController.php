<?php

namespace DcodeGroup\Fileman\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DcodeGroup\Fileman\Models\Folder;
use DcodeGroup\Fileman\Services\SearchService;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchController extends Controller
{

    public function __construct(protected SearchService $searchService)
    {
    }

    public function __invoke(Folder $parent)
    {
        if (!$parent) {
            $parent = Folder::getRoot();
        }
        return new JsonResource(
            $this->searchService->search(request()->input('keyword'), $parent->id)
        );
    }
}
