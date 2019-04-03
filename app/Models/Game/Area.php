<?php

namespace App\Models\Game;


use App\Models\Model;

class Area extends Model
{
    protected $table = 'area';
    protected $fillable = ['id', 'game_id'];

    protected $x;
    protected $y;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->x = [1, 2, 3, 4, 5, 6, 7, 8];
        $this->y = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function pawns()
    {
        return $this->hasMany(Pawn::class);
    }

    public function findPawn($x, $y)
    {
        return $this->pawns->where('x', $x)->where('y', $y)->first();
    }

    public function countPawns($color)
    {
        $normal = $this->pawns()->where('color', $color)->count();
        $damka = $this->pawns()->where('color', $color . 'D')->count();
        return $normal + $damka;
    }

    public function getWhiteStart()
    {
        return [
            1 => [
                'A' => ['pawn' => $this->findPawn(1, 'A'), 'field' => true],
                'C' => ['pawn' => $this->findPawn(1, 'C'), 'field' => true],
                'E' => ['pawn' => $this->findPawn(1, 'E'), 'field' => true],
                'G' => ['pawn' => $this->findPawn(1, 'G'), 'field' => true]
            ],
            2 => [
                'B' => ['pawn' => $this->findPawn(2, 'B'), 'field' => true],
                'D' => ['pawn' => $this->findPawn(2, 'D'), 'field' => true],
                'F' => ['pawn' => $this->findPawn(2, 'F'), 'field' => true],
                'H' => ['pawn' => $this->findPawn(2, 'H'), 'field' => true]
            ],
            3 => [
                'A' => ['pawn' => $this->findPawn(3, 'A'), 'field' => true],
                'C' => ['pawn' => $this->findPawn(3, 'C'), 'field' => true],
                'E' => ['pawn' => $this->findPawn(3, 'E'), 'field' => true],
                'G' => ['pawn' => $this->findPawn(3, 'G'), 'field' => true]
            ]
        ];
    }

    public function getBlackStart()
    {
        return [
            8 => [
                'B' => ['pawn' => $this->findPawn(8, 'B'), 'field' => true],
                'D' => ['pawn' => $this->findPawn(8, 'D'), 'field' => true],
                'F' => ['pawn' => $this->findPawn(8, 'F'), 'field' => true],
                'H' => ['pawn' => $this->findPawn(8, 'H'), 'field' => true],
            ],
            7 => [
                'A' => ['pawn' => $this->findPawn(7, 'A'), 'field' => true],
                'C' => ['pawn' => $this->findPawn(7, 'C'), 'field' => true],
                'E' => ['pawn' => $this->findPawn(7, 'E'), 'field' => true],
                'G' => ['pawn' => $this->findPawn(7, 'G'), 'field' => true],
            ],
            6 => [
                'B' => ['pawn' => $this->findPawn(6, 'B'), 'field' => true],
                'D' => ['pawn' => $this->findPawn(6, 'D'), 'field' => true],
                'F' => ['pawn' => $this->findPawn(6, 'F'), 'field' => true],
                'H' => ['pawn' => $this->findPawn(6, 'H'), 'field' => true],
            ],
        ];
    }

    public function getRestStart()
    {
        return [
            4 => [
                'B' => ['pawn' => false, 'field' => true],
                'D' => ['pawn' => false, 'field' => true],
                'F' => ['pawn' => false, 'field' => true],
                'H' => ['pawn' => false, 'field' => true],
            ],
            5 => [
                'A' => ['pawn' => false, 'field' => true],
                'C' => ['pawn' => false, 'field' => true],
                'E' => ['pawn' => false, 'field' => true],
                'G' => ['pawn' => false, 'field' => true],
            ],
        ];
    }

    public function getMovableFields()
    {
        return [
            1 => [
                'A' => ['pawn' => false, 'field' => true],
                'C' => ['pawn' => false, 'field' => true],
                'E' => ['pawn' => false, 'field' => true],
                'G' => ['pawn' => false, 'field' => true],
            ],
            2 => [
                'B' => ['pawn' => false, 'field' => true],
                'D' => ['pawn' => false, 'field' => true],
                'F' => ['pawn' => false, 'field' => true],
                'H' => ['pawn' => false, 'field' => true],
            ],
            3 => [
                'A' => ['pawn' => false, 'field' => true],
                'C' => ['pawn' => false, 'field' => true],
                'E' => ['pawn' => false, 'field' => true],
                'G' => ['pawn' => false, 'field' => true],
            ],
            4 => [
                'B' => ['pawn' => false, 'field' => true],
                'D' => ['pawn' => false, 'field' => true],
                'F' => ['pawn' => false, 'field' => true],
                'H' => ['pawn' => false, 'field' => true],
            ],
            5 => [
                'A' => ['pawn' => false, 'field' => true],
                'C' => ['pawn' => false, 'field' => true],
                'E' => ['pawn' => false, 'field' => true],
                'G' => ['pawn' => false, 'field' => true],
            ],
            6 => [
                'B' => ['pawn' => false, 'field' => true],
                'D' => ['pawn' => false, 'field' => true],
                'F' => ['pawn' => false, 'field' => true],
                'H' => ['pawn' => false, 'field' => true],
            ],
            7 => [
                'A' => ['pawn' => false, 'field' => true],
                'C' => ['pawn' => false, 'field' => true],
                'E' => ['pawn' => false, 'field' => true],
                'G' => ['pawn' => false, 'field' => true],
            ],
            8 => [
                'B' => ['pawn' => false, 'field' => true],
                'D' => ['pawn' => false, 'field' => true],
                'F' => ['pawn' => false, 'field' => true],
                'H' => ['pawn' => false, 'field' => true],
            ],
        ];
    }

