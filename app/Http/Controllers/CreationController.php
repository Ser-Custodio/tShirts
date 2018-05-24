<?php

namespace App\Http\Controllers;

use App\Creation;
use App\Jobs\ProcessPDF;
use App\Mail\SendPdf;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use PDF;
use Illuminate\Support\Facades\Mail;

class CreationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "creations" => Creation::orderBy('id')->get(),
        ];
        return view('creations.index', $data);
    }

    //Fonction permettant de lire une image et la retourner (image dans storage)

    /**
     * @param Creation $creation
     * @return mixed
     */
    public function afficherImage(Creation $creation){
        //Chemin des images
        $cheminCreation = public_path("storage/creations/". $creation->id . ".png");
        //instance de ImageManager
        $manager = new ImageManager();
        //Créer l'image de la création
        $imageCreation = $manager->make($cheminCreation);
        //Récupérer le copyright
        //Ajouter un texte avec une font personnalisée:
        $imageCreation->text('Copyright',700, 1500, function($font){
            $font->file('fonts/Bleed.ttf');
            $font->color(array(255,0,0,0.5));
            $font->size(200);
            $font->angle(30);
        });
//        $cheminCopy = public_path("imgs/copy.png");
//        $imageCopyRight = $manager->make($cheminCopy);
//        //Ajouter un copyright sur l'image
//        $image = $imageCreation->insert($imageCopyRight, 'center');
        return $imageCreation->response();
    }

    // Method to generate PDF using queue

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generatePdf(){
        $data = [
            'title' => 'My creations',
            'creations' => Creation::all()
        ];
        ProcessPDF::dispatch();
//        $this->sendMailPdf();
        return back();
    }

    // Method to send mails using queue

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMailPdf(){
        Mail::to('sergio.custodio@campus-numerique-in-the-alps.com')
            ->queue(new SendPdf());

        return back();
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
        //
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
        //
    }
}
