<table class="table table-bordered table-hover table-striped">
  <thead>
  <tr>
    <th>Sites</th>
    <th>Total time</th>
    <th>Connect time</th>
    <th>Created</th>
  </tr>
  </thead>
  <tbody>
  <tr ng-repeat="site in sitereportdata">
    <td><a href="#/view/{{site.site_id}}">{{site.site_id}}</a></td>
    <td>{{site.total_time}}</td>
    <td>{{site.connect_time}}</td>
    <td>{{site.created}}</td>
  </tr>
  </tbody>
</table>