<?php

namespace GamesManagerDP/Event-Command/GameTimer;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat as Color;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\level\Level;
use pocketmine\Player;
use pocketmine\Server;

class GamesManagerDP/Event-Command/GameTimer extends PluginBase implements Listener{
  
  public $minute = 0;
  public $second = 60;
  public $counttype = "down"; 
  
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getServer()->getScheduler()->scheduleRepeatingTask(new Task($this),20);    @mkdir($this->getDataFolder());
    $level = [
      
      'game' => 'world',
      'leave' => 'world',
    ];
    $cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, $level);
    $cfg->save();
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
    switch($cmd->getName()){
      case 'set':
        if(isset($args[0])){          switch($args[0]){
            case 'leave':
              $leave = $sender->getLevel()->getName();
              $this->getConfig()->set("leave", $leave);
              
              return true;
              
            case 'game':
              $game = $sender->getLevel()->getName();
							$this->getConfig()->set("game", $game);
          }        }
    }
  }
  
  public function tick(){
		$game = $this->getConfig()->get("game");
		$map = $this->getServer()->getLevelByName("$game")->getPlayers();
    $leave = $this->getConfig()->get("leave");
    
		if($this->time == "on"){
			$this->second--;
		}
    
		foreach($world as $p){
      
			if($this->second > 60 && $this->second < 9){e
					$this->second = 60;
					$this->minute--;
				}
			}
      
      if($this->second < 0 && $this->second > 0){
        $p->teleport($this->getServer()->getLevelbyName("l")->getSafeSpawn());
      }
	}
}
