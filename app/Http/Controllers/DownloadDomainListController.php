<?php

namespace App\Http\Controllers;

use App\Domain;
use League\Csv\Writer;

class DownloadDomainListController extends Controller
{
    public function __invoke()
    {
        $domains = Domain::all();
        $writer  = Writer::createFromPath(public_path('/domains.csv'), 'w+');
        $writer->insertOne(['host', 'issuer', 'expires_at', 'on_wpengine']);
        $writer->insertAll($domains->toArray()); //using an array

        return response()->download(public_path('/domains.csv'))->deleteFileAfterSend(true);
    }
}
