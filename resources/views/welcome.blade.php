<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        
        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            #submitBtn{
                cursor: pointer;
            }
        </style>

        <!-- Script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        
    </head>
    <body class="bg-light">
        <div class="container">
            <div class="py-3 text-center">
                <h1>Create A Question</h1>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    {!! Form::open(array('route' => 'questions.store')) !!}
                        <div class="form-group">
                            <label for="inputQuestion">Question</label>
                            <input type="text" class="form-control" id="inputQuestion" placeholder="Enter Question">
                        </div>
                        <div class="form-group">
                            <label for="inputAnswerA">Answer A - <b>True Answer</b></label>
                            <input type="text" class="form-control" id="inputAnswerA" placeholder="Enter Answer A">
                        </div>
                        <div class="form-group">
                            <label for="inputAnswerB">Answer B</label>
                            <input type="text" class="form-control" id="inputAnswerB" placeholder="Enter Answer B">
                        </div>
                        <div class="form-group">
                            <label for="inputAnswerC">Answer C</label>
                            <input type="text" class="form-control" id="inputAnswerC" placeholder="Enter Answer C">
                        </div>
                        <div class="form-group">
                            <label for="inputAnswerD">Answer D</label>
                            <input type="text" class="form-control" id="inputAnswerD" placeholder="Enter Answer D">
                        </div>
                        <div class="text-center">
                            <div class="btn btn-primary" id="submitBtn">Submit</div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('#submitBtn').click(function(e){
                    e.stopPropagation()
                    e.preventDefault()
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var inputQuestion   = $('#inputQuestion').val();
                    var inputAnswerA    = $('#inputAnswerA').val();
                    var inputAnswerB    = $('#inputAnswerB').val();
                    var inputAnswerC    = $('#inputAnswerC').val();
                    var inputAnswerD    = $('#inputAnswerD').val();
                    if(inputQuestion.length < 1){
                        return Swal.fire({
                            type:"warning",
                            text:"Question can't be empty!"
                        })
                    }else{
                        var request = $.ajax({
                            url : "/questions",
                            method: "POST",
                            data :{
                                "question"      : inputQuestion,
                                "answerOne"     : inputAnswerA,
                                "answerTwo"     : inputAnswerB,
                                "answerThree"   : inputAnswerC,
                                "answerFour"    : inputAnswerD
                            },
                            dataType: "json",                
                        })

                        request.done((response)=>{
                            console.log(response)
                            if(response.status == 201){
                                return Swal.fire({
                                    type:"success",
                                    text:response.message
                                })

                                $('#inputQuestion').val('');
                                $('#inputAnswerA').val('');
                                $('#inputAnswerB').val('');
                                $('#inputAnswerC').val('');
                                $('#inputAnswerD').val('');
                            }else{
                                $('#input-coupon').val('')
                                return Swal.fire({
                                    type:"warning",
                                    text:response.message
                                })
                            }
                        })
                    }
                })
            });
        </script>
    </body>
</html>
