@extends('layout')
@section('content')
<div class="index-conntent" ng-app="indexApp" ng-controller="jobController">
	<div id="left-column">
		<div class="clr"><br></div>
		<div id="featured-listings">
			<div id="featured-head">New Social Job</div>
			<div class="new-job-list" ng-repeat="job in jobList">
				<div class="featured job">
					<div class="featuredListings">
						<a href="./job/<% job.id_social %>"><% job.title %></a><br>
						<span class="green">
							<% job.author_name %>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="clr"><br></div>
	</div>
	<!-- End left collumn -->
	<!-- Right collumn -->
	<div id="right-column">
		<div class="white-block featured-companies">
			<h2>Featured Companies</h2>
			<span class="sep-line">&nbsp;</span>
			<div class="new-source-list" ng-repeat="logo in sourceList">
				<div class="FeaturedCompaniesLogo">
					<a href="http://facebook.com/<% logo.id_source %>" target="_blank">
						<img src="http://graph.facebook.com/<% logo.id_source %>/picture?height=150&width=150" />
					</a>
				</div>
			</div>
			<div class="clr"><br></div>
			<div class="view-all">
				<a href="#">View All Companies</a>
			</div>
		</div>
	</div>
</div>
<!-- End right collumn -->
<script type="text/javascript" charset="utf-8">
	(function() {
		var indexApp = angular.module('indexApp', [], function($interpolateProvider) {
		$interpolateProvider.startSymbol('<%');
		$interpolateProvider.endSymbol('%>');
	});
		indexApp.controller('jobController', function($scope, $http){
			$scope.jobList = [];
			$scope.sourceList = [];
	$scope.init = function() {
	// Get new Job
	$http({
	url: './api/job/new',
	method: "GET"
	}).success(function(data, status, headers, config) {
	$scope.jobList = data[0].job;
		// console.log('Data: ', $scope.jobList)
	});
	// Get source list
	$http({
	url: './api/source/new',
	method: "GET"
	}).success(function(data, status, headers, config) {
	$scope.sourceList = data[0].source;
		// console.log('Data: ', $scope.sourceList)
	});
	};
	$scope.init();
		});
	})();
</script>
@endsection