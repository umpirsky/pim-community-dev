'use strict';

angular.module('App.directives', [])
    .directive('grid', function() {
        return {
            scope: {
                name: '@'
            },
            templateUrl: '/bundles/pimux/templates/grid/grid.html',
            controller: function(GridManager, $scope) {
                GridManager.load($scope.name).then(function (data) {
                    $scope.metaData = data.metadata;
                    $scope.data     = data.data;
                });
            }
        };
    })
    .directive('gridHeader', function() {
        return {
            templateUrl: '/bundles/pimux/templates/grid/header.html',
        };
    })
    .directive('gridRow', function() {
        return {
            templateUrl: '/bundles/pimux/templates/grid/row.html',
            controller: function($scope) {
                $scope.getCellConfig = function (columnName) {
                    return _.find($scope.metaData.columns, {name: columnName});
                };
            }
        };
    })
    .directive('gridCell', function(CellManager) {
        return {
            scope: {
                cell: '=',
                column: '='
            },
            templateUrl: '/bundles/pimux/templates/grid/cell.html',
            controller: function($scope) {
                $scope.renderCell = function (cell, column) {
                    return CellManager.render(cell, column);
                };
            }
        };
    })
    .directive('gridFilters', function() {
        return {
            templateUrl: '/bundles/pimux/templates/grid/filters.html'
        };
    })
    .directive('gridPagination', function() {
        return {
            templateUrl: '/bundles/pimux/templates/grid/pagination.html'
        };
    });
