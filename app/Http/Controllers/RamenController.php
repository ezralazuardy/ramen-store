<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Validator, Redirect};
use Inertia\Inertia;
use Carbon\Carbon;

class RamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query("search");
        if (empty($search)) {
            $ramens = DB::table("ramens")
                ->select(
                    DB::raw("
                        ramens.id as id, ramens.name as name, ramen_categories.id as ramen_category_id,
                        ramen_categories.name as ramen_category_name, ramen_stores.id as ramen_store_id,
                        ramen_stores.name as ramen_store_name, users.name as user_name, ramens.stock as stock,
                        ramens.price as price, ramens.deleted_at as deleted_at
                    ")
                )
                ->where("ramens.deleted_at", "=", null)
                ->join(
                    "ramen_categories",
                    "ramen_categories.id",
                    "=",
                    "ramens.category_id"
                )
                ->join(
                    "ramen_stores",
                    "ramen_stores.id",
                    "=",
                    "ramens.store_id"
                )
                ->join("users", "users.id", "=", "ramens.user_id")
                ->get();
        } else {
            $ramens = DB::table("ramens")
                ->select(
                    DB::raw("
                    ramens.id as id, ramens.name as name, ramen_categories.id as ramen_category_id,
                    ramen_categories.name as ramen_category_name, ramen_stores.id as ramen_store_id,
                    ramen_stores.name as ramen_store_name, users.name as user_name, ramens.stock as stock,
                    ramens.price as price, ramens.deleted_at as deleted_at
                    ")
                )
                ->where("ramens.deleted_at", "=", null)
                ->where("ramens.name", "like", "%$search%")
                ->join(
                    "ramen_categories",
                    "ramen_categories.id",
                    "=",
                    "ramens.category_id"
                )
                ->join(
                    "ramen_stores",
                    "ramen_stores.id",
                    "=",
                    "ramens.store_id"
                )
                ->join("users", "users.id", "=", "ramens.user_id")
                ->get();
        }
        return Inertia::render("Ramens/Index", [
            "ramens" => $ramens,
        ]);
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $trashedRamens = DB::table("ramens")
            ->select(
                DB::raw("
                ramens.id as id, ramens.name as name, ramen_categories.id as ramen_category_id,
                ramen_categories.name as ramen_category_name, ramen_stores.id as ramen_store_id,
                ramen_stores.name as ramen_store_name, users.name as user_name, ramens.stock as stock,
                ramens.price as price, ramens.deleted_at as deleted_at
            ")
            )
            ->where("ramens.deleted_at", "!=", null)
            ->join(
                "ramen_categories",
                "ramen_categories.id",
                "=",
                "ramens.category_id"
            )
            ->join("ramen_stores", "ramen_stores.id", "=", "ramens.store_id")
            ->join("users", "users.id", "=", "ramens.user_id")
            ->get();
        return Inertia::render("Ramens/Trashed", [
            "trashed_ramens" => $trashedRamens,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ramenCategories = DB::table("ramen_categories")
            ->select(DB::raw("id, name, deleted_at"))
            ->where("deleted_at", "=", null)
            ->get();
        $ramenStores = DB::table("ramen_stores")
            ->select(DB::raw("id, name, address, deleted_at"))
            ->where("deleted_at", "=", null)
            ->get();
        return Inertia::render("Ramens/Create", [
            "ramen_categories" => $ramenCategories,
            "ramen_stores" => $ramenStores,
        ]);
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
                "category" => [
                    "required",
                    "integer",
                    "exists:ramen_categories,id",
                ],
                "store" => ["required", "integer", "exists:ramen_stores,id"],
                "name" => ["required", "string", "max:255"],
                "stock" => ["required", "integer", "min:0"],
                "price" => ["required", "integer", "min:0"],
            ],
            [],
            [
                "category" => "ramen category",
                "store" => "ramen store",
                "name" => "ramen name",
                "stock" => "ramen stock",
                "price" => "ramen price",
            ]
        );
        DB::table("ramens")->insert([
            "category_id" => $request->category,
            "store_id" => $request->store,
            "name" => $request->name,
            "stock" => $request->stock,
            "price" => $request->price,
        ]);
        return Redirect::route("ramens.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ramenCategories = DB::table("ramen_categories")
            ->select(DB::raw("id, name, deleted_at"))
            ->where("deleted_at", "=", null)
            ->get();
        $ramenStores = DB::table("ramen_stores")
            ->select(DB::raw("id, name, address, deleted_at"))
            ->where("deleted_at", "=", null)
            ->get();
        $ramen = DB::table("ramens")
            ->select(
                DB::raw("
                ramens.id as id, ramens.name as name, ramen_categories.id as ramen_category_id,
                ramen_categories.name as ramen_category_name, ramen_stores.id as ramen_store_id,
                ramen_stores.name as ramen_store_name, users.name as user_name, ramens.stock as stock,
                ramens.price as price, ramens.deleted_at as deleted_at
        ")
            )
            ->where("ramens.deleted_at", "=", null)
            ->where("ramens.id", "=", $id)
            ->join(
                "ramen_categories",
                "ramen_categories.id",
                "=",
                "ramens.category_id"
            )
            ->join("ramen_stores", "ramen_stores.id", "=", "ramens.store_id")
            ->join("users", "users.id", "=", "ramens.user_id")
            ->get();
        return Inertia::render("Ramens/Edit", [
            "ramen_categories" => $ramenCategories,
            "ramen_stores" => $ramenStores,
            "ramen" => $ramen[0],
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
                "category" => [
                    "required",
                    "integer",
                    "exists:ramen_categories,id",
                ],
                "store" => ["required", "integer", "exists:ramen_stores,id"],
                "name" => ["required", "string", "max:255"],
                "stock" => ["required", "integer", "min:0"],
                "price" => ["required", "integer", "min:0"],
            ],
            [],
            [
                "category" => "ramen category",
                "store" => "ramen store",
                "name" => "ramen name",
                "stock" => "ramen stock",
                "price" => "ramen price",
            ]
        );
        DB::table("ramens")
            ->where("id", "=", $id)
            ->update([
                "category_id" => $request->category,
                "store_id" => $request->store,
                "name" => $request->name,
                "stock" => $request->stock,
                "price" => $request->price,
                "updated_at" => Carbon::now(),
            ]);
        return Redirect::route("ramens.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("ramens")
            ->where("id", "=", $id)
            ->update([
                "deleted_at" => Carbon::now(),
            ]);
        return back();
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_permanent($id)
    {
        DB::table("ramens")
            ->where("id", "=", $id)
            ->delete();
        return back();
    }

    /**
     * Restore the specified trashed resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        DB::table("ramens")
            ->where("deleted_at", "!=", null)
            ->where("id", "=", $id)
            ->update([
                "deleted_at" => null,
            ]);
        return back();
    }
}
