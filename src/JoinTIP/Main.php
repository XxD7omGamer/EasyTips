<?php

namespace JoinTIP;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
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
      $config = $this->getConfig();
      foreach($this->getServer()->getOnlinePlayers() as $players){
      $playerName = $event->getPlayer()->getName();
      $msg2 = $config->get("Announce-Join");
      $msg2 = str_replace("{PLAYER}", $playerName, $msg2);
      $msg = $config->get("Message-Join");
      $msg = str_replace("{PLAYER}", $playerName, $msg);
      $p = $event->getPlayer();
      $p->sendTip($msg);
      $players->sendTip($msg2);
      }
      }
      
      public function onQuitEvent(PlayerQuitEvent $event){
      $config = $this->getConfig();
      foreach($this->getServer()->getOnlinePlayers() as $players){
      $playerName = $event->getPlayer()->getName();
      $msg2 = $config->get("Announce-Quit");
      $msg2 = str_replace("{PLAYER}", $playerName, $msg2);
      $p = $event->getPlayer();
      $players->sendTip($msg2);
      }
      }
      
    }

