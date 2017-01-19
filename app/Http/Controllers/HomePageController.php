<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/14/17
 * Time: 8:08 AM
 */

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use App\Managers\PicsParserManger;

class HomePageController extends BaseController
{
    public function getIndex()
    {
        $parser = new PicsParserManger();

        $data['pics'] = $parser->generateContent($parser->getJson());

        dd($parser->getUrl());
        return view('welcome',$data);
    }
}