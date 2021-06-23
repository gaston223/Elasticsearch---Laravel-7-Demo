<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Punchline;
use App\Models\Title;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PunchlineController extends Controller
{
    /**
     * Get punchlines order by popularity
     * @param $pageSize
     * @param $pageNumber
     * @return JsonResponse
     */
    public function getPunchlinesByPopularity($pageSize, $pageNumber): JsonResponse
    {
        $offset = ($pageNumber * $pageSize) - $pageSize;
        $punchlines = Punchline::select('punchlines.id', 'punchlines.title_id', 'punchlines.description', 'artist_id')
            ->with(['artist' => function ($query){
                $query->select('id', 'name');
            }])
            ->withCount('punchline_profile')
            ->where('is_validated', 1)
            ->orderBy('punchline_profile_count', 'desc');

        $total = count($punchlines->get());
        $hasMore = $total > ($offset+$pageSize) ;

        $punchlines->skip($offset)->take($pageSize)->get();

        return response()->json([
            'code' => 200,
            'page_size' => $pageSize,
            'page_number' => $pageNumber,
            'has_more' => $hasMore,
            'punchlines' => $punchlines->get()
        ], 200);
    }

    /**
     * Get all artists who have punchlines, order by "alphabetical"
     * @param $pageSize
     * @param $pageNumber
     * @return JsonResponse
     */
    public function getArtistsWhoHavePunchlines($pageSize, $pageNumber): JsonResponse
    {
        $offset = ($pageNumber * $pageSize) - $pageSize;
        $artists = Artist::select('artists.id', 'artists.name')
            ->has('punchlines')
            ->orderBy('artists.name');
        $total = count($artists->get());
        $artists = $artists->skip($offset)->take($pageSize)->get();
        $hasMore = $total > ($offset+$pageSize) ;

        return response()->json([
            'code' => 200,
            'page_size' => $pageSize,
            'page_number' => $pageNumber,
            'has_more' => $hasMore,
            'artists' => $artists
        ],200);
    }

    public function search(Request $request)
    {
        $term = $request->query('term');

//        $resultsPunchlines = Punchline::select('id', 'description')
//            ->where('description', 'like', "%{$term}%")->withCount('punchline_profile')
//            ->orderBy('punchline_profile_count', 'desc')
//            ->get();

//        $resultsArtists = Artist::select('id', 'name')
//            ->where('name', 'like', "%{$term}%")->get();

        $resultsArtists = Artist::search($term)->get();
        $resultsPunchlines = Punchline::search($term)->get();

        //dd($results->items());
        return response()->json([
            'code' => 200,
            'punchlines' => $resultsPunchlines,
            'artists' => $resultsArtists
        ]);
    }
}
