<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/20/17
 * Time: 11:03 AM
 */

namespace App\Managers;


class CountManger
{
    private  $count ;


    /**
     * @param $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return integer
     */
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