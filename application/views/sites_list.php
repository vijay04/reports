<input type="text" ng-model="search" class="search-query" placeholder="Search">
<div></div>
  <table class="table table-bordered table-hover table-striped">
      <thead>
      <tr>
        <th>Sites</th>
        <th>Email</th>
        <th><a href="#/new"><i class="icon-plus-sign"></i></a></th>
      </tr>
      </thead>
      <tbody>
      <tr ng-repeat="site in sites | filter:search | orderBy:'sitename'">
        <td><a href="{{site.path}}" target="_blank">{{site.sitename}}</a></td>
        <td>{{site.email}}</td>
        <td>
          <a href="#/edit/{{site.id}}"><i class="icon-pencil"></i></a>
        </td>
      </tr>
      </tbody>
    </table>