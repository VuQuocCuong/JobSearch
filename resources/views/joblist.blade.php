@extends('layout') @section('content')
<div id="main-div-after" ng-app="joblistApp" ng-controller="joblistController">
    <div class="results ">
        <div class="results-paging">
            <div class="head">
                <h1>Found <% jobCount %> job</h1>
            </div>
            <!-- TOP RESULTS - PER PAGE - PAGE NAVIGATION -->
            <div class="topNavBar">
                <form id="listings_per_page_form" method="get" action="" class="" style="width: 100%">
                	<div class="numberPerPage" >
                		<span>Order by</span>
                        <select id="sort-by-select" name="sort-by-select">
                            <option value="activation_date" selected="selected">Created Time</option>
                        </select>
                    </div>
                	<div class="numberPerPage" style="float:right; position: relative; right: 0;">
                    	<span>Number of jobs per page</span>
                        <select id="listings_per_page" name="listings_per_page" ng-model="selectedItem" ng-change="updateLimit()">
                            <option value="10" selected="selected">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                	</div>
                </form>
                <div class="clr"></div>
            </div>
            <!-- END TOP RESULTS - PER PAGE - PAGE NAVIGATION -->
        </div>
        <!-- START REFINE SEARCH -->
        <div id="refineResults-block">
            <div id="blockBg">
                <div id="blockTop"></div>
                <div id="blockInner">
                    <div id="ajaxRefineSearch">
                        <table cellpadding="0" cellspacing="0" id="currentSearch">
                            <thead>
                                <tr>
                                    <th class="tableLeft">&nbsp;</th>
                                    <th>&nbsp;Current Search:</th>
                                    <th class="tableRight">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        <div class="separate-div">
                                            <div class="currentSearch"><span class="strong">Keywords</span></div>
                                            <span class="curSearchItem">
												<% keywords %>
											</span>
                                        </div>
                                        <br>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table cellpadding="0" cellspacing="0" width="100%" id="refineResults">
                            <thead>
                                <tr>
                                    <th class="tableLeft">&nbsp;</th>
                                    <th>Job Source</th>
                                    <th class="tableRight">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        <div class="refine_block" ng-repeat="source in jobSource">
                                            <div class="refineItem">
                                                <a ng-href="javascript: void(0)" ng-click="findBySource(source.id_source)"><% source.name %></a> 
                                            </div>
                                        </div>
                					</td>
                				</tr>
                			</tbody>
                		</table>
            		</div>
        		</div>
    		</div>
		</div>
<!-- END REFINE SEARCH -->
<!-- LISTINGS TABLE -->
		<div id="listingsResults">
				<!-- preloader row here -->
            <div class="preloader">
                <div><img src="../img/ajax_preloader_circular_32.gif"></div>
            </div>
		    <table cellspacing="0">
		        <tbody class="searchResultsJobs" ng-repeat="job in jobData">
		            <!-- Job Info Start -->
		            <tr class="priorityListing">
		                <td>
		                    <div class="listing-section">
		                        <div class="listing-title">
		                            <a name="listing_35"><img src="../img/fbjob.png" width="30px"></a>
		                            <a ng-href="/job/<% job.id_social %>"><% job.title %></a>
		                        </div>
		                        <div class="listing-info">
		                            <div class="right-side">
		                                <a href="">
		                                    <center><img src="" alt=""></center>
		                                </a>
		                            </div>
		                            <div class="left-side">
		                                <!-- <span class="captions">Source:</span><span class="captions-field"><% job.name %></span> -->
		                                <span class="captions">Author:</span><span class="captions-field">
											<a ng-href="http://facebook.com/<% job.author %>" target="_blank"><% job.author_name %></a>
										</span>
		                                <span class="captions">Posted:</span><span class="captions-field"><% job.created_at %></span>
		                            </div>
		                        </div>
		                        <div class="clr"></div>
		                    </div>
		                </td>
		            </tr>
		            <!-- END Job Info Start -->
		        </tbody>
		    </table>
		    <div class="pageNavigation">
		        <span class="prevBtn">
					<a ng-href="javascript: void(0)" ng-click="prePage()">Previous</a></span>
		        <span class="navigationItems">
					<span class="strong"><% page + 1 %></span>
		        </span>
		        <span class="nextBtn"><a ng-href="javascript: void(0)" ng-click="nextPage()">Next</a></span>
		    </div>
		</div>
<!-- END LISTINGS TABLE -->
<!-- END BOTTOM RESULTS - PER PAGE - PAGE NAVIGATION -->
	</div>
	<div class="clr"><br></div>
</div>
<script type="text/javascript" charset="utf-8">
	(function() {
		var joblistApp = angular.module('joblistApp', [], function($interpolateProvider) {
			$interpolateProvider.startSymbol('<%');
			$interpolateProvider.endSymbol('%>');
		});
		joblistApp.controller('joblistController', function($scope, $http){
			var searchObject 	= window.location.search;
			$scope.keywords 	= searchObject.split('keywords=')[1] || '';

			$scope.jobData = [];
			$scope.jobCount = [];
			$scope.jobSource = [];
			$scope.page = 0;
			$scope.id_source = '';
			$scope.limit = 10;
			$scope.offset = $scope.limit * $scope.page;

			$scope.init = function() {
				$('.preloader').show();
				$http({
					url: '/api/job/search',
					method: "GET",
					params: {
						keywords 	: $scope.keywords || '',
						id_source	: $scope.id_source || '',
						limit 		: $scope.limit || 10,
						offset 		: $scope.offset || 0
					}
				}).success(function(data, status, headers, config) {
					$scope.jobData = data;
					$('.preloader').hide();
				});
				$http({
					url: '/api/job/count',
					method: "GET",
					params: {
						keywords 	: $scope.keywords || '',
						id_source	: $scope.id_source || '',
						limit 		: $scope.limit || 10,
						offset 		: $scope.offset || 0
					}
				}).success(function(data, status, headers, config) {
					$scope.jobCount = data;
				});
			};
			// Get source list
			$scope.getSourceList = function()
			{
				$http({
					url: '/api/source/all',
					method: "GET"
				}).success(function(data, status, headers, config) {
					$scope.jobSource = data;
					// console.log('Data: ', data)
				});
			}
			$scope.init();
			$scope.getSourceList();

			$scope.findBySource = function (id_source) {
				$scope.id_source = id_source;
				$scope.init();
			};
			$scope.updateLimit = function () {
				$scope.limit 	= $scope.selectedItem;
				$scope.page = 0;
				$scope.init();
			};
			$scope.nextPage = function() {
				$scope.page++;
				$scope.offset = $scope.limit * $scope.page;
				$scope.init();
				$('html, body').animate({
		            scrollTop: 250
		        }, 800);
			}
			$scope.prePage = function() {
				$scope.page--;
				$scope.offset = $scope.limit * $scope.page;
				$scope.init();
			}
		});
	})();
</script>
@endsection
