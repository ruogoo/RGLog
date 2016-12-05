<?php
/**
 * This file is part of ruogu.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */

namespace Ruogoo\Log\Processor;

class CategoryProcessor
{
    private $_category;

    public function setCategory($category)
    {
        $this->_category = $category;
    }

    public function __invoke($record)
    {
        $record['category'] = $this->_category;

        return $record;
    }
}
