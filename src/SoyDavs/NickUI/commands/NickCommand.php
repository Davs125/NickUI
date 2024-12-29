<?php

namespace SoyDavs\NickUI\commands;

use jojoe77777\FormAPI\CustomForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use SoyDavs\NickUI\Main;

class NickCommand extends Command {

    private Main $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("nick", "Change your display name and rank", "/nick", []);
        $this->setPermission("nickui.cmd.nick");
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

        $this->openNickForm($sender);
        return true;
    }

    private function openNickForm(Player $player): void {
        $form = new CustomForm(function (Player $player, ?array $data) {
            if ($data === null) {
                // The player closed the form
                return;
            }

            // Debug: Display the data array
            $player->sendMessage("§7Data: " . json_encode($data));

            // Without label, $data[0] is input, $data[1] is dropdown
            $displayName = trim($data[0] ?? '');
            $rankIndex = $data[1] ?? 0;

            if (empty($displayName)) {
                $player->sendMessage("§cThe name cannot be empty.");
                return;
            }

            $config = $this->plugin->getPluginConfig();
            $ranks = $config->get("ranks", []);
            $rankOptions = array_keys($ranks);
            $defaultRank = $config->get("default_rank", "default");

            // Validate rank selection
            if (!isset($rankOptions[$rankIndex])) {
                $rankName = $defaultRank;
            } else {
                $rankName = $rankOptions[$rankIndex];
            }

            // Handle "random" name selection if applicable
            if (strtolower($displayName) === "random") {
                $randomNames = $config->get("random_names", []);
                if (empty($randomNames)) {
                    $player->sendMessage("§cNo random names are defined in the config.");
                    return;
                }
                $displayName = $randomNames[array_rand($randomNames)];
            }

            $this->plugin->setPlayerNickData($player->getName(), $displayName, $rankName);
            $player->setDisplayName($displayName);

            $player->sendMessage("§aYour nickname has been changed to §f{$displayName} §a(with rank §f{$rankName}§a).");
        });

        $form->setTitle("§lNickUI");

        // Input field for the new name
        $form->addInput("Enter your new name:", "Name...", "random");

        // Dropdown for selecting rank
        $ranks = $this->plugin->getPluginConfig()->get("ranks", []);
        $rankOptions = array_keys($ranks);
        $defaultRank = $this->plugin->getPluginConfig()->get("default_rank", "default");

        $defaultIndex = array_search($defaultRank, $rankOptions);
        $defaultIndex = $defaultIndex === false ? 0 : $defaultIndex;

        $form->addDropdown("Select your rank:", $rankOptions, $defaultIndex);

        $player->sendForm($form);
    }
}
