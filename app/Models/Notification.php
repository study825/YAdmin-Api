<?php

namespace App\Models;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Str;

class Notification extends DatabaseNotification
{
    public static function getList($guard, array $validated): array
    {
        $model = Notification::whereNotifiableType(get_class($guard))
            ->whereNotifiableId($guard->id)
            ->when($validated['message'] ?? null, function ($query) use ($validated) {
                return $query->where('data', 'like', '%' . $validated['message'] . '%');
            })
            ->when(isset($validated['is_read']), function ($query) use ($validated) {
                if ($validated['is_read'] === 0) {
                    return $query->whereNull('read_at');
                } else {
                    return $query->whereNotNull('read_at');
                }
            })
            ->when($validated['start_at'] ?? null, function ($query) use ($validated) {
                return $query->whereBetween('created_at', [$validated['start_at'], $validated['end_at']]);
            });

        $total = $model->count('id');

        $notifications = $model->select([
            'id',
            'data',
            'read_at',
            'created_at',
            'updated_at'
        ])
            ->orderBy($validated['sort'] ?? 'created_at', $validated['order'] === 'ascending' ? 'asc' : 'desc')
            ->offset(($validated['offset'] - 1) * $validated['limit'])
            ->limit($validated['limit'])
            ->get()
            ->map(function ($notification) {
                // 只保留KEY值 去除HTML标签 最多100个字符 拼接...
                $data = preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/", " ", strip_tags(implode(' ', $notification->data)));
                $notification->data = Str::limit($data, 100, '...');
                return $notification;
            });

        return [
            'notifications' => $notifications,
            'total' => $total
        ];
    }
}