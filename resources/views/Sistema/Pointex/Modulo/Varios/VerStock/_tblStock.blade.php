@if($data->count()>0)
<section class="basic-elements">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="px-3">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table  text-center datatablePointer">
                                    <thead class="text-white">
                                    <tr class="headings darken-4 bg-dark">
                                        @foreach($head as $vh)
                                            <th class="column-title">{{ $vh }}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data->first() as $kvd => $vd)
                                        @if($kvd!=0)
                                            <tr>
                                                @foreach($vd as $vdd)
                                                    <td class="column-title">{{ $vdd }}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
