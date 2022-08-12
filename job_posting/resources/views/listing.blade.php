@unless (count($listings) == 0)
    
@foreach ($listings as $listing)
    <h1>{{ $listing['title'] }}</h1>
    <h1>l{{  $listing['des'] }}</h1>
@endforeach

@else
<p>No listing found</p>

@endunless