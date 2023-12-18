<?php session_start();?>
<?php require "audio/BackgroundMusic.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="visaulity/DayGame.css">
    <title>doggo</title>
</head>
<body <?php
            if(isset($_SESSION['ConeversationProgression']))
                {
                    $progress=$_SESSION['ConeversationProgression'];
                    if ($progress>=8&&$progress<98)
                        {
                            echo "class='BackgroundDiningArea'";
                        }
                    if($progress>98&&$progress<199)
                        {
                            echo "class='BackgroundKitchen'";
                        }
                } ?> >
<?php
if(!isset($_SESSION["Conversation"]))
    {
        $ScriptDefault=file_get_contents("text/Dave/DaveDefault.txt");
        $ScriptInsane=file_get_contents("text/Dave/Insane.txt");
        $ScriptPassiveAgressive=file_get_contents("text/Dave/PassiveAgressive.txt");
        $ScriptResonable=file_get_contents("text/Dave/Resonable.txt");

        $JackScriptDefault=file_get_contents("text/Jack/JackDefault.txt");
        $JackScriptInsane=file_get_contents("text/Jack/JackInsane.txt");
        $JackScriptPassiveAgressive=file_get_contents("text/Jack/JackPassiveAgressive.txt");
        $JackScriptResonable=file_get_contents("text/Jack/JackResonable.txt");

        $StevenScriptDefault=file_get_contents("text/Steven/StevenDefault.txt");
        $StevenScriptInsane=file_get_contents("text/Steven/StevenInsane.txt");
        $StevenScriptPassiveAgressive=file_get_contents("text/Steven/StevenPassiveAgressive.txt");
        $StevenScriptResonable=file_get_contents("text/Steven/StevenResonable.txt");

        $RonaldoScriptDefault=file_get_contents("text/Ronaldo/RonaldoDefault.txt");
        $RonaldoScriptInsane=file_get_contents("text/Ronaldo/RonaldoInsane.txt");
        $RonaldoScriptPassiveAgressive=file_get_contents("text/Ronaldo/RonaldoPassiveAgressive.txt");
        $RonaldoScriptResonable=file_get_contents("text/Ronaldo/RonaldoResonable.txt");

        $_SESSION['conversation'][1]['Dave']=explode(";",$ScriptDefault);
        $_SESSION['conversation'][2]['Dave']=explode(";",$ScriptInsane);
        $_SESSION['conversation'][3]['Dave']=explode(";",$ScriptPassiveAgressive);
        $_SESSION['conversation'][4]['Dave']=explode(";",$ScriptResonable);

        $_SESSION['conversation'][1]['Jack']=explode(";",$JackScriptDefault);
        $_SESSION['conversation'][2]['Jack']=explode(";",$JackScriptInsane);
        $_SESSION['conversation'][3]['Jack']=explode(";",$JackScriptPassiveAgressive);
        $_SESSION['conversation'][4]['Jack']=explode(";",$JackScriptResonable);

        $_SESSION['conversation'][1]['Steven']=explode(";",$StevenScriptDefault);
        $_SESSION['conversation'][2]['Steven']=explode(";",$StevenScriptInsane);
        $_SESSION['conversation'][3]['Steven']=explode(";",$StevenScriptPassiveAgressive);
        $_SESSION['conversation'][4]['Steven']=explode(";",$StevenScriptResonable);

        $_SESSION['conversation'][1]['Ronaldo']=explode(";",$RonaldoScriptDefault);
        $_SESSION['conversation'][2]['Ronaldo']=explode(";",$RonaldoScriptInsane);
        $_SESSION['conversation'][3]['Ronaldo']=explode(";",$RonaldoScriptPassiveAgressive);
        $_SESSION['conversation'][4]['Ronaldo']=explode(";",$RonaldoScriptResonable);
    }


function talking($words, $voice,$who)
    {
        echo "<audio controls autoplay hidden='hidden'>  <source src='audio/$who/$voice.mp3' type='audio/mpeg'>  </audio>";
        echo "<div id='talking'>";
        echo $words;
        echo "</div>";
    }

