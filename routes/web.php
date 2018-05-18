<?php

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

Route::get('/', function () {

    return view('welcome');
});

Route::resource('images', 'ImageController');


Route::get('/fusion/{shirt}/{logo}','ImageController@fusion')->name('fusion');

Route::post('/results', 'ImageController@create')->name('resultFusion');

Route::post('/save/{shirt}/{logo}','ImageController@store')->name('saveImage');

Route::get('/delete/{logo}','ImageController@deleteFile')->name('deleteImage');

Route::get('/upload', 'ImageController@telecharger')->name("telechargerImage");
Route::post('/upload', 'ImageController@fileUpload')->name('addImage');


//Route pour aller sur le formulaire de modification de l'image
Route::get('/modifier/{shirt}/{logo}/{origineX}', 'ImageController@editionLogo')->name('imageEdit');
//Route pour récupérer les modifications du logo par l'utilisateur
Route::post('/modifier/{shirt}/{logo}', 'ImageController@recupModifLogo')->name('modiflogo');

//route pour retourner la fusion de 2 images avec le logo modifié
Route::get('/fusion/{shirt}/{logo}/{origineX}/{origineY}/{largeur}', 'ImageController@formaterLogo')->name("fusionLogoModif");

//route pour enregistrer l'image avec le logo modifié
Route::post('/enregistrer/{shirt}/{logo}/{origineX}/{origineY}/{largeur}', 'ImageController@saveformaterLogo')->name("enregistrerImageModif");
