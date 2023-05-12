<?php

namespace App\Models;

class ShoppingCart
{
    public $items = null;
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct($oldShoppingCart) {
        if ($oldShoppingCart) {
            $this->items = $oldShoppingCart->items;
            $this->totalQuantity = $oldShoppingCart->totalQuantity;
            $this->totalPrice = $oldShoppingCart->totalPrice;
        }
    }

    public function add($item, $id, $times) {
        $newItem = ['item' => $item, 'price' => $item->price, 'quantity' => 0];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $newItem = $this->items[$id];
            }
        }
        $newItem['quantity'] += $times;
        $newItem['price'] = $item->price * $newItem['quantity'];
        $this->items[$id] = $newItem;
        $this->totalPrice += ($item->price * $times);
        $this->totalQuantity += $times;
    }

    public function remove($id) {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $this->totalPrice -= $this->items[$id]['price'];
                $this->totalQuantity -= $this->items[$id]['quantity'];
                unset($this->items[$id]);
            }
        }
    }

    public function addOne($id) {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $this->totalPrice += $this->items[$id]['item']['price'];
                $this->items[$id]['price'] += $this->items[$id]['item']['price'];
                $this->items[$id]['quantity']++;
                $this->totalQuantity++;
            }
        }
    }

    public function removeOne($id) {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $this->totalPrice -= $this->items[$id]['item']['price'];
                $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
                $this->items[$id]['quantity']--;
                $this->totalQuantity--;
                if ($this->items[$id]['quantity'] == 0) {
                    unset($this->items[$id]);
                }
            }
        }
    }

    public function addPrice($price) {
        $this->totalPrice += $price;
    }
}
