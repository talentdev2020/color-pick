<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Colors;
use League\Fractal\Resource\Collection;
use App\Transformers\ColorsTransformer;
use League\Fractal\Manager;
class ColorsController extends Controller
{
    private $fractal;

    private $colorTransformer;
    
    function __construct(Manager $fractal, ColorsTransformer $colorTransformer)
    {
        $this->fractal = $fractal;
        $this->colorTransformer = $colorTransformer;
    }

    public function index() : Response
    {
        $colors = Colors::all();

        $colors = new Collection($colors, $this->colorTransformer);
        $colors = $this->fractal->createData($colors);

        $response = new Response($colors->toArray(), Response::HTTP_OK);

         return $response;
        
    }

    function hexToRGB($hex)
    {
       list($red, $green, $blue) = sscanf($hex, "#%02x%02x%02x");
       return ['red'=>$red, 'green'=>$green, 'blue'=>$blue];
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : Response
    {
        $color = $request->input("color");
        $res = Colors::create($this->hexToRGB($color));
        $response = new Response(["id"=>$res->id, "color"=>$color], Response::HTTP_OK);
           // Return HTTP response.
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) : Response
    {
        $color = $request->input("color");

        $row = Colors::where("id", $id)->update($this->hexToRGB($color));
        
        $response = new Response(Response::HTTP_OK);
        // Return HTTP response.
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id) : Response
    {
        // CODE CHALLENGE: Delete Domains
        Colors::where("id", $id)->delete();

        $response = new Response(Response::HTTP_OK);
        // Return HTTP response.
        return $response;
    }
}
