<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container-fluid">
        <div class="col-sm-12"><h2 class="text-center">List API of api.timtruyen.online</h2></div>
        <div class="clearfix"></div>
        <div class="col-sm-3">
            <ul class="list-group">
                <li class="list-group-item active">Api List</li>
                <li class="list-group-item">Authen</li>
                <li class="list-group-item">Morbi leo risus</li>
                <li class="list-group-item">Porta ac consectetur ac</li>
                <li class="list-group-item">Vestibulum at eros</li>
            </ul>
        </div>
        <div class="col-sm-9"> 
            <div class="panel panel-primary">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#header" aria-controls="header" role="tab" data-toggle="tab">Header</a></li>
                        <li role="presentation"><a href="#Params" aria-controls="Params" role="tab" data-toggle="tab">Params</a></li>
                        <li role="presentation"><a href="#output" aria-controls="output" role="tab" data-toggle="tab">Output</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="header">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-3">Accept: </div>
                                    <div class="col-sm-9">application/json</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">Content-Type: </div>
                                    <div class="col-sm-9">application/json</div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="Params">Params</div>
                        <div role="tabpanel" class="tab-pane" id="output">Output</div>
                    </div>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                </div>
                <div class="panel-body">
                    Panel content
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>