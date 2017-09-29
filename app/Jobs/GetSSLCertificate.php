<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Spatie\SslCertificate\SslCertificate;

class GetSSLCertificate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $domain;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($domain)
    {
        $this->domain = $domain;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $certificate = SslCertificate::download()->withVerifyPeer(false)->withVerifyPeerName(false)->forHost($this->domain->host);
            if ($certificate->getDomain() == '*.wpengine.com') {
                $this->domain->update(['on_wpengine' => true]);
            } else {
                $this->domain->update([
                    'issuer'     => $certificate->getIssuer(),
                    'expires_at' => $certificate->expirationDate(),
                ]);
            }
        } catch (\Exception $e) {

        }
    }
}
