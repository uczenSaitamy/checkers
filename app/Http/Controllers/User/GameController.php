<?php

namespace App\Http\Controllers\User;

use App\Models\Game\Area;
use App\Models\Game\Game;
use App\Models\Game\Pawn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    protected $prefix = 'game';
    protected $guard;

    public function __construct()
    {
        $this->guard = Auth::guard('user');
    }

//    public function index()
//    {
//        $game = Game::find(1);
////        $game = new Game();
//        $game->user_id = $this->guard->user()->id;
//        $game->save();
//
//        $area = Area::find(1);
////        $area = new Area();
//        $area->game_id = $game->id;
//        $area->save();
//
//        $test = $area->startArea();
////        dd($test);
//        return $this->view('index', compact('test'));
//    }

    public function index()
    {
//        $game = Game::find(1);
        $game = new Game();
        $game->user_id = $this->guard->user()->id;
        $game->save();

//        $area = Area::find(1);
        $area = new Area();
        $area->game_id = $game->id;
        $area->save();

        $area->setPawns();
//        $test = $area->startArea();
//        dd($test);
        return redirect()->route('game.game', $game);
    }

    public function game(Game $game)
    {
        $test = $game->area->startArea();
        return $this->view('index', compact(['test', 'game']));
    }

//    public function move(Game $game)
////    public function move(Request $request)
//    {
//        $area = $game->area;
//        $x = $area->getX();
//        $y = $area->getY();
//        $id = substr('area[6H]', -3, 2);
//        $move = substr('area[5G]', -3, 2);
//        $type = 'C';
//
////        dd(array_search(6, $x));
//        if ($type === 'B') {
//            if ($x[substr($id, 0, 1) + 1] === substr($move, 0, 1)) {
//                if ($y[substr($id, -1) + 1] === substr($move, -1) ||
//                    $y[substr($id, -1) - 1] === substr($move, -1)) {
//                    dd('bialy dobrze');
//                }
//            }
//        } else if ($type === 'C') {
////            dd($y[array_search(substr($id,1), $y) -1], substr($move,1), $move);
//            if ($x[array_search(substr($id, 0, 1), $x) - 1] === intval(substr($move, 0, 1))) {
//                if ($y[array_search(substr($id, 1), $y) - 1] === substr($move, 1) ||
//                    array_search(substr($id, 1), $y) + 1 < count($y) &&
//                    $y[array_search(substr($id, 1), $y) + 1] === intval(substr($move, 1))) {
//                    dd('czarny dobrze');
//                }
//            }
//        }
//        dd('error');
//
////        return response()->json(['id' =>$request->id, 'type' => $request->type, 'move' => $request->move]);
//    }

//    public function move(Game $game)
    public function move(Request $request, Game $game)
//    public function move(Request $request)
    {
//        return response()->json(['id' =>$request->id, 'type' => $request->type, 'move' => $request->move]);
        $area = $game->area;
//        $x = substr('area[4H]', -3, 1);
//        $y = substr('area[4H]', -2, 1);
//        $moveX = substr('area[6F]', -3, 1);
//        $moveY = substr('area[6F]', -2, 1);
//        $color = 'B';
        $x = substr($request->id, -3, 1);
        $y = substr($request->id, -2, 1);
        $moveX = substr($request->move, -3, 1);
        $moveY = substr($request->move, -2, 1);
        $color = $request->type;
        $next = ($color == 'B') ? 'C' : 'B';
        if ($pawn = $area->findPawn('d', $x, $y)) {
            /**
             * Zwykły ruch
             */
            if (!$area->findPawn('d', $moveX, $moveY)) {
                if ($area->checkMove(intval($x), $y, intval($moveX), $moveY, $color)) {
                    $pawn->x = $moveX;
                    $pawn->y = $moveY;
                    $pawn->save();
                    return response()->json(['success' => true, 'action' => 'move', 'killId' => false, 'next' => $next]);
                    /**
                     * Ruch zbijania
                     */
                } else if ($toKill =$area->checkKill(intval($x), $y, intval($moveX), $moveY, $color)) {
                    return response()->json(['success' => true, 'action' => 'kill', 'killId' => 'area['. $toKill->x .
                    $toKill->y.']', 'next' => '']);
                }
            }
        }
        return response()->json(['success' => false]);
//        return response()->json(['id' =>$request->id, 'type' => $request->type, 'move' => $request->move]);
    }

    public function test(Game $game)
    {
        $area = $game->area;
        $test = $game->area->finalArea();
//        dd($area->findPawn('d', 1, 'A')->color == 'B');
        return $this->view('index', compact(['test', 'game']));
    }
}