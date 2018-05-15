angular.module('myapp.services', [])

    .factory('EmployeeService', function($q) {

        var employees = [
            {"id": 1, "firstName": "Jastine", "lastName": "Govela", "Staff ID": 100,"title": "System Analyst II", "department": "IS", "cellPhone": "0763158517","email": "justine.govela7@gmail.com", "city": "Dar","pic": "Eugene_Lee.jpg"},
            {"id": 2, "firstName": "Fanuel", "lastName": "YengaYenga", "Staff ID": 20,"title": "System Administrator", "department": "IS", "cellPhone": "0753260210","email": "fanuel.yengayenga@ppra.go.tz", "city": "Dar","pic": "Eugene_Lee.jpg"}
        ];

        // We use promises to make this api asynchronous. This is clearly not necessary when using in-memory data
        // but it makes this service more flexible and plug-and-play. For example, you can now easily replace this
        // service with a JSON service that gets its data from a remote server without having to changes anything
        // in the modules invoking the data service since the api is already async.

        return {
            findAll: function() {
                var deferred = $q.defer();
                deferred.resolve(employees);
                return deferred.promise;
            },

            findById: function(employeeId) {
                var deferred = $q.defer();
                var employee = employees[employeeId - 1];
                deferred.resolve(employee);
                return deferred.promise;
            },

            findByName: function(searchKey) {
                var deferred = $q.defer();
                var results = employees.filter(function(element) {
                    var fullName = element.firstName + " " + element.lastName;
                    return fullName.toLowerCase().indexOf(searchKey.toLowerCase()) > -1;
                });
                deferred.resolve(results);
                return deferred.promise;
            },

            findByManager: function (managerId) {
                var deferred = $q.defer(),
                    results = employees.filter(function (element) {
                        return parseInt(managerId) === element.managerId;
                    });
                deferred.resolve(results);
                return deferred.promise;
            }

        }

    })
	 .factory('config', function() {
	   
    return {
	    defaultRoute: '/app/employees',
		session: 'session',
		credentials: 'credentials',
	    stockSave:'stockSaveData',
		stockInitData:'stockInitData',
		paymentInitData:'paymentInitData',
		saleSave:'saleSaveData',
        saleInitData:'saleInitData',
		fuelSave:'fuelSaveData',
		marketSave:'marketSaveData',
		activationSave:'activationSaveData',
		paymentSave:'paymentSaveData',
		set_workLocation: 'workingLocation',
		serverUrl: 'http://localhost'
       // serverUrl: 'http://lsf.co.tz'
    };
})
	 
	 .factory('localstorage', ['$window', function($window) {
        return {
            set: function(key, value) {
                $window.localStorage[key] = value;
            },
            get: function(key, defaultValue) {
                return $window.localStorage[key] || defaultValue;
            },
            setObject: function(key, value) {
                $window.localStorage[key] = JSON.stringify(value);
            },
            getObject: function(key) {
                return JSON.parse($window.localStorage[key] || '{}');
            }
        };
    }])
	 

        .factory('http', function(loading,$http) {
    return {
        request: function(type, url, loadingMsg, data) {
           // loading.show(loadingMsg);
            var promise = $http({
                method: type,
                url: url,
                data: data,
                headers: {
                    'Content-Type': undefined
                }
            }).then(function(response) {
               // loading.hide();
                //return data
                return response.data;
            }, function(error) {
                console.log(error);
               // loading.hide();
                //show popup
                popup.alert('Alert', 'Network error occured', 'error');
            });
            return promise;
        }

    }
})
        .factory('loading', function($ionicLoading) {
    return {
        show: function(loadingMsg) {
            $ionicLoading.show({
                template: loadingMsg
            });
        },
        hide: function() {
            $ionicLoading.hide();
        }
    };
})
		   .factory('popup', function($ionicPopup) {
    return {
        alert: function(title, message, type) {
            $ionicPopup.alert({
                title: title,
                template: message
            });
        },
        confirm: function(message) {
            var confirmPopup = $ionicPopup.confirm({
                title: 'Warning',
                template: message
            });
            return confirmPopup;
        }
    };
})
		   
 .factory('network', function($cordovaNetwork) {
    return {
        isOnline: function() {
            return $cordovaNetwork.isOnline();
        }
    };
})
   .factory('offline', function(localstorage, config) {
    return {
        saveCredential: function(credential) {
            localstorage.setObject(config.credentials, credential);
        },
        getCredential: function() {
            return localstorage.getObject(config.credentials);
        },
        hasUnsyncData: function(){
         var stock = [];
             stock = localstorage.getObject(config.stockSave);
             if(stock.length > 0)
                 return true;
            return false; 
        }
    };
});