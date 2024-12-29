<?php

namespace SoyDavs\NickUI\listeners;

use pocketmine\event\Listener;
use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;
use SoyDavs\NickUI\Main;

class FormListener implements Listener {

    private Main $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    // Puedes agregar métodos para manejar diferentes formularios si lo deseas
}
