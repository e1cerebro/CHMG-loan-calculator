<?php

    class CPLC_DB_Utils{


        public static function get_products(){
            $args =  array(
                            'post_type' => 'product',
                            'numberposts' => -1,
                            'post_status' => 'publish',
                            'fields' => 'ids',
                        );
        
            $products  = get_posts($args);
            return $products;
        }

        public static function get_products_variations($product_id){
            global $woocommerce, $product, $post;

            $product = wc_get_product( $product_id );

            if ($product->is_type( 'variable' ))  {
                $temp_id_arr = array();
                $available_variations = $product->get_available_variations();
                foreach ($available_variations as $key => $value) 
                { 
                    array_push($temp_id_arr, $value['variation_id']);
                }
                return $temp_id_arr;
            }else{
                return false;
            }

           
        }
    }