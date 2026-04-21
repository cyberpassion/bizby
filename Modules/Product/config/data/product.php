<?php
$pg = 'product';

return [

    /* =========================
     | Bulk Operations
     ========================= */
    "bulk-operations" => [
        "view:detail" => "View Product Details",
        "op:remove"   => "Delete Product",
        "op:restore"  => "Restore Product"
    ],

    /* =========================
     | Default Columns
     ========================= */
    "columns" => [
        'entry'  => [
            'product_id','name','product_type','brand_name',
            'sku','retail_price','sale_price','unit','availability','tags','status'
        ],
        'list'   => [
            'product_id','name','product_type','brand_name',
            'sale_price','availability','status'
        ],
        'detail' => [
            'product_id','name','product_type','brand_name',
            'sku','retail_price','sale_price','unit','availability',
            'product_description','tags','status'
        ],
        'report' => [
            'product_id','name','product_type','brand_name',
            'sku','retail_price','sale_price','unit','availability','status'
        ],
        'sample_export' => [
            'sno','name','product_type','brand_name','sku',
            'retail_price','sale_price','unit','availability','product_description'
        ],
        'selected_columns' => [
            'name','product_type','brand_name','sku',
            'retail_price','sale_price','unit','availability','product_description'
        ]
    ],

    /* =========================
     | Statuses
     ========================= */
    "statuses" => [
        "1"  => "ACTIVE",
        "2"  => "INACTIVE",
        "3"  => "DELETED"
    ],

	/* =========================
	 | Availability Statuses
	 ========================= */
	"availability-statuses" => [
    	"in_stock"        => "In Stock",
    	"out_of_stock"    => "Out of Stock",
    	"low_stock"       => "Low Stock",
    	"preorder"        => "Pre Order",
    	"discontinued"    => "Discontinued"
	],

    /* =========================
     | Custom Fields
     ========================= */

    // Product Types
    "types" => [
        "physical" => "Physical",
        "service"  => "Service"
    ],

    // Availability (UI purpose only)
    "availability" => [
        "in_stock"     => "In Stock",
        "out_of_stock" => "Out of Stock",
        "preorder"     => "Pre Order"
    ],

    // Units
    "units" => [

    /* =========================
     | Quantity / Count
     ========================= */
    "pcs"      => "Pieces",
    "unit"     => "Unit",
    "pair"     => "Pair",
    "set"      => "Set",
    "box"      => "Box",
    "pack"     => "Pack",
    "dozen"    => "Dozen",

    /* =========================
     | Weight
     ========================= */
    "mg"       => "Milligram",
    "g"        => "Gram",
    "kg"       => "Kilogram",
    "ton"      => "Ton",

    /* =========================
     | Volume
     ========================= */
    "ml"       => "Millilitre",
    "litre"    => "Litre",
    "kl"       => "Kilolitre",

    /* =========================
     | Length
     ========================= */
    "mm"       => "Millimeter",
    "cm"       => "Centimeter",
    "m"        => "Meter",
    "km"       => "Kilometer",
    "inch"     => "Inch",
    "ft"       => "Feet",

    /* =========================
     | Area
     ========================= */
    "sqft"     => "Square Feet",
    "sqm"      => "Square Meter",
    "acre"     => "Acre",

    /* =========================
     | Time (for services)
     ========================= */
    "minute"   => "Minute",
    "hour"     => "Hour",
    "day"      => "Day",
    "month"    => "Month",
    "year"     => "Year"

],

    /* =========================
     | Validation & Rules
     ========================= */
    "mandatoryFields-product-entry-update" => [
        'name',
        'product_type',
        'retail_price'
    ],

    "dateFields-product-entry-update" => [],

    "additionalFields-product-entry-update" => [],

];