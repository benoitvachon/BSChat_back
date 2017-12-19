@extends('layout')
@section('sidenav')
@include('sidenav')
@endsection
@section('content')
<div class="container" ng-controller="ProfileController">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @{{user.nom}}
                @{{user.email}}
            </div>
        </div>
    </div>
</div>
@endsection
