<?php

declare(strict_types=1);

namespace HyperFlareMC\PMRequisites;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class EventListener implements Listener{

    /**
     * @var Main
     */
    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $player->getServer()->getCommandMap()->dispatch($player, "spawn");
    }

}