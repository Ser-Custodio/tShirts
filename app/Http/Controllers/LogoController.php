<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Creation;
use App\Tshirt;
use App\Logo;
use Intervention\Image\ImageManager;
use Intervention\Image\Font;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //Récupérer les infos pour créer une nouvelle Creation en BDD
       $creation = Creation::create($request->all());
       //Créer un nouveau champs contenant le lien vers la création
       $creation->infos = public_path("storage/creations/".$creation->id.".png");
       //Récupérer le texte entré
       $creation->texte = $request->input("texte");
       //Instance du tshirt
       $tshirt = Tshirt::find(3);

       //Créer l'image avec le texte
       $manager = new ImageManager();
       $imageTshirt = $manager->make(public_path("imgs/shirts/3.png"));
       $imageTshirt->text($creation->texte, 650, 1000, function ($font) {
           $font->file('fonts/Bleed.ttf');
           $font->color(array(255, 0, 0));
           $font->size(120);
       });

       //Enregistrer dans le répertoire
       $imageTshirt->save($creation->infos);

       //Retourner du json avec une réponse 201
       return response()->json($creation,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id->delete();
        return response()->json(null,204);
    }
}
