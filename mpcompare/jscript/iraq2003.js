var iraq2003 = angular.module('iraq2003', []);

iraq2003.controller('mainController', ['$scope', '$filter', '$http', function ($scope, $filter, $http) {
	$scope.iraqResults = [];
	$scope.loadIraq = function () {
		url = '/politics/mpcompare/iraq2003api.php';
		console.log(url);
		$http.get(url)
			.success(function (result){
				console.log(result);
				$scope.iraqResults = result;
			})
			.error(function (data,status){
				console.log(data);
			})
	};
	$scope.mpPolicyLink = function(policyLink){
		return policyLink+"#dreammotions";
	}
	$scope.loadIraq();
}]);
