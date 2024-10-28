@extends('Sistema.Pointex.LayOuts.layout')

@section('title',$titleMsg)

@section("css")
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/css/tagging.min.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/css/tagging.css') !!}
    {!! HTML::style('/others/css/tagify.css') !!}
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 47px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 13px;
            width: 13px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            /*background-color: #2196F3;*/
            background-color: #21F396;
        }

        input:focus + .slider {
            /*box-shadow: 0 0 1px #2196F3;*/
            box-shadow: 0 0 1px #21F396;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }


        .customSuggestionsList > div{
            max-height: 300px;
            min-height: 50px;
            border: 2px solid pink;
            overflow: auto;
        }

        .customSuggestionsList .empty{
            color: #999;
            font-size: 20px;
            text-align: center;
            padding: 1em;
        }
    </style>
@endsection

@section("content")
    <section class="basic-elements">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="horz-layout-basic">{{ $titleMsg }}</h4>
                        {!! $vista !!}
                    </div>
                </div>
            </div>
@endsection
@section("js")
    @yield('jsExtras')
@endsection
