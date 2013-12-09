var sitesApp = angular.module('sitesApp', [])

sitesApp.config(function($provide, $routeProvider) {
    $provide.factory('$routeProvider', function () {
        return $routeProvider;
    });
}).run(function($routeProvider, $http) {
    $routeProvider.when('/', {
        templateUrl:  base_url + 'sites/listing',
        controller: 'sitesController'
    }).when('/new', {
        templateUrl: base_url + 'sites/add',
        controller: 'addSiteController'
    }).when('/edit/:projectId', {
        templateUrl: base_url + 'sites/add',
        controller: 'editSiteController'
    }).when('/view/:projectId', {
        templateUrl: base_url + 'sites/view',
        controller: 'viewSiteController'
    }).when('/history/:projectId', {
        templateUrl: base_url + 'sites/history',
        controller: 'viewSiteHistoryController'
    }).otherwise({
        redirectTo: '/'
    });
});

sitesApp.factory('sitesFact', ['$http', '$rootScope', function($http, $rootScope) {
  var sites = [];

  return {
    getSitesDetails: function($sid) {
      return $http.get(base_url + 'sites/getjson/' + $sid).then(function (response) {
        sites = response.data;
        $rootScope.$broadcast('handleProjectsBroadcast', sites);
        return sites;
      });
    },
    addSites: function($params) {
      return $http({
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        url: base_url + 'sites/savejson',
        method: "POST",
        data: $params,
      })
      .success(function(addData) {
        sites = addData;
        $rootScope.$broadcast('handleProjectsBroadcast', sites);
      });
    },
    deleteSites: function($params) {
      return $http({
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        url: base_url + 'sites/delete',
        method: "POST",
        data: $params,
      })
      .success(function(addData) {
        //sites = addData;
        //$rootScope.$broadcast('handleProjectsBroadcast', sites);
      });
    }
  };
}]);

sitesApp.controller('sitesController', function(sitesFact,$scope, $location) {
 
  //get sites lists
  $sid = '';
  sitesFact.getSitesDetails($sid).then(function(sites) {
    $scope.sites = sites;
  });
  
});


sitesApp.controller('addSiteController', function(sitesFact,$scope, $location) {
  $scope.save = function() {
    $params = $.param({
      "sitename" : $scope.site.sitename,
      "email" : $scope.site.email,
      "path" : $scope.site.path
    });
    sitesFact.addSites($params).then(function(sites) {
      $location.path( base_url + 'sites/listing');
    });
  }
});


sitesApp.controller('viewSiteController', function($scope, $location,$routeParams, $http) {
  $sid = $routeParams.projectId;
  
  $params = $.param({
    "site_id" : $sid,
  });
  $http({
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    url: base_url + 'sites/viewjson',
    method: "POST",
    data: $params,
  })
  .success(function(siteData) {
    $scope.sitedata = siteData;
  });
});

sitesApp.controller('viewSiteHistoryController', function($scope, $location,$routeParams, $http) {
  $sid = $routeParams.projectId;
  console.log($sid);
  
  $params = $.param({
    "site_id" : $sid,
  });
  $http({
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    url: base_url + 'sites/historyjson',
    method: "POST",
    data: $params,
  })
  .success(function(reportData) {
    $scope.sitereportdata = reportData;
  });

});

sitesApp.controller('editSiteController', function(sitesFact,$scope, $location,$routeParams) {
  //get sites lists
  $sid = $routeParams.projectId;
  var self = this
  sitesFact.getSitesDetails($sid).then(function(sites) {
    self.original = sites;
    $scope.site = self.original;
    
    // $scope.site = sites;
  });
  
  
  $scope.save = function() {
    $params = $.param({
      "sitename" : $scope.site.sitename,
      "email" : $scope.site.email,
      "id" : $scope.site.id,
      "path" : $scope.site.path
    });
    sitesFact.addSites($params).then(function(sites) {
      $location.path( base_url + 'sites/listing');
    });
  }
  
  $scope.destroy = function() {
    $params = $.param({
      "id" : $scope.site.id
    });
    sitesFact.deleteSites($params).then(function(sites) {
      $location.path( base_url + 'sites/listing');
    });
  
  }
  
  
  
});