    public function getArea()
    {
        $area = [];
        foreach ($this->getX() as $x) {
            $list = [];
            foreach ($this->getY() as $y) {
                $list[$y] = '';
            }
            if (isset($this->getMovableFields()[$x])) {
                $area[$x] = array_merge($list, $this->getMovableFields()[$x]);
            } else {
                $area[$x] = $list;
            }
        }
        return $area;
    }

    public function finalArea()
    {
        $area = $this->getArea();
        foreach ($this->getX() as $x) {
            foreach ($this->getY() as $y) {
                if ($pawn = $this->findPawn($x, $y)) {
                    $area[$x][$y] = ['pawn' => $pawn, 'field' => true];
                }
            }
        }
        return $area;
    }

    public function startArea()
    {
        $area = [];
        foreach ($this->getX() as $x) {
            $list = [];
            foreach ($this->getY() as $y) {
                $list[$y] = '';
            }
            if (isset($this->getWhiteStart()[$x])) {
                $area[$x] = array_merge($list, $this->getWhiteStart()[$x]);
            } else if (isset($this->getBlackStart()[$x])) {
                $area[$x] = array_merge($list, $this->getBlackStart()[$x]);
            } else if (isset($this->getRestStart()[$x])) {
                $area[$x] = array_merge($list, $this->getRestStart()[$x]);
            } else {
                $area[$x] = $list;
            }
        }
        return $area;
    }

    public function setPawn($color, $x, $y)
    {
        if ($pawn = $this->findPawn($x, $y)) {

        } else {
            $pawn = new Pawn();
            $pawn->area_id = $this->id;
            $pawn->type = 'normal';
            $pawn->color = $color;
            $pawn->x = $x;
            $pawn->y = $y;
            $pawn->save();
        }

        return $pawn;
    }

    public function setPawns()
    {
        $this->setPawn('B', 1, 'A');
        $this->setPawn('B', 1, 'C');
        $this->setPawn('B', 1, 'E');
        $this->setPawn('B', 1, 'G');
        $this->setPawn('B', 2, 'B');
        $this->setPawn('B', 2, 'D');
        $this->setPawn('B', 2, 'F');
        $this->setPawn('B', 2, 'H');
        $this->setPawn('B', 3, 'A');
        $this->setPawn('B', 3, 'C');
        $this->setPawn('B', 3, 'E');
        $this->setPawn('B', 3, 'G');


        $this->setPawn('C', 8, 'B');
        $this->setPawn('C', 8, 'D');
        $this->setPawn('C', 8, 'F');
        $this->setPawn('C', 8, 'H');
        $this->setPawn('C', 7, 'A');
        $this->setPawn('C', 7, 'C');
        $this->setPawn('C', 7, 'E');
        $this->setPawn('C', 7, 'G');
        $this->setPawn('C', 6, 'B');
        $this->setPawn('C', 6, 'D');
        $this->setPawn('C', 6, 'F');
        $this->setPawn('C', 6, 'H');
    }

