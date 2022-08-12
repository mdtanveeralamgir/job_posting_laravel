@foreach ($listings as $listing)
    <h1><a href="{{ route('singleListing', ['id'=>$listing['id']]) }}">{{$listing['title']}}</a></h1>
    <p>{{ $listing['description'] }}</p>
@endforeach
    
    
    
