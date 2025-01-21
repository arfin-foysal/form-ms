<?php

namespace Database\Seeders;

use App\Models\FormConfiguration;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('12345678'),
        ]);

        // Define available fields
        $availableFields = [
            [
                'type' => 'text',
                'name' => 'name',
                'label' => 'Name',
                'placeholder' => 'Enter your name',
                'required' => false,
                'order' => 1,
            ],
            [
                'type' => 'email',
                'name' => 'email',
                'label' => 'Email',
                'placeholder' => 'Enter your email',
                'required' => false,
                'validation' => 'email',
                'order' => 2,
            ],
            [
                'type' => 'textarea',
                'name' => 'message',
                'label' => 'Message',
                'placeholder' => 'Enter your message',
                'required' => false,
                'validation' => 'min:10|max:500',
                'order' => 3,
            ],
            [
                'type' => 'password',
                'name' => 'password',
                'label' => 'Password',
                'placeholder' => 'Enter your password',
                'required' => false,
                'validation' => 'min:8',
                'order' => 4,
            ],
            [
                'type' => 'number',
                'name' => 'age',
                'label' => 'Age',
                'placeholder' => 'Enter your age',
                'required' => false,
                'validation' => 'min:18|max:100',
                'order' => 5,
            ],
            [
                'type' => 'date',
                'name' => 'dob',
                'label' => 'Date of Birth',
                'required' => false,
                'validation' => 'before:today',
                'order' => 6,
            ],
            [
                'type' => 'file',
                'name' => 'profile_picture',
                'label' => 'Picture',
                'required' => false,
                'validation' => 'mimes:jpg,jpeg,png|max:2048',
                'order' => 7,
            ],
            [
                'type' => 'checkbox',
                'name' => 'agree',
                'label' => 'I agree to the terms and conditions',
                'required' => false,
                'options' => [['value' => 'yes', 'label' => 'Yes']],
                'validation' => 'accepted',
                'order' => 8,
            ],
            [
                'type' => 'radio',
                'name' => 'gender',
                'label' => 'Gender',
                'required' => false,
                'options' => [
                    ['value' => 'male', 'label' => 'Male'],
                    ['value' => 'female', 'label' => 'Female'],
                    ['value' => 'other', 'label' => 'Other'],
                ],
                'order' => 9,
            ],
            [
                'type' => 'select',
                'name' => 'country',
                'label' => 'Country',
                'placeholder' => 'Select a country',
                'required' => false,
                'options' => [
                    ['value' => 'bd', 'label' => 'Bangladesh'],
                    ['value' => 'in', 'label' => 'India'],
                    ['value' => 'us', 'label' => 'United States'],
                ],
                'order' => 10,
            ],
            [
                'type' => 'color',
                'name' => 'favorite_color',
                'label' => 'Favorite Color',
                'required' => false,
                'validation' => 'regex:^#[0-9a-fA-F]{6}$',
                'order' => 11,
            ],
            [
                'type' => 'range',
                'name' => 'satisfaction',
                'label' => 'Satisfaction Level',
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'required' => false,
                'validation' => 'integer|min:1|max:10',
                'order' => 12,
            ],
            [
                'type' => 'time',
                'name' => 'meeting_time',
                'label' => 'Meeting Time',
                'required' => false,
                'order' => 13,
            ],
            [
                'type' => 'url',
                'name' => 'website',
                'label' => 'Website',
                'placeholder' => 'Enter your website',
                'required' => false,
                'validation' => 'url',
                'order' => 14,
            ],
            [
                'type' => 'number',
                'name' => 'phone',
                'label' => 'Phone Number',
                'placeholder' => 'Enter your phone number',
                'required' => false,
                'validation' => 'regex:/^\\+?[0-9]{7,15}$/',
                'order' => 15,
            ],
        ];

        // Insert available fields into the Configuration model
        FormConfiguration::create([
            'forms' => $availableFields,
        ]);
    }
}
