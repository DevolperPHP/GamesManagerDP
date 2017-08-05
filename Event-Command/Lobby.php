
<?php 

namespace GamesManagerDP/Event-Command/Lobby;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\scheduler\PluginTask;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;use pocketmine\utils\Config;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\tile\Sign
use pocketmine\block\Block;
use pocketmine\level\Level;
use pocketmine\Player;
use pocketmine\Server;

class GamesManagerDP/Event-Command/Lobby extends PluginBase implements Listener{
  
  public $minute = 0;
  public $second = 60;
  public $counttype = "down";
  
  public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this,$this);		@mkdir($this->getDataFolder());
    $pos = [
      'lobby' => 'world',
      'game' => 'world',
      'x' => '0',
      'y' => '0',
      'z' => '0',
      'line0' => '[Join Sign]',
      'line1' => 'Touch To Teleport',
      'line2' => 'Lobby',
      'line3' => 'text',    ];
    $cfg = new C($this->getDataFolder() . "viproom.yml", C::YAML,$pos);
		$cfg->save();
  }
    public function onDisable(){	  $this->getConfig()->save();  }
  
  public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
    switch($cmd->getName()){
      case 'set':        if(isset($args[0])){
          switch($args[0]){
            case 'lobby':
              $x = $sender->getFloorX();
							$y = $sender->getFloorY();
							$z = $sender->getFloorZ();              $this->getConfig()->set("x", $x);              $this->getConfig()->set("y", $y);
              $this->getConfig()->set("z", $z);
              $lobby = $sender->getLevel()->getName();
              $this->getConfig()->set("lobby", $lobby);
              
              return true;
              
            case 'game':
              $game = $sender->getLevel()->getName();
							$this->getConfig()->set("game", $game);
          }
        }
    }
  }
  
  public function onChange(SignChangeEvent $e){
)    $p = $e->getPlayer();
    $line0 = $this->getConfig()->get("line0");
    $line1 = $this->getConfig()->get("line1");
    $line2 = $this->getConfig()->get("line2");
    $line3 = $this->getConfig()->get("line3");
    
    if($p->isOp()){
      if($e->getLine(0) === "lobby"){
        
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
    $lobby = $this->getConfig()->get("world");
    
    if($sign instanceof Sign){
      $text = $sign->getText();
      
      if($text[0] === $lineone){
        $p->teleport($this->getServer()->getLevelbyName("$world")->getSafeSpawn());
      }
    }
  }
  
  public function tick(){
		$lobby = $this->getConfig()->get("lobby");
		$world = $this->getServer()->getLevelByName("$lobby")->getPlayers();
    $game = $this->getConfig()->get("game");
    
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
      
      if($this->second < 0 && $this->second > 0){
        $p->teleport($this->getServer()->getLevelbyName("$game")->getSafeSpawn());
      }
	}
}
