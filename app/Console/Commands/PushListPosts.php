<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PushListPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pushlist:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'PushList draft post';

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = 'aaa';
        Log::channel('test')->info($data);

        // Post::query()->where('status',0)->update(['status'=>1]);

    }
}
