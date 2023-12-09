<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="game.css">
</head>
<body>
	<header>
		<a href="../index.html">Go back to main page</a>
		<h1>THE GAME<h1>
	</header>
<div class="grid-container">
<div class="item1">
<?php
class character
	{
		protected $pwr, $def, $lck, $exp, $eq, $img, $name;
		public $hp, $lvl;
		protected function __construct()
			{
				$this->hp=100;
				$this->pwr=10;
				$this->def=5;
				$this->lvl=1;
				$this->lck=7;
				$this->exp=0;
				$this->eq=[];
				$this->img="";
				$this->name;
			}
		function show($id)
			{
				echo 
				"
				NAME: $this->name<br>
				HP: $this->hp<br>
				PWR: $this->pwr<br>
				DEF: $this->def<br>
				LVL: $this->lvl<br>
				LUCK: $this->lck<br>
				EXP: $this->exp<br>
				<img id='$id' src='$this->img'><br>";
				if (isset ($this->mana))
					{
						echo "MANA: $this->mana<br>";
					}
			}

		function damage($attacker)
			{
				$a=(rand(round($attacker/2),$attacker))-$this->def;
				if ($a>0)
					{
						$this->hp-=$a;
					}
				else
					{
						echo "attack was innefective<br>";
					}
			}
		function attack()
			{
				$_SESSION['enemy']->damage($_SESSION['player']->pwr+round($_SESSION['player']->lck*0.7));
			}
		function enemyattack()
			{
				$_SESSION['player']->damage($_SESSION['enemy']->pwr+round($_SESSION['enemy']->lck*0.7));
			}
		function giveexp()
			{
				$this->exp+=rand(30,100);
				if (isset($_SESSION['player']->mana))
					{
						$this->mana+=1+$this->lvl;
					}
			}
		function lvlup() 
			{
				if ($_SESSION["player"]->exp>round(100*0.6*$this->lvl))
				{
					$this->exp=0;
					$this->lvl++;
					$this->pwr+=round(1.3*$this->lvl);
					$this->def+=round(1.1*$this->lvl);
					$this->lck+=round(1.2*$this->lvl);
					$this->hp=100+(10*$this->lvl);
				}
				if(isset ($_SESSION['selector']))
					{
						switch ($_SESSION['selector'])
							{
								case 1:
									switch($this->lvl)
									{	
										case $this->lvl<3:
										$this->img="barbarian_level1_icon.png";
										break;
										case $this->lvl<5:
										$this->img="barbarian_level3_icon.png";
										break;
										case $this->lvl<6:
										$this->img="barbarian_level5_icon.png";
										break;
										case $this->lvl<7:
										$this->img="barbarian_level6_icon.png";
										break;
										case $this->lvl>=7:
										$this->img="barbarian_level7_icon.png";
										break;
									};
								break;
								case 2:
									switch($this->lvl)
									{	
										case $this->lvl<3:
										$this->img="wizard_level1_icon.png";
										break;
										case 3:
										$this->img="wizard_level3_icon.png";
										break;
										case 4:
										$this->img="wizard_level4_icon.png";
										break;
										case 5:
										$this->img="wizard_level5_icon.png";
										break;
										case $this->lvl>=6:
										$this->img="wizard_level6_icon.png";
										break;
									}
								break;
								case 3:
									switch($this->lvl)
									{	
										case 1:
										$this->img="goblin_level1_icon.png";
										break;
										case 2:
										$this->img="goblin_level2_icon.png";
										break;
										case $this->lvl<5:
										$this->img="goblin_level3_icon.png";
										break;
										case 5:
										$this->img="goblin_level5_icon.png";
										break;
										case $this->lvl>=6:
										$this->img="goblin_level6_icon.png";
										break;
									};
								break;
								case 4:
									switch($this->lvl)
									{	
										case $this->lvl<3:
										$this->img="witch_level1_icon.png";
										break;
										case $this->lvl>=3:
										$this->img="witch_level3_icon.png";
										break;
									}
								break;
							}
						
					}

			}
	}
class bright extends character
	{
		public $side=0;
		function heal()
			{
				echo "zjedzono".$_SESSION['healcounter']."/4 kory";
				$this->hp+=10;
			}
	}
class dark extends character
	{
		public $side=1;
		function smog()
			{
				$this->hp-=rand(1,3);
			}
	}
class warrior extends bright
	{
		function __construct($a)
			{
				parent::__construct();
				$this->lck+=10;
				$this->def+=2;
				$this->name=$a;
			}

	}
	
