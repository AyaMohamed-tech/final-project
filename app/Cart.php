<?php
    namespace App;

    class Cart{

        public $items = null;
        public $integer_quantity = 0;
        // for kilos
        public $parts_quantity=0;
        // for parts of kilo (1/4,  1/2  ,3/4)
        public $totalPrice = 0;



        public function __construct($oldCart){
            
            if($oldCart){
                $this->items = $oldCart->items;
                $this->integer_quantity = $oldCart->integer_quantity;
                $this->parts_quantity = $oldCart->parts_quantity;

                $this->totalPrice = $oldCart->totalPrice;
            }

        }

        public function add($item, $product_id){

            $storedItem = ['qty' => 0, 'part_qty' => 0, 'product_id' => 0, 'product_name' => $item->product_name,'product_price' => $item->product_price, 'product_image' => $item->product_image, 'item' =>$item];

        if($this->items){
            if(array_key_exists($product_id, $this->items)){
                $storedItem = $this->items[$product_id];
            }
        }

        $storedItem['qty']++;
        $storedItem['part_qty']=0;

        $storedItem['product_id'] = $product_id;
        $storedItem['product_name'] = $item->product_name;
        $storedItem['product_price'] = $item->product_price;
        $storedItem['product_image'] = $item->product_image;
        $this->integer_quantity++;
        $this->parts_quantity=0;

        $this->totalPrice += $item->product_price;
        $this->items[$product_id] = $storedItem;

        }

        public function updateQty($id, $qty,$part_qty){
            if(isset($this->items[$id]['qty']) ||isset($this->items[$id]['product_price'])||isset($this->items[$id]['part_qty']))
            
            {
            $this->integer_quantity -= $this->items[$id]['qty'];
            $this->parts_quantity -= $this->items[$id]['part_qty'];


            $this->totalPrice -= $this->items[$id]['product_price'] * ($this->items[$id]['qty']+$this->items[$id]['part_qty']);
            // dd($this->totalPrice);
            $this->items[$id]['qty'] = $qty;
            $this->items[$id]['part_qty'] = $part_qty;

            $this->integer_quantity += $qty;
            $this->parts_quantity += $part_qty;

            $this->totalPrice += $this->items[$id]['product_price'] * ($qty+$part_qty);

            }

        }

        public function removeItem($id){
            $this->integer_quantity -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['product_price'] * ($this->items[$id]['qty']+$this->items[$id]['part_qty']);
            unset($this->items[$id]);
        }


    }
?>