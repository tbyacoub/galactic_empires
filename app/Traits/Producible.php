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
        $level = $this->getLevel();
        $this->{$description->type}($description, $product, $level);
    }

    private function resource(){
        //TODO
    }

    private function planetary_defense(){
        //TODO
    }

    private function facility($description, $product, $level){
        $base = $product->characteristics['storage_base'];
        $rate = $product->characteristics['storage_base_rate'];
        $capacity = ($level * $base * $rate);
        $this->planet()->first()->setStorage($description->name, $capacity);
    }

    private function research($description, $product, $level){
        //TODO
    }

    private function shipyard($description, $product, $level){
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