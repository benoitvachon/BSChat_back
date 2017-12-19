@extends('layout')
@section('sidenav')
    @include('sidenav')
@endsection
@section('content')

    <div ng-controller='ContactController'>
        <div>
            <h4>@{{ contact.name }}</h4>
        </div>
        <div class="topic-feed">
            <div class="container">
                <div ng-repeat="message in messages" class="row">
                    <div ng-if="user.id == message.idAuthor" class="card col s4 right">
                        <div class="card-content">
                            <p>@{{message.text}}</p>
                        </div>
                    </div>
                    <div ng-if="user.id != message.idAuthor" class="card col s4 left">
                        <div class="card-content">
                            <p>@{{message.text}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class='toolbar send-field'>
            <div class="input-field">
                <input type="text" id="message" class="validate" ng-model="text">
                <label for="message" class='left-align'>Envoyer un message</label>
            </div>

            <a class='btn' ng-click="postMessage()"><i class='material-icons left'>comment</i>ENVOYER</a>

        </div>
    </div>
@endsection