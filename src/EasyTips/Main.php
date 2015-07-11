<?php

namespace EasyTips;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
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
    $this->getLogger()->info(TextFormat::BLUE."Created By" . TextFormat::BOLD . " " . TextFormat::LIGHT_PURPLE . "ItzBulkDev");
    
		
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
      $players->sendTip($msg2);
      $p->sendTip($msg);
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
      
      	public function onDeath(PlayerDeathEvent $event){
		$cause = $event->getEntity()->getLastDamageCause();
		$killer = $event->getEntity()->getLastDamageCause()->getDamager();
		$player = $event->getEntity();
		if($cause instanceof EntityDamageByEntityEvent and $killer instanceof Player and $player instanceof Player) {
			$config = $this->getConfig();
			$msg = $config->get("Announce-Death");
			$msg = str_replace("{PLAYER}", $player->getName(), $msg);
			$msg = str_replace("{KILLER}", $killer->getName(), $msg);
			$msga = $config->get("Killed-Message");
			$msga = str_replace("{KILLER}", $killer->getName(), $msga);
			$msgb = $config->get("Killer-Message");
			$msga = str_replace("{PLAYER}", $player->getName(), $msgb);
			foreach($this->getServer()->getOnlinePlayers() as $players);
			$players->sendTip($msg);
			$player->sendMessage($msga);
			$killer->sendTip($msgb);
		
	}else{
		$event->setCancelled();
	}

}
      
    }

