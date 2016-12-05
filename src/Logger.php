<?php
/**
 * This file is part of ruogu.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */

namespace Ruogoo\Log;

use Ruogoo\Log\Operation\Record;

/**
 * 日志类
 * 日志规范:
 *     基于 Monolog,
 *     以 category, event, message 字段来覆盖所有日志需求
 *     extra 字段记录请求信息, 可选地添加额外信息.
 */
class Logger
{
    protected $fetcher;

    /**
     * 事件日志.
     *
     * @param string $event    事件名
     * @param string $category 分类名
     * @param string $message  记录信息
     * @param array  $extra    额外信息
     *
     * @return $this
     */
    public function event($event, $category = LogCategory::INFO, $message = '', array $extra = [])
    {
        $record = new Record($category, $event, $message, $extra);
        $record->save();

        return $this;
    }

    /**
     * 时间日志.
     *
     * @param int    $time
     * @param string $event
     * @param array  $extra
     *
     * @return $this
     */
    public function time($time = 0, $event = null, array $extra = [])
    {
        $record = new Record(LogCategory::TIME, $event, $time, $extra);
        $record->setTime($time);
        $record->save();

        return $this;
    }

    /**
     * 异常日志.
     *
     * @param \Exception $exception
     * @param string     $event
     * @param array      $extra
     *
     * @return $this
     */
    public function exception(\Exception $exception, $event = null, array $extra = [])
    {
        $record = new Record(LogCategory::EXCEPTION, $event, $exception->getTraceAsString(), $extra);
        $record->save(\Monolog\Logger::ERROR);

        return $this;
    }
}
