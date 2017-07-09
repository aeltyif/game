<!DOCTYPE html>
<html lang="en" ng-app="getCharacter">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RPG Game - King Of Luck</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="background-color:#21232a">
    <div class="container" style="background-color:#FFF;margin-top:35px;">
      <h2>RPG Game - King Of Luck</h2>
      <div ng-controller="CharacterController">
        <div class="alert alert-danger" ng-if="error.length">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Error!</strong> @{{error}}
        </div>
        <div class="alert alert-info" ng-if="fightResults.outcome">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>You <span ng-if="fightResults.outcome == 1">Lost</span><span ng-if="fightResults.outcome == 2">Won</span> !</strong>
            <hr/>
            <p>You : @{{fightResults.rolls[0]}}</p>
            <p>Opponent : @{{fightResults.rolls[1]}}</p>
        </div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Character Name</th>
              <th>Hero Type</th>
              <th>Current Level</th>
              <th>
                <button id="btn-add" class="btn btn-success btn-xs" ng-click="toggle('new', 0)">Create New Character</button>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="character in characters">
              <td>@{{ character.id }}</td>
              <td>@{{ character.name }}</td>
              <td>@{{ character.hero.name }}</td>
              <td>@{{ character.level }}</td>
              <td>
                <button class="btn btn-warning btn-xs btn-detail" ng-click="toggle('explore', character.id)">
                  <span class="glyphicon glyphicon-fire"></span>
                  <span>Explore</span>
                </button>
                <button class="btn btn-danger btn-xs btn-delete" ng-click="deleteCharacter(character.id)">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span>Delete</span>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- New modal  -->
        <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="newModalLabel">@{{title}}</h4>
              </div>
              <div class="modal-body">
                <form name="frmCharacter" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Character Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Name" ng-model="character.name" ng-required="true">
                          <span ng-show="frmCharacter.name.$invalid && frmCharacter.name.$touched">Name field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Hero Type</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="hero_id" ng-model="character.hero_id" ng-required="true"
                                ng-options="hero.id as hero.name for hero in heroes">
                            <option value="">Select Hero Type</option>
                        </select>
                        <span ng-show="frmCharacter.hero_id.$invalid && frmCharacter.hero_id.$touched">Hero Type is required</span>
                      </div>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmCharacter.$invalid">Save Changes</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Explore modal  -->
        <div class="modal fade" id="exploreModal" tabindex="-1" role="dialog" aria-labelledby="exploreModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exploreModalLabel">@{{title}}</h4>
              </div>
              <div class="modal-body">
                  <label ng-if="!generated && !explored">You can start playing by clicking Explore</label>
                  <label ng-if="!generated && explored">
                      <p>We could not find a challenger, try again</p>
                      <p>Number of tries : @{{explored}}</p>
                  </label>
                  <label ng-if="generated">
                      <p>Congratulations you have found a new challenger</p>
                      <p>Click Fight Villain to test your luck</p>
                      <hr />
                      <p>Challenger Name : @{{villain.name}}</p>
                      <p>Desciption : @{{villain.description}}</p>
                      <p>Reward : @{{villain.increment}} Levels</p>
                  </label>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" id="btn-save" ng-click="explore()">Explore</button>
                  <button type="button" class="btn btn-primary" id="btn-save" ng-click="fight(generated)" ng-disabled="!generated">Fight Villian</button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- Aangular Material load from CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.1/angular-material.min.js"></script>

    <!-- Angular Application Scripts Load  -->
    <script src="{{ asset('angular/app.js') }}"></script>
    <script src="{{ asset('angular/controllers/CharacterController.js') }}"></script>
  </body>
</html>
