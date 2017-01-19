<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/14/17
 * Time: 9:32 AM
 */

namespace App\Managers;


// Adapter class to handel results from  reddit json url

class PicsParserManger
{
    private $source = 'https://www.reddit.com/r/pics/.json?limit=10';

    public function generateContent($nodes)
    {

        $data = [];

        foreach ($nodes as $node)
        {
            $buffer = new \stdClass();

            $buffer->thumbnail = $node['data']['thumbnail'];
            $buffer->url = $node['data']['url'];
            $buffer->domain = $node['data']['domain'];
            $buffer->title = $node['data']['title'];

            $data[] = $buffer;
        }

        return $data;
    }

    public function setUrl($before, $after)
    {
        $this->source =  $this->source.'?before='.$before.'?after='.$after;

        return $this->source;
    }

    public function getUrl()
    {
        return $this->source;
    }

    public function getJson()
    {
        $json = json_decode(file_get_contents($this->source), true)['data'];

        $this->setUrl($json['before'],$json['after']);

        return $json['children'];
    }



}