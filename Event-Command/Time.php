
<?php

namespace GameManager/Time.php;
  
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\utils\TextFormat as Color;
use GameManagerDP/Time/time;

class Main extends PluginBase implements Listener{
  
  public $minute = 0;   /*Time minute*/
  public $second = 60; /*Time second*/
  public $counttype = "down";  /*Time counttype you can change "down" to "up"*/
  
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getServer()->getScheduler()->scheduleRepeatingTask(new Task($this),20);
    @mkdir($this->getDataFolder());
    $level = [
      $level => 'world',
    ];
  }
  
	
  public function onDisable(){
	$this->getConfig()->save();
  }
	
  public function tick(){
		$level = $this->getConfig()->get("level");
		$world = $this->getServer()->getLevelByName("$level")->getPlayers();
    
		if($this->time == "on"){
			$this->second--;
		}

		foreach($world as $p){

			if($this->second > 60 && $this->second < 9){
				$p->sendTip($this->minute.":0".$this->second);
			}

			

			if($this->time == "on"){

				if($this->second == 0){
					$this->second = 60;
					$this->minute--;

				}

			}

	}
}
