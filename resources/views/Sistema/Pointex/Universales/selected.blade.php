<select @if(count($atributes)>0)
                @foreach($atributes as $ka => $va)
                        {!! $ka.'="'.$va.'"' !!}
                @endforeach
        @else class="form-control select2_single cmb{{$tipoSelected}}" id="cmb{{$tipoSelected}}"
        name="cmb{{$tipoSelected}}{{ $multiple ? "[0]": null }}"
        @endif
        {{ $multiple2 ? "multiple": null }}
        {{ $requerido ?  " required " : null }} >
        @if(!$select)
            @if($placeholder)<option value=""  selected>{{ $placeholder }}</option>@endif
        @endif
    @if(!$attr)
        @foreach($ordenar ? $model->sort() : $model as $kdp => $vdp)
            @if(is_array($select))
                <option value="{{ $kdp }}" {{ in_array($kdp,$select) ? "selected" : null}}>{{ $vdp }}</option>
            @else
                <option value="{{ $kdp }}" {{ $select == $kdp ? "selected" : null}}>{{ $vdp }}</option>
            @endif
        @endforeach
    @else
        @foreach($attr as $kdp => $vdp)
            @if(is_array($select))
                <option value="{{ $vdp->Id }}" {{ in_array($vdp->Id,$select) ? "selected" : null}} data-attr = "{{ $vdp->Atributo }}">{{ $vdp->Nombre }}</option>
            @else
                <option value="{{ $vdp->Id }}" {{ $select == $vdp->Id ? "selected" : null}} data-attr = "{{ $vdp->Atributo }}">{{ $vdp->Nombre }}</option>
            @endif
        @endforeach
    @endif
</select>

@if($debug)
        {{ dd($model,$tipoSelected) }}
@endif