{{ csrf_field() }}
<input name="user_id" type="hidden" value="{{ Auth::id() }}">
<div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">Article Title:</label>
    <div class="col-sm-10">
        <input type="text" name="title" class="form-control" id="title" placeholder="write article title" value = "@if(isset($article->title)) {{$article->title}} @endif" required>
    </div>
</div>
<div class="form-group row">
    <label for="body" class="col-sm-2 col-form-label">Article Body: </label>
    <div class="col-sm-10">
        <textarea class="form-control" name="body" id="body" cols="10" rows="5" required>@if(isset($article->body)) {{$article->body}} @endif</textarea>
    </div>
</div>
@php
        if(isset($article->published_at)) {
            $dateTime = explode(" ", $article->published_at);
            $date = $dateTime[0];
            $time = $dateTime[1];
        }
@endphp
<div class="form-group row">
    <label for="published_at" class="col-sm-2 col-form-label">Published At:</label>
    <div class="col-sm-5">
        <input type="date" name="published_at_date" class="form-control" id="published_at" value="@if(isset($article->published_at)){{ date('Y-m-d', strtotime($date)) }}@else{{ date('Y-m-d') }}@endif" >
    </div>
    <div class="col-sm-5">
        <input type="time" name="published_at_time" class="form-control" id="published_at" value="@if(isset($article->published_at)){{ date('H:i:s', strtotime($time)) }}@else{{ date('H:i:s') }}@endif" >

    </div>
</div>
<div class="form-group row">
    <label for="tags" class="col-sm-2 col-form-label">Tags:</label>
    <div class="col-sm-10">
        <select multiple class="form-control" name="tags[]" id="tag_list">
            @foreach($tags as $tag)
                @php
                    if(isset($article->tagList)){
                        if(in_array($tag->id, $article->tagList->toArray())){
                            $selected = 'selected';
                        }
                        else{
                            $selected = '';
                        }
                    }else{
                        $selected = '';
                    }
                @endphp
                <option value="{{$tag->id}}" {{ $selected }} >{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
</div>
@section('footer')
    <script>
        $("#tag_list").select2({
                placeholder:'chose a Tag',
                tags: true,
            }
        );
    </script>
@endsection