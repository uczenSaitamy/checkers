@extends('template.index')

@section('title', 'checkers')

@section('content')
    <div class="row mt-4">
        <div class="col-md-8">
            @foreach($test as $keyR => $row)
                <div class="row m-0 p-0">
                    @foreach($row as $keyC => $column)
                        @if(isset($column['field']))
                            @if($column['pawn'])
                                <div id="{{$keyR . $keyC}}"
                                     class="square bg-dark movable text-center text-light h3 m-0">
                                    {{ $column['pawn']->color }}
                                </div>
                            @else
                                <div id="{{$keyR . $keyC}}"
                                     class="square bg-dark movable text-center text-light h3 m-0">
                                </div>
                            @endif
                        @else
                            <div id="{{$keyR . $keyC}}"
                                 class="square bg-warning text-danger h3 text-center m-0"></div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <div class="row">
               <div class="col">Tura gracza:</div>
                <div class="col" id="round">{{ $game->round }}</div>
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
    <script>
        $(document).ready(function () {
            let lastBtn = '';
            let type = '';
            $('.movable').on('click', function (event) {
                event.stopPropagation();
                event.preventDefault();
                if ($(event.target).text().trim() === 'B') {
                    lastBtn = $(event.target).attr('id');
                    type = $(event.target).text().trim();
                    console.log('biale', type, lastBtn);
                } else if ($(event.target).text().trim() === 'C') {
                    lastBtn = $(event.target).attr('id');
                    type = $(event.target).text().trim();
                    console.log('czarne');
                } else if ($(event.target).text().trim() === '' && lastBtn && type) {
                    // if (lastBtn && type) {
                    // console.log(lastBtn, type);
                    move(lastBtn, $(event.target).attr('id'), type);
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
                    if (result.success) {
                        $('#' + btn_id + '').text('');
                        $('#' + move_id + '').text(type);
                    }

                    if (result.action == 'kill') {
                        $('#' + result.killId + '').text('');
                    }

                    if (result.next){
                        $('#round').text(result.next);
                    }
                },
                error(error) {
                    console.log(error.status);
                }
            });
        }
    </script>
@stop
