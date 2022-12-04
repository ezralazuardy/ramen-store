<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Validator, Redirect};
use Inertia\Inertia;
use Carbon\Carbon;

class RamenStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ramenStores = DB::table("ramen_stores")
            ->select(DB::raw("id, name, address, deleted_at"))
            ->where("deleted_at", "=", null)
            ->get();
        return Inertia::render("RamenStores/Index", [
            "ramen_stores" => $ramenStores,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("RamenStores/Create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::validate(
            $request->all(),
            [
                "name" => ["required", "string", "max:255"],
                "address" => ["required", "string"],
            ],
            [],
            [
                "name" => "ramen store name",
                "address" => "ramen store address",
            ]
        );
        DB::table("ramen_stores")->insert([
            "name" => $request->name,
            "address" => $request->address,
        ]);
        return Redirect::route("ramens.stores.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ramenStore = DB::table("ramen_stores")
            ->where("id", "=", $id)
            ->get();
        return Inertia::render("RamenStores/Edit", [
            "ramen_store" => $ramenStore[0],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::validate(
            $request->all(),
            [
                "name" => ["required", "string", "max:255"],
                "address" => ["required", "string"],
            ],
            [],
            [
                "name" => "ramen store name",
                "address" => "ramen store address",
            ]
        );
        DB::table("ramen_stores")
            ->where("id", "=", $id)
            ->update([
                "name" => $request->name,
                "address" => $request->address,
                "updated_at" => Carbon::now(),
            ]);
        return Redirect::route("ramens.stores.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("ramen_stores")
            ->where("id", "=", $id)
            ->update([
                "deleted_at" => Carbon::now(),
            ]);
        return back();
    }
}
