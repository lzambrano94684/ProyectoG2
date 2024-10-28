<textarea
        @if(count($atributes)>0)
        @foreach($atributes as $ka => $va)
        {!! $ka.'="'.$va.'"' !!}
        @endforeach
        @else class="form-control" id="{{$name}}"
        name="{{ $name }}"
        rows="3"
        @endif
       >{{ trim($value) }}</textarea>