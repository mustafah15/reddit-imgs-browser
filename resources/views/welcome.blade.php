<html>
<head>
    <title>test</title>
    <style>
        .modal-dialog {width:600px;}
        .thumbnail {margin-bottom:6px;}
    </style>
    <!-- Latest compiled and minified CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>
<div class="container">
    <div class="row">
        <h1>reddit images retriver</h1>
        @foreach($pics as $pic)
            <div  data-content="<img height='500' width='500' src='{{$pic->url}}'>"  class="col-lg-3 col-sm-4 col-xs-6"><a title="{{$pic->title}}" href="#"><img class="thumbnail img-responsive" height='150' width='150'
            @if($pic->domain != 'self.pics')
            src=" {{$pic->thumbnail}}"></a></div>
            @else
               src="https://placehold.it/150x150"></a></div>
            @endif

        @endforeach

        <hr>

        <hr>
    </div>
</div>
<div tabindex="-1" class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h3 class="modal-title">Heading</h3>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function() {
        $('.thumbnail').click(function(){
            $('.modal-body').empty();
            var title = $(this).parent('a').attr("title");
            $('.modal-title').html(title);
            $($(this).parents('div').attr("data-content")).appendTo('.modal-body');
            $('#myModal').modal({show:true});
        });
    });
</script>
</html>