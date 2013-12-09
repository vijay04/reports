 <!-- Add sites form -->
    
     <form name="siteAddForm" ng-submit="save()">
      <div class="control-group" ng-class="{error: myForm.name.$invalid}">
        <label>Name</label>
        <input type="text" name="sitename" ng-model="site.sitename" required>
        <span ng-show="myForm.name.$error.required" class="help-inline">
            Required</span>
      </div>
    
      <div class="control-group" ng-class="{error: myForm.site.$invalid}">
        <label>Website</label>
        <input type="url" name="site" ng-model="site.path" required>
        <span ng-show="myForm.site.$error.required" class="help-inline">
            Required</span>
        <span ng-show="myForm.site.$error.url" class="help-inline">
            Not a URL</span>
      </div>
    
      <label>Email</label>
      <input name="description" ng-model="site.email" type="email" required>
    
      <br>
      <a href="#/" class="btn">Cancel</a>
      <!--<button ng-click="save()" ng-disabled="isClean() || myForm.$invalid"
              class="btn btn-primary">Save</button>-->
              <input type="submit" value="Save" class="btn btn-primary">
      <button ng-click="destroy()"
              ng-show="site.id" class="btn btn-danger">Delete</button>
    </form>