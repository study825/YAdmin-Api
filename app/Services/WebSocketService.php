<?php

namespace App\Services;

use Hhxsv5\LaravelS\Swoole\WebSocketHandlerInterface;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

class WebSocketService implements WebSocketHandlerInterface
{
    // Declare constructor without parameters
    public function __construct()
    {
    }

    public function onOpen(Server $server, Request $request)
    {
        $clientList = $server->getClientList(0);

        $temp = [];
        //通知所有客户端
        if ($clientList) {
            foreach ($clientList as $fd) {
                if (0 != $server->getClientInfo($fd)['websocket_status']) {
                    $temp[] = $fd;
                }
            }

            foreach ($temp as $fd) {
                if (0 != $server->getClientInfo($fd)['websocket_status']) {
                    $server->push($fd, count($temp));
                }
            }
        }


    }

    public function onMessage(Server $server, Frame $frame)
    {
        // \Log::info('Received message', [$frame->fd, $frame->data, $frame->opcode, $frame->finish]);
        // The exceptions thrown here will be caught by the upper layer and recorded in the Swoole log. Developers need to try/catch manually.

//        $clientList = $server->getClientList(0);
//        $server->push($frame->fd, count($clientList));
    }

    public function onClose(Server $server, $fd, $reactorId)
    {
        $clientList = $server->getClientList(0);

        //通知所有客户端
        if ($clientList) {
            $temp = [];

            foreach ($clientList as $fd) {
                if (0 != $server->getClientInfo($fd)['websocket_status']) {
                    $temp[] = $fd;
                }
            }


            $clientList = array_filter($temp, function ($item) use ($fd) {
                if ($item == $fd) {
                    return false;
                }
                return true;
            });

            var_dump($clientList);
            //通知所有客户端
            if ($clientList) {
                foreach ($clientList as $client) {
                    $server->push($client, count($clientList));
                }
            }
        }
    }
}