if (!isset($_SESSION['GameOn'])&&!isset($_SESSION['DaveSwitch']))
     {
        echo "<form method='get'>";
        echo "<input type='submit' name='GameOn' value='Begin the suffering'>";
        echo "</form>";
        if (isset($_GET['GameOn']))
            {
                    $_SESSION['GameOn']=$_GET['GameOn'];
                    header ("refresh:0; url=DayGame.php");
            }

        }
    else 
        {   
            if (isset ($_SESSION['ConeversationProgression']))
                {
                    $progress=$_SESSION['ConeversationProgression'];

                    if ($progress>=17&&$progress<99)
                        {
                            if (!isset($_SESSION['StevenSwitch']))
                            {
                                echo "<img id='StevenGoesUp' src='images/PhoneGuySteven.png'/>";
                                $_SESSION['StevenSwitch']=true;
                            }
                            else
                            {            
                                echo "<img id='StevenStill' src='images/PhoneGuySteven.png'/>";
                            }
                        }

                    if ($progress>99&&$progress<199)
                        {
                            if (!isset($_SESSION['RonaldoSwitch']))
                            {
                                echo "<img id='RonaldoGoesUp' src='images/Ronaldo.png'/>";
                                $_SESSION['RonaldoSwitch']=true;
                            }
                            else
                            {            
                                echo "<img id='RonaldoStill' src='images/Ronaldo.png'/>";
                            }
                        }

                }

            

           if (!isset($_SESSION['DaveSwitch']))
            {
                echo "<img id='DavieGoesUp' src='images/DaveMiller.png'/>";
                $_SESSION['DaveSwitch']=true;
                echo "<div class='TalkingOptionsFloat'>";
                echo "<div class='skip'>";
                echo "<form method='get'>";
                echo "  <input type='submit' name='skip' value='next'>";
                echo "</form>";
                echo "</div>";
                PlayTheme(1);
            }
            else
            {  
                if (isset($_SESSION['ConeversationProgression']))
                    {
                        if ($_SESSION['ConeversationProgression']<99)
                            {
                                echo "<img id='DavieStill' src='images/DaveMiller.png'/>";
                            }
                    }
                else
                    {
                        echo "<img id='DavieStill' src='images/DaveMiller.png'/>";
                    }
                    
                echo "<div class='TalkingOptions'>";
                echo "<div class='skip'>";
                echo "<form method='get'>";
                echo "  <input type='submit' name='skip' value='next'>";
                echo "</form>";
                echo "</div>";
                if (!isset($_SESSION["ConeversationProgression"]))
                    {
                        $_SESSION['ConeversationProgression']=0;
                    }
                else
                    {
                        $_SESSION['ConeversationProgression']++;
                    }

                if (isset($_SESSION["ConeversationProgression"]))
                    {
                        PlayTheme($_SESSION['ConeversationProgression']+1);
                    }

                if (isset($_GET["skip"]))
                        {
                            $_SESSION['DialogOption']= 1;
                        }

                for ($i = 1; $i <= 4; $i++)
                {
                    if (!ctype_space($_SESSION['conversation'][$i]['Jack'][$_SESSION['ConeversationProgression']]))
                        {
                            echo "<a href='DayGame.php?DialogOption=$i'>".$_SESSION['conversation'][$i]['Jack'][$_SESSION['ConeversationProgression']]."</a><br>";
                        }
                }

                if (isset($_GET['DialogOption']))
                    {
                        $_SESSION['DialogOption']=$_GET['DialogOption'];
                    }
                $progress = $_SESSION['ConeversationProgression'];
                $convo = $_SESSION['conversation'];
                $DialogOption = $_SESSION['DialogOption'];
                            
                $Dave = $convo[$DialogOption]["Dave"][$progress];
                $Steven = $convo[$DialogOption]["Steven"][$progress];
                $Ronaldo = $convo[$DialogOption]["Ronaldo"][$progress];

                //echo $progress;

                if (!ctype_space($Dave))
                    {
                        talking($Dave,$DialogOption.",".$progress,"DaveLines");
                    }
                if (!ctype_space($Steven))
                    {
                        talking($Steven,$DialogOption.",".$progress,"StevenLines");
                    }
                if (!ctype_space($Ronaldo))
                    {
                        talking($Ronaldo,$DialogOption.",".$progress,"RonaldoLines");
                    }


                        // Choose Location From Dining Area
                if($progress==35)
                    {
                        if ($DialogOption==1)
                            {
                                if (isset($_SESSION['RonaldoMet']))
                                    {
                                        $_SESSION['ConeversationProgression']=104;
                                    }
                                else
                                    {
                                        $_SESSION['ConeversationProgression']=99;
                                    }
                                        
                            }
                        if ($DialogOption==2)
                            {
                                $_SESSION['ConeversationProgression']=199;
                            }
                        if ($DialogOption==3)
                            {
                                $_SESSION['ConeversationProgression']=299;
                            }
                        if ($DialogOption==4)
                            {
                                $_SESSION['ConeversationProgression']=399;
                            } 
                        }

                // Event Markers   

                // Ronaldo's Kitchen
                if($progress>99&&$progress<200)
                    {
                        // Ronaldo Goes Straight To Cooking
                        if($progress==104)
                        {
                            if($DialogOption==3)
                            {
                                $_SESSION['ConeversationProgression']=110; 
                            }
                        }

                        // Discuss Ronaldo Options
                        if($progress==108)
                            {
                                // Cooking Begins
                                if ($DialogOption==1)
                                    {
                                        $_SESSION['ConeversationProgression']=110;                       
                                    }

                                // Stare at Ronaldo
                                if ($DialogOption==2)
                                    {
                                        $_SESSION['ConeversationProgression']=106;
                                    }

                                // Stealing Pots and Pans
                                if ($DialogOption==3)
                                    {
                                        $_SESSION['ConeversationProgression']=106;
                                    }
                                    
                                // Go back to dining Area
                                if ($DialogOption==4)
                                    {
                                        $_SESSION['ConeversationProgression']=34;
                                    }  
                                }

                        // Ronaldo Remebers You
                        if ($progress==104)
                            {
                                $_SESSION['RonaldoMet']=true;
                            }
                    }
                

                echo "</div>";

            }

        }

        // Debug
        /*
        echo "<form method='get'>";
        echo "  <input type='submit' name='GoTo100' value='GoTo100'>";
        echo "</form>";
        if (isset($_GET['GoTo100']))
            {
                $_SESSION['ConeversationProgression']=100;
            }
        */

?>
</div>


























<div class="giveup">
<form name="clear" method="get">
	<input name="destroy" type="submit" class="giveup" value="GIVE UP">
</form>
</div>
<?php
// All forms of game over
if (isset($_GET['destroy']))
	{
		header ("refresh:1; url=GAMEOVER.php");
	}
?>  
    
  

</body>
</html>