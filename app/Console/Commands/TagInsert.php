<?php

namespace App\Console\Commands;

use App\Models\Tags;
use Illuminate\Console\Command;

class TagInsert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tag:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $arr = ['a','b','c','d'];
        foreach ($arr as $title )
        {
            Tags::create([
                'title'=>$title,

            ]);
        }

    }
}
