<ul ng-controller="SidenavController" class='side-nav fixed'>

    <li><h5 class="h5"><i class='material-icons'>group_work</i>TOPICS</h5></li>
    <li><a class="btn" ng-click="createTopic()">Ajouter un topic</a></li>
    <li ng-repeat="topic in topics">
        <a href="{{ url('/topic') }}/@{{topic.id}}" class="collection-item"><span class="badge"></span>@{{topic.nom}}</a>
    </li>
    <li><h5 class="h5"><i class='material-icons'>contacts</i>CONTACTS</h5></li>
     <li><a class="btn" ng-click="addContact()">Ajouter un contact</a></li>
     <li ng-repeat="contact in contacts">
         <a href="{{ url('/contact') }}/@{{contact.id}}" class="collection-item">
            <div class='connected-user z-depth-2'></div>
            <span class="badge"></span>@{{contact.name}}</a>
            <a class="btn" ng-click="deleteContact(contact.id)">Supprimer</a>

    </li>
</ul>

