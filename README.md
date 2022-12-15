## YAdmin-后台管理系统
> YAdmin管理后台，包含登录、权限管理、站内信等功能。项目代码简练，逻辑清晰明了。可以基于该管理后台，开发"业务系统"，节省开发时间。

#### 依赖
- PHP7.2
- Swoole 4.6.0
- LaravelS 3.7.16
- Laravel Framework 6.20.16

#### 运行方式(一)
- 操作命令： `php bin/laravels {start|stop|restart|reload|info|help}`。

| 命令 | 说明 |
| --------- | --------- |
| start | 启动LaravelS，展示已启动的进程列表 "*ps -ef&#124;grep laravels*" |
| stop | 停止LaravelS，并触发自定义进程的`onStop`方法 |
| restart | 重启LaravelS：先平滑`Stop`，然后再`Start`；在`Start`完成之前，服务是`不可用的` |
| reload | 平滑重启所有Task/Worker/Timer进程(这些进程内包含了你的业务代码)，并触发自定义进程的`onReload`方法，不会重启Master/Manger进程；修改`config/laravels.php`后，你`只有`调用`restart`来完成重启 |
| info | 显示组件的版本信息 |
| help | 显示帮助信息 |

#### 运行方式(二)
- php artisan serve

#### 运行方式(三)
- Nginx or apache
