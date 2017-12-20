@extends('layouts.master')

@section('title', 'Report')

@section('body')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Request information
                </div>

                <div class="card-body">
                    @if ($request->error_message)
                        <div class="alert alert-danger" role="alert">
                            <h6 class="alert-heading">Xebia Header Checker failed to execute the request</h6>

                            {{$request->error_message}}
                        </div>
                    @endif

                    <dl class="row">
                        <dt class="col-sm-3">Url</dt>
                        <dd class="col-sm-9">
                            <a href="{{$request->endpoint->url}}" rel="noopener noreferrer" target="_blank">
                                {{$request->endpoint->url}}
                            </a>
                        </dd>

                        <dt class="col-sm-3">Method</dt>
                        <dd class="col-sm-9">{{$request->endpoint->method}}</dd>

                        <dt class="col-sm-3">Profile</dt>
                        <dd class="col-sm-9">{{$request->profile->name}}</dd>
                    </dl>

                    @if ($request->requestHeaders->count() > 0)
                        <h4>Request headers</h4>

                        <dl class="row">
                            @foreach ($request->requestHeaders as $requestHeader)
                                <dt class="col-sm-3">{{$requestHeader->name}}</dt>
                                <dd class="col-sm-9">{{$requestHeader->value}}</dd>
                            @endforeach
                        </dl>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @foreach ($request->responses as $key => $response)
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Response {{$key + 1}} information
                    </div>

                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-3">Status code</dt>
                            <dd class="col-sm-9">{{$response->status_code}}</dd>

                            <dt class="col-sm-3">Reason phrase</dt>
                            <dd class="col-sm-9">{{$response->reason_phrase}}</dd>

                            @if ($locationResponseHeader = $response->responseHeaders->where('name', 'Location')->first())
                                <dt class="col-sm-3">Location</dt>
                                <dd class="col-sm-9">
                                    <a href="{{$locationResponseHeader->value}}" target="_blank">
                                        {{$locationResponseHeader->value}}
                                    </a>
                                </dd>
                            @endif
                        </dl>

                        <h4>Findings</h4>
                        @if (count($response->findings) > 0)
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Header name</th>
                                    <th>Validation type</th>
                                    <th>Risk level</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($response->findings as $finding)
                                    <tr>
                                        <td>
                                            <strong>{{$finding['name']}}</strong>
                                            @if ($finding['description'])
                                                <br>
                                                {{$finding['description']}}
                                            @endif
                                        </td>
                                        <td>
                                            {{$finding['validation_type']}}
                                            @if ($finding['validation_value'])
                                                <br>
                                                {{$finding['validation_value']}}
                                            @endif
                                        </td>
                                        <td>{{$finding['risk_level']}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-success" role="alert">
                                Hurray this response doesn't have findings!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection