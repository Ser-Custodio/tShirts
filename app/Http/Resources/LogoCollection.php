<?php

namespace App\Http\Resources;

use App\Logo;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LogoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'Logos' => $this->collection,
        ];
        return $data;
    }

}
