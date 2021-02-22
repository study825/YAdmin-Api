<?php
/**
 * Created by PhpStorm.
 * User: liqiang
 * Date: 2021-02-22
 * Time: 14:57
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Swoole\Server;

/**
 * Class WebsocketController
 *
 * @package App\Http\Controllers\Admin
 */
class WebsocketController extends Controller
{
    public function push()
    {
        $fd = 2; // Find fd by userId from a map [userId=>fd].
        /**@var \Swoole\WebSocket\Server $swoole */
        $swoole = app('swoole');

        $success = $swoole->push($fd, 'Push data to fd#1 in Controller');
        var_dump($success);
    }

    public function notice()
    {
        /**@var Server $swoole */
        $swoole = app('swoole');
        $clientFds = $swoole->getClientList(0);

        if ($clientFds) {
            foreach ($clientFds as $fd) {
                if (0 != $swoole->getClientInfo($fd)['websocket_status']) {
                    $swoole->push($fd, '通知');
                }
            }
        }
    }
}