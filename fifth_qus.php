<?php

function ball_sort($containers)
{
    $ballCounts = array();
    $containerCounts = array();
    foreach ($containers as $container) {
        $containerCounts[] = count($container);

        foreach ($container as $ballType => $count) {
            if (!isset($ballCounts[$ballType])) {
                $ballCounts[$ballType] = array();
            }

            $ballCounts[$ballType][] = $count;
        }
    }

    foreach ($ballCounts as &$counts) {
        sort($counts);
    }
    for ($i = 0; $i < count($ballCounts[array_key_first($ballCounts)]); $i++) {
        $totalBalls = 0;

        foreach ($ballCounts as $counts) {
            $totalBalls += $counts[$i];
        }

        $totalContainers = array_sum($containerCounts);

        if ($totalBalls != $totalContainers) {
            return "Impossible\n";
        }
    }

    return "Possible\n";
}

$container_one = array(
    array(1, 2,3),
    array(1, 2,3),
);

$container_two = array(
    array(1, 1, 3),
    array(2, 2),
    array(1, 1, 2),
);

print ball_sort($container_one);echo'<br>';
print ball_sort($container_two);