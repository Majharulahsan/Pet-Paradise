<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pet;
use App\Models\Product;
use App\Models\Appointment; 
use App\Models\DaycareBooking;
use App\Models\VaccinationPackage;
use App\Models\Vaccination;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- 1. MANUAL USER & PET ---
        // We create Jane once and store her in $jane to use for other records
        $jane = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
        ]);

        $luna = Pet::create([
            'user_id' => $jane->id,
            'name' => 'Luna',
            'species' => 'Cat',
            'breed' => 'Siamese',
            'birth_date' => '2023-01-01',
        ]);

        // --- 2. GENERATED USERS & PETS ---
        // Create 10 random people with random pets to make the app look busy
        User::factory(10)->create()->each(function ($user) {
            Pet::create([
                'user_id' => $user->id,
                'name' => fake()->firstName(),
                'species' => fake()->randomElement(['Dog', 'Cat', 'Bird']),
                'breed' => fake()->word(),
                'birth_date' => fake()->date(),
            ]);
        });

        // --- 3. PRODUCTS ---
        $myCategories = ['Food & Nutrition', 'Toys & Play', 'Comfort & Care'];
        
        foreach (range(1, 15) as $index) {
            Product::create([
                'title' => fake()->words(3, true),
                'description' => 'High quality items for your pets.',
                'image' => 'https://via.placeholder.com/150',
                'category' => fake()->randomElement($myCategories),
                'price' => fake()->randomFloat(2, 10, 500),
                'quantity' => rand(10, 100),
            ]);
        }

        // --- 4. SERVICE APPOINTMENTS ---
        // Appointment for Jane's cat
        Appointment::create([
            'user_id' => $jane->id,
            'pet_id' => $luna->id,
            'service_type' => 'Grooming',
            'appointment_date' => now()->addDays(2),
            'notes' => 'Luna needs a summer trim and nail clipping.',
            'status' => 'scheduled',
        ]);

        // Random appointments for others
        $allPets = Pet::where('id', '!=', $luna->id)->get();
        foreach ($allPets->random(5) as $randomPet) {
            Appointment::create([
                'user_id' => $randomPet->user_id,
                'pet_id' => $randomPet->id,
                'service_type' => fake()->randomElement(['Vet Visit', 'Grooming', 'Health Checkup']),
                'appointment_date' => fake()->dateTimeBetween('now', '+1 month'),
                'status' => 'scheduled',
            ]);
        }

        // --- 5. DAYCARE BOOKING ---
        DaycareBooking::create([
            'user_id' => $jane->id,
            'pet_id' => $luna->id,
            'check_in' => now()->addWeek(),
            'check_out' => now()->addWeek()->addDays(3),
        ]);

        // --- 6. VACCINATION PACKAGES ---
        $packages = [
            [
                'name' => 'Essential Puppy Pack',
                'description' => 'Includes Rabies, DHPP, and Lepto vaccines.',
                'price' => 120.00,
                'pet_type' => 'Dog'
            ],
            [
                'name' => 'Kitten Wellness Bundle',
                'description' => 'Includes FVRCP and FeLV vaccines.',
                'price' => 95.00,
                'pet_type' => 'Cat'
            ],
            [
                'name' => 'Puppy Starter Pack',
                'description' => 'Includes Rabies, Parvo, and Distemper shots.',
                'price' => 150.00,
                'pet_type' => 'Dog'
            ]
        ];

        foreach ($packages as $pkgData) {
            $createdPkg = VaccinationPackage::create($pkgData);
            
            // Link one of these to Jane's cat as an example
            if ($pkgData['pet_type'] === 'Cat') {
                Vaccination::create([
                    'pet_id' => $luna->id,
                    'package_id' => $createdPkg->id,
                    'vaccine_name' => 'Rabies',
                    'administered_at' => now()->subMonth(),
                    'next_due_date' => now()->addYear(),
                ]);
            }
        }

        // --- 7. REVIEWS ---
        $firstProduct = Product::first();
        if ($firstProduct) {
            Review::create([
                'user_id' => $jane->id,
                'reviewable_id' => $firstProduct->id,
                'reviewable_type' => Product::class,
                'rating' => 5,
                'comment' => 'My pet absolutely loves this! Highly recommend.',
            ]);
            // --- SECTION: DAYCARE SEEDING ---
\App\Models\DaycareBooking::create([
    'user_id' => $jane->id,
    'pet_id' => $luna->id,
    'check_in' => now()->addDays(5),
    'check_out' => now()->addDays(7),
    'special_instructions' => 'Luna likes to sleep near the window.',
]);
        }
    }
}