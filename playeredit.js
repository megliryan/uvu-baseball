// Code implementing the dropdown menu in admin.php

// Stats in the menu.
// This is both the IDs of the fields in the form as
// well as properties in getplayer.php. So don't change them without changing this!
const stats = [// Player Info
               "playerName",
               "playerNumber",
               "playerPosition",
               "playerYear",
               // Player Stats
               "atBats",
               "plateAppearances",
               "battingAverage",
               "onBasePercentage",
               "slugging",
               "hits",
               "singles",
               "doubles",
               "triples",
               "homeruns",
               "runsBattedIn",
               "stolenBases",
               "caughtStealing",
               // Pitching Stats
               "inningsPitched",
               "wins",
               "losses",
               "earnedRunAverage",
               "whip",
               "strikeOuts",
               "walks",
               "opponentBattingAverage"
                ];

function getPlayerStats() {
    var playerID = document.getElementById("playerID").value;
    // If the option is to make a new player, clear the form.
    if (playerID == "new") {
        for (stat in stats) {
            var elem = document.getElementById(stat)
            elem.value = "";
        }
        document.getElementById("playerUpdateButton").value = "Add Player"
    }
    else {
        // Get the player's information.
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "getplayer.php?playerID="+playerID);
        // Set a listener so that when the stats are loaded, it edits the forms.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // The data is ready to display
                var player = JSON.parse(this.responseText)

                if (player.success) {
                    for (stat in stats) {
                        var elem = document.getElementById(stat)
                        elem.value = player[stat]
                    }
                    document.getElementById("playerUpdateButton").value = "Update Player"
                }

            }
        }
        // Send the request.
        xhttp.send();
    }
    


}