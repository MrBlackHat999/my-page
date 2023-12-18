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
            if(isset($_SESSION["Background"]))
                {
                    echo "class='Background'";
                }
            if(@$_SESSION['ConeversationProgression']==7) 
                {
                    $_SESSION["Background"] = "true";
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
                    if ($_SESSION['ConeversationProgression']>=17)
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
                echo "<img id='DavieStill' src='images/DaveMiller.png'/>";
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
                $dialogOption = $_SESSION['DialogOption'];
                            
                $Dave = $convo[$dialogOption]["Dave"][$progress];
                $Steven = $convo[$dialogOption]["Steven"][$progress];
                //echo $progress;
                if (!ctype_space($Dave))
                    {
                        talking($Dave,$dialogOption.",".$progress,"DaveLines");
                    }
                if (!ctype_space($Steven))
                    {
                        talking($Steven,$dialogOption.",".$progress,"StevenLines");
                    }
                echo "</div>";

                
            }

        }




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