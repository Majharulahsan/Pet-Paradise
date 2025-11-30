<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Mock product data for demonstration.
     */
    private $products = [
        [
            'id' => 1,
            'name' => 'Premium Dog Food (15kg)',
            'price' => 5999,
            'category' => 'Food & Nutrition',
            'image' => 'https://images.unsplash.com/photo-1520721973443-8f2bfd949b19?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwZXQlMjBzdXBwbGllc3xlbnwxfHx8fDE3NjA1MjE0NTl8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral',
            'rating' => 4,
            'reviews' => 124,
            'description' => 'Our Premium Dog Food is specially formulated with high-quality ingredients to provide complete and balanced nutrition for your furry friend. Made with real chicken as the first ingredient, this nutrient-rich formula supports healthy digestion, strong muscles, and a shiny coat. Perfect for adult dogs of all breeds.',
            'stock' => 45,
        ],
        [
            'id' => 2,
            'name' => 'Interactive Cat Toy',
            'price' => 2899,
            'category' => 'Toys & Play',
            'image' => 'https://images.unsplash.com/photo-1623963946022-f483257a2189?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxjdXRlJTIwY2F0JTIwcG9ydHJhaXR8ZW58MXx8fHwxNzYwNTIwOTE3fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referralhttps://images.unsplash.com/photo-1623963946022-f483257a2189?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxjdXRlJTIwY2F0JTIwcG9ydHJhaXR8ZW58MXx8fHwxNzYwNTIwOTE3fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral',
            'rating' => 3,
            'reviews' => 97,
            'description' => 'Keep your feline friend entertained for hours with this motion-activated, interactive toy. It encourages natural hunting instincts and provides essential mental stimulation.',
            'stock' => 12,
        ],
        [
            'id' => 3,
            'name' => 'Luxury Orthopedic Pet Bed',
            'price' => 10750,
            'category' => 'Comfort & Care',
            'image' => 'https://images.unsplash.com/photo-1643260218499-ffb487553b6d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwdXBweSUyMHBsYXlpbmd8ZW58MXx8fHwxNzYwNDczMzg2fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral',
            'rating' => 5,
            'reviews' => 133,
            'description' => 'The ultimate in pet comfort. This orthopedic bed provides excellent joint support, covered in a soft, machine-washable fabric for easy maintenance.',
            'stock' => 5,
        ],
        [
            'id' => 4,
            'name' => 'Grooming Kit for Small Animals',
            'price' => 1500,
            'category' => 'Comfort & Care',
            'image' => 'https://media.istockphoto.com/id/1277453154/photo/golden-retriever-dog-in-a-grooming-salon-is-taking-a-shower.jpg?s=612x612&w=0&k=20&c=J2vXxWLGC559xEgSt3OyBahZVs91CALA0tyI7FR_A98=',
            'rating' => 4,
            'reviews' => 55,
            'description' => 'An essential grooming kit including clippers, brushes, and a comb, perfect for rabbits, guinea pigs, and other small pets.',
            'stock' => 20,
        ],
    ];

    /**
     * Show the application home page (Hero UI).
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Show the product listing page (Shop UI).
     */
    public function shop()
    {
        // Pass the mock product list to the shop view
        return view('shop', [
            'products' => $this->products
        ]);
    }

    /**
     * Show a single product detail page (Product Detail UI).
     * @param int $id The product ID.
     */
    public function productDetail($id)
    {
        // Find the product by ID. Use strict type check for consistency.
        $product = collect($this->products)->firstWhere('id', (int)$id);

        if (!$product) {
            abort(404, 'Product not found.');
        }

        return view('product_detail', [
            'product' => $product
        ]);
    }
}