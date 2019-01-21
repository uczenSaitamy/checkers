@extends('template.index')

@section('title', 'checkers')

@section('content')
    <div class="row mt-4">
        <div class="col-md-8">
            @foreach($test as $keyR => $row)
                {{--<div class="btn-group-toggle" data-toggle="buttons">--}}
                <div class="row m-0 p-0 btn-group-toggle" data-toggle="buttons">
                    @foreach($row as $keyC => $column)
                        @if(isset($column['field']))
                            <div class="btn-group-toggle" data-toggle="buttons">
                                @if($column['pawn'])
                                    <label class="btn btn-secondary square m-0 h3">
                                        {{--<input type="radio" name="options" id="option2" autocomplete="off"> Radio--}}
                                        <input type="radio" name="options" id="area[{{$keyR . $keyC}}]"
                                               autocomplete="off">
                                        {{ $column['pawn']->color }}
                                    </label>
                                    {{--</div>--}}
                                    {{--<button id="area[{{$keyR . $keyC}}]" class="square bg-dark text-danger h3 text-center m-0"--}}
                                    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                                    {{--                                    {{ $column['pawn']->color }}</button>--}}
                                @else
                                    <label class="btn btn-secondary square m-0 h3">
                                        {{--<input type="radio" name="options" id="option2" autocomplete="off"> Radio--}}
                                        <input type="radio" name="options" id="area[{{$keyR . $keyC}}]"
                                               autocomplete="off">
                                    </label>
                                    {{--<div id="area[{{$keyR . $keyC}}]" class="square bg-dark text-danger h3 text-center m-0">--}}
                                    {{--</div>--}}
                                @endif
                                {{--<input type="text" class="square bg-dark text-danger h3 text-center"--}}
                                {{--                                   value="{{ ($column['pawn']) ? $column['pawn']->color : ''}}" disabled>--}}
                            </div>
                        @else
                            <div id="area[{{$keyR . $keyC}}]"
                                 class="square bg-warning text-danger h3 text-center m-0"></div>
                        @endif
                    @endforeach
                    {{--</div>--}}
                </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col">
                    <div class="big-square">
                        <div class="square bg-warning"></div>
                    </div>
                </div>
                <div class="col">
                    pierwsze
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="big-square">
                        <div class="square bg-dark"></div>
                    </div>
                </div>
                <div class="col">
                    drugie
                </div>
            </div>
        </div>
    </div>

    <style>
        .square {
            float: left;
            width: 60px;
            height: 60px;
        }

        .big-square {
            float: left;
            width: 90px;
            height: 90px;
        }
    </style>

    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    {{--<script src="{{asset('js/jquery-3.3.1.js')}}"></script>--}}
    {{--    <script src="{{asset('js/jquery-3.3.1.min.map')}}"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/core.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.map"></script>--}}
    <script>
        $(document).ready(function () {
            let lastBtn = '';
            let type = '';
            $('.btn-secondary').on('click', function (event) {
                event.stopPropagation();
                event.preventDefault();
                if ($(event.target).text().trim() === 'B') {
                    lastBtn = $(event.target).children().attr('id');
                    type = $(event.target).text().trim();
                    console.log('biale');
                } else if ($(event.target).text().trim() === 'C') {
                    lastBtn = $(event.target).children().attr('id');
                    type = $(event.target).text().trim();
                    console.log('czarne');
                } else if ($(event.target).text().trim() === '' && lastBtn && type) {
                    // if (lastBtn && type) {
                        // console.log(lastBtn, type);
                        move(lastBtn, $(event.target).children().attr('id'), type);
                    // }
                    lastBtn = '';
                    type = '';
                }
            });
        });

        function move(btn_id, move_id, type) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: "{{ route('game.move', $game) }}",
                data: {
                    id: btn_id,
                    type: type,
                    move: move_id,
                },
                success(result) {
                    console.log('success:', result);
                    $('#btn_id').text('')
                },
                error(error) {
                    console.log(error.status);
                }
            });
        }
    </script>
@stop
