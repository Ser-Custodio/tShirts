<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Faker\Provider\Image;
use App\Tshirt;
use App\Logo;
use App\Creation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'shirts' => Tshirt::all(),
            'logos' => Logo::all()
        ];
        return view('index', $data);
    }

    public function fusion(Tshirt $shirt, Logo $logo){
        //path for the images
        $pathShirt = public_path('imgs/shirts/' . $shirt->id . '.png');
        $pathLogo = public_path('imgs/logos/' . $logo->id . '.png');
        $pathCopyright = public_path('imgs/copy.png');
        //Instance of ImageManager
        $manager = new ImageManager();
        //Image of shirt
        $imageShirt = $manager->make($pathShirt);
        //Image of logo resized to fit the shirt
        $imageLogo = $manager->make($pathLogo)->resize($shirt->largeurImpression, $shirt->hauteurImpression, function ($gg) {
            $gg->aspectRatio();
        });
        //Dimensions of logo
        $width = $imageLogo->width();
        $heigth = $imageLogo->height();
        // Position of logo on the shirt
        $x = intval($shirt->origineX + (($shirt->largeurImpression / 2) - ($width / 2)));
        $y = intval($shirt->origineY + (($shirt->hauteurImpression / 2) - ($heigth / 2)));
        // insertion of logo
        $shirtFinal = $imageShirt->insert($imageLogo, 'top-left', $x, $y);

        $copy = $manager->make($pathCopyright);//->opacity(20);
        $shirtFinal->insert($copy,'center');
        return $imageShirt->response();
    }

    public function fileUpload(){
        $manager = new ImageManager();
        $img = $manager->make($_FILES['photo']['tmp_name']);
        $data = [
            'nom' => 'perso',
            'largeur' => $img->width(),
            'hauteur' => $img->height()
        ];
        $newLogo = Logo::create($data);
        $destPath = public_path('imgs/logos/'.$newLogo->id.'.png');
        $img->save($destPath);
        return redirect(route('images.index'));
    }

    public function telecharger(){
        return view("upload");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $choix = $request->input('shirt');
        $logo = $request->input('logo');
        $data = [
            'shirt' => Tshirt::find($choix),
            'logo' => Logo::find($logo),
        ];
        return view('results', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Tshirt $shirt, Logo $logo)
    {
        //path for the images
        $pathShirt = public_path('imgs/shirts/' . $shirt->id . '.png');
        $pathLogo = public_path('imgs/logos/' . $logo->id . '.png');
        //Instance of ImageManager
        $manager = new ImageManager();
        //Image of shirt
        $imageShirt = $manager->make($pathShirt);
        //Image of logo resized to fit the shirt
        $imageLogo = $manager->make($pathLogo)->resize($shirt->largeurImpression, $shirt->hauteurImpression, function ($gg) {
            $gg->aspectRatio();
        });
        //Dimensions of logo
        $width = $imageLogo->width();
        $heigth = $imageLogo->height();
        // Position of logo on the shirt
        $x = intval($shirt->origineX + (($shirt->largeurImpression / 2) - ($width / 2)));
        $y = intval($shirt->origineY + (($shirt->hauteurImpression / 2) - ($heigth / 2)));
        // insertion of logo
        $imageShirt->insert($imageLogo, 'top-left', $x, $y);
        //Enregistrer en BDD l'image
        $data = [
            "shirt_id" => $shirt->id,
            "logo_id" => $logo->id,
            "user_id" => 1
        ];
        $creation = Creation::create($data);
        //Save image
        $savePath = storage_path('creations/' . $creation->id . '.png');
        $imageShirt->save($savePath);

        $this->deleteFile($logo);

        return redirect(route('images.index'));
    }

    public function deleteFile(Logo $logo){
        $pathLogo = public_path('imgs/logos/' . $logo->id . '.png');
        if($logo->nom === 'perso'){
            File::delete($pathLogo);
            $logo->delete();
        }
        return redirect(route('images.index'));
    }

//------------------------------------------------------------------------------------------------------------//

    //Afficher le formulaire de modification du logo
    public function editionLogo(Tshirt $shirt, Logo $logo)
    {
        $data = [
            "shirt" => $shirt,
            "logo" => $logo,
            "origineX" => $shirt->origineX,
            "origineY" => $shirt->origineY,
            "largeur" => $logo->largeur,
        ];
        return view("edit", $data);
    }

    //Récupérer les données de modification du logo de l'utilisateur
    public function recupModifLogo (Request $request, Tshirt $shirt, Logo $logo)
    {
        $data = [
            "origineX" => $request->input('originex'),
            "origineY" => $request->input('originey'),
            "largeur" => $request->input('largeur'),
            "hauteur" => $request->input('hauteur'),
            "shirt" => $shirt,
            "logo" => $logo,
            "message" => ''
        ];
        //Vérifier que le positionnement du logo modifié respecte la zone d'impression
        //Si le logo est trop à gauche
        if ($data['origineX'] < $shirt->origineX)
        {
            $data['origineX'] = $shirt->origineX;
            $data['message'] = "Votre logo ne peut pas aller plus à gauche";
        }
        //Si le logo est trop à droite (en prenant compte la largeur du logo)
        if (($data['origineX'] + $data['largeur']) > ($shirt->origineX + $shirt->largeurImpression))
        {
            $data['origineX'] = ($shirt->origineX + $shirt->largeurImpression) - $data['largeur'];
            $data['message'] = "Votre logo ne peut pas aller plus à droite";
        }
        //Si le logo est trop en haut
        if ($data['origineY'] < $shirt->origineY)
        {
            $data['origineY'] = $shirt->origineY;
            $data['message'] = "Votre logo ne peut pas aller plus haut";
        }
        //Si le logo est trop en bas (en prenant compte la largeur du logo)
        if (($data['origineY']) > ($shirt->origineY + $shirt->hauteurImpression))
        {
            $data['origineY'] = $shirt->origineY;
            $data['message'] = "Votre logo était trop en bas, il reprend donc son positionnement optimal";
        }

        return view("edit", $data);
    }

    //Méthode retournant une image avec des propriétés dynamiques (origineX, origineY, taille Logo..)
    public function formaterLogo (Tshirt $shirt, Logo $logo, $origineX, $origineY,$largeur)
    {
        //Chemin des images
        $cheminLogo = public_path("imgs/logos/" . $logo->id . ".png");
        $cheminTshirt = public_path("imgs/shirts/" . $shirt->id . ".png");
        //instance de ImageManager
        $manager = new ImageManager();
        //Image du tshirt
        $imageTshirt = $manager->make($cheminTshirt);
        //Image du logo redimensionner en respectant les proportions
        $imageLogo = $manager->make($cheminLogo)->resize($largeur,$shirt->hauteurImpression, function ($constraint) {
            $constraint->aspectRatio();
        });

        //Coller le logo sur le tshirt
        $imageTshirtLogo = $imageTshirt->insert($imageLogo, 'top-left', $origineX, $origineY);

        //Ajouter un copyright sur l'image
        $cheminCopy = public_path("imgs/copy.png");
//        $imageCopyRight = $manager->make($cheminCopy)->opacity(10);
        $imageCopyRight = $manager->make($cheminCopy);

        $imageTshirt = $imageTshirtLogo->insert($imageCopyRight, 'center');
        return $imageTshirt->response();
    }

    //Méthode permettant d'enregistrer l'image avec le logo modifié par l'utilisateur
    public function saveformaterLogo (Tshirt $shirt, Logo $logo, $origineX, $origineY, $largeur)
    {
        //Chemin des images
        $cheminLogo = public_path("imgs/logos/" . $logo->id . ".png");
        $cheminTshirt = public_path("imgs/shirts/" . $shirt->id . ".png");
        //instance de ImageManager
        $manager = new ImageManager();
        //Image du tshirt
        $imageTshirt = $manager->make($cheminTshirt);
        //Image du logo redimensionner en respectant les proportions
        $imageLogo = $manager->make($cheminLogo)->resize($largeur,$shirt->hauteurImpression,  function ($constraint) {
            $constraint->aspectRatio();
        });

        //Coller le logo sur le tshirt
        $imageTshirtLogo = $imageTshirt->insert($imageLogo, 'top-left', $origineX, $origineY);

        //Enregistrer en BDD l'image
        $data = [
            "shirt_id" => $shirt->id,
            "logo_id" => $logo->id,
            "user_id" => 1
        ];
        $creation = Creation::create($data);
        //Sauvegarder l'image
        $cheminSauvegarde = storage_path("creations/" . $creation->id . ".png");
        $imageTshirt->save($cheminSauvegarde);

        //Si dans la BDD le logo est nommé "perso" : supprimer en BDD et l'image dans le répertoire
        $this->deleteFile($logo);

        //Retour à l'accueil
        return redirect(route("images.index"));
    }





















    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
