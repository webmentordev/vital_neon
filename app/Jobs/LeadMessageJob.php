<?php

namespace App\Jobs;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class LeadMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Lead $lead;
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    public function handle(): void
    {
        $lead = $this->lead;
        $source = $lead->source ? $lead->source : '-';
        $content = "A new lead has been recieved\n".
        "**Name**: {$lead->name}\n".
        "**Email**: {$lead->email}\n".
        "**Contact**: {$lead->phone_number}\n".
        "**Location**: {$lead->location}\n".
        "**Dimensions**: {$lead->dimensions}\n".
        "**Budget**: {$lead->budget}\n".
        "**Ip Address**: {$lead->ip_address}\n";
        "**Source**: {$source}\n".
        "=============================";
        Http::post(config('app.design'), [
            'content' => $content
        ]);
    }
}
