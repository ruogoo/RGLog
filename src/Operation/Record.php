<?php
/**
 * This file is part of ruogu.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */

namespace Ruogoo\Log\Operation;

use Illuminate\Support\Facades\Log;
use Ruogoo\Log\Processor\CategoryProcessor;
use Ruogoo\Log\Processor\EventProcessor;
use Ruogoo\Log\Processor\NormalProcessor;
use Ruogoo\Log\Processor\TimeProcessor;
use Monolog\Logger as Monolog;

/**
 * 记录操作, 基于 Monolog 的写日志
 * Class Record.
 */
class Record
{
    private $_category;
    private $_event;
    private $_message;
    private $_time;
    private $_extra;
    protected $monolog;

    public function __construct($category, $event, $message, array $extra = [])
    {
        $this->monolog = Log::getMonolog();

        $this->_category = $category;
        $this->_event    = $event;
        $this->_message  = $message;
        $this->_extra    = $extra;
    }

    public function setTime($time)
    {
        $this->_time = $time;

        return $this;
    }

    public function save($level = Monolog::INFO)
    {
        // 保证主程序不受 log 异常影响
        try {
            $this->processor();
            // 写入
            $this->monolog->addRecord($level, $this->_message);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    private function processor()
    {
        foreach ($this->monolog->getProcessors() as $processor) {
            if ($processor instanceof CategoryProcessor) {
                $processor->setCategory($this->_category);
            }
            if ($processor instanceof EventProcessor) {
                $processor->setEvent($this->_event);
            }
            if ($processor instanceof NormalProcessor) {
                $processor->setExtra($this->_extra);
            }
            if ($processor instanceof TimeProcessor) {
                $processor->setTime($this->_time);
            }
        }
    }
}
