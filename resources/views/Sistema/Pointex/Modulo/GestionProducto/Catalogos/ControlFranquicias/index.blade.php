@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
@endsection

@section('content')

    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {!! $vista !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection
