<?php
/**
 * This file is part of ruogu.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */

namespace Ruogoo\Log;

/**
 * 定义的日志类别
 * Class LogCategory.
 */
class LogCategory
{
    const INFO = 'info';    // 普通信息
    const EXCEPTION = 'exception';    // 异常
    const PV = 'page_view'; // 页面查看数
    const VISIT = 'visit';  // 访问量
    const API = 'api';      // 接口访问
    const TIME = 'time';    // 时间
}
