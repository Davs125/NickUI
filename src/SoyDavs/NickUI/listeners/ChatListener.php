<?php

namespace SoyDavs\NickUI\listeners;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use SoyDavs\NickUI\Main;

class ChatListener implements Listener {

    private Main $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onPlayerChat(PlayerChatEvent $event): void {
        $player = $event->getPlayer();
        $message = $event->getMessage();

        $nickData = $this->plugin->getPlayerNickData(strtolower($player->getName()));
        if ($nickData !== null) {
            $displayName = $nickData['displayName'] ?? $player->getName();
            $rank = $nickData['rank'] ?? $this->plugin->getPluginConfig()->get("default_rank", "default");
            $rankPrefix = $this->plugin->getPluginConfig()->get("ranks.$rank.prefix", "");

            // Replace color codes if necessary
            $rankPrefix = str_replace('&', '§', $rankPrefix);

            // Construct the new message format
            $format = "{$rankPrefix} {$displayName}: {$message}";

            // Set the new message format
            $event->setMessage($format);
        }
    }
}
