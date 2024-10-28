@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")

@endsection

@section('content')

    <section id="basic-tabs-components">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">{{ $titleMsg }}</div>
            </div>
        </div>
        <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
                <div class="card" style="height: 100%;">

                    <div class="card-content">
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('js')

    <script type="text/javascript">

    </script>
@endsection
