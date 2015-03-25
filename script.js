(function(angular) {
  angular.module('ngViewExample', ['ngRoute', 'ngMap', 'infinite-scroll', 'ui.bootstrap'])
    .config(['$routeProvider', '$locationProvider',
      function($routeProvider, $locationProvider) {
        $routeProvider
          .when('/', {
            templateUrl: '/find.tpl.html',
            controller: 'findCtrl',
            controllerAs: 'find'
          })
          .when('/:type?/:place?/', {
            templateUrl: '/find.tpl.html',
            controller: 'findCtrl',
            controllerAs: 'find'
          })
          .when('/:type?/:place?/:f1*', {
            templateUrl: '/find.tpl.html',
            controller: 'findCtrl',
            controllerAs: 'find'
          });
      //  $locationProvider.html5Mode(true);
      }
    ])
    .controller('findCtrl', ['$routeParams', '$scope', '$http', '$interval',
      function($routeParams, $scope, $http, $interval) {
        this.params = $routeParams;
        $scope.area_contains_str_latlng = function(LatLng) {
          return area.contains_str_latlng(LatLng);
        };
        $scope.mapFilter = false;
        $scope.mapShow = false;
        $scope.point = {};
        $mapFilter = false;
        $scope.show = function(event, id) {
          //  $scope.point = $scope.listedPoints[id];
          if (id) $(location).attr('href', $scope.listedPoints[id].url);
        };
        $scope.$on('mapInitialized', function(event, evtMap) {
          map = evtMap;
          $scope.map = map;
        });
        $scope.idle = function(event) {
          if ($scope.mapFilter == false) {
            map.fitBounds(area.bounds);
          }
          else {
            area.bounds = map.getBounds();
            $scope.$apply();
          }
          if ($scope.setHeight == undefined || $scope.setHeight != $('#themap').parent().height()) {
            $scope.setHeight = $('#themap').parent().height();
            $('#themap').height($scope.setHeight);
          }
          google.maps.event.trigger(map, 'resize');
          // $scope.loadMore();
          //  alert('idle');
        };
        $scope.map_click = function(event) {
          // turn on filter by map
          $scope.mapFilter = true;
        };
        $scope.zoomChanged = function(event) {};
        $scope.midPoint = function(inputs) {
          if ($scope.mapFilter === true) {
            return false;
          }
          else {
            if (inputs != undefined && inputs.length) {
              var i = 0;
              area.reset();
              for (i in inputs) {
                if (inputs[i].LatLng) {
                  var input_lat = +(inputs[i].LatLng.split(',')[0]);
                  var input_lng = +(inputs[i].LatLng.split(',')[1]);
                  area.extend(input_lat, input_lng);
                }
              }
              // set zoom
              return area.bounds.getCenter().lat() + ", " + area.bounds.getCenter().lng();
            }
          }
        };
        if ($scope.items === undefined) {
          $scope.items = [];
        }
        $scope.facilities = [];
        $scope.facilitiesFilter = [];
        $scope.facilitiesFilterTog = function(index) {
          var filtered_index = $scope.facilitiesFilter.indexOf($scope.facilities[index]);
          if (filtered_index === -1) {
            $scope.facilitiesFilter.push($scope.facilities[index]);
          }
          else {
            $scope.facilitiesFilter.splice(filtered_index, 1);
          }
        };
        $scope.facilitiesFilterIndexOf = function(text) {
          var filtered_index = $scope.facilitiesFilter.indexOf(text);
          if (filtered_index === -1) {
            return false;
          }
          else {
            return true;
          }
        };
        $scope.decodeURI = function(t) {
          return decodeURIComponent(t);
        };
        $scope.filterFn = function(cat) {
          if ($scope.allitems.length > 0) $scope.loadMore();
          $scope.typeFilter = cat_filter[2];
          var $print_me = 0;
          for (var k in cat.facilities) {
            if (typeof cat.facilities[k] !== 'function') {
              var index = $scope.facilities.indexOf(cat.facilities[k]);
              if (index === -1) {
                $scope.facilities.push(cat.facilities[k]);
              }
              if ($scope.facilitiesFilter.length > 0) {
                for (var f in $scope.facilitiesFilter) {
                  if (typeof $scope.facilitiesFilter[f] !== 'function') {
                    if (cat.facilities[k] == $scope.facilitiesFilter[f]) {
                      $print_me++;
                    }
                  }
                }
              }
            }
          }
          if ($print_me !== $scope.facilitiesFilter.length) {
            return false;
          }
          return true; // this will be listed in the results
        };
        $http.get('/index.json').success(function(thisdata) {
          if (cat_filter[0]) {
            $scope.items = thisdata;
            $scope.allitems = [];
          }
          else {
            $scope.allitems = thisdata;
            var i;
            for (i = 0; i <= 840; i++) {
              $scope.items.push($scope.allitems.shift());
            }
          }
        });
        var loadStuff = $interval(function() {
          $scope.loadMore();
        }, 2000);
        $scope.loadMore = function() {
          if ($scope.allitems != undefined) {
            if ($scope.allitems.length > 0) {
              if (cat_filter.length > 0) {
                $scope.items = $scope.items.concat($scope.allitems);
                $scope.allitems = [];
              }
              else {
                for (var i = 1; i <= 40; i++) {
                  $scope.items.push($scope.allitems.shift());
                }
              }
            }
            else {
              $interval.cancel(loadStuff);
            }
          }
        };
      }
    ])
    .directive('navBlock', function() {
      return {
        restrict: 'E',
        templateUrl: '/Angular Blocks/nav-block.html'
      };
    });
})(window.angular);
// End of Demo Scripts

var cat_filter = Array();
if (window.location.href.indexOf("?") > 15) {
  window.location.href = "https://essentialhotels.co.uk/index.php?" + window.location.href.split("?").pop();
}
//
//globles
//
var map;
var area;

jQuery(document).ready(function($) {

  area = {
    reset: function() {
      this.bounds = new google.maps.LatLngBounds();
    },
    bounds: new google.maps.LatLngBounds(),
    contains_str_latlng: function(LatLng) {
      if (LatLng !== undefined) {
        return this.contains(+LatLng.split(',')[0], +LatLng.split(',')[1]);
      }
    },
    contains: function(lat, lng) {
      var point = new google.maps.LatLng(lat, lng);
      return this.bounds.contains(point);
    },
    extend: function(lat, lng) {
      var point = new google.maps.LatLng(lat, lng);
      this.bounds.extend(point);
    }
  };
});
