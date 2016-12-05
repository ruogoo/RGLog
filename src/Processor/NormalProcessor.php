<?php
/**
 * This file is part of ruogu.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */

namespace Ruogoo\Log\Processor;

use Illuminate\Support\Facades\Auth;

class NormalProcessor
{
    private $_extra;

    public function setExtra($extra)
    {
        $this->_extra = $extra;
    }

    public function __invoke(array $record)
    {
        if (is_array($this->_extra)) {
            $record['extra'] = array_merge($record['extra'], $this->_extra);
            if (Auth::id()) {
                $record['context'] = array_merge($record['context'], ['id' => Auth::id()]);
            }
        }

        return $record;
    }
}
