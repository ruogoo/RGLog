<?php
/**
 * This file is part of ruogu.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */

namespace Ruogoo\Log\Processor;

class EventProcessor
{
    private $_event;

    public function setEvent($event)
    {
        $this->_event = $event;
    }

    public function __invoke($record)
    {
        $record['event'] = $this->_event;

        return $record;
    }
}
