<?php

namespace SoyDavs\NickUI\listeners;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\event\Listener;
use pocketmine\player\Player;

class FormListener implements Listener {


    public function __construct() {
    }

    public function onFormSubmit(FormSubmitEvent $event): void {
        $player = $event->getPlayer();
        $formData = $event->getData();

        // Handle form submission
    }
}
