<!DOCTYPE html>
<html lang="en">
<head>
    <title>Levenshtein Algorithm</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
</head>
<script type="text/javascript">

    var app = angular.module('myApp', []);
    app.controller('myController', function ($scope,$http) {
        $scope.$watch('textvalue', function () {
            this.items=$scope.textvalue;
            //$scope.yaz=this.items;
            $scope.gonder(this.items)

        });
        $scope.gonder=function (gelen) {
            var request = $http({
                method: 'post',
                url: 'levenshtein.php',
                data: {
                    input:gelen
                },
                headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
            });
            request.then(function (res) {
                $scope.message=res.data;
            });
        }
        $scope.gel=" ";
        $scope.click_func=function(oneri_yaz){
            $scope.gel+=" "+oneri_yaz;
            $scope.textvalue=null;
        }
    });
</script>
<body>
<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div  class="wrap-login100">
            <form class="login100-form validate-form">
                <div ng-app="myApp" ng-controller="myController" >

                <span class="login100-form-title p-b-34 p-t-27">
						Levenshtein Distance
					</span>

                <div class="wrap-input100 validate-input" data-validate = "Enter username">

                    <input class="input100" type="text" placeholder="Input" ng-model="textvalue" >
                    <span class="focus-input100"></span>

                </div>
                    <table>
                        <tr >
                            <td ng-repeat="msg in message"><strong><a style="color: #c80000" href="#" ng-click="click_func(msg.oneri)">{{msg.oneri}} - </a></strong></td>
                        </tr>
                    </table>
                    <p style="color: gold">{{gel}}</p>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>