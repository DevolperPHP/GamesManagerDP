<?php

namespace GameManager/Event-Command/Time.php;
  
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat as Color;

class GamesManagerDP/Event-Command/Time extends PluginBase implements Listener{
  
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
    $cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, $level);
    $cfg->save();
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
