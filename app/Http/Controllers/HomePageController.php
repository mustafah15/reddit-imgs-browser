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
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $parser = new PicsParserManger();

        $data['pics'] = $parser->generateContent($parser->getJson($parser->getUrl()));
        $data['next'] = $parser->getNext();
        $data['previous'] = $parser->getPrevious();
        $data['count'] = 0;
        return view('welcome',$data);
    }

    /**
     * @param $next
     * @param $count
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPaginateNext($next, $count)
    {
        $parser = new PicsParserManger();

        $data['pics'] = $parser->getNextJson($next,$count);
        $data['next'] = $parser->getNext();
        $data['previous'] = $parser->getPrevious();
        $data['count'] = $parser->count->getCount();

        return view('welcome',$data);
    }

    /**
     * @param $before
     * @param $count
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPaginatePrev($before, $count)
    {
        $parser = new PicsParserManger();

        $data['pics'] = $parser->getPrevJson($before,$count);
        $data['next'] = $parser->getNext();
        $data['previous'] = $parser->getPrevious();
        $data['count'] = $parser->count->getCount();

        return view('welcome',$data);
    }

}