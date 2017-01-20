<html>
<head>
    <title>welcome to the Homepage</title>
    <style>
        .modal-dialog {width:600px;}
        .thumbnail {margin-bottom:6px;}
    </style>
    <!-- Latest compiled and minified CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>
<div class="container">

    <h1>Reddit images retriver</h1>
    <div class="row">
        @foreach($pics as $pic)
            <div data-content="<img height='500' width='500' src='{{$pic->url}}'>"  class="col-lg-3 col-sm-4 col-xs-6"><a title="{{$pic->title}}" href="#">
                    <img class="thumbnail img-responsive" height='150' width='150'
                        @if($pic->domain != 'self.pics')
                        src=" {{$pic->thumbnail}}"></a>
                        @else
                           src="https://placehold.it/150x150"></a>
                        @endif
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-sm-8">
            <a href="{{route('prev-pagination',['previous'=>$previous,'count'=>$count])}}" > <button type="button" class="btn btn-primary">previous</button></a>
            <a href="{{route('next-pagination',['next'=>$next,'count'=>$count])}}"><button type="button" class="btn btn-primary">next</button></a>
        </div>
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