    public function checkMove($x, $y, $movex, $movey, $type)
    {
        if ($type == 'C') {
            if (array_search($x, $this->x) - 1 < count($this->x)) {
                if ($this->x[array_search($x, $this->x) - 1] === $movex) {
                    if (array_search($y, $this->y) + 1 < count($this->y) &&
                        $this->y[array_search($y, $this->y) + 1] === $movey) {
                        return true;
                    } else if (array_search($y, $this->y) - 1 < count($this->y) &&
                        $this->y[array_search($y, $this->y) - 1] === $movey) {
                        return true;
                    } else return false;
                }
            }
        } else if ($type == 'B') {
            if (array_search($x, $this->x) + 1 < count($this->x)) {
                if ($this->x[array_search($x, $this->x) + 1] === $movex) {
                    if (array_search($y, $this->y) + 1 < count($this->y) &&
                        $this->y[array_search($y, $this->y) + 1] === $movey) {
                        return true;
                    } else if (array_search($y, $this->y) - 1 < count($this->y) &&
                        $this->y[array_search($y, $this->y) - 1] === $movey) {
                        return true;
                    } else return false;
                }
            }
        } else if ($type == 'BD' || $type == 'CD') {
            if (array_search($x, $this->x) - 1 < count($this->x) && array_search($x, $this->x) - 1 >= 0) {
                if ($this->x[array_search($x, $this->x) - 1] === $movex) {
                    if (array_search($y, $this->y) + 1 < count($this->y) &&
                        $this->y[array_search($y, $this->y) + 1] === $movey) {
                        return true;
                    } else if (array_search($y, $this->y) - 1 < count($this->y) &&
                        $this->y[array_search($y, $this->y) - 1] === $movey) {
                        return true;
                    } else return false;
                } else if (array_search($x, $this->x) + 1 < count($this->x)) {
                    if ($this->x[array_search($x, $this->x) + 1] === $movex) {
                        if (array_search($y, $this->y) + 1 < count($this->y) &&
                            $this->y[array_search($y, $this->y) + 1] === $movey) {
                            return true;
                        } else if (array_search($y, $this->y) - 1 < count($this->y) &&
                            $this->y[array_search($y, $this->y) - 1] === $movey) {
                            return true;
                        } else return false;
                    }
                }
            }
        }
        return false;
    }

    public function checkKill($x, $y, $movex, $movey, $type)
    {
        if ($type == 'C') {
            if (array_search($x, $this->x) - 2 < count($this->x)) {
                if ($this->x[array_search($x, $this->x) - 2] === $movex) {
                    if (array_search($y, $this->y) + 2 < count($this->y) &&
                        $this->y[array_search($y, $this->y) + 2] === $movey) {
                        if ($toKill = $this->findPawn($movex + 1, $this->y[array_search($y, $this->y) + 1])) {
                            return $toKill;
                        } else return false;
                    } else if (array_search($y, $this->y) - 2 < count($this->y) &&
                        $this->y[array_search($y, $this->y) - 2] === $movey) {
                        if ($toKill = $this->findPawn($movex + 1, $this->y[array_search($y, $this->y) - 1])) {
                            return $toKill;
                        } else return false;
                    } else return false;
                }
            }
        } else if ($type == 'B') {
            if (array_search($x, $this->x) + 2 < count($this->x)) {
                if ($this->x[array_search($x, $this->x) + 2] === $movex) {
                    if (array_search($y, $this->y) + 2 < count($this->y) &&
                        $this->y[array_search($y, $this->y) + 2] === $movey) {
                        if ($toKill = $this->findPawn($movex - 1, $this->y[array_search($y, $this->y) + 1])) {
                            return $toKill;
                        } else return false;
                    } else if (array_search($y, $this->y) - 2 < count($this->y) &&
                        $this->y[array_search($y, $this->y) - 2] === $movey) {
                        if ($toKill = $this->findPawn($movex - 1, $this->y[array_search($y, $this->y) - 1])) {
                            return $toKill;
                        } else return false;
                    } else return false;
                }
            }
        } else if ($type == 'BD' || $type == 'CD') {
            if (array_search($x, $this->x) - 2 < count($this->x) && array_search($x, $this->x) - 2 >= 0) {
                if ($this->x[array_search($x, $this->x) - 2] === $movex) {
                    if (array_search($y, $this->y) + 2 < count($this->y) &&
                        $this->y[array_search($y, $this->y) + 2] === $movey) {
                        if ($toKill = $this->findPawn($movex + 1, $this->y[array_search($y, $this->y) + 1])) {
                            return $toKill;
                        } else return false;
                    } else if (array_search($y, $this->y) - 2 < count($this->y) &&
                        $this->y[array_search($y, $this->y) - 2] === $movey) {
                        if ($toKill = $this->findPawn($movex + 1, $this->y[array_search($y, $this->y) - 1])) {
                            return $toKill;
                        } else return false;
                    } else return false;
                }
            } else if (array_search($x, $this->x) + 2 < count($this->x)) {
                if ($this->x[array_search($x, $this->x) + 2] === $movex) {
                    if (array_search($y, $this->y) + 2 < count($this->y) &&
                        $this->y[array_search($y, $this->y) + 2] === $movey) {
                        if ($toKill = $this->findPawn($movex - 1, $this->y[array_search($y, $this->y) + 1])) {
                            return $toKill;
                        } else return false;
                    } else if (array_search($y, $this->y) - 2 < count($this->y) &&
                        $this->y[array_search($y, $this->y) - 2] === $movey) {
                        if ($toKill = $this->findPawn($movex - 1, $this->y[array_search($y, $this->y) - 1])) {
                            return $toKill;
                        } else return false;
                    } else return false;
                }
            }
        }
        return false;
    }

    public function checkQueen($x, $color)
    {
        switch ($color) {
            case 'B':
                return $x == 8;
            case 'C':
                return $x == 1;
            default:
                return false;
        }
    }
}
