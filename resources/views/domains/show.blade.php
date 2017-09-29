@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col">
                <h1>Manage Domain</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Host Details</h4>
                        <form action="/domains/{{ $domain->id }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label>Host</label>
                                <input type="text" class="form-control" name="host" value="{{ $domain->host }}">
                            </div>
                            <div class="form-group">
                                <label>Issuer</label>
                                <input type="text" class="form-control" name="issuer" value="{{ $domain->issuer }}">
                            </div>
                            <div class="form-group">
                                <label>Expires At</label>
                                <input type="text" class="form-control" name="expires_at" value="{{ $domain->expires_at }}">
                            </div>
                            <div class="form-group">
                                <label>On WPEngine?</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" @if($domain->on_wpengine) checked @endif> Yes
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="0" @if(!$domain->on_wpengine) checked @endif> No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <a href="/" class="btn btn-link">Cancel</a>
                                <button type="submit" class="btn btn-success btn-lg">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @stop