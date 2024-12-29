<?php

namespace SoyDavs\NickUI\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use SoyDavs\NickUI\Main;

class UnNickCommand extends Command {

    private Main $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("unnick", "Revert to your real name", "/unnick", []);
        $this->setPermission("nickui.cmd.unnick");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if (!$this->testPermission($sender)) {
            return true;
        }

        if (!$sender instanceof Player) {
            $sender->sendMessage("This command can only be used in-game.");
            return true;
        }

        $this->plugin->removePlayerNickData($sender->getName());
        $sender->setDisplayName($sender->getName());

        $sender->sendMessage("§eYou have reverted to your real name: §f" . $sender->getName());
        return true;
    }
}
