<?php

namespace JoinTIP;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{

  public function onEnable(){
    $this->saveDefaultConfig();
    $config = $this->getConfig();
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info(TextFormat::GOLD."Join" . TextFormat::BLUE . "TIP" . TextFormat::GREEN . " Has Been Enabled!");
    $this->getLogger()->info(TextFormat::BLUE."Created By" . TextFormat::BOLD . " " . TextFormat::LIGHT_PURPLE . "LegacyDEVS");
    
		
    }
    
    public function onJoinEvent(PlayerJoinEvent $event){
      "{PLAYER}"  = str_replace("$player");
      $config = $this->getConfig();
      $msg = $config->get("Message");
      $p = $event->getPlayer();
      $player = $p->getName();
      $p->sendTip($msg);
      
      }
      
    }

