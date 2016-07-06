var mpcompare = angular.module('mpcompare', []);

mpcompare.controller('mainController', ['$scope', '$filter', '$http', function ($scope, $filter, $http) {
	$scope.mps = [];
	$scope.policies = [6685,1039,6711,1052,852,6686,1065,1049,984,1087,6673];
	$scope.mpsLeaders = [86, 119, 196, 511, 373, 93];
	$scope.mpsConLeaders = [354,209,236,124,396];
	$scope.mpsLabLeaders = [119,77,118,336];
	$scope.mpsBrexit = [86,465,119,320,236];
	$scope.mpsSelCon = [86,465,396,260,306,438,314];
	$scope.mpsSelLab = [119,408,618,1,174];
	$scope.mpsSelLib = [196, 107, 348, 91];
	$scope.mpsSelSNP = [ 511, 521, 299, 43];
	$scope.policyResults = [];
	$scope.polEconomy = [6681,6752,6689,6680,1110,6730,6711,6690,6729,1124];
	$scope.polEurope = [1065,1014,1027,1015];
	$scope.polBusiness = [6685,6716,6733,6744,1012,1032,6712,1105,6679,6705,6691];
	$scope.polCrime = [1071,1039,1053];
	$scope.polEducation = [6687,1016,6682,1074,1132,367,1052];
	$scope.polForeign = [1115,1049,975,6706,984,6688,995];
	$scope.polWelfare = [6672,810,6702,6684,6743,6673,1109,6670,6707,6674];
	$scope.polDemocracy = [1120,6667,6736,1113,6698,1008,837,6709,6708,1051,6723,6721,6751,6758,6695,1119,856,6696,1084,629,6671,1136,1112,6717,6720,1079,6678,6683,1021,6731,996,842];
	$scope.polEnvironment = [1034,794,6710,1050,6704,6699,852,6741,6697,1030];
	$scope.polHealth = [813,6732,839,363,6676,6694,6677,812,811,1041];
	$scope.polEqual = [826,6703,6686,809];
	$scope.polImmigration = [1087,6734];
	$scope.polTransport = [827,6753,6693,6746,6692];
	$scope.mpFilter = "";
	$scope.mpSearchText = "";
	$scope.mpFilterParty = "";
	$scope.polFilter = "";
	$scope.polSearchText = "";
	$scope.loadSupportPolicies = function () {
		url = '/politics/mpcompare/policyapi.php?mps=' + $scope.mps.toString() + '&policies=' + $scope.policies.toString();
		console.log(url);
		$http.get(url)
			.success(function (result){
				console.log(result);
				$scope.policyResults = result.policies;
				$scope.mpDetails = result.mpNames;
				$scope.moreMps = result.moreMps
				$scope.morePolicies = result.morePolicies
			})
			.error(function (data,status){
				console.log(data);
			})
	};
	$scope.filterMoreMPs = function(moreMp) {
		if($scope.mpFilter=="party"){
			return (moreMp.mpParty === $scope.mpFilterParty);
		}else if($scope.mpFilter=="search"){
			return moreMp.mpName.toLowerCase().match($scope.mpSearchText.toLowerCase());
		} else {
			return true;
		}
	}

	$scope.mpPolicyLink = function(policyLink){
		return policyLink+"#dreammotions";
	}
	$scope.addMP = function(mpID){
		$scope.mps.push(mpID);
		$scope.loadSupportPolicies();
	}
	$scope.removeMP = function(mpID){
		for(var i = 0; i < $scope.mps.length; i++) {
		    if($scope.mps[i] == mpID) {
		        $scope.mps.splice(i, 1);
		        break;
		    }
		}
		$scope.loadSupportPolicies();
	}
	$scope.filterMorePolicies = function(morePolicy) {
		if($scope.polFilter=="search"){
			return morePolicy.policyName.toLowerCase().match($scope.polSearchText.toLowerCase());
		} else {
			return true;
		}
	}
	$scope.addPolicy = function(policyID){
		$scope.policies.push(policyID);
		$scope.loadSupportPolicies();
	}
	$scope.removePolicy = function(policyID){
		for(var i = 0; i < $scope.policies.length; i++) {
		    if($scope.policies[i] == policyID) {
		        $scope.policies.splice(i, 1);
		        break;
		    }
		}
		$scope.loadSupportPolicies();
	}
	$scope.keyMPs = function(keyGroup){
		$scope.mps =  keyGroup.slice(0);
		$scope.loadSupportPolicies();
	}
	$scope.keyPols = function(keyGroup){
		$scope.policies =  keyGroup.slice(0);
		$scope.loadSupportPolicies();
	}


	$scope.mps =  $scope.mpsLeaders.slice(0);
	$scope.loadSupportPolicies();

}]);
