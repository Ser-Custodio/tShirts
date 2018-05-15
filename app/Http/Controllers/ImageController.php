<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Faker\Provider\Image;
use App\Tshirt;
use App\Logo;

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
            'tshirts' => Tshirt::all(),
            'logos' => Logo::all()
        ];
        return view('index', $data);
    }

    public function fusion(){
        $choix = $_GET['shirt'];
        $logo = $_GET['logo'];
        $myShirt = Tshirt::find($choix);
        $path = public_path('imgs/shirts/'.$choix.'.png');
        $pathLogo = public_path('imgs/logos/'.$logo.'.png');
        $manager = new ImageManager();
        $logo = $manager->make($pathLogo)->resize($myShirt->largeurImpression,$myShirt->hauteurImpression, function($gg){$gg->aspectRatio();});
        $width = $logo->width();
        $heigth = $logo->height();
        $x = intval($myShirt->origineX + (($myShirt->largeurImpression/2)- ($width / 2)));
        $y = intval($myShirt->origineX + (($myShirt->hauteurImpression/2)- ($heigth / 2)));
        $tshirt = $manager->make($path)->insert($logo,'top-left',$x, $y);
        return $tshirt->response();

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
