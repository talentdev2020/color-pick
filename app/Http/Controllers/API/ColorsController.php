<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Colors;

class ColorsController extends Controller
{
    public function index() : Response
    {
        $colors = Colors::all();

        $response = new Response($colors, Response::HTTP_OK);

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : Response
    {
        $red = $request->input("red");
        $green = $request->input("green");
        $blue = $request->input("blue");

        $res = Colors::create(['red'=>$red, 'green'=>$green, 'blue'=>$blue]);

        $response = new Response($res,Response::HTTP_OK);
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
        $red = $request->input("red");
        $green = $request->input("green");
        $blue = $request->input("blue");

        $row = Colors::where("id", $id)->update(['red'=>$red, 'green'=>$green, 'blue'=>$blue]);
        
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