class wizard extends bright
	{
		protected $mana;
		function __construct($a)
			{ 
				parent::__construct();
				$this->mana=20;		
				$this->name=$a;
				
			}
		function fireball()
			{
				if ($this->mana>19)
					{
						if (isset($_SESSION['enemy']))
							{
								$this->mana-=20;
								$_SESSION['enemy']->damage($_SESSION['player']->pwr*2+round($_SESSION['player']->lck*0.7));
							}

					}
				else
					{
						echo "not enough mana<br>";
					}
			}
				
	}
class ogre extends dark
	{
		function __construct($a)
			{ 
				parent::__construct();
				$this->pwr+=10;
				$this->def-=5;
				$this->name=$a;
				
			}
	}

class witch extends dark
	{
		protected $mana;
		function __construct($a)
			{ 
				$this->mana=20;
				parent::__construct();		
				$this->name=$a;
				
			}
	}

class enemy extends character
	{
		function __construct($a)
		{
			parent::__construct();
			$this->img= "download.jfif";
			$this->name=$a;
		}
	}

?>
<form  method='get'>
<input name='selector' type='radio' value='1'>El Barbarianus <br>
<input name='selector' type='radio' value='2'>El Wizardus  <br>
<input name='selector' type='radio' value='3'>El Ogrus  <br>
<input name='selector' type='radio' value='4'>El Witchus  <br>
choose your name:<br>
<input name='name' type='text' required><br>
<input type='submit' value='Begin'><br>
</form>
</div>
<div class="item2">
<?php
if(isset ($_GET['selector']))
	{
		if(isset ($_SESSION['player'])==false)
			{
				switch ($_GET['selector'])
				{
					case 1:
					$_SESSION['player'] = new warrior($_GET["name"]);
					break;
					case 2:
					$_SESSION['player'] = new wizard($_GET["name"]);
					break;
					case 3:
					$_SESSION['player'] = new ogre($_GET["name"]);
					break;
					case 4:
					$_SESSION['player'] = new witch($_GET["name"]);
					break;
				}
				$_SESSION['selector'] = $_GET['selector'];
			}
		else
			{

			}

	}

if (isset ($_SESSION['player']))
	{
		$_SESSION['player']->show("player");
		if (isset ($_SESSION["enemy"]))
			{
				$_SESSION["player"]->attack();
			}
	}
?>
</div>
<div class="item3">
<?PHP	
if (isset ($_SESSION["enemy"],$_SESSION["player"]))
	{
		$_SESSION["enemy"]->show("enemy");
		$_SESSION["enemy"]->enemyattack();
		if ($_SESSION['enemy']->hp<0)
			{
				$_SESSION['player']->giveexp();
				unset ($_SESSION['enemy']);
			}
	}
else
	{
		$_SESSION["enemy"] = new enemy("<b>rufus</b>");
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
if (isset ($_SESSION["player"]))
	{
		if ($_SESSION["player"]->hp<0)
			{
				header ("refresh:0; url=GAMEOVER.php");
			}
		$_SESSION["player"]->lvlup();

	}

?>
<div class="item4">
<?php
//Basic attack
If (isset($_SESSION['player'], $_SESSION['attack']))
	{

	}

//All abilites
//heal
if (isset ($_SESSION['player']))
	{
		if (!isset ($_SESSION['healcounter']))
			{
				$_SESSION['healcounter']=1;
			}
		if ($_SESSION['player']->side==0)
			{
				echo "
				<form method='get'>
					<input name='heal' type='submit' value='Heal'>";

				if (isset ($_GET['heal']))
				{
					$_SESSION['heal']=$_GET['heal'];
				}
				
				if (isset ($_SESSION['heal']))
					{
						
						if ($_SESSION['healcounter']<=4)
							{
								$_SESSION['player']->heal();
								$_SESSION['healcounter']++;
							}
						if ($_SESSION['healcounter']==5)
							{
								unset ($_SESSION['heal']);
								unset($_SESSION['healcounter']);
								header ("refresh:0; url=game.php");
							}
						
					}
			}
	}
//fireball

if ($_SESSION['selector']==2&&$_SESSION['player']->lvl>4)
	{
		echo "<input name='fireball' type='submit' value='fireball'>";
		if (isset($_GET['fireball']))
			{
				$_SESSION['player']->fireball();
				header ("refresh:0; url=game.php");
			}
	}
?>
</form>
</div>















</div>
</body>
</html>