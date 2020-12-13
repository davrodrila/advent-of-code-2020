<?php

class P2
{
    protected string $file;
    protected int $x = 0;
    protected int $y = 0;
    protected int $wpx = 10;
    protected int $wpy = 1;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function run() {
        preg_match_all('/([NSEWLRF]{1})(\d+)/', file_get_contents($this->file), $commands, PREG_SET_ORDER);

        foreach ($commands as $command) {
            $this->executeCommand($command[1], (int)$command[2]);
        }

        return abs($this->x) + abs($this->y);
    }

    protected function executeCommand(string $cmd, int $num) : void
    {
        switch($cmd) {
            case 'N':
                $this->wpy += $num;
                break;
            case 'S':
                $this->wpy -= $num;
                break;
            case 'E':
                $this->wpx += $num;
                break;
            case 'W':
                $this->wpx -= $num;
                break;
            case 'F':
                $this->x += $this->wpx * $num;
                $this->y += $this->wpy * $num;
                break;
            case 'R':
            case 'L':
                $this->rotate($cmd, $num);
                break;
        }
    }

    protected function rotate($direction, $degrees)
    {
        if($direction === 'R') {
            $degrees = 360 - $degrees;
        }

        $rad = $degrees * (pi() / 180);
        $x = $this->wpx * cos($rad) - $this->wpy * sin($rad);
        $y = $this->wpx * sin($rad) + $this->wpy * cos($rad);
        $this->wpx = (int)round($x);
        $this->wpy = (int)round($y);
    }
}

// P2
$durations = [];
for($i = 0; $i < 10000; $i++) {
    $start = microtime(true);
    $p2 = (new P2(__DIR__ . '/Resources/day12/input.txt'))->run();
    $durations[] = microtime(true) - $start;
}
$avg = array_sum($durations) / count($durations);
echo "P2: {$p2}\n";
echo "AVG Duration: " . number_format($avg * 1000, 3) . "ms\n";
