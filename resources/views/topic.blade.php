@extends('layout')
@section('sidenav')
    @include('sidenav')
@endsection
@section('content')

    <div ng-controller='TopicController'>
        <div>
            <h4>
                <a class='btn' ng-click="renameTopic(topic.id)">@{{ topic.nom }}</a>
                </h4>
            <a class='btn' ng-click="leaveTopic(topic.id)">Quitter le topic</a>
            <a class='btn' ng-click="addContactsToTopic(topic.id)">Ajouter des contacts</a>
            <a class='btn' ng-click="deleteContactFromTopic(topic.id)">Supprimer un contact</a>
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