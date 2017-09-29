@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Domains</h1>

            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="/domains" method="POST" enctype="multipart/form-data" class="form-inline">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="mr-3">Upload new domains</label>
                                <input type="file" name="csv">
                                <small class="text-muted">Supported formats: .csv</small>
                            </div>
                            <button class="btn btn-primary ml-3">Upload</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div class="d-flex mt-5">
            <a href="/domain-list" class="btn btn-primary btn-lg">Download List</a>
            <form method="GET" role="search" class="w-100 ml-3">
                <input type="search" class="form-control form-control-lg" name="q" placeholder="Search for domain" value="{{ old('q') }}">
            </form>
        </div>
        <div class="row mt-5">
            <div class="col">
                <table class="table">
                    <thead>
                        <th>Host</th>
                        <th>Issuer</th>
                        <th>Expires At</th>
                        <th>On WPEngine</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($domains as $domain)
                            <tr>
                                <td>{{ $domain->host }}</td>
                                <td>{{ $domain->issuer }}</td>
                                <td>{{ $domain->expires_at }}</td>
                                <th>{{ $domain->on_wpengine ? 'Yes' : 'No' }}</th>
                                <td>
                                    <a href="/domains/{{ $domain->id }}">Check Domain</a>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @stop