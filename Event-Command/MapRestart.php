<?php

namespace GamesManagerDP/Event-Command/MapRestart;

use EDLB\GameSender;

class ResetMap{
  
  public function __construct(GameSender $plugin){
    
		$this->plugin = $plugin;
    
	}
  
  public function resetWorld($){
    $name = self::WORLD;
    $this->getServer()->unloadLevel($this->getServer()->getLevelByName($name));
    $zip = new /ZipArchive;
    $zip->open($this->getServer()->getDataFolder."Map/".$name.".zip");
    $zip->extractTo($this->getServer()->getDataPath()."worlds");
    $zip->close;
    unset($zip);
    $this->getServer()->loadLevel(self::WORLD);
}
