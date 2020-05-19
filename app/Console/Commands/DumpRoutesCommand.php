<?php
/**
 * LUMEN API ( https://github.com/viticm/lumen-api )
 * $Id DumpRoutesCommand.php
 * @link https://github.com/viticm/lumen-api for the canonical source repository
 * @copyright Copyright (c) 2020 viticm( viticm.ti@gmail.com )
 * @license
 * @user viticm( viticm.ti@gmail.com )
 * @date 2020/05/18 17:19
 * @uses The dump route list file command.
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\RouteController;

class DumpRoutesCommand extends Command
{

    /**
     * 命令名称
     * 
     * @var string
     */ 
    protected $signature = 'dump_routes';

    /**
     * 命令描述
     * 
     * @var string
     */
    protected $description = 'Dump the route list files';

    /**
     * Create a new command instance.
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 命令执行处理函数
     *
     * @return mixed
     */ 
    public function handle()
    {
        RouteController::dump();
        echo 'completed!!!'."\n";
    }

}
