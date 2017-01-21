<!doctype html>
<html ng-app>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js">
        </script>
            
    </head>
    <body>
        <div>
            <label>Name:</label>
            <input type="text" ng-model="modalname" placeholder="name here">
            <h1>hello {{modalname}}!</h1>
        </div>
    </body>
</html>