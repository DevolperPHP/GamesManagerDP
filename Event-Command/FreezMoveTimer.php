<?php

namespace GamesManagerDP/Event-Command/FreezMoveTimer;

use pocketmine\plugin\PluginBase;
use podketmine\event\Listener;
use pocketmine\scheduler\PluginTask;
use pocketmine\event\player\PlayerMoveEvent;

class GamesManagerDP/Event-Command/FreezMoveTimer extends PluginBase implements Listener{
  
  public $minute = 0;
  public $second = 60;
  public $counttype = "down";
  
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new Task($this),20);
		@mkdir($this->getDataFolder());
    $level = [
      'level' => 'world'
    ];
    $cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, $level);
		$cfg->save();
  }
  
  public function onDisable(){
		$this->getConfig()->save();
  }
  
  public function tick(){

		$level = $this->getConfig()->get("world");
		$game = $this->getServer()->getLevelByName("$level")->getPlayers();
		if($this->time == "on"){
			$this->second--;
		}

		foreach($game as $p){

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
	
  public function onMove(PlayerMoveEvent $event){

    $player = $event->getPlayer();
	  
    $level = $this->getConfig()->get("world");
    $game = $this->getServer()->getLevelByName("$level")->getPlayers();
	  
    foreach($game as $p){
      $event->setCancelled(true);
      
      if($this->second < 0 && $this->second > 0){
        $event->setCancelled(false);
      }
    }

  }
}
