<?php

namespace GamesManagerDP/FreezMoveTimer;

use pocketmine\plugin\PluginBase;
use podketmine\event\Listener;
use pocketmine\scheduler\PluginTask;
use pocketmine\event\player\PlayerMoveEvent;

class GamesManagerDP/FreezMoveTimer extends PluginBase implements Listener{
  
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
  
  
}
