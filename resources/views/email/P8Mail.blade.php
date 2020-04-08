<!DOCTYPE html>
<html>
<head>
    <title>Passage8.com</title>
</head>
<body>

    <h1>{{ $details['title'] }}</h1>
    @foreach($details['body'] as $key => $value )


      <p><b>{{$key}}</b>: 
      @if(is_array($value))
         {{ implode( ", ", $value ) }}
      @else
         {{ $value }}
      @endif
  </p>   
    @endforeach
   
</body>
</html>