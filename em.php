<?php

function singleTicketWin($ticket, $draw) {
        if (count(array_intersect($ticket, $draw)) >= 2) {
                return true;
        }
        return false;
}

function wouldWeWin($tickets, $draw) {
        foreach ($tickets as $ticket) {
                if (singleTicketWin($ticket, $draw)) {
                        return true;
                }
        }
        return false;

}

function printTicket($ticket) {
        sort($ticket);
        echo $ticket[0] . ' ' . $ticket[1] . ' ' . $ticket[2] . ' ' . $ticket[3] . ' ' . $ticket[4] . "";
}

function printTickets($tickets) {
        foreach ($tickets as $ticket) {
                printTicket($ticket);
                echo "\r\n";
        }
}

function swapTicket($ticket, $swapA, $swapB) {
        foreach ($ticket as $k => $number) {
                if ($number == $swapA) {
                        $ticket[$k] = $swapB;
                } else if ($ticket[$k] == $swapB) {
                        $ticket[$k] = 'xxx';
                }
        }
        foreach ($ticket as $k => $number) {
                if ($number == 'xxx') {
                        $ticket[$k] = $swapA;
                }
        }
        return $ticket;
}

function swapTickets($tickets, $swapA, $swapB) {
        foreach ($tickets as $k => $ticket) {
                $tickets[$k] = swapTicket($ticket, $swapA, $swapB);
        }
        return $tickets;
}

$purchased = array();

for ($a = 1; $a <= 46; $a++) {
        for ($b = $a + 1; $b <= 47; $b++) {
                for ($c = $b + 1; $c <= 48; $c++) {
                        for ($d = $c + 1; $d <= 49; $d++) {
                                for ($e = $d + 1; $e <= 50; $e++) {
                                        $draw = array($a, $b, $c, $d, $e);
                                        if (wouldWeWin($purchased, $draw)) {
                                        } else {
                                                $toBuy = array($draw[0], $draw[1], $draw[2], $draw[3], $draw[4]);
                                                $purchased[] = $toBuy;
                                        }
                                }
                        }
                }
        }
        // var_dump($a);
}

$swaps = array(
        // add your own
        array(12, 33),
        array(9, 13), // etc
);

foreach ($swaps as $swap) {
        $purchased = swapTickets($purchased, $swap[0], $swap[1]);
}


echo "Would buy " . count($purchased) . " tickets\r\n";

printTickets($purchased);
