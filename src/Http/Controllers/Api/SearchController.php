<?php

namespace DcodeGroup\Fileman\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DcodeGroup\Fileman\Models\Folder;
use DcodeGroup\Fileman\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchController extends Controller
{
    public function __construct(public SearchService $searchService) {}

    public function __invoke(Request $request, Folder $parent)
    {
        //        if (! $parent instanceof Folder) {
        //            $parent = Folder::getRoot();
        //        }

        return new JsonResource(
            $this->searchService->search($request->input('keyword'), $parent->id)
        );
    }
}
