#!/usr/bin/php
<?php
$input_file = 'Resources/day7/input.txt';
if (file_exists($input_file)) {
    $input = file_get_contents($input_file);
    if ($input != null) {
        $bag_rules = explode("\n", $input);
        print 'Part 1 answer: ' . solve_part_one($bag_rules) . "\n";
        print 'Part 2 answer: ' . solve_part_two($bag_rules) . "\n";
    }
}

function solve_part_one(array $bag_rules): int
{
    $rules = parse_bag_rules($bag_rules);
    var_dump($rules);
    return count(get_parent_colors($rules, 'shiny gold'));
}

function solve_part_two(array $bag_rules): int
{
    return get_content_count(parse_bag_rules($bag_rules), 'shiny gold') - 1;
}

function get_content_count(array $rules, string $color): int
{
    $ret = 0;

    foreach ($rules[$color] as $content_color => $count)
        $ret += $count * get_content_count($rules, $content_color);

    return $ret + 1;
}

function get_parent_colors(array $rules, string $color): array
{
    $ret = [];

    foreach ($rules as $parent_color => $content)
        if (array_key_exists($color, $content))
            $ret = array_merge($ret, [$parent_color], get_parent_colors($rules, $parent_color));

    return array_unique($ret);
}

function parse_bag_rules(array $bag_rules): array
{
    $ret = [];

    foreach ($bag_rules as $rule) {
        if (preg_match('/^(([a-z ]+) bags?) contain ([0-9a-z, ]+ bags?)+\.$/', trim($rule), $matches)) {
            [, , $color, $content] = $matches;
            if ($content === 'no other bags')
                $ret[$color] = [];
            elseif (preg_match_all('/((\d+) ([a-z ]+) bags?)+?,?/', trim($content), $content_matches, PREG_SET_ORDER)) {
                $parsed_content = [];
                foreach ($content_matches as $content_match) {
                    [, , $content_qty, $content_color] = $content_match;
                    $parsed_content[$content_color] = $content_qty;
                }
                $ret[$color] = $parsed_content;
            }
        }
    }

    return $ret;
}