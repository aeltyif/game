<?php

namespace App\Http\Controllers;

use App\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HeroController extends Controller
{
    /**
     * Holds the number of minutes the heroes should be cached
     *
     * @var integer
     */
    protected $cache_time = 60;

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return Collection
     */
    public function index()
    {
        return Cache::remember('heroes', $this->cache_time, function () {
            return Hero::orderBy('id', 'asc')->get();
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @return Collection
     */
    public function show(Request $request)
    {
        return Cache::remember('heroes' . $request->id, $this->cache_time, function () use ($request) {
            return Hero::find($request->id);
        });
    }
}
