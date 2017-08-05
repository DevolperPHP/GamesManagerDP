<?php

namespace GamesManagerDP/Event-Command/GameJoinSign;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\math\Vector3;
use pocketmine\tile\Sign;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\block\Block;
use pocketmine\level\Level;
use pocketmine\Player;
use pocketmine\Server;

class GamesManagerDP/Event-Command/GameJoinSign extends PluginBase implements Listener{
  
  public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		@mkdir($this->getDataFolder());
    $sing = [
      'line0' => '[Join Sign]',
      'line1' => 'Touch To Join Game',
      'line2' => 'text',
      'line3' => 'text',
      'world' => 'world',
    ];
    $cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, $sign);
		$cfg->save();
  }
  
  public function onDisable(){
		$this->getConfig()->save();
  }
  
  public function onChange(SignChangeEvent $e){
    $p = $e->getPlayer();
    
    $line0 = $this->getConfig()->get("line0");
    $line1 = $this->getConfig()->get("line1");
    $line2 = $this->getConfig()->get("line2");
    $line3 = $this->getConfig()->get("line3");
    
    if($p->isOp()){
      if($e->getLine(0) === "JoinSign"){
        
 	 		 	$e->setLine(0, $line0);
 	 		 	$e->setLine(1, $line1);
 	 		 	$e->setLine(2, $line2);
 	 		 	$e->setLine(3, $line3);
      }
    }
  }
  
  public function onClick(PlayerInteractEvent $e){
    $p = $e->getPlayer();
    $sign = $e->getBlock()->getLevel()->getTile($e->getBlock());
    
    $line0 = $this->getConfig()->get("line0");
    $line1 = $this->getConfig()->get("line1");
    $line2 = $this->getConfig()->get("line2");
    $line3 = $this->getConfig()->get("line3");
    $world = $this->getConfig()->get("world");
    
    if($sign instanceof Sign){
      $text = $sign->getText();
      
      if($text[0] === $lineone){
        $p->teleport($this->getServer()->getLevelbyName("$world")->getSafeSpawn());
      }
    }
  }
}
