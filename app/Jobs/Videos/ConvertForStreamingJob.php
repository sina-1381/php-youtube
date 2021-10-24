<?php

namespace App\Jobs\Videos;

use Illuminate\Contracts\Queue\ShouldQueue;

class ConvertForStreamingJob implements ShouldQueue
{

    public $video;
    public $title;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($video, $title)
    {
        $this->video = $video;
        $this->title = $title;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo "converting";
    }
}
