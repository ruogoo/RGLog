<?php
/**
 * This file is part of ruogu.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */

namespace Ruogu\Packages\Log\Processor;

class TimeProcessor
{
    private $_time;

    public function setTime($time)
    {
        $this->_time = $time;
    }

    public function __invoke($record)
    {
        $record['time'] = $this->_time;

        return $record;
    }
}
