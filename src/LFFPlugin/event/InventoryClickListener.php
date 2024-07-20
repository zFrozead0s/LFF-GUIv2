<?php

namespace LFFPlugin\event;

use pocketmine\event\Listener;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\player\Player;
use LFFPlugin\Main;

class InventoryClickListener implements Listener {

    /** @var Main */
    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onInventoryTransaction(InventoryTransactionEvent $event): void {
        $transaction = $event->getTransaction();
        $player = $transaction->getSource();

        if ($player instanceof Player) {
            foreach ($transaction->getActions() as $action) {
                $item = $action->getSourceItem();
                if ($item->getCustomName() !== "") {
                    // Mensaje a mostrar en el chat
                    $message = "El usuario: " . $player->getName() . " de clase: " . $item->getCustomName() . " busca una facción";
                    $this->plugin->getServer()->broadcastMessage($message);
                    $event->cancel(); // Evita que el jugador tome el item del inventario
                    return;
                }
            }
        }
    }
}
