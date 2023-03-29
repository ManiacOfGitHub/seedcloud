<?php

namespace SeedCloud\Controllers;

use SeedCloud\BaseController;
use SeedCloud\DatabaseManager;

class StatusController extends BaseController
{
    public function indexAction()
    {
        $dbConn1 = DatabaseManager::GetHandle();

        $statement = $dbConn1->prepare('select count(1) as number from seedqueue where state = 3');
        $result = $statement->execute();
        $waitingForBruteforceCount = $statement->fetchAll(\PDO::FETCH_ASSOC)[0]["number"];

        $statement = $dbConn1->prepare('select count(1) as number from seedqueue where state = 4');
        $result = $statement->execute();
        $bruteforcingCount = $statement->fetchAll(\PDO::FETCH_ASSOC)[0]["number"];

        $statement = $dbConn1->prepare('select count(1) as number from minerstatus where `action` = 0 and TIMESTAMPDIFF(SECOND, last_action_at, now()) < 60 ');
        $result = $statement->execute();
        $minerCount = $statement->fetchAll(\PDO::FETCH_ASSOC)[0]["number"];

        $ret_data = array(
            'userCount' => $waitingForBruteforceCount,
            'miningCount' => $bruteforcingCount,
            'minersStandby' => $minerCount,
        );
        header('Content-Type: application/json');
        echo json_encode($ret_data);
        exit;

    }
}
