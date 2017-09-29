<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Jobs\GetSSLCertificate;
use Illuminate\Http\Request;
use League\Csv\Reader;

class DomainsController extends Controller
{
    public function index()
    {
        if(request()->filled('q')) {
            $domains = Domain::where('host','LIKE','%' . request('q') .'%')->orderBy('host','ASC')->get();
        } else {
            $domains = Domain::orderBy('host','ASC')->get();
        }
        request()->flash();

        return view('domains.index', ['domains' => $domains]);
    }

    public function store(Request $request)
    {
        $reader = Reader::createFromPath($request->file('csv')->getPathname());
        $records = $reader->getRecords();
        foreach($records as $host)
        {
            $domain = Domain::firstOrCreate(['host' => $host[0]]);
            dispatch(new GetSSLCertificate($domain));
        }

        return redirect('/');
    }

    public function show(Domain $domain)
    {
        return view('domains.show', ['domain' => $domain]);
    }

    public function update(Domain $domain, Request $request)
    {
        $domain->update($request->only(['host','issuer','expires_at','on_wpengine']));

        return redirect('/');
    }
}

