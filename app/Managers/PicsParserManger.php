<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/14/17
 * Time: 9:32 AM
 */

namespace App\Managers;


class PicsParserManger
{
    private $source = 'https://www.reddit.com/r/pics/.json';

    private $before ;

    private $after ;

    public $count ;


    public function __construct()
    {
        $this->count = new CountManger();
    }

    /**
     * @param $nodes
     * @return array
     */
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

    /**
     * @param $url
     * @return mixed
     */
    public function getJson($url)
    {
        $json = json_decode(file_get_contents($url), true)['data'];

        $this->setNext($json['after']);
        $this->setPrevious($json['before']);

        return $json['children'];
    }

    /**
     * @param $after
     * @param $count
     * @return array
     */
    public function getNextJson($after, $count)
    {
        $this->setNext($after);
        $this->count->setCount($count);
        $this->count->increaseCount();
        $nodes = $this->getJson($this->setUrl());
        $this->setPrevious($after);

        return $this->generateContent($nodes);
    }

    /**
     * @param $before
     * @param $count
     * @return array
     */
    public function getPrevJson($before, $count)
    {
        $this->setPrevious($before);
        $this->count->setCount($count);
        $this->count->decreaseCount();
        $nodes = $this->getJson($this->setUrl());
        $this->setNext($before);

        return $this->generateContent($nodes);
    }

    /**
     * @return string
     */
    public function setUrl()
    {
        $this->source =  $this->source.'?count='.$this->count->getCount().'&before='.$this->before.'&after='.$this->after;

        return $this->source;
    }

    /**
     * @return mixed
     */
    public function getNext()
    {
        return $this->after;
    }

    /**
     * @return mixed
     */
    public function getPrevious()
    {
        return $this->before;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->source;
    }

    /**
     * @param $before
     */
    public function setPrevious($before)
    {
        $this->before = $before;
    }

    /**
     * @param $after
     */
    public function setNext($after)
    {
        $this->after = $after;
    }

}