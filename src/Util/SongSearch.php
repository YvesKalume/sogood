<?php
/**
 * Copyright (c) 2020.
 * Yves Kalume
 * yveskalumenoble@gmail.com
 */
namespace App\Util;

class SongSearch
{
    private $q;

    /**
     * @return mixed
     */
    public function getQ()
    {
        return $this->q;
    }

    /**
     * @param mixed $q
     */
    public function setQ($q): void
    {
        $this->q = $q;
    }
}

