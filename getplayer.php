<?php

// NOT FOR USER ACCESS
// This page is used in "playeredit.js" to get the stats for a specific player.
// It returns it in a JSON format.
// success will be true if successful, otherwise false.

$playerID = filter_input(INPUT_GET, 'playerID');
if ($playerID == null) {
    $success = false;
    $message = "Player ID is required.";
}
else {
    require_once("config.php");
    $query = "SELECT * FROM players WHERE playerID = :playerID";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':playerID', $playerID);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $success = true;
    } else {
        $success = false;
        $message = "Player ID not found.";
    }
}
?>

<?php if ($success):?>
{
    "success":true,
    "playerID":<?=$player['PlayerID']?>,
    "playerNumber":"<?=$player['PlayerNumber']?>",
    "playerPosition":"<?=$player['PlayerPosition']?>",
    "playerYear":"<?=$player['PlayerYear']?>",

    "imagePath":"<?=$player['ImagePath']?>",
    
    "atBats":<?=$player['AB']?>,
    "plateAppearances":<?=$player['PA']?>,
    "battingAverage":<?=$player['AVG']?>,
    "onBasePercentage":<?=$player['OBP']?>,
    "slugging":<?=$player['SLG']?>,
    "hits":<?=$player['H']?>,
    "singles":<?=$player['1B']?>,
    "doubles":<?=$player['2B']?>,
    "triples":<?=$player['3B']?>,
    "homeruns":<?=$player['HR']?>,
    "runsBattedIn":<?=$player['RBI']?>,
    "stolenBases":<?=$player['SB']?>,
    "caughtStealing":<?=$player['CS']?>,

    "inningsPitched":<?=$player['IP']?>,
    "wins":<?=$player['W']?>,
    "losses":<?=$player['L']?>,
    "earnedRunAverage":<?=$player['ERA']?>,
    "whip":<?=$player['WHIP']?>,
    "strikeOuts":<?=$player['SO']?>,
    "walks":<?=$player['BB']?>,
    "opponentBattingAverage":<?=$player['BAA']?>
}
<?php else:?>
{
    "success":false,
    "message":"<?=$message?>"
}
<?php endif;?>