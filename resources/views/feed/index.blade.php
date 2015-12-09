@extends('layouts.main')

@section('content')




    @foreach($jsonData as $key => $value)
        <div>
            Title : {{$jsonData[$key]['title']}}
            <br/>
            Description : {{$jsonData[$key]['description']}}
            <br/>
            Image URL : {{$jsonData[$key]['image']}}
            <br/>
            url : {{$jsonData[$key]['url']}}
            <br/>
            Publish date : {{$jsonData[$key]['pubdate']}}

        </div>
        <hr>
    @endforeach


@endsection