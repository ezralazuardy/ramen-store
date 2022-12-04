<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{
    UserController,
    RamenCategoryController,
    RamenStoreController,
    RamenController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    return Inertia::render("Welcome", [
        "canLogin" => Route::has("login"),
        "canRegister" => Route::has("register"),
        "laravelVersion" => Application::VERSION,
        "phpVersion" => PHP_VERSION,
    ]);
});

Route::middleware([
    "auth:sanctum",
    config("jetstream.auth_session"),
    "verified",
])->group(function () {
    // Ramens Endpoint
    Route::group(
        [
            "prefix" => "ramens",
            "as" => "ramens.",
        ],
        function () {
            Route::get("/", [RamenController::class, "index"])->name("index");
            Route::get("create", [RamenController::class, "create"])->name(
                "create"
            );
            Route::post("store", [RamenController::class, "store"])->name(
                "store"
            );
            Route::get("{id}/edit", [RamenController::class, "edit"])->name(
                "edit"
            );
            Route::put("{id}/update", [RamenController::class, "update"])->name(
                "update"
            );
            Route::get("{id}/destroy", [
                RamenController::class,
                "destroy",
            ])->name("destroy");

            // Ramen Categories Endpoint
            Route::group(
                [
                    "prefix" => "categories",
                    "as" => "categories.",
                ],
                function () {
                    Route::get("/", [
                        RamenCategoryController::class,
                        "index",
                    ])->name("index");
                    Route::get("create", [
                        RamenCategoryController::class,
                        "create",
                    ])->name("create");
                    Route::post("store", [
                        RamenCategoryController::class,
                        "store",
                    ])->name("store");
                    Route::get("{id}/edit", [
                        RamenCategoryController::class,
                        "edit",
                    ])->name("edit");
                    Route::put("{id}/update", [
                        RamenCategoryController::class,
                        "update",
                    ])->name("update");
                    Route::get("{id}/destroy", [
                        RamenCategoryController::class,
                        "destroy",
                    ])->name("destroy");
                }
            );

            // Ramen Stores Endpoint
            Route::group(
                [
                    "prefix" => "stores",
                    "as" => "stores.",
                ],
                function () {
                    Route::get("/", [
                        RamenStoreController::class,
                        "index",
                    ])->name("index");
                    Route::get("create", [
                        RamenStoreController::class,
                        "create",
                    ])->name("create");
                    Route::post("store", [
                        RamenStoreController::class,
                        "store",
                    ])->name("store");
                    Route::get("{id}/edit", [
                        RamenStoreController::class,
                        "edit",
                    ])->name("edit");
                    Route::put("{id}/update", [
                        RamenStoreController::class,
                        "update",
                    ])->name("update");
                    Route::get("{id}/destroy", [
                        RamenCategoryController::class,
                        "destroy",
                    ])->name("destroy");
                }
            );
        }
    );
});
