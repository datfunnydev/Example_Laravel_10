<?php

namespace App\Jobs;

use App\Models\LogActivity;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class CreateLogActivity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $id;

    private string $activity;

    private Carbon $created_at;

    public function __construct(string $activity)
    {
        $this->id = Auth::id();
        $this->activity = $activity;
        $this->created_at = Carbon::now();
    }

    public function handle()
    {
        LogActivity::query()->create([
            'user_id' => $this->id,
            'activity' => $this->activity,
            'created_at' => $this->created_at,
        ]);
    }
}
