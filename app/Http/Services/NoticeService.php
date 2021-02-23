<?php

namespace App\Http\Services;

use App\Models\Notice;

/**
 * Class NoticeService
 *
 * @package App\Http\Services
 */
class NoticeService
{
    public function getNoticeList()
    {
        return Notice::query()->get()->toArray();
    }
}