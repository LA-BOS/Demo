<?php
namespace App\Controllers;

use eftec\bladeone\BladeOne;

class Controller{
    protected $blade;
    public function __construct()
    {
        $views = ROOT_URL. '/views';
        $cache = ROOT_URL. '/cache';
        $this->blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
    }
}