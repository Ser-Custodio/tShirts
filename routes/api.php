<?php

use Illuminate\Http\Request;
use App\Http\Resources\LogoCollection;
use App\Logo;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('logos', function () {
    return new LogoCollection(Logo::all());
});
Route::get('logos/{logo}', function (Logo $logo) {
    return new LogoCollection(Logo::find($logo));
});


