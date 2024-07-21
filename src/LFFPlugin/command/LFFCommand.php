<?php

namespace LFFPlugin\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\item\VanillaItems;
use pocketmine\inventory\SimpleInventory;
use LFFPlugin\Main;

class LFFCommand extends Command {

    /** @var Main */
    private $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("lff", "Abre el menú Looking for Faction.", "/lff");
        $this->setPermission("lffplugin.command.lff");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if (!$this->testPermission($sender)) {
            return false;
        }

        if (!$sender instanceof Player) {
            $sender->sendMessage("Este comando solo puede ser usado en el juego.");
            return false;
        }

        $config = $this->plugin->getConfigData();
        $options = $config->get("options", []);

        $inventory = new SimpleInventory(count($options));

        foreach ($options as $index => $option) {
            $item = VanillaItems::getInstance()->get(ID::Paper); // Papel
            $item->setCustomName($option["name"]);
            $item->setLore([$option["description"]]);
            $inventory->setItem($index, $item);
        }

        $sender->setCurrentWindow($inventory);
        return true;
    }
}
