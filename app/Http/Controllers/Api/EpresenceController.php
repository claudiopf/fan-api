<?php

namespace App\Http\Controllers\Api;

use App\Models\Epresence;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EpresenceResource;

class EpresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EpresenceResource::collection(Auth::user()->epresence()->latest('id')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => ['required'],
        ]);

        $epre = Epresence::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'waktu' => now(),
        ]);

        return response()->json([
            'data' => [
                'type' => $epre->type,
                'waktu' => Carbon::parse($epre['waktu'])->translatedFormat('Y-m-d')
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
