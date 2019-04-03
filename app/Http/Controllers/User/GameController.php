<?php

namespace App\Http\Controllers\User;

use App\Models\Game\Area;
use App\Models\Game\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    protected $prefix = 'game';
    protected $guard;

    public function __construct()
    {
        parent::__construct();
        $this->guard = Auth::guard('user');
    }

    public function index()
    {
        dd('test');
    }

    public function start()
    {
        $game = new Game();
        $game->user_id = $this->guard->user()->id;
        $game->save();

        $area = new Area();
        $area->game_id = $game->id;
        $area->save();

        $area->setPawns();
        return redirect()->route('game.game', $game);
    }

    public function game(Game $game)
    {
        $test = $game->area->startArea();
        return $this->view('index', compact(['test', 'game']));
    }

//    public function move(Game $game)
    public function move(Request $request, Game $game)
//    public function move(Request $request)
    {
        $area = $game->area;
//        $x = substr('2F', 0, 1);
//        $y = substr('2F', 1);
//        $moveX = substr('3G', 0, 1);
//        $moveY = substr('3G', 1);
//        $color = 'CD';
        $x = substr($request->id, 0, 1);
        $y = substr($request->id, 1);
        $moveX = substr($request->move, 0, 1);
        $moveY = substr($request->move, 1);
        $color = $request->type;
        if ($game->round == $color || $game->round == substr($color, 0, 1)) {
        } else {
            return response()->json(['success' => false, 'test' => substr($color, 0, 1)]);
        }
        $next = ($color == 'B' || $color == 'BD') ? 'C' : 'B';
        $game->round = $next;
        if ($pawn = $area->findPawn($x, $y)) {
            if (!$area->findPawn($moveX, $moveY)) {
                /**
                 * Zwykły ruch
                 */
                if ($area->checkMove(intval($x), $y, intval($moveX), $moveY, $color)) {
                    $pawn->x = $moveX;
                    $pawn->y = $moveY;
                    $pawn->save();
                    $game->save();

                    if ($area->checkQueen($pawn->x, $pawn->color)) {
                        $pawn->color = $pawn->color . 'D';
                        $pawn->save();
                    }
                    return response()->json([
                        'success' => true,
                        'action' => 'move',
                        'killId' => false,
                        'next' => $next,
                        'color' => $pawn->color,
                    ]);
                    /**
                     * Ruch zbijania
                     */
                } else if ($toKill = $area->checkKill(intval($x), $y, intval($moveX), $moveY, $color)) {
                    $killId = $toKill->x . $toKill->y;
                    $pawn->x = $moveX;
                    $pawn->y = $moveY;
                    $pawn->save();
                    $game->save();
                    $toKill->delete();
                    if ($area->checkQueen($pawn->x, $pawn->color)) {
                        $pawn->color = $pawn->color . 'D';
                        $pawn->save();
                    }
                    if ($area->countPawns($next) == 0) {
                        $game->status = ($next == 'B') ? 'lost' : 'win';
                        $game->save();
                        return response()->json([
                            'success' => true,
                            'action' => 'win',
                            'killId' => $killId,
                            'color' => $pawn->color,
                        ]);
                    } else {
                        return response()->json([
                            'success' => true,
                            'action' => 'kill',
                            'killId' => $killId,
                            'next' => $next,
                            'color' => $pawn->color,
                        ]);
                    }
                }
            }
        }
        return response()->json(['success' => false]);
    }

    public function test(Game $game)
    {
        $area = $game->area;
        $test = $area->finalArea();

        return $this->view('index', compact('test', 'game'));
    }
}
