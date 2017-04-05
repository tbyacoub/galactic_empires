<?php
/**
 * Created by PhpStorm.
 * User: tbyacoub
 * Date: 4/5/17
 * Time: 2:49 PM
 */

namespace App\Traits;


trait Producible
{

    /**
     * Called after BuildingUpgraded event.
     *
     * Kick-In the Product specific bonuses after building upgrades.
     */
    public function setProduct()
    {
        $description = $this->description()->first();
        $product = $this->product()->first();
        if ($description->type == "facility" || $description->type == "shipyard") {
            $level = $this->current_level;
            if ($description->type == "facility") {
                $base = $product->characteristics['storage_base'];
                $rate = $product->characteristics['storage_base_rate'];
                $capacity = ($level * $base * $rate);
                $this->planet()->first()->setStorage($description->name, $capacity);
            } else {
                $base = $product->characteristics['capacity_base'];
                $rate = $product->characteristics['capacity_rate'];
                $capacity = ($level * $base * $rate);
                switch ($description->name) {
                    case "babylon5_shipyard":
                        $this->planet()->first()->fleet('babylon5')->first()->updateCapacity($capacity);
                        break;
                    case "battlestarGalactica_shipyard":
                        $this->planet()->first()->fleet('battlestar_galactica')->first()->updateCapacity($capacity);
                        break;
                    case "stargate_shipyard":
                        $this->planet()->first()->fleet('stargate')->first()->updateCapacity($capacity);
                        break;
                }
            }
        }
    }

    private function resource(){

    }

    private function planetary_defense(){

    }

    private function facility(){

    }

    private function research(){

    }

    private function shipyard(){

    }

}