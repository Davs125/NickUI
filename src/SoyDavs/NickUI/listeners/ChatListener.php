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

    public function onChat(PlayerChatEvent $event): void {
        $player = $event->getPlayer();
        $message = $event->getMessage();

        $data = $this->plugin->getPlayerNickData($player->getName());
        $config = $this->plugin->getPluginConfig();
        $chatFormat = $config->get("chat_format", "{RANK_PREFIX} {DISPLAY_NAME}: {MESSAGE}");

        if($data !== null) {
            $rankName = $data["rank"];
            $ranks = $config->get("ranks", []);
            $rankPrefix = $ranks[$rankName]["prefix"] ?? "";
            $displayName = $data["displayName"];
        } else {
            $defaultRank = $config->get("default_rank", "default");
            $ranks = $config->get("ranks", []);
            $rankPrefix = $ranks[$defaultRank]["prefix"] ?? "";
            $displayName = $player->getName();
        }

        $format = str_replace("{RANK_PREFIX}", $this->colorize($rankPrefix), $chatFormat);
        $format = str_replace("{DISPLAY_NAME}", $displayName, $format);
        $format = str_replace("{MESSAGE}", $message, $format);

        $event->setFormat($format);
    }

    private function colorize(string $message): string {
        return str_replace("&", "§", $message);
    }
}
