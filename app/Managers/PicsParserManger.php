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
    private $source = 'https://www.reddit.com/r/pics/.json';

    private $before ;

    private $count ;

    private $after ;

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

    public function getJson($url)
    {
        $json = json_decode(file_get_contents($url), true)['data'];

        $this->setNext($json['after']);
        $this->setPrevious($json['before']);

        return $json['children'];
    }

    public function getNextJson($after,$count)
    {
        $this->setNext($after);
        $this->setCount($count);
        $this->increaseCount();
        $nodes = $this->getJson($this->setUrl());
        $this->setPrevious($after);

        return $this->generateContent($nodes);
    }

    public function getPrevJson($before,$count)
    {
        $this->setPrevious($before);
        $this->setCount($count);
        $this->decreaseCount();
        $nodes = $this->getJson($this->setUrl());
        $this->setNext($before);

        return $this->generateContent($nodes);
    }

    public function setUrl()
    {
        $this->source =  $this->source.'?count='.$this->count.'&before='.$this->before.'&after='.$this->after;

        return $this->source;
    }

    public function getNext()
    {
        return $this->after;
    }

    public function getPrevious()
    {
        return $this->before;
    }

    public function getUrl()
    {
        return $this->source;
    }

    public function setPrevious($before)
    {
        $this->before = $before;
    }

    public function setNext($after)
    {
        $this->after = $after;
    }


    public function setCount($count)
    {
        $this->count = $count;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function increaseCount()
    {
        $this->count = $this->count + 25;
    }

    public function decreaseCount()
    {
        if($this->count<25)
            $this->count = 0;
        else
            $this->count = $this->count - 25;
    }

}