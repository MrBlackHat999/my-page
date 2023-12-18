<?php

function PlayTheme($Theme)
    {
        //echo $Theme;
        switch($Theme)
            {
                case $Theme<=9:
                echo "<audio controls autoplay loop hidden='hidden'><source src='audio/Themes/Davie_Davie.mp3' type='audio/mpeg'></audio>";
                break;

                case $Theme==10:
                echo "<audio controls autoplay hidden='hidden'><source src='audio/Themes/whoosh.mp3' type='audio/mpeg'></audio>";
                break;

                case $Theme>10:
                echo "<audio controls autoplay loop hidden='hidden'><source src='audio/Themes/RestaurantBlueprint.mp3' type='audio/mpeg'></audio>";
                break;

            }
    }



?>